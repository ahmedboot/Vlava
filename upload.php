<?php 
$fname=$_POST['Fname'];
define ('SITE_ROOT', realpath(dirname(__FILE__)));
if(isset($_POST['submit'])){
    echo $fname;
    
    }
     $name = $_FILES['uploaded']['name'];  
        $temp_name = $_FILES['uploaded']['tmp_name'];  
        $location = "\Upload\\";
        echo SITE_ROOT.$location.$name;
        if(isset($name) and !empty($name)){
             
            if(move_uploaded_file($temp_name, SITE_ROOT.$location.$name)){
                echo 'File uploaded successfully';
            }
        } else {
            echo 'You should select a file to upload !!';
        }
    
    
?>