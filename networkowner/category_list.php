<?
include 'z_header.php';
 
     
if ($_REQUEST[mode] == 'removed') {
    
    $sql = "DELETE FROM offer_categories WHERE category_id='{$_REQUEST[id]}'";
    mysql_query($sql);
    
    mysql_query("DELETE FROM categories WHERE `id`={$_REQUEST[id]}");
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
                    Offers Category List
                    <small>list of the offer categories</small>
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> <span class="divider">/</span>
                    </li>
                    <li><a href="#">Offers Category List</a></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div id="page">

            <? if ($errmsg != '') 
                { 
                    $usermessage = '<b>Please correct the following errors:</b><br><ul>';
                    $usermessage .= $errmsg;
                    $usermessage .= '</ul>';
            ?>
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
                    Category <b>"<?= $_REQUEST[name] ?>"</b> has been removed successfully from the list!
                </div>
            <? } ?>

            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i>  Offers Categories List</h4>
                        </div>
                        <div class="widget-body form">
                            <!-- BEGIN FORM-->
                            <table class="table table-striped table-bordered" id="other_list">
                                <thead>
                                    <tr>
                                        <th>OCID</th>
                                        <th>Created Date/Time</th>
                                        <th>Category Name</th>
                                        <th>Offers Count</th>
                                        <th>Actions</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    $sql = "SELECT c.*, (SELECT count(oc.id) FROM offer_categories oc WHERE oc.category_id=c.id ) as offers_count FROM categories c ORDER BY id DESC";
                                    $q = mysql_query($sql);
                                    while ($row = mysql_fetch_assoc($q)) {
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?= $row[id] ?></td>
                                            <td><?= date_format(date_create($row[lastdate]), SHORTDATETIME) ?></td>                                             
                                            <td><?= $row[name] ?></td>                                             
                                            <td><?= $row[offers_count] ?></td>
                                            <td class="center">                                                
                                                <a href="category_edit.php?id=<?= $row[id]?>" class="icon huge tooltips" data-placement="bottom" data-original-title="Edit Offer Category"><i class="icon-pencil"></i></a>&nbsp;
                                                <a href="category_list.php?mode=removed&id=<?= $row[id] ?>&name=<?= $row[name]?>" onclick="return confirm('Are you sure to remove <?= $row[name] ?>?')" class="icon huge tooltips" data-placement="bottom" data-original-title="Delete Offer Category"><i class="icon-remove"></i></a>&nbsp;
                                            </td>
                                        </tr>
                                    <? } ?>
                                </tbody>
                            </table>
                            <!-- END FORM-->
                            <br>

                            <div class="form-actions" id="buttons_general"  style="padding-left: 15px;">
                                <a href="category_add.php" class="btn btn-success"><i class="icon-plus-sign"></i> Add A New Category</a>
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