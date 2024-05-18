<?php


$server_name="localhost";
$username="root";
$password="";
$database_name="ngo";

$conn=mysqli_connect($server_name,$username,$password,$database_name);
//now check the connection
if($conn->connect_error)
{
    die("Connection failed:" .mysqli_connect_error());
}
if(isset($_POST['save']))
{
   $firstname = $_POST['firstname'];
   $lastname = $_POST['lastname'];
   $gender = $_POST['gender'];
   $phone = $_POST['phone'];
   $state1 = $_POST['state1'];
   $email = $_POST['email'];
   $password1 = $_POST['password1'];
   
   $sql_query = "INSERT INTO registration (firstname,lastname,gender,phone,state1,email,password1) 
   VALUES ('$firstname','$lastname','$gender','$phone','$state1','$email','$password')";

   if (mysqli_query($conn,$sql_query))
   {
    echo "Registration Successful";
   }
   else
   {
    echo "Error: " .$sql . "" . mysqli_error($conn);
   }
   mysqli_close($conn);
}
?>