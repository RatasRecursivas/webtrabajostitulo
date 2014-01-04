<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row">
    <hr>
    <form >
        <fieldset>
            <legend>Fieldset</legend>

            <div class="row">
                <div class="large-12 columns">
                    <label for="password">Password <small>required</small></label>
                    <input id="password" placeholder="LittleW0men." name="password" required="" type="password">
                    <small class="error">Passwords must be at least 8 characters with 1 capital letter, 1 number, and one special character.</small>
                </div>
                <div class="large-12 columns">
                    <label for="confirmPassword">Confirm Password <small>required</small></label>
                    <input id="confirmPassword" placeholder="LittleW0men." name="confirmPassword" required="" data-equalto="password" type="password">
                    <small class="error" data-error-message="">Passwords must match.</small>
                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <label for="phone">Phone</label>
                    <input id="phone" placeholder="1 234-567-8910" type="tel">
                    <small class="error">Please enter a properly formatted telephone number.</small>
                </div>
            </div>

            <div class="row">
                <div class="large-4 columns">
                    <label for="email">Email</label>
                    <input id="email" placeholder="foundation@zurb.com" type="email">
                    <small class="error">Valid email required.</small>
                </div>
                <div class="large-4 columns">
                    <label for="url">URL <small>required</small></label>
                    <input id="url" placeholder="http://zurb.com" required="" type="url">
                    <small class="error">Valid URL required.</small>
                </div>
                <div class="large-4 columns">
                    <div class="row collapse">
                        <label for="customDropdown1">Hardest to find in grocery <small>required</small></label>
                        <select id="customDropdown1" class="medium" required="">
                            <option value="">Select grocery item</option>
                            <option value="first">Green Chilies</option>
                            <option value="second">Raisins</option>
                            <option value="third">Panko bread crumbs</option>
                            <option value="fourth">Assistance</option>
                        </select>
                        <small class="error">Broke.</small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <hr>
                </div>
            </div>

            <div class="row">
                <div class="large-6 columns">
                    <label for="radio1"><input name="radioButtons" id="radio1" required="" type="radio"> Radio Button 1</label>
                    <label for="radio2"><input name="radioButtons" id="radio2" required="" type="radio"> Radio Button 2</label>
                    <label for="radio3"><input name="radioButtons" id="radio3" required="" type="radio"> Radio Button 3</label>
                </div>
                <div class="large-6 columns">
                    <label for="checkbox1"><input id="checkbox1" required="" type="checkbox"> Label for Checkbox</label>
                    <label for="checkbox2"><input id="checkbox2" checked="" required="" type="checkbox"> Label for Checkbox</label>
                    <label for="checkbox3"><input checked="" id="checkbox3" required="" type="checkbox"> Label for Checkbox</label>
                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <hr>
                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <label for="remarks">Closing Remarks</label>
                    <textarea id="remarks" name="remarks" placeholder="Leave your remarks here."></textarea>
                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <button type="submit" class="medium button green">Submit</button>
                </div>
            </div>

        </fieldset>
    </form>
</div>