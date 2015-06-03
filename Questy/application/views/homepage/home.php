<!-- Aida Mavric 0397/12-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="../styles/styleHomepage.css" rel="stylesheet" type="text/css" />
 <style>
     a{
         color:slategray;
         text-decoration:none;
     }
  <?php $s=true;$m=true;?>
</style>
<!--<link href="styleHomepage.css" rel="stylesheet" type="text/css" />-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".c").click(function(event) {
                event.preventDefault();
                var id = $(this).attr('id');
                var idQ =id.substring(0, id.length - 2);
               // alert(idQ);
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo site_url();?>/Homepage/cuddle",
                    data: {idQ: idQ},
                    success: function (res) {
                        // alert(res);
                        document.getElementById(idQ+"C").innerHTML = "<b>" + res + "</b>";
                    }
                });

            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".s").click(function(event) {
                event.preventDefault();
                var id = $(this).attr('id');
                var idQ =id.substring(0, id.length - 2);
                //alert(idQ);
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo site_url();?>/Homepage/slap",
                    data: {idQ: idQ},
                    success: function (res) {
                        // alert(res);
                        document.getElementById(idQ+"S").innerHTML =  "<b>" + res + "</b>";
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
                                <img src="<?php if($row['User1PhotoId']==null) $photo="null"; else $photo=$row['User1ID'].'/'.$row['User1PhotoId']; echo base_url().'photos/'.$photo.'.jpg';?>" ></a>
        </div>
        <div class="question">
          <div class="username"> <a href="<?php echo'../index.php/profileController/index/'.$row['User1ID']; ?>">
              <?php $lid=$row['ID']; echo $row['Username1']; ?></a>
              <span style="font-weight:normal;">asks</span> 
              <a href="<?php echo'../index.php/profileController/index/'.$row['User2ID']; ?>">
             <?php echo $row['Username2']; ?></a></div>
            
            <div class="datetime"><?php echo  date('d.m.Y H:i',strtotime($row['DateQ'])); ?></div>
          <div class="text"><?php echo $row['TextQ']; ?></div>



            <div class="mark">

                <div class="s" style="float:right;line-height: 35px;" id="<?php echo $row['ID']; ?>s1">  <img src="<?php echo base_url();?>styles/images/slap.png"/></div>
                <div style="float:right;line-height: 35px;" id="<?php echo $row['ID'] ; ?>S"> <b><?php echo $row['NumSlaps'] ; ?> </b></div>

                <div class="c" style="float:right;line-height: 35px;" id="<?php echo $row['ID']; ?>c1"><img src="<?php echo base_url();?>styles/images/cuddle.png"/></div>
                <div style="float:right;line-height: 35px;" id="<?php echo $row['ID'] ; ?>C"> <b><?php echo $row['NumCuddles'] ; ?></b></div>


            </div>


           <?php if ($row['Answers']!=null): ?>
             <?php foreach($row['Answers'] as $row2): ?>
          <div class="response"><div class="datetime2"><img src="<?php echo base_url();?>styles/images/replay.png"/><?php echo  date('d.m.Y H:i',strtotime($row2['DateR'])); ?></div>
          <div class="text">
             <?php echo $row2['TextR']; ?>
          </div>
          </div>
          <?php endforeach;?>
          <?php endif;?>
          
          
        </div>

      </div>
          
     <?php endif; ?>
          
     
      
    
        <!--*****************************************************mainbarend-->
      

          
<!--*****************************************************sidebar-->
    
   
    <?php if ($row['type'] == 1): ?>
          </div>
     <div class="sidebar">
         <?php if($s==true):$s=false; ?>
     
         <h2 class="head">Status</h2>
                
            <?php endif; ?>
      
        <div class="statuses">
            
             <img src="<?php if($row['UserPhotoId']==null) $photo="null";else $photo=$row['UserID'].'/'.$row['UserPhotoId']; echo base_url().'photos/'. $photo.'.jpg';?>" >
          <h2 class="username" >
              <a style="  color: white;" href="<?php echo'../index.php/profileController/index/'.$row['UserID']; ?>" >
                  <?php  echo $row['Username']; ?></a></h2>

          <div class="status" style="  font-size: 15px; font-style: italic;">"<?php echo $row['TextS']; ?>"</div>
          <div class="statusd" style=" margin-top:5px; color: gray; font-size: 12px;"><?php echo date('d.m.Y H:i',strtotime($row['Date'])); ?></div>
        
        </div>
        
     
    <?php endif; ?>
      
       <?php endforeach;?>
     </div>

      
  
</body>
</html>
