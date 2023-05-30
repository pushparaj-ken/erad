<div class="content-wrapper">

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <form class="insert_data" this_id="form-9900" reload-action="true">
                                <div class="col-md-6">
                                    <label>Child Category</label>
                                    <select name="child_category_id" required class="form-control">
                                        <option value="">Select Child Category</option>
                                        <?php foreach ($child_categorys as $child_category) : ?>
                                            <option value="<?= $child_category->id ?>"><?= $child_category->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="text-danger error-span">This input is required.</span>
                                    <input type="hidden" name="slug">
                                    <input type="hidden" name="table_name" value="tbl_category_with_form">
                                    <input type="hidden" name="created_by" value="<?= $_SESSION['userId']; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label>Template Form Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-sm btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <table class="table table-hover data_table">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Child Category Name</th>
                                    <th>Template Name</th>
                                    <th class="text-center">Add Form</th>
                                    <th class="text-center">Date Time</th>
                                    <th class="text-center">Actions</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($records)) {
                                    $inc = 1;
                                    foreach ($records as $record) {
                                ?>
                                        <tr>
                                            <td>
                                                <?php echo $inc; ?>
                                            </td>
                                            <td>
                                                <?= $this->common_model->get_record("tbl_child_category", "status = '0' and id='$record->child_category_id'", "name"); ?>
                                            </td>
                                            <td>
                                                <?= $record->name ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url() ?>admin/admin-form-template/<?= $record->id ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <?php $dateTime = $record->updated_at;
                                                $date = date("d-m-Y", strtotime($dateTime)); ?>
                                                <?= $date ?>
                                            </td>
                                            <td class="text-center" style="display: flex;justify-content: center;">
                                                <a class="btn btn-sm btn-warning" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-default" onclick="$('.update_data input[name=row_id]').val(`<?= $record->id ?>`);$('.update_data input[name=name]').val(`<?= $record->name ?>`);$('.update_data select[name=child_category_id]').val(`<?= $record->child_category_id ?>`);"><i class="fa fa-pencil-square-o"></i></a>
                                                <form class="update_data" this_id="form-<?= uniqid() ?>" reload-action="true">
                                                    <input type="hidden" name="row_id" value="<?= $record->id ?>">
                                                    <input type="hidden" name="status" value="1">
                                                    <input type="hidden" name="table_name" value="tbl_category_with_form">
                                                    <button class="btn btn-sm btn-danger" type="submit">
                                                        <i class="fa fa-close"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-pill btn-success">Active</span>
                                            </td>
                                        </tr>
                                <?php
                                        $inc++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form reload-action="true" this_id="form-002" class="update_data" method="post" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Edit</h4>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6">
                            <label>Child Category</label>
                            <select name="child_category_id" required class="form-control">
                                <option value="">Select Child Category</option>
                                <?php foreach ($child_categorys as $child_category) : ?>
                                    <option value="<?= $child_category->id ?>"><?= $child_category->name ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="text-danger error-span">This input is required.</span>
                            <input type="hidden" name="slug">
                            <input type="hidden" name="row_id">
                            <input type="hidden" name="table_name" value="tbl_category_with_form">
                            <input type="hidden" name="updated_by" value="<?= $_SESSION['userId']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Template Form Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default pull-left" data-dismiss="modal" value="Close">
                    <input type="submit" class="btn btn-primary" value="Save changes">
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/common.js" charset="utf-8"></script>