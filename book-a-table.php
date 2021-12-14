<?php
//
  $receiving_email_address = 'bagombekajob16@gmail.com';

  // if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
  //   include( $php_email_form );
  // } else {
  //   die( 'Unable to load the "PHP Email Form" Library!');
  // }

  $book_a_table = new PHP_Email_Form;
  $book_a_table->ajax = true;
  
  $book_a_table->to = $receiving_email_address;
  $book_a_table->from_name = $_POST['name'];
  $book_a_table->from_email = $_POST['email'];
  $book_a_table->subject = "New table booking request from the website";

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $book_a_table->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */

  $book_a_table->add_message( $_POST['name'], 'Name');
  $book_a_table->add_message( $_POST['email'], 'Email');
  $book_a_table->add_message( $_POST['phone'], 'Phone', 4);
  $book_a_table->add_message( $_POST['date'], 'Date', 4);
  $book_a_table->add_message( $_POST['time'], 'Time', 4);
  $book_a_table->add_message( $_POST['people'], '# of people', 1);
  $book_a_table->add_message( $_POST['message'], 'Message');
  
  
  
  //for creating the database and also inserrting data into  the database
 $servername = "localhost";
  $username="root";
  $password = "";
  $database_name="BOOK_TABLE";

  $conn = new mysqli($servername, $username, $password, $database_name);

if($conn->$connect_error){
  die("<br>Connecting Error!!!!!".$conn->$connect_error)
}else{
  echo"<br>Successfully connected to the database";
}

$DBname = "CREATE DATABASE BOOK_TABLE";
if($conn->query($DBname)==TRUE){
  echo"Successfully created the database<br>";
}else{
  echo"Error in creating the database<br>".$conn->error;
}

$table = "CREATE TABLE BOOK_A_TABLE (id AUTO_INCREMENT NOT NULL PRIMARY KEY, name VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL,
phone INT(10) NOT NULL , people IN(100) NOT NULL , message VARCHAR(500) NOT NULL, 
time_date TIMESTAMP";

//GETTING  THE DATA FROM THE BOOK_TABLE_FORM
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$people = $_POST['people'];
$message  = $_POST['message'];

//Validating the data before being inserted into the database
function BOOK_A_TABLE_VALIDATION(){
if($_POST['name'] == " "){
  echo"Please insert the name column!!<br>";
}
if($_POST['email'] == " "){
  echo"Please insert the email column!!<br>";
}
if($_POST['phone'].length() >10){
  echo"Please length of the phone number should not be greater than 10!!<br>";
}
if($_POST['people'] >100){
  echo"Please the number of people should be less then 100!!<br>";
}
if($_POST['message'].length() >500){
  echo"Please message should not be above 500<br>";
}
}
BOOK_A_TABLE_VALIDATION();

//validating if all field are not inserted
if(BOOK_A_TABLE_VALIDATION() == TRUE){
  echo"Your data is inserted. You are all set!!";
}else{
  echo"Please insert all the fields!!";
}
//FOR INSERTING THE DATA INTO  THE BOOK_A_TABLE TABLE
$qry = "INSERT INTO BOOK_A_TABLE(name, email, phone, message) VALUES($name, $email, $phone,
$people, $message)";
if($conn->query($qry)==TRUE){
echo"Values inserted successfully<br>";
}else{
  echo"Error in inserting the data".$conn->error;
}

  echo $book_a_table->send();
//for closing the connection
$conn->close();
?>
