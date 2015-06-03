<!--Stevan Milicic-->
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Simple Login with CodeIgniter - Private Area</title>
        <link href="../../../../styles/styleHomeAdmin.css" rel="stylesheet" type="text/css" />
        <style Stylesheet="css/text">
            .button{
                margin:10px;
            }
            .mainbar{
                min-width:710px
            }
            td{
                max-width:150px;
                overflow:hidden;
            }
        </style>
    </head>
    <body>

    <div class="content">
        <div class="content_resize">
            <div class="mainbar">
                <h2><?php echo $user['username'] ?>'s conversation with <?php echo $conversation['participant'] ?>:</h2>

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
                    <a href=<?php echo '../../../AdminHome/deleteMessage/'.$user['id'].'/'.$conversation['id'].'/'.$message['id'] ?>><div class="button">Delete message</div></a>
                </td>
            </tr>
            <?php endforeach ?>
        </table>

                <h2>
                    <a href=<?php echo '../../../AdminHome/editConversations/'.$user['id'] ?>><div class="button">Back</div></a>
                </h2>

            </div>

        </div>

    </div>


    </body>
</html>