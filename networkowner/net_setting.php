<?
include 'z_header.php';

                            
if ($_REQUEST[tryout] == '1') 
{

    $errmsg = '';

    
    if ($_REQUEST[max_revenue_publisher] == '') {
        $errmsg.='<li>Field "Max Publisher Revenue" should not be empty</li>';
    }

    if ($_REQUEST[max_revenue_PM] == '') {
        $errmsg.='<li>Field "Max PM Revenue" should not be empty</li>';
    }

    if ($_REQUEST[max_revenue_AM] == '') {
        $errmsg.='<li>Field "Max AM Revenue" should not be empty</li>';
    } 
    
    if ($errmsg != '') {
        $usermessage = '<b>Please correct the following errors:</b><br><ul>';
        $usermessage .= $errmsg;
        $usermessage .= '</ul>';
    } 
    else 
    {                                  
        mysql_query("UPDATE `network_setting` SET field_value='{$_REQUEST[max_revenue_publisher]}' WHERE field_name='max_revenue_publisher'");
        mysql_query("UPDATE `network_setting` SET field_value='{$_REQUEST[max_revenue_PM]}' WHERE field_name='max_revenue_PM'");
        mysql_query("UPDATE `network_setting` SET field_value='{$_REQUEST[max_revenue_AM]}' WHERE field_name='max_revenue_AM'");
        
        $usermessage = '<b>Saving Success:</b><br>';
        
    }
} 
else 
{
    $sql = "SELECT * FROM network_setting ";
    $q = mysql_query($sql);
    while($row = mysql_fetch_assoc($q))
    {
        $_REQUEST[$row[field_name]] = $row[field_value];            
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
                    Network Setting
                    <small>edit Network setting values</small>
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="">Network Setting</a> 
                    </li>
                    
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
                            <h4><i class="icon-reorder"></i>  Netwok Setting</h4>
                        </div>
                        <div class="widget-body form">
                            <!-- BEGIN FORM-->
                            <form action="net_setting.php" class="form-horizontal" method="POST" id="net_setting" enctype="multipart/form-data">
                                <input type="hidden" name="tryout" value="1"/>

                                <div class="control-group">
                                    <label class="control-label" for="input3"><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Max Publisher Revenue</label>
                                    <div class="controls">
                                        <input type="text" id="max_revenue_publisher" name="max_revenue_publisher" value="<?= $_REQUEST[max_revenue_publisher] ?>" class="span6"  />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="input3"><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Max PM Revenue</label>
                                    <div class="controls">
                                        <input type="text" id="max_revenue_PM" name="max_revenue_PM" value="<?= $_REQUEST[max_revenue_PM] ?>" class="span6"  />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="input3"><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Repeat Password</label>
                                    <div class="controls">
                                        <input type="text" id="max_revenue_AM" name="max_revenue_AM" value="<?= $_REQUEST[max_revenue_AM] ?>" class="span6" />
                                    </div>
                                </div>


                                <div class="form-actions">
                                    <a href="#" class="btn btn-success" onclick="$('#net_setting').submit();
                                            return false;"><i class="icon-check"></i> Save Setting</a>
                                    <a href="" class="btn">Cancel</a>
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