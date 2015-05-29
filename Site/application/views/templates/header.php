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
 </style>

 <div class="header">
    <div class="header_resize">
    
      <div class="menu_nav">
        <ul>
        <li><div class="logo">Questy</div></li>
          <li <?php if($page==0) echo ' class="active"'; ?>><a href="<?php echo site_url()?>/homepage"><img src="<?php echo base_url()?>styles/images/home.png"></a></li>
          <li <?php if($page==1) echo ' class="active"'; ?>><a href="<?php echo site_url()?>/conversations"><img src="<?php echo base_url()?>styles/images/inbox.png"></a></li>
          <li <?php if($page==2) echo ' class="active"'; ?>><a href="<?php echo site_url()?>/profilecontroller"><img src="<?php echo base_url()?>styles/images/profile.png"></a></li>
          <li style="position:relative;left:370px;"><a href="UserHome/logout"><img src="<?php echo base_url()?>styles/images/logout.png"></a></li>
        </ul>
      </div>
     
    <div class="clr"></div>
    </div>
  </div>