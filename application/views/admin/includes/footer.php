</div>

<footer class="main-footer">
	<div class="pull-right hidden-xs">Version 1.0</div>
	<strong>Copyright &copy; <script>
			document.write(new Date().getFullYear())
		</script> <a href="<?php echo base_url(); ?>"><?= $this->config->item('app_name') ?></a>.</strong> All Rights Reserved.
</footer>

<div class="spinner-border" role="status">
 <img src="https://upload.wikimedia.org/wikipedia/commons/c/c7/Loading_2.gif">
</div>


<script src="<?php echo base_url(); ?>assets/admin/js/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/dist/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/dist/js/app.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/validation.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-print-1.6.1/rr-1.2.6/datatables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-print-1.6.1/rr-1.2.6/datatables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>

<script src="https://ckeditor.com/latest/ckeditor.js"></script>

<!--<script data-main="<?php echo base_url(); ?>assets/admin/js/form2/bootstrap-form-builder-gh-pages/assets/js/main-built.js"
	 src="<?php echo base_url(); ?>assets/admin/js/form2/bootstrap-form-builder-gh-pages/assets/js/lib/require.js" ></script>-->

<script>

function cronJob() {
	debugger
    $.ajax({
        type: 'POST',
        url: baseURL + "cron-job",
        dataType: "json",
        beforeSend: function() {
            $('a').attr('disabled', 'true');
			$('.spinner-border').show();
        },
        success: function(response) {
            $('.spinner-border').hide();
			if (response.result == 1) {
				toastr.success('Success!');
				 $('a').removeAttr('disabled');
				setTimeout(function() {
						location.reload();
					}, 1000);
			} else {
				toastr.error('Something went wrong! Please try again later!');
				 $('a').removeAttr('disabled');
			}
        }
    });
}
</script>

<script>
$('.spinner-border').hide();

	$('.select2').select2();

	if ($("#editor1").length != 0) {
		CKEDITOR.replace('editor1');
	}
	if ($("#editor2").length != 0) {
		CKEDITOR.replace('editor2');
	}
	if ($("#editor3").length != 0) {
		CKEDITOR.replace('editor3');
	}
	if ($("#editor4").length != 0) {
		CKEDITOR.replace('editor4');
	}
	if ($("#editor").length != 0) {
		CKEDITOR.replace('editor');

		CKEDITOR.editorConfig = function(config) {
			config.toolbar = [{
					name: 'document',
					items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates']
				},
				{
					name: 'clipboard',
					items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
				},
				{
					name: 'editing',
					items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
				},
				'/',
				{
					name: 'basicstyles',
					items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat']
				},
				{
					name: 'paragraph',
					items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language']
				},
				{
					name: 'links',
					items: ['Link', 'Unlink', 'Anchor']
				},
				{
					name: 'insert',
					items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak']
				},
				'/',
				{
					name: 'styles',
					items: ['Styles', 'Format', 'Font', 'FontSize']
				},
				{
					name: 'colors',
					items: ['TextColor', 'BGColor']
				},
				{
					name: 'tools',
					items: ['Maximize', 'ShowBlocks']
				}
			];
		};
	}
</script>
<script type="text/javascript">
	$('.data_table').DataTable({
		"dom": '<"top"fB>rt<"bottom"lp><"clear">',
		lengthMenu: [
			[50, 75, 100, -1],
			['50', '75', '100', 'Show all']
		],
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdfHtml5'
		],
		select: true,
	});
	$('.data_table_1').DataTable();
	//$('.select2').select2();

	var url = window.location;
	// for sidebar menu but not for treeview submenu
	$('ul.sidebar-menu a').filter(function() {
		return this.href == url;
	}).parent().siblings().removeClass('active').end().addClass('active');
	// for treeview which is like a submenu
	$('ul.treeview-menu a').filter(function() {
		return this.href == url;
	}).parentsUntil(".sidebar-menu > .treeview-menu").siblings().removeClass('active menu-open').end().addClass('active menu-open');
</script>
</body>

</html>