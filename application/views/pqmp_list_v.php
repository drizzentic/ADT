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
        <a class="button info" href="<?php echo base_url() . 'inventory_management/pqmp/'; ?>">PQMP</a>
        <a class="button disabled" href="<?php echo base_url() . 'inventory_management/adr/'; ?>">ADR</a>
        <hr>
    </div>
    <div class="span11">
        <h5>PQMP Reports</h5>
    </div>
    <div class="span11">
        <a href="<?= base_url(); ?>inventory_management/new_pqmp"  id="NEWPQ" class="btn btn-default" > New PQMQ </a>
        <a href="#synchdata" class="btn btn-default" id="SYNDATA" > Synch PQMQ </a>
        <span id="NOCOM" style="display:none">Synch disabled, connection to the SPQM server could not be established...</span>
        <span id="SYNCHLOADER" style="display:none;">
            <img src="<?= base_url(); ?>assets/images/loading_spin.gif" width="30px" height="30px"/>
            Synchronizing Please wait....
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

        <?php if (!empty($this->session->flashdata('pqmp_error'))) { ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('pqmp_error'); ?>
            </div> 
        <?php }
        ?>



        <table border="1" class="table" >
            <thead>
            <th></th>
            <th>Reporter Name</th>
            <th>Brand Name</th>
            <th>Generic Name</th>
            <th>Batch No</th>
            <th>Manufacturer Name</th>
            <th>Receipt Date</th>
            <th>Supplier Name</th>  
            <th>Synch Status</th>
            </thead>
            <tbody>
                <?php foreach ($pqmp_data as $key => $pqmp) { ?>
                    <tr>
                        <td>
                            <?php if ($pqmp['synch'] == '0') { ?>
                                <input type="checkbox" class="synvals" value="<?= $pqmp['id']; ?>" name="pmpqid">
                            <?php } else { ?>
                                <span class=""><i class="fa fa-check-circle-o"></i>ok</span> 
                            <?php }
                            ?>
                        </td>
                        <td><a href="<?= base_url(); ?>inventory_management/pqmp/<?= $pqmp['id']; ?> "> <?= $pqmp['reporter_name']; ?> </a></td>
                        <td> <?= $pqmp['brand_name']; ?></td>
                        <td> <?= $pqmp['generic_name']; ?></td>
                        <td> <?= $pqmp['batch_number']; ?></td>
                        <td> <?= $pqmp['name_of_manufacturer']; ?></td>
                        <td> <?= $pqmp['receipt_date']; ?></td>
                        <td> <?= $pqmp['supplier_name']; ?></td>
                        <td> <?php if ($pqmp['synch'] == '0') { ?>
                                <a href="<?= base_url(); ?>inventory_management/getpvdata/pqms/pqm/<?= $pqmp['id']; ?> " title="Data synchronization has not occured" class="badge badge-warning">Not Synched</a>
                            <?php } else if ($pqmp['synch'] == '1') { ?>
                                <span class="badge badge-success" title="Data synched to remote server">&uArr;Synch(U)</span> 
                            <?php } else { ?>
                                <span class="badge badge-info" title="Data synched from remote server">&dArr;Synch(D)</span> 
                            <?php } ?>
                        </td>

                    </tr>    
                <?php } ?>
            </tbody>

        </table>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function () {

        $('#SYNDATA').click(function () {

            if ($("input[name='pmpqid']:checked").length > 0) {
                $('#SYNDATA').prop('disabled', true);
                $('#NEWPQ').prop('disabled', true);
                $('#SYNCHLOADER').show();
                var searchIDs = $("input[name='pmpqid']:checked:checked").map(function () {
                    return $(this).val();
                }).get();

                $.post("<?= base_url(); ?>inventory_management/getpvdata/pqms/pqm/", {ids: searchIDs}, function (resp) {

                    if (resp.status === 'success') {

                        $('#SYNCHLOADER').hide();
                        $('#SYNCHMESSAGE').show();
                        $('#SYNDATA').prop('disabled', false);
                        $('#NEWPQ').prop('disabled', false);
                        setInterval(function () {
                            window.location.href = "<?= base_url(); ?>inventory_management/pqmp/";
                        }, 2000);

                    } else {
                        alert("Something went Wrong, Synchronization could not be done");
                    }
                }, 'json');

            } else {
                alert('Error: Please Select Data to be synchronised');
                return false;

            }
        });


        setInterval(function () {
            $.getJSON("<?= base_url(); ?>inventory_management/serverStatus", function (resp) {
                if (resp.status === 404) {
                    $('#NOCOM').show();
                    $('#SYNDATA').hide();
                } else if(resp.status === 200){
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