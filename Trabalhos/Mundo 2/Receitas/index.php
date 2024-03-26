<?php
require_once('src/PHPMailer.php');
require_once('src/SMTP.php');
require_once('src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $cep = $_POST['cep'];
    $address = $_POST['address'];
    $address2 = $_POST['address2'];
    $complemento = $_POST['complemento'];
    $city = $_POST['city'];
    $uf = $_POST['uf'];

    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'markouizosf@gmail.com';
        $mail->Password = 'rrmatlmvftwhbedq';
        $mail->Port = 587;

        $mail->setFrom('markouizosf@gmail.com');
        $mail->addAddress('markouizosf@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = 'Novo cadastro';
        $mail->Body = "
            <p><strong>Nome:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>CEP:</strong> $cep</p>
            <p><strong>Endereço:</strong> $address, $address2 - $complemento</p>
            <p><strong>Cidade:</strong> $city</p>
            <p><strong>UF:</strong> $uf</p>
        ";

        // Envia o e-mail
        if ($mail->send()) {
            header("Location: cadastro.html?success=true");
            exit;
        } else {
            header("Location: cadastro.html?success=false");
            exit;
        }
    } catch (Exception $e) {
        header("Location: cadastro.html?success=false");
        exit;
    }
} else {
    header("Location: cadastro.html?success=false");
    exit;
}
?>
