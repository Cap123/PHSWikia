<?php
if (isset($_COOKIE["PHSWikia"])) {
echo "<!DOCTYPE html>
<html>
<head>
<link rel='stylesheet' href='http://cptricks.tk/CPTPS/style.css' />
<title>Run my bot</title>
</head>
<body>
<header>
<h1>Bot has been run</h1>
</header>
<content>
<p>The bot has been ran already. Please wait 5 seconds so that Wikia's servers don't overload.</p>
</content>
</body>
</html>";
} else {
echo "<!DOCTYPE html>
<html>
<head>
<link rel='stylesheet' href='http://cptricks.tk/CPTPS/style.css' />
<title>Run my bot</title>
</head>
<body>
<header>
<h1>Login</h1>
</header>
<content>
<form action='runbot.php' method='POST'>
<input type='text' placeholder='Username' name='username' /><br />
<input type='password' placeholder='Password' name='password' /><br />
<input type='text' placeholder='Wiki' name='wiki' />.wikia.com/wiki/
<input type='text' placeholder='Pages' name='pages' /><br />
<input type='text' placeholder='Summary' name='summary' /><br />
<textarea rows='7' cols='60' placeholder='Content' name='content'></textarea><br />
<p>You can only edit one page at a time.</p>
<input type='submit' value='Login' />
</form>
</content>
</body>
</html>";
}
?>
