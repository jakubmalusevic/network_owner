<?
include 'z_header.php';
//var_dump($_SERVER);exit;
?>

<?
     
    
     $act = $_REQUEST["mode"];
     if($act=="del")
     {
         $sql = "DELETE FROM projects WHERE id={$_REQUEST["cid"]}";
         $q = mysql_query($sql);
         //var_dump($sql);exit;
     }
     else if($act=="copy")
     {                                  
         $sql = "INSERT INTO projects(
            user_id,
            assigned_user_id,
            network_id,
            proj_datetime,
            proj_name,
            proj_description,
            proj_exe,
            proj_logo,
            software_name,
            software_version,
            software_description,
            software_url,
            software_silent,
            software_tos_url,
            software_pp_url,
            software_eula_url,
            software_exit_url) 
            (SELECT  user_id,
                        assigned_user_id,
                        network_id,
                        proj_datetime,
                        CONCAT('copy-',proj_name),
                        proj_description,
                        proj_exe,
                        proj_logo,
                        software_name,
                        software_version,
                        software_description,
                        software_url,
                        software_silent,
                        software_tos_url,
                        software_pp_url,
                        software_eula_url,
                        software_exit_url
            FROM projects p 
            WHERE id={$_REQUEST[cid]})";    
              
         
         
         $q = mysql_query($sql);
         $proj_id = mysql_insert_id(); 
           
         $logopath =  $my_common_path . 'installer_logos/';  
         
         $logo_src = $logopath . $_REQUEST[cid] . '.jpg';
         $logo_dst = $logopath . $proj_id . '.jpg';
         copy($logo_src, $logo_dst);
         
         //copy projects template
         $sql = "INSERT INTO projects_template(proj_id,tmpl_id,rate,description)
                (SELECT {$proj_id}, tmpl_id, rate, description FROM projects_template WHERE proj_id={$_REQUEST[cid]}) ";
         //var_dump($sql);exit;
         $q = mysql_query($sql);
         
         //copy projects_offer
         $sql = "INSERT INTO projects_offer(proj_id, cat_order, cat_id, offer_id, rate_rotation)
                (SELECT {$proj_id}, cat_order, cat_id, offer_id, rate_rotation FROM projects_offer WHERE proj_id={$_REQUEST[cid]})";
         $q = mysql_query($sql);
         
         echo('<script language="JavaScript">window.location.href = "camp_list.php"</script>');
         break;
            
     }
     //$download_url = "http://totalnethits.biz/download_gate.php?cid=";     
     $download_url = "http://localhost/network_owner/common/download_gate.php?cid=";
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
                    Campaigns List
                    <small>list of your installation packages</small>
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> <span class="divider">/</span>
                    </li>
                    <li><a href="#">Campaigns List</a></li>
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
                            <h4><i class="icon-reorder"></i>  Campaigns List</h4>
                        </div>
                        <div class="widget-body form">
                            <form action="camp_list.php" class="form-horizontal" method="POST" id="copy_form">
                                <input type="hidden" name="cid" value="0" id="copy_form_cid">
                                <input type="hidden" name="mode" value="copy">
                            </form>
                            <!-- BEGIN FORM-->
                            <table class="table table-striped table-bordered" id="other_list">
                                <thead>
                                    <tr>
                                        <th>CID</th>
                                        <th>Created Date/Time</th>
                                        <th>Created By</th>
                                        <th>Assigned To</th>
                                        <th>Campaign Name</th>
                                        <th>Application</th>
                                        <th>Download URL</th>
                                        <th>Offers</th>                                          
                                        <th>Campaign Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    $sql = "SELECT p.*, um.*, ( SELECT count(id) FROM projects_offer po WHERE po.proj_id=p.id and po.rate_rotation>0) as offer_count 
                                            FROM projects p, (SELECT u1.id as user_id, u1.user_first_name, u1.user_last_name, u2.id as PM_id, u2.user_first_name as PM_first_name, u2.user_last_name as PM_last_name FROM users u1, users u2 WHERE u1.user_manager=u2.id) um 
                                            WHERE p.assigned_user_id=um.user_id ORDER BY p.id ";
                                    $q = mysql_query($sql);
                                    while ($row = mysql_fetch_assoc($q)) {
                                        ?>
                                        <tr class="odd gradeX">
                                            <td class="highlight"><div class="success"></div><?= $row[id] ?></td>
                                            <td><?= date_format(date_create($row[proj_datetime]), SHORTDATETIME) ?></td>
                                            <td><a href="pub_edit.php?id=<?= $row[PM_id] ?>"><?= $row[PM_first_name] . ' ' . $row[PM_last_name] ?></a></td>
                                            <td><a href="pub_edit.php?id=<?= $row[user_id] ?>"><?= $row[user_first_name] . ' ' . $row[user_last_name] ?></a></td>
                                            <td><?= $row[proj_name] ?></td>
                                            <td><?= $row[software_name] . ' ' . $row[software_version] ?></td>
                                            <td><a target="_blank" href="<?=$download_url ?><?= $row[id] ?>&file=<?= $row[proj_exe] ?>"><? echo($download_url . $row[id] . "&file=" . $row[proj_exe]); ?></a></td>
                                            <td><?= $row[offer_count] ?></td>
                                            
                                            <td><span class="label label-success">Active</span></td>
                                            <td class="center">
                                                <a target="_blank" href="<?=$download_url ?><?= $row[id] ?>&file=<?= $row[proj_exe] ?>" class="icon huge tooltips" data-placement="bottom" data-original-title="Direct download EXE File"><i class="icon-download-alt"></i></a>&nbsp;
                                                <!--<a href="camp_view.php?cid=<?=$row[id]?>" class="icon huge tooltips" data-placement="bottom" data-original-title="View Campaign"><i class="icon-search"></i></a>&nbsp;-->
                                                <a href="camp_edit.php?cid=<?= $row[id] ?>" class="icon huge tooltips" data-placement="bottom" data-original-title="Edit Campaign"><i class="icon-pencil"></i></a>&nbsp;
                                                <a href="camp_list.php?cid=<?=$row[id]?>&mode=del" class="icon huge tooltips" data-placement="bottom" data-original-title="Delete Campaign"><i class="icon-remove"></i></a>&nbsp;
                                                <a href="" onclick="document.getElementById('copy_form_cid').value=<?=$row[id]?> ;$('#copy_form').submit();return false;" class="icon huge tooltips" data-placement="bottom" data-original-title="Copy Campaign"><i class="icon-plus"></i></a>&nbsp;
                                            </td>
                                        </tr>
                                    <? } ?>
                                </tbody>
                            </table>
                            
                            
                            <!-- END FORM-->
                            <br>
                            <div class="form-actions" id="buttons_general"  style="<? if ($_REQUEST[tab] == '2') { ?> display: none; <? } ?> padding-left: 15px;">
                                <a href="camp_add.php" class="btn btn-success"><i class="icon-plus-sign"></i> Add A New Campaign</a>
                            </div>
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
