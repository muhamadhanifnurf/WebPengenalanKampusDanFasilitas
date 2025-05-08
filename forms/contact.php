<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  // $receiving_email_address = 'muhamadhanifnurfahri@gmail.com';

  // if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
  //   include( $php_email_form );
  // } else {
  //   die( 'Unable to load the "PHP Email Form" Library!');
  // }

  // $contact = new PHP_Email_Form;
  // $contact->ajax = true;
  
  // $contact->to = $receiving_email_address;
  // $contact->from_name = $_POST['name'];
  // $contact->from_email = $_POST['email'];
  // $contact->subject = $_POST['subject'];

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */

  // $contact->add_message( $_POST['name'], 'From');
  // $contact->add_message( $_POST['email'], 'Email');
  // $contact->add_message( $_POST['message'], 'Message', 10);

  // echo $contact->send();

  // Replace with your WhatsApp number (include country code, no "+" or spaces)
  $whatsapp_number = '6283852424416';

  // Check if the request is a POST request
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $subject = isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : '';
    $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';

    // Validate required fields
    if (empty($name) || empty($email) || empty($message)) {
      http_response_code(400); // Bad Request
      echo json_encode(['error' => 'Please fill in all required fields.']);
      exit();
    }

    // Construct the WhatsApp message
    $whatsapp_message = "Hello, you have a new message from your website:\n\n";
    $whatsapp_message .= "Name: $name\n";
    $whatsapp_message .= "Email: $email\n";
    $whatsapp_message .= "Subject: $subject\n";
    $whatsapp_message .= "Message: $message";

    // Encode the message for URL
    $encoded_message = urlencode($whatsapp_message);

    // Redirect to WhatsApp
    $whatsapp_url = "https://wa.me/$whatsapp_number?text=$encoded_message";
    echo json_encode(['redirect' => $whatsapp_url]);
    exit();
  } else {
    // If not a POST request, return an error
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method.']);
    exit();
  }
