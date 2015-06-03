<!--Stevan Milicic-->
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Simple Login with CodeIgniter - Private Area</title>
        <link href="../../../styles/styleHomeAdmin.css" rel="stylesheet" type="text/css" />
        <style Stylesheet="css/text">
            .button{
                margin:10px;
            }
            .mainbar{
                min-width: 550px;;
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
                    <a href=<?php echo '../../AdminHome/deleteStatus/'.$user['id'].'/'.$status['id'] ?>><div class="button">Delete status</div></a>
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