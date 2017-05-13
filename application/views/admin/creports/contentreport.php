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
		<form name="date" method="post" class="table-form">
            <table cellpadding="0" cellspacing="0" border="0" width="100%" >
                <tr  style="background-color: #f6f6f6">
                    <td>Unique Id :</td>
                    <td><div class="input-group"><input class="form-control" type="text" name="uid" id="uid" placeholder="Enter Unique Code..."></div>
                    </td><td></td><td></td><td></td></tr>
                <tr style="background-color: #f6f6f6">
                        <td align="left" style="width: 9.5%"><div id="column1" class="col1"><i class="iconred icon-filter"></i></div></td>
                        <td align="left" style="width:30%">
                            <div class='input-group date' id='from_date'><input type='text' class="form-control" name="fromdate" id="fromdate" value="<?php if (!empty($_POST['fromdate'])) {echo $_POST['fromdate'];}else{$start=date('m')."/01/".date('Y'); echo $start;} ?>" />
                                <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span></div>
                        </td>
                        <td style="width: 10.5%"></td>
                        <td align="right" style="width:30%">
                            <div class='input-group date' id='to_date'><input type='text' class="form-control" name="todate" id="todate" value="<?php if (!empty($_POST['todate'])) {echo $_POST['todate'];}else{$end=date('m')."/".date('d')."/".date('Y');echo $end;} ?>" />
                                <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span></div>                        </td>

                        <td style="text-align: center">
                            <input type="submit" name="contentsubmit" id="reportsubmit" value="Search" class="btn pakodi" style="">
                        </td>
                    </form>
                </tr>
                <tr><td></td><td></td><td></td><td></td><td></td></tr>
            </table>

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

    
