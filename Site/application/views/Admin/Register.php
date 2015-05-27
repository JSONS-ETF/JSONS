<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>Register</title>
    </head>

    <body>
        <h1>Register</h1>
        <?php echo validation_errors() ?>
        <?php echo form_open('AdminVerifyRegister'); ?>
        <label for="email">Email:</label>
        <input type="text" size="20" id="email" name="email"/>
        <br/>
        <label for="username">Username:</label>
        <input type="text" size="20" id="username" name="username"/>
        <br/>
        <label for="password">Password:</label>
        <input type="password" size="20" id="password" name="password"/>
        <br/>
        <label for="accesscode">Access Code:</label>
        <input type="text" size="20" id="accesscode" name="accesscode"/>
        <br/>
        <input type="submit" value="Register"/>
        </form>
    </body>
</html>