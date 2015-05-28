<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Simple Login with CodeIgniter - Private Area</title>
        <link href="../../../styles/styleHomeAdmin.css" rel="stylesheet" type="text/css" />
        <style Stylesheet="css/text">
            .button{
                margin:10px;
            }
            </style>
    </head>
    <body>


    <div class="content">
        <div class="content_resize">
            <div class="mainbar">
                <h2>Edit user: <?php echo $user['username'] ?></h2>

                <a href=<?php echo '../../AdminHome/editNotifications/'.$user['id'] ?>><div class="button">View notifications</div></a>

                <a href=<?php echo '../../AdminHome/editStatuses/'.$user['id'] ?>><div class="button">View statuses</div></a>

                <a href=<?php echo '../../AdminHome/editConversations/'.$user['id'] ?>><div class="button">View conversations</div></a>

                <a href=<?php echo '../../AdminHome/editPhotos/'.$user['id'] ?>><div class="button">View photos</div></a>

                <a href=<?php echo '../../AdminHome/editQuestions/'.$user['id'] ?>><div class="button">View questions</div></a>

                <a href=<?php echo '../../AdminHome/editResponses/'.$user['id'] ?>><div class="button">View responses</div></a>

                <a href="../../AdminHome/gotoHome"><div class="button">Back</div></a>

            </div>

        </div>

    </div>




    </body>
</html>