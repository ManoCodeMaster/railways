<!DOCTYPE html>
<html>
<head>
</title></title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
   margin: 0px;
}
ul {
   list-style-type: none;
   overflow: hidden; 
   position: fixed;
   width: 100%;
   margin: 0px;
   padding: 0px;
   z-index: 2; 
}
ul.scrolled{
  background-color:rgb(135,206,235);
}
li {
   float: left; 
}
li a{
   display: block;
   text-decoration: none;
   text-align: center;
   font-size: 20px;
   color: black;
   padding: 30px 50px;
}

li a.active {
    background-color: #04AA6D;
    color: white;
}
li a:hover:not(.active) {
   background-color: #555;
   color: white;
}

.hero-image {
  background-image: url("img.webp");
  background-color: #cccccc;
  height: 600px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

.hero-text {
  text-align: right;
  position: absolute;
  top: 60%;
  left: 40%;
  color: yellow;
  z-index: 1;
}
img{
  margin:3%;
  border-radius:10%;
  height:300px;
  width:300px;
}
.services{
  border:1px solid black;
  border-radius:5%;
  width:320px;
  display:inline-block;
  margin-left:5%;
}
p{
  word-wrap:break-word;
  margin:3%;
}
.b{
  width:50%;
  word-wrap:break-word;
}
.tab-content {
  display: none;
}
.tab-content.active {
  display: block;
}
</style>
<script>
  window.onscroll = function() {
    var menu = document.querySelector("ul");
    if (window.scrollY > document.querySelector(".hero-image").offsetHeight) {
        menu.classList.add("scrolled");
    } else {
        menu.classList.remove("scrolled");
    }
};
  window.addEventListener("DOMContentLoaded", (event) => {
        // Smooth scroll to anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                const target = document.querySelector(this.getAttribute('href'));
                const offset = document.querySelector("ul").offsetHeight;

                window.scrollTo({
                    top: target.offsetTop - offset,
                    behavior: 'smooth'
                });
            });
        });
   });
</script>
</head>
<body>
<section id="home" class="tab-content active">
<ul>
   <li> <a href="#home">HOME</a></li>
   <li> <a href="#services">SERVICES</a></li>
   <li> <a href="#aboutus">ABOUT US</a></li>
   <li style="float:right;"> <a href="http://localhost/Southern_Railways/signup.php">Sign Up</a></li>
   <li style="float:right;"> <a href="http://localhost/Southern_Railways/login.php"> Login</a></li>
   <li style="float:right;"> <a href="#contactus">CONTACT US </a></li>
   <li style="float:center;"> <img style="border-radius:50%;width:100px;height:80px;margin-left:60%" src="img6.jpeg" /img> </li>
</ul>

<div class="hero-image">
  <div class="hero-text">
    <h2 style="font-size:40px" align="right">Fast and Reliable</h2>
    <h1 style="font-size:50px" align="right"> Railway Ticketing Services </h1>
  </div>
</div>
<section id="services" class="tab-content active">
<h2 style="font-size:40px;margin-top:10%;" align="center">Services</h2><br>
<div style="margin-left:5%;">
   <div class="services"> <img src="img2.webp" /img>
   <p style="font-size:25px;word-wrap:break-word;"> Reservation for trains within the TamilNadu</p>
   <p style="font-size:20px;word-wrap:break-word;"> We provide reservation facility from wherever you want to travel within the Tamilnadu</p>
   </div>
   <div class="services"> <img src="img3.webp" /img>
   <p style="font-size:25px;word-wrap:break-word;"> Reservation for Sleeper Class:</p>
   <p style="font-size:20px;word-wrap:break-word;"> We provide reservation in the sleeper class for those who want to travel in sleeper and general    class</p>
   </div>
   <div class="services"> <img src="img4.webp" /img>
   <p style="font-size:25px;"> Reservation for AC and First Class:</p>
   <p style="font-size:20px;"> We provide reservation in the sleeper class for those who want to travel in ac and first    class</p>
   </div>
</div><br>
</section>
<section id="aboutus" class="tab-content active">
<div style="margin-top:15%;">
   <div style="display:inline-block;width:45%;height:450px;"> <h1 align="center"> About Us </h1>
         <p class="b" style="font-size:20px;text-align:center;width:80%">Booking a ticket has always been a state of agitation for everyone.Keeping this in mind, We at Perfecto Holidays Agents located in Anna Nagar, Madurai, Tamilnadu, provide the service for tocket booking for the preferred class of train so that you can easily avail the seat travel wherever you want. We have emegency ticket booking services as well so when you want to travel and go somewhere in emergency, We provide assured ticket booking for such situations.</p>
  </div>
  <div style="display:inline-block;"> <img style="float:right;width:100%;height:450px;" src="img5.jpeg" /img></div>
</div>
</section>
<section id="contactus" class="tab-content active">
<div> <h1 style="font-size:40px;margin-top:5%;text-align:center;">Contact Us</h1><br><br>
  <div style="width:50%;display:inline-block;margin-left:5%;">
    <iframe style="margin-left:5%;" src="https://www.google.com/maps/d/embed?mid=1leNVXh9sgLcbPlRQqTWcAhuw86c&hl=en_US&ehbc=2E312F" width="640" height="480"></iframe>
  </div>
  <div style="margin-left:5%;display:inline-block;">
                                                     <h2 style="display:inline-block;">Our Office Address</h2> <p> Anna Nagar, Madurai-625 009, TamilNadu</p>
                                                     <i style="font-size:24px;">&#128231;</i>&nbsp
                                                     <h2 style="display:inline-block;">Email Address </h2> <p>railways@gmail.com</p>
                                                     <i style="font-size:24px;" class="fa">&#xf095;</i>&nbsp
                                                     <h2 style="display:inline-block;">Call Us </h2> <p> +91-8888888888 </p>
                                                     <i style="font-size:24px;">&#x1F570;</i>&nbsp
                                                     <h2 style="display:inline-block;">Our Timing </h2> <p> Mon - Sun: 10.00AM to 7.00PM </p> 
  </div>
</div><br><br><br>
</section>
</section>
</body>
</html>