<!--Stevan Milicic-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<link href="../styles/styleIndexAdmin.css" rel="stylesheet" type="text/css" />
<html>
    <head>
        <title>Admin - Login</title>
    </head>
    <body>

    <div class="header">
        <div class="header_resize">

            <div class="logo">Questy</div>
            <?php echo validation_errors(); ?>
            <?php echo form_open('AdminVerifyLogin'); ?>
            <div class="login">
                <input type="text" size="20" id="username" placeholder="Username" name="username"/>
                <input type="password" size="20" id="password" placeholder="Password" name="password"/>
                <input type="submit" class="button" value="Login"/>
            </div>
            </form>
            <div class="clr"></div>
        </div>


    </div>