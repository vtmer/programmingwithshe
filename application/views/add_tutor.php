<?php
echo validation_errors();
echo form_open('backend/tutor/create');
?>
<form>
<label for="create_tutor">Tutor:</label>
<textarea id="create_tutor" name="create_tutor" rows="10" cols="30"></textarea>
<input type="submit" name="submit" value="submit"/>
</form>
