<?php

function tkSendConfirmationEmail($to,$eventName, $unregisterLink)
{
    $body =  '
    <div style="font-family: Arial, sans-serif; max-width: 70%; margin: 0 auto; background-color: #f2f2f2; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
      <div style="background-color: #007bff; padding: 20px; text-align: center;">
        <h1 style="color: #fff; font-size: 36px; margin: 0;">Erfolgreich registriert</h1>
      </div>
      <div style="background-color: #fff; padding: 5% 17%;">
        <p style="font-size: 20px; line-height: 1.5; color: #333; margin: 0;">Sie haben sich für ' . $eventName .' erfolgreich registriert.</p>
        <p style="font-size: 20px; line-height: 1.5; color: #555; margin-top: 20px;">Wenn Sie sich abmelden wollen, können Sie <a href="'. $unregisterLink .'" style="color: #007bff; padding: 10px 20px; border-radius: 5px; text-decoration: none;">hier</a> klicken.</p>
      </div>
      <div style="background-color: #007bff; padding: 20px; text-align: center;">
        <p style="color: #fff; font-size: 16px; margin: 0;">Tk Events Manager.</p>
      </div>
    </div>
    ';
    $subject = get_option('tk-events-manager-email-subject');
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($to, $subject, $body, $headers);
}



