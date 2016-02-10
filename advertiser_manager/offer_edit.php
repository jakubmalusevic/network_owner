<?
include 'z_header.php';
 
if (($_REQUEST[id] != '') && ($_REQUEST[tryout] == '')) {
    $sql = "SELECT * FROM `offers` WHERE `id`='{$_REQUEST[id]}'";
    $q = mysql_query($sql);
    $row = mysql_fetch_assoc($q);

    foreach ($row as $key => $value) {
        $_REQUEST[$key] = $value;
    }
}


if ($_REQUEST[tryout] == '1') {

    $errmsg = '';

    if ($_REQUEST[offer_name] == '') {
        $errmsg.='<li>Field "Application Name" should not be empty</li>';
    }

    if ($_REQUEST[offer_description] == '') {
        $errmsg.='<li>Field "Application Description" should not be empty</li>';
    }

    if ($_REQUEST[offer_url] == '') {
        $errmsg.='<li>Field "Application URL" should not be empty</li>';
    }

    if ($_REQUEST[offer_silent] == '') {
        $errmsg.='<li>Field "Application Silent Key" should not be empty</li>';
    }

    if ($_REQUEST[offer_price] == '') {
        $errmsg.='<li>Field "Price Per Install" should not be empty</li>';
    }
//    if ($_REQUEST[registry_key] == '') {
//        $errmsg.='<li>Field "Registry Key" should not be empty</li>';
//    }
//
//    if ($_REQUEST[registry_value] == '') {
//        $errmsg.='<li>Field "Registry Value" should not be empty</li>';
//    }


    if ($errmsg != '') {
        $usermessage = '<b>Please correct the following errors:</b><br><ul>';
        $usermessage .= $errmsg;
        $usermessage .= '</ul>';
    } else {
        if ($_REQUEST[offer_show] == '')
            $_REQUEST[offer_show] = '0';
        $sql = "UPDATE `offers` SET
            `offer_name`='{$_REQUEST[offer_name]}',
            `offer_description`='{$_REQUEST[offer_description]}',
            `offer_url`='{$_REQUEST[offer_url]}',
            `offer_silent`='{$_REQUEST[offer_silent]}',
            `offer_tos_url`='{$_REQUEST[offer_tos_url]}',
            `offer_pp_url`='{$_REQUEST[offer_pp_url]}',
            `offer_eula_url`='{$_REQUEST[offer_eula_url]}',
            `offer_show`='{$_REQUEST[offer_show]}',
            `offer_price`='{$_REQUEST[offer_price]}',
            `registry_path`='{$_REQUEST[registry_path]}',
            `registry_key`='{$_REQUEST[registry_key]}',
            `registry_value`='{$_REQUEST[registry_value]}'
            WHERE `id`='{$_REQUEST[id]}'
            ";
        mysql_query($sql);

        FB::log($sql);
        echo('<script language="JavaScript">window.location.href = "offer_list.php"</script>');
        break;
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
                    Edit Offer
                    <small>edit application offer</small>
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="offer_list.php">Offers List</a> <span class="divider">/</span>
                    </li>
                    <li><a href="#">Edit Offer</a></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div id="page">

            <? if ($usermessage != '') { ?>
                <div class="alert alert-error">
                    <button class="close" data-dismiss="alert">×</button>
                    <?= $usermessage ?>
                </div>
            <? } ?>

            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i>  Edit Application Offer</h4>
                        </div>
                        <div class="widget-body form">
                            <!-- BEGIN FORM-->
                            <form action="offer_edit.php" class="form-horizontal" method="POST" id="add_form" enctype="multipart/form-data">
                                <input type="hidden" name="tryout" value="1"/>                                
                                <input type="hidden" name="proj_id" value="<?= $_REQUEST[proj_id] ?>"/>
                                <input type="hidden" name="id" value="<?= $_REQUEST[id] ?>"/>

                                <div class="control-group">
                                    <label class="control-label" for="input3"><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Application Name</label>
                                    <div class="controls">
                                        <input type="text" id="software_name" name="offer_name" value="<?= $_REQUEST[offer_name] ?>" class="span6 popovers" data-trigger="hover" data-content='The name of the offer application, which will be installed. This name will be shown in your installer. Eg: "Firefox"' data-original-title="Main Software Name" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" ><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Application Description</label>
                                    <div class="controls">
                                        <textarea class="span6 editor popovers" rows="6" style="width: 700px;" id="offer_description" name="offer_description" data-trigger="hover" data-content='The description of the offer application, which will be installed. This will be shown in your installer.'><?= $_REQUEST[offer_description] ?></textarea>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="input3"><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Application URL</label>
                                    <div class="controls">
                                        <input type="text" id="offer_url" name="offer_url" value="<?= $_REQUEST[offer_url] ?>" class="span6 popovers" data-trigger="hover" data-content='The direct URL of the offer application download. Eg: "http://www.mozilla.org/en-US/products/download.html?product=firefox-18.0.1&os=win&lang=en-US"' data-original-title="Main Software URL" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="input3"><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Application Silent Key</label>
                                    <div class="controls">
                                        <input type="text" id="offer_silent" name="offer_silent" value="<?= $_REQUEST[offer_silent] ?>" class="span6 popovers" data-trigger="hover" data-content='The key to the silent installation of the main application, which will be installed. Eg: "/S" or "-s"' data-original-title="Main Software Silent Key" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="input3">Registry Path</label>
                                    <div class="controls">
                                        <input type="text" id="registry_path" name="registry_path" value="<?= $_REQUEST[registry_path] ?>" class="span6 popovers" data-trigger="hover" data-content='The registry path need to be checked to determine the successful installation. Eg: HKEY_CURRENT_USER\Software\Microsoft\MyCoolApp' data-original-title='Registry Path' />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" >Application Visible</label>
                                    <div class="controls">
                                        <label class="checkbox">
                                            <input type="checkbox" name="offer_show" id="offer_show" value="1" <? if (($_REQUEST[offer_show] == '1') || ($_REQUEST[offer_show] == '')) { ?> CHECKED <? } ?>/>
                                        </label>
                                    </div>
                                </div>
                                <hr>


                                <div class="control-group">
                                    <label class="control-label" for="input3">"Terms Of Service" URL</label>
                                    <div class="controls">
                                        <input type="text" id="offer_tos_url" name="offer_tos_url" value="<?= $_REQUEST[offer_tos_url] ?>" class="span6 popovers" data-trigger="hover" data-content='The direct link to the "Terms Of Service" page. It is not a mandatory field. Eg: https://services.mozilla.com/tos/' data-original-title='"Terms Of Service" URL' />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="input3">"Privacy Policy" URL</label>
                                    <div class="controls">
                                        <input type="text" id="offer_pp_url" name="offer_pp_url" value="<?= $_REQUEST[offer_pp_url] ?>" class="span6 popovers" data-trigger="hover" data-content='The direct link to the "Privacy Policy" page. It is not a mandatory field. Eg: https://www.mozilla.org/en-US/privacy/' data-original-title='"Privacy Policy" URL' />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="input3">"EULA" URL</label>
                                    <div class="controls">
                                        <input type="text" id="offer_eula_url" name="offer_eula_url" value="<?= $_REQUEST[offer_eula_url] ?>" class="span6 popovers" data-trigger="hover" data-content='The direct link to the "End User License Agreement (EULA)" page. It is not a mandatory field. Eg: http://www.mozilla.org/en-US/legal/eula/' data-original-title='"EULA" URL' />
                                    </div>
                                </div>

                                <hr>

                                <div class="control-group">
                                    <label class="control-label" for="input8">Price Per Install</label>
                                    <div class="controls">
                                        <div class="input-prepend input-append">
                                            <span class="add-on">$</span><input class="input-small" id="input8" type="text" id="offer_price" name="offer_price" value="<?= $_REQUEST[offer_price] ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <!--                                <div class="control-group">
                                                                    <label class="control-label" for="input3"><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Registry Key/Value</label>
                                                                    <div class="controls">
                                                                        <input type="text" id="registry_key" name="registry_key" value="<?= $_REQUEST[registry_key] ?>" class="span3 popovers" data-trigger="hover" data-content='The registry key need to be checked to determine the successful installation.' data-original-title='Registry Key' />
                                                                        &nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;
                                                                        <input type="text" id="registry_value" name="registry_value" value="<?= $_REQUEST[registry_value] ?>" class="span3 popovers" data-trigger="hover" data-content='The registry value for a key need to be checked to determine the successful installation.' data-original-title='Registry Value' />
                                                                    </div>
                                                                </div>-->

                                <div class="form-actions">
                                    <a href="#" class="btn btn-success" onclick="$('#add_form').submit();
                                            return false;"><i class="icon-check"></i> Save Offer</a>
                                    <a href="offer_list.php" class="btn">Cancel</a>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                </div>
            </div>

















        </div>
        <!-- END PAGE CONTENT-->
    </div>
    <!-- END PAGE CONTAINER-->
</div>

<? include 'z_footer.php'; ?>