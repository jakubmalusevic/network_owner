<?
include 'z_header.php';


FB::log($_SERVER);

if (($_REQUEST[tid] != '')) {
    $sql = "SELECT * FROM `templates` WHERE `template_id`='{$_REQUEST[tid]}'";
    $q = mysql_query($sql);
    $row = mysql_fetch_assoc($q);
    $homepage = file_get_contents($row["file_path"]);
    
    $start_div = strpos($homepage,"<div");
    $end_div = strpos($homepage,"</body>");
    $homepage1 = substr($homepage,$start_div,$end_div-$start_div);
    
//  var_dump($start_div);var_dump($end_div);exit;
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
                    View Template
                    <small>preview HTML template for installer manager interface</small>
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> <span class="divider">/</span>
                    </li>
                    <li><a href="#">View Template</a></li>
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
                            <h4><i class="icon-reorder"></i>  View Template</h4>
                        </div>
                        <div class="widget-body form">
                            

                                <?php echo($homepage1);?>
                                
                                <div class="form-actions">
                                    <a href="template_list.php" class="btn">Return List</a>                                    
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
