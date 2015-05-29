<!-- Milos Kotlar 115/12  Maja Zivkovic 528/12-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Questy - Profile</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!--<link href="styleProfile.css" rel="stylesheet" type="text/css" /> -->
    <script src="../../../styles/lightbox/js/jquery-1.11.0.min.js"></script>
    <script src="../../../styles/lightbox/js/lightbox.min.js"></script>
    <link href="../../../styles/styleProfile.css" rel="stylesheet" type="text/css" />
    <link href="../../../styles/lightbox/css/lightbox.css" rel="stylesheet" />
    <script type="text/javascript">
        $(document).ready(function() {
        $(".c").click(function(event) {
            event.preventDefault();
            var idQ = $(this).attr('id');
            //alert(idQ);
            jQuery.ajax({
                type: "POST",
                url: "<?php echo site_url();?>/profileController/cuddle",
                data: {idQ: idQ},
                success: function (res) {
                   // alert(res);
                    document.getElementById(idQ+"C").innerHTML=res;
                }
            });

        });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".s").click(function(event) {
                event.preventDefault();
                var idQ = $(this).attr('id');
                //alert(idQ);
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo site_url();?>/profileController/slap",
                    data: {idQ: idQ},
                    success: function (res) {
                        // alert(res);
                        document.getElementById(idQ+"S").innerHTML=res;
                    }
                });

            });
        });
    </script>
</head>
<body>
<?php
//include ("templates/header.php");
?>

<!--**********************************************************************************************************************************************************-->
<pre><?php// print_r($question)?></pre>

<div class="content">
    <div class="content_resize">
        <!--*****************************************************sidebar-->
        <div class="sidebar">
            <div class="user">
                <?php foreach($userInfo as $r): ?>
                <?php if($r): ?>
            <img src="<?php if($r->PhotoID==null and $r->PhotoID!=0) $photo="null"; else $photo=$r->ID.'/'.$r->PhotoID; echo base_url().'photos/'.$photo.'.jpg';?>" >
                <h2 class="username">
                       <?php
                            echo '<span>' . $r->FirstName . '</span> &nbsp' . $r->LastName; ?>
                    <?php endif?>
                    <?php endforeach ?>

                    </h2>
                <div class="about"> <?php foreach($userInfo as $r){if($r) echo '<span>'. $r->About.'</span>';} ?>
                </div>
                <div class="status"><?php if($status)foreach($status as $stat){if($stat) echo '"'. $stat->Text.'"';} ?></div>
                <?php

                if(($friends != null) && ($id!=$idCurr)): ?>
                <a href=""><div class="button">Send message</div></a>


                <?php endif; ?>

                <?php

                if($id==$idCurr): ?>
                    <?php echo form_open_multipart('profileController/do_upload');?>

                    <input type="file" name="userfile" size="20" />

                    <textarea name="description" cols="20" rows="5" /></textarea>
                    <input name="idCurr" value="<?php echo $idCurr; ?>" hidden/>

                    <br /><br />

                    <input type="submit" value="upload" />

</form>
                <?php endif; ?>
            </div>
            <div class="gallery">
                <?php

                foreach($photos as $idPhoto=>$photo) {
                    echo '<a href="'.base_url().'photos/'.$id.'/'.$idPhoto.'.jpg" data-lightbox="image-1" data-title="';
                    echo ' <script type=\'text/javascript\'>'.
                        '$(\'.ccc\').click(function(){'.
                        'var idPhoto='.$idPhoto.';'.
                        'jQuery.ajax({'.
                        'type: \'POST\','.
                        'url: \'../../profileController/cuddlePhoto/\' ,'.
                        'data: {idPhoto:idPhoto},'.
                        'success: function (res) {'.
                        'document.getElementById(\''.$idPhoto.'C\').innerHTML=res;'.
                        '}'.
                        '});'.
                        '       });'.
                        '</script>';
                    echo '<img class=\'ccc\' src=\''.base_url().'styles/images/cuddle.png\'/><div id=\''.$idPhoto.'C\'>'.$photo["cuddles"].'</div>';
                    echo '<script type=\'text/javascript\'>'.
                        '$(\'.sss\').click(function(){'.
                        'var idPhoto='.$idPhoto.';'.
                        'jQuery.ajax({'.
                        'type: \'POST\','.
                        'url: \'../../profileController/slapPhoto/\' ,'.
                        'data: {idPhoto:idPhoto},'.
                        'success: function (res) {'.
                        'document.getElementById(\''.$idPhoto.'S\').innerHTML=res;'.
                        '}'.
                        '});'.
                        '       });'.
                        '</script>';
                       echo '<img class=\'sss\' src=\''.base_url().'styles/images/slap.png\'/><div id=\''.$idPhoto.'S\'>'.$photo["slaps"].'</div>'.
                        '<span style=\'padding-left:50px;\'>'.$photo["description"].'</span>';
                    if ($id==$idCurr)
                        echo '<span style=\'float:right;\'><a href=\'../../profileController/deletePhoto/'.$idPhoto.'\' >Delete</a></span>';

                    echo '"><img src="'.base_url().'photos/'.$id.'/'.$idPhoto.'.jpg"/></a>';

                }
                ?>
            </div>
            <div class="questions">Questions
                <?php foreach($BQ as $b): ?>
                    <?php if($b): ?>
                <div class="question"><img src="<?php echo base_url();?>styles/images/question.png"/><?php echo $b->BQText; ?></div>
                <div class="response"><img src="<?php echo base_url();?>styles/images/response.png"/><?php echo $b->BRText; ?></div>
                        <?php endif ?>
<?php endforeach ?>
            </div>

        </div>
        <!--*****************************************************sidebarend-->


        <!--*****************************************************mainbar-->
        <div class="mainbar">
            <div class="ask">
                <form method="post" action = <?php

                if($idCurr == $id){
                    echo '../../profileController/create_status/';}

                else echo '../../profileController/create_question/'.$idCurr?> />
                    <textarea name="qest" placeholder="<?php

                    if($idCurr == $id)  echo 'What\'s on your mind?';
                    else  echo 'Type a question...';

                    ?>" ></textarea>
                <input type="submit" value="Post"/>
                </form>
            </div>


            <?php if(($friends) || ($idCurr == $id )):  ?>

                <?php foreach($question as $qu): ?>
                    <?php if($qu['TextQ']):?>

        <div class="questions">

        <div class="picture">
        <a href=<?php echo'../../profileController/index/'.$qu['User1ID']; ?>>    <img src="<?php if($r->PhotoID==null) $photo="null"; else $photo=$r->ID.'/'.$r->PhotoID; echo base_url().'photos/'.$photo.'.jpg';?>"/></a>


        </div>
        <div class="question">
          <div class="username">
              <a href=<?php echo'../../profileController/index/'.$qu['User1ID']; ?>>   <?php echo '<span>'.  $qu['UsernameU2'] . '</span>'; ?></a>
          </div>
            <div class="datetime">

                <?php echo date('d.m.Y H:i',strtotime($qu['TimestampQ'])) ;; ?>
            </div>
          <div class="text">
              <?php echo   $qu['TextQ'] ; ?>
          </div>


          <div class="mark">


              <div class="c" id="<?php echo $qu['ID']; ?>"><img src="<?php echo base_url();?>styles/images/cuddle.png"/></div>
              <div id="<?php echo $qu['ID'] ; ?>C"> <b><?php echo $qu['NumCuddles'] ; ?></b></div>

              <div class="s" id="<?php echo $qu['ID']; ?>">  <img src="<?php echo base_url();?>styles/images/slap.png"/></div>
              <div id="<?php echo $qu['ID'] ; ?>S"> <b><?php echo $qu['NumSlaps'] ; ?> </b></div>
          </div>



            <form method="post" accept-charset="utf-8" action = <?php  echo '../../profileController/create/'.$qu['ID'].'/'.$idCurr ?> />
            <table>

                <?php if($idCurr == $id) {
                        echo '<tr>' . '<td>' . ' <input type=' . 'text name=' . 'ans>' . '</td>' . '</tr>' .
                            '<tr>' . '<td>' . '<input class="buttonB" type=' . 'submit' . ' value=' . 'Answer' . '>' . '</td>' . '</tr>';
                    }
                        ?>


            </table></form>



                    <?php if($qu['odg']!=null)?>
                        <?php foreach($qu['odg'] as $od): ?>
                        <div class="response">
                            <div class="datetime2">
                                <img src="<?php echo base_url();?>styles/images/replay.png"/>

                                <?php foreach($userInfo as $r){if($r) echo '<span>'. $r->Username.'</span>';} ?>
                                <?php echo  date('d.m.Y H:i',strtotime($od['TimestampR'])) ; ?>
                            </div>
                            <div class="text">
                                <?php echo   $od['TextR']; ?>
                            </div>
                        </div>

                        <?php endforeach; ?>


                    </div>
                    </div>


        <?php endif ?>

                <?php endforeach; ?>

            <?php endif ?>

        </div>
        <!--*****************************************************mainbarend-->

        <pre><?//php  print_r($s)?></pre>
        <div class="sidebarRight">
            <h2 class="head">Status</h2>
            <?php $counter = 1; ?>
            <?php if($s)foreach($s as $stat): ?>
                <div class="statuses">
                    <div class="status"><?php if($stat){
                            echo $stat->Text .'&nbsp&nbsp' .'</br>'. date('d.m.Y H:i',strtotime($stat->Timestamp));
                            $counter++;
                        }   ?></div>
                </div>

            <?php endforeach ?>
            <?php if($idCurr != $id) {
                echo   '<form  align="center"method="post" accept-charset="utf-8" action = ../../profileController/block/'.$idCurr .'/>'. '<input class="buttonBlock" type=' . 'submit' . ' value=' . 'Block' . '>' . '</form>';
            }
            ?>


        </div>


    </div>

</div>

</body>
</html>
