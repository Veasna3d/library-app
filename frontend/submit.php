<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $message = $_POST["message"];

  // Send email to admin
  $to = "veasna3d@gmail.com";
  $subject = "New Message from Contact Form";
  $body = "Name: $name\nEmail: $email\nMessage: $message";
  mail($to, $subject, $body);
}

?>
