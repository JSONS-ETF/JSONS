<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Simple Login with CodeIgniter - Private Area</title>
        <link href="../../../styles/styleHomeAdmin.css" rel="stylesheet" type="text/css" />
        <style Stylesheet="css/text">
            .button{
                margin:10px;
            }
            .mainbar{
                min-width: 1000px;;
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
        <h1><?php echo $user['username'] ?>'s responses:</h1>
        <table>
            <tr>
                <td>Time:</td>
                <td>From:</td>
                <td>To:</td>
                <td>Question:</td>
                <td>Response:</td>
            </tr>
            <?php foreach ($responses as $response): ?>
            <tr>
                <td>
                    <?php echo $response['timestamp'] ?>
                </td>
                <td>
                    <?php echo $response['from'] ?>
                </td>
                <td>
                    <?php echo $response['to'] ?>
                </td>
                <td>
                    <?php echo $response['question'] ?>
                </td>
                <td>
                    <?php echo $response['response'] ?>
                </td>
                <td>
                    <a href=<?php echo '../../AdminHome/deleteResponse/'.$user['id'].'/'.$response['id'] ?>><div class="button">Delete response</div></a>
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