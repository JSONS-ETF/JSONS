<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Simple Login with CodeIgniter - Private Area</title>
    </head>
    <body>
        <h1><?php echo $user['username'] ?>'s statuses:</h1>
        <table>
            <tr>
                <td>Time:</td>
                <td>Text:</td>
            </tr>
            <?php foreach ($statuses as $status): ?>
            <tr>
                <td>
                    <?php echo $status['timestamp'] ?>
                </td>
                <td>
                    <?php echo $status['text'] ?>
                </td>
                <td>
                    <a href=<?php echo '../../AdminHome/deleteStatus/'.$user['id'].'/'.$status['id'] ?>>Delete status</a>
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