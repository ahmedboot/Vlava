/*
  $('form.contactForm').submit(function() {
   debugger
   //document.getElementById("contactForm").submit();
    str=  { Fname: $('#Fname').val(), Lname: $('#Lname').val() };
    //var atmmodel = { BranchID: $("#BranchID").val() }
    var result = '';
    $.ajax({

        url: 'SMTP.php',
        type: 'POST',
        dataType: 'json',
        async: false,
        contentType: 'application/json',
        success: function (data) {
          
         alert(data);
            if (data.msg == 'OK') {
              $("#sendmessage").addClass("show");
              $("#errormessage").removeClass("show");
              $('.contactForm').find("input, textarea").val("");
            } else {
              $("#sendmessage").removeClass("show");
              $("#errormessage").addClass("show");
              $('#errormessage').html(data);
            } 

        },
        data: JSON.stringify(str)
    });
  })*/

  $(document).ready(function () {
    $('#submit').click(function (event) {
      debugger
        ajaxSearch();
    });
});


function ajaxSearch() {
  debugger
  $.ajax({
      method: 'post',
      dataType: 'json',
      url: 'SMTP.php',
      data: $('.contactForm').serialize(),
      success: function (response, textStatus, jqXHR) {
          /*
           * Just for testing: diplay the whole response
           * in the console. So look unto the console log.
           */
          alert(response.message);

          // Get the success message from the response object.
          //var successMessage = response.message;

          // Get the list of the found cities from the response object.
         // var cities = response.cities;

          // Display the success message.
         // displayMessage('.messages', 'success', successMessage);

          // Display the list of the found cities.
          //$('.cities').html('');
          //$.each(cities, function (index, value) {
            //  var city = index + ": " + value.name + ' (' + value.isCapital + ')' + '<br/>';
             // $('.cities').append(city);
          //});
      },
      error: function (jqXHR, textStatus, errorThrown) {
          // Handle the raised errors. In your case, display the error message.
          handleAjaxError(jqXHR);
      },
      complete: function (jqXHR, textStatus) {
          // ... Do something here, after all ajax processes are finished.
      }
  });
}

/**
* Display a user message.
*
* @param selector string The jQuery selector of a message container.
* @param type string The message type: success|danger|warning.
* @param message string The message text.
* @return void
*/
function displayMessage(selector, type, message) {
  $(selector).html('<div class="message ' + type + '">' + message + '</div>');
}

/**
* Handle an error raised by an ajax request.
*
* If the status code of the response is a custom one (420), defined by
* the developer, then the corresponding error message is displayed.
* Otherwise, e.g. if a system error occurres, the displayed message must
* be a general, user-friendly one. So, that no system-related infos will be shown.
*
* @param jqXHR object The jQuery XMLHttpRequest object returned by the ajax request.
* @return void
*/
function handleAjaxError(jqXHR) {
  var message = 'An error occurred during your request. Please try again, or contact us.';

  if (jqXHR.status === 420) {
      message = jqXHR.statusText;
  }

  displayMessage('.messages', 'danger', message);
}





///////////////////////////////

<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
define ('SITE_ROOT', realpath(dirname(__FILE__)));
if(isset($_POST['submit'])){
    
    
  
     $name = $_FILES['uploaded']['name'];  
        $temp_name = $_FILES['uploaded']['tmp_name'];  
        $location = "\Upload\\";
        echo SITE_ROOT.$location.$name;
        if(isset($name) and !empty($name)){
             
            if(move_uploaded_file($temp_name, SITE_ROOT.$location.$name)){
              
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
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
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'The email message was sent.';
}


            }
        }
         else {
            echo 'You should select a file to upload !!';
        }
    }
    else
    {
        echo 'You Submit Form !!';
    }
    
//move_uploaded_file($_FILES["CV"]["tmp_name"],"Uploud/". $_FILES["CV"]["name"]);

?>



function Filevalidation  ()  {
  const fi = document.getElementById('uploaded');
  // Check if any file is selected.
  if (fi.files.length > 0) {
      for (const i = 0; i <= fi.files.length - 1; i++) {

          const fsize = fi.files.item(i).size;
          const file = Math.round((fsize / 1024));
          // The size of the file.
          if (file >= 5119) {
              alert(
                "File too Big, please select a file less than 5mb");
                
          
          } else {
              document.getElementById('size').innerHTML = '<b>'
              + file + '</b> KB';
          }
      }
  }
}
