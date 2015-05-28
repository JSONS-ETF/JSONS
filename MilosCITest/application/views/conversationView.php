<html>
<head>
    <title>Chat</title>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <style>
        #conversationsWrapper{
            width:600px;
            min-height:600px;
            position:relative;
            margin:auto;
            padding:10px;
            margin-top:30px;
            border:1px solid gainsboro;
            max-height:600px;
            overflow:auto;

        }
        .conversation{
            width:500px;
            height:auto;
            padding:5px;
            margin:5px;
            border:1px solid lightslategray;
            border-radius: 5px;
            clear:both;
            color:black;
        }

        .picture{
            float:left;
            height:60px;
            width:60px;
            border:1px solid darkslategray;
            border-radius:30px;
            overflow:hidden;
        }

        .username{
            font-family: Calibri;
            padding:5px 0 5px 10px;
            font-size:18px;
            clear:both;
        }
        .date{
            font-family: Calibri;
            color:gray;
            float:right;
            font-size:14px;
        }
        .time{
            font-family: Calibri;
            color:gray;
            float:right;
            font-size:14px;
            margin-right: 10px;
        }
        .message{
            font-family: Calibri;
            padding:0 0 0 30px;
            font-size:18px;
            float:left;
            width:400px;
        }
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>

<div id="conversationsWrapper">
    <?php
    foreach($conversations as $idConversation=>$conversation) {
        echo '<a href="../index.php/chat/index/'.$idConversation.'/'.$conversation['username'].'"><div class="conversation" alt="' . $idConversation . '" style="float:left;">'.
        '<div class="username">' .
            $conversation['username'] .
            '<div class="date">' .
            date('d.m.Y',strtotime($conversation['timestamp'])) .
            '</div>' .
            '<div class="time">' .
            date('H:i',strtotime($conversation['timestamp'])) .
            '</div>' .
        '</div>' .
        '<div class="picture">' .
        '<img src='.$conversation['picture'].'/>' .
        '</div>' .
        '<div class="message">' .
            substr ($conversation['message'] ,0, 40).
        '</div>' .

        '</div></a>';
    }
    ?>
</div>

<form method="POST" action="../index.php/conversation/newConversation">
    idUser: <input type="text" name="idUser2" id="idUser2" /><br/>
    <input type="text" name="idUser1" id="idUser1" value="<?php echo $idUser; ?>" hidden/>
    <input id="send" type="submit" name="send" value="Send">
</form>

</body>
</html>