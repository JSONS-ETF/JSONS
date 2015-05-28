<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Simple Login with CodeIgniter - Private Area</title>
    </head>
    <body>
        <h1><?php echo $user['username'] ?>'s responses:</h1>
        <table>
            <tr>
                <td>Time:</td>
                <td>Question:</td>
                <td>Response:</td>
            </tr>
            <?php foreach ($responses as $response): ?>
            <tr>
                <td>
                    <?php echo $response['timestamp'] ?>
                </td>
                <td>
                    <?php echo $response['question'] ?>
                </td>
                <td>
                    <?php echo $response['text'] ?>
                </td>
                <td>
                    <a href=<?php echo '../../../AdminHome/deleteQuestionResponse/'.$user['id'].'/'.$question['id'].'/'.$response['id'] ?>>Delete response</a>
                </td>
            </tr>
            <?php endforeach ?>
        </table>


        <h2>
            <a href=<?php echo '../../../AdminHome/editQuestions/'.$user['id'] ?>>Back</a>
        </h2>

        <h2>
            <a href="../../../AdminHome/Logout">Logout</a>
        </h2>
    </body>
</html>