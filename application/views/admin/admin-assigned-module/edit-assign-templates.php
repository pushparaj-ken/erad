<div class="row">
	<div class="col-md-6">
		<label>Template Names</label>
		<select class="form-control required select22" multiple name="template_id[]">
			<option value="">-- Select Template Name --</option>
			
			<?php foreach ($this->common_model->get_records('tbl_category_with_form', "status='0'") as $template) : ?>
				<option <?=($record->template_id == $template->id)?"selected":""?> value="<?= $template->id ?>"><?= $template->name ?></option>
			<?php endforeach; ?>
		</select>
		<span class="text-danger error-span">This input is required.</span>
		<input type="hidden" name="table_name" value="tbl_template_assign">
		<input type="hidden" name="row_id" value="<?=$product?>">
		<input type="hidden" name="assigned_from" value="<?= $_SESSION['userId'] ?>">
		<input type="hidden" name="updated_by" value="<?= $_SESSION['userId'] ?>">
	</div>
	<div class="col-md-6">
		<label>Group Name</label>
		<select name="group_id" class="form-control required">
			<option value="">-- Select Group --</option>
			<?php foreach ($this->common_model->get_records('tbl_group', "status='0'") as $group) : ?>
				<option <?=($record->group_id == $group->id)?"selected":""?> value="<?= $group->id ?>"><?= $group->group_name ?></option>
			<?php endforeach; ?>
		</select>
		<span class="text-danger error-span">This input is required.</span>
	</div>
	<div class="col-md-6">
		<label>Assigned To</label>
		<select name="assigned_to" class="form-control required">
			<option value="">-- Select Admin --</option>
			<?php foreach ($this->common_model->get_records('tbl_users', "isDeleted='0' and roleId='3'") as $admin) : ?>
				<option <?=($record->assigned_to == $admin->userId)?"selected":""?> value="<?= $admin->userId ?>"><?= $admin->name ?></option>
			<?php endforeach; ?>
		</select>
		<span class="text-danger error-span">This input is required.</span>
	</div>
</div>