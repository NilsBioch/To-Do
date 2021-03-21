<?
echo "<option value="$status['id']" . "if ($task['status_id'] == $status['id']) echo 'selected="selected' ">" echo $status['name'] "</option>";
?>
<option value="<?php $status['id'] ?>" <?php if ($task['status_id'] == $status['id']) echo 'selected="selected" '; ?> ><?php echo $status['name'] ?></option>