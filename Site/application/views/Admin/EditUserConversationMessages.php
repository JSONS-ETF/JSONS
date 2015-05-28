<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Simple Login with CodeIgniter - Private Area</title>
    </head>
    <body>
        <h1><?php echo $user['username'] ?>'s conversation with <?php echo $conversation['participant'] ?>:</h1>
        <table>
            <tr>
                <td>Time:</td>
                <td>Participant:</td>
                <td>Message:</td>
            </tr>
            <?php foreach ($messages as $message): ?>
            <tr>
                <td>
                    <?php echo $message['timestamp'] ?>
                </td>
                <td>
                    <?php echo $message['username'] ?>
                </td>
                <td>
                    <?php echo $message['text'] ?>
                </td>
                <td>
                    <a href=<?php echo '../../../AdminHome/deleteMessage/'.$user['id'].'/'.$conversation['id'].'/'.$message['id'] ?>>Delete message</a>
                </td>
            </tr>
            <?php endforeach ?>
        </table>


        <h2>
            <a href=<?php echo '../../../AdminHome/editConversations/'.$user['id'] ?>>Back</a>
        </h2>

        <h2>
            <a href="../../../AdminHome/Logout">Logout</a>
        </h2>
    </body>
</html>