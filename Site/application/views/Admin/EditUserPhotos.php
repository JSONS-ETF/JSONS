<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Simple Login with CodeIgniter - Private Area</title>
    </head>
    <body>
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
                    <a href=<?php echo '../../AdminHome/deletePhoto/'.$user['id'].'/'.$photo['id'] ?>>Delete photo</a>
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