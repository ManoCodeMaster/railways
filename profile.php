<?php
session_start();
$conn = new mysqli("localhost","root","","southern_railways");
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
$username = $_SESSION["user"];
$qry1 = "SELECT * FROM profile where username='$username'";
$res1 = $conn->query($qry1);
if ($res1->num_rows > 0) {
    while ($row1 = $res1->fetch_assoc()) {
            echo "<!DOCTYPE html>";
            echo "<html>";
            echo "<head>";
            echo "</head>";
            echo "<body>";
            echo "<img style='margin-top:5px;' src='profile.jpeg' style='border-radius:100px;'/>";
            echo "<h1 style='margin-left:45px;margin-top:0px;'><u>Profile</u></h1>";
            echo "<button style='margin-left:45px;text-align:center;display:block;' type='button'> Edit </button>";
            echo "<table style='display:inline-block;margin-left:10%;'><form method='post'>";
            echo "<tr><td><h3> Username:</h2></td><td>" . $row1['username'] . "</td></tr>";
            echo "<tr><td><h3> Date of Birth:</h2></td><td>" . $row1['dob'] . "</td></tr>";
            echo "<tr><td><h3> Gender:</h2></td><td>" . $row1['gender'] . "</td></tr>";
            echo "<tr><td><h3> Email:</h2></td><td>" . $row1['email'] . "</td></tr>";
            echo "<tr><td align='center'><input type='submit' name='logout' value='Logout'/></td><td align='center'><input type='submit' name='back' value='Back'/></td></tr></table>";
            echo "<table style='display:inline-block;margin-left:10%'>";
            echo "<tr><td><h3> State:</h2></td><td>" . $row1['state'] . "</td></tr>";
            echo "<tr><td><h3> City:</h2></td><td>" . $row1['city'] . "</td></tr>";
            echo "<tr><td><h3> Address:</h2></td><td>" . $row1['address'] . "</td></tr>";
            echo "<tr><td><h3> Phone Number:</h2></td><td>" . $row1['phoneno'] . "</td></tr></table>";
            
    }
}
if(isset($_POST['logout']))
//if($_SERVER["REQUEST_METHOD"]==POST)
{
    session_destroy();
    header('Location: http://localhost/Southern_Railways/railways.php');
}
if(isset($_POST['back'])){
    header('Location: http://localhost/Southern_Railways/southern_railways.php');
}
mysqli_close($conn);
?>
</body>
</html>