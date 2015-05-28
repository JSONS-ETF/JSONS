<html>
<head>
    <title>Upload Form</title>
</head>
<body>

<?php echo form_open_multipart('upload/do_upload');?>

<input type="file" name="userfile" size="20" />

<textarea name="description" cols="20" rows="5" /></textarea>
<input name="idUser" value="<?php echo $idUser; ?>" hidden/>

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>