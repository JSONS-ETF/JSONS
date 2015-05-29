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
</head>
<body>

<?php
include ("header.php");
?>
    
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
                                <img src=<?php echo 'photos/'.$row['User1ID'].'/'.idphoto.'.jpg'></a>
        <div class="question">
          <div class="username"> <a href="<?php echo'../index.php/profileController/index/'.$row['User1ID']; ?>">
              <?php $lid=$row['ID']; echo $row['Username1']; ?></a>
              <span style="font-weight:normal;">asks</span> 
              <a href="<?php echo'../index.php/profileController/index/'.$row['User1ID']; ?>">
             <?php echo $row['Username2']; ?></a></div>
            
            <div class="datetime"><?php echo  date('d.m.Y H:i',strtotime($row['DateQ'])); ?></div>
          <div class="text"><?php echo $row['TextQ']; ?></div>
         
  
          
          <div class="mark">    
              <a href="../index.php/Homepage/cuddle/<?php echo $row['ID'] ?>"> 
               <img src="../styles/images/cuddle.png"/></a>
                 <b><?php echo $row['NumCuddles'];?></b>
              <a href="../index.php/Homepage/slap/<?php echo $row['ID'] ?>">
                  <img src="../styles/images/slap.png"/></a>
                  <b><?php echo $row['NumSlaps']; ?></b>
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
            
             <img src="../styles/images/jane.jpg"/>
          <h2 class="username">
              <a href="<?php echo'../index.php/profileController/index/'.$row['UserID']; ?>">
                  <?php  echo $row['Username']; ?></a></h2>

          <div class="status"><b><?php echo $row['TextS']; ?></b></div>
          <div class="statusd"><?php echo date('d.m.Y H:i',strtotime($row['Date'])); ?></div>
        
        </div>
        
     
    <?php endif; ?>
      
       <?php endforeach;?>
     </div>

      
  
</body>
</html>
