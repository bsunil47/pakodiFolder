<div class="content">

    <div class="btn-controls">
        <div class="btn-box-row row-fluid" >
           <div class="span8" >
                <div class="row-fluid">
                    <div class="span12" >

					 <a href="javascript:void(0);"  class="btn-box small span4 nohover"><i class=" icon-group"></i><b><?php echo count($activeusers); ?></b>User Activity</a>
                     <a href="javascript:void(0);"  class="btn-box small span4 nohover"><i class="icon-book"></i><b><?php echo count($contentcount); ?></b>Content Count</a>
                     <a href="javascript:void(0);"  class="btn-box small span4 nohover"><i class=" icon-download"></i><b><?php echo count($usercontentdownload); ?></b>Downloads</a>

                    </div>
                </div>
            </div>
            <a href="javascript:void(0);"  class="btn-box small span4 nohover" style="width:180px;"><i class=" icon-film"></i><b><?php echo count($userdubs); ?></b>Dubs</a>
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
    <style>
        .drangebox{
            width: auto;
        }
        .hidz{
            margin-left: 20px;
            padding: 0px;
        }
    </style>
    <div class="btn-controls">
        <div class="btn-box-row row-fluid">
            <div class="module span12" style="width:800px;">
                <div class="module-head"><h3>User Activity and Registered Users</h3></div>
				<div class="clear"></div>
                <form name="userstats" method="post">
		<div style="padding:5px; width:50%;line-height: 35px">
                    <div class="drangebox"><input type="radio" name="userrangetype"  id="yearly"  onclick="return show(1);">&nbsp;Yearly</div>
                    <div class="drangebox"><input type="radio" name="userrangetype"  id="monthly" onclick="return show(2);">&nbsp;Monthly</div>
                    <div class="drangebox"><input type="radio" name="userrangetype"  id="weekly" onclick="return show(3);" checked="checked">&nbsp;Weekly</div>
                    <div class="drangebox"><input type="radio" name="userrangetype"  id="daily" onclick="return show(4);">&nbsp;Daily</div>
                    </div>
                    <div style="width: 50%; display: inline-block">
                    <div id="show1" class="hidz">
                        <span style="padding-left:10px;">Select Year :</span>
                        <select name="year" id="year" onchange="return getusersbyyearly();">
                            <?php for($i=date('Y'); $i>(date('Y')-10); $i--){ ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div id="show2" class="hidz">
                        <span style="padding-left:10px;">Select Month :</span>&nbsp;<input type="text" name="usermonth" id="usermonth" style="margin-bottom: -1px;" value="<?php if(!empty($_POST['usermonth'])){ echo $_POST['usermonth']; }else{ echo date('Y-m'); } ?>" readonly="readonly">
                        <input type="button" id="btn_month" class="btn pakodi" style="margin-bottom: 10px;padding: 4px; margin-bottom: -1px;" value="Go" onclick="return getusersbymonthly();">
                    </div>
                    <div id="show3" class="hidz" style="display: block;">
                        <span style="padding-left:10px;">Select Week :</span>&nbsp;<input type="text" class="userweek-picker" style="margin-bottom: -1px;" name="userweek" id="userweek" value="<?php if(!empty($_POST['userweek'])){ echo $_POST['userweek']; } ?>" readonly="readonly" >
                        <input type="button" id="btn_week" class="btn pakodi" style="margin-bottom: 10px;padding: 4px; margin-bottom: -1px;" value="Go" onclick="return getusersbyweekly();">
                    </div>
                    <div id="show4" class="hidz">
                        <span style="padding-left:10px;">Select Day :</span>&nbsp;<input type="text" name="userday" id="userday" style="margin-bottom: -1px;" value="<?php if(!empty($_POST['userday'])){ echo $_POST['userday']; }else{ echo date('m/d/Y'); } ?>" readonly="readonly" >
                        <input type="button" id="btn_day" class="btn pakodi" style="margin-bottom: 10px;padding: 4px; margin-bottom: -1px;" value="Go" onclick="return getusersbydaily();">
                    </div>
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
				<div style="padding:5px; width:50%; line-height: 35px">
                    <div class="drangebox"><input type="radio" name="dubrangetype"  id="yearly"  onclick="return dshow(1);">&nbsp;Yearly</div>
                    <div class="drangebox"><input type="radio" name="dubrangetype"  id="monthly" onclick="return dshow(2);">&nbsp;Monthly</div>
                    <div class="drangebox"><input type="radio" name="dubrangetype"  id="weekly" onclick="return dshow(3);" checked="checked">&nbsp;Weekly</div>
                    <div class="drangebox"><input type="radio" name="dubrangetype"  id="daily" onclick="return dshow(4);">&nbsp;Daily</div>
                    </div>
                    <div style="width: 50%; display: inline-block">
                        <div id="dshow1" class="hidz">
                            <span style="">Select Year :</span>
                            <select name="dyear" id="dyear" onchange="return getdubsbyyearly();">
                                <?php for($i=date('Y'); $i>(date('Y')-10); $i--){ ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div id="dshow2" class="hidz">
                            <span style="padding-left:10px;">Select Month :</span>&nbsp;<input type="text" name="dubmonth" id="dubmonth" style="margin-bottom: -1px;" value="<?php if(!empty($_POST['dubmonth'])){ echo $_POST['dubmonth']; }else{ echo date('Y-m'); } ?>" readonly="readonly">
                            <input type="button" id="btn_month" class="btn pakodi" style="margin-bottom: 10px;padding: 4px; margin-bottom: -1px;" value="Go" onclick="return getdubsbymonthly();">
                        </div>
                        <div id="dshow3" class="hidz" style="display: block;">
                            <span style="padding-left:10px;">Select Week :</span>&nbsp;<input type="text" class="week-picker" name="dubweek" id="dubweek" style="margin-bottom: -1px;" value="<?php if(!empty($_POST['dubweek'])){ echo $_POST['dubweek']; } ?>" readonly="readonly" >
                            <input type="button" id="btn_week" class="btn pakodi" style="margin-bottom: 10px;padding: 4px; margin-bottom: -1px;" value="Go" onclick="return getdubsbyweekly();">
                        </div>
                        <div id="dshow4" class="hidz">
                            <span style="padding-left:10px;">Select Day :</span>&nbsp;<input type="text" name="dubday" id="dubday" style="margin-bottom: -1px;" value="<?php if(!empty($_POST['dubday'])){ echo $_POST['dubday']; }else{ echo date('m/d/Y'); } ?>" readonly="readonly" >
                            <input type="button" id="btn_day" class="btn pakodi" style="margin-bottom: 10px;padding: 4px; margin-bottom: -1px;" value="Go" onclick="return getdubsbydaily();">
                        </div>
                    </div>

                </form>
                <div id="curve_chart1" ></div>
            </div>
        </div>
    </div>
</div>
