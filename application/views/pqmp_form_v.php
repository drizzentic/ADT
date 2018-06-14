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
    <div class="container">
        <div class="row">
            <div class="text-center">
                <img src="<?php echo base_url() . 'assets/images/top_logo.png'; ?>">
                <h4 style="color: #2e3092;">
                    MINISTRY OF HEALTH <br />
                    THE PHARMACY AND POISONS BOARD<br />
                    DEPARTMENT OF PHARMACOVIGILANCE<br />
                </h4>
                <h3 style="color:#3b8476;">FORM FOR REPORTING POOR QUALITY MEDICINAL PRODUCTS</h3>
            </div>
        </div>
    </div>
    <form name="pqmp-form" id="PQMS" method="POST" action="<?= base_url(); ?>inventory_management/save_pqm_for_synch">
        <table border="1" style="">
            <tr>
                <td colspan="2">Name of Facility : <input type="text" name="facility_name" id="facility_name" class="form-control" value="<?= $facility_name; ?>"> </td>
                <td colspan="3">County: <!--input type="text" name="district_name" id="district_name" class="form-control"-->
                    <select name="county_id" class="" id="PqmpCountyId">
                        <option value=""></option>
                        <option value="1">Mombasa</option>
                        <option value="2">Kwale</option>
                        <option value="3">Kilifi</option>
                        <option value="4">Tana River</option>
                        <option value="5">Lamu</option>
                        <option value="6">Taita Taveta</option>
                        <option value="7">Garissa</option>
                        <option value="8">Wajir</option>
                        <option value="9">Mandera</option>
                        <option value="10">Marsabit</option>
                        <option value="11">Isiolo</option>
                        <option value="12">Meru</option>
                        <option value="13">Tharaka Nithi</option>
                        <option value="14">Embu</option>
                        <option value="15">Kitui</option>
                        <option value="16">Machakos</option>
                        <option value="17">Makueni</option>
                        <option value="18">Nyandarua</option>
                        <option value="19">Nyeri</option>
                        <option value="20">Kirinyaga</option>
                        <option value="21">Murang&#039;a</option>
                        <option value="22">Kiambu</option>
                        <option value="23">Turkana</option>
                        <option value="24">West Pokot</option>
                        <option value="25">Samburu</option>
                        <option value="26">Trans Nzoia</option>
                        <option value="27">Uasin Gishu</option>
                        <option value="28">Elgeyo/Marakwet</option>
                        <option value="29">Nandi</option>
                        <option value="30">Baringo</option>
                        <option value="31">Laikipia</option>
                        <option value="32">Nakuru</option>
                        <option value="33">Narok</option>
                        <option value="34">Kajiado</option>
                        <option value="35">Kericho</option>
                        <option value="36">Bomet</option>
                        <option value="37">Kakamega</option>
                        <option value="38">Vihiga</option>
                        <option value="39">Bung&#039;oma</option>
                        <option value="40">Busia</option>
                        <option value="41">Siaya</option>
                        <option value="42">Kisumu</option>
                        <option value="43">Homa Bay</option>
                        <option value="44">Migori</option>
                        <option value="45">Kisii</option>
                        <option value="46">Nyamira</option>
                        <option value="47" selected="selected">Nairobi City</option>
                    </select>
                </td>
                <td colspan="3">Sub County: <!--input type="text" name="province_name" id="province_name" class="form-control"-->
                    <select name="sub_county_id" class="" id="PqmpSubCountyId">
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
                        <option value="290">CHUKA/IGAMBANG&#039;OMBE</option>
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
                        <option value="276" selected="selected">LANGATA</option>
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
                        <option value="273">WESTLANDS</option>
                        <option value="24">WUNDANYI</option>
                        <option value="75">YATTA</option>
                    </select>

                </td>
            </tr>
            <tr>
                <td colspan="2">Facility Address: <input type="text" name="facility_address" id="facility_address" class="form-control" value="325 Nairobi"></td>
                <td colspan="3">Facility Telephone: <input type="text" name="facility_phone" id="facility_phone" class="form-control" value="<?= $facility_phone; ?>"></td>
                <td colspan="3">Facility Code: <input type="text" name="facility_code" id="facility_phone" class="form-control" value="3258"></td>
            </tr>
            <tr>
                <td colspan="8" align="center" style="background-color: lightblue;"><h3>PRODUCT IDENTITY</h3></td>
            </tr>
            <tr>
                <td>Brand Name</td>
                <td colspan="3"><input type="text" name="brand_name" id="brand_name" class="form-control"> </td>
                <td>Generic Name</td>
                <td colspan="3"><input type="text" name="generic_name" id="generic_name" class="form-control"> </td>
            </tr>
            <tr>
                <td>Batch/Lot Number</td>
                <td><input type="text" name="batch_no" id="batch_no" class="form-control"></td>
                <td>Date of Manufacture</td>
                <td><input type="text" name="manufacture_date" id="manufacture_date" class=""></td>
                <td>Date of Expiry</td>
                <td><input type="text" name="expiry_date" id="expiry_date" class=""></td>
                <td>Date of Receipt</td>
                <td><input type="text" name="receipt_date" id="receipt_date" class=""></td>
            </tr>
            <tr>
                <td>Name of Manufacturer</td>
                <td colspan="3"><input type="text" name="manufacturer_name" id="manufacturer_name" class="form-control"> </td>
                <td>Country of Origin</td>
                <td colspan="3"><!--input type="text" name="origin_county" id="origin_county" class="form-control"-->

                    <select name="country_id" class="" id="PqmpCountryId">
                        <option value=""></option>
                        <option value="1">Andorra</option>
                        <option value="2">United Arab Emirates</option>
                        <option value="3">Afghanistan</option>
                        <option value="4">Antigua and Barbuda</option>
                        <option value="5">Anguilla</option>
                        <option value="6">Albania</option>
                        <option value="7">Armenia</option>
                        <option value="8">Angola</option>
                        <option value="9">Antarctica</option>
                        <option value="10">Argentina</option>
                        <option value="11">American Samoa</option>
                        <option value="12">Austria</option>
                        <option value="13">Australia</option>
                        <option value="14">Aruba</option>
                        <option value="16">Azerbaijan</option>
                        <option value="17">Bosnia and Herzegovina</option>
                        <option value="18">Barbados</option>
                        <option value="19">Bangladesh</option>
                        <option value="20">Belgium</option>
                        <option value="21">Burkina Faso</option>
                        <option value="22">Bulgaria</option>
                        <option value="23">Bahrain</option>
                        <option value="24">Burundi</option>
                        <option value="25">Benin</option>
                        <option value="26">Saint BarthÃ©lemy</option>
                        <option value="27">Bermuda</option>
                        <option value="28">Brunei Darussalam</option>
                        <option value="29">Bolivia</option>
                        <option value="30">Caribbean Netherlands </option>
                        <option value="31">Brazil</option>
                        <option value="32">Bahamas</option>
                        <option value="33">Bhutan</option>
                        <option value="34">Bouvet Island</option>
                        <option value="35">Botswana</option>
                        <option value="36">Belarus</option>
                        <option value="37">Belize</option>
                        <option value="38">Canada</option>
                        <option value="39">Cocos (Keeling) Islands</option>
                        <option value="40">Congo, Democratic Republic of</option>
                        <option value="41">Central African Republic</option>
                        <option value="42">Congo</option>
                        <option value="43">Switzerland</option>
                        <option value="44">CÃ´te Dâ€™Ivoire</option>
                        <option value="45">Cook Islands</option>
                        <option value="46">Chile</option>
                        <option value="47">Cameroon</option>
                        <option value="48">China</option>
                        <option value="49">Colombia</option>
                        <option value="50">Costa Rica</option>
                        <option value="51">Cuba</option>
                        <option value="52">Cape Verde</option>
                        <option value="53">CuraÃ§ao</option>
                        <option value="54">Christmas Island</option>
                        <option value="55">Cyprus</option>
                        <option value="56">Czech Republic</option>
                        <option value="57">Germany</option>
                        <option value="58">Djibouti</option>
                        <option value="59">Denmark</option>
                        <option value="60">Dominica</option>
                        <option value="61">Dominican Republic</option>
                        <option value="62">Algeria</option>
                        <option value="63">Ecuador</option>
                        <option value="64">Estonia</option>
                        <option value="65">Egypt</option>
                        <option value="66">Western Sahara</option>
                        <option value="67">Eritrea</option>
                        <option value="68">Spain</option>
                        <option value="69">Ethiopia</option>
                        <option value="70">Finland</option>
                        <option value="71">Fiji</option>
                        <option value="72">Falkland Islands</option>
                        <option value="73">Micronesia, Federated States of</option>
                        <option value="74">Faroe Islands</option>
                        <option value="75">France</option>
                        <option value="76">Gabon</option>
                        <option value="77">United Kingdom</option>
                        <option value="78">Grenada</option>
                        <option value="79">Georgia</option>
                        <option value="80">French Guiana</option>
                        <option value="81">Guernsey</option>
                        <option value="82">Ghana</option>
                        <option value="83">Gibraltar</option>
                        <option value="84">Greenland</option>
                        <option value="85">Gambia</option>
                        <option value="86">Guinea</option>
                        <option value="87">Guadeloupe</option>
                        <option value="88">Equatorial Guinea</option>
                        <option value="89">Greece</option>
                        <option value="90">South Georgia and the South Sandwich Islands</option>
                        <option value="91">Guatemala</option>
                        <option value="92">Guam</option>
                        <option value="93">Guinea-Bissau</option>
                        <option value="94">Guyana</option>
                        <option value="95">Hong Kong</option>
                        <option value="96">Heard and McDonald Islands</option>
                        <option value="97">Honduras</option>
                        <option value="98">Croatia</option>
                        <option value="99">Haiti</option>
                        <option value="100">Hungary</option>
                        <option value="101">Indonesia</option>
                        <option value="102">Ireland</option>
                        <option value="103">Israel</option>
                        <option value="104">Isle of Man</option>
                        <option value="105">India</option>
                        <option value="106">British Indian Ocean Territory</option>
                        <option value="107">Iraq</option>
                        <option value="108">Iran</option>
                        <option value="109">Iceland</option>
                        <option value="110">Italy</option>
                        <option value="111">Jersey</option>
                        <option value="112">Jamaica</option>
                        <option value="113">Jordan</option>
                        <option value="114">Japan</option>
                        <option value="115" selected="selected">Kenya</option>
                        <option value="116">Kyrgyzstan</option>
                        <option value="117">Cambodia</option>
                        <option value="118">Kiribati</option>
                        <option value="119">Comoros</option>
                        <option value="120">Saint Kitts and Nevis</option>
                        <option value="121">North Korea</option>
                        <option value="122">South Korea</option>
                        <option value="123">Kuwait</option>
                        <option value="124">Cayman Islands</option>
                        <option value="125">Kazakhstan</option>
                        <option value="126">Lao Peopleâ€™s Democratic Republic</option>
                        <option value="127">Lebanon</option>
                        <option value="128">Saint Lucia</option>
                        <option value="129">Liechtenstein</option>
                        <option value="130">Sri Lanka</option>
                        <option value="131">Liberia</option>
                        <option value="132">Lesotho</option>
                        <option value="133">Lithuania</option>
                        <option value="134">Luxembourg</option>
                        <option value="135">Latvia</option>
                        <option value="136">Libya</option>
                        <option value="137">Morocco</option>
                        <option value="138">Monaco</option>
                        <option value="139">Moldova</option>
                        <option value="140">Montenegro</option>
                        <option value="141">Saint-Martin (France)</option>
                        <option value="142">Madagascar</option>
                        <option value="143">Marshall Islands</option>
                        <option value="144">Macedonia</option>
                        <option value="145">Mali</option>
                        <option value="146">Myanmar</option>
                        <option value="147">Mongolia</option>
                        <option value="148">Macau</option>
                        <option value="149">Northern Mariana Islands</option>
                        <option value="150">Martinique</option>
                        <option value="151">Mauritania</option>
                        <option value="152">Montserrat</option>
                        <option value="153">Malta</option>
                        <option value="154">Mauritius</option>
                        <option value="155">Maldives</option>
                        <option value="156">Malawi</option>
                        <option value="157">Mexico</option>
                        <option value="158">Malaysia</option>
                        <option value="159">Mozambique</option>
                        <option value="160">Namibia</option>
                        <option value="161">New Caledonia</option>
                        <option value="162">Niger</option>
                        <option value="163">Norfolk Island</option>
                        <option value="164">Nigeria</option>
                        <option value="165">Nicaragua</option>
                        <option value="166">The Netherlands</option>
                        <option value="167">Norway</option>
                        <option value="168">Nepal</option>
                        <option value="169">Nauru</option>
                        <option value="170">Niue</option>
                        <option value="171">New Zealand</option>
                        <option value="172">Oman</option>
                        <option value="173">Panama</option>
                        <option value="174">Peru</option>
                        <option value="175">French Polynesia</option>
                        <option value="176">Papua New Guinea</option>
                        <option value="177">Philippines</option>
                        <option value="178">Pakistan</option>
                        <option value="179">Poland</option>
                        <option value="180">St. Pierre and Miquelon</option>
                        <option value="181">Pitcairn</option>
                        <option value="182">Puerto Rico</option>
                        <option value="183">Palestinian Territory, Occupied</option>
                        <option value="184">Portugal</option>
                        <option value="185">Palau</option>
                        <option value="186">Paraguay</option>
                        <option value="187">Qatar</option>
                        <option value="188">Reunion</option>
                        <option value="189">Romania</option>
                        <option value="190">Serbia</option>
                        <option value="191">Russian Federation</option>
                        <option value="192">Rwanda</option>
                        <option value="193">Saudi Arabia</option>
                        <option value="194">Solomon Islands</option>
                        <option value="195">Seychelles</option>
                        <option value="196">Sudan</option>
                        <option value="197">Sweden</option>
                        <option value="198">Singapore</option>
                        <option value="199">Saint Helena</option>
                        <option value="200">Slovenia</option>
                        <option value="201">Svalbard and Jan Mayen Islands</option>
                        <option value="202">Slovakia (Slovak Republic)</option>
                        <option value="203">Sierra Leone</option>
                        <option value="204">San Marino</option>
                        <option value="205">Senegal</option>
                        <option value="206">Somalia</option>
                        <option value="207">Suriname</option>
                        <option value="208">South Sudan</option>
                        <option value="209">Sao Tome and Principe</option>
                        <option value="210">El Salvador</option>
                        <option value="211">Saint-Martin (Pays-Bas)</option>
                        <option value="212">Syria</option>
                        <option value="213">Swaziland</option>
                        <option value="214">Turks and Caicos Islands</option>
                        <option value="215">Chad</option>
                        <option value="216">French Southern Territories</option>
                        <option value="217">Togo</option>
                        <option value="218">Thailand</option>
                        <option value="219">Tajikistan</option>
                        <option value="220">Tokelau</option>
                        <option value="221">Timor-Leste</option>
                        <option value="222">Turkmenistan</option>
                        <option value="223">Tunisia</option>
                        <option value="224">Tonga</option>
                        <option value="225">Turkey</option>
                        <option value="226">Trinidad and Tobago</option>
                        <option value="227">Tuvalu</option>
                        <option value="228">Taiwan</option>
                        <option value="229">Tanzania</option>
                        <option value="230">Ukraine</option>
                        <option value="231">Uganda</option>
                        <option value="232">United States Minor Outlying Islands</option>
                        <option value="233">United States</option>
                        <option value="234">Uruguay</option>
                        <option value="235">Uzbekistan</option>
                        <option value="236">Vatican</option>
                        <option value="237">Saint Vincent and the Grenadines</option>
                        <option value="238">Venezuela</option>
                        <option value="239">Virgin Islands (British)</option>
                        <option value="240">Virgin Islands (U.S.)</option>
                        <option value="241">Vietnam</option>
                        <option value="242">Vanuatu</option>
                        <option value="243">Wallis and Futuna Islands</option>
                        <option value="244">Samoa</option>
                        <option value="245">Yemen</option>
                        <option value="246">Mayotte</option>
                        <option value="247">South Africa</option>
                        <option value="248">Zambia</option>
                        <option value="249">Zimbabwe</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Name of Distributor/Supplier</td>
                <td colspan="2"><input type="text" name="supplier_name" id="supplier_name" class="form-control"> </td>
                <td>Distributor/Supplier's Address</td>
                <td colspan="4"><input type="text" name="supplier_address" id="supplier_address" class="form-control"> </td>
            </tr>
            <tr>
                <td colspan="4" align="center" style="background-color:lightblue;"><h4>PRODUCT FORMULATION (Tick appropriate box)</h4></td>
                <td colspan="4" align="center" style="background-color: lightblue;"><h4>COMPLAINT (Tick appropriate box)</h4></td>
            </tr>
            <tr>
                <td colspan="4" align="">
                    
                        <input name="product_formulation"  value="Oral tablets / capsules" type="radio">Oral tablets / capsules<br>
                        <input name="product_formulation"  value="Oral suspension / syrup" type="radio">Oral suspension / syrup<br>
                        <input name="product_formulation"  value="Injection" type="radio">Injection<br>
                        <input name="product_formulation"  value="Diluent" type="radio">Diluent<br>
                        <input name="product_formulation"  value="Powder for Reconstitution of Suspension" type="radio">Powder for Reconstitution of Suspensions<br>
                        <input name="product_formulation"  value="Powder for Reconstitution of Injection" type="radio">Powder for Reconstitution of Injection<br>
                        <input name="product_formulation"  value="Eye drops" type="radio">Eye drops<br>
                        <input name="product_formulation"  value="Ear drops" type="radio">Ear drops<br>
                        <input name="product_formulation"  value="Nebuliser solution" type="radio">Nebuliser solution<br>
                        <input name="product_formulation"  value="Cream / Ointment / Liniment / Paste" type="radio">Cream / Ointment / Liniment / Paste<br>
                        <input name="product_formulation"  value="Cream / Ointment / Liniment / Paste" type="radio">Other<br>
                        <input type="text" name="formulation_other" id="formulation_other">

                        </td>
                        <td colspan="4" align="">
                            <input type="checkbox" name="colour_change" value="1"   id="PqmpColourChange"/>Colour change <br>
                           <input type="checkbox" name="separating" value="1"   id="PqmpSeparating"/>Separating	<br>
                           <input type="checkbox" name="powdering1" value="1"    id="PqmpPowdering"/>Powdering / crumbling <br>
                           <input type="checkbox" name="caking" value="1"   id="PqmpCaking"/>Caking<br>
                           <input type="checkbox" name="moulding"   value="1"  id="PqmpMoulding"/>Moulding <br>
                           <input type="checkbox" name="odour_change" value="1"   id="PqmpOdourChange"/>Change of odour<br>
                           <input type="checkbox" name="mislabeling"  value="1"   id="PqmpMislabeling"/>Mislabeling <br>
                           <input type="checkbox" name="incomplete_pack" value="1"    id="PqmpIncompletePack"/>Incomplete pack<br>
                           <input type="checkbox" name="complaint_other"  value="1"   id="PqmpComplaintOther"/>Other<br>
                            <input type="text" name="complaint_other_specify" value="1"  id="complaint_other">


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
                    <textarea style="width: 100%;" id="comments" name="comments"></textarea>
                </td>
            </tr>
            <tr>

                <td colspan="4">Name of reporter : <input type="text" name="reporter_name" id="reporter_name" value="<?= $user_full_name; ?>" class="form-control"> </td>
                <td colspan="4">Contact Number : <input type="text" name="reporter_phone" id="reporter_phone" value="<?= $user_phone; ?>" class="form-control"> </td>
            </tr>
            <tr>
                <td colspan="4">Cadre Job Title : <!--input type="text" name="reporter_title" id="reporter_title" class="form-control"--> 

                    <select name="designation_id" class="" id="PqmpDesignationId">
                        <option value="1">physician</option>
                        <option value="2">pharmacist</option>
                        <option value="3" selected="selected">other professional</option>
                        <option value="5">consumer or other non health professional</option>
                    </select>
                </td>
                <td colspan="4">Reporter E-mail : <input type="text" name="reporter_signature" id="reporter_signature" value="<?= $user_email; ?>" class="form-control"> </td>
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
        <div class="mid-row">
            <input type="submit" id="SUBMITDATA"  value="Submit">
            <button>cancel</button>
        </div>
    </form>
</div>
<script type="text/javascript">

    $(document).ready(function () {
     
        $("#manufacture_date,#expiry_date,#receipt_date").datepicker();

    });

</script>