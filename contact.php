<?php


if ($_POST) {
    $visitor_name = "";
    $visitor_tel = "";
    $visitor_message = "";
    $recipient = "dimflip@gmail.com";
    $email_title = "Письмо с сайта";

    if (isset($_POST['visitor_name'])) {
        $visitor_name = filter_var($_POST['visitor_name'], FILTER_SANITIZE_STRING);
    }

    if (isset($_POST['visitor_tel'])) {
        $visitor_tel = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['visitor_tel']);
        $visitor_tel = filter_var($visitor_tel, FILTER_VALIDATE_INT);
    }

    if (isset($_POST['visitor_message'])) {
        $visitor_message = htmlspecialchars($_POST['visitor_message']);
    }

    $headers = 'MIME-Version: 1.0' . "\r\n"
        . 'Content-type: text/html; charset=utf-8' . "\r\n"
        . 'From: ' . 'dimflip@mail.ru' . "\r\n";
    $message = "Привет меня зовут $visitor_name, а это мой телефон: $visitor_tel, а это мой комментарий: $visitor_message";

    if (mail($recipient, $email_title, $message, $headers)) {
        echo "<p>Thank you for contacting us, $visitor_name. You will get a reply within 24 hours.</p>";
    } else {
        echo '<p>We are sorry but the email did not go through.</p>';
    }

} else {
    echo '<p>Something went wrong</p>';
}

