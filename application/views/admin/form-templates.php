<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form class="form-horizontal">
                                    <fieldset>
                                        <div class="col-md-6">
                                            <h3>Input Fields</h3>
                                            <hr />
                                            <?php foreach ($records as $record) { ?>
                                            <div id="firstnamedrag" class="form-group" draggable="true" ondragstart="drag(event)">
                                                <!--<label class="col-md-3 control-label" for="textinput">Name</label>
                                            <div class="col-md-6">
                                                <input id="textinput" name="textinput" type="text" placeholder="John" class="form-control pull-right" data-toggle="modal" data-target="#modal-default" onclick="$('.update_data input[name=row_id]').val(`<?= $record->id ?>`);" />
                                            </div>-->
                                                <?=$record->name?>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>

                            <div class="col-md-6">
                                <div id="builder" class="panel panel-default">
                                    <h3>Drag Fields</h3>
                                    <hr />
                                    <div class="panel-body" ondrop="drop(event)" ondragover="allowDrop(event)">
                                        <form id="target" class="form-horizontal"></form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
							<div class="form-group">
								<label for="title">Name</label>
								<input type="text" class="form-control" name="name"></textarea>
								<span class="text-danger error-span">This input is required.</span>
								<input type="hidden" name="row_id" value="">
							</div>
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
<!--<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div id="fb-editor"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>-->

  // <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  // <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  // <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
 // <script>
  // jQuery(function($) {
    // $(document.getElementById('fb-editor')).formBuilder();
  // });
  // </script>


<script>
function allowDrop(ev) {
  ev.preventDefault();
}
function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}
function drop(ev) {
  ev.preventDefault();
  var data = ev.dataTransfer.getData("text");
  ev.target.appendChild(document.getElementById(data));
}


</script>


