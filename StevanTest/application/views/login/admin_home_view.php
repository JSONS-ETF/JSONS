<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Simple Login with CodeIgniter - Private Area</title>
</head>
<body>
<h1>Home</h1>
<h2>Welcome <?php echo $username; ?>!</h2><br/>

<?php
if ($accesscode !== null)
echo '<h2>Welcome '.$accesscode.'!</h2><br/>';
?>

<a href="adminhome/newadmin">Generate new admin access code</a><br/>
<a href="adminhome/logout">Logout</a>
</body>
</html>