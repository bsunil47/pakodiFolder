<div class="content">
    <div class="module">
        <div class="module-head">
            <?php
				$successmsg=$this->session->flashdata('result');
				if (!empty($successmsg)) { 
				echo $successmsg; 
				}
				?>

            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align="left"><h3>Random Users</h3></td>
                    <td align="right"><a href="<?php base_url(); ?>randomusers/add" ><button class='btn' title='Edit' style="border:1px solid #cccccc;">Add Random Users</button></a></td>
                </tr>
            </table>
        </div>
        <div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-13 table table-bordered table-striped display" width="100%">
                <thead>
                <tr>
                    <th align="left">S.NO.</th>
                    <th align="left">Name</th>
                    <th align="left">Language</th>
                    <th align="left">Email</th>
                    <th align="left">Mobile</th>
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
