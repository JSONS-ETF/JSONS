<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Simple Login with CodeIgniter - Private Area</title>
    </head>
    <body>
        <h1><?php echo $user['username'] ?>'s notifications:</h1>
        <table>
            <tr>
                <td>Link:</td>
                <td>Text:</td>
            </tr>
            <?php foreach ($notifications as $notification): ?>
            <tr>
                <td>
                    <?php echo '<a href='.$notification['link'].'>'.$notification['link'].'</a>' ?>
                </td>
                <td>
                    <?php echo $notification['text'] ?>
                </td>
                <td>
                    <a href=<?php echo '../../AdminHome/deleteNotification/'.$user['id'].'/'.$notification['id'] ?>>Delete notification</a>
                </td>
            </tr>
            <?php endforeach ?>
        </table>


        <h2>
            <a href=<?php echo '../../AdminHome/editUser/'.$user['id'] ?>>Back</a>
        </h2>

        <h2>
            <a href="../../AdminHome/Logout">Logout</a>
        </h2>
    </body>
</html>