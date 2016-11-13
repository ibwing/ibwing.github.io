<!DOCTYPE html>

<head>
  <title>Ivy Wingate</title>
  <style>
    body {
      text-align: center;
      background: black;
      background-size: cover;
      background-position: center;
      color: white;
      font-family: helvetica;
    }
    p {
      font-size: 22px;
    }
    input {
      border: 0;
      padding: 10px;
      font-size: 18px;
    }
    input[type="submit"] {
      background: red;
      color: white;
    }
img {
	margin: 40px 0px 0px 0px;
	border: 7px solid white;
	border-radius: 20px;
  </style>
</head>
<body>
  <img src="http://i.imgur.com/wEQiABg.jpg?1" alt="Ivy">
  <p>Hi! I'm Ivy, an Atlanta-based Computer Programmer. Say hello!</p>
 
 
<!-- include your own success html here -->
 
<form action="contact.php" method="post">
<p><b>Your Name:</b> <input type="text" name="yourname" /><br><br>
<b>Subject:</b> <input type="text" name="subject" /><br><br>
<b>E-mail:</b> <input type="text" name="email" /><br><br>
<b>Website:</b> <input type="text" name="website"></p><br><br>
<p>Do you like this website?
<input type="radio" name="likeit" value="Yes" checked="checked" /> Yes
<input type="radio" name="likeit" value="No" /> No
<input type="radio" name="likeit" value="Not sure" /> Not sure</p>
<p>How did you find us?
<select name="how">
<option value=""> -- Please select -- </option>
<option>Google</option>
<option>Yahoo</option>
<option>Link from a website</option>
<option>Word of mouth</option>
<option>Other</option>
</select>
<p><b>Your comments:</b><br />
<textarea name="comments" rows="10" cols="40"></textarea></p>
<p><input type="submit" value="Send it!"></p>
</form>
 
 
<!--Thank you for contacting us. We will be in touch with you very soon.-->
</body>
</html>
<?php
/* Set e-mail recipient */
$myemail  = "wingate.ivy@gmail.com";

/* Check all form inputs using check_input function */
$yourname = check_input($_POST['yourname'], "Enter your name");
$subject  = check_input($_POST['subject'], "Write a subject");
$email    = check_input($_POST['email']);
$website  = check_input($_POST['website']);
$likeit   = check_input($_POST['likeit']);
$how_find = check_input($_POST['how']);
$comments = check_input($_POST['comments'], "Write your comments");

/* If e-mail is not valid show error message */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
    show_error("E-mail address not valid");
}

/* If URL is not valid set $website to empty */
if (!preg_match("/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i", $website))
{
    $website = '';
}

/* Let's prepare the message for the e-mail */
$message = "Hello!

Your contact form has been submitted by:

Name: $yourname
E-mail: $email
URL: $website

Like the website? $likeit
How did he/she find it? $how_find

Comments:
$comments

End of message
";

/* Send the message using mail() function */
mail($myemail, $subject, $message);

/* Redirect visitor to the thank you page */
header('Location: thanks.html');
exit();

/* Functions we used */
function check_input($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        show_error($problem);
    }
    return $data;
}

function show_error($myError)
{
?>
    <html>
    <body>

    <b>Please correct the following error:</b><br />
    <?php echo $myError; ?>

    </body>
    </html>
<?php
exit();
}
?>
