<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require './vendor/phpmailer/phpmailer/src/Exception.php';
    require './vendor/phpmailer/phpmailer/src/SMTP.php';
    require './vendor/autoload.php';

    class envioEmail
    {
        private $nombre;
        private $email;


        function __construct($nombre, $email) {
            $this->nombre = $nombre;
            $this->email = $email;
        }




        function sendMail() {
            //Crear un objeto nuevo email
            $mail = new PHPMailer();

            //Usamos SMTP
            $mail->isSMTP();

            //Asignamos el servidor
            $mail->Host = 'smtp.gmail.com';
            // usar
            // $mail->Host = gethostbyname('smtp.gmail.com');
            // Si tu red no soporta ipV6

            //Asignar el número de puerto SMTP  - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
            $mail->Port = 587;

            //Asignar el mecanismo de encriptación - STARTTLS or SMTPS
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            //Activamos comunicación segura SMTP authentication
            $mail->SMTPAuth = true;

            //Usuario que se logea en gmail - hay que usar la misma dirección de email completa
            $mail->Username = 'angel@gmail.com';

            //Contraseña de gmail para la SMTP authentication
            $mail->Password = '1234';

            //Asignar el 'desde'
            $mail->setFrom("angel@gmail.com", "Angel");

            // reply-to address
            $mail->addReplyTo("angel@gmail.com", 'Tienda Web 3.0');

            //Dirección de envío

            $mail->addAddress("$this->email", "$this->nombre");

            //Ponemos el asunto
            $mail->Subject = 'Aviso de Insercion en Tienda Web 3.0';

            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
            $mail->msgHTML("<h3>Aviso</h3><br><p>Mensaje generado automaticamente.</p> <p>Le informamos de que el ".date(DATE_RFC2822)." fue dado de alta en Tienda Web 3.0 </p>", __DIR__);
            //Replace the plain text body with one created manually
            $mail->AltBody = 'This is a plain-text message body';

            //Attach an image file
            //$mail->addAttachment('images/phpmailer_mini.png');

            //send the message, check for errors
            $mail->send();
        }

    }
?>