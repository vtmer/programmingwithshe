<div id="ENTER">
<?php 
$attributes=array('class'=>'setContent');
?>
<p class='error'>
<?php
echo validation_errors();
?>
</p>
<?php
echo form_open('program/setContent',$attributes);
?>
<form class='setForm'>
<label for="content" >content:</label>
<textarea name="content" rows="10" cols="100"></textarea>
<div> 
<input type="submit" name="submit" value="submit"/>
</div>
</form>
</div>
