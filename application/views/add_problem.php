<?php
echo validation_errors();
?>
<?php echo form_open('backend/add_problem');?>
<form >
<label for="add_problem">problem:</label>
<textarea id="setProblem" name="add_problem" rows="10" cols="30"></textarea>
<input type="submit" name="submit" value="submit"/>
</form>
