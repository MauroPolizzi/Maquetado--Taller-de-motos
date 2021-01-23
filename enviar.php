<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Phpmailer/Exception.php';
require 'Phpmailer/PHPMailer.php';
require 'Phpmailer/SMTP.php';

enviarEmail();

function enviarEmail(){
    if(isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['mensaje'])){

        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $mensaje = $_POST['mensaje'];

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Conexion al servidor
            $mail->SMTPDebug = 2;                                      // Me da los errores que tengo, poner 0 para que no muestre
            $mail->isSMTP();                                           // Set mailer to use SMTP, protocolo que usa
            $mail->Host = 'smtp.gmail.com';                            // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                                    // Enable SMTP authentication
            $mail->Username = 'mauropolizzi2@gmail.com';               // SMTP username
            $mail->Password = '42404521998MEP';                        // SMTP password
            $mail->SMTPSecure = 'tls';                                 // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                         // TCP port to connect to

            //Destinatarios
            $mail->setFrom($correo);                                   // Desde que direccion se enviara
            $mail->addAddress('mauropolizzi2@gmail.com');              // Quien recibira el correo

            
            //Content
            $mail->isHTML(true);                                       // Formatea el texto en base a HTML
            $mail->Subject = 'Correo de Contacto';                     // El asunto del correo  
            $mail->Body    = 'Nombre: ' . $nombre . '<br/>Correo: ' . $correo . '<br/><br/>' . $mensaje;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            header('Location:SegundoSitio.html');
        } 
        catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

}
// $destino="mauropolizzi2@gmail.com";
// $nombre= $_POST["nombre"];
// $correo= $_POST["correo"];
// $mensaje= $_POST["mensaje"];

// $contenido= "Nombre: " . $nombre . "\nCorreo: " . $correo . "\nMensaje: " . $mensaje;


// if(mail($destino,"Sugerencia", $contenido)){
//     header("Location: SegundoSitio.html");
// }
// else{
//     echo("No se pudo enviar");
// }


// if(isset($_POST['boton'])){
//     $mensaje = '
//     <!DOCTYPE html>
//     <html>
//     <head>
//      <title></title>
//     </head>
//     <body>
//     '.$_POST['mensaje'].'
//     </body>
//     </html>';

//     $headers  = "MIME-Version: 1.0\r\n";
//     $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
//     $headers .= "From: ".$_POST['nombre']." <".$_POST['correo'].">\r\n";

//     if(mail($_POST['correo'], $mensaje,$headers)){
//         echo "<script>alert('Funcion \"mail()\" Evio exitoso.');</script>";
        
//     }
//     else{
//         echo "<script>alert('No se pudo enviar el correo.');</script>";
//     }
//}
?>