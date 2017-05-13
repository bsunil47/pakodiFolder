<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>UGC Category</h3></td>
               </tr>
            </table>
        </div>
        <div class="module-body table" >
            <form name="date" method="post" class="table-form">
                <!--span style="padding-left:10px;"> Uploaded Between Start Date  : </span><input type="text" name="fromdate" id="fromdate" value="<?php //if(!empty($_POST['fromdate'])){ echo $_POST['fromdate']; } ?>" readonly="readonly" >
                <span style="padding-left:20px;"> End Date  : </span><input type="text" name="todate" id="todate" value="<?php //if(!empty($_POST['todate'])){ echo $_POST['todate']; } ?>" readonly="readonly" >
                <input type="button" name="mugcsubmit" id="mugcsubmit" value="Go" class="pakodi" style="margin-bottom: 10px;padding: 4px;">
                <input type="button" id="mugcreset" value="Reset" class="pakodi" style="margin-bottom: 10px;padding: 4px;"-->
			<div id="column1" class="col1"><i class="iconred icon-filter"></i></div>
			<div id="column2" class="col2">
				<div class='input-group date' id='from_date'><input type='text' class="form-control" name="fromdate" id="fromdate" value="<?php if (!empty($_POST['fromdate'])) {echo $_POST['fromdate'];}else{$start=date('m')."/01/".date('Y'); echo $start;} ?>" /><span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span></div>
			</div>
			<div id="column3" class="col2">
				<div class='input-group date' id='to_date'><input type='text' class="form-control" name="todate" id="todate" value="<?php if (!empty($_POST['todate'])) {echo $_POST['todate'];}else{$end=date('m')."/".date('d')."/".date('Y');echo $end;} ?>" /><span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span></div>
			</div>
			<div id="column4" class="col2">
				<input type="button" name="mugcsubmit" id="mugcsubmit" value="Go" class="pakodi" style="margin-bottom: 10px;padding: 4px;">
                <input type="button" id="mugcreset" value="Reset" class="pakodi" style="margin-bottom: 10px;padding: 4px;">
			</div>
			<div style="clear: both;" ></div>
            </form>
            
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-28 table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">S.NO</th>
                        <th align="left">User Name</th>
                        <th align="left">Clip Title</th>
                        <th align="left">Thumb</th>
						<th align="left">Media file</th>
						<th align="left">Moderated By</th>
						<th align="left">Date</th>
						<th align="left">Status</th>
                        <th align="left">Action</th>
                    </tr>
                </thead>
                <tbody>
                 
                </tbody>
            </table>
        </div>
    </div>
</div>

