<?php

add_shortcode('tk-event-registration-popup', 'tkEventRegistrationPopup');
function tkEventRegistrationPopup()
{
    return '
        <div class="tk-popup-overlay"></div> 
        <div class="tk-popup">
          <h2>Popup Content</h2>
          <label for="tk-email-input">Email:</label>
          <input type="email" id="tk-email-input" name="email">
          <button id="tkEventRegistrationFormBtn">Anmedlen</button>
          <div class="tk-validation-message"></div>
          <button class="tk-close-popup">X</button>
        </div>
    ';
}