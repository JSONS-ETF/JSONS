

<div class="content">
    <div class="content_resize">
        <?php echo validation_errors() ?>
        <?php echo form_open('AdminVerifyRegister'); ?>
        <div class="mainbar">
            <h2>Register</h2>
            <table>
                <tr><td colspan="2"> <input type="text" size="20" id="email" placeholder="Email" name="email"/></td></tr>
                <tr><td colspan="2"><input type="text" size="20" id="username" placeholder="Username" name="username"/></tr>
                <tr><td><input type="password" size="20" id="password" placeholder="Password" name="password"/></td><td><input type="text" size="20" id="accesscode" placeholder="Access Code" name="accesscode"/></td></tr>
                <tr><td></td><td><input type="submit"  class="button" value="Register"/></td></tr>
            </table>
        </div>
        </form>
    </div>
</div>

</body>
</html>