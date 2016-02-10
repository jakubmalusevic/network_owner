<?
include 'z_header.php';

if ($_REQUEST[mode] == 'removed') {
    $offer_name = mysql_result(mysql_query("SELECT `offer_name` FROM `offers` as t1 WHERE `id`=(SELECT offer_id FROM projects_offer WHERE id={$_REQUEST[offer_id]})"), 0);
    mysql_query("DELETE FROM `projects_offer` WHERE `id`={$_REQUEST[offer_id]}");
    mysql_query("UPDATE projects SET proj_offers=(SELECT COUNT(id) FROM projects_offer WHERE proj_id={$_REQUEST[cid]}) WHERE id={$_REQUEST[cid]}");
}

if ($_REQUEST[mode] == 'add_offer') {
    $offer_name = mysql_result(mysql_query("SELECT `offer_name` FROM `offers` WHERE `id`={$_REQUEST[new_offer_id]}"), 0);
    mysql_query("INSERT INTO `projects_offer` (proj_id, offer_id) VALUES ({$_REQUEST[cid]}, {$_REQUEST[new_offer_id]})");
    mysql_query("UPDATE projects SET proj_offers=(SELECT COUNT(id) FROM projects_offer WHERE proj_id={$_REQUEST[cid]}) WHERE id={$_REQUEST[cid]}");
}


if (($_REQUEST[cid] != '') && ($_REQUEST[tryout] == '')) {
    $sql = "SELECT * FROM `projects` WHERE `id`='{$_REQUEST[cid]}'";
    $q = mysql_query($sql);
    $row = mysql_fetch_assoc($q);

    //IS OWNER?
//    if ($row[user_id] != $_SESSION[user_id]) {
//        echo('<script language="JavaScript">window.location.href = "dashboard.php"</script>');
//        break;
//    }

    foreach ($row as $key => $value) {
        $_REQUEST[$key] = $value;
    }
}


if ($_REQUEST[tryout] == '1') {

    $errmsg = '';

    if ($_REQUEST[proj_name] == '') {
        $errmsg.='<li>Field "Campaign Name" should not be empty</li>';
    }

    if (!preg_match('~^[a-z0-9_\-]*$~i', $_REQUEST[proj_exe])) {
        $errmsg.='<li>Field "Installer EXE name" should contain only [A-Z], [a-z] and [0-9]</li>';
    }

    if ($_REQUEST[software_name] == '') {
        $errmsg.='<li>Field "Application Name" should not be empty</li>';
    }

    if ($_REQUEST[software_description] == '') {
        $errmsg.='<li>Field "Application Description" should not be empty</li>';
    }

    if ($_REQUEST[software_url] == '') {
        $errmsg.='<li>Field "Application URL" should not be empty</li>';
    }

    if ($_REQUEST[software_silent] == '') {
        $errmsg.='<li>Field "Application Silent Key" should not be empty</li>';
    }


    if ($errmsg != '') {
        $usermessage = '<b>Please correct the following errors:</b><br><ul>';
        $usermessage .= $errmsg;
        $usermessage .= '</ul>';
        $save_message = '0';
    } else {
        mysql_query("UPDATE `projects` SET
            `assigned_user_id`='{$_REQUEST[assigned_user_id]}',
            `proj_name`='{$_REQUEST[proj_name]}',
            `proj_description`='{$_REQUEST[proj_description]}',
            `software_name`='{$_REQUEST[software_name]}',
            `software_version`='{$_REQUEST[software_version]}',
            `software_description`='{$_REQUEST[software_description]}',
            `software_url`='{$_REQUEST[software_url]}',
            `software_silent`='{$_REQUEST[software_silent]}',
            `software_tos_url`='{$_REQUEST[software_tos_url]}',
            `software_pp_url`='{$_REQUEST[software_pp_url]}',
            `software_eula_url`='{$_REQUEST[software_eula_url]}'
            WHERE `id`='{$_REQUEST[cid]}'");

//        $z_sql = "UPDATE `projects` SET
//            `proj_name`='{$_REQUEST[proj_name]}',
//            `proj_description`='{$_REQUEST[proj_description]}',
//            `software_name`='{$_REQUEST[software_name]}',
//            `software_version`='{$_REQUEST[software_version]}',
//            `software_description`'{$_REQUEST[software_description]}',
//            `software_url`='{$_REQUEST[software_url]}',
//            `software_silent`='{$_REQUEST[software_silent]}',
//            `software_tos_url`='{$_REQUEST[software_tos_url]}',
//            `software_pp_url`='{$_REQUEST[software_pp_url]}',
//            `software_eula_url`='{$_REQUEST[software_eula_url]}'
//            WHERE `id`='{$_REQUEST[cid]}'";


        $proj_id = $_REQUEST[cid];
        if (is_uploaded_file($_FILES["proj_logo"]["tmp_name"])) {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/installer_logos/' . $proj_id . '.jpg');
            move_uploaded_file($_FILES["proj_logo"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/installer_logos/" . $proj_id . '_tmp.jpg');
            custom_crop($_SERVER['DOCUMENT_ROOT'] . '/installer_logos/' . $proj_id . '_tmp.jpg', $_SERVER['DOCUMENT_ROOT'] . '/installer_logos/' . $proj_id . '.jpg', 210, 400);
            unlink($_SERVER['DOCUMENT_ROOT'] . '/installer_logos/' . $proj_id . '_tmp.jpg');
            mysql_query("UPDATE `projects` SET `proj_logo`=1 WHERE `id`={$proj_id}");
        }


        $sql = "SELECT * FROM `projects` WHERE `id`='{$_REQUEST[cid]}'";
        $q = mysql_query($sql);
        $row = mysql_fetch_assoc($q);

        foreach ($row as $key => $value) {
            $_REQUEST[$key] = $value;
        }

        $save_message = '1';
    }
}
?>



















<div id="body">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

    <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN STYLE CUSTOMIZER-->
                <!-- END STYLE CUSTOMIZER-->
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    Edit Campaign
                    <small>manage your own installation package</small>
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="camp_list.php">Campaigns List</a> <span class="divider">/</span>
                    </li>
                    <li><a href="#">Edit Campaign</a></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div id="page">
            <? if ($_REQUEST[new_camp] == '1') { ?>
                <div class="alert alert-success">
                    <button class="close" data-dismiss="alert">×</button>
                    <b>Congratulation!</b><br><br>
                    Your campaign "<?= $_REQUEST[proj_name] ?>" has been added successfully! Now you could do the following:
                    <ul>
                        <li>Add offers to install an additional software. Use <b>Application Offers</b> tab.</li>
                        <li>Add a <a href="camp_add.php">new campaign</a></li>
                        <li>Look at the <a href="camp_list.php">list of all your campaigns</a></li>
                    </ul>
                </div>
            <? } ?>

            <? if ($_REQUEST[new_offer] == '1') { ?>
                <div class="alert alert-success">
                    <button class="close" data-dismiss="alert">×</button>
                    <b>Congratulation!</b><br><br>
                    Your application offers list has been changed successfully!
                </div>
            <? } ?>

            <? if ($save_message == '1') { ?>
                <div class="alert alert-success">
                    <button class="close" data-dismiss="alert">×</button>
                    <b>Congratulation!</b><br><br>
                    Your campaign "<?= $_REQUEST[proj_name] ?>" has been changed successfully! Now you could do the following:
                    <ul>
                        <li>Add a <a href="camp_add.php">new campaign</a></li>
                        <li>Look at the <a href="camp_list.php">list of all your campaigns</a></li>
                    </ul>
                </div>
            <? } ?>

            <? if ($usermessage != '') { ?>
                <div class="alert alert-error">
                    <button class="close" data-dismiss="alert">×</button>
                    <?= $usermessage ?>
                </div>
            <? } ?>

            <?
            if ($_REQUEST[mode] == 'removed') {
                ?>
                <div class="alert alert-success">
                    <button class="close" data-dismiss="alert">×</button>
                    Offer <b>"<?= $offer_name ?>"</b> has been removed successfully from the installation package!
                </div>
            <? } ?>

            <?
            if ($_REQUEST[mode] == 'add_offer') {
                ?>
                <div class="alert alert-success">
                    <button class="close" data-dismiss="alert">×</button>
                    Offer <b>"<?= $offer_name ?>"</b> has been added successfully to the installation package!
                </div>
            <? } ?>

            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i>  Edit Campaign Settings</h4>
                        </div>
                        <div class="widget-body form">
                            <div class="tabbable portlet-tabs">
                                <ul class="nav nav-tabs">
                                    <li <? if ($_REQUEST[tab] == '2') { ?>class="active"<? } ?>><a href="#portlet_tab2" data-toggle="tab" onclick="$('#buttons_general').hide();
                                            $('#buttons_offers').show();">Application Offers (<?= $row[proj_offers] ?>)</a></li>
                                    <li <? if ($_REQUEST[tab] != '2') { ?>class="active"<? } ?>><a href="#portlet_tab1" data-toggle="tab" onclick="$('#buttons_general').show();
                                            $('#buttons_offers').hide();">General Campaign Settings</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane <? if ($_REQUEST[tab] != '2') { ?>active<? } ?>" id="portlet_tab1">
                                        <form action="camp_edit.php" class="form-horizontal" method="POST" id="edit_form" enctype="multipart/form-data">
                                            <input type="hidden" name="tryout" value="1"/>
                                            <input type="hidden" name="id" value="<?= $_REQUEST[cid] ?>"/>

                                            <div class="control-group">
                                                <label class="control-label" for="input3"><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Campaign Name</label>
                                                <div class="controls">
                                                    <input type="text" id="proj_name" name="proj_name" value="<?= $_REQUEST[proj_name] ?>" class="span6 popovers" data-trigger="hover" data-content="Name of your campaign. This name will be shown only to you." data-original-title="Campaign Name" />
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="input3"><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Campaign Assigned To</label>
                                                <div class="controls">
                                                    <select class="span6 chosen" name='assigned_user_id'>
                                                        <option value="-1" <? if ($_REQUEST[assigned_user_id] == '-1') echo 'SELECTED'; ?>>Not yet assigned</option>
                                                        <?
                                                        $sql1 = "SELECT id, user_name, user_first_name, user_last_name FROM `users` WHERE `user_status`=3 ORDER BY `id` DESC";
                                                        $q1 = mysql_query($sql1);
                                                        while ($row1 = mysql_fetch_assoc($q1)) {
                                                            ?>
                                                            <option value="<?= $row1[id] ?>" <? if ($_REQUEST[assigned_user_id] == $row1[id]) echo 'SELECTED'; ?>><?= $row1[user_first_name] . ' ' . $row1[user_last_name] . ' (' . $row1[user_name] . ')' ?></option>
                                                        <? } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="inputRemarks">Campaign Description</label>
                                                <div class="controls">
                                                    <textarea class="span6 popovers" rows="3" id="proj_description" name="proj_description" style="resize: none;" data-trigger="hover" data-content="Description of your campaign. This description will be shown only to you. It is not a mandatory field." data-original-title="Campaign Description"><?= $_REQUEST[proj_description] ?></textarea>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="input3">Installer EXE name</label>
                                                <div class="controls">
                                                    <div class="input-append">
                                                        <input disabled type="text" value="<?= str_ireplace('.exe', '', $_REQUEST[proj_exe]) ?>" class="input-large popovers disabled"><span class="add-on">.exe</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label">Installer Logo</label>
                                                <div class="controls">
                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail" style="width: 250px; height: 250px;"><img src="installer_logos/<?= $_REQUEST[cid] ?>.jpg?r=<?= time(); ?>" alt=""/></div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 250px; max-height: 250px; line-height: 20px;"></div>
                                                        <div>
                                                            <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" class="default" name="proj_logo"/></span>
                                                            <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                        </div>
                                                    </div>
                                                    <span class="label label-important">NOTE!</span>
                                                    <span class="help-inline">You may upload any image, but it will auto-resize to 210x400.</span>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="control-group">
                                                <label class="control-label" for="input3"><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Application Name</label>
                                                <div class="controls">
                                                    <input type="text" id="software_name" name="software_name" value="<?= $_REQUEST[software_name] ?>" class="span6 popovers" data-trigger="hover" data-content='The name of the main application, which will be installed. This name will be shown in your installer. Eg: "Firefox"' data-original-title="Main Software Name" />
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="input3">Application Version</label>
                                                <div class="controls">
                                                    <input type="text" id="software_version" name="software_version" value="<?= $_REQUEST[software_version] ?>" class="span6 popovers" data-trigger="hover" data-content='The version of the main application, which will be installed. This will be shown in your installer. It is not a mandatory field. Eg: "18.0.1"' data-original-title="Main Software Version" />
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" ><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Application Description</label>
                                                <div class="controls">
                                                    <textarea class="span6 editor popovers" rows="6" style="width: 700px;" id="software_description" name="software_description" data-trigger="hover" data-content='The description of the main application, which will be installed. This will be shown in your installer.'><?= $_REQUEST[software_description] ?></textarea>
                                                </div>
                                            </div>



                                            <div class="control-group">
                                                <label class="control-label" for="input3"><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Application URL</label>
                                                <div class="controls">
                                                    <input type="text" id="software_url" name="software_url" value="<?= $_REQUEST[software_url] ?>" class="span6 popovers" data-trigger="hover" data-content='The direct URL of the main application, which will be installed. Eg: "http://www.mozilla.org/en-US/products/download.html?product=firefox-18.0.1&os=win&lang=en-US"' data-original-title="Main Software URL" />
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="input3"><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Command Line Parameters</label>
                                                <div class="controls">
                                                    <input type="text" id="software_silent" name="software_silent" value="<?= $_REQUEST[software_silent] ?>" class="span6 popovers" data-trigger="hover" data-content='The key to the silent installation of the main application, which will be installed. Eg: "/S" or "-s"' data-original-title="Command Line Parameters" />
                                                </div>
                                            </div>
                                            <hr>

                                            <div class="control-group">
                                                <label class="control-label" for="input3">"Terms Of Service" URL</label>
                                                <div class="controls">
                                                    <input type="text" id="software_tos_url" name="software_tos_url" value="<?= $_REQUEST[software_tos_url] ?>" class="span6 popovers" data-trigger="hover" data-content='The direct link to the "Terms Of Service" page. It is not a mandatory field. Eg: https://services.mozilla.com/tos/' data-original-title='"Terms Of Service" URL' />
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="input3">"Privacy Policy" URL</label>
                                                <div class="controls">
                                                    <input type="text" id="software_pp_url" name="software_pp_url" value="<?= $_REQUEST[software_pp_url] ?>" class="span6 popovers" data-trigger="hover" data-content='The direct link to the "Privacy Policy" page. It is not a mandatory field. Eg: https://www.mozilla.org/en-US/privacy/' data-original-title='"Privacy Policy" URL' />
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="input3">"EULA" URL</label>
                                                <div class="controls">
                                                    <input type="text" id="software_eula_url" name="software_eula_url" value="<?= $_REQUEST[software_eula_url] ?>" class="span6 popovers" data-trigger="hover" data-content='The direct link to the "End User License Agreement (EULA)" page. It is not a mandatory field. Eg: http://www.mozilla.org/en-US/legal/eula/' data-original-title='"EULA" URL' />
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane <? if ($_REQUEST[tab] == '2') { ?>active<? } ?>" id="portlet_tab2">

                                        <table class="table table-striped table-bordered" id="sample_1">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Created Date/Time</th>
                                                    <th>Application Name</th>
                                                    <th>PPI</th>
                                                    <th>Installs Total</th>
                                                    <th>Install Success</th>
                                                    <th>Application Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?
                                                $sql = "SELECT `projects_offer`.id as off_id, `projects_offer`.`proj_id`, `projects_offer`.`installs_total` as installs_total_local, `projects_offer`.`installs_success` as installs_success_local, `offers`.* FROM `projects_offer`, `offers` WHERE `projects_offer`.`proj_id`={$_REQUEST[cid]} AND projects_offer.offer_id=offers.id ORDER BY `id` DESC";
                                                $q = mysql_query($sql);
                                                while ($row = mysql_fetch_assoc($q)) {
                                                    ?>
                                                    <tr class="odd gradeX">
                                                        <td><?= $row[id] ?></td>
                                                        <td><?= date_format(date_create($row[offer_datetime]), SHORTDATETIME) ?></td>
                                                        <td><?= $row[offer_name] ?></td>
                                                        <td><?= $row[offer_price] ?></td>
                                                        <td><?= $row[installs_total_local] ?></td>
                                                        <td><?= $row[installs_success_local] ?></td>
                                                        <td>
                                                            <? if ($row[offer_show] == '1') { ?>
                                                                <span class="label label-success">Visible</span>
                                                            <? } else { ?>
                                                                <span class="label label-default">Hidden</span>
                                                            <? } ?>
                                                        </td>
                                                        <td class="center">


                                                            <a href="offer_edit.php?id=<?= $row[id] ?>" class="icon huge tooltips" data-placement="bottom" data-original-title="Edit Offer"><i class="icon-pencil"></i></a>&nbsp;
                                                            <a href="camp_edit.php?mode=removed&offer_id=<?= $row[off_id] ?>&id=<?= $row[proj_id] ?>&tab=2" onclick="return confirm('Are you sure to remove <?= $row[offer_name] ?>?')" class="icon huge tooltips" data-placement="bottom" data-original-title="Remove Offer"><i class="icon-remove"></i></a>&nbsp;
                                                        </td>
                                                    </tr>
                                                <? } ?>
                                            </tbody>
                                        </table>
                                        <br>

                                    </div>
                                </div>
                            </div>

                            <!-- BEGIN FORM-->



                            <!-- END FORM-->
                            <br>
                            <div class="form-actions" id="buttons_general" <? if ($_REQUEST[tab] == '2') { ?> style="display: none;"<? } ?>>
                                <a href="#" class="btn btn-success" onclick="$('#edit_form').submit();
                                            return false;"><i class="icon-check"></i> Save Campaign</a>
                                <a href="camp_list.php" class="btn">Cancel</a>
                            </div>
                            <div class="form-actions" id="buttons_offers"  style="<? if ($_REQUEST[tab] != '2') { ?> display: none; <? } ?> padding-left: 15px;">
                                <a style="float: left;" a href="#myModal1" class="btn btn-success" data-toggle="modal"><i class="icon-plus-sign"></i> Add New Offer</a>
                            </div>
                        </div>



                        <div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 id="myModalLabel1">Add A New Offer</h4>
                            </div>
                            <form action="camp_edit.php" class="form-horizontal" method="POST" id="add_form">
                                <div class="modal-body">

                                    <input type="hidden" name="id" value="<?= $_REQUEST[cid] ?>"/>
                                    <input type="hidden" name="tab" value="2"/>
                                    <input type="hidden" name="mode" value="add_offer"/>
                                    <select size="5" name="new_offer_id" data-placeholder="Select an offer to add" class="chosen-with-diselect" tabindex="-1" id="selCSI" style="width: 500px; z-index: 1000; overflow: auto;">
                                        <option value=""></option>
                                        <?
                                        $sql1 = "SELECT id, offer_name FROM `offers` WHERE `id` NOT IN (SELECT offer_id FROM projects_offer WHERE proj_id={$_REQUEST[cid]})";
                                        $q1 = mysql_query($sql1);
                                        while ($row1 = mysql_fetch_assoc($q1)) {
                                            ?>
                                            <option value="<?= $row1[id] ?>"><?= $row1[offer_name] ?></option>
                                        <? } ?>
                                    </select>
                                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                    <button class="btn btn-success" onclick="$('#add_form').submit();">Save</button>
                                </div>
                            </form>
                        </div>


                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                </div>

            </div>
        </div>

















    </div>
    <!-- END PAGE CONTENT-->
</div>
<!-- END PAGE CONTAINER-->
</div>

<? include 'z_footer.php'; ?>