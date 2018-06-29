<style type="text/css">
    /*@media (min-width: 992px)*/
    /*.modal-lg {*/
    /*width: 900px;*/
    /*}*/
    table{
        width:100%;
    }

</style>
<div class="row">
    <div class="span11" style="background: #fdfdfd;">
        <a class="button disabled" href="<?php echo base_url() . 'inventory_management/pqmp/'; ?>">PQMP</a>
        <a class="button info" href="<?php echo base_url() . 'inventory_management/adr'; ?>">ADR</a>
        <hr>
    </div>
    <div class="span11">
        <h5>Patient ADR Reports</h5>
        <a href="#synchdata" class="btn btn-default" id="SYNDATA" > Synch ADR </a>
        <span id="NOCOM" style="display:none">Synch disabled, connection to the SADR server could not be established...</span>

        <span id="SYNCHLOADER" style="display:none;">
            <img src="<?= base_url(); ?>assets/images/loading_spin.gif" width="30px" height="30px"/>
            Synchronizing Please wait....<span id="SYNCHPERCENT"></span>
        </span>

        <div style="display:none" id="SYNCHMESSAGE" class="alert alert-success">
            Synchronization Successfully Completed..
        </div>

        <?php if (!empty($this->session->flashdata('pqmp_saved'))) { ?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('pqmp_saved'); ?>
            </div> 
        <?php }
        ?>

        <?php if (!empty($this->session->flashdata('adr_error'))) { ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('adr_error'); ?>
            </div> 
        <?php }
        ?>
    </div>
    <div class="span11">
        <table border="1" class="table" >
            <thead>
            <th></th>
            <th>#</th>
            <th>Patient</th>
            <th>diagnosis</th>
            <th>Severity</th>
            <th>Outcome</th>
            <th>Date</th>
            <th>Action Taken</th>  
            <th>Status</th>  
            </thead>
            <tbody>
                <?php foreach ($adr_data as $key => $adr) { ?>
                    <tr>
                        <td>

                            <?php if ($adr['synch'] == '0') { ?>
                                <input type="checkbox" name="adrid" value="<?= $adr['id']; ?>"
                            <?php } else { ?>
                                       <span class=""><i class="fa fa-check-circle-o"></i>ok</span> 
                                   <?php }
                                   ?></td>
                        <td> <?= $adr['id']; ?></td>
                        <td>
                            <a href="<?= base_url(); ?>inventory_management/adr/<?= $adr_data[0]['id']; ?> "> <?= $adr['patient_name']; ?> </a>
                        </td>
                        <td> <?= $adr['diagnosis']; ?></td>
                        <td> <?= $adr['severity']; ?></td>
                        <td> <?= $adr['outcome']; ?></td>
                        <td> <?= $adr['datecreated']; ?></td>
                        <td> <?= $adr['action_taken']; ?></td>
                        <td> <?php if ($adr['synch'] == '0') { ?>
                                <a href="<?= base_url(); ?>inventory_management/getpvdata/pqms/pqm/<?= $adr['id']; ?> " title="Data synchronization has not occured" class="badge badge-warning">Not Synched</a>
                            <?php } else if ($adr['synch'] == '1') { ?>
                                <span class="badge badge-success" title="Data synched to remote server">&uArr;Synch(U)</span> 
                            <?php } else { ?>
                                <span class="badge badge-info" title="Data synched from remote server">&dArr;Synch(D)</span> 
                            <?php } ?></td>

                    </tr>    
                <?php } ?>
            </tbody>

        </table>
    </div>
</div>
<script type="text/javascript">
    (function ($, window, undefined) {
        //is onprogress supported by browser?
        var hasOnProgress = ("onprogress" in $.ajaxSettings.xhr());

        //If not supported, do nothing
        if (!hasOnProgress) {
            return;
        }

        //patch ajax settings to call a progress callback
        var oldXHR = $.ajaxSettings.xhr;
        $.ajaxSettings.xhr = function () {
            var xhr = oldXHR.apply(this, arguments);
            if (xhr instanceof window.XMLHttpRequest) {
                xhr.addEventListener('progress', this.progress, false);
            }

            if (xhr.upload) {
                xhr.upload.addEventListener('progress', this.progress, false);
            }

            return xhr;
        };
    })(jQuery, window);

    $(document).ready(function () {


        $('#SYNDATA').click(function () {

            if ($("input[name='adrid']:checked").length > 0) {
                $('#SYNDATA').prop('disabled', true);
                $('#NEWAD').prop('disabled', true);
                $('#SYNCHLOADER').show();
                var searchIDs = $("input[name='adrid']:checked:checked").map(function () {
                    return $(this).val();
                }).get();

                $.ajax({
                    type: 'post',
                    url: "<?= base_url(); ?>inventory_management/getpvdata/adr_form/adr/",
                    dataType: 'json',
                    data: {ids: searchIDs},
                    success: function (resp) {
                        if (resp.status === 'success') {

                            $('#SYNCHLOADER').hide();
                            $('#SYNCHMESSAGE').show();
                            $('#SYNDATA').prop('disabled', false);
                            $('#NEWPQ').prop('disabled', false);
                            setInterval(function () {
                                window.location.href = "<?= base_url(); ?>inventory_management/adr/";
                            }, 2000);
                        } else {
                            alert("Something went Wrong, Synchronization could not be done");
                        }

                    },
                    error: function () { },
                    progress: function (e) {
                        //make sure we can compute the length
                        if (e.lengthComputable) {
                            //calculate the percentage loaded
                            var pct = (e.loaded / e.total) * 100;
                            //log percentage loaded
                            $('#SYNCHPERCENT').text(pct);
                        }
                        //this usually happens when Content-Length isn't set
                        else {
                            console.warn('Content Length not reported!');
                        }
                    }

                });



            } else {
                alert("synch Error: No data selected to synch..");
            }
        });

        setInterval(function () {
            $.getJSON("<?= base_url(); ?>inventory_management/serverStatus", function (resp) {
                if (resp.status === 404) {
                    $('#NOCOM').show();
                    $('#SYNDATA').hide();
                } else if (resp.status === 200) {
                    $('#NOCOM').hide();
                    $('#SYNDATA').show();
                }
            });
        }, 5000);

        var storeTable = $('table').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "sDom": '<"H"Tfr>t<"F"ip>',
            "oTableTools": {
                "sSwfPath": base_url + "scripts/datatable/copy_csv_xls_pdf.swf",
                "aButtons": ["copy", "print", "xls", "pdf"]
            },
            "bProcessing": true,
            "bServerSide": false,
        });
        $("#manufacture_date,#expiry_date,#receipt_date").datepicker();
    });

</script>