<html>
<head>
    <title>Chat</title>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <style>
        #messagesWrapper{
            width:600px;
            min-height:500px;
            position:relative;
            margin:auto;

            margin-top:30px;
            border:1px solid gainsboro;
            max-height:500px;
            overflow:auto;

        }
        .messageWrapper{
            width:100%;
        }
        .messageWrapper:before, .messageWrapper:after{
            display: block;
            height: 0;
            overflow: hidden;
        }
        .message{
            width:200px;
            height:auto;
            padding:5px;
            margin:5px;
            border:1px solid lightslategray;
            border-radius: 5px;
            clear:both;
        }
        .username{
            clear:both;
            font-family: Calibri;
            padding-bottom:5px;
            font-size:16px;
            color:dodgerblue;
        }
        .text{
            font-family: Calibri;
            padding-bottom:5px;
            font-size:16px;
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
            float:left;
            font-size:14px;
        }
        #typemessage, #message{
            width:600px;
            border-radius:3px;
            font-family: Calibri;
            margin:auto;
            padding:5px;
            height:auto;
            position: :relative;

        }
        #sendmessage,#send{
            width:600px;
            border-radius:3px;
            font-family: Calibri;
            margin:auto;
            padding:5px;
            height:auto;
            position: :relative;
        }
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            var start=0;
            var end=0;
            var diff=0;

            var lockSend=0;
            var lockCheck=0;

            var existing=[];
            $("#messagesWrapper").scrollTop($("#messagesWrapper")[0].scrollHeight);
            window.setInterval(function(){
                diff=end-start;
                diff=diff/1000;
                start = new Date().getTime();
                while (lockSend===1);
                lockCheck=1;
                document.getElementById('send').disabled = true;

                jQuery.ajax({
                    type: "POST",
                    dataType: 'json',
                    cache : false,
                    data: {idConversation:<?php echo $idConversation; ?>,diff:diff,start:start},
                    url: "<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>/www/questy/index.php/chat/checkMessage",
                    success: function(data) {
                       console.log(JSON.stringify(data));
                       // alert(JSON.stringify(data));
                        $.each(data,function(i,el)
                        {
                            if(jQuery.inArray( i, existing )==-1) {
                                existing.push(i);
                                if (el.idUser ==<?php echo $idUser;?>) {
                                    $('#messagesWrapper').append(
                                        '<div class="message" alt="' + i + '" style="float:right;">' +
                                        '<div class="username">' +
                                        'me' +
                                        '</div>' +
                                        '<div class="text">' +
                                        el.message +
                                        '</div>' +
                                        '<div class="date">' +
                                        el.date +
                                        '</div>' +
                                        '<div class="time">' +
                                        el.time +
                                        '</div>' +
                                        '</div>'
                                    );
                                } else {
                                    $('#messagesWrapper').append(
                                        '<div class="message" alt="' + i + '" style="float:left;">' +
                                        '<div class="username">' +
                                        <?php echo $guestUsername; ?> +
                                        '</div>' +
                                        '<div class="text">' +
                                        el.message +
                                        '</div>' +
                                        '<div class="date">' +
                                        el.date +
                                        '</div>' +
                                        '<div class="time">' +
                                        el.time +
                                        '</div>' +
                                        '</div>'
                                    );
                                }


                                var scrollHeight = $("#messagesWrapper").prop('scrollHeight');
                                var divHeight = $("#messagesWrapper").height();
                                var scrollerEndPoint = scrollHeight - divHeight;

                                var divScrollerTop =  $("#messagesWrapper").scrollTop();
                                divScrollerTop+=$(".message").height()+10+10+2;
                                if(divScrollerTop===scrollerEndPoint){
                                    $("#messagesWrapper").scrollTop($("#messagesWrapper")[0].scrollHeight);
                                }
                            }
                        });

                    }
                });
                lockCheck=0;
                document.getElementById('send').disabled = false;
                end = new Date().getTime();
            }, 1000);

            $("#send").click(function(event) {
                while (lockCheck==1);
                lockSend=1;
                document.getElementById('send').disabled = true;

                event.preventDefault();
                var message = $("#message").val();
                var idUser = $("#idUser").val();
                document.getElementById('message').value = "";
                document.getElementById("message").focus();
                if (message!='') {
                    jQuery.ajax({
                        type: "POST",
                        url: "<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>/www/questy/index.php/chat/sendMessage",
                        dataType: 'json',
                        data: {message: message, idConversation: <?php echo $idConversation; ?>, idUser: idUser},
                        success: function (res) {
                            alert(res);
                        }
                    });
                }
                lockSend=0;
                document.getElementById('send').disabled = false;
            });
        });
    </script>

</head>
<body>

<div id="messagesWrapper">
    <?php
        foreach($messages as $idMessage=>$message) {
            if ($message['idUser'] == $idUser) {
                echo '<div class="message" alt="' . $idMessage . '" style="float:right;">';
                echo '<div class="username">'.
                'me'.
                '</div>';
            }
            else{
                echo '<div class="message" alt="' . $idMessage . '" style="float:left;">';
                echo '<div class="username">'.
                    $guestUsername.
                    '</div>';
            }

            echo'<div class="text">' .
                $message['message'] .
                '</div>' .
                '<div class="date">' .
                $message['date'] .
                '</div>' .
                '<div class="time">' .
                $message['time'] .
                '</div>' .
                '</div>';
        }
    ?>
</div>
    <form method="POST">
            <div id="typemessage"><textarea type="text" name="message" id="message" cols="30" rows="10"></textarea></div><br/>
            <input type="text" name="idConversation" id="idConversation" value="<?php echo $idConversation; ?>" hidden/>
            <input type="text" name="idUser" id="idUser" value="<?php echo $idUser; ?>" hidden/>
            <div id="sendmessage"><input id="send" type="submit" name="send" value="Send"></div>
    </form>

</body>
</html>