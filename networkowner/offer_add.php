<?
include 'z_header.php';


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
            
        $str_offerdesc = $_REQUEST[offer_description];
        $str_offerdesc = str_replace("<a href","<a target=\"_blank\" href", $str_offerdesc);    
              
        $sql =  "INSERT INTO `offers`(
            `user_id`,
            `assigned_user_id`, 
            `offer_datetime`,
            `offer_name`,
            `offer_description`,
            `offer_url`,            
            `offer_silent_main`,
            `offer_silent_check1_on`,
            `offer_silent_check1_off`,
            `offer_silent_check2_on`,
            `offer_silent_check2_off`,
            `offer_silent_check3_on`,
            `offer_silent_check3_off`,
            `offer_silent_check4_on`,
            `offer_silent_check4_off`,
            `offer_silent_check5_on`,
            `offer_silent_check5_off`,            
            `offer_tos_url`,
            `offer_pp_url`,
            `offer_eula_url`,
            `offer_show`,
            `offer_price`,
            `checkinstalled_method`,            
            `reg_path_pre`,
            `reg_path_64_pre`,
            `reg_path_post`,
            `reg_path_64_post`
            ) VALUES (
            '{$_SESSION[user_id]}',
            '{$_REQUEST[assigned_user_id]}',
                NOW(),
            '{$_REQUEST[offer_name]}',
            '{$str_offerdesc}',
            '{$_REQUEST[offer_url]}',
            '{$_REQUEST[offer_silent_main]}',
            '{$_REQUEST[offer_silent_check1_on]}',
            '{$_REQUEST[offer_silent_check1_off]}',
            '{$_REQUEST[offer_silent_check2_on]}',
            '{$_REQUEST[offer_silent_check2_off]}',
            '{$_REQUEST[offer_silent_check3_on]}',
            '{$_REQUEST[offer_silent_check3_off]}',
            '{$_REQUEST[offer_silent_check4_on]}',
            '{$_REQUEST[offer_silent_check4_off]}',
            '{$_REQUEST[offer_silent_check5_on]}',
            '{$_REQUEST[offer_silent_check5_off]}',
            '{$_REQUEST[offer_tos_url]}',
            '{$_REQUEST[offer_pp_url]}',
            '{$_REQUEST[offer_eula_url]}',
            '{$_REQUEST[offer_show]}',
            '{$_REQUEST[offer_price]}',
            '{$_REQUEST[checkinstalled_method]}',            
            '{$_REQUEST[reg_path_pre]}',
            '{$_REQUEST[reg_path_64_pre]}',
            '{$_REQUEST[reg_path_post]}',
            '{$_REQUEST[reg_path_64_post]}'
            )";   
            
        //var_dump($sql);exit;
        mysql_query($sql);

        $offer_id = mysql_insert_id();

        echo('<script language="JavaScript">window.location.href = "offer_list.php"</script>');
        break;
    }
}
?>

<script type="text/javascript">

function FixRegPath()
{
    var str = $('#reg_path_pre').val(); 
    str = str.replace(/\\\\/g,'\\');  
    str = str.replace(/\\/g,'\\\\');  
    $('#reg_path_pre').val(str); 
    
    str = $('#reg_path_64_pre').val(); 
    str = str.replace(/\\\\/g,'\\');  
    str = str.replace(/\\/g,'\\\\');  
    $('#reg_path_64_pre').val(str);  
    
    str = $('#reg_path_post').val(); 
    str = str.replace(/\\\\/g,'\\');  
    str = str.replace(/\\/g,'\\\\');  
    $('#reg_path_post').val(str); 
    
    str = $('#reg_path_64_post').val(); 
    str = str.replace(/\\\\/g,'\\');  
    str = str.replace(/\\/g,'\\\\');  
    $('#reg_path_64_post').val(str); 
}
</script>
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
                    Add New Offer
                    <small>add new application offer</small>
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="offer_list.php">Offers List</a> <span class="divider">/</span>
                    </li>
                    <li><a href="#">Add New Offer</a></li>
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
                            <h4><i class="icon-reorder"></i>  Add New Offer</h4>
                        </div>
                        <div class="widget-body form">
                            <!-- BEGIN FORM-->
                            <form action="offer_add.php" class="form-horizontal" method="POST" id="add_form" enctype="multipart/form-data">
                                <input type="hidden" name="tryout" value="1"/>
  
                                <div class="control-group">
                                    <label class="control-label" for="input3"><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Offer Name</label>
                                    <div class="controls">
                                        <input type="text" id="software_name" name="offer_name" value="<?= $_REQUEST[offer_name] ?>" class="span6 popovers" data-trigger="hover" data-content='The name of the offer application, which will be installed. This name will be shown in your installer. Eg: "Firefox"' data-original-title="Main Software Name" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label" for="input3"><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Offer Assigned To</label>
                                    <div class="controls">
                                        <select class="span6 chosen" name='assigned_user_id'>
                                            <option value="-1" <? if ($_REQUEST[assigned_user_id] == '-1') echo 'SELECTED'; ?>>Not yet assigned</option>
                                            <?
                                            $sql1 = "SELECT id, user_name, user_first_name, user_last_name FROM `users` WHERE `user_status`=2 ORDER BY `id` DESC";
                                            $q1 = mysql_query($sql1);
                                            while ($row1 = mysql_fetch_assoc($q1)) {
                                                ?>
                                                <option value="<?= $row1[id] ?>" <? if ($_REQUEST[assigned_user_id] == $row1[id]) echo 'SELECTED'; ?>><?= $row1[user_first_name] . ' ' . $row1[user_last_name] . ' (' . $row1[user_name] . ')' ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" ><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Offer Description</label>
                                    <div class="controls">
                                        <textarea class="span6 editor popovers" rows="6" style="width: 700px;" id="offer_description" name="offer_description" data-trigger="hover" data-content='The description of the offer application, which will be installed. This will be shown in your installer.'><?= $_REQUEST[offer_description] ?></textarea>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="input3"><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Offer URL</label>
                                    <div class="controls">
                                        <input type="text" id="offer_url" name="offer_url" value="<?= $_REQUEST[offer_url]?>" class="span6 popovers" data-trigger="hover" data-content='The direct URL of the offer application download. Eg: "http://www.mozilla.org/en-US/products/download.html?product=firefox-18.0.1&os=win&lang=en-US"' data-original-title="Main Software URL" />
                                    </div>
                                </div>
                                
                                <hr>

                                 <div class="control-group">
                                    <label class="control-label" for="input3"><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Main Command Line</label>
                                    <div class="controls">
                                        <input type="text" id="offer_silent_main" name="offer_silent_main" value="<?= $_REQUEST[offer_silent_main]?>" class="span6 popovers" data-trigger="hover" data-content='The key to the silent installation of the main application, which will be installed. Eg: "/S" or "-s"' data-original-title="Main Software Silent Key" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label" for="input3"> CheckBox 1</label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="input3">On</label>
                                    <div class="controls">
                                        <input type="text" id="offer_silent_check1_on" name="offer_silent_check1_on" value="<?= $_REQUEST[offer_silent_check1_on]?>" class="span6 popovers" data-trigger="hover" data-content='The key to the silent installation of the main application, which will be installed. Eg: "/S" or "-s"' data-original-title="Main Software Silent Key" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="input3">Off</label>
                                    <div class="controls">
                                        <input type="text" id="offer_silent_check1_off" name="offer_silent_check1_off" value="<?= $_REQUEST[offer_silent_check1_off]?>" class="span6 popovers" data-trigger="hover" data-content='The key to the silent installation of the main application, which will be installed. Eg: "/S" or "-s"' data-original-title="Main Software Silent Key" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label" for="input3"> CheckBox 2</label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="input3">On</label>
                                    <div class="controls">
                                        <input type="text" id="offer_silent_check2_on" name="offer_silent_check2_on" value="<?= $_REQUEST[offer_silent_check2_on]?>" class="span6 popovers" data-trigger="hover" data-content='The key to the silent installation of the main application, which will be installed. Eg: "/S" or "-s"' data-original-title="Main Software Silent Key" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="input3">Off</label>
                                    <div class="controls">
                                        <input type="text" id="offer_silent_check2_off" name="offer_silent_check2_off" value="<?= $_REQUEST[offer_silent_check2_off]?>" class="span6 popovers" data-trigger="hover" data-content='The key to the silent installation of the main application, which will be installed. Eg: "/S" or "-s"' data-original-title="Main Software Silent Key" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label" for="input3"> CheckBox 3</label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="input3">On</label>
                                    <div class="controls">
                                        <input type="text" id="offer_silent_check3_on" name="offer_silent_check3_on" value="<?= $_REQUEST[offer_silent_check3_on]?>" class="span6 popovers" data-trigger="hover" data-content='The key to the silent installation of the main application, which will be installed. Eg: "/S" or "-s"' data-original-title="Main Software Silent Key" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="input3">Off</label>
                                    <div class="controls">
                                        <input type="text" id="offer_silent_check3_off" name="offer_silent_check3_off" value="<?= $_REQUEST[offer_silent_check3_off]?>" class="span6 popovers" data-trigger="hover" data-content='The key to the silent installation of the main application, which will be installed. Eg: "/S" or "-s"' data-original-title="Main Software Silent Key" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label" for="input3"> CheckBox 4</label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="input3">On</label>
                                    <div class="controls">
                                        <input type="text" id="offer_silent_check4_on" name="offer_silent_check4_on" value="<?= $_REQUEST[offer_silent_check4_on]?>" class="span6 popovers" data-trigger="hover" data-content='The key to the silent installation of the main application, which will be installed. Eg: "/S" or "-s"' data-original-title="Main Software Silent Key" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="input3">Off</label>
                                    <div class="controls">
                                        <input type="text" id="offer_silent_check4_off" name="offer_silent_check4_off" value="<?= $_REQUEST[offer_silent_check4_off]?>" class="span6 popovers" data-trigger="hover" data-content='The key to the silent installation of the main application, which will be installed. Eg: "/S" or "-s"' data-original-title="Main Software Silent Key" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label" for="input3"> CheckBox 5</label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="input3">On</label>
                                    <div class="controls">
                                        <input type="text" id="offer_silent_check5_on" name="offer_silent_check5_on" value="<?= $_REQUEST[offer_silent_check5_on]?>" class="span6 popovers" data-trigger="hover" data-content='The key to the silent installation of the main application, which will be installed. Eg: "/S" or "-s"' data-original-title="Main Software Silent Key" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="input3">Off</label>
                                    <div class="controls">
                                        <input type="text" id="offer_silent_check5_off" name="offer_silent_check5_off" value="<?= $_REQUEST[offer_silent_check5_off]?>" class="span6 popovers" data-trigger="hover" data-content='The key to the silent installation of the main application, which will be installed. Eg: "/S" or "-s"' data-original-title="Main Software Silent Key" />
                                    </div>
                                </div>
                                
                                <hr>
                                
                                <div class="control-group">
                                    <label class="control-label-1" for="input3"> (If you select check installed method of dropdown , then registry keys will be ignored)</label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="input3"> Check Installed Method </label>
                                    <div class="controls">
                                        <select class="span6 chosen" name='checkinstalled_method' >
                                            <option value="0">&nbsp;</option>
                                            <?
                                            $sql1 = "SELECT * FROM checkinstalled_method";
                                            $q1 = mysql_query($sql1);
                                            while ($row1 = mysql_fetch_assoc($q1)) {
                                                ?>
                                                <option value="<?= $row1[id] ?>" <? if ($_REQUEST[checkinstalled_method] == $row1[id]) echo 'SELECTED'; ?>><?= $row1[method_name]?></option>
                                            <? } ?>
                                        </select>
                                    </div>      
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="input3">Registry For Pre-Install on 32bit OS</label>
                                    <div class="controls">
                                        <input type="text" id="reg_path_pre" name="reg_path_pre" value="<?= $_REQUEST[reg_path_pre]?>" class="span6 popovers" data-trigger="hover" data-content='The registry path need to be checked to determine the successful installation. Eg: HKEY_CURRENT_USER\Software\Microsoft\MyCoolApp' data-original-title='Registry Path for 32bit OS' />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label" for="input3">Registry For Pre-Install on 64bit OS</label>
                                    <div class="controls">
                                        <input type="text" id="reg_path_64_pre" name="reg_path_64_pre" value="<?= $_REQUEST[reg_path_64_pre]?>" class="span6 popovers" data-trigger="hover" data-content='The registry path need to be checked to determine the successful installation. Eg: HKEY_CURRENT_USER\Software\Microsoft\MyCoolApp' data-original-title='Registry Path for 64bit OS' />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label" for="input3">Registry For Post-Install on 32bit OS</label>
                                    <div class="controls">
                                        <input type="text" id="reg_path_post" name="reg_path_post" value="<?= $_REQUEST[reg_path_post]?>" class="span6 popovers" data-trigger="hover" data-content='The registry path need to be checked to determine the successful installation. Eg: HKEY_CURRENT_USER\Software\Microsoft\MyCoolApp' data-original-title='Registry Path for 32bit OS' />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label" for="input3">Registry For Post-Install on 64bit OS</label>
                                    <div class="controls">
                                        <input type="text" id="reg_path_64_post" name="reg_path_64_post" value="<?= $_REQUEST[reg_path_64_post]?>" class="span6 popovers" data-trigger="hover" data-content='The registry path need to be checked to determine the successful installation. Eg: HKEY_CURRENT_USER\Software\Microsoft\MyCoolApp' data-original-title='Registry Path for 64bit OS' />
                                    </div>
                                </div>
                                
                                <hr>

                                <div class="control-group">
                                    <label class="control-label" >Offer Visible</label>
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
                                        <input type="text" id="offer_tos_url" name="offer_tos_url" value="<?= $_REQUEST[offer_tos_url]?>" class="span6 popovers" data-trigger="hover" data-content='The direct link to the "Terms Of Service" page. It is not a mandatory field. Eg: https://services.mozilla.com/tos/' data-original-title='"Terms Of Service" URL' />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="input3">"Privacy Policy" URL</label>
                                    <div class="controls">
                                        <input type="text" id="offer_pp_url" name="offer_pp_url" value="<?= $_REQUEST[offer_pp_url]?>" class="span6 popovers" data-trigger="hover" data-content='The direct link to the "Privacy Policy" page. It is not a mandatory field. Eg: https://www.mozilla.org/en-US/privacy/' data-original-title='"Privacy Policy" URL' />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="input3">"EULA" URL</label>
                                    <div class="controls">
                                        <input type="text" id="offer_eula_url" name="offer_eula_url" value="<?= $_REQUEST[offer_eula_url]?>" class="span6 popovers" data-trigger="hover" data-content='The direct link to the "End User License Agreement (EULA)" page. It is not a mandatory field. Eg: http://www.mozilla.org/en-US/legal/eula/' data-original-title='"EULA" URL' />
                                    </div>
                                </div>

                                <hr>

                                <div class="control-group">
                                    <label class="control-label" for="input8">Price Per Install</label>
                                    <div class="controls">
                                        <div class="input-prepend input-append">
                                            <span class="add-on">$</span><input class="input-small" id="input8" type="text" id="offer_price" name="offer_price" value="<?= $_REQUEST[offer_price]?>"/>
                                        </div>
                                    </div>
                                </div>                               
                               
                                

                                <div class="form-actions">
                                    <a href="#" class="btn btn-success" onclick="FixRegPath(); $('#add_form').submit();
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