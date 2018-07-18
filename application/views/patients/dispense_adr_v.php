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

<div class="container" style="background-color: #fffacc;border: solid thick #2b597e;padding: 30px; margin-top: 130px; margin-bottom: 130px; border-radius:20px;">

    <form name="adr_form" id="adr_form" method="post" action="<?= base_url();?>dispensement_management/adr/<?= $patient_id ?>">
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
                <label><span class='astericks'>*</span>REPORT TITLE </label>
                <input type="text" name="report_title" id="report_title" value="<?= str_replace('%20', ' ',$this->uri->segment(4));?>">
            </div>
              <div class="mid-row">
                <label ><span class='astericks'>*</span>UNIQUE ID:</label>
                <input  type="text" name="uniqueid"  value="<?= $uniqueid; ?>" readonly class="">
            </div>

        </div>
        <div class="max-row">
            <div class="mid-row">
                <label><span class='astericks'>*</span>NAME OF INSTITUTION: </label>
                <input type="text" name="institution" id="institution" value="<?= $facility_details['name']; ?>" class="validate[required] f-input">
            </div>
            <div class="mid-row">
                <label ><span class='astericks'>*</span>INSTITUTION CODE:</label>
                <input  type="text" name="institutioncode" id="institutioncode" value="<?= $facility_details['facilitycode']; ?>" class="validate[required] f-input">
            </div>


        </div>

        <div class="max-row">
            <div class="mid-row">
                <label><span class='astericks'>*</span>ADDRESS </label>
                <input type="text" name="address" id="address" value="<?= $facility_details['facilitycode']; ?>" class="validate[required] f-input">
            </div>
            <div class="mid-row">
                <label ><span class='astericks'>*</span>CONTACT</label>
                <input  type="text" name="contact" id="contact" value="<?= $facility_details['phone']; ?>" class="validate[required] f-input">
            </div>

        </div>

        <div class="max-row">
            <div class="mid-row">

                <label ><span class='astericks'>*</span>COUNTY:</label>
                <select class="fil" class="fil" name="county_id"  id="county_id">
                    <option value=""></option>
                    <option value="30">Baringo</option>
                    <option value="36">Bomet</option>
                    <option value="39">Bung'oma</option>
                    <option value="40">Busia</option>
                    <option value="28">Elgeyo/Marakwet</option>
                    <option value="14">Embu</option>
                    <option value="7">Garissa</option>
                    <option value="43">Homa Bay</option>
                    <option value="11">Isiolo</option>
                    <option value="34">Kajiado</option>
                    <option value="37">Kakamega</option>
                    <option value="35">Kericho</option>
                    <option value="22">Kiambu</option>
                    <option value="3">Kilifi</option>
                    <option value="20">Kirinyaga</option>
                    <option value="45">Kisii</option>
                    <option value="42">Kisumu</option>
                    <option value="15">Kitui</option>
                    <option value="2">Kwale</option>
                    <option value="31">Laikipia</option>
                    <option value="5">Lamu</option>
                    <option value="16">Machakos</option>
                    <option value="17">Makueni</option>
                    <option value="9">Mandera</option>
                    <option value="10">Marsabit</option>
                    <option value="12">Meru</option>
                    <option value="44">Migori</option>
                    <option value="1">Mombasa</option>
                    <option value="21">Murang'a</option>
                    <option value="47" selected="selected">Nairobi </option>
                    <option value="32">Nakuru</option>
                    <option value="29">Nandi</option>
                    <option value="33">Narok</option>
                    <option value="46">Nyamira</option>
                    <option value="18">Nyandarua</option>
                    <option value="19">Nyeri</option>
                    <option value="25">Samburu</option>
                    <option value="41">Siaya</option>
                    <option value="6">Taita Taveta</option>
                    <option value="4">Tana River</option>
                    <option value="13">Tharaka Nithi</option>
                    <option value="26">Trans Nzoia</option>
                    <option value="23">Turkana</option>
                    <option value="27">Uasin Gishu</option>
                    <option value="38">Vihiga</option>
                    <option value="8">Wajir</option>
                    <option value="24">West Pokot</option>
                </select>

            </div>
            <div class="mid-row">

                <label ><span class='astericks'>*</span>SUB-COUNTY</label>
                <select class="fil" name="sub_county_id" id="sub_county_id"  class="" id="SadrSubCountyId">
                    <option value=""></option>
                    <option value="143">AINABKOI</option>
                    <option value="189">AINAMOI</option>
                    <option value="151">ALDAI</option>
                    <option value="233">ALEGO USONGA</option>
                    <option value="253">AWENDO</option>
                    <option value="173">BAHATI</option>
                    <option value="28">BALAMBALA</option>
                    <option value="40">BANISSA</option>
                    <option value="158">BARINGO CENTRAL</option>
                    <option value="157">BARINGO NORTH</option>
                    <option value="159">BARINGO SOUTH</option>
                    <option value="191">BELGUT</option>
                    <option value="263">BOBASI</option>
                    <option value="262">BOMACHOGE BORABU</option>
                    <option value="264">BOMACHOGE CHACHE</option>
                    <option value="196">BOMET CENTRAL</option>
                    <option value="195">BOMET EAST</option>
                    <option value="260">BONCHARI</option>
                    <option value="235">BONDO</option>
                    <option value="272">BORABU</option>
                    <option value="230">BUDALANGI</option>
                    <option value="218">BUMULA</option>
                    <option value="20">BURA</option>
                    <option value="190">BURETI</option>
                    <option value="206">BUTERE</option>
                    <option value="228">BUTULA</option>
                    <option value="57">BUURI</option>
                    <option value="58">CENTRAL IMENTI</option>
                    <option value="1">CHANGAMWE</option>
                    <option value="194">CHEPALUNGU</option>
                    <option value="139">CHERANGANY</option>
                    <option value="153">CHESUMEI</option>
                    <option value="290">CHUKA/IGAMBANG'OMBE</option>
                    <option value="30">DADAAB</option>
                    <option value="274">DAGORETTI NORTH</option>
                    <option value="275">DAGORETTI SOUTH</option>
                    <option value="161">ELDAMA RAVINE</option>
                    <option value="37">ELDAS</option>
                    <option value="283">EMBAKASI CENTRAL</option>
                    <option value="284">EMBAKASI EAST</option>
                    <option value="282">EMBAKASI NORTH</option>
                    <option value="281">EMBAKASI SOUTH</option>
                    <option value="285">EMBAKASI WEST</option>
                    <option value="154">EMGWEN</option>
                    <option value="214">EMUHAYA</option>
                    <option value="177">EMURUA DIKIRR</option>
                    <option value="136">ENDEBESS</option>
                    <option value="31">FAFI</option>
                    <option value="229">FUNYULA</option>
                    <option value="19">GALOLE</option>
                    <option value="15">GANZE</option>
                    <option value="27">GARISSA TOWNSHIP</option>
                    <option value="18">GARSEN</option>
                    <option value="109">GATANGA</option>
                    <option value="111">GATUNDU NORTH</option>
                    <option value="110">GATUNDU SOUTH</option>
                    <option value="234">GEM</option>
                    <option value="100">GICHUGU</option>
                    <option value="168">GILGIL</option>
                    <option value="115">GITHUNGURI</option>
                    <option value="212">HAMISI</option>
                    <option value="248">HOMA BAY TOWN</option>
                    <option value="52">IGEMBE CENTRAL</option>
                    <option value="53">IGEMBE NORTH</option>
                    <option value="51">IGEMBE SOUTH</option>
                    <option value="32">IJARA</option>
                    <option value="209">IKOLOMANI</option>
                    <option value="49">ISIOLO NORTH</option>
                    <option value="50">ISIOLO SOUTH</option>
                    <option value="2">JOMVU</option>
                    <option value="112">JUJA</option>
                    <option value="118">KABETE</option>
                    <option value="245">KABONDO KASIPUL</option>
                    <option value="217">KABUCHAI</option>
                    <option value="130">KACHELIBA</option>
                    <option value="84">KAITI</option>
                    <option value="183">KAJIADO CENTRAL</option>
                    <option value="184">KAJIADO EAST</option>
                    <option value="182">KAJIADO NORTH</option>
                    <option value="186">KAJIADO SOUTH</option>
                    <option value="185">KAJIADO WEST</option>
                    <option value="13">KALOLENI</option>
                    <option value="287">KAMUKUNJI</option>
                    <option value="108">KANDARA</option>
                    <option value="219">KANDUYI</option>
                    <option value="103">KANGEMA</option>
                    <option value="76">KANGUNDO</option>
                    <option value="128">KAPENGURIA</option>
                    <option value="144">KAPSERET</option>
                    <option value="246">KARACHUONYO</option>
                    <option value="279">KASARANI</option>
                    <option value="244">KASIPUL</option>
                    <option value="78">KATHIANI</option>
                    <option value="148">KEIYO NORTH</option>
                    <option value="149">KEIYO SOUTH</option>
                    <option value="145">KESSES</option>
                    <option value="207">KHWISERO</option>
                    <option value="117">KIAMBAA</option>
                    <option value="116">KIAMBU</option>
                    <option value="277">KIBRA</option>
                    <option value="87">KIBWEZI EAST</option>
                    <option value="86">KIBWEZI WEST</option>
                    <option value="94">KIENI</option>
                    <option value="106">KIGUMO</option>
                    <option value="105">KIHARU</option>
                    <option value="119">KIKUYU</option>
                    <option value="176">KILGORIS</option>
                    <option value="11">KILIFI NORTH</option>
                    <option value="12">KILIFI SOUTH</option>
                    <option value="83">KILOME</option>
                    <option value="222">KIMILILI</option>
                    <option value="138">KIMININI</option>
                    <option value="10">KINAGO</option>
                    <option value="88">KINANGOP</option>
                    <option value="89">KIPIPIRI</option>
                    <option value="187">KIPKELION EAST</option>
                    <option value="188">KIPKELION WEST</option>
                    <option value="102">KIRINYAGA CENTRAL</option>
                    <option value="3">KISAUNI</option>
                    <option value="239">KISUMU CENTRAL</option>
                    <option value="237">KISUMU EAST</option>
                    <option value="238">KISUMU WEST</option>
                    <option value="71">KITUI CENTRAL</option>
                    <option value="72">KITUI EAST</option>
                    <option value="70">KITUI RURAL</option>
                    <option value="73">KITUI SOUTH</option>
                    <option value="69">KITUI WEST</option>
                    <option value="267">KITUTU CHACHE NORTH</option>
                    <option value="268">KITUTU CHACHE SOUTH</option>
                    <option value="269">KITUTU MASABA</option>
                    <option value="197">KONOIN</option>
                    <option value="170">KURESOI NORTH</option>
                    <option value="169">KURESOI SOUTH</option>
                    <option value="259">KURIA EAST</option>
                    <option value="258">KURIA WEST</option>
                    <option value="135">KWANZA</option>
                    <option value="44">LAFEY</option>
                    <option value="29">LAGDERA</option>
                    <option value="163">LAIKIPIA EAST</option>
                    <option value="164">LAIKIPIA NORTH</option>
                    <option value="162">LAIKIPIA WEST</option>
                    <option value="48">LAISAMIS</option>
                    <option value="21">LAMU EAST</option>
                    <option value="22">LAMU WEST</option>
                    <option value="276" >LANGATA</option>
                    <option value="121">LARI</option>
                    <option value="5">LIKONI</option>
                    <option value="199">LIKUYANI</option>
                    <option value="120">LIMURU</option>
                    <option value="125">LOIMA</option>
                    <option value="213">LUANDA</option>
                    <option value="198">LUGARI</option>
                    <option value="8">LUNGA LUNGA</option>
                    <option value="201">LURAMBI</option>
                    <option value="60">MAARA</option>
                    <option value="80">MACHAKOS TOWN</option>
                    <option value="17">MAGARINI</option>
                    <option value="286">MAKADARA</option>
                    <option value="85">MAKUENI</option>
                    <option value="200">MALAVA</option>
                    <option value="16">MALINDI</option>
                    <option value="43">MANDERA EAST</option>
                    <option value="41">MANDERA NORTH</option>
                    <option value="42">MANDERA SOUTH</option>
                    <option value="39">MANDERA WEST</option>
                    <option value="62">MANYATTA</option>
                    <option value="107">MARAGWA</option>
                    <option value="146">MARAKWET EAST</option>
                    <option value="147">MARAKWET WEST</option>
                    <option value="74">MASINGA</option>
                    <option value="227">MATAYOS</option>
                    <option value="289">MATHARE</option>
                    <option value="104">MATHIOYA</option>
                    <option value="95">MATHIRA</option>
                    <option value="9">MATUGA</option>
                    <option value="205">MATUNGU</option>
                    <option value="77">MATUNGULU</option>
                    <option value="79">MAVOKO</option>
                    <option value="65">MBEERE NORTH</option>
                    <option value="64">MBEERE SOUTH</option>
                    <option value="82">MBOONI</option>
                    <option value="160">MOGOTIO</option>
                    <option value="142">MOIBEN</option>
                    <option value="165">MOLO</option>
                    <option value="155">MOSOP</option>
                    <option value="45">MOYALE</option>
                    <option value="7">MSAMBWENI</option>
                    <option value="215">MT. ELGON</option>
                    <option value="242">MUHORONI</option>
                    <option value="97">MUKURWENI</option>
                    <option value="204">MUMIAS EAST</option>
                    <option value="203">MUMIAS WEST</option>
                    <option value="6">MVITA</option>
                    <option value="81">MWALA</option>
                    <option value="25">MWATATE</option>
                    <option value="99">MWEA</option>
                    <option value="68">MWINGI CENTRAL</option>
                    <option value="66">MWINGI NORTH</option>
                    <option value="67">MWINGI WEST</option>
                    <option value="167">NAIVASHA</option>
                    <option value="175">NAKURU TOWN EAST</option>
                    <option value="174">NAKURU TOWN WEST</option>
                    <option value="226">NAMBALE</option>
                    <option value="152">NANDI HILLS</option>
                    <option value="179">NAROK EAST</option>
                    <option value="178">NAROK NORTH</option>
                    <option value="180">NAROK SOUTH</option>
                    <option value="181">NAROK WEST</option>
                    <option value="202">NAVAKHOLO</option>
                    <option value="92">NDARAGWA</option>
                    <option value="249">NDHIWA</option>
                    <option value="101">NDIA</option>
                    <option value="166">NJORO</option>
                    <option value="46">NORTH HORR</option>
                    <option value="56">NORTH IMENTI</option>
                    <option value="271">NORTH MUGIRANGO</option>
                    <option value="243">NYAKACH</option>
                    <option value="4">NYALI</option>
                    <option value="241">NYANDO</option>
                    <option value="266">NYARIBARI CHACHE</option>
                    <option value="265">NYARIBARI MASABA</option>
                    <option value="257">NYATIKE</option>
                    <option value="98">NYERI TOWN</option>
                    <option value="91">OL JORO OROK</option>
                    <option value="90">OL KALOU</option>
                    <option value="96">OTHAYA</option>
                    <option value="131">POKOT SOUTH</option>
                    <option value="14">RABAI</option>
                    <option value="247">RANGWE</option>
                    <option value="236">RARIEDA</option>
                    <option value="172">RONGAI</option>
                    <option value="252">RONGO</option>
                    <option value="278">ROYSAMBU</option>
                    <option value="280">RUARAKA</option>
                    <option value="114">RUIRU</option>
                    <option value="63">RUNYENJES</option>
                    <option value="211">SABATIA</option>
                    <option value="137">SABOTI</option>
                    <option value="47">SAKU</option>
                    <option value="134">SAMBURU EAST</option>
                    <option value="133">SAMBURU NORTH</option>
                    <option value="132">SAMBURU WEST</option>
                    <option value="240">SEME</option>
                    <option value="208">SHINYALU</option>
                    <option value="129">SIGOR</option>
                    <option value="192">SIGOWET/SOIN</option>
                    <option value="216">SIRISIA</option>
                    <option value="193">SOTIK</option>
                    <option value="59">SOUTH IMENTI</option>
                    <option value="261">SOUTH MUGIRANGO</option>
                    <option value="140">SOY</option>
                    <option value="288">STAREHE</option>
                    <option value="250">SUBA NORTH</option>
                    <option value="251">SUBA SOUTH</option>
                    <option value="171">SUBUKIA</option>
                    <option value="254">SUNA EAST</option>
                    <option value="255">SUNA WEST</option>
                    <option value="35">TARBAJ</option>
                    <option value="23">TAVETA</option>
                    <option value="224">TESO NORTH</option>
                    <option value="225">TESO SOUTH</option>
                    <option value="93">TETU</option>
                    <option value="61">THARAKA</option>
                    <option value="113">THIKA TOWN</option>
                    <option value="156">TIATY</option>
                    <option value="55">TIGANIA EAST</option>
                    <option value="54">TIGANIA WEST</option>
                    <option value="150">TINDERET</option>
                    <option value="223">TONGAREN</option>
                    <option value="141">TURBO</option>
                    <option value="124">TURKANA CENTRAL</option>
                    <option value="127">TURKANA EAST</option>
                    <option value="122">TURKANA NORTH</option>
                    <option value="126">TURKANA SOUTH</option>
                    <option value="123">TURKANA WEST</option>
                    <option value="231">UGENYA</option>
                    <option value="232">UGUNJA</option>
                    <option value="256">URIRI</option>
                    <option value="210">VIHIGA</option>
                    <option value="26">VOI</option>
                    <option value="34">WAJIR EAST</option>
                    <option value="33">WAJIR NORTH</option>
                    <option value="38">WAJIR SOUTH</option>
                    <option value="36">WAJIR WEST</option>
                    <option value="220">WEBUYE EAST</option>
                    <option value="221">WEBUYE WEST</option>
                    <option value="270">WEST MUGIRANGO</option>
                    <option value="273" selected="selected">WESTLANDS</option>
                    <option value="24">WUNDANYI</option>
                    <option value="75">YATTA</option>
                </select>

            </div>

            <div class="mid-row">
            </div>

        </div>

        <div class="max-row">

            <table border="0" style="width: 100%;">
                <tr>
                    <td> <label><span class='astericks'>*</span>PATIENT’S NAME/ INITIALS </label>
                        <?php
                        $patient = $patient_details['first_name'] . ' ' . $patient_details['last_name'];
                        $expl = explode(' ',$patient);
                        $new_patient = '';
                        foreach ($expl as $e){
                            $new_patient .= $e[0].'.';
                        }
                        ?>
                        <input type="text" name="patientname" id="patientname" value="<?= rtrim($new_patient,'.'); ?>" class="validate[required] f-input">
                    </td>
                    <td> <label ><span class='astericks'>*</span>IP/OP. NO</label>
                        <input  type="text" name="ip_no" id="ip_no" value="<?= $patient_details['ccc_number'] ?>" class="validate[required] f-input">
                    </td>
                    <td> <label ><span class='astericks'>*</span>D.O.B</label>
                        <input  type="text" name="dob" id="dob" value="<?= $patient_details['date_of_birth'] ?>" class="validate[required] f-input">
                    </td>
                </tr>
                <tr>
                    <td>  <label><span class='astericks'>*</span>PATIENT’S ADDRESS </label>
                        <input type="text" name="patientaddress" id="patientaddress"  value="<?= $patient_details['physical_address'] ?>" class="validate[required] f-input"></td>
                    <td> <label ><span class='astericks'>*</span>WARD/CLINIC</label>
                        <input  type="text" name="clinic" id="clinic"  value="CCC" class="validate[required] f-input">
                    </td>
                    <td>
                        <label id="dcs" >GENDER</label>
                        <input  type="radio"  name="gender" id="gender" value="MALE">
                        male 
                        <input  type="radio"  name="gender" id="gender" value="FEMALE">
                        female

                    </td> 
                </tr>
                <tr>
                    <td rowspan="2">
                        <label id="dcs" >ANY KNOWN  ALLERGY</label>
                        <input  type="radio"  name="allergy" id="allergy" value="0">
                        no<br />
                        <input  type="radio"  name="allergy" id="allergy" value="1">
                        yes<br />
                        if yes, specify
                        <input  type="text" name="allergydesc" id="allergydesc" class="validate[required] f-input" style="display: block;">
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
                        <input type="text" name="patientweight" id="patientweight" value="<?= $patient_details['current_weight'] ?>" class="validate[required] f-input">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label ><span class='astericks'>*</span>HEIGHT (cm):</label>
                        <input  type="text" name="patientheight" id="patientheight" value="<?= $patient_details['current_height'] ?>" class="validate[required] f-input">
                    </td>

                </tr>
                <tr>
                    <td colspan="3">
                        <label><span class='astericks'>*</span>DIAGNOSIS: (What was the patient treated for): </label>
                        <select class="fil" name='diagnosis' id='diagnosis' style="width:150px;">
                            <option value="">-Select-</option>
                            <?php foreach($diagnosis as $d){;?>
                            <option value="<?= str_replace(['Anti','Family Planning medicine','Essential drug'],'',$d->name);?>"><?= str_replace(['Anti','Family Planning medicine','Essential drug'],'',$d->name);?></option>
                            <?php };?>
                        </select>
                        <!--textarea name="diagnosis" id="diagnosis" class="" ><?= $patient_details['current_regimen'] ?></textarea-->
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <label ><span class='astericks'>*</span>BRIEF DESCRIPTION OF REACTION (<?= str_replace('%20', ' ',$this->uri->segment(4));?>):</label>
                        <textarea name="reaction" id="reaction" class=""></textarea>         
                    </td>
                </tr>
            </table>
        </div>

        <table class="table table-bordered table-hover" id="tab_logic">
            <thead>
                <tr>
                    <th colspan="2" style="width: 25%;" class="required tooltipper"
                        title="This is the generic name"
                        data-content="">
                        <label class="help-block required">	(include OTC and herbals)  </label>
                        <span class="label label-info">Generic Name</span>
                    </th>
                    <th style="width: 7%;">BRAND NAME</th>
                    <th colspan="2" style="width: 13%;" class="required tooltipper"
                        title="Dosage"
                        data-content="">
                        <label class="required">DOSE <span style="color:red;">*</span></label>
                        <label class="help-block required">	 </label>
                    </th>
                    <th colspan="2" style="width: 23%;" class="required "
                        title=""
                        data-content="">
                        <label class="required">ROUTE AND FREQUENCY <span style="color:red;">*</span></label>
                        <label class="help-block required">	 </label>
                    </th>
                    <th style="width: 10%;" class="required "
                        title=""
                        data-content="">
                        <label class="required">DATE STARTED <span style="color:red;">*</span></label>
                        <label class="help-block required">	(dd-mm-yyyy) </label>
                    </th>
                    <th style="width: 10%;">DATE STOPPED<p class="help-block">	(dd-mm-yyyy) </p></th>
                    <th style="width: 7%;" >
                        <label>INDICATION </span></label>
                    </th>
                    <th colspan="2" style="width: 10%;" class="required tooltipper"
                        title="Drug suspected to cause reaction"
                        data-content="At least one option must be selected<br>">
                        <label class="required">TICK (&#x2713;)  <br/> SUSPECTED DRUG(S) <span style="color:red;">*</span></label>
                        <label class="help-block required">(select at least one) </label>
                        <input type="hidden" name="list" class="" value="" id="SadrList"/>					</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($patient_visits as $key => $pv) {

                    $ds = date('Y-m-d', strtotime($pv['dispensing_date']) + ($pv['duration'] * 60 * 60 * 24));
                    ?>
                    <tr>
                        <td> <?= $i; ?></td>
                        <td title="Generic Name *"><div class="control-group required"><input name="drug_name[]" maxlength="100" value="<?= $pv['drug'] ?>" type="text" style="width:130px !important;" /></div></td>
                        <td title="Brand Name">
                            <div class="control-group"><input name="brand_name[]" maxlength="100" style="width:50px !important;" type="text"/></div></td>
                        <td  title="Dose *">
                            <?php 
                            $pre_dose = $pv['dose'];
                            $splitter = explode(' ',$pre_dose);
                            $_dose = $splitter[0];
                            $frequency = $splitter[1];
                            ?>
                            <div class="control-group required"><input name="dose[]" maxlength="100" value="<?= $_dose ?>"  style="width:40px !important;" type="text" /></div></div></td>
                        <td>
                            <div class="control-group required">
                                <select class="fil" name="dose_id[]"  style="width:100px !important;">
                                    <option value=""></option>
                                    <option value="2">mg</option>
                                    <option value="3">ml</option>
                                    <option value="4">µg</option>
                                    <option value="5">g</option>
                                    <option value="6">Iu</option>
                                    <option value="7">DF dosage form</option>
                                    <option value="8">Gtt drop(s)</option>
                                    <option value="9">mmol</option>
                                    <option value="10">meq</option>
                                    <option value="11">%</option>
                                    <option value="12">µCi</option>
                                    <option value="13">µg/kg</option>
                                    <option value="14">µg/m2</option>
                                    <option value="15">µl</option>
                                    <option value="16">µmol</option>
                                    <option value="17">Bq</option>
                                    <option value="18">Ci curie(s)</option>
                                    <option value="19">GBq</option>
                                    <option value="20">iu/kg</option>
                                    <option value="21">Kbq</option>
                                    <option value="22">kg</option>
                                    <option value="23">Kiu</option>
                                    <option value="24">l</option>
                                    <option value="25">MBq</option>
                                    <option value="26">mCi</option>
                                    <option value="27">mg/kg</option>
                                    <option value="28">mg/m2</option>
                                    <option value="29">Miu</option>
                                    <option value="30">Mol</option>
                                    <option value="31">nCi</option>
                                    <option value="32">ng</option>
                                    <option value="33">pg</option>
                                </select></div>	</td>
                        <td title="Route *"><div class="control-group required">
                                <select class="fil" name="route_id[]" style="width:150px !important;" >
                                    
                                    <option value=""></option>
                                    <option value="2">oral</option>
                                    <option value="3">intravenous drip</option>
                                    <option value="4">intravenous bolus</option>
                                    <option value="5">subcutaneous</option>
                                    <option value="6">nasal</option>
                                    <option value="7">sublingual</option>
                                    <option value="8">topical</option>
                                    <option value="9">rectal</option>
                                    <option value="10">intra-articular</option>
                                    <option value="11">intrathecal</option>
                                    <option value="12">intra-arterial</option>
                                    <option value="13">auricular (otic)</option>
                                    <option value="14">buccal</option>
                                    <option value="15">cutaneous</option>
                                    <option value="16">dental</option>
                                    <option value="17">endocervical</option>
                                    <option value="18">endosinusial</option>
                                    <option value="19">endotracheal</option>
                                    <option value="20">epidural</option>
                                    <option value="21">extra-amniotic</option>
                                    <option value="22">hemodialysis</option>
                                    <option value="23">intra corpus cavernosum</option>
                                    <option value="24">intra-amniotic</option>
                                    <option value="25">intracardiac</option>
                                    <option value="26">intracavernous</option>
                                    <option value="27">intracerebral</option>
                                    <option value="28">intracervical</option>
                                    <option value="29">intracisternal</option>
                                    <option value="30">intracorneal</option>
                                    <option value="31">intracoronary</option>
                                    <option value="32">intradermal</option>
                                    <option value="33">intradiscal (intraspinal)</option>
                                    <option value="34">intrahepatic</option>
                                    <option value="35">intralesional</option>
                                    <option value="36">intralymphatic</option>
                                    <option value="37">intramedullar (bone marrow)</option>
                                    <option value="38">intrameningeal</option>
                                    <option value="39">intramuscular</option>
                                    <option value="40">intraocular</option>
                                    <option value="41">intrapericardial</option>
                                    <option value="42">intraperitoneal</option>
                                    <option value="43">intrapleural</option>
                                    <option value="44">intrasynovial</option>
                                    <option value="45">intrathoracic</option>
                                    <option value="46">intratracheal</option>
                                    <option value="47">intratumor</option>
                                    <option value="48">intra-uterine</option>
                                    <option value="49">intravenous (nos)</option>
                                    <option value="50">intravesical</option>
                                    <option value="51">iontophoresis</option>
                                    <option value="52">occlusive dressing technique</option>
                                    <option value="53">ophthalmic</option>
                                    <option value="54">oropharingeal</option>
                                    <option value="55">other</option>
                                    <option value="56">parenteral</option>
                                    <option value="57">periarticular</option>
                                    <option value="58">perineural</option>
                                    <option value="59">respiratory (inhalation)</option>
                                    <option value="60">retrobulbar</option>
                                    <option value="61">subdermal</option>
                                    <option value="62">sunconjunctival</option>
                                    <option value="63">transdermal</option>
                                    <option value="64">transmammary</option>
                                    <option value="65">transplacental</option>
                                    <option value="66">unknown</option>
                                    <option value="67">urethral</option>
                                    <option value="68">vaginal</option>
                                </select></div>				
                        </td>
                        <td  title="Frequency *"><div class="control-group required">
                                <select class="fil" name="frequency_id[]" style="width:180px !important;">
                                    <option value="<?=  $frequency  ?>"><?=  $frequency  ?></option>
                                     <option value="2">OD (once daily)</option>
                                    <option value="3">BD (twice daily)</option>
                                    <option value="4">TID. (three times a day)</option>
                                    <option value="5">QID|QDS (four times a day)</option>
                                    <option value="6">PRN PRN (as needed)</option>
                                    <option value="7">MANE (in the morning)</option>
                                    <option value="8">NOCTE (at night)</option>
                                    <option value="9">STAT (immediately)</option>
                                </select></div></td>
                        <td title="Date Started (dd-mm-yyyy) *">
                            <div class="control-group required"><input name="dispensing_date[]" class="ddate" type="text" value="<?= $pv['dispensing_date'] ?>" /></div>					</td>
                        <td title="Date Stopped (dd-mm-yyyy)">
                            <div class="control-group"><input name="date_stopped[]" type="text" class="sdate" value="<?= $ds; ?>"/></div></td>
                        <td title="Indication">
                            <div class="control-group"><input name="indication[]" maxlength="100" type="text" value="<?= $pv['indication'] ?>" /></div></td>
                        <td title="Suspected Drug?">
                            <input type="hidden" name="visitid[]" value="<?= $pv['record_id'] ?>" class="form-control f-input">

                            <div class="control-group"><input type="checkbox" name="suspecteddrug[]" value="1" /></div></td>

                    </tr>

                    <?php
                    $i++;
                }
                ?>

            </tbody>
        </table>

        <div class="max-row">

            <div class="mid-row">
                <label id="dcs" for="severity" ><b>Severity of reaction (refer to scale overleaf)</b></label>
                <input  type="radio" id="severity"  name="severity" value="Mild">
                Mild <br /> 
                <input  type="radio" id="severity"  name="severity" value="Moderate">
                Moderate <br /> 
                <input  type="radio" id="severity"  name="severity" value="Severe">
                Severe <br /> 
                <input  type="radio" id="severity"  name="severity" value="Fatal">
                Fatal <br /> 
                <input  type="radio" id="severity"  name="severity" value="Unknown">
                Unknown
            </div>


            <div class="mid-row">
                <label id="" for="action" ><b>ACTION TAKEN</b></label>
                <input  type="radio"  name="action" id="action" value="Drug withdrawn">
                Drug withdrawn<br />
                <input  type="radio"  name="action" id="action" value="Dose increased">
                Dose increased<br />
                <input  type="radio"  name="action" id="action" value="Dose reduced">
                Dose reduced<br />
                <input  type="radio"  name="action" id="action" value="Dose not changed">
                Dose not changed<br />
                <input  type="radio"  name="action" id="action" value="Unknown">
                Unknown
            </div>


            <div class="mid-row">
                <label id="dcs" for="outcome" ><b>OUTCOME</b></label>
                <input  type="radio"  name="outcome" id="outcome" value="Recovering / resolving">
                Recovering / resolving<br />
                <input  type="radio"  name="outcome" id="outcome" value="Recovered / resolved">
                Recovered / resolved<br />
                <input  type="radio"  name="outcome" id="outcome" value="Requires or prolongs hospitalization">
                Requires or prolongs hospitalization<br />
                <input  type="radio"  name="outcome" id="outcome" value="Causes a congenital anomaly">
                Causes a congenital anomaly<br />
                <input  type="radio"  name="outcome" id="outcome" value="Requires intervention to prevent permanent damage">
                Requires intervention to prevent permanent damage<br />
                <input type="radio" name="outcome" value="recovered/resolved with sequela" />Recovered/resolved with sequela<br />
                <input type="radio" name="outcome"  value="not recovered/not resolved" />Not recovered/not resolved<br />
                <input type="radio" name="outcome"  value="fatal - unrelated to reaction" />Fatal - unrelated to reaction<br />
                <input type="radio" name="outcome"  value="fatal - reaction may be contributory" />Fatal - reaction may be contributory<br />
                <input type="radio" name="outcome" value="fatal - due to reaction" />Fatal - due to reaction<br />
                <input  type="radio"  name="outcome" id="outcome" value="Unknown">
                Unknown
            </div>


            <div class="mid-row">
                <label id="dcs" for="casuality" ><b>CAUSALITY OF REACTION (refer to scale overleaf)</b></label>
                <input  type="radio"  name="casuality" id="casuality" value="Certain">
                Certain <br />
                <input  type="radio"  name="casuality" id="casuality" value="Probable / Likely">
                Probable / Likely <br />
                <input  type="radio"  name="casuality" id="casuality" value="Possible">
                Possible <br />
                <input  type="radio"  name="casuality" id="casuality" value="Unlikely">
                Unlikely <br />
                <input  type="radio"  name="casuality" id="casuality" value="Conditional / Unclassified">
                Conditional / Unclassified <br />
                <input  type="radio"  name="casuality" id="casuality" value="Unassessable / Unclassifiable">
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
                <input type="text" name="officername" id="officername" value="<?= $user_full_name; ?>" class="validate[required] f-input">
            </div>
            <div class="mid-row">
                <label ><span class='astericks'>*</span>DATE:</label>
                <input  type="text" name="reportingdate" id="reportingdate" class="validate[required] f-input adrdate">
            </div>
            <div class="mid-row">
                <label><span class='astericks'>*</span>Email ADDRESS </label>
                <input type="text" name="officeremail" id="officeremail" value="<?= $user_email; ?>" class="validate[required] f-input">
            </div>
            <div class="mid-row">
                <label><span class='astericks'>*</span>Office Phone </label>
                <input type="text" name="officerphone" id="officerphone" value="<?= $user_phone; ?>" class="validate[required] f-input">
            </div>
            <div class="mid-row">
                <label><span class='astericks'>*</span>Designation</label>
                <select name="designation_id" class="fil" id="designation_id">
                    <option value=""></option>
                    <option value="1">physician</option>
                    <option value="2">pharmacist</option>
                    <option value="3" selected="selected">other professional</option>
                    <option value="5">consumer or other non health professional</option>
                </select>
            </div>
            <div class="mid-row">
                <label><span class='astericks'>*</span>Signature </label>
                <input type="text" name="officersignature" id="officersignature" class="validate[required] f-input">
            </div>

            <div class="mid-row">
                <button type="submit" class="btn btn-primary" value="Submit">Submit</button>
                <button>cancel</button>
            </div>

        </div>


    </form>
</div>

<script type="text/javascript">

    $(document).ready(function () {
        $('.fil').select2();

        $("input[name=gender][value=<?= $patient_details['gender'] ?>]").attr('checked', 'checked');
        var pregnant = '<?= $patient_details['pregnant'] ?>';
        var allergies = '<?= $patient_details['drug_allergies'] ?>';

        if (pregnant === 'NO') {
            $("input[name=pregnancystatus][value=NotPregnant]").attr('checked', 'checked');
        } else {
            $("input[name=pregnancystatus][value=1stTrimester]").attr('checked', 'checked');
        }

        if (allergies === ',') {
            $("input[name=allergy][value=0]").attr('checked', 'checked');
        } else {
            $("input[name=allergy][value=1]").attr('checked', 'checked');
            $('#allergydesc').val(allergies);
            $('#allergydesc').show()

        }

        $('#allergy').change(function () {
            // $('#allergydesc').toggle()

            if ($('#allergy').val() == 0) {
                console.log('0 ' + $('#allergy').val());
                $('#allergydesc').hide()

            } else {

                $('#allergydesc').show()
                console.log('otherwise');

            }
        });

        $("#adr_form").validate({
            rules: {
                report_title: "required",
                institution: "required",
                institutioncode: "required",
                contact: "required",
                address: "required",
                county_id: "required",
                sub_county_id: "required",
                patientname: "required",
                ip_no: "required",
                dob: "required",
                patientaddress: "required",
                clinic: "required",
                gender: "required",
                patientweight: "required",
                patientheight: "required",
                diagnosis: "required",
                reaction: "required",
                "brand_name[]": "required",
                "dose[]": "required",
                "drug_name[]": "required",
                "dose_id[]": "required",
                "route_id[]": "required",
                "frequency_id[]": "required",
                "dispensing_date[]": "required",
                "date_stopped[]": "required",
                "indication[]": "required",
                "suspecteddrug[]": "required",
                severity: "required",
                action: "required",
                outcome: "required",
                casuality: "required",
                officername: "required",
                reportingdate: "required",
                officeremail: {required:true,email:true},
                officerphone: "required",
                designation_id: "required",
                officersignature: "required",

            },
            messages: {
                report_title: "Please enter reporting title",
                institution: "Please enter institution",
                institutioncode: "Please enter institution code",
                address: "Please enter address",
                contact: "Please enter contact person",
                sub_county_id: "Please select sub county",
                county_id: "Please eselect county",
                patientname: "Please patient no",
                ip_no: "Please enter IP no",
                dob: "Please enter date of birth",
                patientaddress: "Please enter patient address",
                clinic: "Please enter clinic",
                gender: "Please enter IP gender",
                patientweight: "Please enter IP gender",
                patientheight: "Please enter IP gender",
                diagnosis: "Please select diagnosis",
                reaction: "Please select reaction",
                severity: "Please welect serveritt",
                action: "Please eselect action taken",
                outcome: "Please select outcome",
                casuality: "Please select casuality",
                officername: "Please enter name",
                reportingdate: "Please enter date",
                officeremail: "Please enter email",
                officerphone: "Please enter phone",
                designation_id: "Please select designation",
                officersignature: "Please enter signature",
                "brand_name[]": "Please enter brand name",
                "dose[]": "Please select dosage",
                "drug_name[]": "Please enter Generic name",
                "dose_id[]": "Please select doosage unit",
                "route_id[]": "Please select route",
                "frequency_id[]": "Please select frequency",
                "dispensing_date[]": "Please select date",
                "date_stopped[]": "Please select date stopped",
                "indication[]": "Please state indication",
                "suspecteddrug[]": "Please select suspected",

            }
        });



        $(".adrdate,#dob,.ddate,.sdate").datepicker({
            dateFormat:'yy-dd-mm'
        });

        $('.drugs').change(function (e) {
            var row_id = $(this).parent().parent().attr('rowid');
            console.log(row_id);
        });


// getDoses for all drugs
// getDrugDose(drugid)
// getIndications(drugid) // fetch on selecting a drug
    });

</script>