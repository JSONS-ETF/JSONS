 <style Stylesheet="text/css">
 @font-face {
  font-family: 'LogoFont';
  src: url('fonts/logofont.eot'); /* IE9 Compat Modes */
  src: url('fonts/logofont.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
       url('fonts/logofont.woff2') format('woff2'), /* Super Modern Browsers */
       url('fonts/logofont.woff') format('woff'), /* Pretty Modern Browsers */
       url('fonts/logofont.ttf')  format('truetype'), /* Safari, Android, iOS */
       url('fonts/logofont.svg#svgFontName') format('svg'); /* Legacy iOS */
}
 .clr { clear:both; padding:0; margin:0; width:100%; font-size:0px; line-height:0px;}

.header, .content, .menu_nav, .fbg, .footer, form, ol, ol li, ul { margin:0; padding:0;}

/* header */
.header_resize { margin:0 auto; padding:0; width:990px; background: #fffbf5;border-bottom:1px solid #6c94b8;}

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
		      <li><a href="homepage.php"><img src="images/home.png"></a></li>
          <li class="active"><a href="inbox.php"><img src="images/inbox.png"></a></li>
          <li><a href="profile.php"><img src="images/profile.png"></a></li>
          <li style="position:relative;left:370px;"><a href="logout.php"><img src="images/logout.png"></a></li>
        </ul>
      </div>
     
    <div class="clr"></div>
    </div>
  </div>