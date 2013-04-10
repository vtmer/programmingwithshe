<?php
echo validation_errors();
echo form_open('backend/add_tutor');
?>
<form>
<label for="add_tutor">Tutor:</label>
<textarea id="add_tutor" name="add_tutor" rows="10" cols="30"></textarea>
<input type="submit" name="submit" value="submit"/>
</form>
