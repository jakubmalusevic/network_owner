<?
include 'z_header.php';

    
if (($_REQUEST[cid] != '') && ($_REQUEST[tmpl_id] != '')) 
{    
    if($_REQUEST[tryout] == "1")
    {
        //var_dump("kkk");exit;
        $sql = "UPDATE projects_template SET description='{$_REQUEST[software_description_template]}' WHERE proj_id={$_REQUEST[cid]} AND tmpl_id='{$_REQUEST[tmpl_id]}'";
        $q = mysql_query($sql);
        echo('<script language="JavaScript">window.location.href = "camp_edit.php?cid=' . $_REQUEST[cid] . '"</script>' );
        break;
    } 
    $sql = "SELECT * FROM projects_template WHERE proj_id={$_REQUEST[cid]} AND tmpl_id={$_REQUEST[tmpl_id]}";
    $q = mysql_query($sql);
    $row = mysql_fetch_assoc($q);

    foreach ($row as $key => $value) {
        $_REQUEST[$key] = $value;
    }
}
else
{
    echo('<script language="JavaScript">window.location.href = "camp_edit.php?cid=' . $_REQUEST[cid] . '"</script>' );
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
                    Edit template description
                    <small>edit software description for template</small>
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="camp_list.php">Campaigns List</a> <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="camp_edit.php">Edit Campaign</a> <span class="divider">/</span>
                    </li>
                    <li><a href="#">Edit description for template</a></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div id="page">
      
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i>  Edit Campaign Settings</h4>
                        </div>
                        <div class="widget-body form">
                            <div class="tabbable portlet-tabs">
                                <div class="tab-content">                                          
                                        <form action="camp_template.php?cid=<?= $_REQUEST[cid]?>&tmpl_id=<?=$_REQUEST[tmpl_id] ?>" class="form-inline" method="POST" id="edit_form" >
                                            <input type="hidden" name="tryout" value="1">
                                            <div class="control-group">
                                                <label class="control-label" ><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Application Description for the template</label>
                                                <div class="controls">
                                                    <textarea class="span6 editor popovers" rows="6" style="width: 700px;" id="software_description_template" name="software_description_template" data-trigger="hover" data-content='The description of the main application, which will be installed. This will be shown in your installer.'><?= $_REQUEST[description] ?></textarea>
                                                </div>
                                            </div>

                                        </form>

                                    </div>
       
                                </div>
                            </div>
                            <br>
                            <div class="form-actions" id="buttons_general" <? if ($_REQUEST[tab] == '2') { ?> style="display: none;"<? } ?>>
                                <a href="#" class="btn btn-success" onclick="$('#edit_form').submit();
                                            return false;"><i class="icon-check"></i> Save Campaign</a>
                                <a href="camp_edit.php?cid=<?=$_REQUEST[cid] ?>" class="btn">Cancel</a>
                            </div>

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
