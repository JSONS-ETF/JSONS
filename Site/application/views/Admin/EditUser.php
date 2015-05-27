<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Simple Login with CodeIgniter - Private Area</title>
    </head>
    <body>
        <h1>Edit user <?php echo $user['username'] ?></h1>

        <h2>
            <a href=<?php echo '../../AdminHome/editNotifications/'.$user['id'] ?>>View notifications</a>
        </h2>
        <h2>
            <a href=<?php echo '../../AdminHome/editStatuses/'.$user['id'] ?>>View statuses</a>
        </h2>
        <h2>
            <a href=<?php echo '../../AdminHome/editConversations/'.$user['id'] ?>>View conversations</a>
        </h2>
        <h2>
            <a href="#">View photos</a>
        </h2>
        <h2>
            <a href="#">View questions</a>
        </h2>
        <h2>
            <a href="#">View responses</a>
        </h2>

        <h2>
            <a href="../../AdminHome/gotoHome">Back</a>
        </h2>

        <h2>
            <a href="../../AdminHome/Logout">Logout</a>
        </h2>
    </body>
</html>