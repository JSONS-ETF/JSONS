<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Questy - Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="../styles/styleHomepage.css" rel="stylesheet" type="text/css" />
 <style>
  <?php $s=true;$m=true;?>
</style>
<!--<link href="styleHomepage.css" rel="stylesheet" type="text/css" />-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".c").click(function(event) {
                event.preventDefault();
                var idQ = $(this).attr('id');
               // alert(idQ);
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo site_url();?>/Homepage/cuddle",
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
                    url: "<?php echo site_url();?>/Homepage/slap",
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

<!--**********************************************************************************************************************************************************--> 

  <div class="content">
    <div class="content_resize">


     <?php foreach($records as $row):   ?>
       
        <?php if ($row['type'] == 2): ?>
<!--*****************************************************mainbar-->
          <?php if($m==true):$m=false; ?>
          <div class="mainbar">
         <?php endif; ?>

        <div class="questions">
        <div class="picture"><a href="<?php echo'../index.php/profileController/index/'.$row['User1ID']; ?>">
                                <img src="<?php if($row['User1PhotoId']==null) $photo="null"; else $photo=$row['User1ID'].'/'.$row['User1PhotoId']; echo 'photos/'.$photo.'.jpg';?>" ></a>
        <div class="question">
          <div class="username"> <a href="<?php echo'../index.php/profileController/index/'.$row['User1ID']; ?>">
              <?php $lid=$row['ID']; echo $row['Username1']; ?></a>
              <span style="font-weight:normal;">asks</span> 
              <a href="<?php echo'../index.php/profileController/index/'.$row['User1ID']; ?>">
             <?php echo $row['Username2']; ?></a></div>
            
            <div class="datetime"><?php echo  date('d.m.Y H:i',strtotime($row['DateQ'])); ?></div>
          <div class="text"><?php echo $row['TextQ']; ?></div>



            <div class="mark">


                <div class="c" id="<?php echo $row['ID']; ?>"><img src="../../../images/cuddle.png"/></div>
                <div id="<?php echo $row['ID'] ; ?>C"> <b><?php echo $row['NumCuddles'] ; ?></b></div>

                <div class="s" id="<?php echo $row['ID']; ?>">  <img src="../../../images/slap.png"/></div>
                <div id="<?php echo $row['ID'] ; ?>S"> <b><?php echo $row['NumSlaps'] ; ?> </b></div>
            </div>


           <?php if ($row['Answers']!=null): ?>
             <?php foreach($row['Answers'] as $row2): ?>
          <div class="response"><div class="datetime2"><img src="../styles/images/replay.png"/><?php echo  date('d.m.Y H:i',strtotime($row2['DateR'])); ?></div>
          <div class="text">
             <?php echo $row2['TextR']; ?>
          </div>
          </div>
          <?php endforeach;?>
          <?php endif;?>
          
          
        </div>
        </div>
      </div>
          
     <?php endif; ?>
          
     
      
    
        <!--*****************************************************mainbarend-->
      

          
<!--*****************************************************sidebar-->
    
   
    <?php if ($row['type'] == 1): ?>
          </div>
     <div class="sidebar">
         <?php if($s==true):$s=false; ?>
     
         <h2 class="head"><b>Statuses</b></h2>
                
            <?php endif; ?>
      
        <div class="statuses">
            
             <img src="<?php if($row['UserPhotoId']==null) $photo="null";else $photo=$row['UserID'].'/'.$row['UserPhotoId']; echo 'photos/'. $photo.'.jpg';?>" >
          <h2 class="username">
              <a href="<?php echo'../index.php/profileController/index/'.$row['UserID']; ?>" >
                  <?php  echo $row['Username']; ?></a></h2>

          <div class="status"><b><?php echo $row['TextS']; ?></b></div>
          <div class="statusd"><?php echo date('d.m.Y H:i',strtotime($row['Date'])); ?></div>
        
        </div>
        
     
    <?php endif; ?>
      
       <?php endforeach;?>
     </div>

      
  
</body>
</html>
