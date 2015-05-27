<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Design by http://www.iWebsiteTemplate.com
Released for free under a Creative Commons Attribution 3.0 License
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Questy</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="style.css" rel="stylesheet" type="text/css" />
    <!-- CuFon: Enables smooth pretty custom font rendering. 100% SEO friendly. To disable, remove this section -->
    <script type="text/javascript" src="../js/cufon-yui.js"></script>
    <script type="text/javascript" src="../js/arial.js"></script>
    <script type="text/javascript" src="../js/cuf_run.js"></script>
    <!-- CuFon ends -->
</head>
<body>
<div class="main">

    <div class="header">
        <div class="header_resize">
            <div class="menu_nav">
                <ul>
                    <!-- <li ><a href="index.html">Home</a></li>-->
                    <li class="active"><a href="profile.html">My Profile</a></li>
                    <li><a href="inbox.html">Inbox</a></li>


                    <li ><a href="index.html" >Log out</a></li>
                </ul>
            </div>


            <div class="clr"></div>
        </div>
    </div>


    <div class="content">
        <div class="content_resize">
            <div class="mainbar">
                <div class="article">
<?php     $idCurr = 1;
         $id = 1; ?>
                    <form method="post" accept-charset="utf-8" action = <?php

                    if($idCurr == $id){
                    echo 'index.php/profile_controller/create_status/';}

                    else echo 'index.php/profile_controller/create_question/'?> />

                    <table>
                            <tr><td><font color="#808080"> <textarea rows="2" cols="86" name='qest'><?php

                                        if($idCurr == $id)  echo 'What'.'s on your mind?';
                                                else echo 'Type a question...'
                                        ?> </textarea></font></td></tr>

                            <tr> <td><p align="right">
                            <input type="submit" value="Post"/>
                        </p></td></tr></table>
                    </form>
                    <h2 align = "left"><?php
                        foreach ($status as $r){
                        echo '<span>'. $r->Text . '</span>';} ?> </h2><div class="clr"></div>
                    <p align= "right">
                        <?php foreach ($status as $r){
                        echo  $r->DateTime2; } ?> <!--<a href="#">Owner</a>  <span>&nbsp;&bull;&nbsp;</span>  Change <a href="#">about you</a>, <a href="#">internet</a>--></p>

                    <?php foreach ($prof as $r){
                        echo '<p>' . $r->About . '</p>';

                    }?>


                    <!--  <p>Tagged: <a href="#">orci</a>, <a href="#">lectus</a>, <a href="#">varius</a>, <a href="#">turpis</a></p>
                      <p><a href="#"><strong>Comments (3)</strong></a>  <span>&nbsp;&bull;&nbsp;</span>  May 27, 2010  <span>&nbsp;&bull;&nbsp;</span>  <a href="#"><strong>Edit</strong></a></p>-->
                </div>


                <div class="article">
                    <h2><span>Questy</span> Questions</h2><div class="clr"></div>


                    <?php $last = 0; ?>
                    <?php foreach($question as $qu): ?>
                        <?php
                        if($qu)
                        if($last != $qu->QID):?>
                  <div class="comment">
                        <a href="profileJohn.html"><img src="images/john.jpg" width="40" height="40" alt="user" class="userpic" /></a>
                        <p ><a href="profileJohn.html">

                                <?php echo '<span>'.  $qu->UsernameU2 . '</span>'; ?></a>
                            asks: <span>&nbsp;&bull;&nbsp;</span>
                            <?php echo '<span>'.  $qu->QDate. '</span>'; ?></p>
                        <p> <?php echo '<h2>'.  $qu->QText. '</h2>'; ?></p>
                            <?php $last = $qu->QID; ?>

                            <form method="post" accept-charset="utf-8" action = <?php  echo 'index.php/profile_controller/create/'.$qu->QID ?> />
                            <table>
                            <?php

                            if($idCurr == $id) {
                                echo '<tr>' . '<td>' . ' <input type=' . 'text name=' . 'ans>' . '</td>' . '</tr>' .
                                    '<tr>' . '<td>' . '<input type=' . 'submit' . ' value=' . 'Answer' . '>' . '</td>' . '</tr>';
                            }

                            else'';
                            ?>


                            </table></form>
                      <?php endif; ?>

                      <?php if($qu) if($qu->RText!=  NULL):?>
                        <p><a href="profile.html"><?php echo '<span>'.  $r->Username; ?></a>
                            <?php echo 'answer:' .'<span>'.  $qu->RText.'</span>'; ?>
                            <font color="#97977E"><span>&nbsp;&bull;&nbsp;</span>
                            <?php echo '<span>'.  $qu->RDate . '</span>'; ?>
                            </font></p>
                            <?php endif ?>
                    </div>

                    <?php endforeach; ?>



                </div>

            </div>
            <div class="sidebar">
                <div class="gadget">
                    <h2 class="star">
                       <?php
                            echo '<span>' . $r->FirstName .'</span> &nbsp' . $r->LastName;

                        ?>

                    </h2><div class="clr"></div>
                    <img src="images/jane.jpg" width="263" height="146" alt="image" class="fl" />
                    <a href="profile2.html">  <input type="button"  value="Change Picture" \></a>
                </div>

                <div class="article">
                    <p></p>
                    <p></p>
                    <b>Q</b>: Do you wish you lived in another country? Why?<br/>
                    &nbsp&nbsp <a href="profile.html">Jane Doe</a></b>: Yes,I wish.Because of the weather.

                    <p></p>
                    <p></p>
                    <b>Q</b>:Do you wish you you were younger?<br/>
                    &nbsp&nbsp <a href="profile.html">Jane Doe</a></b>: No.
                    <p></p>
                    <p></p>
                    <b>Q</b>: Do you wish you you were more fashionable? Why?<br/>
                    &nbsp&nbsp <a href="profile.html">Jane Doe</a></b>: No,I hate fashionable people.
                </div>
            </div>
            <br/>
            <h2>Statuses </h2>
            <div  class="aut abs" style=" width:300px; height:100px; overflow: auto;">
                <?php

                $counter = 1; ?>
<?php foreach ($s as $stat){
    if($s){
    echo '<p>'. $stat->Text .'&nbsp&nbsp' . $stat->DateTime2. '</p>';
    $counter++;
    }
                    if($counter > 10) break;
    } ?>
            </div>


            <div class="clr"></div>
        </div>
    </div>


    <div class="footer">
        <div class="footer_resize">
            <p class="lf">&copy; Copyright <a href="#">MyWebSite</a>. Layout by [i] <a href="http://www.iwebsitetemplate.com/">Website Templates</a></p>
            <ul class="fmenu">
                <li class="active"><a href="profile.html">My profile</a></li>
                <li><a href="inbox.html">Inbox</a></li>
                <li><a href="index.html">Log Out</a></li>
            </ul>
            <div class="clr"></div>
        </div>
    </div>
</div>
</body>
</html>
