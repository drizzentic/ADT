<div class="external-content">
  <div class="container">
    <div class="row">
      <div class="col col-md-12">
        <h4>Create Backup</h4>
        <form class="form-horizontal" id="backup_frm">
         <div class="form-group">
         </div>
         <div class="form-group">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary" id="backup_btn">Run Backup</button>
          </div>
        </div>
      </form>

      <div id="progress-panel" style="display: none;">
        <span id="progress-text">Creating Backup</span>  
        <img src="<?= base_url() ?>assets/img/loader.gif" >
      </div>
      <hr />
      
    </div>

  </div>

</div>
<h4>Backup viewer</h4>
<div class="browser">
  <div id="dvContents" class="dvContents">
   <?php
   echo $backup_files;
   ?>
 </div>
</div>
</div>
<script type="text/javascript">

  $(document).ready(function(){ 

   
   $("#backup_frm").on('submit',function(e){
  		//disable button when submitted
      $("#backup_btn").attr("disabled",true);
        // do ajax request to backup


        var upload =   $('input[name=upload]:checked').val();



        var data = {
          upload : upload,
          stage     : "make_order"
        };


        $('#progress-panel').show();

        $.ajax({
          type: "POST",
          url: "backup/run_backup",
          data: data,
          success: (function(resp){
            $("#backup_btn").attr("disabled",false);
            $('#progress-text').text(resp);
              // $('.modal form').hide();
              $('#progress-panel').hide();
              window.location.href = "";

            }),
          error:(function(resp){
              // $("#backup_btn").attr("disabled",false);
              // $('.modal form').hide();
              alert("Error: Cannot conect to database for backup.");
            })


  // dataType: dataType
});





        e.preventDefault();
      });


   $(".recover").click(function() {
     var current_row = $(this).closest('tr').children('td');
     var file_name = current_row.eq(1).text();
     var link="<?php echo base_url().'recover/start_recovery/'?>"
     $.ajax({
      url : link,
      type : 'POST',
      dataType : 'json',
      data : {
       "file_name" : file_name
     },
     success : function(data) {
       if(data==1){
        alert("Recovery successful")
      }else{
        alert("Recovery not needed")
      }
    }
  });
   });
 });

</script>