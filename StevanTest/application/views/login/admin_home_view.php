<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Simple Login with CodeIgniter - Private Area</title>
</head>
<body>
<h1>Administrator panel</h1>

<h2>Users:</h2>
<table>
    <tr>
        <td>ID:</td>
        <td>Username:</td>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td>
                <a <?php echo 'href=adminhome/editUser/'.$user['id'] ?>> <?php echo $user['id'] ?> </a>
            </td>
            <td>
                <a <?php echo 'href=adminhome/editUser/'.$user['id'] ?>> <?php echo $user['username'] ?> </a>
            </td>
            <td>
                <a <?php echo 'href=adminhome/deleteUser/'.$user['id'] ?>> Delete user </a>
            </td>
        </tr>
    <?php endforeach ?>
</table>

<?php
if ($accesscode !== null)
echo '<h2>Pass this code to the new administrator: '.$accesscode.'!</h2><br/>';
?>

<a href="adminhome/newadmin">Generate new admin access code</a><br/>
<a href="adminhome/logout">Logout</a>
</body>
</html>