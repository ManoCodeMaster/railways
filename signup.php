<!DOCTYPE html>
<?php
$conn=new mysqli("localhost","root","","southern_railways");
?>
<html>
<head>
<title> Sign up page </title>
<style>
body{
  margin:0px;
  background-color:lightgray;
}
.container{
  display:flex;
}
.signup-container{
  margin:5% 40%;
  padding:10px;
  border:1px solid blue;
  width:25%;
  height:100%;
  background-color:white;
}
.b{
width:300px;
height:40px;
font-size:20px;
}
/*.hero-image{
  background-image:url("img7.webp");
  //background-color:#cccccc;
  background-attachment:fixed;
  height:100vh;
  width:75%;
  background-position:-webkit-sticky;
  background-repeat:no-repeat;
  background-size:cover;
  position:-webkit-sticky;
}*/
</style>
</head>
<body>
<div class="container">
<div class="signup-container">
<table border="0">
<form method="post">
<caption> <img style="border-radius:50%;width:100px;height:100px;" src="img6.jpeg" /img> </caption>
<tr> <td> <u><h2 style="text-align:center;">Sign Up</h2></u></td></tr>
<tr> <td style="font-size:25px"><label for="fname">First Name*</label></td></tr>
<tr> <td><input class="b" type="text" id="fname" name="firstname" placeholder="Enter a first name" required/></td></tr>
<tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>
<tr> <td style="font-size:25px"><label for="lname">Last Name*</label></td></tr>
<tr> <td><input class="b" type="text" id="lname" name="lastname" placeholder="Enter a last name" required/></td></tr>
<tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>
<tr> <td style="font-size:25px"><label for="dob">Date of Birth*</label></td></tr>
<tr> <td><input class="b" type="date" id="dob" name="dob" placeholder="Enter a date of birth" required/></td></tr>
<tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>
<tr> <td style="font-size:25px"><label for="gender">Gender*</label></td></tr>
<tr> <td><input type="radio" id="male" name="gender" value="Male" required/><label for="male">Male</label></td></tr>
<tr> <td><input type="radio" id="female" name="gender" value="Female" required/><label for="female">Female</label></td></tr>
<tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>
<tr> <td style="font-size:25px"><label for="email">Email Address*</label></td></tr>
<tr> <td><input class="b" type="email" id="email" name="email" placeholder="Enter a email address" required/></td></tr>
<tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>
<tr> <td style="font-size:25px"><label for="pass">Password*</label></td></tr>
<tr> <td><input class="b" type="password" id="pass" name="password" placeholder="Enter a password" required/></td></tr>
<tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>
<tr> <td style="font-size:25px"><label for="cpass">Confirm Password*</label></td></tr>
<tr> <td><input class="b" type="password" id="cpass" name="cpassword" placeholder="Enter a confirm password" required/></td></tr>
<tr> <td style="font-size:25px"><label for="state">State*</label></td></tr>
<tr> <td><input class="b" type="text" id="state" name="state" placeholder="Enter a state" required/></td></tr>
<tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>
<tr> <td style="font-size:25px"><label for="city">City*</label></td></tr>
<tr> <td><input class="b" type="text" id="city" name="city" placeholder="Enter a city" required/></td></tr>
<tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>
<tr> <td style="font-size:25px"><label for="add">Address*</label></td></tr>
<tr> <td><textarea rows="5" cols="40" id="add" name="address" placeholder="Enter a address" required></textarea></td></tr>
<tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>
<tr> <td style="font-size:25px"><label for="pno">Phone Number*</label></td></tr>
<tr> <td><input class="b" type="tel" id="pno" name="pnumber" placeholder="Enter a phone number" required/></td></tr>
<tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>
<tr> <td align="center"> <input class="b" type="submit" name="signup" value="Sign Up"/></td></tr>
</form>
</table>
<h3 style="margin-top:20%;text-align:center"> Already have an account? </h3>
<p align="center"><a href="http://localhost/Southern_Railways/login.php">LOGIN NOW</a></p>
</div>
<!--<div class="hero-image"></div>-->
</div>
<?php
if(isset($_POST['signup']))
{

$firstname=$_POST["firstname"];
$lastname=$_POST["lastname"];
$username=$firstname . " " . $lastname;
$email=$_POST["email"];
$password=$_POST["password"];
$cpassword=$_POST["cpassword"];
$date=date("y/m/d");
$time=date("h:i:sa");
$dob=$_POST["dob"];
$gender=$_POST["gender"];
$state=$_POST["state"];
$city=$_POST["city"];
$address=$_POST["address"];
$phoneno=$_POST["pnumber"];
$qry1="SELECT * FROM signup";
$res1 = $conn->query($qry1);
if ($res1->num_rows > 0) {
    while ($row1 = $res1->fetch_assoc())
    {
      if($username==$row1['username']){
            echo"<script> alert('This Account is Already Exists')</script>";
            goto x;
      }
    }
}
if($password==$cpassword)
{
  $qry2="INSERT INTO signup VALUES('$username','$email','$password','$cpassword','$date','$time')";
  $qry3="INSERT INTO profile VALUES('$username','$dob','$gender','$email','$state','$city','$address','$phoneno')";
  if($conn->query($qry2) && $conn->query($qry3))
  {
        echo "<script> alert('Signup successful')</script>";
        header('Location: http://localhost/Southern_Railways/railways.php'); 
  }      
}
else{
   echo"<script> alert('Password Mismatch')</script></center>";
} 
x:mysqli_close($conn);
}
?>
</body>
</html>