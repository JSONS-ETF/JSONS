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

        <h1><?php echo $user['username'] ?>'s photos:</h1>
        <table>
            <tr>
                <td>Time:</td>
                <td>Description:</td>
                <td>Photo</td>
            </tr>
            <?php foreach ($photos as $photo): ?>
            <tr>
                <td>
                    <?php echo $photo['timestamp'] ?>
                </td>
                <td>
                    <?php echo $photo['description'] ?>
                </td>
                <td>

                </td>
                <td>
                    <a href=<?php echo '../../AdminHome/deletePhoto/'.$user['id'].'/'.$photo['id'] ?>><div class="button">Delete photo</div></a>
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