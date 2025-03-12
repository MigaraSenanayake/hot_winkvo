

<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Register In-House Guest
                <a href="b_customer.php" class="btn btn-outline-danger float-end">Back</a>
            </h4>
        </div>

        <div class="card-body px-3 mt-2">
            <?php alertMessage(); ?>

            <form action="../code.php" method="POST" enctype="multipart/form-data">
                <?php 
                // error_reporting(E_ALL);
                // ini_set('display_errors', 1);

                // Check if the customer ID is passed in the URL
                
                if (isset($_GET['id'])) {
                    $b_cus_Id = trim($_GET['id']);
                    if (!empty($b_cus_Id)) {
                        $b_cus_Data = getById('bcustomers', $b_cus_Id);
                        if ($b_cus_Data && $b_cus_Data['status'] == 200) {
                            $b_customer = $b_cus_Data['data'];

                            
                           
                            
                        } else {
                            echo '<h5>' . htmlspecialchars($b_cus_Data['message']) . '</h5>';
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

                <input type="hidden" name="b_cus_Id" value="<?= htmlspecialchars($b_customer['id'] ?? ''); ?>">

                <div class="row">
                    <div class="col-md-2 mb-4">
                        <label for="title">Title *</label>
                        <select name="title" class="form-select" required>                            
                            <option <?= (isset($b_customer['title']) && $b_customer['title'] == 'Mr.') ? 'selected' : ''; ?>>Mr.</option>
                            <option <?= (isset($b_customer['title']) && $b_customer['title'] == 'Mrs.') ? 'selected' : ''; ?>>Mrs.</option>
                            <option <?= (isset($b_customer['title']) && $b_customer['title'] == 'Rev.') ? 'selected' : ''; ?>>Rev.</option>
                        </select>
                    </div>

                    <div class="col-md-10 mb-4">
                        <label for="fname">First Name *</label>
                        <input type="text" name="fname" value="<?= htmlspecialchars($b_customer['fname'] ?? ''); ?>" required class="form-control" />
                    </div>
                    <div class="col-md-12 mb-4">
                        <label for="lname">Family/Surname *</label>
                        <input type="text" name="lname" value="<?= htmlspecialchars($b_customer['lname'] ?? ''); ?>" required class="form-control" />
                    </div>
                    
                    <div class="col-md-12 mb-4">   
                        <label for="bname">Billing Name (For Co-operate Client) *</label>
                        <input type="text" name="bname" value="<?= htmlspecialchars($b_customer['bname'] ?? ''); ?>"  class="form-control" placeholder="If Need Only"/>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="arrival-date">Arrival Date *</label>
                        <input type="date" name="arrival" required class="form-control" />
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="departure-date">Departure Date *</label>
                        <input type="date" id="departure-date" name="departure" required class="form-control" />
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="r_num">Number of Rooms *</label>
                        <input type="number" name="r_num" required class="form-control" min="1"/>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="room_pack[]">Room Packages *</label>
                        <select name="room_pack[]" class="form-select js-mySelect2" multiple required>                        
                        <?php
                            $name = getAll('room_cat');
                            if ($name && mysqli_num_rows($name) > 0) {
                                foreach ($name as $nameItems) {
                                    echo '<option value="'.$nameItems['id'].'">'.$nameItems['id'].' - '.$nameItems['cat_code'].'</option>';
                                }
                            } else {
                                echo '<option value="">Packages Not Found</option>';
                            }
                        ?>
                        </select>    
                    </div> 

                    <div class="col-md-6 mb-4">
                        <label for="room[]">Room Numbers *</label>
                        <select name="room[]" class="form-select js-mySelect2" multiple required>                        
                        <?php
                            $name = getAll('room');
                            if ($name && mysqli_num_rows($name) > 0) {
                                foreach ($name as $nameItems) {
                                    echo '<option value="'.$nameItems['room_no'].'">'.$nameItems['room_no'].'</option>';
                                }
                            } else {
                                echo '<option value="">Rooms Not Found</option>';
                            }
                        ?>
                        </select>    
                    </div> 
                    
                    <div class="col-md-4 mb-4">
                        <label for="a_count">Adults *</label>
                        <input type="number" name="a_count" required class="form-control" min="1" />
                    </div>

                    <div class="col-md-4 mb-4">
                        <label for="c_count_s">Children (Below 6 years) *</label>
                        <input type="number" name="c_count_s" class="form-control" min="0"/>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="c_count_b">Children (Between 6 - 12) *</label>
                        <input type="number" name="c_count_b" class="form-control" min="0"/>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($b_customer['email'] ?? ''); ?>"class="form-control" required />
                        <span id="email-message" class="validation-message"></span> 
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="phone">Contact Number *</label>
                        <div class="input-group">
                            <!-- Country Code Dropdown -->
                            <select name="c_code" id="c_code" class="form-select" style="max-width: 120px;" required>
                                <option value="+1" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+1') ? 'selected' : ''; ?>>+1 (USA)</option>
                                <option value="+7" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+7') ? 'selected' : ''; ?>>+7 (Russia)</option>
                                <option value="+20" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+20') ? 'selected' : ''; ?>>+20 (Egypt)</option>
                                <option value="+27" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+27') ? 'selected' : ''; ?>>+27 (South Africa)</option>
                                <option value="+30" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+30') ? 'selected' : ''; ?>>+30 (Greece)</option>
                                <option value="+31" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+31') ? 'selected' : ''; ?>>+31 (Netherlands)</option>
                                <option value="+32" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+32') ? 'selected' : ''; ?>>+32 (Belgium)</option>
                                <option value="+33" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+33') ? 'selected' : ''; ?>>+33 (France)</option>
                                <option value="+34" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+34') ? 'selected' : ''; ?>>+34 (Spain)</option>
                                <option value="+36" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+36') ? 'selected' : ''; ?>>+36 (Hungary)</option>
                                <option value="+39" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+39') ? 'selected' : ''; ?>>+39 (Italy)</option>
                                <option value="+40" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+40') ? 'selected' : ''; ?>>+40 (Romania)</option>
                                <option value="+41" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+41') ? 'selected' : ''; ?>>+41 (Switzerland)</option>
                                <option value="+43" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+43') ? 'selected' : ''; ?>>+43 (Austria)</option>
                                <option value="+44" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+44') ? 'selected' : ''; ?>>+44 (United Kingdom)</option>
                                <option value="+45" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+45') ? 'selected' : ''; ?>>+45 (Denmark)</option>
                                <option value="+46" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+46') ? 'selected' : ''; ?>>+46 (Sweden)</option>
                                <option value="+47" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+47') ? 'selected' : ''; ?>>+47 (Norway)</option>
                                <option value="+48" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+48') ? 'selected' : ''; ?>>+48 (Poland)</option>
                                <option value="+49" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+49') ? 'selected' : ''; ?>>+49 (Germany)</option>
                                <option value="+51" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+51') ? 'selected' : ''; ?>>+51 (Peru)</option>
                                <option value="+52" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+52') ? 'selected' : ''; ?>>+52 (Mexico)</option>
                                <option value="+53" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+53') ? 'selected' : ''; ?>>+53 (Cuba)</option>
                                <option value="+54" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+54') ? 'selected' : ''; ?>>+54 (Argentina)</option>
                                <option value="+55" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+55') ? 'selected' : ''; ?>>+55 (Brazil)</option>
                                <option value="+56" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+56') ? 'selected' : ''; ?>>+56 (Chile)</option>
                                <option value="+57" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+57') ? 'selected' : ''; ?>>+57 (Colombia)</option>
                                <option value="+58" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+58') ? 'selected' : ''; ?>>+58 (Venezuela)</option>
                                <option value="+60" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+60') ? 'selected' : ''; ?>>+60 (Malaysia)</option>
                                <option value="+61" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+61') ? 'selected' : ''; ?>>+61 (Australia)</option>
                                <option value="+62" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+62') ? 'selected' : ''; ?>>+62 (Indonesia)</option>
                                <option value="+63" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+63') ? 'selected' : ''; ?>>+63 (Philippines)</option>
                                <option value="+64" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+64') ? 'selected' : ''; ?>>+64 (New Zealand)</option>
                                <option value="+65" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+65') ? 'selected' : ''; ?>>+65 (Singapore)</option>
                                <option value="+66" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+66') ? 'selected' : ''; ?>>+66 (Thailand)</option>
                                <option value="+81" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+81') ? 'selected' : ''; ?>>+81 (Japan)</option>
                                <option value="+82" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+82') ? 'selected' : ''; ?>>+82 (South Korea)</option>
                                <option value="+84" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+84') ? 'selected' : ''; ?>>+84 (Vietnam)</option>
                                <option value="+86" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+86') ? 'selected' : ''; ?>>+86 (China)</option>
                                <option value="+90" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+90') ? 'selected' : ''; ?>>+90 (Turkey)</option>
                                <option value="+91" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+91') ? 'selected' : ''; ?>>+91 (India)</option>
                                <option value="+92" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+92') ? 'selected' : ''; ?>>+92 (Pakistan)</option>
                                <option value="+93" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+93') ? 'selected' : ''; ?>>+93 (Afghanistan)</option>
                                <option value="+94" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+94') ? 'selected' : ''; ?>>+94 (Sri Lanka)</option>
                                <option value="+95" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+95') ? 'selected' : ''; ?>>+95 (Myanmar)</option>
                                <option value="+98" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+98') ? 'selected' : ''; ?>>+98 (Iran)</option>
                                <option value="+211" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+211') ? 'selected' : ''; ?>>+211 (South Sudan)</option>
                                <option value="+212" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+212') ? 'selected' : ''; ?>>+212 (Morocco)</option>
                                <option value="+213" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+213') ? 'selected' : ''; ?>>+213 (Algeria)</option>
                                <option value="+216" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+216') ? 'selected' : ''; ?>>+216 (Tunisia)</option>
                                <option value="+218" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+218') ? 'selected' : ''; ?>>+218 (Libya)</option>
                                <option value="+220" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+220') ? 'selected' : ''; ?>>+220 (Gambia)</option>
                                <option value="+221" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+221') ? 'selected' : ''; ?>>+221 (Senegal)</option>
                                <option value="+222" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+222') ? 'selected' : ''; ?>>+222 (Mauritania)</option>
                                <option value="+223" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+223') ? 'selected' : ''; ?>>+223 (Mali)</option>
                                <option value="+224" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+224') ? 'selected' : ''; ?>>+224 (Guinea)</option>
                                <option value="+225" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+225') ? 'selected' : ''; ?>>+225 (Ivory Coast)</option>
                                <option value="+226" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+226') ? 'selected' : ''; ?>>+226 (Burkina Faso)</option>
                                <option value="+227" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+227') ? 'selected' : ''; ?>>+227 (Niger)</option>
                                <option value="+228" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+228') ? 'selected' : ''; ?>>+228 (Togo)</option>
                                <option value="+229" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+229') ? 'selected' : ''; ?>>+229 (Benin)</option>
                                <option value="+230" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+230') ? 'selected' : ''; ?>>+230 (Mauritius)</option>
                                <option value="+231" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+231') ? 'selected' : ''; ?>>+231 (Liberia)</option>
                                <option value="+232" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+232') ? 'selected' : ''; ?>>+232 (Sierra Leone)</option>
                                <option value="+233" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+233') ? 'selected' : ''; ?>>+233 (Ghana)</option>
                                <option value="+234" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+234') ? 'selected' : ''; ?>>+234 (Nigeria)</option>
                                <option value="+235" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+235') ? 'selected' : ''; ?>>+235 (Chad)</option>
                                <option value="+236" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+236') ? 'selected' : ''; ?>>+236 (Central African Republic)</option>
                                <option value="+237" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+237') ? 'selected' : ''; ?>>+237 (Cameroon)</option>
                                <option value="+238" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+238') ? 'selected' : ''; ?>>+238 (Cape Verde)</option>
                                <option value="+239" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+239') ? 'selected' : ''; ?>>+239 (Sao Tome and Principe)</option>
                                <option value="+240" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+240') ? 'selected' : ''; ?>>+240 (Equatorial Guinea)</option>
                                <option value="+241" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+241') ? 'selected' : ''; ?>>+241 (Gabon)</option>
                                <option value="+242" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+242') ? 'selected' : ''; ?>>+242 (Congo-Brazzaville)</option>
                                <option value="+243" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+243') ? 'selected' : ''; ?>>+243 (Congo-Kinshasa)</option>
                                <option value="+244" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+244') ? 'selected' : ''; ?>>+244 (Angola)</option>
                                <option value="+245" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+245') ? 'selected' : ''; ?>>+245 (Guinea-Bissau)</option>
                                <option value="+246" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+246') ? 'selected' : ''; ?>>+246 (British Indian Ocean Territory)</option>
                                <option value="+248" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+248') ? 'selected' : ''; ?>>+248 (Seychelles)</option>
                                <option value="+249" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+249') ? 'selected' : ''; ?>>+249 (Sudan)</option>
                                <option value="+250" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+250') ? 'selected' : ''; ?>>+250 (Rwanda)</option>
                                <option value="+251" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+251') ? 'selected' : ''; ?>>+251 (Ethiopia)</option>
                                <option value="+252" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+252') ? 'selected' : ''; ?>>+252 (Somalia)</option>
                                <option value="+253" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+253') ? 'selected' : ''; ?>>+253 (Djibouti)</option>
                                <option value="+254" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+254') ? 'selected' : ''; ?>>+254 (Kenya)</option>
                                <option value="+255" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+255') ? 'selected' : ''; ?>>+255 (Tanzania)</option>
                                <option value="+256" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+256') ? 'selected' : ''; ?>>+256 (Uganda)</option>
                                <option value="+257" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+257') ? 'selected' : ''; ?>>+257 (Burundi)</option>
                                <option value="+258" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+258') ? 'selected' : ''; ?>>+258 (Mozambique)</option>
                                <option value="+260" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+260') ? 'selected' : ''; ?>>+260 (Zambia)</option>
                                <option value="+261" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+261') ? 'selected' : ''; ?>>+261 (Madagascar)</option>
                                <option value="+263" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+263') ? 'selected' : ''; ?>>+263 (Zimbabwe)</option>
                                <option value="+264" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+264') ? 'selected' : ''; ?>>+264 (Namibia)</option>
                                <option value="+265" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+265') ? 'selected' : ''; ?>>+265 (Malawi)</option>
                                <option value="+266" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+266') ? 'selected' : ''; ?>>+266 (Lesotho)</option>
                                <option value="+267" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+267') ? 'selected' : ''; ?>>+267 (Botswana)</option>
                                <option value="+268" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+268') ? 'selected' : ''; ?>>+268 (Eswatini)</option>
                                <option value="+269" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+269') ? 'selected' : ''; ?>>+269 (Comoros)</option>
                                <option value="+290" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+290') ? 'selected' : ''; ?>>+290 (Saint Helena)</option>
                                <option value="+298" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+298') ? 'selected' : ''; ?>>+298 (Faroe Islands)</option>
                                <option value="+299" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+299') ? 'selected' : ''; ?>>+299 (Greenland)</option>
                                <option value="+350" <?= (isset($b_customer['country_code']) && $b_customer['country_code'] == '+350') ? 'selected' : ''; ?>>+350 (Gibraltar)</option>     
                            </select>
                            
                            <!-- Phone Number Input -->
                            <input type="tel" name="pNum" id="pNum" class="form-control" placeholder="Enter number"
                                value="<?= isset($b_customer['pNum']) ? htmlspecialchars($b_customer['pNum']) : ''; ?>" required />
                        </div>
                    </div>

                    <!-- Hidden input to store the combined phone value -->
                    <input type="hidden" name="phone" id="phone" value="<?= isset($b_customer['phone']) ? htmlspecialchars($b_customer['phone']) : ''; ?>" />


                    <div class="col-md-2 mb-4">
                        <label for="address_type">Address Type *</label>
                        <div>
                            <input type="radio" name="address_type" value="private" <?= (isset($b_customer['address_type']) && $b_customer['address_type'] == 'private') ? 'checked' : ''; ?> style="width:20px;height:20px;" />
                            <label>Private</label>
                        </div>
                        <div>
                            <input type="radio" name="address_type" value="business" <?= (isset($b_customer['address_type']) && $b_customer['address_type'] == 'business') ? 'checked' : ''; ?> style="width:20px;height:20px;" />
                            <label>Business</label>
                        </div>
                    </div>

                    <!-- Updated Address Fields -->
                        <div class="col-md-4 mb-4">
                            <label for="street">Street *</label>
                            <input type="text" id="street" name="street" value="<?= htmlspecialchars($b_customer['street'] ?? ''); ?>"  class="form-control" />
                        </div>

                        <div class="col-md-3 mb-4">
                            <label for="state_pc">State/Postal Code *</label>
                            <input type="text" id="state_pc" name="state_pc" value="<?= htmlspecialchars($b_customer['state_pc'] ?? ''); ?>"  class="form-control" />
                        </div>

                        <div class="col-md-3 mb-4">
                            <label for="city">City *</label>
                            <input type="text" id="city" name="city" value="<?= htmlspecialchars($b_customer['city'] ?? ''); ?>"  class="form-control" />
                        </div>      


                    <div class="col-md-4 mb-4">
                        <label for="dob">Date of Birth *</label>
                        <input type="date" id="dob" name="dob" value="<?= htmlspecialchars($b_customer['dob'] ?? ''); ?>"  class="form-control" />
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="nation">Nationality *</label>
                        <input type="text" name="nation" value="<?= htmlspecialchars($b_customer['nationality'] ?? ''); ?>"  class="form-control" />
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="nic_pp">NIC/Passport Number *</label>
                        <input type="text" name="nic_pp" value="<?= htmlspecialchars($b_customer['nic_pp'] ?? ''); ?>"  class="form-control" />
                    </div>

                    <div class="col-md-4 mb-4">
                        <label for="issue-date">Issue Date *</label>
                        <input type="date" id="issue-date" name="issue_date" value="<?= htmlspecialchars($b_customer['issue_date'] ?? ''); ?>"  class="form-control" />
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="issue_place">Place of Issue *</label>
                        <input type="text" name="issue_place" value="<?= htmlspecialchars($b_customer['issue_place'] ?? ''); ?>"  class="form-control" />
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="exp-date">Expiry Date *</label>
                        <input type="date" id="exp-date" name="exp_date" value="<?= htmlspecialchars($b_customer['exp_date'] ?? ''); ?>"  class="form-control" />
                    </div>

                     <!-- Image uploadfield -->
                    <div class="col-md-6 mb-4">
                        <label for="photo">Image of NIC or Passport *</label>
                        <input type="hidden" name="existing_photo" value="<?= htmlspecialchars($b_customer['photo']); ?>" />
                        <?php if (!empty($b_customer['photo']) && file_exists("../uploads/" . $b_customer['photo'])): ?>
                            <p>Current File: <a href="../uploads/<?= htmlspecialchars($b_customer['photo']); ?>" target="_blank">View Uploaded File</a></p>
                        <?php else: ?>
                            <p>No file uploaded.</p>
                        <?php endif; ?>

                        <input type="file" name="photo" class="form-control" />
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="visa_photo">Image of Visa Page (If Need) *</label>
                        <input type="hidden" name="existing_visa_photo" value="<?= htmlspecialchars($b_customer['visa_photo']); ?>" />
                        <?php if (!empty($b_customer['visa_photo']) && file_exists("../uploads/" . $b_customer['visa_photo'])): ?>
                            <p>Current File: <a href="../uploads/<?= htmlspecialchars($b_customer['visa_photo']); ?>" target="_blank">View Uploaded File</a></p>
                        <?php else: ?>
                            <p>No file uploaded.</p>
                        <?php endif; ?>

                        <input type="file" name="visa_photo" class="form-control" />
                    </div>


                    <div class="col-md-4 mb-4"> 
                        <label for="booking">Booking Details *</label>
                        <input type="text" name="booking" value="<?= htmlspecialchars($b_customer['booking'] ?? ''); ?>"  class="form-control"/>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="advance">Advanced Payment *</label>
                        <input type="text" name="advance" class="form-control" />
                    </div>
                    <div class="col-md-12 mb-4">
                        <label for="special">Remarks *</label>
                        <input type="text" name="special" value="<?= htmlspecialchars($b_customer['special'] ?? ''); ?>"  class="form-control"/>
                    </div>          
                </div>

                <div class="col-md-12 mb-4">
                    <h5>Terms and Conditions</h5>
                    <p>
                        By Registering, You Agree to the Following Terms and Conditions:
                        <ul>
                            <li>Check-in Time is From 14:00 and Checkout Time is Until 11:00.</li>
                            <li>The Guest Acknowledges Joint and Several Liability for All Services Rendered Until Full Settlement of Bills.</li>
                            <li>Regardless of Charge Instruction, I Acknowledge that I am Personally Liable for the Payment of All Charges Incurred by Me During My Stay at Subaseth Villa.</li>
                            <li>By Agreeing to this Form, I Consent to the Use of My Personal Information for the Purpose Described.</li>
                        </ul>
                    </p>
                    <div>
                        <input type="checkbox" id="terms" name="terms" style="height: 30px; width: 30px; margin-right:15px" />
                        <label for="terms">I have read and agree to the terms and conditions.</label>
                    </div>

                    <!-- Signature Canvas (Initially Hidden) -->
                    <div id="signature-section" style="display: none; margin-top: 20px;">
                        <label for="signature">Customer's Digital Signature:</label>
                        <canvas id="signature-pad" style="border: 1px solid #ccc; width: 100%; height: 200px;"></canvas>
                        <div class="mt-2">
                            <button type="button" id="clear-signature" class="btn btn-danger">Clear</button>
                            <button type="button" id="ok-signature" class="btn btn-success">OK</button>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 mb-3">
                    <div class="col-md-12">
                        <button type="submit" id="submit-btn" name="save_B_Cus" class="btn btn-success float-end" disabled>Register</button>
                    </div>
                </div>



                
            </form>
        </div>
    </div>
</div>
<script src="../../assets/form_validation.js"></script>
<link rel="stylesheet" href="../../assets/styles.css">


<?php include('includes/footer.php'); ?>


<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>

<script>
    const termsCheckbox = document.getElementById('terms');
    const signatureSection = document.getElementById('signature-section');
    const canvas = document.getElementById('signature-pad');
    const clearButton = document.getElementById('clear-signature');
    const okButton = document.getElementById('ok-signature');
    const submitButton = document.getElementById('submit-btn');

    let signaturePad;

    // Toggle signature section visibility
    termsCheckbox.addEventListener('change', function () {
        if (this.checked) {
            signatureSection.style.display = 'block';
            // Ensure canvas dimensions are correct when visible
            canvas.width = canvas.offsetWidth;
            canvas.height = 200;
            signaturePad = new SignaturePad(canvas);
            submitButton.disabled = true;
        } else {
            signatureSection.style.display = 'none';
            if (signaturePad) signaturePad.clear();
            submitButton.disabled = true;
        }
    });

    // Clear signature button
    clearButton.addEventListener('click', function () {
        if (signaturePad) signaturePad.clear();
    });

    // OK button to validate signature
    okButton.addEventListener('click', function () {
        if (signaturePad && !signaturePad.isEmpty()) {
            swal('Success','Signature accepted!','success');
            submitButton.disabled = false;
        } else {
            swal('Error','Please provide your digital signature.','error');
        }
    });

</script>




