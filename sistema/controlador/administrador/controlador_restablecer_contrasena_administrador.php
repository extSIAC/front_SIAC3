<?php
    require '../../modelo/modelo_administrador.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $MU = new Modelo_Administrador();
    
        $RES_REC_CORREO_USUARIO_ADMINISTRADOR   = htmlspecialchars($_POST['REC_CORREO_USUARIO_ADMINISTRADOR'],ENT_QUOTES,'UTF-8');
        $RES_CONTRASENA_ALEATORIA               = password_hash   ($_POST['CONTRASENA_ALEATORIA'],PASSWORD_DEFAULT,['cost']);
        $CONTRA_ACTUAL   = htmlspecialchars($_POST['CONTRASENA_ALEATORIA'],ENT_QUOTES,'UTF-8');

        
    $consulta = $MU->Restablecer_Contrasena_Usuario_Administrador($RES_REC_CORREO_USUARIO_ADMINISTRADOR, $RES_CONTRASENA_ALEATORIA);
    echo $consulta;


    if($consulta=="1"){

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
            );
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username='pruebatecextraaescolar@gmail.com';//este debe ir en el address?
            $mail->Password='extraescolares';                            // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('inscripciones.extraescolar.itp@gmail.com', 'DEPARTAMENTO DE ACTIVIDADES EXTRAESCOLARES');
            $mail->addAddress($RES_REC_CORREO_USUARIO_ADMINISTRADOR);     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Restablecer Password';
            $mail->Body    = 'PRUEBA DE CORREO '.$CONTRA_ACTUAL.'';

            $mail->send();
            echo '1';
        } catch (Exception $e) {
            echo '0';
        }
    }else{
        echo '2';
    }


?>