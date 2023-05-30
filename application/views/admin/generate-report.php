<style>
.custom-btn {
    position: absolute;
    left: 152px;
    top: -44px;
}

.dropdown-submenu {
    position: relative;
}

.dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -6px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
}

.dropdown-submenu:hover>.dropdown-menu {
    display: block;
}

.dropdown-submenu>a:after {
    display: block;
    content: " ";
    float: right;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
    border-width: 5px 0 5px 5px;
    border-left-color: #ccc;
    margin-top: 5px;
    margin-right: -10px;
}

.dropdown-submenu:hover>a:after {
    border-left-color: #fff;
}

.dropdown-submenu.pull-left {
    float: none;
}
.dropdown-menu  a{
    color:#000 !important;
}
.dropdown-submenu.pull-left>.dropdown-menu {
    left: -100%;
    margin-left: 10px;
    -webkit-border-radius: 6px 0 6px 6px;
    -moz-border-radius: 6px 0 6px 6px;
    border-radius: 6px 0 6px 6px;
}
.scroll-down{
	max-height: 300px;
    overflow-y: auto;
}
</style>

<header class="main-header ">
    <nav class="navbar navbar-static-top" style="background:#fff;">
        <div class="container">
            <div class="navbar-header">

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse" style="color:#000;">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
				<?php $userId = $_SESSION['userId'];?>
				<?php foreach($this->common_model->get_records("tbl_category","status ='0' and find_in_set('$userId',user_id)")as $category): ?>
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="javascript:void()" style="color:#000;" class="dropdown-toggle" data-toggle="dropdown"aria-expanded="false">
								<?=$category->name?>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
								<li class="divider"></li>
								<?php foreach($this->common_model->get_records("tbl_sub_category","status ='0' and category_id ='$category->id'")as $sub_category): ?>
									<li class="dropdown-submenu ">
										<a tabindex="-1" href="javascript:void()">
											<?=$sub_category->name?>
										</a>
										<ul class="dropdown-menu scroll-down">
											<?php foreach($this->common_model->get_custom_query("SELECT e.name , c.template_id FROM tbl_template_assign as c , tbl_category_with_form as d , tbl_child_category as e where c.status = 0 and d.status = 0 and e.status = 0 and c.assigned_to = '".$_SESSION['userId']."' and d.id = c.template_id and e.id = d.child_category_id and e.sub_category_id = '$sub_category->id'") as $child_category_form): ?>
												<li>
													<a tabindex="-1" href="<?= base_url() ?>admin/admin-view-form-template/<?=$child_category_form->template_id?>">
														<?=$child_category_form->name?>
													</a>
												</li>
											<?php endforeach;?>	
										</ul>
									</li>
								<?php endforeach;?>
							</ul>
						</li>    
					</ul>
				<?php endforeach;?>
				
            </div>
			<div class="text-right" style="margin: 15px 10px;">
				<a class="btn btn-sm btn-primary2" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-default">
					References
				</a>
			</div>
			
        </div>
    </nav>
</header>
<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<form reload-action="true" this_id="form-002" class="update_data" method="post" role="form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">References Documents</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="title">1. Prompt rad procedure</label>
							</div>
						</div>
						<div class="col-md-6">
							<a class="btn btn-sm btn-primary2" target="_blank" href="<?= base_url() ?>admin/document/20222412167188298963a6e8ed42092.docx" >
								view
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="title">2. Stat portable procedure</label><br>
							</div>
						</div>
						<div class="col-md-6">
							<a class="btn btn-sm btn-primary2" target="_blank" href="<?= base_url() ?>admin/document/20222412167188302163a6e90d1d562.docx">
								view
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="title">3. Umedex procedure</label><br>
							</div>
						</div>
						<div class="col-md-6">
							<a class="btn btn-sm btn-primary2" target="_blank" href="<?= base_url() ?>admin/document/20222412167188291563a6e8a3cd4bf.docx">
								view
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="title">4. TMI procedure</label><br>
							</div>
						</div>
						<div class="col-md-6">
							<a class="btn btn-sm btn-primary2" target="_blank" href="<?= base_url() ?>admin/document/20231901167410580263c8d3cadd6a4.pdf">
								view
							</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="content-wrapper pb-1 cs-font">
    <section class="content  color-bg1 py-6">
        <div class="row">
            <div class="col-md-12  mr-mi-30 mr-lg-0">
                <div class="">
                    <div class="">
                        <div class=" box-primary">
                            <div class="box-header py-0 ">
                                <div class="row box-card mb-6">
                                    <div class="col-sm-11">
                                        <h4 class="text-center head-title"><?= $temp_id->name ?></h4>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 ">
                <form id="insert_template" class="insert_template" reload-action="true" method="post"
                    this_id="<?= uniqid() ?>">
                    <input type="hidden" name="template_form_id" value="<?php echo $temp_id->id ?>">
                    <div class="box-body">
                        <div class="row">
                            <?php
                                $template = $this->common_model->get_records('tbl_admin_copy_template_fields', "status='0' and copy_template_form_id='$temp_id->id' and assign_id = '" . $_SESSION['userId'] . "' group by order_by");
                                foreach ($template as $order) {
                                ?>

                            <div class="box-card mb-none">
                                <div class="box-body py-0">
                                    <?php if ($order->title != "") : ?>
                                    <h4 class="my-6">
                                        <?= $this->common_model->get_record("tbl_main_title", "status = '0' and id = '$order->title'", "title"); ?>
                                    </h4>
                                    <?php endif; ?>
                                    <?php foreach ($this->common_model->get_records('tbl_admin_copy_template_fields', "status='0' and copy_template_form_id='$temp_id->id' and assign_id = '" . $_SESSION['userId'] . "' and order_by = '$order->order_by'") as $template_field) { ?>
                                    <?php if ($template_field->type == 10) { ?>
                                    <div class="col-md-4">
                                        <div class="form-group" id="<?= $template_field->id ?>">
                                            <label for="exampleInputEmail1"><?= $template_field->name ?></label>
                                            <select type="text" class="form-control select2" name="method[]"
                                                id="<?= $template_field->form_fields_id ?>">
                                                <option value="">-- Select --</option>
                                                <?php foreach ($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_id='$template_field->form_fields_id' and assign_id = '" . $_SESSION['userId'] . "'") as $options) : ?>
                                                <option value="<?= $options->name ?>"><?= $options->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php } else if ($template_field->type == 9) { ?>
                                    <div class="col-md-4">
                                        <div class="form-group" id="<?= $template_field->id ?>">
                                            <label for="exampleInputEmail1"><?= $template_field->name ?> <input
                                                    type="checkbox" id="date" name="date" value="1"></label></label>
                                            <input type="date" name="comparison_date" class="form-control h-20"
                                                id="date1">
                                        </div>
                                    </div>
                                    <?php } else if ($template_field->type == 2) { ?>
                                    <div class="col-md-4">
                                        <div class="form-group" id="<?= $template_field->id ?>">
                                            <label for="exampleInputEmail1"><?= $template_field->name ?></label>
                                            <select type="text" class="form-control select2" name="option_name[]"
                                                id="<?= $template_field->form_fields_id ?>">
                                                <option value="">-- Select --</option>
                                                <?php foreach ($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_id='$template_field->form_fields_id' and assign_id = '" . $_SESSION['userId'] . "'") as $options) : ?>
                                                <option value="<?= $options->input_option_id ?>">
                                                    <?= $options->name ?></option>

                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <input type="hidden" value="<?= $template_field->name ?>" name="label_name[]">
                                        <input type="hidden" value="<?= $template_field->form_fields_id ?>"
                                            name="label_id[]">
                                        <input type="hidden" value="<?= $order->title ?>" name="title_id[]">
                                    </div>
                                    <?php } else if ($template_field->type == 4) { ?>
                                    <div class="col-md-4">
                                        <div class="form-group " id="checkbox">
                                            <?php foreach ($this->common_model->get_records('tbl_copy_input_options', "status='0' and input_id='$template_field->form_fields_id' and assign_id = '" . $_SESSION['userId'] . "'") as $options) : ?>
                                            <input type="checkbox" name="option_name[]" id="<?= $template_field->id ?>"
                                                onclick="hideshow(<?= $options->id ?>)"
                                                value="<?= $options->input_option_id ?>">
                                            <?= $options->name ?>
                                            <!--<input id='testNameHidden' type='hidden' value='0' name='option_name[]'>-->
                                            <?php endforeach; ?>
                                        </div>

                                        <input type="hidden" value="<?= $template_field->name ?>" name="label_name[]">
                                        <input type="hidden" value="<?= $template_field->form_fields_id ?>"
                                            name="label_id[]">
                                        <input type="hidden" value="<?= $order->title ?>" name="title_id[]">
                                    </div>
                                    <?php }
                                            }  ?>

                                </div>
                            </div>

                            <?php    } ?>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary2">Generate</button>
                        <a class="btn btn-primary2" onclick="$('.insert_template')[0].reset()">clear</a>
                        <span class="btn btn-primary2 foo" data-clipboard-target="#div1" onclick="myFunction1()">
                            Copy
                        </span>
                    </div>


                </form>
            </div>

            <div class="col-md-6 py-5 py-xl-0 ml-4 ml-lg-0 mr-mi-30 mr-lg-0">
                <div class="row mr-30">
                    <div class="col-md-12 box-card">

                        <div class="col-md-12">
                            <label> Search</label>
                            <label class="my-3"> Title</label>
                            <input type="text" id="txt_search" name="txt_search" required="" class="form-control">
                            <input type="hidden" name="table_name" value="tbl_main_title">
                            <input type="hidden" name="created_by" value="4">
                        </div>


                        <ul id="searchResult"></ul>


                        <div class="col-md-6 hide-ans">
                            <h3>Findings</h3>
                            <div class="text-box-border">

                            </div>
                        </div>
                        <div class="col-md-6 hide-ans">
                            <h3>Impressions</h3>
                            <div class="text-box-border">
                                <div class="impressions_text"></div>

                            </div>
                        </div>
                        <div class="answer_text"></div>

                        <!-- <div class="col-md-6 hide-ans" id="answer_textss">
								<h3>Findings</h3>
								<div class="text-box-border">

								</div>
							</div>
							<div class="col-md-6 hide-ans">
								<h3>Impressions</h3>
								<div class="text-box-border">
									<div class="impressions_text"></div>
								</div>
							</div> -->
                        <!-- <div class="answer_text btn_hide_class"></div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>