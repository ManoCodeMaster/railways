<?php
session_start();
$conn=new mysqli("localhost","root","","southern_railways");
if($conn->connect_error){
   die("Connection Failed:".$conn->connect_error);
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
.a{
  margin:3% 30% 2% 30%;
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
  margin:3% 30% 2% 30%;
  border:1px solid black;
  background-color:blue;
  font-color:white;
  border-top:2px solid black;
  border-bottom:2px solid black;
  padding:10px;
  text-align:center;
}
.c{
  margin:1% 30% 1% 30%;
  font-size:20px;
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
  margin:1% 30% 1% 30%;
  font-size:25px;
  border-bottom:2px solid black;
}
.custom-button:hover{
  background-color: #2980b9;
  color:white;
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
.nonehideable{
  display:block;
}
.hideable {
  display: none;
}
</style>
<script>
function showTab(tabName) {
            // Hide all tabs
            var tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(function (tab) {
                tab.classList.remove('active');
            });

            // Show the selected tab
            var selectedTab = document.getElementById(tabName);
            if (selectedTab) {
                selectedTab.classList.add('active');
            } else {
                console.error('Element with ID ' + tabName + ' not found.');
            }
        }
        function hidden(id_name) {
    var hide = document.getElementById(id_name);
    hide.classList.remove('nonehideable');
    hide.classList.add('hideable');
    hide.style.display = 'none';
}
        
    /*document.addEventListener('DOMContentLoaded', function() {
    // Get the "Find Trains" button by its name
    var findTrainsButton = document.querySelector('input[name="find"]');

    // Attach an event listener to the button
    findTrainsButton.addEventListener('click', function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();
        showTab('show_train');
    });
});*/
</script>
</head>
<body>
<section id="train_search" class="tab-content active"> 
<div class="a">
<form method="post" style="margin:3%;">
<table >
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
<tr><td></td></tr><tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>
<tr> <td colspan="2" style="font-size:25px;text-align:center;"><input style="padding:10px 120px;background-color:green;color:white;" type="submit" name="find" value="Find Trains" onclick="hidden('forms')"/></td></tr>
</table>
</form>
</div>
<div class="a">
<form method="post" class="search-container">
<!--<table class="search-container" style="margin:3%;">-->
<input style="flex-grow:2px;border:none;font-size:25px;" type="number" id="t_no" name="t_no" placeholder="Train No" required/>
<input class="search" type="submit" name="t_no_search" value="search"/>
</form>
</div>
<div class="a">
<form method="post" class="search-container">
<!--<table class="search-container" style="margin:3%;">-->
<input style="flex-grow:2px;border:none;font-size:25px;" type="text" id="departure" name="departure" placeholder="Station departure board" required/>
<input class="search" type="submit" name="departure_search" value="search"/>
</form>
</div>
<div class="a" style="height:250px">
<h3 style="color:blue;"> SEARCH HISTORY </h3>
<?php
   $sql="SELECT * from search ORDER BY s_no DESC LIMIT 5";
   $res=$conn->query($sql);
   if($res->num_rows > 0)
   {
       echo"<table style='float:left;font-size:25px;'>";
       while($row=$res->fetch_assoc()){
            echo"<tr class='custom-button'><td width='50px'>".$row['t_no']."</td><td style='width:50px;'></td><td width='300px'>".$row['t_name']."</td></tr>";
       }
       echo"</table>";
   }
?>
</div>
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
  $qry2="SELECT e_time from trains WHERE t_no=$t_no";
  $qry="SELECT * FROM stations
  WHERE stops_no >= (SELECT stops_no FROM stations WHERE stops ='". $from."' AND t_no =$t_no) 
  AND stops_no <= (SELECT stops_no FROM stations WHERE stops ='".$to."' AND t_no = $t_no) 
  AND t_no =$t_no ORDER BY stops_no ASC";
  $result2=$conn->query($qry2);
  $result=$conn->query($qry);
  if($r=$result2->fetch_assoc()){
    $e_time=$r['e_time'];
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
?>
<?php
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
   $qry2="SELECT t.t_no, t.t_name,t.e_time, s.t_no, s.stops, s.stops_no, s.arrive_time, s.leave_time from trains t JOIN stations s WHERE t.t_no=$t_no and s.t_no=$t_no ORDER BY s.stops_no ASC;";
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
           echo"<tr><td><p>".$row['arrive_time']."</p></td><td></td><td><p><li>".$row['stops']."</p></td><td></td><td><p>".$row['leave_time']."</p></td></tr>";
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
            echo"<tr><td colspan='3'><ul style='color:green;'><li>".$row['start']."</li></ul></td></tr>";
            echo"<tr><td align='center'><span style='font-size:50px;'>&#8595;</span></td></tr>";
            echo"<tr><td><ul style='color:red;'><li>".$row['end']."</li></ul></td></tr></table>";
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
</body>
</html>