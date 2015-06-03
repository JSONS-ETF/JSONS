<!-- Milos Kotlar 115/12 -->
<style Stylesheet="text/css">
 @font-face {
  font-family: 'LogoFont';
  src: url('<?php echo base_url()?>styles/fonts/logofont.eot'); /* IE9 Compat Modes */
  src: url('<?php echo base_url()?>styles/fonts/logofont.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
       url('<?php echo base_url()?>styles/fonts/logofont.woff2') format('woff2'), /* Super Modern Browsers */
       url('<?php echo base_url()?>styles/fonts/logofont.woff') format('woff'), /* Pretty Modern Browsers */
       url('<?php echo base_url()?>styles/fonts/logofont.ttf')  format('truetype'), /* Safari, Android, iOS */
       url('<?php echo base_url()?>styles/fonts/logofont.svg#svgFontName') format('svg'); /* Legacy iOS */
}
 .clr { clear:both; padding:0; margin:0; width:100%; font-size:0px; line-height:0px;}

.header, .content, .menu_nav, .fbg, .footer, form, ol, ol li, ul { margin:0; padding:0;}
.header{border-bottom:1px solid #6c94b8;background: #fffbf5;}
/* header */
.header_resize { margin:0 auto; padding:0; width:990px; background: #fffbf5;}

.logo{	font-family:LogoFont;	font-size:70px;	color:#6C94B8  ;	height:72px;	line-height:72px;	width:230px;	text-align:center;	margin-right:20px;}

/* menu */
.menu_nav { margin:0; padding:5px 0 5px 40px; float:left; }
.menu_nav ul { list-style:none;}
.menu_nav ul li { margin:0; padding:0 16px 0 0; float:left;}
.menu_nav ul li a { display:block; margin:0; padding:20px; color:#52aec6; text-decoration:none; font-size:13px; text-transform:uppercase;}
.menu_nav ul li a img{width:22px; height:22px;}
.menu_nav ul li.active a, .menu_nav ul li a:hover { background:#80A8CC; border-radius: 1300px;}
.header_resize .button{color:white;font-family:Helvetica;font-size:16px; background: #6c94b8;padding:10px;width:80px;cursor:pointer;margin:0 0 0 5px;border:0px;border-radius: 10px;position:relative;float:left; text-align:center;margin-top:15px;}
.header_resize input{color:black;  border: 2px solid #e0dcd7;font-family:Helvetica;font-size:16px; background: white;padding:10px;width:180px;margin:0 0 0 5px;border-radius: 10px;position:relative;float:left; text-align:center;margin-top:14px}

</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
        <?php if ($err!='') {echo 'tempAlert("'.$err.'",4000);'; }?>

    });

    function tempAlert(msg,duration){
        var el = document.createElement("div");
        el.setAttribute("style","position:absolute;top:10%;left:0;right:0;margin:auto;background-color:#cc8980;padding:10px;color:white;font-weight:bold;font-size:22px;border-radius:5px;width:600px;text-align:center;height:100px;border:2px solid #FE2E2E;");
        el.innerHTML = msg;
        setTimeout(function(){
            el.parentNode.removeChild(el);
        },duration);
        document.body.appendChild(el);
    }

</script>

 <div class="header">
    <div class="header_resize">
    
      <div class="menu_nav">
        <ul>
        <li><div class="logo">Questy</div></li>
          <li <?php if($page==0) echo ' class="active"'; ?>><a href="<?php echo site_url()?>/homepage"><img src="<?php echo base_url()?>styles/images/home.png"></a></li>
          <li <?php if($page==1) echo ' class="active"'; ?>><a href="<?php echo site_url()?>/conversations"><img src="<?php echo base_url()?>styles/images/inbox.png"></a></li>
          <li <?php if($page==2) echo ' class="active"'; ?>><a href="<?php echo site_url()?>/profilecontroller/index/<?php echo $id;?>"><img src="<?php echo base_url()?>styles/images/profile.png"></a></li>

              <li> <form method="post" action=<?php echo site_url();?>/homepage/findUser> <input type="text" name="newUser" id="newUser" class="newUser" placeholder="Enter username"/>
               <input id="send" type="submit" name="send" value="Search" class="button"> </form></li>

            <li style="position:relative;left:100px;"><a href="<?php echo site_url()?>/UserHome/logout"><img src="<?php echo base_url()?>styles/images/logout.png"></a></li>
        </ul>
      </div>


    <div class="clr"></div>
    </div>
  </div>