<?php

$addAddress = filter_input(INPUT_POST, 'addAddress', FILTER_SANITIZE_EMAIL);
$Subject = filter_input(INPUT_POST, 'Subject', FILTER_SANITIZE_STRING);
$Message = filter_input(INPUT_POST, 'Message', FILTER_SANITIZE_STRING);
$IsHTML = filter_input(INPUT_POST, 'IsHTML', FILTER_SANITIZE_STRING);

require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer();
$mail->isSMTP();
$mail->CharSet = 'UTF-8';
$mail->Host = 'mx1.hostinger.com.br';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'noreply@ernane.online';
$mail->Password = 'trabalho';
$mail->setFrom('noreply@ernane.online', 'noreply@ernane.online');
$mail->addReplyTo('noreply@ernane.online', 'noreply@ernane.online');
$mail->addAddress($addAddress);
$mail->Subject = $Subject;
$mail->IsHTML($IsHTML);
$mail->Body = $Message;
//$mail->msgHTML(file_get_contents('message.html'), __DIR__);
$mail->AltBody = 'This is a plain text message body';
//$mail->addAttachment('test.txt');
if (!$mail->send()) {
    echo 'Erro ao tentar enviar o e-mail: ' . $mail->ErrorInfo;
    echo $addAddress . '<br >';
    echo $Subject;
    echo $Message;
    echo $IsHTML;
} else {
    echo 'E-mail enviado!';
    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0; URL=../pagina_inicial.php'>";
}
?>