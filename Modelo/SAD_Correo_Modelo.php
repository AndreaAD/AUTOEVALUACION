<?php

class Correo{
        
    public function Enviar_Correo($Nombre, $Apellido, $Correo, $Usuario, $pass){
                
        $body = "<table border='0' width='600px' align='center'>    
                    <tr>
                        <td>
                            <img src='http://www.omzsistemas.com.co/sia/imagenes/ESCUDO_UDEC.png' width=''200px' height=''100px'/>
                        </td>
                        <td align='center'>
                            <h1>Sistema de Informaci�n de Autoevaluaci�n</h1>
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan='2' align='center'>
                            <br />
                            <h1>Universidad de Cundinamarca</h1>
                            <h1>Oficina de Sistemas</h1> 
                            
                            <br />
                            <br />
                            
                            <p>
                                En el siguiente correo se ha adjuntado su usuario y clave para que pueda 
                                entrar a la aplicaci�n por favor al momento de ingresar cambie su clave 
                                si as� lo desea en la parte de configuraci�n esperamos que tenga un buen 
                                d�a.                        
                            </p>
                            <br />
                            <a href='http://www.omzsistemas.com.co/sia/Controlador/VIS_Index_Controlador.php'>Pagina principal de SIA</a>
                            <br />
                            <br />
                            
                            <h2>$Nombre $Apellido</h2>
                            
                            <h2>Usuario: $Usuario</h2>
                            
                            <h1>clave: $pass</h1>
                        </td>
                    </tr>
                </table>";
        
        date_default_timezone_set('Etc/UTC');
        
        require '../PHPMailer/PHPMailerAutoload.php';
        
        $mail = new PHPMailer();
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Username = "cit.udec@gmail.com";
        $mail->Password = "CITudec2016";
        $mail->addAddress($Correo, $Nombre . " " . $Apellido);
        $mail->setFrom('cit.udec@gmail.com', 'SIA');
        $mail->Subject = 'Registro de Usuario';
        $mail->Body    = $body;
        $mail->AltBody = 'This is a plain-text message body';
       // $mail->addAttachment('images/phpmailer_mini.png');
        
        $mensaje="<h2>No se ha podido enviar el correo</h2>";
        
        if (!$mail->send()) {
            $mensaje="<h2>No se ha podido enviar el correo</h2>";
        	
       	} 
        else{
            $mensaje = "<h2>Se ha enviado el correo</h2>";
        }  
      //  echo $mensaje;die();
        return $mensaje;
        
    }
    
    
}

?>