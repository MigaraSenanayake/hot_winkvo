
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
                <div class="row">
                    <div class="col-md-2 mb-4">
                        <label for="title">Title *</label>
                        <select name="title" class="form-select" required>
                            <option value="" disabled selected>Select Title</option>    
                            <option>Mr.</option>
                            <option>Mrs.</option>
                            <option>Rev.</option>                            
                        </select>
                    </div>                   
                    <div class="col-md-10 mb-4">
                        <label for="fname">First Name *</label>
                        <input type="text" name="fname" required class="form-control" />
                    </div>
                    <div class="col-md-12 mb-4">
                        <label for="lname">Family/Surname *</label>
                        <input type="text" name="lname" required class="form-control" />
                    </div>
                    <div class="col-md-12 mb-4">
                        <label for="bname">Billing Name (For Corporate Client) *</label>
                        <input type="text" name="bname" class="form-control" placeholder="If Needed Only" />
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="arrival-date">Arrival Date *</label>
                        <input type="date" id="arrival-date" name="arrival" required class="form-control" />
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="departure-date">Departure Date *</label>
                        <input type="date" id="departure-date" name="departure" required class="form-control" />
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="r_num">Number of Rooms *</label>
                        <input type="number" name="r_num" required class="form-control" min="1" />
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
                        <input type="number" name="a_count" required class="form-control" min="1"/>
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
                        <input type="email" id="email" name="email" class="form-control" required />
                        <span id="email-message" class="validation-message"></span> 
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="phone">Contact Number *</label>
                        <div class="input-group">
                            <!-- Country Code Dropdown -->
                            <select name="c_code" id="c_code" class="form-select" style="max-width: 120px;" required>
                                <option value="+1">+1 (USA)</option>
                                <option value="+7">+7 (Russia)</option>
                                <option value="+20">+20 (Egypt)</option>
                                <option value="+27">+27 (South Africa)</option>
                                <option value="+30">+30 (Greece)</option>
                                <option value="+31">+31 (Netherlands)</option>
                                <option value="+32">+32 (Belgium)</option>
                                <option value="+33">+33 (France)</option>
                                <option value="+34">+34 (Spain)</option>
                                <option value="+36">+36 (Hungary)</option>
                                <option value="+39">+39 (Italy)</option>
                                <option value="+40">+40 (Romania)</option>
                                <option value="+41">+41 (Switzerland)</option>
                                <option value="+43">+43 (Austria)</option>
                                <option value="+44">+44 (United Kingdom)</option>
                                <option value="+45">+45 (Denmark)</option>
                                <option value="+46">+46 (Sweden)</option>
                                <option value="+47">+47 (Norway)</option>
                                <option value="+48">+48 (Poland)</option>
                                <option value="+49">+49 (Germany)</option>
                                <option value="+51">+51 (Peru)</option>
                                <option value="+52">+52 (Mexico)</option>
                                <option value="+53">+53 (Cuba)</option>
                                <option value="+54">+54 (Argentina)</option>
                                <option value="+55">+55 (Brazil)</option>
                                <option value="+56">+56 (Chile)</option>
                                <option value="+57">+57 (Colombia)</option>
                                <option value="+58">+58 (Venezuela)</option>
                                <option value="+60">+60 (Malaysia)</option>
                                <option value="+61">+61 (Australia)</option>
                                <option value="+62">+62 (Indonesia)</option>
                                <option value="+63">+63 (Philippines)</option>
                                <option value="+64">+64 (New Zealand)</option>
                                <option value="+65">+65 (Singapore)</option>
                                <option value="+66">+66 (Thailand)</option>
                                <option value="+81">+81 (Japan)</option>
                                <option value="+82">+82 (South Korea)</option>
                                <option value="+84">+84 (Vietnam)</option>
                                <option value="+86">+86 (China)</option>
                                <option value="+90">+90 (Turkey)</option>
                                <option value="+91">+91 (India)</option>
                                <option value="+92">+92 (Pakistan)</option>
                                <option value="+93">+93 (Afghanistan)</option>
                                <option value="+94" selected>+94 (Sri Lanka)</option>
                                <option value="+95">+95 (Myanmar)</option>
                                <option value="+98">+98 (Iran)</option>
                                <option value="+211">+211 (South Sudan)</option>
                                <option value="+212">+212 (Morocco)</option>
                                <option value="+213">+213 (Algeria)</option>
                                <option value="+216">+216 (Tunisia)</option>
                                <option value="+218">+218 (Libya)</option>
                                <option value="+220">+220 (Gambia)</option>
                                <option value="+221">+221 (Senegal)</option>
                                <option value="+222">+222 (Mauritania)</option>
                                <option value="+223">+223 (Mali)</option>
                                <option value="+224">+224 (Guinea)</option>
                                <option value="+225">+225 (Ivory Coast)</option>
                                <option value="+226">+226 (Burkina Faso)</option>
                                <option value="+227">+227 (Niger)</option>
                                <option value="+228">+228 (Togo)</option>
                                <option value="+229">+229 (Benin)</option>
                                <option value="+230">+230 (Mauritius)</option>
                                <option value="+231">+231 (Liberia)</option>
                                <option value="+232">+232 (Sierra Leone)</option>
                                <option value="+233">+233 (Ghana)</option>
                                <option value="+234">+234 (Nigeria)</option>
                                <option value="+235">+235 (Chad)</option>
                                <option value="+236">+236 (Central African Republic)</option>
                                <option value="+237">+237 (Cameroon)</option>
                                <option value="+238">+238 (Cape Verde)</option>
                                <option value="+239">+239 (Sao Tome and Principe)</option>
                                <option value="+240">+240 (Equatorial Guinea)</option>
                                <option value="+241">+241 (Gabon)</option>
                                <option value="+242">+242 (Congo-Brazzaville)</option>
                                <option value="+243">+243 (Congo-Kinshasa)</option>
                                <option value="+244">+244 (Angola)</option>
                                <option value="+245">+245 (Guinea-Bissau)</option>
                                <option value="+246">+246 (British Indian Ocean Territory)</option>
                                <option value="+248">+248 (Seychelles)</option>
                                <option value="+249">+249 (Sudan)</option>
                                <option value="+250">+250 (Rwanda)</option>
                                <option value="+251">+251 (Ethiopia)</option>
                                <option value="+252">+252 (Somalia)</option>
                                <option value="+253">+253 (Djibouti)</option>
                                <option value="+254">+254 (Kenya)</option>
                                <option value="+255">+255 (Tanzania)</option>
                                <option value="+256">+256 (Uganda)</option>
                                <option value="+257">+257 (Burundi)</option>
                                <option value="+258">+258 (Mozambique)</option>
                                <option value="+260">+260 (Zambia)</option>
                                <option value="+261">+261 (Madagascar)</option>
                                <option value="+263">+263 (Zimbabwe)</option>
                                <option value="+264">+264 (Namibia)</option>
                                <option value="+265">+265 (Malawi)</option>
                                <option value="+266">+266 (Lesotho)</option>
                                <option value="+267">+267 (Botswana)</option>
                                <option value="+268">+268 (Eswatini)</option>
                                <option value="+269">+269 (Comoros)</option>
                                <option value="+290">+290 (Saint Helena)</option>
                                <option value="+298">+298 (Faroe Islands)</option>
                                <option value="+299">+299 (Greenland)</option>
                                <option value="+350">+350 (Gibraltar)</option>                                
                            </select>
                            
                            <!-- Phone Number Input -->
                            <input type="tel" name="pNum" id="pNum" required class="form-control" placeholder="Enter number" />
                        </div>
                    </div>

                    

                    <input type="hidden" name="phone" id="phone" />


                 
                    <div class="col-md-2 mb-4">
                        <label for="address_type">Address Type *</label>
                        <div>
                            <input type="radio" name="address_type" value="private" style="width:20px;height:20px;" />
                            <label for="private">Private</label>
                        </div>
                        <div>
                            <input type="radio" name="address_type" value="business" style="width:20px;height:20px;" />
                            <label for="business">Business</label>
                        </div>                        
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="street">Street *</label>
                        <input type="text" name="street" class="form-control" placeholder="If Needed Only" />
                    </div>  
                    <div class="col-md-3 mb-4">
                        <label for="state_pc">State/Postal Code *</label>
                        <input type="text" name="state_pc" class="form-control" placeholder="If Needed Only" />
                    </div>  
                    <div class="col-md-3 mb-4">
                        <label for="city">City *</label>
                        <input type="text" name="city" class="form-control" placeholder="If Needed Only" />
                    </div>  
                    <div class="col-md-4 mb-4">
                        <label for="dob">Date of Birth *</label>
                        <input type="date" id="dob" name="dob" required class="form-control" />
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="nation">Nationality *</label>
                        <input type="text" name="nation" class="form-control" placeholder="If Needed Only"/>
                    </div>  
                    <div class="col-md-4 mb-4">
                        <label for="nic_pp">NIC or Passport Number *</label>
                        <input type="text" name="nic_pp" class="form-control" />
                    </div>                         
                    <div class="col-md-4 mb-4">
                        <label for="issue-date">Issued Date of NIC/Passport (If Needed) *</label>
                        <input type="date" id="issue-date" name="issue_date" class="form-control" />
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="issue_place">Place of Issue NIC/Passport  *</label>
                        <input type="text" name="issue_place" class="form-control" placeholder="If Needed Only"/>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="exp_date">Expiry Date of NIC/Passport (If Needed) *</label>
                        <input type="date" id="exp-date" name="exp_date" class="form-control" />
                    </div>  
                    <div class="col-md-6 mb-4">
                        <label for="photo">Image of NIC/Passport *</label>
                        <input type="file" name="photo" required class="form-control" />
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="visa_photo">Image of NIC/Visa Page (If Needed) *</label>
                        <input type="file" name="visa_photo" class="form-control" />
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="booking">Booking From *</label>
                        <input type="text" name="booking" required class="form-control" />
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="advance">Advanced Payment *</label>
                        <input type="text" name="advance" class="form-control" />
                    </div>
                    <div class="col-md-12 mb-4">
                        <label for="special">Remarks *</label>
                        <input type="text" name="special" class="form-control" placeholder="If Needed Only "/>
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
                        <label for="signature">Guest's Digital Signature:</label>
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






