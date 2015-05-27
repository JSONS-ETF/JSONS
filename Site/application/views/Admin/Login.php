<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>Simple login</title>
    </head>

    <body>
        <h1>Login</h1>
        <?php echo validation_errors(); ?>
        <?php echo form_open('AdminVerifyLogin'); ?>
        <label for="username">Username:</label>
        <input type="text" size="20" id="username" name="username"/>
        <br/>
        <label for="password">Password:</label>
        <input type="password" size="20" id="password" name="password"/>
        <br/>
        <a href="AdminRegister">Register</a>
        <br/>
        <input type="submit" value="Login"/>
        </form>
    </body>
</html>