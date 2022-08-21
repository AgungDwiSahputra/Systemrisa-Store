<?php
include "../classes/class.phpmailer.php";
$mail = new PHPMailer; 
$mail->IsSMTP();
$mail->SMTPSecure = 'ssl'; 
$mail->Host = "smtp.gmail.com"; //host masing2 provider email
$mail->SMTPDebug = 2;
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = "systemairisa@gmail.com"; //user email
$mail->Password = "Agungganteng275!"; //password email 
$mail->SetFrom("systemairisa@gmail.com","Systemrisa Store"); //set email pengirim
$mail->addReplyTo("noreply@r-i-s-a.com", "noreply"); //Set an alternative reply-to address
$mail->Subject = "Aktivasi Pendaftaran"; //subyek email
$mail->AddAddress($_POST['email'], $_POST['nama']);  //tujuan email
$mail->MsgHTML("<!DOCTYPE html>
<html lang='en'>
<body style='margin:0px; background: #f8f8f8;'>
    <div width='100%'
        style='background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;'>
        <div style='max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px'>
            <div style='padding: 40px; background: #fff;'>
                <table border='0' cellpadding='0' cellspacing='0' style='width: 100%;'>
                    <tbody>
                        <table border='0' cellpadding='0' cellspacing='0' style='width: 100%;'>
                            <tbody>
                                <tr>
                                    <td style='vertical-align: top;' align='center'>
                                        <img src='https://r-i-s-a.com/assets/img/favicon.png' alt='Systemrisa Store'
                                            style='border:none' width='13%'>
                                        <h4 style='margin: 0 !important;'>SYSTEMRISA STORE</h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr width='100%' size='5' color='black'
                            style='margin-bottom: 0 !important; margin-top: 20px !important;'>
                        <hr width='100%' size='1' color='black'
                            style='margin-top: 3px !important; margin-bottom: 20px !important;'>
                        <tr>
                            <td style='border-bottom:1px solid #f6f6f6;'>
                                <h1 style='font-size:14px; font-family:arial; margin:0px; font-weight:bold;'>Dear
                                    ".$_POST['nama']."</h1>
                                <p style='margin-top:0px; color:#bbbbbb;'>Email untuk Aktivasi Akun Kamu, mohon untuk
                                    tidak membalas.</p>
                            </td>
                        </tr>
                        <hr color='aliceblue' style='color: aliceblue;'>
                        <tr>
                            <td style='padding:10px 0 30px 0;'>
                                <p>
                                    <h3>Selamat Datang ".$_POST['nama']."</h3>
                                </p>
                                <p>
                                    Kamu telah <b>Berhasil</b> membuat Akun kamu, sekarang tinggal Aktivasi Email Kamu
                                    agar Akun Kamu Terverifikasi.<br>
                                    Aktivasi dengan cara klik Tombol di bawah ini :
                                </p>
                                <center>
                                    <a href='https://r-i-s-a.com/panel/register/activation.php?t=".$token."'
                                        style='width: 80%; display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #4fc3f7; border-radius: 60px; text-decoration:none;'>
                                        Aktivasi Akun</a>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td style='border-top:1px solid #f6f6f6; padding-top:20px; color:#777'>Jika tombol di atas
                                tidak berfungsi, coba salin dan tempel URL ini <b>
                                    https://r-i-s-a.com/panel/register/activation.php?t=".$token." </b> ke browser Anda.
                                Jika
                                Anda terus
                                mengalami
                                masalah, jangan ragu untuk menghubungi kami di <a
                                    href='https://api.whatsapp.com/send?phone=+6281298623982'>082110860615</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style='text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px'>
                <p>Copyright © 2020 Systemrisa Store dibuat oleh <b>Agung Dwi Sahputra</b></p>
            </div>
        </div>
    </div>
</body>
</html>");
if($mail->Send()) echo "Message has been sent";
else echo "Failed to sending message";
?>