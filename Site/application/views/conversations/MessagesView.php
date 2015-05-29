<html>
<head>
    <title>Chat</title>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="../../../styles/styleMessages.css" rel="stylesheet" type="text/css" />
    <style>
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
            $(".mainbar").scrollTop($(".mainbar")[0].scrollHeight);

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
                    data: {idConversation:<?php echo $idConversation; ?>,diff:diff},
                    url: "<?php echo site_url();?>/messages/checkMessage",
                    success: function(data) {
                       console.log(JSON.stringify(data));

                        //alert(JSON.stringify(data));
                        $.each(data,function(i,el)
                        {

                            if(jQuery.inArray( i, existing )==-1) {
                                var flag=1;
                                existing.push(i);
                                if (el.idUser ==<?php echo $idUser;?>) {
                                    $('.mainbar').append(
                                    '<div class="messagesright" alt="' + i + '">'+
                                    '<div class="picture"><img src=""/></div>'+
                                    '<div class="message">'+
                                    '<div class="text">'+el.message+'</div>'+
                                    '<div class="datetime">'+el.timestamp +'</div>'+
                                    '</div></div>'
                                    );
                                    flag=0;
                                } else {
                                    $('.mainbar').append(
                                        '<div class="messagesleft" alt="' + i + '">'+
                                        '<div class="picture"><img src=""/></div>'+
                                        '<div class="message">'+
                                        '<div class="text">'+el.message+'</div>'+
                                        '<div class="datetime">'+el.timestamp +'</div>'+
                                        '</div></div>'
                                    );
                                }
                            }
							var scrollHeight = $(".mainbar").prop('scrollHeight');
                            var divHeight = $(".mainbar").height();
                            var scrollerEndPoint = scrollHeight - divHeight;

                            var divScrollerTop =  $(".mainbar").scrollTop();
                            divScrollerTop+=$(".messagesright").height()+20;

                                //alert(divScrollerTop+' '+scrollerEndPoint);
                            if(divScrollerTop>=scrollerEndPoint-20){
                                $(".mainbar").scrollTop($(".mainbar")[0].scrollHeight);
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
                        url: "<?php echo site_url();?>/messages/sendMessage",
                        dataType: 'json',
                        data: {message: message, idConversation: <?php echo $idConversation; ?>},
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

<div class="content">
    <div class="content_resize">
        <div class="username"><?php echo $info["username"]; ?></div>
        <div class="mainbar">

    <?php
        foreach($messages as $idMessage=>$message) {
            if ($message['idUser'] == $idUser) {
                echo '<div class="messagesright" alt="' . $idMessage . '">';
                echo '<div class="picture"><img src=""/></div>';
                echo '<div class="message">';
                echo '<div class="text">'.$message['message'].'</div>';
                echo '<div class="datetime">'.date('H:i',strtotime($message['timestamp'])).' '.date('d.m.Y',strtotime($message['timestamp'])) .'</div>';
                echo '</div></div>';

            }
            else{
                echo '<div class="messagesleft" alt="' . $idMessage . '">';
                echo '<div class="picture"><img src=""/></div>';
                echo '<div class="message">';
                echo '<div class="text">'.$message['message'].'</div>';
                echo '<div class="datetime">'.date('H:i',strtotime($message['timestamp'])).' '.date('d.m.Y',strtotime($message['timestamp'])) .'</div>';
                echo '</div></div>';
            }
        }
    ?>

        </div>

        <div class="newmessage">
            <form method="POST" >
               <textarea type="text" name="message" placeholder="Enter username" id="message""></textarea>
                <input type="text" name="idConversation" id="idConversation" value="<?php echo $idConversation; ?>" hidden/>
                <div id="sendmessage"><input id="send" type="submit" name="send" value="Send"></div>
            </form>
        </div>


    </div>

</div>




</body>
</html>