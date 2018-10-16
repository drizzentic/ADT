<style type="text/css">
    /*@media (min-width: 992px)*/
    /*.modal-lg {*/
    /*width: 900px;*/
    /*}*/
    table{
        width:100%;
    }
    #pv_form{
        zoom:0.8 !important;
    }
</style>
<?php

function ellipsis($string, $max_length) {
    return (strlen($string) > $max_length) ? substr($string, 0, strrpos(substr($string, 0, $max_length), ' ')) . "…" : $string;
}
?>
<div class="row" id="pv_form">
    <div class="span11" style="background: #fdfdfd;">
        <a class="button disabled" href="<?php echo base_url() . 'inventory_management/pqmp/'; ?>">PQMP</a>
        <a class="button info" href="<?php echo base_url() . 'inventory_management/adr'; ?>">ADR</a>
        <hr>
    </div>
    <div class="span11">
        <h5>Patient ADR Reports</h5>
        <!--a href="<?php echo base_url().'inventory_management/pqmp_followup/';?>" class="btn btn-primary pull-right" id="followup" ><i class="icon icon-refresh"></i> ADR FOLLOWUP  </a-->
        <a href="#synchdata" class="btn btn-warning pull-right" id="SYNDATA" ><i class="icon icon-refresh"></i> Synch with PPB  </a>
        <span id="NOCOM" style="display:none">Synch disabled, connection to the SADR server could not be established...</span>

        <span id="SYNCHLOADER" style="display:none;">
            <img src="<?= base_url(); ?>assets/images/loading_spin.gif" width="30px" height="30px"/>
            Synchronizing Please wait....<span id="SYNCHPERCENT"></span>
        </span>

        <div style="display:none" id="SYNCHMESSAGE" class="alert alert-success">
            Synchronization Successfully Completed..
        </div>

            <?php $msg = $this->session->flashdata('pqmp_saved'); if (!empty($msg)) { ?>
            <div class="alert alert-success">
            <?= $this->session->flashdata('pqmp_saved'); ?>
            </div> 
        <?php }
        ?>

            <?php $adr_error = $this->session->flashdata('adr_error'); if (!empty($adr_error)) { ?>
            <div class="alert alert-danger">
            <?= $this->session->flashdata('adr_error'); ?>
            </div> 
        <?php }
        ?>
    </div>
    <div class="span11">
        <table border="1" class="table" >
            <thead>
            <th>Synch<br><input type="checkbox" id="CHECKALL"/>
                <input type="checkbox" checked="checked" name="adrid" style="display:none;" value="1010101010101010"/></th>
            <th>#</th>
            <th>Patient</th>
            <th>diagnosis</th>
            <th>Severity</th>
            <th>Outcome</th>
            <th>Date</th>
            <th>Action Taken</th>  

            </thead>
            <tbody>
<?php foreach ($adr_data as $key => $adr) { ?>
                    <tr>
                        <td>

    <?php if ($adr['synch'] == '0' || is_null($adr['synch'])) { ?>
                                <input type="checkbox" name="adrid" value="<?= $adr['id']; ?>"

                                   <?php } else { ?>
                                       <span class="">&#9989;</span> 
                            <?php }
                            ?></td>
                        <td> <?= $adr['id']; ?></td>
                        <td>
                            <a href="<?= base_url(); ?>inventory_management/loadAdrRecord/<?= $adr['id']; ?> "> <?= ellipsis($adr['patient_name'], 10); ?> </a>
                        </td>
                        <td> <?= ellipsis($adr['diagnosis'], 10); ?></td>
                        <td> <?= ellipsis($adr['severity'], 10); ?></td>
                        <td> <?= ellipsis($adr['outcome'], 10); ?></td>
                        <td> <?= ellipsis($adr['datecreated'], 10); ?></td>
                        <td> <?= ellipsis($adr['action_taken'], 10); ?></td>


                    </tr>    
<?php } ?>
            </tbody>

        </table>
    </div>
</div>
<script type="text/javascript">


    $(document).ready(function () {

        $("#CHECKALL").click(function () {
            $("input[name='adrid']:checkbox").not(this).prop('checked', this.checked);
        });


        $('#SYNDATA').click(function () {

            // if ($("input[name='adrid']:checked").length > 0) {
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



            //  } else {
            //  alert("synch Error: No data selected to synch..");
            //}
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
        }, 25000);

        var storeTable = $('table').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "sDom": '<"H"Tfr>t<"F"ip>',
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0]}],
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