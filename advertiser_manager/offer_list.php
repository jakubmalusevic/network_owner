<?
include 'z_header.php';

if ($_REQUEST[mode] == 'removed') {
    $offer_name = mysql_result(mysql_query("SELECT `offer_name` FROM `offers` WHERE `id`='{$_REQUEST[id]}'"), 0);
    mysql_query("DELETE FROM `offers` WHERE `id`={$_REQUEST[id]}");
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
                    Offers List
                    <small>list of the offers</small>
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> <span class="divider">/</span>
                    </li>
                    <li><a href="#">Offers List</a></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div id="page">

            <? if ($usermessage != '') { ?>
                <div class="alert alert-success">
                    <button class="close" data-dismiss="alert">×</button>
                    <?= $usermessage ?>
                </div>
            <? } ?>

            <?
            if ($_REQUEST[mode] == 'removed') {
                ?>
                <div class="alert alert-success">
                    <button class="close" data-dismiss="alert">×</button>
                    Offer <b>"<?= $offer_name ?>"</b> has been removed successfully from the list!
                </div>
            <? } ?>

            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i>  Offers List</h4>
                        </div>
                        <div class="widget-body form">
                            <!-- BEGIN FORM-->
                            <table class="table table-striped table-bordered" id="other_list">
                                <thead>
                                    <tr>
                                        <th>OID</th>
                                        <th>Created Date/Time</th>
                                        <th>Created By</th>
                                        <th>Advertiser</th>
                                        <th>Offer Name</th>
                                        <th>Price</th>
                                        <th>Installs Started</th>
                                        <th>Install Completed</th>
                                        <th>Offer Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    //var_dump($_SESSION);exit;
                                    $sql = "SELECT o.id, o.offer_datetime, u1.id as created_id, u1.user_first_name as created_first_name, u1.user_last_name as created_last_name, u.id as user_id, u.user_first_name, u.user_last_name, o.offer_name, o.offer_price, (SELECT COUNT(io.id) FROM install_offers io WHERE io.offer_id=o.id AND io.install_state=0) as install_started, (SELECT COUNT(io1.id) FROM install_offers io1 WHERE io1.offer_id=o.id AND io1.install_state=1) as install_successed, o.offer_show  FROM offers o, users u, users u1  WHERE o.assigned_user_id=u.id AND u.user_manager={$_SESSION[user_id]} AND u1.id=o.user_id ORDER BY o.id DESC";
                                    //var_dump($sql);exit;
                                    $q = mysql_query($sql);
                                    while ($row = mysql_fetch_assoc($q)) {
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?= $row[id]+1000 ?></td>
                                            <td><?= date_format(date_create($row[offer_datetime]), SHORTDATETIME) ?></td>
                                            <td><?= $row[created_first_name] . ' ' . $row[created_last_name] ?></a></td>
                                            <td><a href="adv_edit.php?id=<?= $row[user_id] ?>"><?= $row[user_first_name] . ' ' . $row[user_last_name] ?></a></td>
                                            <td><?= $row[offer_name] ?></td>
                                            <td>$<?= $row[offer_price] ?></td>
                                            <td><?= $row[install_started] ?></td>
                                            <td><?= $row[install_successed] ?></td>
                                            <td>
                                                <? if ($row[offer_show] == '1') { ?>
                                                    <span class="label label-success">Visible</span>
                                                <? } else { ?>
                                                    <span class="label label-default">Hidden</span>
                                                <? } ?>
                                            </td>
                                            <td class="center">
                                                <a href="offer_edit.php?id=<?= $row[id] ?>" class="icon huge tooltips" data-placement="bottom" data-original-title="Edit Offer"><i class="icon-pencil"></i></a>&nbsp;
                                                <a href="offer_list.php?mode=removed&id=<?= $row[id] ?>" onclick="return confirm('Are you sure to remove <?= $row[offer_name] ?>?')" class="icon huge tooltips" data-placement="bottom" data-original-title="Delete Offer"><i class="icon-remove"></i></a>&nbsp;
                                            </td>
                                        </tr>
                                    <? } ?>
                                </tbody>
                            </table>
                            <!-- END FORM-->
                            <br>
                            <div class="form-actions" id="buttons_general"  style="<? if ($_REQUEST[tab] == '2') { ?> display: none; <? } ?> padding-left: 15px;">
                                <a href="offer_add.php" class="btn btn-success"><i class="icon-plus-sign"></i> Add A New Offer</a>
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