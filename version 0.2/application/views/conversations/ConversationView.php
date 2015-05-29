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
                <input type="text" name="newUser" id="newUser" class="newUser" placeholder="Enter username"/><br/>
                <input id="send" type="submit" name="send" value="Send" class="newConversationButton">
            </form>
            </div>

    <?php
    foreach($conversations as $idConversation=>$conversation) {
        echo '<a href="'.site_url().'/messages/index/'.$idConversation.'"><div class="conversations" alt="' . $idConversation . '" style="float:left;">'.
            '<div class="picture">'; if ($conversation['picture']==null){echo '<img src="'.base_url().'photos/null.jpg"/>';}else echo '<img src="'.base_url().'photos/'.$conversation['idUser'].'/'.$conversation['picture'].'.jpg"/>';echo '</div>'.
            '<div class="message">'.
            '<div class="username">'.$conversation['username'].'</div><div class="datetime">'.date('d.m.Y',strtotime($conversation['timestamp'])).' '.date('H:i',strtotime($conversation['timestamp'])).'</div>' .
             '<div class="text">'.substr ($conversation['message'] ,0, 140).'</div>'.
            '</div></div></a>';
    }
    ?>
        </div>
    </div>
</div>

</body>
</html>