<?
include 'z_header.php';
//var_dump($_SESSION);exit;

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
                            <!-- BEGIN FORM-->
                            <table class="table table-striped table-bordered" id="other_list">
                                <thead>
                                    <tr>
                                        <th>CID</th>
                                        <th>Created Date/Time</th>
                                        <th>Manager</th>
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
                                    $sql = "
                                    SELECT p.*, um.* 
                                    FROM projects p, (SELECT u1.id as user_id, u1.user_first_name, u1.user_last_name, u2.id as PM_id, u2.user_first_name as PM_first_name, u2.user_last_name as PM_last_name FROM users u1, users u2 WHERE u1.user_manager=u2.id) um 
                                    WHERE p.assigned_user_id=um.user_id AND um.user_id={$_SESSION[user_id]} ORDER BY um.user_id DESC";
                                            
                                    //var_dump($sql);exit;
                                    
                                    $q = mysql_query($sql);
                                    while ($row = mysql_fetch_assoc($q)) {
                                        ?>
                                        <tr class="odd gradeX">
                                            <td class="highlight"><div class="success"></div><?= $row[id] ?></td>
                                            <td><?= date_format(date_create($row[proj_datetime]), SHORTDATETIME) ?></td>
                                            <td><?= $row[PM_first_name] . ' ' . $row[PM_last_name] ?></td>
                                            <td><?= $row[user_first_name] . ' ' . $row[user_last_name] ?></td>
                                            <td><?= $row[proj_name] ?></td>
                                            <td><?= $row[software_name] . ' ' . $row[software_version] ?></td>
                                            <td><a href="../common/download.php?cid=<?= $row[id] ?>&file=<?= $row[proj_exe] ?>"><?=$common_path_url?>download.php?cid=<?= $row[id] ?>&file=<?= $row[proj_exe] ?></a></td>
                                            <td><?= $row[proj_offers] ?></td>
                                            
                                            <td><span class="label label-success">Active</span></td>
                                            <td class="center">
                                                <a href="../common/download.php?cid=<?= $row[id] ?>&file=<?= $row[proj_exe] ?>" class="icon huge tooltips" data-placement="bottom" data-original-title="Direct download EXE File"><i class="icon-download-alt"></i></a>&nbsp;                                                
                                            </td>
                                        </tr>
                                    <? } ?>
                                </tbody>
                            </table>
                            <!-- END FORM-->
                            <br>

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