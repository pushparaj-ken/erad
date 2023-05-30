<option value="0"> -- Select Main Name -- </option>
<?php foreach ($record as $template_name) : ?>
	<option  value="<?= $template_name->id ?>"><?=$this->common_model->get_record("tbl_main_title","status = '0' and id = '$template_name->title'","title");?></option>
<?php endforeach; ?>