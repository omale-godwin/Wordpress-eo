<!-- STEP 2 -->
          <fieldset data-step="2" class="step" style="display:none;border:0;padding:0;margin:0">
            <div class="row">
              <div class="form-input-block">
                <label for="industry">Industry <span style="color:#ff6b6b">*</span></label>
                <div class="select-wrap">
                  <select id="industry" name="industry" class="t-form-input" required>
                    <option value="">Please Select</option>
                    <option>Telecom</option>
                    <option>Manufacturing</option>
                    <option>Energy</option>
                    <option>Finance</option>
                    <option>Logistics(3PL) </option>
                    <option>Technology</option>
                    <option>Healthcare</option>
                    <option>Agriculture</option>
                    <option>Defence & Space  </option>
                    <option>Textile </option>
                    <option>Mining </option>
                  </select>
                </div>
                <div class="errors" data-error-for="industry"></div>
              </div>
            </div>

            <div class="row">
              <div class="form-input-block">
                <label for="company">Company / Organisation <span style="color:#ff6b6b">*</span></label>
                <input id="company" name="company" class="t-form-input" required placeholder="Enter company/organisation name">
                <div class="errors" data-error-for="company"></div>
              </div>
            </div>

            <div class="row">
              <div class="form-input-block">
                <label for="website">Company Website <span style="color:#ff6b6b">*</span></label>
                <input id="website" name="website" type="url" class="t-form-input" placeholder="www.example.com" required>
                <div class="errors" data-error-for="website"></div>
              </div>
            </div>
            <div class="row">
              <div class="form-input-block">
                <label for="revenue">Company yearly revenue? <span style="color:#ff6b6b">*</span></label>
                  <div class="select-wrap">
                    <select id="revenue" name="revenue" class="t-form-input" required>
                      <option value="">Please Select</option>
                      <option>Less than $2M</option>
                      <option>$2M-$50M</option>
                      <option>$50M - $250M</option>
                      <option>$250M- $500M</option>
                      <option>$50-$1B</option>
                      <option>$1B+</option>
                    </select>
                  </div>
                  <div class="errors" data-error-for="revenue"></div>
                </div>
            </div>
            <div class="row">
              <?php
                $countries_states = require get_template_directory() . '/inc/countries-states.php';
                ?>
                <div class="form-input-block">
                  <label for="country">Country <span style="color:#ff6b6b">*</span></label>
                  <div class="select-wrap">
                    <select id="country" name="country" class="t-form-input" required>
                      <option value="">Please Select</option>
                      <?php foreach ($countries_states as $country => $states): ?>
                        <option value="<?php echo esc_attr($country); ?>">
                          <?php echo esc_html($country); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                    </div>      
                    <div class="errors" data-error-for="country"></div>
                 </div>
            </div>

            <div class="row">
              <div class="form-input-block">
                <label for="state">State/Province/Region <span style="color:#ff6b6b">*</span></label>
                <div class="select-wrap">
                  <select id="state" name="state" class="t-form-input" required>
                    <option value="">Please Select</option>
                  </select>

                </div>
                <div class="errors" data-error-for="state"></div>
              </div>
            </div>

          </fieldset>