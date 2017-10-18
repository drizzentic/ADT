<style type="text/css">
/*@media (min-width: 992px)*/
/*.modal-lg {*/
  /*width: 900px;*/
  /*}*/

</style>
<!-- ADR Modal -->
<!-- <div class="modal fade bs-example-modal-lg" id="ADRmodal" tabindex="-1" role="dialog" aria-labelledby="ADRModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="ADRModal">SUSPECTED ADVERSE DRUG REACTION REPORTING FORM</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->


<div class="container" style="background-color: #fffacc;border: solid thick #0000ff;padding: 30px; margin-top: 130px; margin-bottom: 130px;">

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
      <label><span class='astericks'>*</span>NAME OF INSTITUTION: </label>
      <input type="text" name="institution" id="institution" class="validate[required]">
    </div>
    <div class="mid-row">
      <label ><span class='astericks'>*</span>INSTITUTION CODE:</label>
      <input  type="text" name="height" id="institutioncode" class="validate[required]">
    </div>
  </div>

  <div class="max-row">
    <div class="mid-row">
      <label><span class='astericks'>*</span>ADDRESS </label>
      <input type="text" name="weight" id="address" class="validate[required]">
    </div>
    <div class="mid-row">
      <label ><span class='astericks'>*</span>CONTACT</label>
      <input  type="text" name="contact" id="contact" class="validate[required]">
    </div>
  </div>

  <div class="max-row">
    <div class="mid-row">
      <label><span class='astericks'>*</span>PATIENT’S NAME/ INITIAL </label>
      <input type="text" name="patientname" id="patientname" class="validate[required]">
    </div>
    <div class="mid-row">
      <label ><span class='astericks'>*</span>IP/OP. NO</label>
      <input  type="text" name="ip_no" id="ip_no" class="validate[required]">
    </div>

    <div class="mid-row">
      <label ><span class='astericks'>*</span>D.O.B</label>
      <input  type="text" name="dob" id="dob" class="validate[required]">
    </div>

  </div>

  <div class="max-row">
    <div class="mid-row">
      <label><span class='astericks'>*</span>PATIENT’S ADDRESS </label>
      <input type="text" name="patientaddress" id="patientaddress" class="validate[required]">
    </div>
    <div class="mid-row">
      <label ><span class='astericks'>*</span>WARD/CLINIC</label>
      <input  type="text" name="clinic" id="clinic" class="validate[required]">
    </div>

    <div class="mid-row">
      <label id="dcs" >GENDER</label>
      <input  type="radio"  name="male" value="1">
      male
      <input  type="radio"  name="male" value="0">
      female
    </div>

  </div>


  <div class="max-row">

    <div class="mid-row">
      <label id="dcs" >ANY KNOWN  ALLERGY</label>
      <input  type="radio"  name="allergy" id="allergy" value="0">
      no
      <input  type="radio"  name="allergy" id="allergy" value="1">
      yes
    </div>
    if yes, specify
    <input  type="text" name="allergydesc" id="allergydesc" class="validate[required]" style="display: none;">



    <div class="mid-row">
      <label id="dcs" >PREGNANCY STATUS</label>
      <input  type="radio"  name="pregnancystatus" value="Not Pregnant">
      Not Pregnant
      <input  type="radio"  name="pregnancystatus" value="1st Trimester">
      1st Trimester
      <input  type="radio"  name="pregnancystatus" value="2nd Trimester">
      2nd Trimester
      <input  type="radio"  name="pregnancystatus" value="3rd Trimester">
      3rd Trimester
    </div>


    <div class="mid-row">
      <label><span class='astericks'>*</span>WEIGHT (kg): </label>
      <input type="text" name="patientweight" id="patientweight" class="validate[required]">
    </div>
    <div class="mid-row">
      <label ><span class='astericks'>*</span>HEIGHT (cm):</label>
      <input  type="text" name="patientheight" id="patientheight" class="validate[required]">
    </div>
  </div>

  <div class="max-row">
    <div class="mid-row">
      <label><span class='astericks'>*</span>DIAGNOSIS: (What was the patient treated for): </label>
      <textarea name="diagnosis" id="diagnosis" class="">

      </textarea>

    </div>
    <div class="mid-row">
      <label ><span class='astericks'>*</span>BRIEF DESCRIPTION OF REACTION:</label>
      <textarea name="reaction" id="reaction" class="">

      </textarea>
    </div>
  </div>


  <?php
// var_dump($ccc_stores);
  ?>




  <table class="table table-bordered table-hover" id="tab_logic">
    <thead>
      <tr >
        <th class="text-center">
          #
        </th>
        <th>LIST OF  ALL DRUGS </th>
        <th>Dose</th> 
        <th>ROUTE  AND FREQUENCY</th>
        <th>DATE STARTED </th>
        <th>DATE STOPPED </th>
        <th>INDICATION </th>
        <th>TICK SUSPECTED DRUG </th>
      </tr>
    </thead>
    <tbody>
      <tr id='addr1' rowid="1">
        <td>
          1
        </td>
        <td>
          <select name="drug1" id="drug1" class="drugs">
            <option>-- Select Drug --</option>         
            <?php       foreach ($patient_appointment as $key => $app) {?>
            <option><?= $app['drug'];?></option>         
            <?php } ?>
          </select>
        </td>
        <td>
          <input  name="dose1" list="dose1" id="doselist1" class="input-small next_pill dose icondose"> 

        </td>
        <td>
          <input type="text" name='routefreq' id="routefreq1" placeholder='routefreq' class="form-control"/>
        </td>
        <td>
          <input type="text" name='datestarted' id="datestarted1" placeholder='date started' class="form-control adrdate"/>
        </td>
        <td>
          <input type="text" name='datestopped' id="datestopped1" placeholder='date Stopped' class="form-control adrdate"/>
        </td>
        <td>
          <input type="text" name='indication' id="indication1" placeholder='Indication' class="form-control"/>
        </td>
        <td>
          <input type="checkbox" name='drugsuspected1' id="drugsuspected1" class="form-control"/>
        </td>
      </tr>
    </tbody>
  </table>

  <a id="add_row" class="btn btn-default pull-left">Add Row</a><a id='delete_row' class="pull-right btn btn-default">Delete Row</a>
  <br />
  <br />
  <br />

  <div class="max-row">

    <div class="mid-row">
      <label id="dcs" for="severity" >Severity of reaction (refer to scale overleaf)</label>
      <input  type="checkbox" id="severity"  name="severity" value="Mild">
      Mild
      <input  type="checkbox" id="severity"  name="severity" value="Moderate">
      Moderate
      <input  type="checkbox" id="severity"  name="severity" value="Severe">
      Severe
      <input  type="checkbox" id="severity"  name="severity" value="Fatal">
      Fatal
      <input  type="checkbox" id="severity"  name="severity" value="Unknown">
      Unknown
    </div>


    <div class="mid-row">
      <label id="" for="action" >ACTION TAKEN</label>
      <input  type="checkbox"  name="action" id="action" value="Drug withdrawn">
      Drug withdrawn
      <input  type="checkbox"  name="action" id="action" value="Dose increased">
      Dose increased
      <input  type="checkbox"  name="action" id="action" value="Dose reduced">
      Dose reduced
      <input  type="checkbox"  name="action" id="action" value="Dose not changed">
      Dose not changed
      <input  type="checkbox"  name="action" id="action" value="Unknown">
      Unknown
    </div>


    <div class="mid-row">
      <label id="dcs" for="outcome" >OUTCOME</label>
      <input  type="checkbox"  name="outcome" id="outcome" value="Recovering / resolving">
      Recovering / resolving
      <input  type="checkbox"  name="outcome" id="outcome" value="Recovered / resolved">
      Recovered / resolved
      <input  type="checkbox"  name="outcome" id="outcome" value="Requires or prolongs hospitalization">
      Requires or prolongs hospitalization
      <input  type="checkbox"  name="outcome" id="outcome" value="Causes a congenital anomaly">
      Causes a congenital anomaly
      <input  type="checkbox"  name="outcome" id="outcome" value="Requires intervention to prevent permanent damage">
      Requires intervention to prevent permanent damage
      <input  type="checkbox"  name="outcome" id="outcome" value="Unknown">
      Unknown
    </div>


    <div class="mid-row">
      <label id="dcs" for="casuality" >CAUSALITY OF REACTION (refer to scale overleaf)</label>
      <input  type="checkbox"  name="casuality" id="casuality" value="Certain">
      Certain
      <input  type="checkbox"  name="casuality" id="casuality" value="Probable / Likely">
      Probable / Likely
      <input  type="checkbox"  name="casuality" id="casuality" value="Possible">
      Possible
      <input  type="checkbox"  name="casuality" id="casuality" value="Unlikely">
      Unlikely
      <input  type="checkbox"  name="casuality" id="casuality" value="Conditional / Unclassified">
      Conditional / Unclassified
      <input  type="checkbox"  name="casuality" id="casuality" value="Unassessable / Unclassifiable">
      Unassessable / Unclassifiable
    </div>

  </div>
  <div class="max-row">
    <div class="mid-row">
      <label class="blue" for="othercomment">ANY OTHER COMMENT : </label>
      <textarea name="othercomment" class="" id="othercomment"></textarea>

    </div>
  </div>


  <div class="max-row">
    <div class="mid-row">
      <label><span class='astericks'>*</span>NAME OF PERSON REPORTING </label>
      <input type="text" name="officername" id="officername" class="validate[required]">
    </div>
    <div class="mid-row">
      <label ><span class='astericks'>*</span>DATE:</label>
      <input  type="text" name="reportingdate" id="reportingdate" class="validate[required] adrdate">
    </div>


    <div class="mid-row">
      <label><span class='astericks'>*</span>Email ADDRESS </label>
      <input type="text" name="officeremail" id="officeremail" class="validate[required]">
    </div>
    <div class="mid-row">
      <label><span class='astericks'>*</span>Office Phone </label>
      <input type="text" name="officerphone" id="officerphone" class="validate[required]">
    </div>
    <div class="mid-row">
      <label><span class='astericks'>*</span>Designation</label>
      <input type="text" name="officerdesignation" id="officerdesignation" class="validate[required]">
    </div>
    <div class="mid-row">
      <label><span class='astericks'>*</span>Signature </label>
      <input type="text" name="officersignature" id="officersignature" class="validate[required]">
    </div>

    <div class="mid-row">
      <button type="submit" form="adr_form" value="Submit">Submit</button>
      <button>cancel</button>
    </div>

  </div>


</form>
</div>

<script type="text/javascript">

 $(document).ready(function(){
  var i=1;
  $("#add_row").click(function(){
    var drugsoptions = $('#drug1').html();
    var td = "<td>"+i+"</td><td><select name='drug"+i+"' id='drug"+i+"'>"+drugsoptions+" </select></td><td><input  name='dose"+i+"' list='dose"+i+"' id='doselist"+i+"' class='input-small next_pill dose icondose'></td><td><input type='text' name='routefreq"+i+"' id='routefreq"+i+"' placeholder='routefreq' class='form-control'/></td><td><input type='text' name='datestarted"+i+"' id='datestarted"+i+"' placeholder='date started' class='form-control adrdate'/></td><td><input type='text' name='datestopped"+i+"' id='datestopped"+i+"' placeholder='date Stopped' class='form-control adrdate'/></td><td><input type='text' name='indication"+i+"' id='indication"+i+"' placeholder='Indication' class='form-control'/></td><td><input type='checkbox' name='drugsuspected"+i+"' class='form-control'/></td>";


    // $('#doselist'+i);





    var url_dose = "<?php echo base_url() . 'dispensement_management/getDoses'; ?>";
                            //Get doses
                            var request_dose = $.ajax({
                              url: url_dose,
                              type: 'post',
                              dataType: "json"
                            });
                            request_dose.done(function(data) {
                              var url_drug_dose = "<?php echo base_url() . 'dispensement_management/getDrugDose/'; ?>";
                              var new_url_dose = url_drug_dose+selected_drug;
                              
                              var request_one_dose = $.ajax({
                                url: new_url_dose,
                                data: {"weight": weight,"drug_id":drug_id,"age":age},
                                type: 'post',
                                dataType: "json"
                              });
                              request_one_dose.done(function(data_single_dose) {
                                var current_dose = data_single_dose[0].dose;
                                row.closest("tr").find(".dose option").remove();
                                $.each(data, function(key, value) {
                                  row.closest("tr").find(".dose").append("<option value='" + value.Name + "'  data-dose_val='" + value.value + "' data-dose_freq='" + value.frequency + "' >" + value.Name + "</option> ");
                                });
                                row.closest("tr").find(".dose").val(current_dose)

                              });
                            });






                            $(".adrdate").datepicker();

                            $('#tab_logic').append('<tr id="addr'+(i)+' rowid="'+(i)+'">'+td+'</tr>');
                            i++; 
                          });
  $("#delete_row").click(function(){
   if(i>1){
     $("#addr"+(i-1)).html('');
     i--;
   }
 });

  $('#allergy').change(function(){
  // $('#allergydesc').toggle()

  if ($('#allergy').val() == 0){
    console.log('0 '+$('#allergy').val());
    $('#allergydesc').hide()

  }
  else{

    $('#allergydesc').show()
    console.log('otherwise');

  }
});

  $('#adr_form').submit(function(e){
    console.log('form submitted');
    console.log($('form').serializeArray());
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
});

</script>