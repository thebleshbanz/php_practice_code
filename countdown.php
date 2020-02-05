<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
p {
  text-align: center;
  color:red;
  font-size: 30px;
  margin-top:0px;
}
</style>
<style>

#clockdiv{
	font-family: sans-serif;
	color: #fff;
	display: inline-block;
	font-weight: 100;
	text-align: center;
	font-size: 30px;
}

#clockdiv > div{
	padding: 10px;
	border-radius: 3px;
	background: #00BF96;
	display: inline-block;
}

#clockdiv div > span{
	padding: 15px;
	border-radius: 3px;
	background: #00816A;
	display: inline-block;
}

.smalltext{
	padding-top: 5px;
	font-size: 16px;
}

</style>

<script>
// Set the date we're counting down to
var countDownDate = new Date("Feb 29, 2020 11:23:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() 
{
var minute = 1000*60;
var hour = minute*60;
var day = hour*24;

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    //document.getElementById("distance").innerHTML=distance;//exit();
    // Time calculations for days, hours, minutes and seconds
    
	var days = Math.floor(distance / day);
    var hours = Math.floor((distance % (day)) / hour);
    var minutes = Math.floor((distance % (hour)) / minute);
    var seconds = Math.floor((distance % (minute)) / 1000);
    
	    
    // Output the result in an element with id="demo"
  /*  document.getElementById("countdown").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";*/
	
    	// format countdown string + set tag value
	document.getElementById("clockdiv").innerHTML = "<div class='div'><span class='span'>" + days + "</span>   <div class='smalltext'>Days</div></div>	<div class='div'><span class='span'>" + hours + "</span>   <div class='smalltext'>Hours</div></div>	<div class='div'><span class='span'>" + minutes + "</span>   <div class='smalltext'>Minutes</div></div>	<div class='div'><span class='span'>" + seconds + "</span>   <div class='smalltext'>Seconds</div></div>";
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("countdown").innerHTML = "EXPIRED";
    }
}, 1000);
</script>



</head>
<body>
<!--<p id="countdown"></id>-->
<h1>Countdown Clock</h1>
<div id="clockdiv">
  <div>
    <span class="days"></span>
    <div class="smalltext">Days</div>
  </div>
  <div>
    <span class="hours"></span>
    <div class="smalltext">Hours</div>
  </div>
  <div>
    <span class="minutes"></span>
    <div class="smalltext">Minutes</div>
  </div>
  <div>
    <span class="seconds"></span>
    <div class="smalltext">Seconds</div>
  </div>
</div>


</div>




</body>
</html>
