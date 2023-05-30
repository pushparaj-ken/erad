<div class="content-wrapper">

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-body">
						<div id='gUMArea'>
							<div>
								Record:
								<input type="radio" name="media" value="video" checked id='mediaVideo'>Video
								<input type="radio" name="media" value="audio">audio
							</div>
							<button class="btn btn-default"  id='gUMbtn'>
								Request Stream
							</button>
						</div>
						<div id='btns'>
							<div class="row">
								<a class="btn btn-sm btn-warning" href="<?=base_url()?>admin/record" >
									Back
								</a>
							</div>
							<button  class="btn btn-default" id='start'>Start</button>
							<button  class="btn btn-default" id='stop'>Stop</button>
						</div>
						<div>
							<ul  class="list-unstyled" id='ul'></ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script>
$( document ).ready(function() {
    $('#btns').hide();
});
</script>
<script type="text/javascript"  src="<?php echo base_url(); ?>assets/admin/js/audioscript.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/common.js" charset="utf-8"></script>