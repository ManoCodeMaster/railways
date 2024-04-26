<?php 
session_start();
if(isset($_POST['logout'])) {
    header('Location: http://localhost/Southern_Railways/railways.php');
    session_destroy();
}
?>
<!DOCTYPE html>
<html>
<head>
<title> Southern Railways Reservation </title>
<style>
body{
    margin:0px;
}
ul{
  list-style-type:none;
  margin:0px;
  padding:0px;
  background-color:black;
  width:20%;
  position:fixed;
  overflow:auto;
  height:100%;
}
li button{
  display:block;
  text-decoration:none;
  background-color:#333;
  color:white;
  padding:20px 30px;
  width:100%;
}
li{
  border-bottom:1px solid #bbb;
}
li button.active{
  background-color:#04AA6D;
}
li button:hover:not(.active){
  background-color:#111;
}
.tab-content {
  display: none;
}
.tab-content.active {
  display: block;
}
section{
  margin-left:20%;
  padding:1px 16px;
  height:100%;
  display:block;
}
.a{
  margin:3% 25% 2% 25%;
  border:1px solid black;
}
input[list]{
  border:none;
  border-bottom:1px solid black;
  padding:10px 30px;
  font-size:20px;
}
input:focus{
  outline:none;
}
input:focus-within{
  outline:1px solid green;
}
.search-container{
  display:flex;
  flex-direction:row;
  border:1px solid black;
  padding:3px;
}
.search{
  border:1px solid green;
  background:green;
  colr:white;
  width:100%;
  font-size:20px;
}
.b{
  margin:3% 25% 2% 25%;
  border:1px solid black;
  background-color:blue;
  font-color:white;
  border-top:2px solid black;
  border-bottom:2px solid black;
  padding:10px;
  text-align:center;
}
.c{
  margin:1% 25% 1% 25%;
  font-size:25px;
  border:2px solid black;
}
.custom-button{
  padding:5px;
  background-color: white;
  color: black;
  //text-align: center;
  //line-height: 50px;
  cursor: pointer;
  user-select: none;
  transition: background-color 0.3s;
  margin:1% 25% 1% 25%;
  font-size:25px;
  border-bottom:2px solid black;
}
.custom-button:hover{
  background-color: #2980b9;
  color:white;
}
select{
  margin:3% 2%;
  width:90%;
  height:10%;
  text-align:center;
  font-size:20px;
}
passenger{
  display:flex;
  justify-content:center;
  align-items:center;
  height:100%;
}
.form-container{
    margin:10% 20%;
    width:450px;
    height:450px;
    background-color:white;
    border:2px solid black;
    border-radius:5%;
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
  function showTab(tabName) {
            var tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(function(tab) {
                tab.classList.remove('active');
            });
            var selectedTab = document.getElementById(tabName);
            selectedTab.classList.add('active');
        }
function showPassengerForm() {
    var passengerForm = document.getElementById("passenger");
    if(passengerForm.style.display === "none"){
       passengerForm.style.display = "block";
    }else{
    passengerForm.style.display = "none";
  }
}
function hideDuplicatePassengerForm(){
        var duplicatePassengerForm = document.getElementById("passenger");
        if (duplicatePassengerForm.style.display === "block") {
            duplicatePassengerForm.style.display = "none";
        }
    }
        function setActiveTab() {
            <?php
            if (isset($_POST['find'])) {
                echo 'showTab("Train_search");';
            }elseif(isset($_POST['find2'])){
                echo 'showTab("Train_search");';
            }elseif(isset($_POST['show_train'])){
                echo 'showTab("Train_search");';
            }elseif (isset($_POST['t_no_search'])) {
                echo 'showTab("Train_search");';
            }elseif (isset($_POST['departure_search'])) {
                echo 'showTab("Train_search");';
            }elseif(isset($_POST['departure_search2'])){
                echo'showTab("Train_search");';
            }elseif(isset($_POST['show_train2'])){
                echo'showTab("Train_search");';
            }elseif(isset($_POST['search_train'])){
                echo'showTab("Booking");';
            }elseif(isset($_POST['SL']) || isset($_POST['3AC']) || isset($_POST['2AC']) || isset($_POST['1AC'])){
                echo'showTab("Booking");';
            }elseif(isset($_POST['search_train2'])){
                echo'showTab("Booking");';
            }elseif(isset($_POST['addpassenger'])){
                echo'showTab("Booking");';
            }elseif(isset($_POST['delete'])){
                echo'showTab("Booking");';
            }        
            ?>
        }
        document.addEventListener('DOMContentLoaded', function () {

            setActiveTab();
        });
        function addPassenger(event) {
    //event.preventDefault(); 
    var p_name = document.getElementsByName('p_name')[0].value;
    var p_age = document.getElementsByName('p_age')[0].value;
    var gender = document.querySelector('input[name="gender"]:checked');
    var berth_preference = document.getElementsByName('berth_preference')[0].value;

    if (p_name.trim() === '' || p_age.trim() === '' || !gender || berth_preference.trim() === '') {
        alert('Please fill in all required fields.');
        return false; 
    }
    document.getElementById("passengerForm").submit();
    document.getElementById("p_delete").submit();
    hideDuplicatePassengerForm();
    return false;
}           
</script>
</head>
<body>
<ul>
   <!--<li> <button class="active" type="button" onclick="showTab('home')">Home</button></li>-->   
   <li> <button class="active" type="button" onclick="showTab('profile')">Profile</button> </li>
   <li> <button type="button" onclick="showTab('Booking')">Booking</button> </li>
   <li> <button type="button" onclick="showTab('Train_search')">Train Search</button> </li>
   <!--<li> <button type="button">Food Order</button> </li>-->
</ul>
<!--<section id="home" class="tab-content active">-->
<!--<h1 style="text-align:center;"> Southern Railways Reservation </h1>-->
<!--</section>-->
<section id="Booking" class="tab-content">
<div class="a">
<form method="post" style="margin:3%;">
<table align="center">
    <tr><td style="font-size:25px"><input list="fromstation" id="from" name="from" placeholder="From Station" required/>
    <datalist id="fromstation">
<?php
  $conn=new mysqli('localhost','root','','southern_railways');
  if($conn->connect_error){
    die("Connection Failed:".$conn->connect_error);
  }
  $qry1="SELECT DISTINCT stops from stations";
  $result=$conn->query($qry1);
  if($result->num_rows>0)
  {
     while($row=$result->fetch_assoc()){
        echo '<option value="'.$row['stops'].'">';
  }}
?>
    </datalist></td></tr>
    <tr><td colspan="2"><br></td></tr>
    <tr><td style="font-size:25px"><input list="tostation" id="to" name="to" placeholder="To Station" required/>
    <datalist id="tostation">
<?php
  $qry1="SELECT DISTINCT stops from stations";
  $result=$conn->query($qry1);
  if($result->num_rows>0)
  {
     while($row=$result->fetch_assoc()){
                 echo'<option value="'.$row['stops'].'">';
  }}
?>
</datalist></td></tr>
<tr><td><select name="class" required> <option value="" disabled selected> Select a Class</option>
                              <option value="All Classes">All Classes</option>
                              <option value="AC First Class (1AC)">AC First Class (1A)</option>
                              <option value="Ac 2 Tier (2AC)">AC 2 Tier (2A)</option>
                              <option value="Ac 3 Tier (3AC)">AC 3 Tier (3A)</option>
                              <option value="Sleeper (SL)">Sleeper (SL)</option></select></td></tr>
<tr><td><select name="quota" required> <option value="" disabled selected>Select a Quota</option>
                              <option value="GENERAL">GENERAL</option>
                              <option value="Tatkal">Tatkal</option></select></td></tr>
<tr><td><label style="font-size:20px;' for="date">Select an Departure Date: </label></td></tr>
<tr><td><input style="margin:3% 2%;width:90%;height:10%;text-align:center;font-size:20px;" type="date" name="date" id="date" required/></td></tr><tr><td></td></tr><tr><td></td></tr>
<tr> <td colspan="2" style="font-size:25px;text-align:center;"><input style="padding:10px 120px;background-color:green;color:white;" type="submit" name="search_train" value="Search Trains"/></td></tr>
</table>
</form>
</div>
<?php
if(isset($_POST['search_train2']) || isset($_POST['search_train']))
{
  unset($_SESSION['passenger_details']);
  $from=$_POST['from'];
  $to=$_POST['to'];
  $class=$_POST['class'];
  $quota=$_POST['quota'];
  $date=$_POST['date'];$_SESSION['travel_date']=$date;
  $dayofweek=date('l',strtotime($date));
  $qry="SELECT t.t_no,t.t_name,t.s_time,t.e_time,t.ticket_price,t.SL,t.3AC,t.2AC,t.1AC,t.R_charges,t.S_charges,s_start.stops,s_start.stops_no,s_start.arrive_time as a_time,s_end.stops,s_end.stops_no,s_end.arrive_time as l_time,s_end.distance-s_start.distance as distance FROM trains t JOIN stations s_start ON t.t_no = s_start.t_no JOIN stations s_end ON t.t_no = s_end.t_no
  WHERE
      s_start.stops = '$from'
      AND s_end.stops = '$to'
      AND s_start.stops_no < s_end.stops_no 
      ORDER BY a_time ASC;";
  $result=$conn->query($qry);
  if($result->num_rows > 0)
  {
    while($row=$result->fetch_assoc()){
      echo "<div class='c'><table><form method='post'>";
      echo"<input type='hidden' name='from' value='".$from."'/>";
      echo"<input type='hidden' name='to' value='".$to."'/>";
      echo"<input type='hidden' name='class' value='".$class."'/>";
      echo"<input type='hidden' name='quota' value='".$quota."'/>";
      echo"<input type='hidden' name='date' value='".$date."'/>";
      echo "<tr><td width='100%' colspan='4'><h3>".$row['t_name']."(".$row['t_no'].")</h3></td></tr>";
      echo "<input type='hidden' name='t_name' value='".$row['t_name']."'/>";
      echo "<input type='hidden' name='t_no' value='".$row['t_no']."'/>";
      echo "<tr><td colspan='2'>".$row['a_time']."<br>".$from."<br>".$dayofweek.", ".$date."</td><td width='100%' colspan='2' align='right'>".$row['l_time']."<br>".$to."<br>";
      echo "<input type='hidden' name='a_time' value='".$row['a_time']."'/>";
      echo "<input type='hidden' name='l_time' value='".$row['l_time']."'/>";
      if($row['a_time']<$row['l_time']){echo"".$dayofweek.", ".$date."</td></tr>";}
      else{ $next_day = date('l', strtotime($date . '+1 day'));
            $next_date = date('Y-m-d', strtotime($date . ' +1 day'));
            echo"".$next_day.", ".$next_date."</td></tr>";
      }
      echo "<tr><td></td><td></td><td></td><td></td></tr>";
      echo "<tr>";
      if($row['SL']>0){echo"<td><input style='padding:5px 10px;' type='submit' name='SL'  value='Rs.".(int)($row['distance']*0.80)+$row['R_charges']+$row['S_charges']."(SL)'/></td>";}
      if($row['3AC']>0){echo"<td><input style='padding:5px 10px;' type='submit' name='3AC' value='Rs.".(int)($row['distance']*2.80)+$row['R_charges']+$row['S_charges']."(3AC)'/></td>";}
      if($row['2AC']>0){echo"<td><input style='padding:5px 10px;' type='submit' name='2AC' value='Rs.".(int)($row['distance']*3.80)+$row['R_charges']+$row['S_charges']."(2AC)'/></td>";}
      if($row['1AC']>0){echo"<td><input style='padding:5px 10px;' type='submit' name='1AC' value='Rs.".(int)($row['distance']*6.80)+$row['R_charges']+$row['S_charges']."(1AC)'/></td>";}
      echo "</tr></table></div></form>";
    }
  }
}
if(isset($_POST['delete']) || isset($_POST['addpassenger']) || isset($_POST['SL']) || isset($_POST['3AC']) || isset($_POST['2AC']) || isset($_POST['1AC']))
{
  $form_id='passengerForm';
  if (isset($_POST['addpassenger'])) {
    $form_id = 'passengerForm_' . $_POST['p_name'];
    $p_name = $_POST['p_name'];
    $p_age = $_POST['p_age'];
    $gender = $_POST['gender'];
    $berth_preference = $_POST['berth_preference'];
    $passenger_details = array(
        'p_name' => $p_name,
        'p_age' => $p_age,
        'gender' => $gender,
        'berth_preference' => $berth_preference
    );
    if(isset($_SESSION['passenger_details'])) {
        $_SESSION['passenger_details'][] = $passenger_details;
    } else {
        $_SESSION['passenger_details'] = array($passenger_details);
    }
}
  if(isset($_POST['delete'])){
        $name=$_POST['name'];
        if (isset($_SESSION['passenger_details'])) {
          foreach ($_SESSION['passenger_details'] as $key => $passenger) {
              if ($passenger['p_name'] === $name) {
                  unset($_SESSION['passenger_details'][$key]);
                  break;
              }
          }
      }
}
  if(isset($_POST['SL'])){
    $rate=0.80;
    $coach='SL';
  }elseif(isset($_POST['3AC'])){
    $rate=2.80;
    $coach='3AC';
  }elseif(isset($_POST['2AC'])){
    $rate=3.80;
    $coach='2AC';
  }elseif(isset($_POST['1AC'])){
    $rate=6.80;
    $coach='1AC';
  }
  $from=$_POST['from'];echo"<input type='hidden' name='from' value='".$from."'/>";
  $to=$_POST['to'];echo"<input type='hidden' name='to' value='".$to."'/>";
  $class=$_POST['class'];echo"<input type='hidden' name='class' value='".$class."'/>";
  $quota=$_POST['quota'];echo"<input type='hidden' name='quota' value='".$quota."'/>";
  $date=$_POST['date'];echo"<input type='hidden' name='date' value='".$date."'/>";
  $t_name=$_POST['t_name'];echo"<input type='hidden' name='t_name' value='".$t_name."'/>";
  $t_no=$_POST['t_no'];echo"<input type='hidden' name='t_no' value='".$t_no."'/>";
  $a_time=$_POST['a_time'];echo"<input type='hidden' name='a_time' value='".$a_time."'/>";
  $l_time=$_POST['l_time'];echo"<input type='hidden' name='l_time' value='".$l_time."'/>";
  $dayofweek=date('l',strtotime($date));
  $qry="SELECT t.R_charges,t.S_charges,s_end.distance - s_start.distance as distance from trains t join stations s_start on t.t_no=s_start.t_no join stations s_end on t.t_no=s_end.t_no 
  where t.t_no=$t_no
  and s_start.stops='$from'
  and s_end.stops='$to'";
  $result=$conn->query($qry);
  if($r=$result->fetch_assoc()){
    $r_charges=$r['R_charges'];
    $s_charges=$r['S_charges'];
    $distance=$r['distance'];
  }
  echo "<div class='c'><table>";
  echo "<tr><td width='100%' colspan='4'><h3>".$t_name."(".$t_no.")</h3></td></tr>";
  $_SESSION['t_name']=$t_name;$_SESSION['t_no']=$t_no;
  echo "<tr><td colspan='2' width='100%'>".$a_time."<br>".$from."<br>".$dayofweek.", ".$date."</td><td width='100%' colspan='2' align='right'>".$l_time."<br>".$to."<br>";
  $_SESSION['from']=$from;$_SESSION['to']=$to;
  if($a_time<$l_time){
   echo"".$dayofweek.", ".$date."</td></tr>";
  }else{ 
     $next_day = date('l', strtotime($date . '+1 day'));
     $next_date = date('Y-m-d', strtotime($date . ' +1 day'));
     echo"".$next_day.", ".$next_date."</td></tr>";
  }
  echo "<tr><td></td><td></td><td></td><td></td></tr>";
  echo "<tr><td></td><td></td><td></td><td></td></tr>";
  echo"<tr><td colspan='4' align='center'>FARE BREAKUP<br>".$from."&nbsp&nbsp&nbsp&nbsp<span style='font-size:50px;'>&#8594;</span>&nbsp&nbsp&nbsp&nbsp".$to."</td></tr>";
  echo"<tr><td colspan='2'>Train No:".$t_no."</td><td colspan='2' width='100%' align='right'> Class:".$class."</td></tr>";
  echo"<tr><td colspan='2'>Base Fare:</td><td colspan='2' width='100%' align='right'>".(int)($distance*$rate)."</td></tr>";
  echo"<tr><td colspan='2'>Reservation Charges:</td><td colspan='2' width='100%' align='right'>".$r_charges."</td></tr>";
  echo"<tr><td colspan='2'>Superfast Charges:</td><td colspan='2' width='100%' align='right'>".$s_charges."</td></tr>";
  echo"<tr><td colspan='2'>Total Amount:</td><td colspan='2' width='100%'  align='right'>".(int)($distance*$rate)+$r_charges+$s_charges."</td></tr>";
  $_SESSION['amount']=(int)($distance*$rate)+$r_charges+$s_charges;
  echo"<tr><td colspan='4'><br><br><br></td></tr>";
  echo"<tr><td colspan='4'><h4>Select Passenger </h4></td></tr>";
  if(isset($_SESSION['passenger_details'])){
    echo"<tr><td colspan='4'><table>";
    foreach($_SESSION['passenger_details'] as $passenger){
      echo"<form id='p_delete' method='post'><input type='hidden' name='name' value='".$passenger['p_name']."'/>";
      echo"<input type='hidden' name='".$coach."' value='1'/>";
      echo"<input type='hidden' name='from' value='".$from."'/><input type='hidden' name='to' value='".$to."'/>
    <input type='hidden' name='class' value='".$class."'/><input type='hidden' name='quota' value='".$quota."'/>
    <input type='hidden' name='date' value='".$date."'/><input type='hidden' name='t_name' value='".$t_name."'/>
    <input type='hidden' name='t_no' value='".$t_no."'/><input type='hidden' name='a_time' value='".$a_time."'/>
    <input type='hidden' name='l_time' value='".$l_time."'/>";
      echo"<tr><td colspan='3'>".$passenger['p_name']."<br>".$passenger['p_age']."&nbsp&nbsp&nbsp&nbsp".$passenger['gender']."&nbsp&nbsp&nbsp&nbsp".$passenger['berth_preference']."<br><br></td><td><input type='submit' name='delete' value='Delete' /></form></td></tr>";
    }echo"</table></td></tr>";
  }
  
  echo"<tr><td colspan='4'><button style='margin-left:5%' type='button' onclick='showPassengerForm()'>+ Add New</button></td></tr>";
  echo"<div id=$form_id'><tr id='passenger' style='display:none'><td>";
  echo"<form id='$form_id' method='post'><table align='center'>
    <tr><td align='center'>ADD PASSENGER DETAILS </td></tr>";
    echo"<input type='hidden' name='from' value='".$from."'/><input type='hidden' name='to' value='".$to."'/>
    <input type='hidden' name='class' value='".$class."'/><input type='hidden' name='quota' value='".$quota."'/>
    <input type='hidden' name='date' value='".$date."'/><input type='hidden' name='t_name' value='".$t_name."'/>
    <input type='hidden' name='t_no' value='".$t_no."'/><input type='hidden' name='a_time' value='".$a_time."'/>
    <input type='hidden' name='l_time' value='".$l_time."'/>";
  echo"  <tr><td><input type='text' name='p_name' placeholder='Name' required/></td></tr>
    <tr><td><input type='number' name='p_age' placeholder='Age(above 4 years)' required/></td></tr>
    <tr><td><h4>Gender</h4><input type='radio' name='gender' value='Male' required/>Male<input type='radio' name='gender' value='Female' required/>Female<input type='radio' name='gender' value='Others' required/Others</td></tr>
    <tr><td><select name='berth_preference' required><option value='' disabled selected>Select Berth Preference</option>
                                                 <option value='No Preference'>No Preference</option>
                                                 <option value='Lower'>Lower</option>
                                                 <option value='Middle'>Middle</option>
                                                 <option value='Upper'>Upper</option>
                                                 <option value='Side Lower'>Side Lower</option>
                                                 <option value='Side Upper'>Side Upper</option></select></td></tr>
    <input type='hidden' name='".$coach."' value='1'/>
  <tr><td align='center'><input type='submit' onclick='return addPassenger(event)' name='addpassenger' value='Add Passenger'/></td></tr></table></form></td></tr></div>";
  echo"<tr><td width='100%' colspan='2'><br><br><form method='post'>";
  echo"<form method='post'><input type='hidden' name='from' value='".$from."'/>";
  echo"<input type='hidden' name='to' value='".$to."'/>";
  echo"<input type='hidden' name='class' value='".$class."'/>";
  echo"<input type='hidden' name='quota' value='".$quota."'/>";
  echo"<input type='hidden' name='date' value='".$date."'/>";
  echo"<input type='submit' name='search_train2' value='Back' style='text-align:center;font-size:20px;width:100%;'/></form></td>";
  echo"<td width='100%' colspan='2'><form action='http://localhost/Southern_Railways/payment.php'><br><br><input type='submit' name='payment' value='Pay' style='text-align:center;font-size:20px;width:100%;'/></td></tr></form></table></div>";          
}
?>
</section>
<section id="Train_search" class="tab-content">
<div class="a">
<center>
<form method="post" style="margin:3%;">
<table >
    <tr><td style="font-size:25px"><input list="fromstation" id="from" name="from" placeholder="From Station" required/>
    <datalist id="fromstation">
<?php
  $conn=new mysqli("localhost","root","","southern_railways");
if($conn->connect_error){
   die("Connection Failed:".$conn->connect_error);
}
  $qry1="SELECT DISTINCT stops from stations";
  $result=$conn->query($qry1);
  if($result->num_rows>0)
  {
     while($row=$result->fetch_assoc()){
        echo '<option value="'.$row['stops'].'">';
  }}
?>
    </datalist></td></tr>
    <tr><td colspan="2"><br></td></tr>
    <tr><td style="font-size:25px"><input list="tostation" id="to" name="to" placeholder="To Station" required/>
    <datalist id="tostation">
<?php
  $qry1="SELECT DISTINCT stops from stations";
  $result=$conn->query($qry1);
  if($result->num_rows>0)
  {
     while($row=$result->fetch_assoc()){
                 echo'<option value="'.$row['stops'].'">';
  }}
?>
</datalist></td></tr>
<tr><td></td></tr><tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>
<tr> <td colspan="2" style="font-size:25px;text-align:center;"><input style="padding:10px 120px;background-color:green;color:white;" type="submit" name="find" value="Find Trains"/></td></tr>
</table>
</form>
</center>
</div>
<div class="a">
<center>
<form method="post" class="search-container">
<!--<table class="search-container" style="margin:3%;">-->
<input style="flex-grow:2px;border:none;font-size:25px;" type="text" id="t_no" name="t_no" placeholder="Train No./Train Name" required/>
<input class="search" type="submit" name="t_no_search" value="search"/>
</form></center>
</div>
<div class="a">
<center>
<form method="post" class="search-container">
<!--<table class="search-container" style="margin:3%;">-->
<input style="flex-grow:2px;border:none;font-size:25px;" type="text" id="departure" name="departure" placeholder="Station departure board" required/>
<input class="search" type="submit" name="departure_search" value="search"/>
</form></center>
</div>
<div class="a" style="height:250px;">
<h3 style="color:blue;"> SEARCH HISTORY </h3>
<?php
   $sql="SELECT * from search ORDER BY s_no DESC LIMIT 5";
   $res=$conn->query($sql);
   if($res->num_rows > 0)
   {
       echo"<table style='float:left;font-size:25px;'>";
       while($row=$res->fetch_assoc()){
            echo"<tr class='custom-button'><td width='50px'>".$row['t_no']."</td><td width='50px'></td><td width='300px'>".$row['t_name']."</td></tr>";
       }
       echo"</table>";
   }
?>
</div>
<?php
if(isset($_POST['find2']) || isset($_POST['find']))
{
if(isset($_POST['find2']))
{
  $from=$_POST['return_from'];
  $to=$_POST['return_to'];
}
else{
  $from=$_POST['from'];
  $to=$_POST['to'];
}
//$_SESSION['from']=$from;
//$_SESSION['to']=$to;
echo "<h2 class='b'>" .$from. "&nbsp&nbsp&nbsp&nbsp<span style='font-size:50px;'>&#8594;</span>&nbsp&nbsp&nbsp&nbsp" .$to." </h2>";
$qry1="SELECT t.t_no,t.t_name,t.s_time,t.e_time,t.ticket_price,s_start.stops,s_start.stops_no,s_start.arrive_time as a_time,s_end.stops,s_end.stops_no,s_end.arrive_time as l_time FROM trains t JOIN stations s_start ON t.t_no = s_start.t_no JOIN stations s_end ON t.t_no = s_end.t_no
WHERE
    s_start.stops = '$from'
    AND s_end.stops = '$to'
    AND s_start.stops_no < s_end.stops_no 
    ORDER BY a_time ASC;";
$res=$conn->query($qry1);
if($res->num_rows > 0)
{
   while($row1=$res->fetch_assoc()){
        echo"<form method='post'><input type='hidden' name='selected_from' value='".$from."'/>";
        echo"<input type='hidden' name='selected_to' value='".$to."'/>"; 
         echo"<div class='c custom-button'> <p style='display:inline-block;margin-right:0px;'><span style='background-color:blue;font-color:white;'>".
         $row1['t_no']."</span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
         echo"<input type='hidden' name='selected_tno' value='".$row1['t_no']."'/>";
         echo"<input type='hidden' name='selected_tname' value='".$row1['t_name']."'/>";
         //$_SESSION['t_no']=$row1['t_no'];
         //$_SESSION['t_name']=$row1['t_name'];
         if($row1['a_time']=='00:00'){
                          echo"".$row1['s_time']."&nbsp&nbsp<span style='font-size:50px;'>&#8594;</span>&nbsp&nbsp";
         }else{
                          echo"".$row1['a_time']."&nbsp&nbsp<span style='font-size:50px;'>&#8594;</span>&nbsp&nbsp ";
         }if($row1['e_time']=='00:00'){
                          echo"".$row1['e_time']."<br>".$row1['t_name']." </p>";
         }else{
                          echo"".$row1['l_time']."<br>".$row1['t_name']." </p>";
   }echo"<input style='display:inline-block' type='submit' name='show_train' value='Click'/></form></div>";
  }}
}
if(isset($_POST['show_train']))
{
  $from=$_POST['selected_from'];
  $to=$_POST['selected_to'];
  $t_no=$_POST['selected_tno'];
  $t_name=$_POST['selected_tname'];
  $qry3="INSERT INTO search (t_no, t_name) VALUES ($t_no, '$t_name')";
  $result3=$conn->query($qry3);
  echo"<form method='post'><input type='hidden' name='return_from' value='".$from."'/>";
  echo"<input type='hidden' name='return_to' value='".$to."'/>";
  $qry2="SELECT leave_time from stations WHERE t_no=$t_no and stops='".$to."'";
  $qry="SELECT * FROM stations
  WHERE stops_no >= (SELECT stops_no FROM stations WHERE stops ='". $from."' AND t_no =$t_no) 
  AND stops_no <= (SELECT stops_no FROM stations WHERE stops ='".$to."' AND t_no = $t_no) 
  AND t_no =$t_no ORDER BY stops_no ASC";
  $result2=$conn->query($qry2);
  $result=$conn->query($qry);
  if($r=$result2->fetch_assoc()){
    $e_time=$r['leave_time'];
  }
  if($result->num_rows > 0)
  {
    echo "<h2 class='b' style='background-color:blue;color:white;'>".$t_no."&nbsp&nbsp&nbsp&nbsp".$t_name."</h2>";
    echo"<div class='c'><table align='center'><tr><td><h3> Arrival</h3></td><td></td> <td><h3>Stops</h3></td> <td></td><td><h3>Departure </h3></td></tr>";
    while($row=$result->fetch_assoc())
    {
      echo"<tr><td><p>".$row['arrive_time']."</p></td><td></td><td><p><span style='font-size:25px;'>&#9679;</span>".$row['stops']."</p></td><td></td><td><p>".$row['leave_time']."</p></td></tr>";
      echo"<tr><td></td><td></td>";
      if($e_time!=$row['leave_time']){echo"<td><span style='font-size:100px;'>&#8595;</span></td><td></td><td></td></tr>";}
    }
    echo"<tr><td colspan='3'><input type='submit' name='find2' value='Back'/></td></tr></table></form></div>";
  }
}
if(isset($_POST['t_no_search']))
{
   $t_no=$_POST['t_no'];
       $qry3="SELECT t_name from trains WHERE t_no=$t_no";
       $result2=$conn->query($qry3);
       if($r=$result2->fetch_assoc()){
           $t_name=$r['t_name'];
           $qry4="INSERT INTO search (t_no, t_name) VALUES ($t_no, '$t_name')";
           $result3=$conn->query($qry4);
       }
   $qry2="SELECT t.t_no, t.t_name,t.s_time,t.e_time, s.t_no, s.stops, s.stops_no, s.arrive_time, s.leave_time from trains t JOIN stations s WHERE t.t_no=$t_no and s.t_no=$t_no ORDER BY s.stops_no ASC;";
   $qry3="SELECT t_no,t_name from trains WHERE t_no=$t_no";
   $result1=$conn->query($qry3);
   $result2=$conn->query($qry2);
   if($r=$result1->fetch_assoc()){
      echo"<h2 class='b' style='background-color:blue;color:white;'>".$r['t_no']."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$r['t_name']."</h2>";
   }
   echo"<div class='c'><table align='center'><tr><td><h3> Arrival</h3></td><td></td> <td><h3>Stops</h3></td> <td></td><td><h3>Departure </h3></td></tr><ul>";
   if($result2->num_rows > 0)
   {
       while($row=$result2->fetch_assoc()){
           echo"<tr><td><p>";
           if($row['arrive_time']==$row['s_time']){echo"Start</p></td><td></td>";}
           else{echo"".$row['arrive_time']."</p></td><td></td>";}
           echo"<td><p><span style='font-size:25px;'>&#9679;</span>".$row['stops']."</p></td><td></td>";
           if($row['leave_time']==$row['e_time']){echo"<td><p>End</p></td></tr>";}
           else{echo"<td><p>".$row['leave_time']."</p></td></tr>";}
           echo"<tr><td></td><td></td>";
           if($row['e_time']!=$row['leave_time']){echo"<td><span style='font-size:100px;'>&#8595;</span></td><td></td><td></td></tr>";}
   }
   echo"</table></div>";
  }else {
    echo "No results found for the specified t_no.";
}

}
if(isset($_POST['departure_search2']) || isset($_POST['departure_search']))
{
  if(isset($_POST['departure_search2']))
  {
    $departure=$_POST['return_departure'];
  }
  else{
     $departure=$_POST['departure'];
  }
     $qry="SELECT t.t_no,t.t_name,t.start,t.end,t.s_time,t.e_time,s_start.stops,s_start.arrive_time, s_start.leave_time FROM trains t JOIN stations s_start ON t.t_no = s_start.t_no
     WHERE
         s_start.stops = '$departure' ORDER BY s_start.arrive_time ASC;";
     $result=$conn->query($qry);
     if($result->num_rows > 0)
     {
         echo"<h2 class='b'>".$departure." departure board</h2>";
         while($row=$result->fetch_assoc())
         {
            echo"<form method='post'><input type='hidden' name='departure_station' value='".$departure."'/>";
            echo"<div style='font-size:20px;' class='c custom-button'><form method='post'><table align='center'>";
            echo"<tr> <td></td> <td>Arrive Time</td><td></td><td>Departure Time </td></tr>";
            echo"<tr><td><span style='background-color:blue;font-color:white;'>".$row['t_no']."</span></td>";
            echo"<input type='hidden' name='departure_tno' value='".$row['t_no']."'/>";
            //$_SESSION['train_no']=$row['t_no'];
            if($row['s_time']==$row['arrive_time']){echo"<td>Start</td><td></td>";}
            else{ echo"<td>".$row['arrive_time']."</td><td></td>";}
            if($row['e_time']==$row['leave_time']){echo"<td> End </td></tr>";}
            else{echo"<td>".$row['leave_time']."</td></tr>";}
            echo"<tr><td colspan='3' width='75%'>".$row['t_name']."</td></tr>";
            echo"<input type='hidden' name='departure_tname' value='".$row['t_name']."'/>";
            echo"<tr><td colspan='3'><span style='font-size:25px;color:green;'>&#9679;</span>".$row['start']."</td></tr>";
            echo"<tr><td align='center'><span style='font-size:50px;'>&#8595;</span></td></tr>";
            echo"<tr><td><span style='font-size:25px;color:red;'>&#9679;</span>".$row['end']."</td></tr></table>";
            echo"<input style='display:inline-block' type='submit' name='show_train2' value='Click'/></form></div>";
            
         }
     }
}
if(isset($_POST['show_train2']))
{
  $departure=$_POST['departure_station'];
  echo"<form method='post'><input type='hidden' name='return_departure' value='".$departure."'/>";
  $t_no=$_POST['departure_tno'];
  $t_name=$_POST['departure_tname'];
  $qry3="INSERT INTO search (t_no, t_name) VALUES ($t_no, '$t_name')";
  $result3=$conn->query($qry3);
  $qry2="SELECT s_time,e_time from trains WHERE t_no=$t_no";
  $qry="SELECT * FROM stations
  WHERE stops_no >= (SELECT stops_no FROM stations WHERE stops ='".$departure."' AND t_no =".$t_no.")   
  AND t_no =".$t_no." ORDER BY stops_no ASC;";
  $result2=$conn->query($qry2);
  $result=$conn->query($qry);
  if($r=$result2->fetch_assoc()){
    $s_time=$r['s_time'];
    $e_time=$r['e_time'];
  }
  if($result->num_rows > 0)
  {
    echo "<h2 class='b' style='background-color:blue;color:white;'>".$t_no."&nbsp&nbsp&nbsp&nbsp".$t_name."</h2>";
    echo"<div class='c'><table align='center'><tr><td><h3> Arrival</h3></td><td></td> <td><h3>Stops</h3></td> <td></td><td><h3>Departure </h3></td></tr>";
    while($row=$result->fetch_assoc())
    {
      echo"<tr><td><p>";
      if($s_time==$row['arrive_time']){echo"Start</p></td><td></td>";}
      else{ echo"".$row['arrive_time']."</p></td><td></td>";}
      echo"<td><p><span style='font-size:25px;'>&#9679;</span>".$row['stops']."</p></td><td></td><td><p>";
      if($e_time==$row['leave_time']){echo"End</p></td></tr>";}
      else{echo"".$row['leave_time']."</p></td></tr>";}
      echo"<tr><td></td><td></td>";
      if($e_time!=$row['leave_time']){echo"<td><span style='font-size:100px;'>&#8595;</span></td><td></td><td></td></tr>";}
    }
    echo"<tr><td colspan='3'><input type='submit' name='departure_search2' value='Back'/></td></tr></table></form></div>";
  }
}
mysqli_close($conn);
?>                 
</section>
<section id="profile" class="tab-content active">
<?php
$conn = new mysqli("localhost", "root", "", "southern_railways");
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if(isset($_SESSION["user"])) {
    $username = $_SESSION["user"];
    
    $qry1 = "SELECT * FROM profile WHERE username='".$username."'";
    $res1 = $conn->query($qry1);
    
    if ($res1 && $res1->num_rows > 0) {
        while ($row1 = $res1->fetch_assoc()) {
            echo "<img src='profile.jpeg' style='border-radius:100px;'/>";
            echo "<div style='margin-left:45px;margin-top:0px'><h1><u>Profile</u></h1>";
            echo "<form method='post'>";
            echo "<table style='display:inline-block;margin-left:10%;'>";
            echo "<tr><td><h3> Username:</h3></td><td><input type='text' name='name' value='" . $row1['username'] . "'/></td></tr>";
            echo "<tr><td><h3> Date of Birth:</h3></td><td><input type='text' name='dob' value='" . $row1['dob'] . "'/></td></tr>";
            echo "<tr><td><h3> Gender:</h3></td><td><input type='text' name='gender' value='" . $row1['gender'] . "'/></td></tr>";
            echo "<tr><td><h3> Email:</h3></td><td><input type='email' name='email' value='" . $row1['email'] . "'/></td></tr>";
            echo "<tr><td><h3> State:</h3></td><td><input type='text' name='state' value='" . $row1['state'] . "'/></td></tr>";
            echo "<tr><td><h3> City:</h3></td><td><input type='text' name='city' value='" . $row1['city'] . "'/></td></tr>";
            echo "<tr><td><h3> Address:</h3></td><td><input type='text' name='address' value='" . $row1['address'] . "'/></td></tr>";
            echo "<tr><td><h3> Phone Number:</h3></td><td><input type='text' name='phoneno' value='" . $row1['phoneno'] . "'/></td></tr>";
            echo "<tr><td align='center'><input type='submit' name='update' value='Update'></form></td><td align='center'><form method='post'><input type='submit' name='logout' value='Logout'/></td></tr></table></form>";
            
        }
    } else {
        echo "No user found with the provided username.";
    }
} else {
    echo "User not logged in.";
}
if(isset($_POST['update'])){
    $username1 = $_SESSION["user"];
    
    $qry = "SELECT * FROM profile WHERE username='".$username1."'";
    $res = $conn->query($qry);
    if($row=$res->fetch_assoc()){
      if(isset($_POST['name']) && $_POST['name']!=$row['username']){
         $username=$_POST['name'];
         $qry1="UPDATE profile SET username='$username' WHERE username='".$row['username']."'";
         $qry2="UPDATE signup SET username='$username' WHERE username='".$row['username']."'";
         $res1=$conn->query($qry1);
         $res2=$conn->query($qry2);
         $_SESSION["user"]=$username;
      }
      if(isset($_POST['dob']) && $_POST['dob']!=$row['dob']){
        $dob=$_POST['dob'];
        $qry1="UPDATE profile SET dob='$dob' WHERE dob='".$row['dob']."'";
        $res1=$conn->query($qry1);
      }
      if(isset($_POST['gender']) && $_POST['gender']!=$row['gender']){
        $gender=$_POST['gender'];
        $qry1="UPDATE profile SET gender='$gender' WHERE gender='".$row['gender']."'";
        $res1=$conn->query($qry1);
      }
      if(isset($_POST['email']) && $_POST['email']!=$row['email']){
        $email=$_POST['email'];
        $qry1="UPDATE profile SET email='$email' WHERE email='".$row['email']."'";
        $qry2="UPDATE signup SET email='$email' WHERE email='".$row['email']."'";
        $res1=$conn->query($qry1);
        $res2=$conn->query($qry2);
      }
      if(isset($_POST['state']) && $_POST['state']!=$row['state']){
        $state=$_POST['state'];
        $qry1="UPDATE profile SET state='$state' WHERE state='".$row['state']."'";
        $res1=$conn->query($qry1);
      }
      if(isset($_POST['city']) && $_POST['city']!=$row['city']){
        $city=$_POST['city'];
        $qry1="UPDATE profile SET city='$city' WHERE city='".$row['city']."'";
        $res1=$conn->query($qry1);
      }
      if(isset($_POST['address']) && $_POST['address']!=$row['address']){
        $address=$_POST['address'];
        $qry1="UPDATE profile SET address='$address' WHERE address='".$row['address']."'";
        $res1=$conn->query($qry1);
      }
      if(isset($_POST['phoneno']) && $_POST['phoneno']!=$row['phoneno']){
        $phoneno=$_POST['phoneno'];
        $qry1="UPDATE profile SET phoneno='$phoneno' WHERE phoneno='".$row['phoneno']."'";
        $res1=$conn->query($qry1);
      }
      if($res1 || $res2){
        echo"<script>alert('Update Successful')</script>";
        echo "<meta http-equiv='refresh' content='0'>";
      }
    }
}

mysqli_close($conn);
?>
</section>
</body>
</html>