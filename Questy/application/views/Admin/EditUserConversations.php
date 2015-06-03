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
                min-width:650px;
            }
        </style>
    </head>
    <body>
    <div class="content">
        <div class="content_resize">
            <div class="mainbar">
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
                    <a href=<?php echo '../../AdminHome/editConversationMessages/'.$user['id'].'/'.$conversation['id'] ?>><?php echo $conversation['participant'] ?></a>
                </td>
                <td>
                    <a href=<?php echo '../../AdminHome/deleteConversation/'.$user['id'].'/'.$conversation['id'] ?>><div class="button">Delete conversation</div></a>
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