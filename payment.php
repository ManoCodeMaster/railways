<?php
  session_start();
  //Import PHPMailer classes into the global namespace
  //These must be at the top of your script, not inside a function
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  //required files
  require 'phpmailer/src/Exception.php';
  require 'phpmailer/src/PHPMailer.php';
  require 'phpmailer/src/SMTP.php';

  $n=count($_SESSION['passenger_details']);
  $amount=$_SESSION['amount'];
  if(isset($_POST['payment_done'])){
    $n=count($_SESSION['passenger_details']);
    $amount=$_SESSION['amount'];
    $conn=new mysqli('localhost','root','','southern_railways');
    if($conn->connect_error){
        die('connect Failed:'.$conn->connect_error);
    }
    $qry3="SELECT email from profile where username='".$_SESSION['user']."'";
    $res=$conn->query($qry3);
    if($row=$res->fetch_assoc()){
        $email=$row['email'];
    }
    $mail = new PHPMailer(true);
 
    //Server settings
    $mail->isSMTP();                              //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;             //Enable SMTP authentication
    $mail->Username   = 'manob2304@gmail.com';   //SMTP write your email
    $mail->Password   = 'qcef mgox cdog tvmg';      //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
    $mail->Port       = 465;                                    
 
    //Recipients
    $mail->setFrom('manob2304@gmail.com'); // Sender Email and name
    $mail->addAddress($email);     //Add a recipient email  
    $mail->addReplyTo('manob2304@gmail.com'); // reply to sender email
 
    //Content
    $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject = 'Payment';   // email subject headings
    $mail->Body  = '<img style="border-radius:50%;width:150px;height:150px;" align="center" src="img6.jpeg" /img><br>';
    $mail->Body .= '<h2> Payment Successfull... </h2>'; //email message
    $mail->Body .= '<p>Total Amount paid: Rs.' . ($n * $amount) . '</p>';
    $mail->Body .= '<table><tr><td>Train Name:</td><td>'.$_SESSION['t_name'].'</td></tr>';
    $mail->Body .= '<tr><td> Train No:</td><td>'.$_SESSION['t_no'].'</td></tr>';
    $mail->Body .= '<tr><td> From:</td><td>'.$_SESSION['from'].'</td></tr>';
    $mail->Body .= '<tr><td> To:</td><td>'.$_SESSION['to'].'</td></tr></table>';
    $mail->Body .= '<h3> Passenger Details </h3>';
    foreach ($_SESSION['passenger_details'] as $passenger) {
        $p_name = $passenger['p_name'];
        $p_age = $passenger['p_age'];
        $gender = $passenger['gender'];
        $berth_preference = $passenger['berth_preference'];
        $mail->Body .= '<table><tr><td>Name</td><td>'.$p_name.'</td></tr><tr><td>Age</td><td>'.$p_age.'</td></tr><tr><td>Gender</td><td>'.$gender.'</td></tr><tr><td>Berth Preference:</td><td>'.$berth_preference.'</td></tr></table><br><br>';
    }  
    // Success sent message alert
    $mail->send();
    $date=$_SESSION['travel_date'];
    foreach ($_SESSION['passenger_details'] as $passenger) {
        $p_name=$passenger['p_name'];$p_age=$passenger['p_age'];$gender=$passenger['gender'];
        $berth_preference=$passenger['berth_preference'];
        $qry="INSERT INTO passenger_details VALUES('$p_name',$p_age,'$gender','$berth_preference','$date')";
        $result=$conn->query($qry);
    }
    $p_name=$_POST['name'];$c_no=$_POST['c_no'];
    $expiry=$_POST['expiry'];$cvv_cvc=$_POST['cvv/cvc'];
    $qry2="INSERT INTO payment VALUES('$p_name',$c_no,'$expiry','$cvv_cvc',$n,($n*$amount),'$date')";
    $result2=$conn->query($qry2);
    if($result && $result2){
    echo "<script> window.alert('Payment Successful');
    window.location.href = 'http://localhost/Southern_Railways/southern_railways.php';
    </script>";
    }
}
?>
<!DOCTYPE html>
<head>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #0C4160;

    padding: 30px;
}
.form-container{
    margin:5% 20%;
    width:450px;
    height:450px;
    background-color:white;
}
.textbox-container{
    width:90%;
    height:50px;
    font-size:20px;
}
.textbox-container2{
    width:80%;
    height:50px;
    font-size:20px;
}
</style>
<script>
</script>
</head>
<body>
    <div class="form-container">
        <form method="post">
            <table style="width:100%;margin:5%;">
                <caption style="font-size:30px;text-align:center;">Payement Details</caption>
                <tr><td colspan="2"><br><label style="font-size:20px;" for="name">Pesrson Name:</label></td></tr>
                <tr><td colspan="2"><input class="textbox-container" type="text" name="name" id="name" placeholder="Name" required/></td></tr>
                <tr><td colspan="2"><br><label style="font-size:20px;" for="c_no">Card Number:</label></td></tr>
                <tr><td colspan="2"><input class="textbox-container" type="number" name="c_no" id="c_np" placeholder="16-digit number" required/></td></tr>
                <tr><td><br><label style="font-size:20px;" for="exp">Expiry:</label><br><input class="textbox-container2" type="text" name="expiry" id="exp" placeholder="MM/YYYY" required/></td>
                    <td><br><label style="font-size:20px;" for="cvv/cvc">CVV/CVC:</label><br><input class="textbox-container2" type="password" name="cvv/cvc" id="cvv/cvc" placeholder="***" required/></td></tr>
                <?php
                 echo'<tr><td colspan="2"><br><input class="textbox-container" type="submit" name="payment_done" value="Pay Rs.'.($n*$amount).'"/></td></tr>';
                 ?>
            </table>
        </form>
    </div>
</body>

