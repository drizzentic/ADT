<style type="text/css">
/*@media (min-width: 992px)*/
/*.modal-lg {*/
  /*width: 900px;*/
  /*}*/

  .f-input{
    width: 100% !important;

  }
  textarea{
    width: 100% !important;
  }
</style>

<div class="container" style="background-color: #fffacc;border: solid thick #0000ff;padding: 30px; margin-top: 130px; margin-bottom: 130px;">

  <a href="<?= base_url();?>inventory_management/adr" class="btn btn-default" > Back </a>
  <a href="javascript:;;" class="btn btn-default" id="edit-btn" > Edit </a>
  <a href="<?= base_url();?>inventory_management/adr/<?=  $record_no;?>/export" class="btn btn-default" > Export(.xls) </a>
  <form name="adr_form" id="adr_form">
    <div class="container">
      <div class="row">
        <div class="text-center">
         <img src="../../assets/images/top_logo.png">
         <h4>
          MINISTRY OF HEALTH <br />
          THE PHARMACY AND POISONS BOARD<br />
          P. O. Box 27663-00506 NAIROBI<br />
          Tel: (020)-2716905 / 6 Ext 114    Fax: (020) 2713431/2713409.<br />
          Email: pv@pharmacyboardkenya.org

        </h4>
        <h3 style="color:red; font-family: 'Comic Sans MS';">SUSPECTED ADVERSE DRUG REACTION REPORTING FORM</h3>
      </div>
    </div>
  </div>
  <div class="max-row">
    <div class="mid-row">
      <input type="hidden" name="adr_id" value="<?=  $adr_data[0]['id'];?>" class="form-control f-input">

      <label><span class='astericks'>*</span>NAME OF INSTITUTION: </label>
      <input type="text" name="institution" id="institution" value="<?=  $adr_data[0]['institution_name'];?>" class="validate[required] f-input">
    </div>
    <div class="mid-row">
      <label ><span class='astericks'>*</span>INSTITUTION CODE:</label>
      <input  type="text" name="institutioncode" id="institutioncode" value="<?=  $adr_data[0]['institution_code'];?>" class="validate[required] f-input">
    </div>
  </div>

  <div class="max-row">
    <div class="mid-row">
      <label><span class='astericks'>*</span>ADDRESS </label>
      <input type="text" name="address" id="address" value="<?= $adr_data[0]['address'];?>" class="validate[required] f-input">
    </div>
    <div class="mid-row">
      <label ><span class='astericks'>*</span>CONTACT</label>
      <input  type="text" name="contact" id="contact" value="<?= $adr_data[0]['contact'];?>" class="validate[required] f-input">
    </div>
  </div>

  <div class="max-row">
    <div class="mid-row">
    </div>
    <div class="mid-row">
    </div>

    <div class="mid-row">
    </div>

  </div>

  <div class="max-row">

    <table border="0" style="width: 100%;">
      <tr>
        <td> <label><span class='astericks'>*</span>PATIENT’S NAME/ INITIAL </label>
          <input type="text" name="patientname" id="patientname" value="<?= $adr_data[0]['patient_name'];?>" class="validate[required] f-input">
        </td>
        <td> <label ><span class='astericks'>*</span>IP/OP. NO</label>
          <input  type="text" name="ip_no" id="ip_no" value="<?= $adr_data[0]['ip_no']?>" class="validate[required] f-input">
        </td>
        <td> <label ><span class='astericks'>*</span>D.O.B</label>
          <input  type="text" name="dob" id="dob" value="<?= $adr_data[0]['dob']?>" class="validate[required] f-input">
        </td>
      </tr>
      <tr>
        <td>  <label><span class='astericks'>*</span>PATIENT’S ADDRESS </label>
          <input type="text" name="patientaddress" id="patientaddress"  value="<?= $adr_data[0]['patient_address']?>" class="validate[required] f-input"></td>
          <td> <label ><span class='astericks'>*</span>WARD/CLINIC</label>
            <input  type="text" name="clinic" id="clinic" value="<?= $adr_data[0]['ward_clinic']?>" class="validate[required] f-input">
          </td>
          <td>
            <label id="dcs" >GENDER</label>
            <input  type="radio"  name="gender" gender="gender" value="MALE">
            male 
            <input  type="radio"  name="gender" gender="gender" value="FEMALE">
            female
          </td> 
        </tr>
        <tr>
          <td rowspan="2">
            <label id="dcs" >ANY KNOWN  ALLERGY</label>
            <input  type="radio"  name="allergy" class="allergy" value="0">
            no<br />
            <input  type="radio"  name="allergy" class="allergy" value="1">
            yes<br />
            if yes, specify
            <input  type="text" name="allergydesc" id="allergydesc" class="validate[required] f-input" style="display: none;" value="<?= $adr_data[0]['alergy_desc']?>">
          </td>
          <td rowspan="2">
            <label id="dcs" >PREGNANCY STATUS</label>
            <input  type="radio"  name="pregnancystatus" value="NotPregnant">
            Not Pregnant<br />
            <input  type="radio"  name="pregnancystatus" value="1stTrimester">
            1st Trimester<br />
            <input  type="radio"  name="pregnancystatus" value="2ndTrimester">
            2nd Trimester<br />
            <input  type="radio"  name="pregnancystatus" value="3rdTrimester">
            3rd Trimester 
          </td>
          <td>
            <label><span class='astericks'>*</span>WEIGHT (kg): </label>
            <input type="text" name="patientweight" id="patientweight" value="<?= $adr_data[0]['weight']?>" class="validate[required] f-input">
          </td>
        </tr>
        <tr>
          <td>
            <label ><span class='astericks'>*</span>HEIGHT (cm):</label>
            <input  type="text" name="patientheight" id="patientheight" value="<?= $adr_data[0]['height']?>" class="validate[required] f-input">
          </td>
          
        </tr>
        <tr>
          <td colspan="3">
            <label><span class='astericks'>*</span>DIAGNOSIS: (What was the patient treated for): </label>
            <textarea name="diagnosis" id="diagnosis" class="" ><?= $adr_data[0]['diagnosis']?></textarea>
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <label ><span class='astericks'>*</span>BRIEF DESCRIPTION OF REACTION:</label>
            <textarea name="reaction" id="reaction" class=""><?= $adr_data[0]['reaction_description']?></textarea>         
          </td>
        </tr>
      </table>
    </div>

    <table class="table table-bordered table-hover" id="tab_logic">
      <thead>
        <tr >
          <th class="text-center">
            #
          </th>
          <th>DRUGS </th>
          <th>Dose</th> 
          <th>ROUTE  AND FREQUENCY</th>
          <th>DATE STARTED </th>
          <th>DATE STOPPED </th>
          <th>INDICATION </th>
          <th>TICK SUSPECTED DRUG </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($adr_data as $key => $pv) {?>
        <tr>
          <td> <?= $key; ?></td>
          <?php 
          ;

// $ds =strtotime($pv['dispensing_date'])+($pv['duration']*60*60*24);
          $ds = date('Y-m-d',strtotime($pv['dispensing_date'])+($pv['duration']*60*60*24));
// end date
          ?>
          <input type="hidden" name="adr_detail_id[]" value="<?= $pv['adr_details_id']?>" class="form-control f-input">
          <input type="hidden" name="visitid[]" value="<?= $pv['visitid']?>" class="form-control f-input">
          <td><input type="text" name="drug[]" value="<?= $pv['drug']?>" class="form-control f-input"></td>
          <td><input type="text" name="dose[]" value="<?= $pv['dose']?>" class="form-control f-input"></td>
          <td><input type="text" name="frequency[]" value="<?= $pv['route_freq']?>" class="form-control f-input"></td>
          <td><input type="text" name="dispensing_date[]" value="<?= $pv['date_started']?>" class="form-control f-input"></td>
          <td><input type="text" name="date_stopped[]" value="<?= $pv['date_stopped'];?>" class="form-control f-input adrdate"></td>
          <td><input type="text" name="indication[]" value="<?= $pv['indication']?>" class="form-control f-input"></td>
          <td><input type="checkbox" name="suspecteddrug[]" <?php if ($pv['suspecteddrug'] =='on'){?>checked=""<?php }?>></td>
        </tr>
        <?php  } ?>

      </tbody>
    </table>

    <div class="max-row">

      <div class="mid-row">
        <label id="dcs" for="severity" ><b>Severity of reaction (refer to scale overleaf)</b></label>
        <input  type="radio" class="severity"  name="severity" value="Mild">
        Mild <br /> 
        <input  type="radio" class="severity"  name="severity" value="Moderate">
        Moderate <br /> 
        <input  type="radio" class="severity"  name="severity" value="Severe">
        Severe <br /> 
        <input  type="radio" class="severity"  name="severity" value="Fatal">
        Fatal <br /> 
        <input  type="radio" class="severity"  name="severity" value="Unknown">
        Unknown
      </div>


      <div class="mid-row">
        <label id="" for="action" ><b>ACTION TAKEN</b></label>
        <input  type="radio"  name="action" class="action" value="Drug withdrawn">
        Drug withdrawn<br />
        <input  type="radio"  name="action" class="action" value="Dose increased">
        Dose increased<br />
        <input  type="radio"  name="action" class="action" value="Dose reduced">
        Dose reduced<br />
        <input  type="radio"  name="action" class="action" value="Dose not changed">
        Dose not changed<br />
        <input  type="radio"  name="action" class="action" value="Unknown">
        Unknown
      </div>


      <div class="mid-row">
        <label id="dcs" for="outcome" ><b>OUTCOME</b></label>
        <input  type="radio"  name="outcome" class="outcome" value="Recovering / resolving">
        Recovering / resolving<br />
        <input  type="radio"  name="outcome" class="outcome" value="Recovered / resolved">
        Recovered / resolved<br />
        <input  type="radio"  name="outcome" class="outcome" value="Requires or prolongs hospitalization">
        Requires or prolongs hospitalization<br />
        <input  type="radio"  name="outcome" class="outcome" value="Causes a congenital anomaly">
        Causes a congenital anomaly<br />
        <input  type="radio"  name="outcome" class="outcome" value="Requires intervention to prevent permanent damage">
        Requires intervention to prevent permanent damage <br />
        <input  type="radio"  name="outcome" class="outcome" value="Unknown">
        Unknown
      </div>


      <div class="mid-row">
        <label id="dcs" for="casuality" ><b>CAUSALITY OF REACTION (refer to scale overleaf)</b></label>
        <input  type="radio"  name="casuality" class="casuality" value="Certain">
        Certain <br />
        <input  type="radio"  name="casuality" class="casuality" value="Probable / Likely">
        Probable / Likely <br />
        <input  type="radio"  name="casuality" class="casuality" value="Possible">
        Possible <br />
        <input  type="radio"  name="casuality" class="casuality" value="Unlikely">
        Unlikely <br />
        <input  type="radio"  name="casuality" class="casuality" value="Conditional / Unclassified">
        Conditional / Unclassified <br />
        <input  type="radio"  name="casuality" class="casuality" value="Unassessable / Unclassifiable">
        Unassessable / Unclassifiable
      </div>

    </div>
    <div class="max-row">
      <div class="mid-row">
        <label class="blue" for="othercomment">ANY OTHER COMMENT : </label>
        <textarea name="othercomment" class="" id="othercomment"><?= $adr_data[0]['other_comment']; ?></textarea>

      </div>
    </div>


    <div class="max-row">
      <div class="mid-row">
        <label><span class='astericks'>*</span>NAME OF PERSON REPORTING </label>
        <input type="text" name="officername" id="officername" value="<?= $adr_data[0]['reporting_officer'];?>" class="validate[required] f-input">
      </div>
      <div class="mid-row">
        <label ><span class='astericks'>*</span>DATE:</label>
        <input  type="text" name="reportingdate" id="reportingdate" class="validate[required] f-input adrdate" value="<?= $adr_data[0]['reporting_date'];?>">
      </div>
      <div class="mid-row">
        <label><span class='astericks'>*</span>Email ADDRESS </label>
        <input type="text" name="officeremail" id="officeremail" value="<?= $adr_data[0]['email_address'];?>" class="validate[required] f-input">
      </div>
      <div class="mid-row">
        <label><span class='astericks'>*</span>Office Phone </label>
        <input type="text" name="officerphone" id="officerphone" value="<?= $adr_data[0]['office_phone'];?>" class="validate[required] f-input">
      </div>
      <div class="mid-row">
        <label><span class='astericks'>*</span>Designation</label>
        <input type="text" name="officerdesignation" id="officerdesignation" class="validate[required] f-input" value="<?= $adr_data[0]['designation']; ?>">
      </div>
      <div class="mid-row">
        <label><span class='astericks'>*</span>Signature </label>
        <input type="text" name="officersignature" id="officersignature" class="validate[required] f-input" value="<?= $adr_data[0]['signature']; ?>">
      </div>
      <div class="mid-row" id="submit-container" style="display: none;">
        <button type="submit" form="adr_form" value="Submit">Submit</button>
        <button>cancel</button>
      </div>
    </div>
  </form>
</div>

<script type="text/javascript">

 $(document).ready(function(){
  $("input[name=outcome][value=<?= $adr_data[0]['outcome'] ?>]").attr('checked', 'checked');
  $("input[name=casuality][value=<?= $adr_data[0]['reaction_casualty'] ?>]").attr('checked', 'checked');
  $("input[name=gender][value=<?= $adr_data[0]['gender'] ?>]").attr('checked', 'checked');
  $("input[name=action][value=<?= $adr_data[0]['action_taken'] ?>]").attr('checked', 'checked');
  $("input[name=severity][value=<?= $adr_data[0]['severity'] ?>]").attr('checked', 'checked');
  $('input,textarea').attr('disabled',true);
  var pregnant= '<?= $adr_data[0]['pregnant'] ?>';
  var allergies= '<?= $adr_data[0]['alergy_desc'] ?>';

  if (pregnant ==='NO'){
    $("input[name=pregnancystatus][value=NotPregnant]").attr('checked', 'checked');
  }else{
    $("input[name=pregnancystatus][value=1stTrimester]").attr('checked', 'checked');  
  }

  if (allergies ===','){
    $("input[name=allergy][value=0]").attr('checked', 'checked');
  } else{
    $("input[name=allergy][value=1]").attr('checked', 'checked');
    $('#allergydesc').val(allergies);
    $('#allergydesc').show()

  }

  $('.allergy').change(function(){
  // $('#allergydesc').toggle()

  if ($('.allergy').val() == 0){
    console.log('0 '+$('.allergy').val());
    $('#allergydesc').hide()

  }

  else{

    $('#allergydesc').show()
    console.log('otherwise');

  }
});

  $('#adr_form').submit(function(e){
    // console.log('form submitted');
    // console.log($('form').serializeArray());
    var data = $('#adr_form').serializeArray();
    $.ajax({
      type: "POST",
      url: "",
      data: data,
      success: (function(data){
        alert(data);
        window.close();
        window.location ="";

      })
    });


    e.preventDefault();
  });


  $(".adrdate").datepicker();

  $('.drugs').change(function(e){
    var row_id = $(this).parent().parent().attr('rowid');
    console.log(row_id);
  });


// getDoses for all drugs
// getDrugDose(drugid)
// getIndications(drugid) // fetch on selecting a drug

$('#edit-btn').click(function(e){
  $('input,textarea').attr('disabled',false);

  $('input,textarea').css('background-color','#fff');

  $('#submit-container').show();

});
});

</script>


