<?php
// check if a form was submitted
$MetricArray = array(
      "Role 1" => "Role 0"

    ); 
// function gen_uid($l=5){ $str = ""; for ($x=0;$x<$l;$x++) $str .= substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 1); return $str; }

// $dbid = strtoupper(gen_uid());

$PG_Array = array(
      "level 1" => "level 2",
      "level 1" => "level 2"

    ); 

$Off_MgrArray = array(
      "Singapore" => "xxx",
      "Kuala Lumpur" => "xxx"
    ); 

$Off_MmkArray = array(
      "Singapore" => "xxx",
      "Kuala Lumpur" => "xxx",
    ); 

$Prd_MgrArray = array(
      "Prod 1" => "Name 1",
    ); 

$Name_TL_Array = array(
      "Team Member " => "Team Leader"
    ); 

$EmailArray = array(
      "Team Member Name" => "email@bbg.net"
    ); 
// $json = json_encode(array($_POST));
// print_r($_POST);
// if( !empty( $_POST ) ){

// convert form data to json format
    $postArray = array(
      "Name" => $_POST['name'],
      "Email" => $_POST['email'],
      "Reason" => $_POST['reason'],
      "Training" => $_POST['training'],
      "session" => $_POST['session'],
      "Success" => $_POST['success'],
      "Mentor" => $_POST['mentor'],
      "Expertise" => $_POST['expertise'],
      "Frequency" => $_POST['frequency'],
      
    ); //you might need to process any other post fields you have..\

$json = json_encode(array($postArray));
// echo '<pre>'; print_r($json); echo '</pre>';
// make sure there were no problems
if( json_last_error() != JSON_ERROR_NONE ){
    exit;  // do your error handling here instead of exiting
}

// echo 'Your request has been submitted. Development group will contact you for follow-up.';
// echo '<pre>'; print_r($postArray); echo '</pre>';

//handling questionnair section



$postArray = array($postArray);
$data = json_decode(file_get_contents('mentor.json', true),true);
$result = array_merge($data, $postArray);
$json = json_encode(array($postArray));
// write to file
//   note: _server_ path, NOT "web address (url)"!
file_put_contents("mentor.json", json_encode($result,JSON_PRETTY_PRINT));
// echo "The file's contents have been written.";
// header("Location: http://tokttechops01/gdweb/dashboard.html");
$mentee_email_to = "xxx@bbg.net".", "; // note the comma, comma to concatenate emails. we need a mapping of email to name and vlookup based on form entry
$mentee_email_to .= $EmailArray[$_POST['mentor']].", ";
$mentee_email_subject = 'The start of a Mentorship with '.$_POST['name'];



// Create email headers
// Set content-type header for sending HTML email
$mentee_email_headers = "MIME-Version: 1.0" . "\r\n";
$mentee_email_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// Additional headers
$mentee_email_headers .= 'From: axxx1@bbg.net' . "\r\n";  //change this to Hung's email?
$mentee_email_headers .= 'Bcc: xxx@bbg.net'. ", xxx@bbg.net".",xxx@bbg.net , xxx@bbg.net, xxx@bbg.net,  xxx@bbg.net"."\r\n";  //change it to who? do we need cc?
$mentee_email_headers .= 'Bcc: xx111@bbg.net' ."\r\n";  //change it to who? do we need cc?


$mentee_email_message = '<font size="4.5">Dear '.$_POST['mentor'].',<br><br>There is a request for your mentorship!<br><br>Mentee: '.$_POST['name'].'<br>Mentor: '.$_POST['mentor'].'<br>Topic: '.$_POST['expertise'].'<br>Prior training: '.$_POST['training'].'<br>Hope to learn: '.$_POST['reason'].'<br>Success Measurement: '.$_POST['success'].'<br>Number of Sessions: '.$_POST['session'].'<br>Frequency of Catch-Ups: '.$_POST['frequency'].'<br> Pre-requisites information: <br> '.$_POST['LS_1year'].' <br> '.$_POST['LS_attend_lead_training'].' <br> '.$_POST['LS_lead_1_project'].'  <br> '.$_POST['Te_6month'].' <br> '.$_POST['Te_backround'].' <br> '.$_POST['Te_techstack'].'  <br> '.$_POST['Sta_6month'].'  <br> '.$_POST['Sta_know_stat'].'  <br> '.$_POST['Sta_advanced_analysis'].'  <br> '.$_POST['Sta_proj'].'  <br> '.$_POST['M_6months'].'  <br> '.$_POST['M_present'].' <br> '.$_POST['RM_6month'].' <br> '.$_POST['RM_gcom'].' <br> '.$_POST['RM_clients_visit'].' <br> '.$_POST['PM_3month'].' <br> '.$_POST['PM_project'].'  <br><br>Please <b>reply all</b> to this email within a day indicating if you "Accept" or "Reject" this mentorship. </font></p>';


mail($mentee_email_to, $mentee_email_subject, $mentee_email_message, $mentee_email_headers);

$mentor_email_to = $_POST['email'].", "; // note the comma, comma to concatenate emails. we need a mapping of email to name and vlookup based on form entry
$mentor_email_subject = 'The start of a Mentorship with '.$_POST['mentor'];



// Create email headers
// Set content-type header for sending HTML email
$mentor_email_headers = "MIME-Version: 1.0" . "\r\n";
$mentor_email_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// Additional headers
$mentor_email_headers .= 'From: xxx@bbg.net' . "\r\n";  //change this to xxx email?
$mentor_email_headers .= 'Bcc: xxx@bbg.net'.", xxx@bbg.net , xxx@bbg.net,  sliu439@bloomberg.net, xxx@bbg.net"."\r\n"; //change it to who? do we need cc?
$mentor_email_headers .= 'Bcc: xxx@bbg.net' ."\r\n";  //change it to who? do we need cc?


$mentor_email_message = '<font size="4.5">Dear '.$_POST['name'].',<br><br>Your request has been sent to mentor!<br><br>Mentee: '.$_POST['name'].'<br>Topic: '.$_POST['expertise'].'<br>Prior training: '.$_POST['training'].'<br>Hope to learn: '.$_POST['reason'].'<br>Success Measurement: '.$_POST['success'].'<br>Number of Sessions: '.$_POST['session'].'<br>Mentor: '.$_POST['mentor'].'<br><br>We will reach out to you soon for the next step.<br><br>Peace Out</font></p>';


mail($mentor_email_to, $mentor_email_subject, $mentor_email_message, $mentor_email_headers);


header ("Location: http://devhtml.dev.xxxxxxxxx.com");
// }