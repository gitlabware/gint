<link rel="stylesheet" href="<?php echo $this->webroot; ?>plugins/select2/css/select2.css">
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
                        <label class="col-sm-4 control-label">Basic</label>
                        <div class="col-sm-8">
                            <select name="select2-basic" class="form-control">
                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                    <option value="AK">Alaska</option>
                                    <option value="HI">Hawaii</option>
                                </optgroup>
                                <optgroup label="Pacific Time Zone">
                                    <option value="CA">California</option>
                                    <option value="NV">Nevada</option>
                                    <option value="OR">Oregon</option>
                                    <option value="WA">Washington</option>
                                </optgroup>
                                <optgroup label="Mountain Time Zone">
                                    <option value="AZ">Arizona</option>
                                    <option value="CO">Colorado</option>
                                    <option value="ID">Idaho</option>
                                    <option value="MT">Montana</option><option value="NE">Nebraska</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="UT">Utah</option>
                                    <option value="WY">Wyoming</option>
                                </optgroup>
                                <optgroup label="Central Time Zone">
                                    <option value="AL">Alabama</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TX">Texas</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="WI">Wisconsin</option>
                                </optgroup>
                                <optgroup label="Eastern Time Zone">
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="IN">Indiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="NH">New Hampshire</option><option value="NJ">New Jersey</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="OH">Ohio</option>
                                    <option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option>
                                    <option value="VT">Vermont</option><option value="VA">Virginia</option>
                                    <option value="WV">West Virginia</option>
                                </optgroup>
                            </select>
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
<script type="text/javascript" src="<?php echo $this->webroot; ?>plugins/select2/js/select2.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>javascript/backend/forms/element.js"></script>