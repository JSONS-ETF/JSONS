<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Simple Login with CodeIgniter - Private Area</title>
    </head>
    <body>
        <h1><?php echo $user['username'] ?>'s questions:</h1>
        <table>
            <tr>
                <td>Time:</td>
                <td>From:</td>
                <td>To:</td>
                <td>Text:</td>
            </tr>
            <?php foreach ($questions as $question): ?>
            <tr>
                <td>
                    <?php echo $question['timestamp'] ?>
                </td>
                <td>
                    <a href=<?php echo '../../AdminHome/editQuestionResponses/'.$user['id'].'/'.$question['id'] ?>><?php echo $question['user1'] ?></a>
                </td>
                <td>
                    <a href=<?php echo '../../AdminHome/editQuestionResponses/'.$user['id'].'/'.$question['id'] ?>><?php echo $question['user2'] ?></a>
                </td>
                <td>
                    <?php echo $question['text'] ?>
                </td>
                <td>
                    <a href=<?php echo '../../AdminHome/deleteQuestion/'.$user['id'].'/'.$question['id'] ?>>Delete question</a>
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