<?php

$opj=$_POST['data'];

$jsonArray = json_decode(file_get_contents('php://input'),true);
$user_name = $jsonArray['user_name'];
$email = $jsonArray['email'];
$password = $jsonArray['password'];

$result = $this->reg_model->insert_api($user_name,$email,$password);
    if ($result){
        $config = Array(        
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'YOURGMAIL',
            'smtp_pass' => 'YOURGMAILPASSWORD',
            'smtp_timeout' => '4',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n"); 
        $from_email = "abc@gmail.com"; 
        $this->email->from($from_email, 'Name'); 
        $this->email->to($email);
        $this->email->subject('email subject');
        $message = 'email body';                 
        $this->email->message($message);
        $this->email->send();
        $data = $this->response($this->reg_model->get($user_name));
    }
} 

/>