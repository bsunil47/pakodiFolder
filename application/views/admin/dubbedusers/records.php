<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>Audio Records</h3></td>
               </tr>
            </table>
        </div>
        <div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0" width="100%" >

                <tr style="background-color: #f6f6f6">
                    <form name="date" method="post" class="table-form">
                        <td align="left" style="width: 9.5%"><div id="column1" class="col1"><i class="iconred icon-filter"></i></div></td>
                        <td align="left" style="width:30%"><div class='input-group date' id='from_date' ><input type='text' class="form-control" name="rec_fromdate" id="rec_fromdate" value="<?php if (!empty($_POST['rec_fromdate'])) { echo $_POST['rec_fromdate']; }else{$start=date('m')."/01/".date('Y'); echo $start;} ?>" /><span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span></div></td>
                        <td style="width: 10.5%"></td>
                        <td align="right" style="width:30%"><div class='input-group date' id='to_date' ><input type='text' class="form-control" name="rec_todate" id="rec_todate" value="<?php if (!empty($_POST['rec_todate'])) { echo $_POST['rec_todate']; }else{$end=date('m')."/".date('d')."/".date('Y');echo $end;} ?>" /><span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span></div>
                        </td>

                        <td style="text-align: center">
                            <input type="button" name="recsubmit" id="recsubmit" value="Go" class="btn pakodi">
                            <input type="button" id="recreset" value="Reset" class="btn pakodi">
                        </td>
                    </form>
                </tr>
                <tr><td></td><td></td><td></td><td></td><td></td></tr>
            </table>

            <table cellpadding="0" cellspacing="0" border="0" class="datatable-17 table table-bordered table-striped display" width="100%">
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

