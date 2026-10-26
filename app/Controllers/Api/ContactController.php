<?php
namespace App\Controllers\Api;

use WP_REST_Response;
use WP_REST_Request;

class ContactController {

  public static function general(WP_REST_Request $request){
        // Flag for validation
        $valid = true;

        // Inputs
        $name = sanitize_text_field($request->get_param('full_name'));
        $email = sanitize_email($request->get_param('email'));
        // $phone = sanitize_text_field($request->get_param('phone'));
        $businessname = sanitize_text_field($request->get_param('businessname'));
        $message = sanitize_textarea_field($request->get_param('message'));
        $subject = $request->get_param('subject') ? sanitize_text_field($request->get_param('subject')) : 'New general contact form enquiry';
        
        // Mail receiver defined as constant or a static variable (ensure this is set)
        $mailto = defined('CONTACT_MAIL_RECEIVER') ? CONTACT_MAIL_RECEIVER : 'info@xxxx.com';

        // Validate all required fields
        if (empty($name) || empty($email) || empty($businessname) || empty($message)) {
            $valid = false;
            $status = 400;
            $message = array(
                'status' => 'Error',
                'message' => 'Please fill in all required fields.'
            );
        }

        if ($valid) {
            $body = $subject . "\n\n";
            $body .= 'Name: ' . $name . "\n";
            $body .= 'Email Address: ' . $email . "\n";
            // $body .= 'Phone Number: ' . $phone . "\n";
            $body .= 'Business Name: ' . $businessname . "\n\n";
            $body .= 'Message: ' . $message . "\n";

            $headers = array(
                'Reply-To: ' . $name . ' <' . $email . '>'
            );

            // Try sending the email
            if (wp_mail($mailto, $subject, $body, $headers)) {
                $message = array(
                    'status' => 'Success',
                    'message' => 'Thank you! We have received your message and we will get back to you soon.'
                );
                $status = 200;
            } else {
                $message = array(
                    'status' => 'Error',
                    'message' => 'Oops! Something went wrong and we couldn\'t send your message.'
                );
                $status = 400;
            }
        }

        return new WP_REST_Response($message, $status);
    }

}
