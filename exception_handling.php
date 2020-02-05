<?php
//create function with an exception
function checkNum($number) {
  if($number<5) 
  {
    throw new Exception("Value may be less then 5");
  }elseif($number>10)
  {
	  throw new exception("Others wise value is more then 10");
  }
  return true;
}

//trigger exception in a "try" block
try {
  checkNum(4);//change perameter 4,6,14
  //If the exception is thrown, this text will not be shown
  echo 'If you see this, the number is beteen 5 and 10 ';
}

//catch exception
catch(exception $e) {
  echo 'Message: ' .$e->getMessage();
}
?>