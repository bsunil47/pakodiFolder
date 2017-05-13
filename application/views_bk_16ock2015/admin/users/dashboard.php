<div class="content">
    
    <div class="btn-controls">
        <div class="btn-box-row row-fluid" >
           <div class="span8" >
                <div class="row-fluid">
                    <div class="span12" >
                     
					 <a href="javascript:void(0);"  class="btn-box small span4"><i class=" icon-group"></i><b><?php echo count($activeusers); ?></b><button class="btn pakodi">Active users</button></a>
                     <a href="javascript:void(0);"  class="btn-box small span4"><i class="icon-book"></i><b><?php echo count($contentcount); ?></b><button class="btn pakodi">Content Count</button></a>
                     <a href="javascript:void(0);"  class="btn-box small span4"><i class=" icon-download"></i><b><?php echo count($usercontentdownload); ?></b><button class="btn pakodi">Downloads</button></a>
						
                    </div>
                </div>
            </div>
            <a href="javascript:void(0);"  class="btn-box small span4" style="width:180px;"><i class=" icon-film"></i><b><?php echo count($userdubs); ?></b><button class="btn pakodi">Dubs</button></a>	
        </div>
    </div>
    
    <div class="btn-controls">
        <div class="btn-box-row row-fluid">
            <div class="module span12" style="width:800px;">
                <div class="module-head">
                    <h3>Categories</h3>
                    <p align="right"><input type="button" class="btn pakodi" name="bar_chart" value="Bar" id="bar">&nbsp;<input type="button" class="btn pakodi" name="bar_chart" value="Pie" id="pie"> </p>
		        </div>
                <div id="donutchart" style="width: 800px; height:350px;"> </div>
                <div id="number_format_chart" style="display:none;" ></div>
            </div>
        </div>
    </div>  

    <div class="btn-controls">
        <div class="btn-box-row row-fluid">
            <div class="module span12" style="width:800px;">
                <div class="module-head"><h3>Active and Register Users</h3></div>
                <form name="userstats" method="post">
                    <div class="drangebox"><input type="radio" name="userrangetype"  id="yearly"  onclick="return show(1);">Yearly</div>
                    <div class="drangebox"><input type="radio" name="userrangetype"  id="monthly" onclick="return show(2);">Monthly</div>
                    <div class="drangebox"><input type="radio" name="userrangetype"  id="weekly" onclick="return show(3);" checked="checked">Weekly</div>
                    <div class="drangebox"><input type="radio" name="userrangetype"  id="daily" onclick="return show(4);">Daily</div>
                    <div class="clear"></div>
                    <div id="show1" class="hidz">
                        <span style="padding-left:10px;">Select Year :</span>
                        <select name="year" id="year" onchange="return getusersbyyearly();">
                            <?php for($i=date('Y'); $i>(date('Y')-10); $i--){ ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div id="show2" class="hidz">
                        <span style="padding-left:10px;">Select Month :</span><input type="text" name="usermonth" id="usermonth" value="<?php if(!empty($_POST['usermonth'])){ echo $_POST['usermonth']; }else{ echo date('Y-m'); } ?>" readonly="readonly">
                        <input type="button" id="btn_month" class="btn pakodi" value="Go" onclick="return getusersbymonthly();">
                    </div>
                    <div id="show3" class="hidz" style="display: block;">
                        <span style="padding-left:10px;">Select Week :</span><input type="text" class="userweek-picker" name="userweek" id="userweek" value="<?php if(!empty($_POST['userweek'])){ echo $_POST['userweek']; } ?>" readonly="readonly" >
                        <input type="button" id="btn_week" class="btn pakodi" value="Go" onclick="return getusersbyweekly();">
                    </div>
                    <div id="show4" class="hidz">
                        <span style="padding-left:10px;">Select Day :</span><input type="text" name="userday" id="userday" value="<?php if(!empty($_POST['userday'])){ echo $_POST['userday']; }else{ echo date('m/d/Y'); } ?>" readonly="readonly" >
                        <input type="button" id="btn_day" class="btn pakodi" value="Go" onclick="return getusersbydaily();">
                    </div>
                </form>
                <div id="curve_chart" ></div>
            </div>
        </div>
    </div>
    
    <div class="btn-controls">
        <div class="btn-box-row row-fluid">
            <div class="module span12" style="width:800px;">
                <div class="module-head"><h3>Dubs Statistics</h3></div>
                <form name="dubstats" method="post">
                    <div class="drangebox"><input type="radio" name="dubrangetype"  id="yearly"  onclick="return dshow(1);">Yearly</div>
                    <div class="drangebox"><input type="radio" name="dubrangetype"  id="monthly" onclick="return dshow(2);">Monthly</div>
                    <div class="drangebox"><input type="radio" name="dubrangetype"  id="weekly" onclick="return dshow(3);" checked="checked">Weekly</div>
                    <div class="drangebox"><input type="radio" name="dubrangetype"  id="daily" onclick="return dshow(4);">Daily</div>
                    <div class="clear"></div>
                    <div id="dshow1" class="hidz">
                        <span style="padding-left:10px;">Select Year :</span>
                        <select name="dyear" id="dyear" onchange="return getdubsbyyearly();">
                            <?php for($i=date('Y'); $i>(date('Y')-10); $i--){ ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div id="dshow2" class="hidz">
                        <span style="padding-left:10px;">Select Month :</span><input type="text" name="dubmonth" id="dubmonth" value="<?php if(!empty($_POST['dubmonth'])){ echo $_POST['dubmonth']; }else{ echo date('Y-m'); } ?>" readonly="readonly">
                        <input type="button" id="btn_month" class="btn pakodi" value="Go" onclick="return getdubsbymonthly();">
                    </div>
                    <div id="dshow3" class="hidz" style="display: block;">
                        <span style="padding-left:10px;">Select Week :</span><input type="text" class="week-picker" name="dubweek" id="dubweek" value="<?php if(!empty($_POST['dubweek'])){ echo $_POST['dubweek']; } ?>" readonly="readonly" >
                        <input type="button" id="btn_week" class="btn pakodi" value="Go" onclick="return getdubsbyweekly();">
                    </div>
                    <div id="dshow4" class="hidz">
                        <span style="padding-left:10px;">Select Day :</span><input type="text" name="dubday" id="dubday" value="<?php if(!empty($_POST['dubday'])){ echo $_POST['dubday']; }else{ echo date('m/d/Y'); } ?>" readonly="readonly" >
                        <input type="button" id="btn_day" class="btn pakodi" value="Go" onclick="return getdubsbydaily();">
                    </div>
                </form>
                <div id="curve_chart1" ></div>
            </div>
        </div>
    </div>
</div>
