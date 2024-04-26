<?php
  session_start();
  $conn=new mysqli('localhost','root','','southern_railways');
  if($conn->connect_error){
    die("Connection Failed".$conn->connect_error);
  }
?>
<!DOCTYPE html>
<head>
<style>
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
section{
  margin-left:20%;
  padding:1px 16px;
  height:100%;
  display:block;
}
select{
  margin:3% 2%;
  width:90%;
  height:10%;
  text-align:center;
  font-size:20px;
}
.c{
  margin:1% 25% 1% 25%;
  font-size:20px;
  border:2px solid black;
}
.passenger{
  display:flex;
  justify-content:center;
  align-items:center;
  height:100%;
  border:2px solid black;
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
  function showTab() {
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
    function addPassenger(event) {
    //event.preventDefault(); // Prevent the default form submission
    var p_name = document.getElementsByName('p_name')[0].value;
    var p_age = document.getElementsByName('p_age')[0].value;
    var gender = document.querySelector('input[name="gender"]:checked');
    var berth_preference = document.getElementsByName('berth_preference')[0].value;

    if (p_name.trim() === '' || p_age.trim() === '' || !gender || berth_preference.trim() === '') {
        alert('Please fill in all required fields.');
        return false; // Prevent further propagation
    }
    document.getElementById("passengerForm").submit();
    document.getElementById("p_delete").submit();
    hideDuplicatePassengerForm();
    //document.getElementById("passenger").style.display="none";
    return false; // Prevent further propagation
}    
</script>
</head>
<body>
<section id='booking'>
<div class="a">
<form id='booking_form' method="post" style="margin:3%;">
<table align="center">
    <tr><td style="font-size:25px"><input list="fromstation" id="from" name="from" placeholder="From Station" required/>
    <datalist id="fromstation">
<?php
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
                              <option value="AC First Class (1A)">AC First Class (1A)</option>
                              <option value="Ac 2 Tier (2A)">AC 2 Tier (2A)</option>
                              <option value="Ac 3 Tier (3A)">AC 3 Tier (3A)</option>
                              <option value="Sleeper (SL)">Sleeper (SL)</option></section></td></tr>
<tr><td><select name="quota" required> <option value="" disabled selected>Select a Quota</option>
                              <option value="GENERAL">GENERAL</option>
                              <option value="Tatkal">Tatkal</option></section></td></tr>
<tr><td><label style="font-size:20px;' for="date">Select an Departure Date: </label></td></tr>
<tr><td><input style="margin:3% 2%;width:90%;height:10%;text-align:center;font-size:20px;" type="date" name="date" id="date" required/></td></tr><tr><td></td></tr><tr><td></td></tr>
<tr> <td colspan="2" style="font-size:25px;text-align:center;"><input style="padding:10px 120px;background-color:green;color:white;" type="submit" name="search_train" value="Search Trains"/></td></tr>
</table>
</form>
</div>
<?php
if(isset($_POST['search_train2']) || isset($_POST['search_train']))
{
  session_destroy();
  $from=$_POST['from'];
  $to=$_POST['to'];
  $class=$_POST['class'];
  $quota=$_POST['quota'];
  $date=$_POST['date'];
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
    $_SESSION['passenger_details'][] = $passenger_details;
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
  echo "<tr><td colspan='2' width='100%'>".$a_time."<br>".$from."<br>".$dayofweek.", ".$date."</td><td width='100%' colspan='2' align='right'>".$l_time."<br>".$to."<br>";
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
  
  echo"<tr><td colspan='4'><button style='margin-left:5%' type='button' onclick='showTab()'>+ Add New</button></td></tr>";
  echo"<div id='$form_id'><tr id='passenger' style='display:none'><td>";
  echo"<form id='$form_id' method='post'><table align='center'>
    <tr><td align='center'>ADD PASSENGER DETAILS </td></tr>";
    echo"<input type='hidden' name='from' value='".$from."'/><input type='hidden' name='to' value='".$to."'/>
    <input type='hidden' name='class' value='".$class."'/><input type='hidden' name='quota' value='".$quota."'/>
    <input type='hidden' name='date' value='".$date."'/><input type='hidden' name='t_name' value='".$t_name."'/>
    <input type='hidden' name='t_no' value='".$t_no."'/><input type='hidden' name='a_time' value='".$a_time."'/>
    <input type='hidden' name='l_time' value='".$l_time."'/>";
  echo"  <tr><td><input type='text' name='p_name' placeholder='Name' required/></td></tr>
    <tr><td><input type='number' name='p_age' placeholder='Age(above 4 years)' required/></td></tr>
    <tr><td><h4>Gender</h4><input type='radio' name='gender' value='Male' required/>Male<input type='radio' name='gender' value='Female' required/>Female<input type='radio' name='gender' value='Transgender' required/>Transgender</td></tr>
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
  echo"<input type='submit' name='search_train2' value='Back' style='text-align:center;font-size:20px;width:100%;'/></from></td>";
  echo"<td width='100%' colspan='2'><form method='post'><br><br><input type='submit'  name='payment' value='Pay' style='text-align:center;font-size:20px;width:100%;'/></td></tr></form></table></div>";          
}
?>
</section>
</body>
</html>