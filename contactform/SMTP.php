<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"),true);
if(!empty($data->fname))
{
    echo $data->fname;
echo json_encode(array("msg" => $data->fname));
http_response_code(200);  // Collect what you need in the $data variable.

}
else{
echo json_encode(array("msg" => "Ofail"));  
http_response_code(503);  // Collect what you need in the $data variable.
}  
      
?>