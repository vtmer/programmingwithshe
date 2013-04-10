<?php 
echo validation_errors();
echo form_open('adminlogin/check');
?>
<form >
<label for="admin">Admin:</label>
<input type="text" name="admin"/>
<label for="pwd">Password:</label>
<input type="text" name='pwd'/>
<input type="submit" name='submit' value="submit"/>
</form>
