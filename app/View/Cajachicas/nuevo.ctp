<link rel="stylesheet" href="<?php echo $this->webroot; ?>plugins/selectize/css/selectize.css">
<link rel="stylesheet" href="<?php echo $this->webroot; ?>plugins/jquery-ui/css/jquery-ui.css">
<link rel="stylesheet" href="<?php echo $this->webroot; ?>plugins/select2/css/select2.css">
<link rel="stylesheet" href="<?php echo $this->webroot; ?>plugins/touchspin/css/touchspin.css">
<!-- START row -->
<div class="row">
    <div class="col-md-4">
        <!-- START panel -->
        <form class="panel panel-primary form-horizontal form-bordered" action="">
            <!-- panel heading/header -->
            <div class="panel-heading">
                <h3 class="panel-title">Select2</h3>
            </div>            
            <!--/ panel heading/header -->
            <!-- panel body with collapse capabale -->
            <div class="panel-collapse">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Seleccione</label>
                        <div class="col-sm-9">
                            <input name="name" type="text" class="form-control" id="txtcategoria">
                        </div>
                    </div>                
                </div>
            </div>
            <!--/ panel body with collapse capabale -->
        </form>
        <!-- END form panel -->
    </div>
    <div class="col-md-8">
        <!-- START panel -->
        <div class="panel panel-success">
            <!-- panel heading/header -->
            <div class="panel-heading">
                <h3 class="panel-title">Striped row</h3>
                <!-- panel toolbar -->
                <div class="panel-toolbar text-right">
                    <!-- option -->
                    <div class="option">
                        <button class="btn up" data-toggle="panelcollapse"><i class="arrow"></i></button>
                        <button class="btn" data-toggle="panelremove" data-parent=".col-md-12"><i class="remove"></i></button>
                    </div>
                    <!--/ option -->
                </div>
                <!--/ panel toolbar -->
            </div>
            <!--/ panel heading/header -->
            <!-- panel body with collapse capabale -->
            <div class="table-responsive panel-collapse pull out">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Income</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center"><span class="sparklines" sparkType="line" sparkLineColor="#4fc0e8" sparkFillColor="#d6f0fa">1,6,2,9,6,9,6,8,0,8</span></td>
                            <td>Norman Harmon</td>
                            <td>$43.34</td>
                            <td>Mar 3, 2014</td>
                        </tr>
                        <tr>
                            <td class="text-center"><span class="sparklines" sparkType="line" sparkLineColor="#ac92ed" sparkFillColor="#cdbef4">4,1,6,5,5,3,4,6,1,7</span></td>
                            <td>Plato Pickett</td>
                            <td>$65.93</td>
                            <td>Jan 21, 2014</td>
                        </tr>
                        <tr>
                            <td class="text-center"><span class="sparklines" sparkType="line" sparkLineColor="#a0d569" sparkFillColor="#dbefc6">3,9,0,1,6,6,6,2,9,1</span></td>
                            <td>Nathan Paul</td>
                            <td>$6.07</td>
                            <td>Feb 4, 2013</td>
                        </tr>
                        <tr>
                            <td class="text-center"><span class="sparklines" sparkType="line" sparkLineColor="#f1c40f" sparkFillColor="#fbefc0">0,4,6,4,8,5,6,7,5,3</span></td>
                            <td>Nasim Larson</td>
                            <td>$11.28</td>
                            <td>Sep 17, 2013</td>
                        </tr>
                        <tr>
                            <td class="text-center"><span class="sparklines" sparkType="line" sparkLineColor="#ed5466" sparkFillColor="#f8c0c6">2,6,9,5,4,9,8,5,7,4</span></td>
                            <td>Odysseus Nguyen</td>
                            <td>$7.51</td>
                            <td>Aug 8, 2014</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!--/ panel body with collapse capabale -->
        </div>
    </div>
</div>
<!--/ END row -->
<script type="text/javascript">
//<![CDATA[
  $("#txtcategoria").bind("keyup", function (event) {
      $.ajax({
          async: true,
          data: $("#txtpropietario").serialize(),
          dataType: "html",
          success: function (data, textStatus) {
              $("#listadoPropietarios").html(data);
          }, type: "post", url: "<?php echo $this->Html->url(array('action' => 'ajaxbuscapropietario')); ?>"});
      return false;
  });
//]]>
</script>