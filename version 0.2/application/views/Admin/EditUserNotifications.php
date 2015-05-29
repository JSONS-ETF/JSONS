<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Simple Login with CodeIgniter - Private Area</title>
        <link href="../../../styles/styleHomeAdmin.css" rel="stylesheet" type="text/css" />
        <style Stylesheet="css/text">
            .button{
                margin:10px;
            }
            .mainbar{
                min-width: 650px;
            }
            td{
                overflow: hidden;
                max-width:150px;
            }
        </style>
    </head>
    <body>

    <div class="content">
        <div class="content_resize">
            <div class="mainbar">
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
                    <a href=<?php echo '../../AdminHome/deleteNotification/'.$user['id'].'/'.$notification['id'] ?>><div class="button">Delete notification</div></a>
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