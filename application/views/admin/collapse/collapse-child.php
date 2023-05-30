<option value="0"> -- Select Child Name -- </option>
<?php $exp = explode(",", $record->select_fields_id_child); ?>
<?php foreach ($exp as $template_name) :?>

	<option  value="<?= $template_name?>"><?= $this->common_model->get_record("tbl_form_template_fields","id='$template_name'","name"); ?></option>
<?php endforeach; ?>