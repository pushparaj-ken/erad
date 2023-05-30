<div class="content-wrapper">

    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/addNew"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
				<?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
			</div>
		</div>
        <div class="row">
            <div class="col-xs-12">
			 <?php if($roleId != "1"): ?>
                <div class="box">
                    <div class="box-body table-responsive">
                        <table class="table table-hover data_table">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Role</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								if(!empty($userRecords))
								{
									$inc = 1;
									foreach($userRecords as $record)
									{
								?>
										<tr>
											<td><?php echo $inc; ?></td>
											<td><?php echo $record->name ?></td>
											<td><?php echo $record->email ?></td>
											<td><?php echo $record->mobile ?></td>
											<td>
												<?php echo $this->common_model->get_record("tbl_roles", "roleId = '" . $record->roleId . "'", "role") ?>
											</td>
											<td class="text-center">
												<a class="btn btn-sm btn-info" href="<?php echo base_url().'admin/editOld/'.$record->userId; ?>">
													<i class="fa fa-pencil"></i>
												</a>
												<a class="btn btn-sm btn-danger deleteUser" href="javascript: void(0);" data-userid="<?php echo $record->userId; ?>">
													<i class="fa fa-trash"></i>
												</a>
											</td>
										</tr>
                                <?php
									$inc++;
									}
								}
								?>
                            </tbody>
                        </table>
                    </div>
                </div>
			<?php endif ?>
			 <?php if($roleId == "2"): ?>
                <div class="box">
                    <div class="box-body table-responsive">
                        <table class="table table-hover data_table">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Role</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								if(!empty($userRecords1))
								{
									$inc = 1;
									foreach($userRecords1 as $record)
									{
								?>
										<tr>
											<td><?php echo $inc; ?></td>
											<td><?php echo $record->name ?></td>
											<td><?php echo $record->email ?></td>
											<td><?php echo $record->mobile ?></td>
											<td>
												<?php echo $this->common_model->get_record("tbl_roles", "roleId = '" . $record->roleId . "'", "role") ?>
											</td>
											<td class="text-center">
												<a class="btn btn-sm btn-info" href="<?php echo base_url().'admin/editOld/'.$record->userId; ?>">
													<i class="fa fa-pencil"></i>
												</a>
												<a class="btn btn-sm btn-danger deleteUser" href="javascript: void(0);" data-userid="<?php echo $record->userId; ?>">
													<i class="fa fa-trash"></i>
												</a>
											</td>
										</tr>
                                <?php
									$inc++;
									}
								}
								?>
                            </tbody>
                        </table>
                    </div>
                </div>
			<?php endif ?>
		  </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/common.js" charset="utf-8"></script>