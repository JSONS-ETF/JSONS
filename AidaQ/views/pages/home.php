<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Questy - Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <style>
   <?php $s=true; include 'styleHomepage.css'; ?>
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
      <div class="mainbar">

        <div class="questions">
        <div class="picture"><img src="images/jane.jpg"/></div>
        <div class="question">
          <div class="username"><?php $lid=$row['ID']; echo $row['Username1']; ?>
              <span style="font-weight:normal;">asks</span> 
              <?php echo $row['Username2']; ?></div>
            <div class="datetime"><?php echo  date('d.m.Y H:i',strtotime($row['DateQ'])); ?></div>
          <div class="text"><?php echo $row['TextQ']; ?></div>
          
          <div class="mark">
        
               <img src="images/cuddle.png"/><img src="images/slap.png"/>
             
          </div>

           <?php if ($row['Answers']!=null): ?>
             <?php foreach($row['Answers'] as $row2): ?>
          <div class="response"><div class="datetime2"><img src="images/replay.png"/><?php echo  date('d.m.Y H:i',strtotime($row2['DateR'])); ?></div>
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
     <div class="sidebar">
         <?php if($s==true):$s=false; ?>
     
                <h2 class="head">Status</h2>
                
            <?php endif; ?>
      
        <div class="statuses">
          <img src="images/jane.jpg"/>
          <h2 class="username"><?php  echo $row['Username']; ?></h2>
          <div class="status"><?php echo $row['TextS']; ?></div>
          <div class="status"><?php echo date('d.m.Y H:i',strtotime($row['Date'])); ?></div>
        
        </div>
        
     
    <?php endif; ?>
      
       <?php endforeach;?>
     </div>
      
  
</body>
</html>
