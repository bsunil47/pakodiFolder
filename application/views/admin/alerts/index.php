<div class="content">
    <div class="module">
        <div class="module-head">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr >
                    <td align="left"><h3>Alerts List</h3></td>
                    <td align="right"></td>
                    <td align="right" class="table-form">Device Type:

                        <select name="device_type"  id="dtype">
                            <option value="" >-Select-</option>
                            <option value="3" >IOS</option>
                            <option value="1" >Andriod</option>
                            <option value="2" >Both</option>
                        </select> &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php  base_url(); ?>alerts/add" ><button class='btn pakodi' title='Add' style="border:1px solid #cccccc;" >Add Alert</button></a>

                    </td>
                </tr>
            </table>
        </div>
        <div class="module-body table">
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-26 table table-bordered table-striped display" width="100%">
                <thead>
                    <tr>
                        <th align="left">S.NO</th>
                        <th align="left">Device Type</th>
                        <th align="left">Message</th>
                        <th align="left">Thumbnail</th>
                        <th align="left">Content Clip</th>
                        <!--                        <th align="left">Users Recevied</th>-->
                        <th align="left">User Sent</th>
                        <th align="left">Push Time</th>
                        <th align="left">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
