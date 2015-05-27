<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Simple Login with CodeIgniter - Private Area</title>
    </head>
    <body>
        <h1><?php echo $user['username'] ?>'s conversations:</h1>
        <table>
            <tr>
                <td>Time:</td>
                <td>Participant:</td>
            </tr>
            <?php foreach ($conversations as $conversation): ?>
            <tr>
                <td>
                    <?php echo $conversation['timestamp'] ?>
                </td>
                <td>
                    <?php echo $conversation['participant'] ?>
                </td>
                <td>
                    <a href=<?php echo '../../AdminHome/deleteConversation/'.$user['id'].'/'.$conversation['id'] ?>>Delete conversation</a>
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