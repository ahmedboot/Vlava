<?php
use PHPMailer\PHPMailer\PHPMailer;
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
require 'vendor/autoload.php';
define ('SITE_ROOT', realpath(dirname(__FILE__)));
if(isset($_POST['Fname'])){
        $name = $_FILES['uploaded']['name'];  
        $temp_name = $_FILES['uploaded']['tmp_name'];  
        $location = "\Upload\\";
        echo SITE_ROOT.$location.$name;
        if(isset($name) and !empty($name)){
             
            if(move_uploaded_file($temp_name, SITE_ROOT.$location.$name)){
              
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'smtp-mail.outlook.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'ahmed.bot@outlook.com';
$mail->Password = '3Dahmed#';
$mail->setFrom('ahmed.bot@outlook.com', 'ahmed');
$mail->addReplyTo('ahmed.boot2016@gmail.com', 'Ahmed Adel');
$mail->addAddress('ahmed.boot2016@gmail.com', 'Receiver Name');
$mail->Subject ='Website Form';
//$mail->msgHTML(;
$mail->Body = 'Hi this Mail from your form : <br> First Name :'.$_POST['Fname'].'</br>'.
'Last Name : '.$_POST['Lname'].'</br>'.
'Email : '.$_POST['email'].'</br>'.
'Mobile : '.$_POST['Mobile'].'</br>'. 
'City : '.$_POST['City'].'</br>';
$mail->IsHTML(true); 
$mail->AddAttachment(SITE_ROOT.$location.$name);
//$mail->addAttachment($_POST['CV']);
if (!$mail->send()) {
    $response = [
        'message' => 'Fail send mail. ' ,
    ];
    
    echo json_encode($response);
    exit();
} else {
    echo json_encode("{'msg':'OK'}");
   header('Location:http://localhost/RAYA_boot_service/source/Vlava/index.html#section-contact');
}


            }
        }
         else {
            $response = [
                'message' => 'Fail move file. ' ,
            ];
            
            echo json_encode($response);
            exit();
        }
    }
    else
    {
        $response = [
            'message' => 'OK. ' ,
        ];
        
        echo json_encode($response);
        exit();
        //echo json_encode("{msg:'submit form'}",TRUE);
    }
    
//move_uploaded_file($_FILES["CV"]["tmp_name"],"Uploud/". $_FILES["CV"]["name"]);

?>