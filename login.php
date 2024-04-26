<?php
session_start();
$conn=new mysqli("localhost","root","","southern_railways");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html>
<head>
<title> Login page </title>
<style>
body{
  margin:0px;
}
.container{
  display:flex;
}
.login-container{
  margin:0px 0px 0px 0px;
  padding:10px;
  border:1px solid blue;
  width:25%;
  height:630px;
}
.b{
  width:300px;
  height:40px;
  font-size:20px;
}
.hero-image{
  background-image:url("img7.webp");
  background-color:#cccccc;
  height:100vh;
  width:75%;
  background-position:center;
  background-repeat:no-repeat;
  background-size:cover;
  position:relative;
  margin-left:0%;
}
</style>
<script>
    function togglepassword() {
        var x = document.getElementById('pass');
        if (x.type == "password") x.type = "text";
        else x.type = "password"
    }
</script>
</head>
<body>
<div class="container">
    <div class="login-container">
        <table border="0" align="center">
            <form method="post">
                <caption> <img style="border-radius:50%;width:100px;height:100px;" src="img6.jpeg" /img> </caption>
                <tr> <td> <u><h2 align="center">Login</h2></u></td></tr>
                <tr> <td style="font-size:25px"><label for="uname">User Name</label></td></tr>
                <tr> <td><input class="b" type="text" id="uname" name="username" width="300" height="100" placeholder="enter a username" required/></td></tr>
                <tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>
                <tr> <td style="font-size:25px"><label for="pass">Password:</td></tr>
                <tr> <td><input class="b" id="pass" type="password" id="pass" name="password" width="300" height="100" placeholder="enter a password" required/></td></tr>
                <tr><td><input type="checkbox" onclick="togglepassword()" value="Show Password"/><label>Show Password</label></td></tr>
                <tr><td></td></tr><tr><td></td></tr>
                <tr> <td align="center"> <input class="b" type="submit" name="login" value="Login" width="300" height="100"/></td></tr>
                <tr><td></td></tr><tr><td></td></tr>
                <tr> <td align="center"> <a color="black" href="http://localhost/Southern_Railways/resetpassword.php">Forget password?</a></td></tr>
            </form>
         </table>
         <h3 style="margin-top: 20%; text-align: center;"> Don't have an account? </h3>
         <p align="center"><a href="http://localhost/Southern_Railways/signup.php">SIGN UP NOW</a></p>
    </div>
    <div class="hero-image"></div>
</div>

<?php
if(isset($_POST['login']))
{
$username=$_POST["username"];
$_SESSION["user"]=$username;
$password=$_POST["password"];
$date=date("y/m/d");
$time=date("h:i:sa");
$qry1 = "SELECT * FROM signup";
$res1 = $conn->query($qry1);
if ($res1->num_rows > 0) {
    while ($row1 = $res1->fetch_assoc())
    {
        if($username==$row1['username'])
        {
             if($password==$row1['password'])
             {            
                $qry2="INSERT INTO login VALUES('$username','$password','$date','$time')";
                if($conn->query($qry2)){
                  echo "<script>
                  window.alert('Login Successful');
                  window.location.href = 'http://localhost/Southern_Railways/southern_railways.php';
                 </script>";
                   goto x;
                }
            }
        }
     }
}
echo"<script> alert('Invalid Username or Password')</script>";
x:mysqli_close($conn);
}
?>
</body>
</html>