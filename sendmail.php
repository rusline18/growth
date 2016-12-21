<?php
    function SendMail($to, $subject, $body)
    {
        require 'phpMailer/class.phpmailer.php';
        require 'phpMailer/class.smtp.php';
        $from='info@pergrowth.ru';
        $mail= new PHPMailer();
        $mail->IsHTML(true);
        $mail->CharSet='utf-8';
        $mail->SMTPAuth=true;
        $mail->Host='mail.pergrowth.ru';
        $mail->Port=465;
        $mail->Username='info@pergrowth.ru';
        $mail->Password='kazan1811';
        $mail->Secure='ssl';
        $mail->SetFrom($from, 'Growth Support');
        $mail->AddReplyTo($from, 'Growth Support');
        $mail->Subject=$subject;
        $mail->MsgHTML($body);
        $address=$to;
        $mail->AddAddress($address);
        $mail->Send();

    }
?>