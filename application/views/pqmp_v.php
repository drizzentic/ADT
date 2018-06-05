<style type="text/css">
    /*@media (min-width: 992px)*/
    /*.modal-lg {*/
    /*width: 900px;*/
    /*}*/
    table{
        width: 100%; border-color: #0697d9;
    }

    td{
        padding: 4px;
    }
    input{
        border: solid thin #fff !important;
        max-width: 150px !important;
    }
</style>
<div class="container" style="background-color: #fde8e7;border: solid thick #0000ff;padding: 30px; margin-top: 130px; margin-bottom: 130px;">
    <a href="<?= base_url(); ?>inventory_management/pqmp" class="btn btn-default" > Back </a>
    <?php if (\is_null($pqmp_data[0]['ppid'])) { ?>
        <a href="javascript:;;" class="btn btn-default" id="edit-btn" > Edit </a>
        <a href="<?= base_url(); ?>inventory_management/pqmp/<?= $record_no; ?>/delete" class="btn btn-danger delete-form" > Delete  </a>
    <?php } else {
        
    } ?>
    <a href="<?= base_url(); ?>inventory_management/pqmp/<?= $record_no; ?>/export" class="btn btn-default" > Export(.xls) </a>
    <div class="container">
        <div class="row">
            <div class="text-center">
                <img src="../../assets/images/top_logo.png">
                <h4 style="color: #2e3092;">
                    MINISTRY OF HEALTH <br />
                    THE PHARMACY AND POISONS BOARD<br />
                    DEPARTMENT OF PHARMACOVIGILANCE<br />
                </h4>
                <h3 style="color:#3b8476;">FORM FOR REPORTING POOR QUALITY MEDICINAL PRODUCTS</h3>
            </div>
        </div>
    </div>
    <form name="pqmp-form" id="pqmp-form" method="POST" action="<?= base_url(); ?>inventory_management/pqmp/<?= $record_no; ?>">
        <table border="1" style="">
            <tr>
                <td colspan="2">Name of Facility : <input type="text" name="facility_name" id="facility_name" class="form-control" value="<?= $pqmp_data[0]['facility_name']; ?>"> </td>
                <td colspan="3">District Name: <input type="text" name="district_name" id="district_name" class="form-control" value="<?= $pqmp_data[0]['district_name'] ?>" ></td>
                <td colspan="3">Province Name: <input type="text" name="province_name" id="province_name" class="form-control" value="<?= $pqmp_data[0]['province_name'] ?>" ></td>
            </tr>
            <tr>
                <td colspan="2">Facility Address: <input type="text" name="facility_address" id="facility_address" class="form-control" value="<?= $pqmp_data[0]['facility_address']; ?>"></td>
                <td colspan="6">Facility Telephone: <input type="text" name="facility_phone" id="facility_phone" class="form-control" value="<?= $pqmp_data[0]['facility_phone']; ?>"></td>
            </tr>
            <tr>
                <td colspan="8" align="center" style="background-color: lightblue;"><h3>PRODUCT IDENTITY</h3></td>
            </tr>
            <tr>
                <td>Brand Name</td>
                <td colspan="3"><input type="text" name="brand_name" id="brand_name" value="<?= $pqmp_data[0]['brand_name']; ?>" class="form-control"> </td>
                <td>Generic Name</td>
                <td colspan="3"><input type="text" name="generic_name" id="generic_name" value="<?= $pqmp_data[0]['generic_name']; ?>" class="form-control"> </td>
            </tr>
            <tr>
                <td>Batch/Lot Number</td>
                <td><input type="text" name="batch_no" id="batch_no" value="<?= $pqmp_data[0]['batch_no']; ?>" class="form-control"></td>
                <td>Date of Manufacture</td>
                <td><input type="text" name="manufacture_date" value="<?= $pqmp_data[0]['manufacture_date']; ?>" id="manufacture_date" class=""></td>
                <td>Date of Expiry</td>
                <td><input type="text" name="expiry_date" value="<?= $pqmp_data[0]['expiry_date']; ?>" id="expiry_date" class=""></td>
                <td>Date of Receipt</td>
                <td><input type="text" name="receipt_date" value="<?= $pqmp_data[0]['receipt_date']; ?>" id="receipt_date" class=""></td>
            </tr>
            <tr>
                <td>Name of Manufacturer</td>
                <td colspan="3"><input type="text" name="manufacturer_name" value="<?= $pqmp_data[0]['manufacturer_name']; ?>" id="manufacturer_name" class="form-control"> </td>
                <td>Country of Origin</td>
                <td colspan="3"><input type="text" name="origin_county" value="<?= $pqmp_data[0]['origin_county']; ?>" id="origin_county" class="form-control"> </td>
            </tr>
            <tr>
                <td>Name of Distributor/Supplier</td>
                <td colspan="2"><input type="text" name="supplier_name" value="<?= $pqmp_data[0]['supplier_name']; ?>" id="supplier_name" class="form-control"> </td>
                <td>Distributor/Supplier's Address</td>
                <td colspan="4"><input type="text" name="supplier_address" value="<?= $pqmp_data[0]['supplier_address']; ?>" id="supplier_address" class="form-control"> </td>
            </tr>
            <tr>
                <td colspan="4" align="center" style="background-color:lightblue;"><h4>PRODUCT FORMULATION (Tick appropriate box)</h4></td>
                <td colspan="4" align="center" style="background-color: lightblue;"><h4>COMPLAINT (Tick appropriate box)</h4></td>
            </tr>
            <tr>
                <td colspan="4" align="">
                    <input type="checkbox" name="formulation_oral" value="oral"> Oral Tablets/Capsules <br />
                    <input type="checkbox" name="formulation_injection" value="injection"> Injection <br />
                    <input type="checkbox" name="formulation_diluent" value="diluent"> Diluent <br />
                    <input type="checkbox" name="formulation_powdersuspension" value="powdersuspension"> Powder for Reconstitution of suspension <br />
                    <input type="checkbox" name="formulation_powderinjection" value="powderinjection"> Powder for Reconstitution of injection <br />
                    <input type="checkbox" name="formulation_eyedrops" value="eyedrops"> Eye drops <br />
                    <input type="checkbox" name="formulation_eardrops" value="eardrops"> Ear drops <br />
                    <input type="checkbox" name="formulation_nebuliser" value="nebuliser"> Nebuliser solution <br />
                    <input type="checkbox" name="formulation_cream" value="cream"> Cream/ Ointment/Liniment/ Paste <br />
                    <input type="checkbox" name="other_formulation" value="other"> Other
                    <input type="text" name="formulation_other" id="formulation_other" value="<?= $pqmp_data[0]['formulation_other'] ?>">

                </td>
                <td colspan="4" align="">
                    <input type="checkbox" name="complaint_colour" value="colour">Colour Change <br />
                    <input type="checkbox" name="complaint_separating" value="separating">Separating <br />       
                    <input type="checkbox" name="complaint_powdering" value="powdering">Powdering/crumbling<br />
                    <input type="checkbox" name="complaint_caking" value="caking">Caking <br />
                    <input type="checkbox" name="complaint_moulding" value="moulding">Moulding <br />
                    <input type="checkbox" name="complaint_change" value="change">Change of oduor <br />
                    <input type="checkbox" name="complaint_mislabeilng" value="mislabeilng">Mislabeilng <br />
                    <input type="checkbox" name="complaint_incomplete" value="incomplete">Incomplete pack <br />
                    <input type="checkbox" name="other_complaint" value="other">Other
                    <input type="text" name="complaint_other" id="complaint_other" value="<?= $pqmp_data[0]['complaint_other'] ?>">


                </td>
            </tr>
            <tr>
                <td colspan="8">Describe in detail
                    <textarea name="description" id="description" style="width: 100%;"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="3">Does the product require refrigiration?</td>
                <td><input type="radio" name="product_refrigiration" class="product_refrigiration" value="Yes">Yes</td>
                <td><input type="radio" name="product_refrigiration" class="product_refrigiration" value="No">No</td>
                <td colspan="3" rowspan="4"></td>
            </tr>
            <tr>
                <td colspan="3">Was product available at facility?</td>
                <td><input type="radio" name="product_availability" class="product_availability" value="Yes">Yes</td>
                <td><input type="radio" name="product_availability" class="product_availability" value="No">No</td>
            </tr>
            <tr>
                <td colspan="3">Was dispensed and returned by client?</td>
                <td><input type="radio" name="product_returned" class="product_returned" value="Yes">Yes</td>
                <td><input type="radio" name="product_returned" class="product_returned" value="No">No</td>
            </tr>
            <tr>
                <td colspan="3">Was product stored according to manufacturer/MOH recommendations?</td>
                <td><input type="radio" name="product_storage" class="product_storage" value="Yes">Yes</td>
                <td><input type="radio" name="product_storage" class="product_storage" value="No">No</td>
            </tr>
            <tr>
                <td colspan="8">Comments (if any)
                    <textarea style="width: 100%;" id="comments" name="comments"> <?= $pqmp_data[0]['comments'] ?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="4">Name of reporter : <input type="text" name="reporter_name" id="reporter_name" value="<?= $pqmp_data[0]['reporter_name'] ?>" class="form-control"> </td>
                <td colspan="4">Contact Number : <input type="text" name="reporter_phone" id="reporter_phone" value="<?= $pqmp_data[0]['reporter_phone'] ?>" class="form-control"> </td>
            </tr>
            <tr>
                <td colspan="4">Cadre Job Title : <input type="text" name="reporter_title" id="reporter_title" value="<?= $pqmp_data[0]['reporter_title'] ?>" class="form-control"> </td>
                <td colspan="4">Signature : <input type="text" name="reporter_signature" id="reporter_signature" value="<?= $pqmp_data[0]['reporter_signature'] ?>" class="form-control"> </td>
            </tr>
            <tr>
                <td colspan="8" align="center" style="background-color: lightblue;"><h5>Once completed one copy of this form should be emailed or posted to:</h5></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="8" align="center" style="background-color: lightblue;"><span style="color: red;">Your support in this PHARMACOVIGILANCE program is appreciated </span><br /></td>
            </tr>

        </table>
        <div class="mid-row" id="submit-container" style="display: none;">
            <button type="submit" form="adr_form" value="Submit">Submit</button>
            <button>cancel</button>
        </div>
    </form>
</div>
<script type="text/javascript">

    $(document).ready(function () {


        $("#manufacture_date,#expiry_date,#receipt_date").datepicker();

        $("input[name=formulation_oral][value=<?= $pqmp_data[0]['formulation_oral'] ?>]").attr('checked', 'checked');
        $("input[name=formulation_injection][value=<?= $pqmp_data[0]['formulation_injection'] ?>]").attr('checked', 'checked');
        $("input[name=formulation_diluent][value=<?= $pqmp_data[0]['formulation_diluent'] ?>]").attr('checked', 'checked');
        $("input[name=formulation_powdersuspension][value=<?= $pqmp_data[0]['formulation_powdersuspension'] ?>]").attr('checked', 'checked');
        $("input[name=formulation_powderinjection][value=<?= $pqmp_data[0]['formulation_powderinjection'] ?>]").attr('checked', 'checked');
        $("input[name=formulation_eyedrops][value=<?= $pqmp_data[0]['formulation_eyedrops'] ?>]").attr('checked', 'checked');
        $("input[name=formulation_eardrops][value=<?= $pqmp_data[0]['formulation_eardrops'] ?>]").attr('checked', 'checked');

        $("input[name=formulation_nebuliser][value=<?= $pqmp_data[0]['formulation_nebuliser'] ?>]").attr('checked', 'checked');
        $("input[name=formulation_cream][value=<?= $pqmp_data[0]['formulation_cream'] ?>]").attr('checked', 'checked');
        $("input[name=other_formulation][value=<?= $pqmp_data[0]['other_formulation'] ?>]").attr('checked', 'checked');
        $("input[name=complaint_colour][value=<?= $pqmp_data[0]['complaint_colour'] ?>]").attr('checked', 'checked');
        $("input[name=complaint_separating][value=<?= $pqmp_data[0]['complaint_separating'] ?>]").attr('checked', 'checked');
        $("input[name=complaint_powdering][value=<?= $pqmp_data[0]['complaint_powdering'] ?>]").attr('checked', 'checked');
        $("input[name=complaint_caking][value=<?= $pqmp_data[0]['complaint_caking'] ?>]").attr('checked', 'checked');
        $("input[name=complaint_moulding][value=<?= $pqmp_data[0]['complaint_moulding'] ?>]").attr('checked', 'checked');

        $("input[name=complaint_change][value=<?= $pqmp_data[0]['complaint_change'] ?>]").attr('checked', 'checked');
        $("input[name=complaint_mislabeilng][value=<?= $pqmp_data[0]['complaint_mislabeilng'] ?>]").attr('checked', 'checked');
        $("input[name=complaint_incomplete][value=<?= $pqmp_data[0]['complaint_incomplete'] ?>]").attr('checked', 'checked');
        $("input[name=other_complaint][value=<?= $pqmp_data[0]['other_complaint'] ?>]").attr('checked', 'checked');

        $("input[name=product_refrigiration][value=<?= $pqmp_data[0]['product_refrigiration'] ?>]").attr('checked', 'checked');
        $("input[name=product_refrigiration][value=<?= $pqmp_data[0]['product_refrigiration'] ?>]").attr('checked', 'checked');
        $("input[name=product_availability][value=<?= $pqmp_data[0]['product_availability'] ?>]").attr('checked', 'checked');
        $("input[name=product_availability][value=<?= $pqmp_data[0]['product_availability'] ?>]").attr('checked', 'checked');
        $("input[name=product_returned][value=<?= $pqmp_data[0]['product_returned'] ?>]").attr('checked', 'checked');
        $("input[name=product_returned][value=<?= $pqmp_data[0]['product_returned'] ?>]").attr('checked', 'checked');
        $("input[name=product_storage][value=<?= $pqmp_data[0]['product_storage'] ?>]").attr('checked', 'checked');

        $('input,textarea').attr('disabled', true);

        $('#edit-btn').click(function (e) {
            $('input,textarea').attr('disabled', false);

            $('input,textarea').css('background-color', '#fff');

            $('#submit-container').show();

        })



        $('.delete-form').click(function (e) {
            var answer = confirm('Deleting ADR. Are You Sure?');
            if (answer) {

            } else {
                e.preventDefault();
            }
        });


    });

</script>