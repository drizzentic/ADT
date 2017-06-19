<div class="external-content">
  <div class="container">
    <div class="row">

      <div class="col col-md-12">

        <div class="alert alert-info" role="alert" style="display: none;"> 

        </div>
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
<?= $ftp_status; ?>





    // $(".upload").text("Upload Backup");           
    // $('.upload').parent().append(' | <a class="btn btn-danger delete">Delete Backup</a>')
    // $('.upload').parent().first().html('<button class="btn btn-danger btn-sm delete">Delete Backup</button>')
// $('.upload').parent(:nth-child(3)  ).first().html('<button class="btn btn-primary btn-sm recover">Upload Backup</button>')
// $('.upload').parent()[0].find('.delete').remmove();

$("#backup_frm").on('submit',function(e){
  		//disable button when submitted
      $("#backup_btn, .btn").attr("disabled",true);
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
            $("#backup_btn, .btn").attr("disabled",false);
            $('#progress-text').text(resp);
              // $('.modal form').hide();
              $('#progress-panel').hide();
              $('.alert').show();
              $('.alert').text(""+resp);
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





$(".upload").click(function() {
  $('#progress-panel').show();
  $('#progress-text').text("Uploading copy of backup to remote server.");
  $(".upload, .btn").addClass("disabled");
  var current_row = $(this).closest('tr').children('td');
  var file_name = current_row.eq(0).text();

  var file = {
   "file_name" : file_name
 }

 var link="<?php echo base_url().'backup/upload_backup/'?>"
 $.ajax({
  url : link,
  type : 'POST',
      // dataType : 'json',
      data : file,
      done : function(response) {
        $('#progress-panel').hide();

        $(".upload, .btn").removeClass("disabled");
        $('.alert').show();
        console.log(response);
        $('.alert').text(response);
        // alert(response);
      },
      error: function(response){      
        $(".upload, .btn").removeClass("disabled");
        $('#progress-panel').hide();
        $('.alert').show();
        console.log(response);
        $('.alert').text(response);
        // alert(response);
      }
    });
});

$(".download").click(function() {
  $('#progress-panel').show();
  $('#progress-text').text("Downloading copy of backup from remote server.");
  $(".download, .btn").addClass("disabled");
  var current_row = $(this).closest('tr').children('td');
  var remote_path = current_row.eq(0).text();

  var file = {
   "remote_path" : remote_path
 }

 var link="<?php echo base_url().'backup/download_remote_file/'?>"
 $.ajax({
  url : link,
  type : 'POST',
      // dataType : 'json',
      data : file,
      success : function(response) {
        $('#progress-panel').hide();

        $(".download, .btn").removeClass("disabled");
        $('.alert').show();
        console.log(response);
        $('.alert').text(response);
        window.location.href = "";
        // alert(response);
      },
      error: function(response){      
        $(".download, .btn").removeClass("disabled");
        $('#progress-panel').hide();
        $('.alert').show();
        console.log(response);
        $('.alert').text(response);
        window.location.href = "";
        // alert(response);
      }
    });
});




$(".delete").click(function(e) {
  $('#progress-panel').show();
  $('#progress-text').text("Deleting Backup");
  $(".upload, .btn").addClass("disabled");
  var current_row = $(this).closest('tr').children('td');
  var file_name = current_row.eq(0).text();
  var file = {'file_name' : file_name};
  var link="<?php echo base_url().'backup/delete_backup/'?>"
  $.ajax({
    url : link,
    type : 'POST',
    data : file,
    success : function(response) {
      $('#progress-panel').hide();

      $(".upload, .btn").removeClass("disabled");
      $('.alert').show();
      console.log(response);
      $('.alert').text(response);
        // alert(response);
        // window.location.href = "";
      },
      error: function(response){      
        $(".upload, .btn").removeClass("disabled");
        $('#progress-panel').hide();
        $('.alert').show();
        console.log(response);
        $('.alert').text(response);
        // alert(response);
        // window.location.href = "";
      }
    });
});


});

</script>