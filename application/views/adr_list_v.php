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

      <div class="span12">
        <table border="1" class="table" >
          <thead>
            <th>#</th>
            <th>Patient</th>
            <th>diagnosis</th>
            <th>Severity</th>
            <th>Outcome</th>
            <th>Date</th>
            <th>Action Taken</th>  
          </thead>
          <tbody>
            <?php foreach ($adr_data as $key => $adr) {?>
            <tr>
              <td> <?= $adr['id'];  ?></td>
              <td>
                <a href="<?= base_url(); ?>inventory_management/adr/<?= $adr_data[0]['id'];  ?> "> <?= $adr['patient_name'];  ?> </a>
              </td>
              <td> <?= $adr['diagnosis'];  ?></td>
              <td> <?= $adr['severity'];  ?></td>
              <td> <?= $adr['outcome'];  ?></td>
              <td> <?= $adr['datecreated'];  ?></td>
              <td> <?= $adr['action_taken'];  ?></td>

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