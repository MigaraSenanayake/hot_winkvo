<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Register Walk-In Guest
                <a href="w_customer.php" class="btn btn-outline-danger float-end">Back</a>
            </h4>
        </div>

        <div class="card_body px-3 mt-2">
            <?php alertMessage(); ?>

            <form action="../code.php" method="POST">

                <?php
                if (isset($_GET['id'])) {
                    $w_cus_Id = trim($_GET['id']);
                    if (!empty($w_cus_Id)) {
                        $w_cus_Data = getById('w_customers', $w_cus_Id);

                        if ($w_cus_Data && $w_cus_Data['status'] == 200) {
                            $w_customer = $w_cus_Data['data'];
                        } else {
                            echo '<h5>' . htmlspecialchars($w_cus_Data['message']) . '</h5>';
                            return false;
                        }
                    } else {
                        echo '<h5>Id Not Found</h5>';
                        return false;
                    }
                } else {
                    echo '<h5>Id Not given in parameters</h5>';
                    return false;
                }
                ?>

                <!-- Hidden input to store admin ID -->
                <input type="hidden" name="w_cus_Id" value="<?= htmlspecialchars($w_customer['id']); ?>">

                <div class="row">

                <div class="col-md-2 mb-4">
                        <label for="title">Title *</label>
                        <select name="title" class="form-select" required>                            
                            <option <?= (isset($w_customer['title']) && $w_customer['title'] == 'Mr.') ? 'selected' : ''; ?>>Mr.</option>
                            <option <?= (isset($w_customer['title']) && $w_customer['title'] == 'Mrs.') ? 'selected' : ''; ?>>Mrs.</option>
                            <option <?= (isset($w_customer['title']) && $w_customer['title'] == 'Rev.') ? 'selected' : ''; ?>>Rev.</option>
                        </select>
                    </div>
                    <div class="col-md-10 mb-4">
                        <label for="name">Name *</label>
                        <input type="text" name="name" required value="<?= htmlspecialchars($w_customer['name']); ?>" class="form-control" />
                    </div>                     
                     <div class="col-md-12 mb-4">
                        <label for="bname">Billing Name (For Co-operate Guest) *</label>
                        <input type="text" name="bname" value="<?= htmlspecialchars($w_customer['bname']); ?>" class="form-control" />
                    </div>

                    <div class="col-md-12 mb-4">
                        <label for="address">Address *</label>
                        <input type="text" name="address" required value="<?= htmlspecialchars($w_customer['address']); ?>" class="form-control" />
                    </div>  
                    
                    <div class="col-md-6 mb-4">
                        <label for="nic_pp">NIC or Passport Number *</label>
                        <input type="text" name="nic_pp" required value="<?= htmlspecialchars($w_customer['nic_pp']); ?>" class="form-control" />
                    </div> 

                    <div class="col-md-6 mb-4">
                        <label for="phone">Contact Number *</label>
                        <div class="input-group">
                            <!-- Country Code Dropdown -->
                            <select name="c_code" id="c_code" class="form-select" style="max-width: 120px;" required>
                                <option value="+1" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+1') ? 'selected' : ''; ?>>+1 (USA)</option>
                                <option value="+7" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+7') ? 'selected' : ''; ?>>+7 (Russia)</option>
                                <option value="+20" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+20') ? 'selected' : ''; ?>>+20 (Egypt)</option>
                                <option value="+27" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+27') ? 'selected' : ''; ?>>+27 (South Africa)</option>
                                <option value="+30" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+30') ? 'selected' : ''; ?>>+30 (Greece)</option>
                                <option value="+31" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+31') ? 'selected' : ''; ?>>+31 (Netherlands)</option>
                                <option value="+32" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+32') ? 'selected' : ''; ?>>+32 (Belgium)</option>
                                <option value="+33" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+33') ? 'selected' : ''; ?>>+33 (France)</option>
                                <option value="+34" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+34') ? 'selected' : ''; ?>>+34 (Spain)</option>
                                <option value="+36" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+36') ? 'selected' : ''; ?>>+36 (Hungary)</option>
                                <option value="+39" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+39') ? 'selected' : ''; ?>>+39 (Italy)</option>
                                <option value="+40" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+40') ? 'selected' : ''; ?>>+40 (Romania)</option>
                                <option value="+41" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+41') ? 'selected' : ''; ?>>+41 (Switzerland)</option>
                                <option value="+43" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+43') ? 'selected' : ''; ?>>+43 (Austria)</option>
                                <option value="+44" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+44') ? 'selected' : ''; ?>>+44 (United Kingdom)</option>
                                <option value="+45" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+45') ? 'selected' : ''; ?>>+45 (Denmark)</option>
                                <option value="+46" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+46') ? 'selected' : ''; ?>>+46 (Sweden)</option>
                                <option value="+47" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+47') ? 'selected' : ''; ?>>+47 (Norway)</option>
                                <option value="+48" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+48') ? 'selected' : ''; ?>>+48 (Poland)</option>
                                <option value="+49" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+49') ? 'selected' : ''; ?>>+49 (Germany)</option>
                                <option value="+51" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+51') ? 'selected' : ''; ?>>+51 (Peru)</option>
                                <option value="+52" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+52') ? 'selected' : ''; ?>>+52 (Mexico)</option>
                                <option value="+53" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+53') ? 'selected' : ''; ?>>+53 (Cuba)</option>
                                <option value="+54" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+54') ? 'selected' : ''; ?>>+54 (Argentina)</option>
                                <option value="+55" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+55') ? 'selected' : ''; ?>>+55 (Brazil)</option>
                                <option value="+56" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+56') ? 'selected' : ''; ?>>+56 (Chile)</option>
                                <option value="+57" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+57') ? 'selected' : ''; ?>>+57 (Colombia)</option>
                                <option value="+58" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+58') ? 'selected' : ''; ?>>+58 (Venezuela)</option>
                                <option value="+60" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+60') ? 'selected' : ''; ?>>+60 (Malaysia)</option>
                                <option value="+61" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+61') ? 'selected' : ''; ?>>+61 (Australia)</option>
                                <option value="+62" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+62') ? 'selected' : ''; ?>>+62 (Indonesia)</option>
                                <option value="+63" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+63') ? 'selected' : ''; ?>>+63 (Philippines)</option>
                                <option value="+64" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+64') ? 'selected' : ''; ?>>+64 (New Zealand)</option>
                                <option value="+65" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+65') ? 'selected' : ''; ?>>+65 (Singapore)</option>
                                <option value="+66" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+66') ? 'selected' : ''; ?>>+66 (Thailand)</option>
                                <option value="+81" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+81') ? 'selected' : ''; ?>>+81 (Japan)</option>
                                <option value="+82" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+82') ? 'selected' : ''; ?>>+82 (South Korea)</option>
                                <option value="+84" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+84') ? 'selected' : ''; ?>>+84 (Vietnam)</option>
                                <option value="+86" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+86') ? 'selected' : ''; ?>>+86 (China)</option>
                                <option value="+90" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+90') ? 'selected' : ''; ?>>+90 (Turkey)</option>
                                <option value="+91" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+91') ? 'selected' : ''; ?>>+91 (India)</option>
                                <option value="+92" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+92') ? 'selected' : ''; ?>>+92 (Pakistan)</option>
                                <option value="+93" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+93') ? 'selected' : ''; ?>>+93 (Afghanistan)</option>
                                <option value="+94" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+94') ? 'selected' : ''; ?>>+94 (Sri Lanka)</option>
                                <option value="+95" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+95') ? 'selected' : ''; ?>>+95 (Myanmar)</option>
                                <option value="+98" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+98') ? 'selected' : ''; ?>>+98 (Iran)</option>
                                <option value="+211" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+211') ? 'selected' : ''; ?>>+211 (South Sudan)</option>
                                <option value="+212" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+212') ? 'selected' : ''; ?>>+212 (Morocco)</option>
                                <option value="+213" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+213') ? 'selected' : ''; ?>>+213 (Algeria)</option>
                                <option value="+216" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+216') ? 'selected' : ''; ?>>+216 (Tunisia)</option>
                                <option value="+218" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+218') ? 'selected' : ''; ?>>+218 (Libya)</option>
                                <option value="+220" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+220') ? 'selected' : ''; ?>>+220 (Gambia)</option>
                                <option value="+221" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+221') ? 'selected' : ''; ?>>+221 (Senegal)</option>
                                <option value="+222" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+222') ? 'selected' : ''; ?>>+222 (Mauritania)</option>
                                <option value="+223" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+223') ? 'selected' : ''; ?>>+223 (Mali)</option>
                                <option value="+224" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+224') ? 'selected' : ''; ?>>+224 (Guinea)</option>
                                <option value="+225" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+225') ? 'selected' : ''; ?>>+225 (Ivory Coast)</option>
                                <option value="+226" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+226') ? 'selected' : ''; ?>>+226 (Burkina Faso)</option>
                                <option value="+227" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+227') ? 'selected' : ''; ?>>+227 (Niger)</option>
                                <option value="+228" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+228') ? 'selected' : ''; ?>>+228 (Togo)</option>
                                <option value="+229" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+229') ? 'selected' : ''; ?>>+229 (Benin)</option>
                                <option value="+230" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+230') ? 'selected' : ''; ?>>+230 (Mauritius)</option>
                                <option value="+231" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+231') ? 'selected' : ''; ?>>+231 (Liberia)</option>
                                <option value="+232" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+232') ? 'selected' : ''; ?>>+232 (Sierra Leone)</option>
                                <option value="+233" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+233') ? 'selected' : ''; ?>>+233 (Ghana)</option>
                                <option value="+234" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+234') ? 'selected' : ''; ?>>+234 (Nigeria)</option>
                                <option value="+235" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+235') ? 'selected' : ''; ?>>+235 (Chad)</option>
                                <option value="+236" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+236') ? 'selected' : ''; ?>>+236 (Central African Republic)</option>
                                <option value="+237" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+237') ? 'selected' : ''; ?>>+237 (Cameroon)</option>
                                <option value="+238" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+238') ? 'selected' : ''; ?>>+238 (Cape Verde)</option>
                                <option value="+239" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+239') ? 'selected' : ''; ?>>+239 (Sao Tome and Principe)</option>
                                <option value="+240" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+240') ? 'selected' : ''; ?>>+240 (Equatorial Guinea)</option>
                                <option value="+241" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+241') ? 'selected' : ''; ?>>+241 (Gabon)</option>
                                <option value="+242" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+242') ? 'selected' : ''; ?>>+242 (Congo-Brazzaville)</option>
                                <option value="+243" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+243') ? 'selected' : ''; ?>>+243 (Congo-Kinshasa)</option>
                                <option value="+244" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+244') ? 'selected' : ''; ?>>+244 (Angola)</option>
                                <option value="+245" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+245') ? 'selected' : ''; ?>>+245 (Guinea-Bissau)</option>
                                <option value="+246" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+246') ? 'selected' : ''; ?>>+246 (British Indian Ocean Territory)</option>
                                <option value="+248" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+248') ? 'selected' : ''; ?>>+248 (Seychelles)</option>
                                <option value="+249" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+249') ? 'selected' : ''; ?>>+249 (Sudan)</option>
                                <option value="+250" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+250') ? 'selected' : ''; ?>>+250 (Rwanda)</option>
                                <option value="+251" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+251') ? 'selected' : ''; ?>>+251 (Ethiopia)</option>
                                <option value="+252" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+252') ? 'selected' : ''; ?>>+252 (Somalia)</option>
                                <option value="+253" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+253') ? 'selected' : ''; ?>>+253 (Djibouti)</option>
                                <option value="+254" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+254') ? 'selected' : ''; ?>>+254 (Kenya)</option>
                                <option value="+255" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+255') ? 'selected' : ''; ?>>+255 (Tanzania)</option>
                                <option value="+256" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+256') ? 'selected' : ''; ?>>+256 (Uganda)</option>
                                <option value="+257" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+257') ? 'selected' : ''; ?>>+257 (Burundi)</option>
                                <option value="+258" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+258') ? 'selected' : ''; ?>>+258 (Mozambique)</option>
                                <option value="+260" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+260') ? 'selected' : ''; ?>>+260 (Zambia)</option>
                                <option value="+261" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+261') ? 'selected' : ''; ?>>+261 (Madagascar)</option>
                                <option value="+263" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+263') ? 'selected' : ''; ?>>+263 (Zimbabwe)</option>
                                <option value="+264" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+264') ? 'selected' : ''; ?>>+264 (Namibia)</option>
                                <option value="+265" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+265') ? 'selected' : ''; ?>>+265 (Malawi)</option>
                                <option value="+266" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+266') ? 'selected' : ''; ?>>+266 (Lesotho)</option>
                                <option value="+267" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+267') ? 'selected' : ''; ?>>+267 (Botswana)</option>
                                <option value="+268" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+268') ? 'selected' : ''; ?>>+268 (Eswatini)</option>
                                <option value="+269" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+269') ? 'selected' : ''; ?>>+269 (Comoros)</option>
                                <option value="+290" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+290') ? 'selected' : ''; ?>>+290 (Saint Helena)</option>
                                <option value="+298" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+298') ? 'selected' : ''; ?>>+298 (Faroe Islands)</option>
                                <option value="+299" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+299') ? 'selected' : ''; ?>>+299 (Greenland)</option>
                                <option value="+350" <?= (isset($w_customer['c_code']) && $w_customer['c_code'] == '+350') ? 'selected' : ''; ?>>+350 (Gibraltar)</option>     
                            </select>
                            
                            <!-- Phone Number Input -->
                            <input type="tel" name="pNum" id="pNum" class="form-control" placeholder="Enter number"
                                value="<?= isset($w_customer['phone_number']) ? htmlspecialchars($w_customer['phone_number']) : ''; ?>" required />
                        </div>
                    </div>

                    <!-- Hidden input to store the combined phone value -->
                    <input type="hidden" name="phone" id="phone" value="<?= isset($w_customer['phone']) ? htmlspecialchars($w_customer['phone']) : ''; ?>" />


                    <div class="col-md-6 mb-4">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required value="<?= htmlspecialchars($w_customer['email'] ?? ''); ?>"class="form-control" required />
                        <span id="email-message" class="validation-message"></span> 
                    </div>
             
               

                    <div class="col-md-12 mb-4 text-end">
                        <button type="submit" name="save_w_cus" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
   

<script src="../../assets/form_validation.js"></script>
<link rel="stylesheet" href="../../assets/styles.css">


<?php include('includes/footer.php'); ?>
