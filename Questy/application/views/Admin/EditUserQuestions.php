<!--Stevan Milicic-->
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Admin - Edit</title>
        <link href="../../../styles/styleHomeAdmin.css" rel="stylesheet" type="text/css" />
        <style Stylesheet="css/text">
            .button{
                margin:10px;
            }
            .mainbar{
                min-width: 850px;;
            }
            td{
                max-width: 110px;
                overflow: hidden;
            }
        </style>
    </head>
    <body>

    <div class="content">
        <div class="content_resize">
            <div class="mainbar">
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
                    <a href=<?php echo '../../AdminHome/deleteQuestion/'.$user['id'].'/'.$question['id'] ?>><div class="button">Delete question</div></a>
                </td>
            </tr>
            <?php endforeach ?>
        </table>


        <h2>
            <a href=<?php echo '../../AdminHome/editUser/'.$user['id'] ?>><div class="button">Back</div></a>
        </h2>

            </div>

        </div>

    </div>
    </body>
</html>