<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Simple Login with CodeIgniter - Private Area</title>
        <link href="../styles/styleHomeAdmin.css" rel="stylesheet" type="text/css" />
    </head>
    <body>


    <div class="content">
        <div class="content_resize">
            <div class="mainbar">
                <h2>Users</h2>
                <table>
                    <tr><td>ID</td><td>Username</td><td></td></tr>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td>
                                <a <?php echo 'href=AdminHome/editUser/'.$user['id'] ?>> <?php echo $user['id'] ?> </a>
                            </td>
                            <td>
                                <a <?php echo 'href=AdminHome/editUser/'.$user['id'] ?>> <?php echo $user['username'] ?> </a>
                            </td>
                            <td>
                                <a <?php echo 'href=AdminHome/deleteUser/'.$user['id'] ?>> <div class="button">Delete</div> </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>

                <?php
                if ($accesscode !== null)
                    echo '<h2>Pass this code to the new administrator: '.$accesscode.'</h2><br/>';
                ?>
                <br/>
                <a href="AdminHome/newAdmin"><div class="button">Generate new admin access code</div></a>
            </div>

        </div>

    </div>
    </body>
</html>