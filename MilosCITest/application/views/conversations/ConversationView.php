<html>
<head>
    <title>Chat</title>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="../styles/styleConversations.css" rel="stylesheet" type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>

<div class="content">
    <div class="content_resize">
        <div class="mainbar">

            <div class="newconversation">
                <?php echo validation_errors(); ?>
                <?php echo form_open('conversations/newConversation'); ?>
                <input type="text" name="idUser2" id="idUser2" placeholder="Enter username"/><br/>
                <input type="text" name="idUser1" id="idUser1" value="<?php echo $idUser; ?>" hidden/>
                <input id="send" type="submit" name="send" value="Send" class="newConversationButton">
            </form>
            </div>

    <?php
    foreach($conversations as $idConversation=>$conversation) {
        echo '<a href="'.site_url().'/messages/index/'.$idConversation.'/'.$conversation['username'].'"><div class="conversations" alt="' . $idConversation . '" style="float:left;">'.
            '<div class="picture"><img src="'.$conversation['picture'].'"/></div>'.
            '<div class="message">'.
            '<div class="username">'.$conversation['username'].'</div><div class="datetime">'.date('d.m.Y',strtotime($conversation['timestamp'])).' '.date('H:i',strtotime($conversation['timestamp'])).'</div>' .
             '<div class="text">'.substr ($conversation['message'] ,0, 40).'</div>'.
            '</div></div></a>';
    }
    ?>
        </div>
    </div>
</div>

</body>
</html>