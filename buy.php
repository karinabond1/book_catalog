<?php
//error_reporting(0);
require './lib/class.phpmailer.php';
include "Book_class.php";
include "DB.php";
include_once "Config.php";
$name = $_POST['full_name'];
$address = $_POST['address'];
$number = $_POST['number'];

$book = $_REQUEST['book_id'];
$db = new DB();
$db->connect();
$arr_book = $db->selectWhere("book","books","id",$book);
for($i=0;$i<count($arr_book);$i++){
    $bookname = $arr_book[$i]["book"];
}

$mail = new PHPMailer();

$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Username = "karatest10010110@gmail.com";
$mail->Password = "qetuo13579";
$mail->SMTPSecure = "tls";
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->Subject = "Order a book";
$mail->Body = $bookname . "\n" . $name . "\n" . $address . "\n" . $number;

$mail->AddAddress(Config::$email);
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    header("Location: index.php");
}
?>