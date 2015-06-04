<!--Stevan Milicic-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Friend list</title>
    <link href="../../../styles/styleHomeAdmin.css" rel="stylesheet" type="text/css" />
    <style Stylesheet="css/text">
        .button{
            margin:10px;
        }
        .mainbar{
            min-width:650px;
        }
    </style>
</head>
<body>
<div class="content">
    <div class="content_resize">
        <div class="mainbar">


            <h1>

                <?php echo $idCurrUserName['UserName']; ?>'s friends list:
           </h1>
            <table>


                <?php if($friends) foreach ($friends as $friend): ?>
                    <tr>
                        <td>

                            <div class="picture"  >

                                <a href=<?php echo'../../profileController/index/'.$friend['UserID']; ?>>
                                    <img style="height: 50px;width: 50px; border-radius: 150px;border:0;" src="<?php if($friend['PhotoID'] == null) {$photo="null";}
                                    else {$photo=$friend['UserID'].'/'.$friend['PhotoID'];} echo base_url().'photos/'.$photo.'.jpg';?>"/></a>
                               </div>
                        </td>
                        <td>
                            <a href=<?php echo '../../profileController/index/'.$friend['UserID']; ?>><?php echo $friend['FirstName'].'   ( '.$friend['UserName'].'   )   '.$friend['LastName'] ?></a>


                        </td>

                    </tr>
                <?php endforeach ?>

<?php if($friends == NULL): ?>
                <h1>You don't have friends :( </h1>
                <?php endif ?>

            </table>


            <h2>
                <a href=<?php echo '../../profileController/index/'.$idCurr ?>><div class="button">Back</div></a>
            </h2>

        </div>

    </div>

</div>


</body>
</html>