<!-- STEP 3 -->
          <fieldset data-step="3" class="step" style="display:none;border:0;padding:0;margin:0">
            <div class="row mb-24">
              <label>What service(s) are you interested in? <span style="color:#ff6b6b">*</span></label>

              <div class="service-dropdown select-wrap" id="serviceDropdown">
                <div class="service-input" tabindex="0">
                  <span class="placeholder">Select services</span>
                  
                </div>

                <div class="service-panel">

                  <div class="group">
                    <div class="group-title">Marketing Services</div>

                    <label><input type="checkbox" name="service[]" value="Prospecting Consultancy"> Prospecting Consultancy</label>
                    <label><input type="checkbox" name="service[]" value="Social Media & Paid Advertising"> Social Media & Paid Advertising</label>
                    <label><input type="checkbox" name="service[]" value="Product Design & Development"> Product Design & Development</label>
                    <label><input type="checkbox" name="service[]" value="Tag Management Consultancy"> Tag Management Consultancy</label>
                    <label><input type="checkbox" name="service[]" value="Mobile APP Marketing"> Mobile APP Marketing</label>
                    <label><input type="checkbox" name="service[]" value="eCommerce Marketing"> eCommerce Marketing</label>
                    <label><input type="checkbox" name="service[]" value="SEO & Content Marketing"> SEO & Content Marketing</label>
                    <label><input type="checkbox" name="service[]" value="AI & Data Marketing Analytics"> AI & Data Marketing Analytics</label>
                    <label><input type="checkbox" name="service[]" value="Flagship Fundraising"> Flagship Fundraising</label>
                    <label><input type="checkbox" name="service[]" value="Martech Implementation & Enablement"> Martech Implementation & Enablement</label>
                    <label><input type="checkbox" name="service[]" value="Web3.0 Marketing"> Web3.0 Marketing</label>
                  </div>

                  <div class="group">
                    <div class="group-title">CRM Implementation</div>

                    <label><input type="checkbox" name="service[]" value="Dynamics 365 CE/CRM"> Dynamics 365 CE/CRM</label>
                    <label><input type="checkbox" name="service[]" value="Power Apps"> Power Apps</label>
                    <label><input type="checkbox" name="service[]" value="Power BI"> Power BI</label>
                    <label><input type="checkbox" name="service[]" value="Power Automate"> Power Automate</label>
                    <label><input type="checkbox" name="service[]" value="Salesforce Automation"> Salesforce Automation</label>
                    <label><input type="checkbox" name="service[]" value="Adobe Customer Journey Analytics"> Adobe Customer Journey Analytics</label>
                    <label><input type="checkbox" name="service[]" value="Adobe Experience Cloud"> Adobe Experience Cloud</label>
                    <label><input type="checkbox" name="service[]" value="Hubspot"> Hubspot</label>
                    <label><input type="checkbox" name="service[]" value="Other"> Other</label>
                  </div>

                </div>
              </div>

              <div class="errors" data-error-for="service"></div>
            </div>


            <div class="row">
              <div class="form-input-block">
                <label for="budget">What is your monthly marketing budget <span style="color:#ff6b6b">*</span></label>
                <div class="select-wrap">
                  <select id="budget" name="budget" class="t-form-input" required>
                    <option value="">Please Select</option>
                    <option value="lt_10k">Less than $10,000</option>
                    <option value="10k_50k">$10,000 - $50,000</option>
                    <option value="50k_100k">$50,000 - $100,000</option>
                    <option value="100k_150k">$100,000 - $150,000</option>
                    <option value="150k_250k">$150,000 - $250,000</option>
                    <option value="250k_plus">$250,000+</option>
                  </select>
                </div>

                <div class="errors" data-error-for="budget"></div>
              </div>
            </div>

            <div class="row">
              <div class="form-input-block">
                <label for="teamsize">What is your marketing & sales team size <span style="color:#ff6b6b">*</span></label>
                <div class="select-wrap">
                  <select id="teamsize" name="teamsize" class="t-form-input" required>
                    <option value="">Please Select</option>
                    <option>I don't have a marketing team</option>
                    <option>1 Person</option>
                    <option>2-5 Persons</option>
                    <option>6-10 People</option>
                    <option>10+ People</option>
                  </select>
                </div>
                <div class="errors" data-error-for="teamsize"></div>
              </div>
            </div>

            <div class="row">
              <div class="form-input-block">
                <label for="found">How did you find us</label>
                <div class="select-wrap">
                  <select id="found" name="found" class="t-form-input">
                    <option value="">Please Select</option>
                    <option>Search</option>
                    <option>Social Media</option>
                    <option>Uncensored CMO Podcast</option>
                    <option>Article/News story</option>
                    <option>Recommendation/Word of Mouth</option>
                    <option>Personal Experience</option>
                    <option>Other (Please specify)</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="accept-check">
                <input type="checkbox" id="dataConsent"> 
                <div>By submitting this form I agree that mikael kayanian  or its subcontractors will process my data to respond to my request in accordance with the <a href="#">Privacy Policy</a></div>

              <!-- <div class="errors" data-error-for="dataConsent"></div> -->
            </div>
            <p class="p-note">From time to time, we would like to contact you about our products and services, as well as other content that may be of interest to you. If you consent to us contacting you for this purpose, please tick below:</p>
            <div class="accept-check">
                <input type="checkbox" id="dataConsent"> 
                <div>I agree to receive other communications from mikael kayanian .</div>

              <!-- <div class="errors" data-error-for="dataConsent"></div> -->
            </div>
            <p class="p-note">You may unsubscribe from these communications at any time. For more information on how to unsubscribe, our privacy practices, and how we are committed to protecting and respecting your privacy, please review our <a href="#">Privacy Policy.</a></p>
          </fieldset>