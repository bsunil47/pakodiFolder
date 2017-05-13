<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>Content Report</h3></td>
                    <td align="right"><!--<a href="http://sprintmedia.s3.amazonaws.com/reports/" class='btn pakodi' >Export</a>--></td>
                </tr>
            </table>
        </div>
        <div class="module-body table">
                      
                <!--div class="control-group span11">
                    <div class="span6" style="margin-bottom: 5px">
                        <label class="control-label span4" style="display:none"  >Search Unique Id :</label>
                    <div class="controls span4" style="margin-left: 10px;display:none">
                         <input type="text" name="uid1" id="uid1" placeholder="Enter Unique Code...">
                    </div>
                    </div>
                    <div class="span6" style="margin-bottom: 5px">
                        <label class="control-label span4"   >Search Unique Id :</label>
                    <div class="controls span4" style="margin-left: 10px;">
                         <input type="text" name="uid" id="uid" placeholder="Enter Unique Code...">
                    </div>
                    </div>
                    <div class="span6" style="margin-left: 0px; margin-bottom: 5px">
                        <label class="control-label span4" id="report-start-label" >Report Start Date :</label>
                        <div class="controls span4" id="report-start" style="margin-left: 12px;">
                            <input type="text" name="fromdate" id="fromdate" value="<?php //if (!empty($_POST['fromdate'])) {
                               // echo $_POST['fromdate'];
                            //}else{$start=date('m')."/01/".date('Y');echo $start;} ?>" readonly="readonly" >
                        </div>

                    </div>
                    <div class="span6" style="margin-bottom: 5px">
                        <label class="control-label span4" style="display:none"  >Search Unique Id :</label>
                        <div class="controls span4" style="margin-left: 10px;display:none">
                            <input type="text" name="uid2" id="uid2" placeholder="Enter Unique Code...">
                        </div>
                        <label class="control-label span4" id="month-label">Report End Date :</label>
                        <div class="controls span4" id="months" style="margin-left: 10px">
                            <input type="text" name="todate" id="todate" value="<?php //if (!empty($_POST['todate'])) {
                                //echo $_POST['todate'];
                            //}else{$end=date('m')."/".date('d')."/".date('Y');echo $end;} ?>"  readonly="readonly" >
                        </div>
                    </div>
                    <div class="span9" style="margin-left: 0px;margin-bottom: 5px">
                    </div>
                    <div class="span3" style="margin-left: 0px; margin-bottom: 5px">
                        <input type="submit" name="contentsubmit" id="reportsubmit" value="Search" class="btn pakodi" style="float: right; margin-right: 10px">
                    </div>
                </div-->
				<div class="module-body table" style="border-bottom: 1px solid #d5d5d5;">
            <form name="date" method="post" class="form-horizontal row-fluid table-form">
			
            <div id="column1" style="float:left;width: 4%;  padding-left:15px;"><i class="iconred icon-filter"></i></div>
			<div id="column2" style="float:left;width: 27%;">
				<div class='input-group date' id='from_date'><input type='text' class="form-control" name="fromdate" id="fromdate" /><span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span></div>
			</div>
			<div id="column3" style="float:left;width: 27%;">
				<div class='input-group date' id='to_date'><input type='text' class="form-control" name="todate" id="todate"/><span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span></div>
			
			</div>
			
			<div id="column4" style="float:left;width: 10%;">
                        <label class="controls span4" >Unique Id :</label>
                    <div class="controls span4" style="margin-left: 10px;">
                         <input type="text" name="uid" id="uid" placeholder="Enter Unique Code...">
                    </div>
                    </div>
			<div id="column5" style="float:left;width: 33%;">
				<input type="submit" name="contentsubmit" id="reportsubmit" value="Search" class="pakodi" style="margin-bottom: 10px;padding: 4px;">
                </div>
			<div style="clear: both;" ></div>
                 </form>
            <table cellpadding="0" cellspacing="0" border="0" class=" table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">Unique Code</th>
                        <th align="left">Dubs Count</th>
                        <th align="left">Download Count</th>
                        <th align="left" >Viewed Count</th>
                        <th align="left">Shared Count</th>
                    </tr>
                </thead>
               
                <tbody>
                     <?php if(!empty($_POST['uid'])){?>
                    <tr><td><?php if(!empty($_POST['uid'])){print_r($_POST['uid']);}?></td>
                    <td> <?php if(!empty($dubscount)){print_r($dubscount->dubscount);}else{echo 0;}?></td>
                    <td><?php if(!empty($downloadcount)){print_r($downloadcount->downloadcount);}else{echo 0;}?></td>
                    <td><?php if(!empty($viewedcount)){print_r($viewedcount->viewedcount);}else{echo 0;}?></td>
                     <td><?php if(!empty($sharedcount)){print_r($sharedcount->sharedcount);}else{echo 0;}?></td></tr><?php }else{?>
                     <tr><td colspan="5">No Results Found</td></tr><?php }?>
                  </tbody>
                
            </table>
        </div>
    </div>
</div>

    
