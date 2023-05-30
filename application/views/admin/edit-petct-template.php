<form reload-action="true" this_id="form-002" class="update_data" method="post" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Edit</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Template Name</label>
                            <select type="text" name="template_id" required class="form-control">
                                <option value="0"> -- Select Template Name -- </option>
                                <?php foreach ($this->common_model->get_records('tbl_category_with_form', "status='0'") as $template_name) : ?>
                                    <option <?=($record->template_id == $template_name->id)?"selected":""?>  value="<?= $template_name->id ?>"><?= $template_name->name ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="text-danger error-span">This input is required.</span>
                            <input type="hidden" name="row_id" value="<?=$record->id?>">
                            <input type="hidden" name="table_name" value="tbl_petct_template">
                        </div>
                        <div class="col-md-12">
							<label>Negative Finding Name</label>
							<input name="negative_finding"  class="form-control " value="<?=$record->negative_finding?>">
						</div>
                        <div class="col-md-12">
                            <label>Finding Text</label>
							<textarea  name="finding_text" class="form-control"><?=$record->finding_text?></textarea>
                        </div>
						<div class="col-md-12">
							<label>Order By</label>
							<input name="order_by"  class="form-control " value="<?=$record->order_by?>" >
						</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default pull-left" data-dismiss="modal" value="Close">
                    <input type="submit" class="btn btn-primary" value="Save changes">
                </div>
            </form>