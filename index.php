<?php
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require '../facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '621136264574371',
  'secret' => 'c900e5138953dc9ccfe01d122e545267',
));

// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}

// This call will always work since we are fetching public data.
$naitik = $facebook->api('/naitik');

?>

<?php
$val1 = $_POST['val1'];
$val2 = $_POST['val2'];
$option = $_POST['opt'];
$powerval = $_POST['power'];
$powernum = $_POST['powernum'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mathematical Calculator</title>
</head>

<body>

<?php
if ($option == add) {
	$answer = $val1 + $val2;
}
if ($option == sub) {
	$answer = $val1 - $val2;
}
if ($option == mul) {
	$answer = $val1 * $val2;
}
if ($option == div) {
	$answer = $val1 / $val2;
}
if ($powerval == power2) {
	$answerpower = $powernum * $powernum;
}
if ($powerval == power3) {
	$answerpower = $powernum * $powernum * $powernum;
}

echo "<br />";
if ($option == add) {
	echo "$val1 + $val2 <br />";
	echo "$answer";
}
if ($option == sub) {
	echo "$val1 - $val2<br />";
	echo "$answer";
}
if ($option == mul) {
	echo "$val1 * $val2<br />";
	echo "$answer";
}
if ($option == div) {
	echo "$val1 / $val2<br />";
	echo "$answer";
}
echo "<br />";
if ($powerval == power2) {
	echo "$powernum * $powernum<br />";
	echo "$answerpower";
}
if ($powerval == power3) {
	echo "$powernum * $powernum * $powernum<br />";
	echo "$answerpower";
}
?>

<center>
<form method="POST" action="action.php">
	<p>First number: <input type="text" name="val1" /> <br />
    Second number: <input type="text" name="val2" /><br />
    
    <input type="radio" name="opt" value="add"/> Addition <br />
    <input type="radio" name="opt" value="sub"/> Subtract <br />
    <input type="radio" name="opt" value="mul"/> Multiply <br />
    <input type="radio" name="opt" value="div"/> Divide
    </p>
    
    <p>
    Number: <input type="text" name="powernum" /><br />
    
    <input type="radio" name="power" value="power2"/> Power of 2 <br />
    <input type="radio" name="power" value="power3"/> Power of 3
    </p>
    <input type="submit" value="Submit" name="submit" />
</form>
</center>



</body>
</html>