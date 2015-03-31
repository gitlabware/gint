<div class="panel-collapse">
    <div class="panel-body">
        <div class="form-group">
            <label class="col-sm-4 control-label">Default</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="datepicker1" placeholder="Select a date" />
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <form class="panel panel-default" action="" data-parsley-validate>
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-tshirt mr5"></i> T-shirt order sample</h3>
            </div>               
            <div class="panel-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="control-label">Name <span class="text-danger">*</span></label>
                            <input name="name" type="text" class="form-control" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="control-label">Email <span class="text-danger">*</span></label>
                            <input name="email" type="text" class="form-control" data-parsley-trigger="change" data-parsley-type="email" required data-parsley-error-message="sssssss">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">Proceed</button>
                <button type="reset" class="btn btn-inverse">Reset</button>
            </div>
        </form>
    </div>
</div>
<?php echo $this->Html->css(array(
    '../plugins/jquery-ui/css/jquery-ui.css'
));?>
<?php echo $this->Html->script(array(
    '../plugins/selectize/js/selectize.js'
    ,'../plugins/jquery-ui/js/jquery-ui.js'
    ,'../plugins/jquery-ui/js/addon/timepicker/jquery-ui-timepicker.js'
    ,'../plugins/parsley/js/parsley.js'
    )); ?>
<script>
$('#datepicker1').datepicker();
</script>