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
      <a class="button info" href="<?php echo base_url().'inventory_management/pqmp/'; ?>">PQMP</a>
      <a class="button disabled" href="<?php echo base_url().'inventory_management/adr/'; ?>">ADR</a>
      <hr>
      </div>
      <div class="span11">
      <h5>PQMP Reports</h5>
    </div>
      <div class="span11">
        <a href="<?= base_url();?>inventory_management/new_pqmp" class="btn btn-default" > New PQMQ </a>
        <table border="1" class="table" >
          <thead>
            <th>Reporter Name</th>
            <th>Brand Name</th>
            <th>Generic Name</th>
            <th>Batch No</th>
            <th>Manufacturer Name</th>
            <th>Receipt Date</th>
            <th>Supplier Name</th>  
          </thead>
          <tbody>
            <?php foreach ($pqmp_data as $key => $pqmp) {?>
            <tr>
              <td><a href="<?= base_url(); ?>inventory_management/pqmp/<?= $pqmp['id'];  ?> "> <?= $pqmp['reporter_name'];  ?> </a></td>
              <td> <?= $pqmp['brand_name'];  ?></td>
              <td> <?= $pqmp['generic_name'];  ?></td>
              <td> <?= $pqmp['batch_no'];  ?></td>
              <td> <?= $pqmp['manufacturer_name'];  ?></td>
              <td> <?= $pqmp['receipt_date'];  ?></td>
              <td> <?= $pqmp['supplier_name'];  ?></td>

            </tr>    
            <?php  } ?>
          </tbody>

        </table>
      </div>
    </div>
<script type="text/javascript">

 $(document).ready(function(){

  var storeTable=$('table').dataTable({
    "bJQueryUI": true,
    "sPaginationType": "full_numbers",
    "sDom": '<"H"Tfr>t<"F"ip>',
    "oTableTools": {
      "sSwfPath": base_url+"scripts/datatable/copy_csv_xls_pdf.swf",
      "aButtons": [ "copy", "print","xls","pdf" ]
    },
    "bProcessing": true,
    "bServerSide": false,
  });


  $("#manufacture_date,#expiry_date,#receipt_date").datepicker();

});

</script>