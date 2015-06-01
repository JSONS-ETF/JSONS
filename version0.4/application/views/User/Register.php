<!-- Stevan Milicic -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>Register</title>
        <style Stylesheet="text/css">
            textarea{
                font-family: Helvetica;font-size: 16px;padding: 5px;border-radius: 10px;border: 2px solid #E0DCD7;position: relative ;width:100%;
            }
            .mainbar{
                min-width: 500px;
            }
        </style>
    </head>

    <body>

    <div class="content">
        <div class="content_resize">
            <div class="mainbar">
                <h2>Join Us</h2>
                <?php echo validation_errors() ?>
                <?php echo form_open('UserVerifyRegister'); ?>
                <table>
                    <tr><td><input type="text" size="20" id="firstname" placeholder="Name" name="firstname"/></td><td><input type="text" size="20" placeholder="Surname" id="lastname" name="lastname"/></td></tr>
                    <tr><td colspan="2"><input type="text" size="20" id="email" placeholder="Email" name="email"/></td></tr>
                    <tr><td colspan="2"><input type="text" size="20" id="username" placeholder="Username" name="username"/></tr>
                    <tr><td> <input type="password" size="20" placeholder="Password" id="password" name="password"/></td><td><input type="password" size="20" id="password2" name="password2" placeholder="Repeat Password"/></td></tr>
                    <tr><td colspan="2"><textarea style="resize:none;" placeholder="About" type="text" size="100" id="about" name="about"></textarea></td></tr>

                    <?php foreach ($questions as $question): ?>
                    <tr>
                        <td colspan="2">
                            <input type="text" size="40" id="question<?php echo $question['id'] ?>" placeholder="<?php echo $question['text'] ?>" name="question<?php echo $question['id'] ?>"/>
                        </td>
                    </tr>
                    <?php endforeach ?>

                    <tr><td></td><td><input type="submit" class="button" value="Register"></td></tr>
                </table>
                </form>
            </div>
        </div>

    </div>

    </body>
</html>