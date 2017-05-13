<div class="content">
    <div class="btn-controls">
        <div class="btn-box-row row-fluid">
            <div class="span8">
                <div class="row-fluid">
                    <div class="span12">
                        <a href="<?php echo base_url(); ?>content/clist"  class="btn-box small span4"><i class="icon-download"></i><b>&nbsp;</b>Content List</a>
                        <!--<a href="<?php echo base_url(); ?>content/createjob" class="btn-box small span4"><i class="icon-upload"></i><b>&nbsp;</b>Create Job</a>-->
						
                    </div>

                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <form enctype="multipart/form-data" method="POST" action="<?php echo base_url(); ?>content/createjob" class="btn-box small span8">
                            <label style="color:blue">Content zip upload</label>
                            <input name="file" type="file" />
                            <input type="submit" value="submit" name="submit" id="create_job" />
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<?php
/* $val_data = "[['Date', 'Merchants', 'Customers'],";
  foreach ($gr as $key => $value) {
  (!empty($value['merchant'])) ? $merchant_v = $value['merchant'] : $merchant_v = 0;
  (!empty($value['customer'])) ? $customer_v = $value['customer'] : $customer_v = 0;
  //jS \of F Y date('jS \of F Y', $key)
  $val_data = $val_data . "['" . date('j M y', strtotime($key)) . "'," . $merchant_v . "," . $customer_v . "],";
  }
  trim($val_data, ",");
  ?>
  <?php
  $val_datanew = "[['Date', 'Cashout', 'Topup'],";
  foreach ($dates as $key => $value) {

  (!empty($cashout[$value])) ? $cashout_v = $cashout[$value] : $cashout_v = 0;
  (!empty($topup[$value])) ? $topup_v = $topup[$value] : $topup_v = 0;

  $val_datanew = $val_datanew . "['" . date('j M y', strtotime($value)) . "'," . $cashout_v . "," . $topup_v . "],";
  }
  trim($val_datanew, ","); */
?>

<!--<div class="btn-controls">
    <div class="btn-box-row row-fluid">
        <div class="module span6">
            <div class="module-head"><h3> Users</h3></div>

            <div id="donutchart" class="graph" > </div>

        </div>


        <div class="module span6">
            <div class="module-head"><h3> Users Login Count</h3>  </div>

            <div id="curve_chart" ></div>

        </div>
    </div>
</div>-->
<!--/.module-->
<!--    <br />-->
<!--<div class="btn-controls">
    <div class="btn-box-row row-fluid">
        <div class="module span12">
            <div class="module-head"><h3> Cash In & Out</h3>  </div>

            <div id="curve_chart1"></div>

        </div>
    </div>
</div>-->

