<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Save Walk-In Guest Details
                <a href="w_customer.php" class="btn btn-outline-danger float-end">Back</a>
            </h4>
        </div>

        <div class="card_body px-3 mt-2">
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
                        <label for="name">Name *</label>
                        <input type="text" name="name" required class="form-control" />
                    </div>                     
                     <div class="col-md-12 mb-4">
                        <label for="bname">Billing Name (For Co-operate Guest) *</label>
                        <input type="text" name="bname" class="form-control" />
                    </div>
                    <div class="col-md-12 mb-4">
                        <label for="address">Address *</label>
                        <input type="text" name="address" required class="form-control" />
                    </div>     
                    <div class="col-md-6 mb-4">
                        <label for="nic_pp">NIC or Passport Number *</label>
                        <input type="text" name="nic_pp" required class="form-control" />
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



                    <div class="col-md-6 mb-4">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" class="form-control" required />
                        <span id="email-message" class="validation-message"></span> 
                    </div>
                    
                    

                    <div class="col-md-12 mb-4 text-end">
                        <button type="submit" name="save_w_cus" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../../assets/form_validation.js"></script>
<link rel="stylesheet" href="../../assets/styles.css">


<?php include('includes/footer.php'); ?>
