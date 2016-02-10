<?
include 'z_header.php';

if ($_REQUEST[tryout] == '1') {

    $errmsg = '';
  
    if($_REQUEST[mode] == "select_categories")
    {
        $selected_cats_id = "";
        foreach ($_POST['categories'] as $selectedCategory)
        {               
            $selected_cats_id = $selected_cats_id . $selectedCategory . ",";
        }
        if($selected_cats_id != "")
        {
            $selected_cats_id = substr($selected_cats_id,0,-1);
            $sql = "DELETE FROM projects_offer WHERE proj_id={$_REQUEST[cid]} AND cat_id NOT IN ({$selected_cats_id})"; 
            //echo($selected_cats_id); exit;               
        }
        else
        {
            $sql = "DELETE FROM projects_offer WHERE proj_id={$_REQUEST[cid]}"; 
        }
        
        $q = mysql_query($sql);  
        
        $order = 0;
        
        //var_dump($_POST['categories']);
        
        foreach ($_POST['categories'] as $selectedCategory)
        {               
            $sql = "SELECT * FROM projects_offer WHERE proj_id={$_REQUEST[cid]} AND cat_id={$selectedCategory}";
            $q = mysql_query($sql);
            $num = mysql_numrows($q);
            //echo $order . " : " . $selectedCategory . "\n";
            
            
            if($num == 0)
            {
                ///first add about the category, it means no offer is selected yet.
                // check the category for offer group or not
                $sql = "SELECT count(id) FROM offer_categories WHERE category_id={$selectedCategory} AND isgroup=1";
                
                $q = mysql_query($sql);
                $num = mysql_numrows($q);
                                 
                if($num>0) 
                {
                    // it is category for group
                    $sql = "INSERT INTO projects_offer(proj_id, cat_order, cat_id, offer_id) VALUES ({$_REQUEST[cid]}, {$order}, {$selectedCategory}, '0')";
                }
                else
                {
                    $sql = "INSERT INTO projects_offer(proj_id, cat_order, cat_id, offer_id) VALUES ({$_REQUEST[cid]}, {$order}, {$selectedCategory}, '-1')";
                }
                
                
                
                $q = mysql_query($sql);                  
            }
            else
            {
                $sql = "UPDATE projects_offer SET cat_order={$order} WHERE proj_id={$_REQUEST[cid]} AND cat_id={$selectedCategory}";
                $q = mysql_query($sql);                  
            }
            $order++;
        }
        //var_dump($sql);exit;        
    }
    else if($_REQUEST[mode] == "offers_rate")
    {
        $total = 0;
        //var_dump($_POST);exit;
        foreach ($_POST['rate'] as $rate)
        {               
            $total += $rate;
        }
        
        if($total != 100)
        {
            
            $errmsg.='<li>Total of rate is not 100%, please check it again</li>';  
        }        
        else
        {
            $cat_id = $_REQUEST[selected_categoryid];
            
            //get order of the category
            
            $sql = "SELECT cat_order FROM projects_offer WHERE proj_id={$_REQUEST[cid]} AND cat_id={$cat_id} GROUP BY cat_id" ;
            $q = mysql_query($sql);
            $row = mysql_fetch_row($q);
            $order = $row[0];
            
            //delete original records
            $sql = "DELETE FROM projects_offer WHERE proj_id={$_REQUEST[cid]} AND cat_id={$cat_id}";
            $q = mysql_query($sql);
            
            //insert new records with rate
            $sql = "INSERT INTO projects_offer(proj_id, cat_order, cat_id, offer_id, rate_rotation) VALUES ";
            
            $count = 0;
            foreach ($_POST['rate'] as $rate)
            {               
                if($rate != 0 )
                {
                    $sql .= "( {$_REQUEST[cid]}, {$order}, {$cat_id}, {$_POST[offer_ids][$count]}, {$rate}),";
                }
                $count++;
            }
            $sql = substr($sql,0,-1);
            $q = mysql_query($sql); 
            //var_dump($sql);exit;
        }
    }
    
    if ($errmsg != '') {
        $usermessage = '<b>Please correct the following errors:</b><br><ul>';
        $usermessage .= $errmsg;
        $usermessage .= '</ul>';
        $save_message = '0';
    } else {
        
    }    
}

?>
<link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/themes/ui-lightness/jquery-ui.css" />
<link type="text/css" href="../common/multiselector/css/ui.multiselect.css" rel="stylesheet" />
<script type="text/javascript" src="../common/multiselector/js/plugins/localisation/jquery.localisation-min.js"></script>
<script type="text/javascript" src="../common/multiselector/js/ui.multiselect.js"></script>
<script type="text/javascript">
    $(function(){
        $.localise('ui-multiselect', {/*language: 'en',*/ path: '../common/multiselector/js/locale/'});
        $(".multiselect").multiselect({sortable: true, searchable: true});
        
    });
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
                    Add Offer
                    <small>add offer to the Campign</small>
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
                        <a href="camp_edit.php?cid=<?= $_REQUEST[cid]?>&tab=2">Campaign Edit</a> <span class="divider">/</span>
                    </li>
                    <li><a href="#">Add Offers</a></li>
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
                            <h4><i class="icon-reorder"></i>  Select Categories Settings</h4>
                        </div>
                        <div class="widget-body form">
                            <div class="tabbable portlet-tabs" style="width: 600px; float: left;">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="portlet_tab1">
                                    
                                        <form action="camp_offer.php?cid=<?= $_REQUEST[cid]?>" class="form-horizontal" method="POST" id="category_form" enctype="multipart/form-data">
                                            <input type="hidden" name="tryout" value="1"/>                                            
                                            <input type="hidden" name="mode" value="select_categories"/>
                                            
                                            <div class="control-group" style="overflow-y: hidden ;">
                                             
                                                  <div id="multi_header" style="width:500px;height:30px;margin: 10px 0px 0px 0px;">
                                                    <div style="width:210px;height:30px;float:left;text-align: center;"> Avaialbe Categories </div>
                                                    <div style="width:70px;height:30px;float:left;text-align: center;"><img src="../common/multiselector/images/switch.png" alt=""> </div>
                                                    <div style="width:200px;height:30px;float:left;text-align: center;"> Added Categories  </div>
                                                  </div>
                                                  
                                                  <select id="categories" class="multiselect" multiple="multiple" name="categories[]" style="display: none; width:500px;height: 120px;">
                                                  <?php                                                                                                        
                                                        $sql = "select c.* from categories c where c.id not in (select po.cat_id from projects_offer po where po.proj_id={$_REQUEST[cid]}) ";
                                                        //var_dump($sql);exit;
                                                        $q = mysql_query($sql);
                                                        while ($row = mysql_fetch_assoc($q)) {
                                                  ?>
                                                        <option value="<?= $row[id]?>"> <?= $row[name]?></option>
                                                  <?php
                                                        }
                                                        
                                                        $sql = "SELECT c.*, po.cat_order FROM categories c, projects_offer po WHERE c.id=po.cat_id AND po.proj_id={$_REQUEST[cid]} GROUP BY po.cat_id ORDER BY po.cat_order ";
                                                        $q = mysql_query($sql);
                                                        while ($row = mysql_fetch_assoc($q)) {
                                                  ?>
                                                        <option value="<?= $row[id]?>" selected > <?= $row[name]?></option>
                                                  <?php
                                                        }        
    
                                                  ?>    
                                                  </select>                                                 
                                                  
                                            </div>
                                            
                                        </form>
                                        
                                     </div>
                                </div>
                            </div>    
                            
                            <div class="form-actions" id="buttons_general">
                                <a href="#" style="margin-top: 50px;" class="btn btn-success" onclick="$('#category_form').submit();
                                            return false;"><i class="icon-check"></i> Save Categories</a>
                                <a href="camp_edit.php?cid=<?=$_REQUEST[cid] ?>&tab=2" style="margin-top: 50px;" class="btn">Cancel</a>
                              </div>
                        </div>
                    </div>
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i>  Set Offer % Rotations</h4>
                        </div>
                        <? if ($usermessage != '') { ?>
                            <div class="alert alert-error">
                                <button class="close" data-dismiss="alert">Ã—</button>
                                <?= $usermessage ?>
                            </div>
                        <? } ?>
                        <div class="widget-body form">
                            <div class="tabbable portlet-tabs" >
                                <div class="tab-content">
                                    <div class="tab-pane active" id="portlet_tab1">
                                        <form action="camp_offer.php?cid=<?= $_REQUEST[cid]?>" class="form-inline" role="form" method="POST" id="offer_rate_form" enctype="multipart/form-data">
                                            <input type="hidden" name="tryout" value="1"/>
                                            <input type="hidden" name="mode" value="offers_rate"/>
                                            <br>
                                            <div class="control-group">
                                                <label class="control-label" for="input3"><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span>Added Categories</label>
                                                <div class="controls">
                                                    <select class="span6 chosen" name='selected_categoryid' onchange="GetOffersByCategory_Project(<?=$_REQUEST[cid]?>,this.options[this.selectedIndex].value);">
                                                        <option value="-1"></option>
                                                        <?
                                                        
                                                        $sql = "SELECT c.*, po.cat_order FROM categories c, projects_offer po WHERE c.id=po.cat_id AND po.proj_id={$_REQUEST[cid]} GROUP BY po.cat_id ORDER BY po.cat_order ";
                                                        $q = mysql_query($sql);
                                                        
                                                        while ($row = mysql_fetch_assoc($q)) {                                                            
                                                            ?>
                                                            <option value="<?= $row[id] ?>"><?= $row[name]?></option>
                                                        <? } ?>
                                                    </select>
                                                </div>
                                            </div>
                                                                                         
                                            <div class="control-group" style="float: left; width:600px;">
                                                <br>Offers of category <br><br>
                                                <div id="offers_table" style="">    
                                                <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>OID</th>
                                                        <th>Offer Name</th>
                                                        <th>% Rotation</th>                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
   
                                                </tbody>
                                            </table>
                                                </div>
                                            </div>                                             
                                            
                                        </form>
                                        
                                     </div>
                                </div>
                            </div>    
                            
                            <div class="form-actions" id="buttons_general">
                                <a href="#" class="btn btn-success" onclick="$('#offer_rate_form').submit();
                                            return false;"><i class="icon-check"></i> Save Offers</a>
                                <a href="camp_edit.php?cid=<?=$_REQUEST[cid] ?>&tab=2" class="btn">Return</a>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
</div>                                      
 
<? include 'z_footer.php'; ?> 