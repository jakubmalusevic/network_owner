<?
include 'z_header.php';
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
                    Reports
                    <small>stats and charts</small>
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> <span class="divider">/</span>
                    </li>
                    <li><a href="#">Reports</a></li>
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
                            <h4><i class="icon-reorder"></i>  Reports</h4>
                        </div>
                        <div class="widget-body form">
                            <div class="tabbable portlet-tabs">
                                <ul class="nav nav-tabs">
                                    <li <? if ($_REQUEST[tab] == '8') { ?>class="active"<? } ?>><a href="#portlet_tab8" data-toggle="tab" >Day Parting</a></li>
                                    <li <? if ($_REQUEST[tab] == '7') { ?>class="active"<? } ?>><a href="#portlet_tab7" data-toggle="tab" >Template</a></li>
                                    <li <? if ($_REQUEST[tab] == '6') { ?>class="active"<? } ?>><a href="#portlet_tab6" data-toggle="tab" >Geo</a></li>
                                    <li <? if ($_REQUEST[tab] == '5') { ?>class="active"<? } ?>><a href="#portlet_tab5" data-toggle="tab" >SubID</a></li>
                                    <li <? if ($_REQUEST[tab] == '4') { ?>class="active"<? } ?>><a href="#portlet_tab4" data-toggle="tab" >Campaigns</a></li>
                                    <li <? if ($_REQUEST[tab] == '3') { ?>class="active"<? } ?>><a href="#portlet_tab3" data-toggle="tab" >Referrers</a></li>
                                    <li <? if ($_REQUEST[tab] == '2') { ?>class="active"<? } ?>><a href="#portlet_tab2" data-toggle="tab" >Publishers</a></li>
                                    <li <? if (($_REQUEST[tab] == '1') || ($_REQUEST[tab] == '')) { ?>class="active"<? } ?>><a href="#portlet_tab1" data-toggle="tab" >Advertisers</a></li>
                                </ul>


                                <div class="tab-content">                               
                                    
                                   
                                    <div class="tab-pane <? if (($_REQUEST[tab] == '1') || ($_REQUEST[tab] == '')) { ?>active<? } ?>" id="portlet_tab1">
                                        <div class="widget-body form span6" >
                                            
                                            <!-- BEGIN FORM-->
                                            <form action="#" class="form-horizontal" id="form_1" method="POST">
                                                <input type="hidden" name="tab" value="1"/>
                                                <input type="hidden" name="mode" value="generate"/>
                                                <input type="hidden" name="form-date-range1-startdate" id="form-date-range1-startdate" value="">
                                                <input type="hidden" name="form-date-range1-enddate" id="form-date-range1-enddate" value="">
                                                <div class="control-group">
                                                    <label class="control-label" >Date Ranges:</label>
                                                    <div class="controls">
                                                        <div id="form-date-range1" class="report-range-container span12">
                                                            <i class="icon-calendar icon-large"></i>&nbsp;&nbsp;<span></span> <b class="caret pull-right"></b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="input3">Search String:</label>
                                                    <div class="controls">
                                                        <input type="text" id="search_string_1" name="search_string_1" value="<?= $_REQUEST[search_string_1] ?>" class="span12"/>
                                                    </div>
                                                </div>                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="input3">Search Campign:</label>
                                                    <div class="controls">
                                                        <select class="span6 chosen" name='campign_list' style="width: 150px;">
                                                            <option value="-1" <?php if($_REQUEST[campign_list] == -1) echo "selected"?> >&nbsp;</option>                                                            
                                                            <?
                                                            $sql1 = "SELECT * FROM projects";
                                                            $q1 = mysql_query($sql1);
                                                            while ($row1 = mysql_fetch_assoc($q1)) {
                                                                ?>
                                                                <option value="<?= $row1[id] ?>" <?php if($_REQUEST[campign_list]==$row1[id]) echo "selected" ?> ><?= $row1[proj_name]?></option>
                                                            <? } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="input3">Search Category:</label>
                                                    <div class="controls">
                                                        <select class="span6 chosen" name='cat_list' style="width: 150px;">
                                                            <option value="-1" <?php if($_REQUEST[cat_list]==-1) echo " selected" ?>>&nbsp;</option>                                                            
                                                            <?
                                                            $sql1 = "SELECT * FROM categories";
                                                            $q1 = mysql_query($sql1);
                                                            while ($row1 = mysql_fetch_assoc($q1)) {
                                                                ?>
                                                                <option value="<?= $row1[id] ?>" <?php if($_REQUEST[cat_list]==$row1[id]) echo " selected" ?>><?= $row1[name]?></option>
                                                            <? } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div style="height: 45px;"></div>

                                                <div class="form-actions">
                                                    <a href="#" class="btn btn-success" onclick="$('#form_1').submit();
                                                            return false;"><i class="icon-check"></i> Generate Report</a>
                                                </div>
                                            </form>

                                        </div>

                                        <div class="widget-body form span6">
                                            <!-- BEGIN FORM-->
                                            <div id="chart_sort_div_1" ></div>
                                        </div>



                                        <? if (($_REQUEST[tab] == '1') || ($_REQUEST[tab] == '') && ($_REQUEST[mode] == 'generate')) { ?>
                                            <div class="clearfix"></div>
                                            <br><br>
                                            <div class="widget-body form">
                                                <table class="table table-striped table-bordered" id="sample_1">
                                                    <thead>
                                                        <tr>
                                                            <th>AID</th>
                                                            <th>Advertiser Manager</th>
                                                            <th>Advertiser</th>
                                                            <th>Category</th>
                                                            <th>Offer</th>
                                                            <th>Install Started</th>
                                                            <th>Install Successed</th>
                                                            <th>Advertiser Revenue</th>
                                                            <th>AM Commission</th>
                                                            <th>Network Revenue</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?
                                                        $i = 0;  
  
$tmp_id = (int)$_REQUEST[search_string_1];

$campign = $_REQUEST[campign_list];
$cat = $_REQUEST[cat_list];

$sql = "
SELECT  cat.name as catname, oiop.id, 
        (
            SELECT COUNT(id) FROM install_offers 
            WHERE install_state=0 AND offer_id=oiop.id AND ";
if($campign!=-1) $sql .= "proj_id={$campign} AND ";
$sql .= "
                CAST(install_datetime as DATE)>='{$_REQUEST['form-date-range1-startdate']}' AND 
                CAST(install_datetime as DATE)<='{$_REQUEST['form-date-range1-enddate']}' 
        ) as install_started, 
        (
            SELECT COUNT(id) FROM install_offers 
            WHERE install_state=1 AND offer_id=oiop.id AND ";
if($campign!=-1) $sql .= "proj_id={$campign} AND ";
$sql .= "
                CAST(install_datetime as DATE)>='{$_REQUEST['form-date-range1-startdate']}' AND 
                CAST(install_datetime as DATE)<='{$_REQUEST['form-date-range1-enddate']}'
        ) as install_successed ,
        oiop.offer_name, um.*, SUM(oiop.adv_revenue) as adv_revenue, SUM(oiop.adv_revenue*oiop.AM_revenue/100) as AM_revenue, 
        SUM(oiop.adv_revenue*oiop.PM_revenue/100) as PM_revenue, SUM(oiop.adv_revenue*oiop.pub_revenue/100) as puv_revenue, 
        SUM(oiop.adv_revenue*oiop.network_revenue/100) as net_revenue 
FROM    (SELECT o.id, o.assigned_user_id, o.offer_name,iop.*, iop.offer_price*iop.amount as adv_revenue 
            FROM ";
if($cat!=-1) $sql .= " offer_categories oc, ";
$sql .= "offers o 
            LEFT JOIN   (SELECT iio.offer_id, iio.proj_id, iio.amount ,uuo.offer_price, uuo.AM_revenue, uup.pub_revenue, uup.PM_revenue, (100-uuo.AM_revenue-uup.pub_revenue-uup.PM_revenue) as network_revenue 
                        FROM    (SELECT io.id, io.offer_id, io.proj_id, COUNT(io.id) as amount 
                                FROM install_offers io 
                                WHERE io.install_state=1 AND 
                                    CAST(io.install_datetime as DATE)>='{$_REQUEST['form-date-range1-startdate']}' AND 
                                    CAST(io.install_datetime as DATE)<='{$_REQUEST['form-date-range1-enddate']}' ";
if($campign!=-1) $sql .= "AND io.proj_id={$campign} ";  
$sql .= "
                                GROUP BY io.offer_id,io.proj_id 
                                ) iio , 
                                (SELECT  o.id,o.offer_price,uo2.user_revenue as AM_revenue 
                                FROM offers o, users uo1, users uo2 
                                WHERE o.assigned_user_id=uo1.id AND uo1.user_manager=uo2.id                                     
                                ) uuo, 
                                (SELECT p.id,up1.user_revenue as pub_revenue, up2.user_revenue as PM_revenue 
                                FROM projects p, users up1, users up2 
                                WHERE p.assigned_user_id=up1.id AND up1.user_manager=up2.id) uup 
                        WHERE iio.offer_id=uuo.id AND iio.proj_id=uup.id
                        ) iop 
            ON iop.offer_id=o.id ";
if($cat != -1 ) $sql .= "WHERE oc.category_id={$cat} AND oc.offer_id=o.id "; 
$sql .= "            
            ) oiop, 
            (SELECT u1.id as user_id, u1.subid as user_subid, u1.user_first_name, u1.user_last_name, u2.id as manager_id, u2.user_first_name as manager_first_name, u2.user_last_name as manager_last_name 
                FROM users u1, users u2 WHERE u1.user_manager=u2.id ) um ,
            categories cat, offer_categories oc
WHERE   oc.category_id=cat.id AND oc.offer_id=oiop.id AND
        oiop.assigned_user_id=um.user_id AND 
        (   oiop.offer_name LIKE '%{$_REQUEST[search_string_1]}%'  OR
            um.user_first_name LIKE '%{$_REQUEST[search_string_1]}%'  OR
            um.user_last_name LIKE '%{$_REQUEST[search_string_1]}%'  OR
            um.manager_first_name LIKE '%{$_REQUEST[search_string_1]}%'  OR
            um.manager_last_name LIKE '%{$_REQUEST[search_string_1]}%'  OR
            um.user_subid = {$tmp_id} )
GROUP BY oiop.id ORDER BY adv_revenue DESC";

                                                    
                                                        //var_dump($sql);exit;
                                                        $q = mysql_query($sql);
                                                        
                                                        $total_install_started = 0;
                                                        $total_install_successed = 0;
                                                        $total_revenue = 0;
                                                        $total_AM = 0;
                                                        $total_network = 0;
                                                        
                                                        while ($row = mysql_fetch_assoc($q)) { 
                                                            $total_install_started += $row[install_started];
                                                            $total_install_successed += $row[install_successed];
                                                            
                                                            $total_revenue += $row[adv_revenue];
                                                            $total_AM += $row[AM_revenue];
                                                            $total_network += $row[net_revenue];
                                                            ?>
                                                            <tr class="odd gradeX">
                                                                <td class="highlight"><div class="success"></div><?= $row[user_subid] ?></td>
                                                                <td>
                                                                    <a href="adv_edit.php?id=<?= $row[manager_id] ?>">
                                                                    <?
                                                                    echo($row[manager_first_name] . ' ' . $row[manager_last_name]);
                                                                    ?>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <a href="adv_edit.php?id=<?= $row[user_id] ?>">
                                                                    <?
                                                                    echo($row[user_first_name] . ' ' . $row[user_last_name]);
                                                                    ?>
                                                                    </a>
                                                                </td>
                                                                <th><?=$row[catname] ?></th>
                                                                <td><a href="offer_edit.php?id=<?= $row[id] ?>"><?= $row[offer_name]?></a></td>
                                                                <th><?= $row[install_started] ?></th>
                                                                <th><?= $row[install_successed] ?></th>
                                                                <td>$<?= number_format($row[adv_revenue],2) ?></td>
                                                                <td>$<?= number_format($row[AM_revenue],2) ?></td>
                                                                <td>$<?= number_format($row[net_revenue],2) ?></td>
                                                            </tr>
                                                            <?
                                                            if ($row[adv_revenue] == NULL) $row[adv_revenue] = 0;
                                                            if ($i < 5) {
                                                                $generate_arr.="
                                                                    data.setCell(" . $i . ", 0, '" . $row[offer_name] . "');
                                                                    data.setCell(" . $i . ", 1, " . $row[adv_revenue] . ");
                                                                    data.setCell(" . $i . ", 2, true);
                                                                ";
                                                            }

                                                            $i++;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                                <br>
                                                <table class="table table-striped table-bordered" style="margin: auto;width: 800px;">
                                                    <thead>
                                                        <tr>
                                                            <th>&nbsp</th>
                                                            <th>Install Started</th>
                                                            <th>Install Successed</th>
                                                            <th>Advertiser Revenue</th>
                                                            <th>AM Commission</th>
                                                            <th>Network Revenue</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="highlight" style="color: blue;font-weight: bold;">TOTAL VALUE</td>
                                                            <td><?= $total_install_started?></td>
                                                            <td><?= $total_install_successed?></td>
                                                            <td>$<?= number_format($total_revenue,2)?></td>
                                                            <td>$<?= number_format($total_AM,2)?></td>
                                                            <td>$<?= number_format($total_network,2)?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                      

                                                <script>
                                                            
                                                            google.load('visualization', '1.0', {'packages': ['corechart']});
                                                            google.setOnLoadCallback(drawSort1);
                                                            function drawSort1() {
                                                                var data = new google.visualization.DataTable();
                                                                data.addColumn('string', 'Name');
                                                                data.addColumn('number', 'Revenue');
                                                                data.addColumn('boolean', 'Full Time');
                                                                data.addRows(5);
                                                                
                                                                <?= $generate_arr ?>
                                                                var options = {
                                                                    colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6']
                                                                };

                                                                var formatter = new google.visualization.NumberFormat({prefix: '$'});
                                                                formatter.format(data, 1); // Apply formatter to second column

                                                                var view = new google.visualization.DataView(data);
                                                                view.setColumns([0, 1]);

                                                                var chart = new google.visualization.BarChart(document.getElementById('chart_sort_div_1'));
                                                                chart.draw(view, options);


                                                            }
                                                </script>
                                            </div>
                                        <? } ?>
                                    </div>



                                    <div class="tab-pane <? if ($_REQUEST[tab] == '2') { ?>active<? } ?>" id="portlet_tab2">
                                        <div class="widget-body form span6" >
                                            <!-- BEGIN FORM-->
                                            <form action="#" class="form-horizontal" id="form_2" method="POST">
                                                <input type="hidden" name="tab" value="2"/>
                                                <input type="hidden" name="mode" value="generate"/>
                                                <input type="hidden" name="form-date-range2-startdate" id="form-date-range2-startdate" value="">
                                                <input type="hidden" name="form-date-range2-enddate" id="form-date-range2-enddate" value="">
                                                <div class="control-group">
                                                    <label class="control-label" >Date Ranges:</label>
                                                    <div class="controls">
                                                        <div id="form-date-range2" class="report-range-container span12">
                                                            <i class="icon-calendar icon-large"></i>&nbsp;&nbsp;<span></span> <b class="caret pull-right"></b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="input3">Search String:</label>
                                                    <div class="controls">
                                                        <input type="text" id="search_string_2" name="search_string_2" value="<?= $_REQUEST[search_string_2] ?>" class="span12"/>
                                                    </div>
                                                </div>

                                                <div style="height: 45px;"></div>

                                                <div class="form-actions">
                                                    <a href="#" class="btn btn-success" onclick="$('#form_2').submit();
                                                            return false;"><i class="icon-check"></i> Generate Report</a>
                                                </div>
                                            </form>

                                        </div>

                                        <div class="widget-body form span6">
                                            <!-- BEGIN FORM-->
                                            <div id="chart_sort_div_2" ></div>
                                        </div>



                                        <? if (($_REQUEST[tab] == '2') && ($_REQUEST[mode] == 'generate')) { ?>
                                            <div class="clearfix"></div>
                                            <br><br>
                                            <div class="widget-body form">
                                                <table class="table table-striped table-bordered" id="sample_2">
                                                    <thead>
                                                        <tr>
                                                            <th>PublisherID</th>
                                                            <th>Publisher Manager</th>
                                                            <th>Publisher</th>
                                                            <th>Clicks</th>  
                                                            <th>Install Started</th>  
                                                            <th>Install Completed</th>  
                                                            <th>Publisher Revenue</th>
                                                            <th>PM Commission</th>
                                                            <th>Network Revenue</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?
                                                        $i = 0;
$tmp_id = (int)$_REQUEST[search_string_2];
                                                        
$sql = "
SELECT  um.* ,
        (
            SELECT COUNT(pd.id) FROM projects_downloads pd,projects p 
            WHERE  p.id=pd.proj_id AND p.assigned_user_id=um.user_id AND
                CAST(pd.download_datetime as DATE)>='{$_REQUEST['form-date-range2-startdate']}' AND CAST(pd.download_datetime as DATE)<='{$_REQUEST['form-date-range2-enddate']}'    
        ) as clicks , 
        (
            SELECT COUNT(ip.id) FROM install_projects ip, projects p 
            WHERE ip.proj_id=p.id AND install_state=0 AND p.assigned_user_id=um.user_id AND
                CAST(ip.install_datetime as DATE)>='{$_REQUEST['form-date-range2-startdate']}' AND CAST(ip.install_datetime as DATE)<='{$_REQUEST['form-date-range2-enddate']}'    
        ) as install_started,  
        
        (
            SELECT COUNT(ip.id) FROM install_projects ip, projects p  
            WHERE ip.proj_id=p.id AND install_state=1 AND p.assigned_user_id=um.user_id AND
                CAST(ip.install_datetime as DATE)>='{$_REQUEST['form-date-range2-startdate']}' AND CAST(ip.install_datetime as DATE)<='{$_REQUEST['form-date-range2-enddate']}'    
        ) as install_successed  , 
        SUM(piop.PM_revenue) as PM_revenue, SUM(piop.pub_revenue) as pub_revenue, SUM(piop.network_revenue) as network_revenue
FROM    (SELECT u1.id AS user_id, u1.subid as user_subid, u1.user_first_name, u1.user_last_name, u2.id AS manager_id, u2.user_first_name AS manager_first_name, u2.user_last_name AS manager_last_name
        FROM users u1, users u2
        WHERE u1.user_manager = u2.id AND u1.user_status=3 
        )um
LEFT JOIN
        (SELECT p.assigned_user_id,iio.offer_id, iio.proj_id, SUM(uuo.offer_price) as total,SUM(uuo.offer_price*uuo.AM_revenue/100) as AM_revenue, SUM(uuo.offer_price*uup.pub_revenue/100) as pub_revenue, SUM(uuo.offer_price*uup.PM_revenue/100) as PM_revenue, SUM(uuo.offer_price*(100-uuo.AM_revenue-uup.pub_revenue-uup.PM_revenue)/100) as network_revenue 
        FROM    (SELECT io.id, io.offer_id, io.proj_id  FROM install_offers io 
                WHERE io.install_state=1 AND
                    CAST(io.install_datetime as DATE)>='{$_REQUEST['form-date-range2-startdate']}' AND 
                    CAST(io.install_datetime as DATE)<='{$_REQUEST['form-date-range2-enddate']}'
                ) iio , 
                (SELECT o.id,o.offer_price,uo2.user_revenue as AM_revenue FROM offers o, users uo1, users uo2 WHERE o.assigned_user_id=uo1.id AND uo1.user_manager=uo2.id ) uuo, 
                (SELECT p.id,up1.user_revenue as pub_revenue, up2.user_revenue as PM_revenue FROM projects p, users up1, users up2 WHERE p.assigned_user_id=up1.id AND up1.user_manager=up2.id) uup, projects p WHERE iio.offer_id=uuo.id AND iio.proj_id=uup.id  AND p.id=iio.proj_id GROUP BY iio.proj_id) piop
ON piop.assigned_user_id=um.user_id
WHERE   (
            um.user_first_name LIKE '%{$_REQUEST[search_string_2]}%' OR 
            um.user_last_name LIKE '%{$_REQUEST[search_string_2]}%' OR 
            um.manager_first_name LIKE '%{$_REQUEST[search_string_2]}%' OR 
            um.manager_last_name LIKE '%{$_REQUEST[search_string_2]}%' OR 
            um.user_subid = {$tmp_id}
        )
GROUP BY um.user_id ORDER BY pub_revenue DESC
";                                                          
                                           
                                                        
                                                        //var_dump($sql); exit;
                                                                
                                                        $q = mysql_query($sql);
                                                        
                                                        $total_clicks = 0;
                                                        $total_install_started = 0;
                                                        $total_install_successed = 0;
                                                        $total_revenue = 0;
                                                        $total_PM = 0;
                                                        $total_network = 0;
                                                        
                                                        while ($row = mysql_fetch_assoc($q)) { 
                                                            if($row[pub_revenue]==NULL) $row[pub_revenue] = 0;
                                                            
                                                            $total_clicks += $row[clicks];
                                                            $total_install_started += $row[install_started];
                                                            $total_install_successed += $row[install_successed];
                                                            $total_revenue += $row[pub_revenue];
                                                            $total_PM += $row[PM_revenue];
                                                            $total_network += $row[network_revenue];
                                                            
                                                            ?>
                                                            <tr class="odd gradeX">
                                                                <td class="highlight"><div class="success"></div><?= $row[user_subid] ?></td>
                                                                <td><?
                                                                    if ($row[manager_id] == '-1') {
                                                                        echo('Not yet assigned');
                                                                    } else {
                                                                        echo('<a href="adv_edit.php?id=' . $row[manager_id] . '">' . $row[manager_first_name] . ' ' . $row[manager_last_name] . ' </a>');
                                                                    }
                                                                    ?></td>
                                                                <td><a href="pub_edit.php?id=<?= $row[user_id] ?>"><?= $row[user_first_name] . ' ' . $row[user_last_name] ?></a></td>
                                                                <td><? if($row[clicks]==NULL) $row[clicks] = 0; echo($row[clicks]);?></td>
                                                                <td><? if($row[install_started]==NULL) $row[install_started] = 0; echo($row[install_started]);?></td>
                                                                <td><? if($row[install_successed]==NULL) $row[install_successed] = 0; echo($row[install_successed]);?></td>
                                                                <td>$<?= number_format($row[pub_revenue], 2, ".", ",") ?></td>
                                                                <td>$<?= number_format($row[PM_revenue], 2,".",",") ?></td>
                                                                <td>$<?= number_format($row[network_revenue], 2,".",",") ?></td>
                                                            </tr>
                                                            <?
                                                            if($row[pub_revenue] == NULL) $row[pub_revenue] = 0;
                                                            if ($i < 5) {
                                                                  
                                                                $generate_arr.="
                                                                data.setCell(" . $i . ", 0, '" . $row[user_first_name] . " " . $row[user_last_name] . "');
                                                                data.setCell(" . $i . ", 1, " . $row[pub_revenue] . ");
                                                                data.setCell(" . $i . ", 2, true);
                                                                ";  
                                                            }

                                                            
                                                            $i++;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                                <br>                                                        
                                                <table class="table table-striped table-bordered" style="margin: auto;width: 800px;">
                                                    <thead>
                                                        <tr>
                                                            <th>&nbsp</th>
                                                            <th>Clicks</th>
                                                            <th>Install Started</th>
                                                            <th>Install Completed</th>
                                                            <th>Publisher Revenue</th>
                                                            <th>PM Commission</th>
                                                            <th>Network Revenue</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="highlight" style="color: blue;font-weight: bold;">TOTAL VALUE</td>
                                                            <td><?= $total_clicks?></td>
                                                            <td><?= $total_install_started?></td>
                                                            <td><?= $total_install_successed?></td>
                                                            <td>$<?= number_format($total_revenue, 2, ".", ",")?></td>
                                                            <td>$<?= number_format($total_PM, 2, ".", ",")?></td>
                                                            <td>$<?= number_format($total_network, 2, ".", ",")?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <script>
                                                            google.load('visualization', '1.0', {'packages': ['corechart']});
                                                            google.setOnLoadCallback(drawSort);
                                                            function drawSort() {  
                                                                var data = new google.visualization.DataTable();
                                                                data.addColumn('string', 'Name');
                                                                data.addColumn('number', 'Revenue');
                                                                data.addColumn('boolean', 'Full Time');
                                                                data.addRows(5);
                                                                /*
                                                                data.setCell(0,0,"");data.setCell(0,1,0);data.setCell(0,2,true);
                                                                data.setCell(1,0,"");data.setCell(1,1,0);data.setCell(1,2,true);
                                                                data.setCell(2,0,"");data.setCell(2,1,0);data.setCell(2,2,true);
                                                                data.setCell(3,0,"");data.setCell(3,1,0);data.setCell(3,2,true);
                                                                data.setCell(4,0,"");data.setCell(4,1,0);data.setCell(4,2,true); */
                                                                
                                                                <?= $generate_arr ?>
                                                                var options = {
                                                                    colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6']
                                                                };

                                                                var formatter = new google.visualization.NumberFormat({prefix: '$'});
                                                                formatter.format(data, 1); // Apply formatter to second column

                                                                var view = new google.visualization.DataView(data);
                                                                view.setColumns([0, 1]);

                                                                var chart = new google.visualization.BarChart(document.getElementById('chart_sort_div_2'));
                                                                chart.draw(view, options);


                                                            }
                                                </script>
                                            </div>
                                        <? } ?>
                                    </div>



                                    <div class="tab-pane <? if ($_REQUEST[tab] == '3') { ?>active<? } ?>" id="portlet_tab3">
                                        <div class="widget-body form span6" >
                                            <!-- BEGIN FORM-->
                                            <form action="#" class="form-horizontal" id="form_3" method="POST">
                                                <input type="hidden" name="tab" value="3"/>
                                                <input type="hidden" name="mode" value="generate"/>
                                                <input type="hidden" name="form-date-range3-startdate" id="form-date-range3-startdate" value="">
                                                <input type="hidden" name="form-date-range3-enddate" id="form-date-range3-enddate" value="">
                                                <div class="control-group">
                                                    <label class="control-label" >Date Ranges:</label>
                                                    <div class="controls">
                                                        <div id="form-date-range3" class="report-range-container span12">
                                                            <i class="icon-calendar icon-large"></i>&nbsp;&nbsp;<span></span> <b class="caret pull-right"></b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="input3">Search String:</label>
                                                    <div class="controls">
                                                        <input type="text" id="search_string_3" name="search_string_3" value="<?= $_REQUEST[search_string_3] ?>" class="span12"/>
                                                    </div>
                                                </div>

                                                <div style="height: 45px;"></div>

                                                <div class="form-actions">
                                                    <a href="#" class="btn btn-success" onclick="$('#form_3').submit();
                                                            return false;"><i class="icon-check"></i> Generate Report</a>
                                                </div>
                                            </form>

                                        </div>

                                        <div class="widget-body form span6">
                                        </div>



                                        <? if (($_REQUEST[tab] == '3') && ($_REQUEST[mode] == 'generate')) { ?>
                                            <div class="clearfix"></div>
                                            <br><br>
                                            <div class="widget-body form">
                                                <table class="table table-striped table-bordered" id="sample_3">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Publisher</th>
                                                            <th>App Name</th>
                                                            <th>Referrer</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?
                                                        $i = 0;
                                                        
                                                        $sql = "SELECT u.id as publisher_id,u.user_first_name,u.user_last_name, p.id as proj_id , p.proj_name, pd.download_datetime, pd.download_referer_url 
                                                                FROM projects p, users u, projects_downloads pd 
                                                                WHERE p.id=pd.proj_id AND 
                                                                u.id=p.assigned_user_id AND
                                                                (
                                                                    p.proj_name LIKE '%{$_REQUEST[search_string_3]}%' OR
                                                                    pd.download_referer_url LIKE '%{$_REQUEST[search_string_3]}%' OR
                                                                    u.user_first_name LIKE '%{$_REQUEST[search_string_3]}%' OR
                                                                    u.user_last_name LIKE '%{$_REQUEST[search_string_3]}%' 
                                                                ) AND
                                                                CAST(pd.download_datetime as DATE)>='{$_REQUEST['form-date-range3-startdate']}' AND 
                                                                CAST(pd.download_datetime as DATE)<='{$_REQUEST['form-date-range3-enddate']}'                            
                                                                ";
                                                        

                                                                
                                                        //var_dump($sql);  exit;
                                                        
                                                        $q = mysql_query($sql);
                                                        while ($row = mysql_fetch_assoc($q)) {
                                                            ?>
                                                            <tr class="odd gradeX">
                                                                <td class="highlight"><div class="success"></div><?= $row[download_datetime] ?></td>
                                                                <td><a href="pub_edit.php?id=<?= $row[publisher_id] ?>"><?= $row[user_first_name] . ' ' . $row[user_last_name] ?></a></td>
                                                                <td><a href="camp_edit.php?cid=<?= $row[proj_id] ?>"><?= $row[proj_name] ?></a></td>
                                                                <td><a href="<?= $row[download_referer_url] ?>"><?= $row[download_referer_url] ?></a></td>
                                                            </tr>
                                                            <?
                                                            $i++;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                                <br><br>
                                            </div>
                                        <? } ?>
                                    </div>


   
                                    <div class="tab-pane <? if ($_REQUEST[tab] == '4') { ?>active<? } ?>" id="portlet_tab4">
                                        <div class="widget-body form span6" >
                                            <!-- BEGIN FORM-->
                                            <form action="#" class="form-horizontal" id="form_4" method="POST">
                                                <input type="hidden" name="tab" value="4"/>
                                                <input type="hidden" name="mode" value="generate"/>
                                                <input type="hidden" name="form-date-range4-startdate" id="form-date-range4-startdate" value="">
                                                <input type="hidden" name="form-date-range4-enddate" id="form-date-range4-enddate" value="">
                                                <div class="control-group">
                                                    <label class="control-label" >Date Ranges:</label>
                                                    <div class="controls">
                                                        <div id="form-date-range4" class="report-range-container span12">
                                                            <i class="icon-calendar icon-large"></i>&nbsp;&nbsp;<span></span> <b class="caret pull-right"></b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="input3">Search String:</label>
                                                    <div class="controls">
                                                        <input type="text" id="search_string_4" name="search_string_4" value="<?= $_REQUEST[search_string_4] ?>" class="span12"/>
                                                    </div>
                                                </div>

                                                <div style="height: 45px;"></div>

                                                <div class="form-actions">
                                                    <a href="#" class="btn btn-success" onclick="$('#form_4').submit();
                                                            return false;"><i class="icon-check"></i> Generate Report</a>
                                                </div>
                                            </form>

                                        </div>

                                        <div class="widget-body form span6">
                                            <!-- BEGIN FORM-->
                                            <div id="chart_sort_div_4" ></div>
                                        </div>



                                        <? if (($_REQUEST[tab] == '4') && ($_REQUEST[mode] == 'generate')) { ?>
                                            <div class="clearfix"></div>
                                            <br><br>
                                            <div class="widget-body form">
                                                <table class="table table-striped table-bordered" id="sample_4">
                                                    <thead>
                                                        <tr>
                                                            <th>CID</th>
                                                            <th>Manager</th>
                                                            <th>Publisher</th>
                                                            <th>Campaign</th>
                                                            <th>Clicks</th>                                                            
                                                            <th>Installs Started</th>                                                            
                                                            <th>Installs Completed</th>
                                                            <th>Revenue</th>
                                                            <th>RPI</th>
                                                            <th>EPC</th>
                                                            <th>Network Revenue</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?
                                                        $i = 0;

$tmp_id = (int)$_REQUEST[search_string_4];

$sql = "
SELECT  pum.proj_id, pum.proj_name,pum.user_first_name, pum.user_last_name, pum.manager_id,pum.manager_first_name, pum.manager_last_name, piiop.total, piiop.AM_revenue, 
        piiop.pub_revenue, piiop.PM_revenue, piiop.network_revenue, 
        (
            SELECT COUNT(pd.id) FROM projects_downloads pd 
            WHERE pd.proj_id=pum.proj_id AND
                CAST(pd.download_datetime as DATE)>='{$_REQUEST['form-date-range4-startdate']}' AND CAST(pd.download_datetime as DATE)<='{$_REQUEST['form-date-range4-enddate']}'    
            GROUP BY pd.proj_id 
        ) as clicks, 
        (
            SELECT COUNT(ip.id) FROM install_projects ip 
            WHERE ip.proj_id=pum.proj_id AND install_state=0 AND
                CAST(ip.install_datetime as DATE)>='{$_REQUEST['form-date-range4-startdate']}' AND CAST(ip.install_datetime as DATE)<='{$_REQUEST['form-date-range4-enddate']}'    
            GROUP BY ip.proj_id
        ) as install_started,  
        (
            SELECT COUNT(ip.id) FROM install_projects ip 
            WHERE ip.proj_id=pum.proj_id AND install_state=1 AND
                CAST(ip.install_datetime as DATE)>='{$_REQUEST['form-date-range4-startdate']}' AND CAST(ip.install_datetime as DATE)<='{$_REQUEST['form-date-range4-enddate']}'    
            GROUP BY ip.proj_id
        ) as install_successed 
        
FROM    (SELECT p.id as proj_id, p.proj_name, um.user_id,um.user_first_name,um.user_last_name,um.manager_id,um.manager_first_name,um.manager_last_name
        FROM projects p , (SELECT u1.id as user_id,u1.subid as user_subid, u1.user_first_name,u1.user_last_name, u2.id as manager_id,u2.user_first_name as manager_first_name, u2.user_last_name as manager_last_name FROM users u1, users u2 WHERE u1.user_manager=u2.id) um 
        WHERE   um.user_id=p.assigned_user_id AND
                (
                    p.proj_name LIKE '%{$_REQUEST[search_string_4]}%' OR
                    um.user_first_name LIKE '%{$_REQUEST[search_string_4]}%' OR
                    um.user_last_name LIKE '%{$_REQUEST[search_string_4]}%' OR
                    um.manager_first_name LIKE '%{$_REQUEST[search_string_4]}%' OR
                    um.manager_last_name LIKE '%{$_REQUEST[search_string_4]}%' OR
                    um.user_subid={$tmp_id}
                )         
        ) pum 
LEFT JOIN   (SELECT p.assigned_user_id, iio.proj_id, SUM(uuo.offer_price) as total,SUM(uuo.offer_price*uuo.AM_revenue/100) as AM_revenue, SUM(uuo.offer_price*uup.pub_revenue/100) as pub_revenue, SUM(uuo.offer_price*uup.PM_revenue/100) as PM_revenue, SUM(uuo.offer_price*(100-uuo.AM_revenue-uup.pub_revenue-uup.PM_revenue)/100) as network_revenue 
            FROM    (SELECT io.id, io.offer_id, io.proj_id  FROM install_offers io 
                    WHERE io.install_state=1 AND 
                    CAST(io.install_datetime as DATE)>='{$_REQUEST['form-date-range4-startdate']}' AND 
                    CAST(io.install_datetime as DATE)<='{$_REQUEST['form-date-range4-enddate']}' 
                    ) iio , 
                    (SELECT o.id,o.offer_price,uo2.user_revenue as AM_revenue FROM offers o, users uo1, users uo2 
                    WHERE o.assigned_user_id=uo1.id AND uo1.user_manager=uo2.id 
                    ) uuo, 
                    (SELECT p.id,up1.user_revenue as pub_revenue, up2.user_revenue as PM_revenue 
                    FROM projects p, users up1, users up2 
                    WHERE   p.assigned_user_id=up1.id AND up1.user_manager=up2.id  

                    ) uup, 
                    projects p 
            WHERE iio.offer_id=uuo.id AND iio.proj_id=uup.id  AND p.id=iio.proj_id 
            GROUP BY iio.proj_id
            ) piiop
ON pum.proj_id=piiop.proj_id
ORDER BY piiop.total DESC";   
                                                                                                                
                                                        //var_dump($sql); exit;
                                                        
                                                        $q = mysql_query($sql);
                                                        
                                                        $total_clicks = 0;
                                                        $total_install_started = 0;
                                                        $total_install_successed = 0;
                                                        $total_revenue = 0;
                                                        $total_network = 0;
                                                        
                                                        while ($row = mysql_fetch_assoc($q)) {
                                                            
                                                            $total_clicks += $row[clicks];
                                                            $total_install_started += $row[install_started];
                                                            $total_install_successed += $row[install_successed];
                                                            $total_revenue += $row[total];
                                                            $total_network += $row[network_revenue];
                                                            
                                                            ?>
                                                            <tr class="odd gradeX">                                                                
                                                                <td class="highlight"><div class="success"></div><?= $row[proj_id] ?></td>
                                                                <td><?
                                                                    if ($row[manager_id] == '-1') {
                                                                        echo('Not yet assigned');
                                                                    } else {
                                                                        echo('<a href="adv_edit.php?id=' . $row[manager_id] . '">' . $row[manager_first_name] . ' ' . $row[manager_last_name] . ' </a>');
                                                                    }
                                                                    ?></td>
                                                                <td><?php echo($row[user_first_name] . " " . $row[user_last_name]);?></td>
                                                                <td><a href="camp_edit.php?cid=<?= $row[proj_id] ?>"><?= $row[proj_name]?></a></td>
                                                                <td><?php if($row[clicks] == NULL) echo "0"; else echo $row[clicks]; ?></td>
                                                                <td><?php if($row[install_started] == NULL) echo "0"; else echo $row[install_started]; ?></td>
                                                                <td><?php if($row[install_successed] == NULL) echo "0"; else echo $row[install_successed];?></td>
                                                                <td>$<?= number_format($row[total], 2, ".", ",") ?></td>
                                                                <td>$<? if(($row[install_successed]==NULL)||($row[install_successed]==0)) echo("0.00");
                                                                        else echo(number_format($row[total]/$row[install_successed], 2, ".", ","));?></td>
                                                                <td>$<? if(($row[clicks]==NULL)||($row[clicks]==0)) echo("0.00");
                                                                        else echo(number_format($row[total]/$row[clicks], 2, ".", ","));?></td>
                                                                <td>$<?= number_format($row[network_revenue], 2, ".", ",") ?></td>
                                                                
                                                            </tr>
                                                            <?
                                                            if($row[total] == NULL ) $row[total] = 0;
                                                            if ($i < 5) {
                                                                $generate_arr.="
                                                                data.setCell(" . $i . ", 0, '" . $row[proj_name]. "');
                                                                data.setCell(" . $i . ", 1, $row[total]);
                                                                data.setCell(" . $i . ", 2, true);
                                                            ";
                                                            }

                                                            $i++;
                                                        }
                                                        
                                                        //var_dump($generate_arr);exit;
                                                        ?>
                                                    </tbody>
                                                </table>
                                                <br>
                                                <table class="table table-striped table-bordered" style="margin: auto;width: 1000px;">
                                                    <thead>
                                                        <tr>
                                                            <th>&nbsp</th>
                                                            <th>Clicks</th>
                                                            <th>Install Started</th>
                                                            <th>Install Completed</th>
                                                            <th>Revenue</th>
                                                            <th>RPI</th>
                                                            <th>EPC</th>
                                                            <th>Network Revenue</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="highlight" style="color: blue;font-weight: bold;">TOTAL VALUE</td>
                                                            <td><?= $total_clicks?></td>
                                                            <td><?= $total_install_started?></td>
                                                            <td><?= $total_install_successed?></td>
                                                            <td>$<?= number_format($total_revenue, 2, ".", ",")?></td>
                                                            <td>$<?= number_format($total_revenue / $total_install_successed, 2, ".", ",")?></td>
                                                            <td>$<?= number_format($total_revenue / $total_clicks, 2, ".", ",")?></td>
                                                            <td>$<?= number_format($total_network, 2, ".", ",")?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <script>
                                                            google.load('visualization', '1.0', {'packages': ['corechart']});
                                                            google.setOnLoadCallback(drawSort);
                                                            function drawSort() {
                                                                var data = new google.visualization.DataTable();
                                                                data.addColumn('string', 'Name');
                                                                data.addColumn('number', 'Revenue');
                                                                data.addColumn('boolean', 'Full Time');
                                                                data.addRows(5);
    <?= $generate_arr ?>
                                                                var options = {
                                                                    colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6']
                                                                };

                                                                var formatter = new google.visualization.NumberFormat({prefix: '$'});
                                                                formatter.format(data, 1); // Apply formatter to second column

                                                                var view = new google.visualization.DataView(data);
                                                                view.setColumns([0, 1]);

                                                                var chart = new google.visualization.BarChart(document.getElementById('chart_sort_div_4'));
                                                                chart.draw(view, options);


                                                            }
                                                </script>
                                            </div>
                                        <? } ?>
                                    </div>


                                    
                                    <div class="tab-pane <? if ($_REQUEST[tab] == '5') { ?>active<? } ?>" id="portlet_tab5">
                                        <div class="widget-body form span6" >
                                            <!-- BEGIN FORM-->
                                            <form action="#" class="form-horizontal" id="form_5" method="POST">
                                                <input type="hidden" name="tab" value="5"/>
                                                <input type="hidden" name="mode" value="generate"/>
                                                <input type="hidden" name="form-date-range5-startdate" id="form-date-range5-startdate" value="">
                                                <input type="hidden" name="form-date-range5-enddate" id="form-date-range5-enddate" value="">
                                                <div class="control-group">
                                                    <label class="control-label" >Date Ranges:</label>
                                                    <div class="controls">
                                                        <div id="form-date-range5" class="report-range-container span12">
                                                            <i class="icon-calendar icon-large"></i>&nbsp;&nbsp;<span></span> <b class="caret pull-right"></b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="input3">Search String:</label>
                                                    <div class="controls">
                                                        <input type="text" id="search_string_5" name="search_string_5" value="<?= $_REQUEST[search_string_5] ?>" class="span12"/>
                                                    </div>
                                                </div>

                                                <div style="height: 45px;"></div>

                                                <div class="form-actions">
                                                    <a href="#" class="btn btn-success" onclick="$('#form_5').submit();
                                                            return false;"><i class="icon-check"></i> Generate Report</a>
                                                </div>
                                            </form>

                                        </div>
                                        
                                        <div class="widget-body form span6">
                                            <!-- BEGIN FORM-->
                                            <div id="chart_sort_div_5" ></div>
                                            
                                        </div>
                                        


                                        <? if (($_REQUEST[tab] == '5') && ($_REQUEST[mode] == 'generate')) { ?>
                                            <div class="clearfix"></div>
                                            <br><br>
                                            <div class="widget-body form">
                                                <table class="table table-striped table-bordered" id="sample_5">
                                                    <thead>
                                                        <tr>
                                                            <th>CID</th>
                                                            <th>Application</th>
                                                            <th>Subid #1</th>
                                                            <th>Subid #2</th>
                                                            <th>Subid #3</th>
                                                            <th>Subid #4</th> 
                                                            <th>Subid #5</th> 
                                                            <th>Clicks</th>
                                                            <th>Installs Started</th>
                                                            <th>Installs Completed</th>
                                                            <th>Revenue</th>
                                                            <th>RPI</th>
                                                            <th>EPC</th>
                                                            <th>Network Revenue</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?
                                                        $i = 0;

$sql = "
SELECT  pdid.proj_id, pdid.proj_name, pdid.download_subid1, pdid.download_subid2, pdid.download_subid3, pdid.download_subid4, pdid.download_subid5, 
        pdrev.total, pdrev.network_revenue, pdrev.uam_revenue, pdrev.up_revenue, pdrev.upm_revenue, 
        pd_inst.install_start, pd_inst.install_success, pd_clicks.clicks
FROM
    (
        SELECT p.proj_name, pd.proj_id, pd.download_subid1, pd.download_subid2, pd.download_subid3, pd.download_subid4, pd.download_subid5
        FROM projects_downloads pd, projects p
        WHERE p.id=pd.proj_id
        GROUP BY pd.proj_id, pd.download_subid1, pd.download_subid2, pd.download_subid3, pd.download_subid4, pd.download_subid5
    ) pdid 
    LEFT JOIN
    (
    SELECT       pd1.proj_id, sum(o.offer_price) as total,
                 sum(uam.user_revenue*o.offer_price)/100 as uam_revenue, sum(up.user_revenue*o.offer_price)/100 as up_revenue, sum(upm.user_revenue*o.offer_price)/100 as upm_revenue,
                 sum((100-uam.user_revenue-up.user_revenue-upm.user_revenue)*o.offer_price)/100 as network_revenue,
                 pd1.download_subid1, pd1.download_subid2, pd1.download_subid3, pd1.download_subid4, pd1.download_subid5

    FROM install_offers io, offers o, projects p, projects_downloads pd1, users ua, users uam, users up, users upm
    WHERE io.offer_id=o.id AND io.proj_id=p.id AND io.download_id=pd1.download_id AND io.install_state=1
                 AND ua.id=o.assigned_user_id AND uam.id=ua.user_manager 
                 AND up.id=p.assigned_user_id AND upm.id=up.user_manager
                 AND  CAST(io.install_datetime as DATE)>='{$_REQUEST['form-date-range5-startdate']}' AND CAST(io.install_datetime as DATE)<='{$_REQUEST['form-date-range5-enddate']}'
    GROUP BY pd1.proj_id, pd1.download_subid1, pd1.download_subid2, pd1.download_subid3, pd1.download_subid4, pd1.download_subid5
    ) pdrev 
    ON pdid.proj_id=pdrev.proj_id AND pdid.download_subid1=pdrev.download_subid1 AND pdid.download_subid2=pdrev.download_subid2 AND 
       pdid.download_subid3=pdrev.download_subid3 AND pdid.download_subid4=pdrev.download_subid4 AND pdid.download_subid5=pdrev.download_subid5

    LEFT JOIN
    ( 
    SELECT pd.proj_id, sum(if(ip1.install_state=0,1,0)) as install_start, sum(if(ip1.install_state=1,1,0)) as install_success, 
                 pd.download_subid1, pd.download_subid2, pd.download_subid3, pd.download_subid4, pd.download_subid5
    FROM projects_downloads pd 
              LEFT JOIN install_projects ip1 ON pd.download_id=ip1.download_id
    WHERE CAST(ip1.install_datetime as DATE)>='{$_REQUEST['form-date-range5-startdate']}' AND CAST(ip1.install_datetime as DATE)<='{$_REQUEST['form-date-range5-enddate']}'
    GROUP BY pd.proj_id, pd.download_subid1, pd.download_subid2, pd.download_subid3, pd.download_subid4, pd.download_subid5
    ) pd_inst
    ON pdid.proj_id=pd_inst.proj_id AND pdid.download_subid1=pd_inst.download_subid1 AND pdid.download_subid2=pd_inst.download_subid2 AND  
          pdid.download_subid3=pd_inst.download_subid3 AND pdid.download_subid4=pd_inst.download_subid4 AND 
          pdid.download_subid5=pd_inst.download_subid5
    
    LEFT JOIN
    (
    SELECT pd.proj_id, count(pd.proj_id) as clicks, pd.download_subid1, pd.download_subid2, pd.download_subid3, pd.download_subid4, pd.download_subid5 
    FROM projects_downloads pd
    WHERE CAST(pd.download_datetime as DATE)>='{$_REQUEST['form-date-range5-startdate']}' AND CAST(pd.download_datetime as DATE)<='{$_REQUEST['form-date-range5-enddate']}'           
    GROUP BY pd.proj_id, pd.download_subid1, pd.download_subid2, pd.download_subid3, pd.download_subid4, pd.download_subid5
    ) pd_clicks
    ON pdid.proj_id=pd_clicks.proj_id AND pdid.download_subid1=pd_clicks.download_subid1 AND pdid.download_subid2=pd_clicks.download_subid2 AND  
          pdid.download_subid3=pd_clicks.download_subid3 AND pdid.download_subid4=pd_clicks.download_subid4 AND 
          pdid.download_subid5=pd_clicks.download_subid5
          
WHERE          ( 
                    pdid.download_subid1 LIKE '%{$_REQUEST[search_string_5]}%' OR 
                    pdid.download_subid2 LIKE '%{$_REQUEST[search_string_5]}%' OR 
                    pdid.download_subid3 LIKE '%{$_REQUEST[search_string_5]}%' OR 
                    pdid.download_subid4 LIKE '%{$_REQUEST[search_string_5]}%' OR 
                    pdid.download_subid5 LIKE '%{$_REQUEST[search_string_5]}%' OR
                    pdid.proj_name LIKE '%{$_REQUEST[search_string_5]}%' 
                )
ORDER BY pdrev.network_revenue DESC
";
                                                                
                                                        //var_dump($sql);exit;
                                                        $q = mysql_query($sql);
                                                        
                                                        $total_clicks = 0;
                                                        $total_install_start = 0;
                                                        $total_install_success = 0;
                                                        $total_revenue = 0;
                                                        $total_network = 0;
                                                        
                                                        while ($row = mysql_fetch_assoc($q)) {
                                                            
                                                            $total_clicks += $row[clicks];
                                                            $total_install_start += $row[install_start];
                                                            $total_install_success += $row[install_success];
                                                            $total_revenue += $row[total];
                                                            $total_network += $row[network_revenue];
                                                           
                                                            ?>
                                                            <tr class="odd gradeX">
                                                                <td class="highlight"><div class="success"></div><?= $row[proj_id] ?></td>
                                                                <td><?= $row[proj_name] ?></td>
                                                                <td><?= $row[download_subid1] ?></td>
                                                                <td><?= $row[download_subid2] ?></td>
                                                                <td><?= $row[download_subid3] ?></td>
                                                                <td><?= $row[download_subid4] ?></td>
                                                                <td><?= $row[download_subid5] ?></td>
                                                                <td><? if($row[clicks]==NULL) echo "0"; else echo($row[clicks]); ?></td>
                                                                <td><? if($row[install_start]==NULL) echo "0"; else echo($row[install_start]); ?></td>
                                                                <td><? if($row[install_success]==NULL) echo "0"; else echo($row[install_success]); ?></td>
                                                                <td>$<?= number_format($row[total], 2, ".", ",")?></td>
                                                                <td>$<?= number_format($row[total]/$row[install_success], 2, ".", ",")?></td>
                                                                <td>$<?= number_format($row[total]/$row[clicks], 2, ".", ",")?></td>
                                                                <td>$<?= number_format($row[network_revenue], 2, ".", ",")?></td>
                                                            </tr>
                                                            <?
                                                            if($row[total] == NULL) $row[total] = 0;
                                                            if ($i < 5) {
                                                                $generate_arr.="
                                                                data.setCell(" . $i . ", 0, '" . $row[proj_name] . "');
                                                                data.setCell(" . $i . ", 1, $row[total]);
                                                                data.setCell(" . $i . ", 2, true);
                                                            ";
                                                            }

                                                            $i++;
                                                        }
                                                        //echo  $generate_arr;exit;
                                                        ?>
                                                    </tbody>
                                                </table>
                                                <br>
                                                
                                                <table class="table table-striped table-bordered" style="margin: auto;width: 1000px;">
                                                    <thead>
                                                        <tr>
                                                            <th>&nbsp</th>
                                                            <th>Clicks</th>
                                                            <th>Install Started</th>
                                                            <th>Install Completed</th>
                                                            <th>Revenue</th>
                                                            <th>RPI</th>
                                                            <th>EPC</th>
                                                            <th>Network Revenue</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="highlight" style="color: blue;font-weight: bold;">TOTAL VALUE</td>
                                                            <td><?= $total_clicks?></td>
                                                            <td><?= $total_install_start?></td>
                                                            <td><?= $total_install_success?></td>
                                                            <td>$<?= number_format($total_revenue, 2, ".", ",")?></td>
                                                            <td>$<?= number_format($total_revenue / $total_install_success, 2, ".", ",")?></td>
                                                            <td>$<?= number_format($total_revenue / $total_clicks, 2, ".", ",")?></td>
                                                            <td>$<?= number_format($total_network, 2, ".", ",")?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                
                                                <script>
                                                            google.load('visualization', '1.0', {'packages': ['corechart']});
                                                            google.setOnLoadCallback(drawSort);
                                                            function drawSort() {
                                                                var data = new google.visualization.DataTable();
                                                                data.addColumn('string', 'Name');
                                                                data.addColumn('number', 'Revenue');
                                                                data.addColumn('boolean', 'Full Time');
                                                                data.addRows(5);
    <?= $generate_arr ?>
                                                                var options = {
                                                                    colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6']
                                                                };

                                                                var formatter = new google.visualization.NumberFormat({prefix: '$'});
                                                                formatter.format(data, 1); // Apply formatter to second column

                                                                var view = new google.visualization.DataView(data);
                                                                view.setColumns([0, 1]);

                                                                var chart = new google.visualization.BarChart(document.getElementById('chart_sort_div_5'));
                                                                chart.draw(view, options);


                                                            }
                                                </script>
                                            </div>
                                        <? } ?>
                                    </div>



                                    <div class="tab-pane <? if ($_REQUEST[tab] == '6') { ?>active<? } ?>" id="portlet_tab6">
                                        <div class="widget-body form span6" >
                                            <!-- BEGIN FORM-->
                                            <form action="#" class="form-horizontal" id="form_6" method="POST">
                                                <input type="hidden" name="tab" value="6"/>
                                                <input type="hidden" name="mode" value="generate"/>
                                                <input type="hidden" name="form-date-range6-startdate" id="form-date-range6-startdate" value="">
                                                <input type="hidden" name="form-date-range6-enddate" id="form-date-range6-enddate" value="">
                                                <div class="control-group">
                                                    <label class="control-label" >Date Ranges:</label>
                                                    <div class="controls">
                                                        <div id="form-date-range6" class="report-range-container span12">
                                                            <i class="icon-calendar icon-large"></i>&nbsp;&nbsp;<span></span> <b class="caret pull-right"></b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="input3">Search String:</label>
                                                    <div class="controls">
                                                        <input type="text" id="search_string_6" name="search_string_6" value="<?= $_REQUEST[search_string_6] ?>" class="span12"/>
                                                    </div>
                                                </div>

                                                <div style="height: 45px;"></div>

                                                <div class="form-actions">
                                                    <a href="#" class="btn btn-success" onclick="$('#form_6').submit();
                                                            return false;"><i class="icon-check"></i> Generate Report</a>
                                                </div>
                                            </form>

                                        </div>

                                        <div class="widget-body form span6">
                                            <!-- BEGIN FORM-->
                                            <div id="chart_sort_div_6" ></div>
                                        </div>



                                        <? if (($_REQUEST[tab] == '6') && ($_REQUEST[mode] == 'generate')) { ?>
                                            <div class="clearfix"></div>
                                            <br><br>
                                            <div class="widget-body form">
                                                <table class="table table-striped table-bordered" id="sample_6">
                                                    <thead>
                                                        <tr>
                                                            <th>Country</th>
                                                            <th>Clicks</th>
                                                            <th>Installs Started</th>
                                                            <th>Installs Completed</th>
                                                            <th>Revenue</th>
                                                            <th>RPI</th>
                                                            <th>EPC</th>
                                                            <th>Network Revenue</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?
                                                        $i = 0;
/*
$sql = "
SELECT  di.download_country_code, COUNT(di.download_id) as clicks, SUM(dr.total) as total, SUM(dr.AM_revenue) as AM_revenue, SUM(dr.PM_revenue) as PM_revenue , SUM(dr.pub_revenue) as pub_revenue, SUM(dr.network_revenue) as network_revenue 
        ,SUM(di.install_started) as install_started, SUM(di.install_successed) as install_successed
FROM    (SELECT pd.download_id, pd.download_country_code, 
            (
                SELECT count(ip.id) FROM install_projects ip 
                WHERE ip.download_id=pd.download_id AND ip.install_state=0 AND
                    CAST(ip.install_datetime as DATE)>='{$_REQUEST['form-date-range6-startdate']}' AND CAST(ip.install_datetime as DATE)<='{$_REQUEST['form-date-range6-enddate']}'    
            ) as install_started , 
            (
                SELECT count(ip.id) FROM install_projects ip 
                WHERE ip.download_id=pd.download_id AND ip.install_state=1 AND
                    CAST(ip.install_datetime as DATE)>='{$_REQUEST['form-date-range6-startdate']}' AND CAST(ip.install_datetime as DATE)<='{$_REQUEST['form-date-range6-enddate']}'    
            ) as install_successed 
        FROM projects_downloads pd, projects p 
        WHERE  p.id=pd.proj_id AND
               (
                    pd.download_country LIKE '%{$_REQUEST[search_string_6]}%' OR 
                    pd.download_country_code LIKE '%{$_REQUEST[search_string_6]}%' OR
                    p.proj_name LIKE '%{$_REQUEST[search_string_6]}%' 
               ) AND
               CAST(pd.download_datetime as DATE)>='{$_REQUEST['form-date-range6-startdate']}' AND CAST(pd.download_datetime as DATE)<='{$_REQUEST['form-date-range6-enddate']}'
        )  di 
LEFT JOIN   (SELECT io.download_id,io.proj_id, io.offer_id, SUM(o.offer_price) as total, SUM(o.offer_price*um.user_revenue/100) as pub_revenue, 
                SUM(o.offer_price*um.manager_revenue/100) as PM_revenue, SUM(o.offer_price*um1.manager_revenue/100) as AM_revenue, 
                SUM(o.offer_price*(100-um.user_revenue-um.manager_revenue-um1.manager_revenue)/100) as network_revenue 
             FROM install_offers io, projects p, offers o, 
                (SELECT u1.id as user_id, u1.user_revenue , u2.user_revenue as manager_revenue FROM users u1, users u2 WHERE u1.user_manager=u2.id) um, 
                (SELECT u1.id as user_id, u1.user_revenue , u2.user_revenue as manager_revenue FROM users u1, users u2 WHERE u1.user_manager=u2.id) um1 
             WHERE p.id=io.proj_id AND um.user_id=p.assigned_user_id AND o.id=io.offer_id AND o.assigned_user_id=um1.user_id AND io.install_state=1 
                AND CAST(io.install_datetime as DATE)>='{$_REQUEST['form-date-range6-startdate']}' AND CAST(io.install_datetime as DATE)<='{$_REQUEST['form-date-range6-enddate']}'  
             GROUP BY io.download_id
             ) dr
ON dr.download_id=di.download_id
GROUP BY di.download_country_code
ORDER BY total DESC";
*/

$sql = "
SELECT  pd_code.download_country_code, pd_code.download_country, 
        pd_inst.install_started, pd_inst.install_successed,
        pd_rev.total, pd_rev.network_revenue, pd_clicks.clicks
FROM
    (
    SELECT p.proj_name, pd.download_country_code, pd.download_country 
    FROM projects_downloads pd, projects p 
    WHERE pd.proj_id=p.id
    GROUP BY pd.download_country_code
    ) pd_code
    LEFT JOIN 
    (
    SELECT pd.download_country_code, pd.proj_id, sum(if(ip1.install_state=0,1,0)) as install_started, sum(if(ip1.install_state=1,1,0)) as install_successed                 
        FROM projects_downloads pd 
        LEFT JOIN install_projects ip1 ON pd.download_id=ip1.download_id
        WHERE CAST(ip1.install_datetime as DATE)>='{$_REQUEST['form-date-range6-startdate']}' AND CAST(ip1.install_datetime as DATE)<='{$_REQUEST['form-date-range6-enddate']}'
    GROUP BY pd.download_country_code
     ) pd_inst
    ON pd_code.download_country_code=pd_inst.download_country_code
    LEFT JOIN
    (
    SELECT pd.download_country_code, pd.download_id, io.offer_id, io.install_state, sum(o.offer_price) as total,
           sum(uam.user_revenue*o.offer_price)/100 as uam_revenue, sum(up.user_revenue*o.offer_price)/100 as up_revenue, sum(upm.user_revenue*o.offer_price)/100 as upm_revenue, sum((100-uam.user_revenue-up.user_revenue-upm.user_revenue)*o.offer_price)/100 as network_revenue 
    FROM projects_downloads pd, install_offers io, offers o, projects p, users ua, users uam, users up, users upm
    WHERE pd.download_id=io.download_id AND io.offer_id=o.id AND io.proj_id=p.id AND io.install_state=1 
    AND o.assigned_user_id=ua.id AND ua.user_manager=uam.id AND p.assigned_user_id=up.id AND up.user_manager=upm.id 
    AND CAST(io.install_datetime as DATE)>='{$_REQUEST['form-date-range6-startdate']}' AND CAST(io.install_datetime as DATE)<='{$_REQUEST['form-date-range6-enddate']}'
    GROUP BY pd.download_country_code
    ) pd_rev
    ON pd_code.download_country_code=pd_rev.download_country_code
    LEFT JOIN
    (
    SELECT pd.download_country_code, count(pd.download_country_code) as clicks 
    FROM projects_downloads pd 
    WHERE CAST(pd.download_datetime as DATE)>='{$_REQUEST['form-date-range6-startdate']}' AND CAST(pd.download_datetime as DATE)<='{$_REQUEST['form-date-range6-enddate']}'
    ) pd_clicks
    ON pd_code.download_country_code=pd_clicks.download_country_code
WHERE   pd_code.download_country LIKE '%{$_REQUEST[search_string_6]}%' OR 
        pd_code.download_country_code LIKE '%{$_REQUEST[search_string_6]}%' OR
        pd_code.proj_name LIKE '%{$_REQUEST[search_string_6]}%'
ORDER BY pd_rev.network_revenue DESC
";

                                                        
                                                        //var_dump($sql); exit;
                                                        $q = mysql_query($sql);
                                                        
                                                        $total_clicks = 0;
                                                        $total_install_started = 0;
                                                        $total_install_successed = 0;
                                                        $total_revenue = 0;
                                                        $total_network = 0;
                                                        
                                                        while ($row = mysql_fetch_assoc($q)) {
                                                            
                                                            $total_clicks += $row[clicks];
                                                            $total_install_started += $row[install_started];
                                                            $total_install_successed += $row[install_successed];
                                                            $total_revenue += $row[total];
                                                            $total_network += $row[network_revenue];
                                                            ?>
                                                            <tr class="odd gradeX">
                                                                <td class="highlight"><div class="success"></div><?= $row[download_country_code] ?></td>
                                                                <td><? if($row[clicks] == NULL) echo "0"; else echo($row[clicks]);?></td>
                                                                <td><? if($row[install_started] == NULL) echo "0"; else echo($row[install_started]);?></td>
                                                                <td><? if($row[install_successed] == NULL) echo "0"; else echo($row[install_successed]);?></td>
                                                                <td>$<?= number_format($row[total], 2, ".", ",") ?></td>
                                                                <td><?= number_format($row[total]/$row[install_successed], 2, ".", ",") ?></td>
                                                                <td><?= number_format($row[total]/$row[clicks], 2, ".", ",")?></td>
                                                                <td><?= number_format($row[network_revenue], 2, ".", ",")?></td>
                                                            </tr>
                                                            <?
                                                            if ($row[total]==NULL) $row[total] = 0;
                                                            if ($i < 5) {
                                                                $generate_arr.="
                                                                data.setCell(" . $i . ", 0, '" . $row[download_country_code] . "');
                                                                data.setCell(" . $i . ", 1, $row[total] );
                                                                data.setCell(" . $i . ", 2, true);
                                                            ";
                                                            }

                                                            $i++;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                                <br>
                                                
                                                <table class="table table-striped table-bordered" style="margin: auto;width: 1000px;">
                                                    <thead>
                                                        <tr>
                                                            <th>&nbsp</th>
                                                            <th>Clicks</th>
                                                            <th>Install Started</th>
                                                            <th>Install Completed</th>
                                                            <th>Revenue</th>
                                                            <th>RPI</th>
                                                            <th>EPC</th>
                                                            <th>Network Revenue</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td class="highlight" style="color: blue;font-weight: bold;">TOTAL VALUE</td>
                                                        <td><?= $total_clicks?></td>
                                                        <td><?= $total_install_started?></td>
                                                        <td><?= $total_install_successed?></td>
                                                        <td>$<?= number_format($total_revenue, 2, ".", ",")?></td>
                                                        <td>$<?= number_format($total_revenue / $total_install_successed, 2, ".", ",")?></td>
                                                        <td>$<?= number_format($total_revenue / $total_clicks, 2, ".", ",")?></td>
                                                        <td>$<?= number_format($total_network, 2, ".", ",")?></td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                                <script>
                                                            google.load('visualization', '1.0', {'packages': ['corechart']});
                                                            google.setOnLoadCallback(drawSort);
                                                            function drawSort() {
                                                                var data = new google.visualization.DataTable();
                                                                data.addColumn('string', 'Name');
                                                                data.addColumn('number', 'Revenue');
                                                                data.addColumn('boolean', 'Full Time');
                                                                data.addRows(5);
    <?= $generate_arr ?>
                                                                var options = {
                                                                    colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6']
                                                                };

                                                                var formatter = new google.visualization.NumberFormat({prefix: '$'});
                                                                formatter.format(data, 1); // Apply formatter to second column

                                                                var view = new google.visualization.DataView(data);
                                                                view.setColumns([0, 1]);

                                                                var chart = new google.visualization.BarChart(document.getElementById('chart_sort_div_6'));
                                                                chart.draw(view, options);


                                                            }
                                                </script>
                                            </div>
                                        <? } ?>
                                    </div>
                                    
                                    
                                    
                                    <div class="tab-pane <? if ($_REQUEST[tab] == '7') { ?>active<? } ?>" id="portlet_tab7">
                                        <div class="widget-body form span6" >
                                            
                                            <!-- BEGIN FORM-->
                                            <form action="#" class="form-horizontal" id="form_7" method="POST">
                                                <input type="hidden" name="tab" value="7"/>
                                                <input type="hidden" name="mode" value="generate"/>
                                                <input type="hidden" name="form-date-range7-startdate" id="form-date-range7-startdate" value="">
                                                <input type="hidden" name="form-date-range7-enddate" id="form-date-range7-enddate" value="">
                                                <div class="control-group">
                                                    <label class="control-label" >Date Ranges:</label>
                                                    <div class="controls">
                                                        <div id="form-date-range7" class="report-range-container span12">
                                                            <i class="icon-calendar icon-large"></i>&nbsp;&nbsp;<span></span> <b class="caret pull-right"></b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="input3">Search String:</label>
                                                    <div class="controls">
                                                        <input type="text" id="search_string_7" name="search_string_7" value="<?= $_REQUEST[search_string_7] ?>" class="span12"/>
                                                    </div>
                                                </div>                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="input3">Search Campign:</label>
                                                    <div class="controls">
                                                        <select class="span6 chosen" name='campign_list_7' style="width: 150px;">
                                                            <option value="-1" selected>&nbsp;</option>                                                            
                                                            <?
                                                            $sql1 = "SELECT * FROM projects";
                                                            $q1 = mysql_query($sql1);
                                                            while ($row1 = mysql_fetch_assoc($q1)) {
                                                                ?>
                                                                <option value="<?= $row1[id] ?>"><?= $row1[proj_name]?></option>
                                                            <? } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div style="height: 45px;"></div>

                                                <div class="form-actions">
                                                    <a href="#" class="btn btn-success" onclick="$('#form_7').submit();
                                                            return false;"><i class="icon-check"></i> Generate Report</a>
                                                </div>
                                            </form>

                                        </div>

                                        <div class="widget-body form span6">
                                            <!-- BEGIN FORM-->
                                            <div id="chart_sort_div_1" ></div>
                                        </div>



                                        <? if (($_REQUEST[tab] == '7') && ($_REQUEST[mode] == 'generate')) { ?>
                                            <div class="clearfix"></div>
                                            <br><br>
                                            <div class="widget-body form">
                                                <table class="table table-striped table-bordered" id="sample_1">
                                                    <thead>
                                                        <tr>
                                                            <th>Template</th>
                                                            <th>Install Started</th>
                                                            <th>Install Successful</th>
                                                            <th>Revenue</th>
                                                            <th>RPI</th>                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?
                                                        $i = 0;  
  
$tmp_id = (int)$_REQUEST[search_string_1];

$campign = $_REQUEST[campign_list_7];
if($campign == -1)
{
$sql = "
SELECT tt.*, (tt.revenue/tt.install_successed) as rpi  
FROM
    (SELECT t.name, 
        (
            SELECT count(id) FROM install_projects 
            WHERE template_id=t.id AND install_state=0 AND
                  CAST(install_datetime as DATE)>='{$_REQUEST['form-date-range7-startdate']}' AND 
                  CAST(install_datetime as DATE)<='{$_REQUEST['form-date-range7-enddate']}'
        ) as install_started, 
        (
            SELECT count(id) FROM install_projects 
            WHERE template_id=t.id AND install_state=1 AND
                  CAST(install_datetime as DATE)>='{$_REQUEST['form-date-range7-startdate']}' AND 
                  CAST(install_datetime as DATE)<='{$_REQUEST['form-date-range7-enddate']}'
        ) as install_successed, 
        (
            SELECT sum(o.offer_price) FROM offers o, install_offers io 
            WHERE o.id=io.offer_id AND io.install_state=1 AND io.template_id=t.id AND
                CAST(io.install_datetime as DATE)>='{$_REQUEST['form-date-range7-startdate']}' AND 
                CAST(io.install_datetime as DATE)<='{$_REQUEST['form-date-range7-enddate']}'
        ) as revenue 
        FROM templates t 
        WHERE t.name LIKE '%{$_REQUEST[search_string_7]}%'
    ) tt";
}
else
{
$sql = "
SELECT tt.*, (tt.revenue/tt.install_successed) as rpi  
FROM
    (SELECT t.name, 
        (
            SELECT count(id) FROM install_projects 
            WHERE template_id=t.id AND install_state=0 AND
                  CAST(install_datetime as DATE)>='{$_REQUEST['form-date-range7-startdate']}' AND 
                  CAST(install_datetime as DATE)<='{$_REQUEST['form-date-range7-enddate']}' AND
                  proj_id={$campign}
        ) as install_started, 
        (
            SELECT count(id) FROM install_projects 
            WHERE template_id=t.id AND install_state=1 AND
                  CAST(install_datetime as DATE)>='{$_REQUEST['form-date-range7-startdate']}' AND 
                  CAST(install_datetime as DATE)<='{$_REQUEST['form-date-range7-enddate']}' AND
                  proj_id={$campign}
        ) as install_successed, 
        (
            SELECT sum(o.offer_price) FROM offers o, install_offers io 
            WHERE o.id=io.offer_id AND io.install_state=1 AND io.template_id=t.id AND
                CAST(io.install_datetime as DATE)>='{$_REQUEST['form-date-range7-startdate']}' AND 
                CAST(io.install_datetime as DATE)<='{$_REQUEST['form-date-range7-enddate']}' AND
                io.proj_id={$campign}
        ) as revenue 
        FROM templates t 
        WHERE t.name LIKE '%{$_REQUEST[search_string_7]}%'
    ) tt";
}
                                                    
                                                        //var_dump($sql);exit;
                                                        $q = mysql_query($sql);
                                                        
                                                        $total_install_started = 0;
                                                        $total_install_successed = 0;
                                                        $total_revenue = 0;
                                                        $total_rpi = 0;
                                                        
                                                        while ($row = mysql_fetch_assoc($q)) { 
                                                            $total_install_started += $row[install_started];
                                                            $total_install_successed += $row[install_successed];                                                            
                                                            $total_revenue += $row[revenue];
                                                                                                                       
                                                            ?>
                                                            <tr class="odd gradeX">
                                                                <td class="highlight"><div class="success"></div><?= $row[name] ?></td>                                                                 
                                                                <th><?= $row[install_started] ?></th>
                                                                <th><?= $row[install_successed] ?></th>
                                                                <td>$<?= number_format($row[revenue],2) ?></td>
                                                                <td>$<?= number_format($row[rpi],2) ?></td>                                                                
                                                            </tr>
                                                            <?
                                                            if ($row[revenue] == NULL) $row[revenue] = 0;
                                                            if ($i < 5) {
                                                                $generate_arr.="
                                                                    data.setCell(" . $i . ", 0, '" . $row[name] . "');
                                                                    data.setCell(" . $i . ", 1, " . $row[revenue] . ");
                                                                    data.setCell(" . $i . ", 2, true);
                                                                ";
                                                            }

                                                            $i++;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                                <br>
                                                <table class="table table-striped table-bordered" style="margin: auto;width: 800px;">
                                                    <thead>
                                                        <tr>
                                                            <th>&nbsp</th>
                                                            <th>Install Started</th>
                                                            <th>Install Successed</th>
                                                            <th>Revenue</th>
                                                            <th>RPI</th>                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="highlight" style="color: blue;font-weight: bold;">TOTAL VALUE</td>
                                                            <td><?= $total_install_started?></td>
                                                            <td><?= $total_install_successed?></td>
                                                            <td>$<?= number_format($total_revenue,2)?></td>
                                                            <td>$<?= number_format($total_revenue/$total_install_successed,2) ?></td>                                                            
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                      

                                                <script>
                                                            //$('#form-date-range7-startdate').val(start.toString('yyyy-MM-dd'));
                                                            
                                                            
                                                            google.load('visualization', '1.0', {'packages': ['corechart']});
                                                            google.setOnLoadCallback(drawSort1);
                                                            function drawSort1() {
                                                                var data = new google.visualization.DataTable();
                                                                data.addColumn('string', 'Name');
                                                                data.addColumn('number', 'Revenue');
                                                                data.addColumn('boolean', 'Full Time');
                                                                data.addRows(5);
                                                                
                                                                <?= $generate_arr ?>
                                                                var options = {
                                                                    colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6']
                                                                };

                                                                var formatter = new google.visualization.NumberFormat({prefix: '$'});
                                                                formatter.format(data, 1); // Apply formatter to second column

                                                                var view = new google.visualization.DataView(data);
                                                                view.setColumns([0, 1]);

                                                                var chart = new google.visualization.BarChart(document.getElementById('chart_sort_div_1'));
                                                                chart.draw(view, options);


                                                            }
                                                </script>
                                            </div>
                                        <? } ?>
                                    </div>
                                    
                                    
                                    
                                    <div class="tab-pane <? if ($_REQUEST[tab] == '8')  { ?>active<? } ?>" id="portlet_tab8">
                                        <div class="widget-body form" >
                                            
                                            <!-- BEGIN FORM-->
                                            <form action="#" class="form-horizontal" id="form_8" method="POST">
                                                <input type="hidden" name="tab" value="8"/>
                                                <input type="hidden" name="mode" value="generate"/>
                                                <input type="hidden" name="form-date-range8-startdate" id="form-date-range8-startdate" value="">
                                                <input type="hidden" name="form-date-range8-enddate" id="form-date-range8-enddate" value="">
                                                <div class="control-group" style="margin-bottom: 10px;">
                                                    <label class="control-label" >Date Ranges:</label>
                                                    <div class="controls">
                                                        <div id="form-date-range8" class="report-range-container span5">
                                                            <i class="icon-calendar icon-large"></i>&nbsp;&nbsp;<span></span> <b class="caret pull-right"></b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group" style="margin-bottom: 5px; float: left;">
                                                    <label class="control-label" for="input3">Advertiser:</label>
                                                    <div class="controls">
                                                        <input type="text" id="advertiser_8" name="advertiser_8" value="<?= $_REQUEST[advertiser_8] ?>" class=""/>
                                                    </div>
                                                </div>    
                                                
                                                <div class="control-group" style="margin-bottom: 5px;">
                                                    <label class="control-label" for="input3">Publisher:</label>
                                                    <div class="controls">
                                                        <input type="text" id="publisher_8" name="publisher_8" value="<?= $_REQUEST[publisher_8] ?>" class=""/>
                                                    </div>
                                                </div>                                  
                                                
                                                <div class="control-group" style="margin-bottom: 5px; float: left;">
                                                    <label class="control-label" for="input3">Campign:</label>
                                                    <div class="controls">
                                                        <input type="text" id="campign_8" name="campign_8" value="<?= $_REQUEST[campign_8] ?>" class=""/>
                                                    </div>
                                                </div>          
                                                
                                                <div class="control-group" style="margin-bottom: 5px;">
                                                    <label class="control-label" for="input3">Subid:</label>
                                                    <div class="controls">
                                                        <input type="text" id="subid_8" name="subid_8" value="<?= $_REQUEST[subid_8] ?>" class=""/>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group" style="margin-bottom: 5px;">
                                                    <label class="control-label" for="input3">Country:</label>
                                                    <div class="controls">
                                                        <input type="text" id="Country_8" name="Country_8" value="<?= $_REQUEST[Country_8] ?>" class=""/>
                                                    </div>
                                                </div>
                                                
                                                
                                                

                                                <div style="height: 45px;"></div>

                                                <div class="form-actions">
                                                    <a href="#" class="btn btn-success" onclick="$('#form_8').submit();
                                                            return false;"><i class="icon-check"></i> Generate Report</a>
                                                </div>
                                            </form>

                                        </div>

                                        <div class="widget-body form ">
                                            <!-- BEGIN FORM-->
                                            <div id="chart_sort_div_8" ></div>
                                        </div>
             
                                        <? if (($_REQUEST[tab] == '8') || ($_REQUEST[tab] == '') && ($_REQUEST[mode] == 'generate')) { ?>
                                            <div class="clearfix"></div>
                                            <br><br>
                                            <div class="widget-body form">
                                                <table class="table table-striped table-bordered" id="sample_8">
                                                    <thead>
                                                        <tr>
                                                            <th>Time</th>
                                                            <th>Clicks</th>
                                                            <th>Install Started</th>
                                                            <th>Install Completed</th>
                                                            <th>Revenue</th>
                                                            <th>RPI</th>
                                                            <th>EPC</th>
                                                            <th>Network Revenue</th>                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?
                                                        $i = 0;  
  
$adv = $_REQUEST[advertiser_8];
$pub = $_REQUEST[publisher_8];
$camp = $_REQUEST[campign_8];
$subid = $_REQUEST[subid_8];
$country = $_REQUEST[Country_8];

$clicks = 0;
$install_started = 0;
$install_completed = 0;
$revenue = 0.0;
$rpi = 0.0;
$epc = 0.0;
$network_revenue = 0.0;

$total_clicks = 0;
$total_install_started = 0;
$total_install_successed = 0;
$total_revenue = 0;
$total_network = 0;

$max_rev = 0;

$time_arr = array("midnight-1AM", "1AM-2AM", "2AM-3AM", "3AM-4AM", "4AM-5AM", "5AM-6AM", "6AM-7AM", "7AM-8AM", "8AM-9AM", "9AM-10AM", "10AM-11AM", "11AM-12PM",
                    "12PM-1PM", "1PM-2PM", "2PM-3PM", "3PM-4PM", "4PM-5PM", "5PM-6PM", "6PM-7PM", "7PM-8PM", "8PM-9PM", "9PM-10PM", "10PM-11PM", "11PM-midnight" ) ;
                    
$str_gen = "var revenue = [";

for($nHour=0; $nHour<24; $nHour++)
{
    if($adv != "")
    {
        // if advertiser filter is used, then get offer install started and install completed
        $sql = "SELECT count(u1.id) as install_started 
                FROM install_offers io1, users u1, offers o1 
                WHERE hour(io1.install_datetime)={$nHour} AND io1.install_state=0 AND o1.id=io1.offer_id AND 
                o1.assigned_user_id=u1.id AND (u1.user_first_name LIKE '%{$adv}%' OR u1.user_last_name LIKE '%{$adv}%') AND
                CAST(io1.install_datetime as DATE)>='{$_REQUEST['form-date-range8-startdate']}' AND 
                CAST(io1.install_datetime as DATE)<='{$_REQUEST['form-date-range8-enddate']}'";
        $q = mysql_query($sql);
        $row = mysql_fetch_assoc($q);
        $install_started = $row[install_started];
        
        
        $sql = "SELECT count(u1.id) as install_completed 
                FROM install_offers io1, users u1, offers o1 
                WHERE hour(io1.install_datetime)={$nHour} AND io1.install_state=1 AND o1.id=io1.offer_id AND 
                o1.assigned_user_id=u1.id AND (u1.user_first_name LIKE '%{$adv}%' OR u1.user_last_name LIKE '%{$adv}%') AND
                CAST(io1.install_datetime as DATE)>='{$_REQUEST['form-date-range8-startdate']}' AND 
                CAST(io1.install_datetime as DATE)<='{$_REQUEST['form-date-range8-enddate']}'";
        $q = mysql_query($sql);
        $row = mysql_fetch_assoc($q);
        $install_completed = $row[install_completed];   
        
        $sql = "SELECT sum(o1.offer_price) as advertiser_revenue 
                FROM install_offers io1, offers o1, users u1 
                WHERE io1.offer_id=o1.id AND io1.install_state=1 AND hour(io1.install_datetime)={$nHour} AND 
                u1.id=o1.assigned_user_id AND (u1.user_first_name LIKE '%{$adv}%' OR u1.user_last_name LIKE '%{$adv}%') AND
                CAST(io1.install_datetime as DATE)>='{$_REQUEST['form-date-range8-startdate']}' AND 
                CAST(io1.install_datetime as DATE)<='{$_REQUEST['form-date-range8-enddate']}' ";
        $q = mysql_query($sql);
        $row = mysql_fetch_assoc($q);
        $revenue = $row[advertiser_revenue]; 
        if($revenue == NULL) $revenue = 0;
        
        $sql = "SELECT SUM(o1.offer_price* (100-u2.user_revenue- u3.user_revenue- u4.user_revenue)/100) as network_rev 
                FROM install_offers io1, offers o1, users u1, users u2, projects p1, users u3, users u4 
                WHERE io1.offer_id=o1.id AND io1.install_state=1 AND hour(io1.install_datetime)={$nHour} AND u1.id=o1.assigned_user_id AND 
                (u1.user_first_name LIKE '%{$adv}%' OR u1.user_last_name LIKE '%{$adv}%') AND 
                u1.user_manager=u2.id AND io1.proj_id=p1.id AND p1.assigned_user_id=u3.id AND u3.user_manager=u4.id AND
                CAST(io1.install_datetime as DATE)>='{$_REQUEST['form-date-range8-startdate']}' AND 
                CAST(io1.install_datetime as DATE)<='{$_REQUEST['form-date-range8-enddate']}'";
        $q = mysql_query($sql);
        $row = mysql_fetch_assoc($q);
        $network_revenue = $row[network_rev];  
        if($network_revenue == NULL) $network_revenue = 0;       
    }  
    else if($pub != "")
    {
        $sql = "SELECT count(pd.proj_id) as clicks
                FROM projects_downloads pd, projects p, users u 
                WHERE hour(pd.download_datetime)={$nHour} AND p.id=pd.proj_id AND p.assigned_user_id=u.id AND 
                (u.user_first_name LIKE '%{$pub}%' OR u.user_last_name LIKE '%{$pub}%') AND
                CAST(pd.download_datetime as DATE)>='{$_REQUEST['form-date-range8-startdate']}' AND 
                CAST(pd.download_datetime as DATE)<='{$_REQUEST['form-date-range8-enddate']}'";
        $q = mysql_query($sql);
        $row = mysql_fetch_assoc($q);
        $clicks = $row[clicks];  
        
        $sql = "SELECT count(ip.proj_id) as install_started
                FROM install_projects ip, projects p, users u 
                WHERE ip.install_state=0 AND hour(ip.install_datetime)={$nHour} AND p.id=ip.proj_id AND p.assigned_user_id=u.id AND 
                (u.user_first_name LIKE '%{$pub}%' OR u.user_last_name LIKE '%{$pub}%')  AND
                CAST(ip.install_datetime as DATE)>='{$_REQUEST['form-date-range8-startdate']}' AND 
                CAST(ip.install_datetime as DATE)<='{$_REQUEST['form-date-range8-enddate']}'";
        $q = mysql_query($sql);
        $row = mysql_fetch_assoc($q);
        $install_started = $row[install_started]; 
        
        $sql = "SELECT count(ip.proj_id) as install_completed
                FROM install_projects ip, projects p, users u 
                WHERE ip.install_state=1 AND hour(ip.install_datetime)={$nHour} AND p.id=ip.proj_id AND p.assigned_user_id=u.id AND 
                (u.user_first_name LIKE '%{$pub}%' OR u.user_last_name LIKE '%{$pub}%')  AND
                CAST(ip.install_datetime as DATE)>='{$_REQUEST['form-date-range8-startdate']}' AND 
                CAST(ip.install_datetime as DATE)<='{$_REQUEST['form-date-range8-enddate']}'";
        $q = mysql_query($sql);
        $row = mysql_fetch_assoc($q);
        $install_completed = $row[install_completed]; 
        
        $sql = "SELECT SUM(o.offer_price*u.user_revenue/100) as pub_rev 
                FROM install_offers io, offers o, projects p, users u 
                WHERE hour(io.install_datetime)={$nHour} AND io.install_state=1 AND io.offer_id=o.id AND io.proj_id=p.id AND 
                p.assigned_user_id=u.id AND (u.user_first_name LIKE '%{$pub}%' OR u.user_last_name LIKE '%{$pub}%')  AND
                CAST(io.install_datetime as DATE)>='{$_REQUEST['form-date-range8-startdate']}' AND 
                CAST(io.install_datetime as DATE)<='{$_REQUEST['form-date-range8-enddate']}'";
        $q = mysql_query($sql);
        $row = mysql_fetch_assoc($q);
        $revenue = $row[pub_rev]; 
        if($revenue == NULL) $revenue = 0;   
        
        $sql = "SELECT SUM(o1.offer_price* (100-u2.user_revenue- u3.user_revenue- u4.user_revenue)/100) as network_rev 
                FROM install_offers io1, offers o1, users u1, users u2, projects p1, users u3, users u4 
                WHERE io1.offer_id=o1.id AND io1.install_state=1 AND hour(io1.install_datetime)={$nHour} AND u1.id=o1.assigned_user_id AND 
                (u3.user_first_name LIKE '%{$pub}%' OR u3.user_last_name LIKE '%{$pub}%') AND 
                u1.user_manager=u2.id AND io1.proj_id=p1.id AND p1.assigned_user_id=u3.id AND u3.user_manager=u4.id  AND
                CAST(io1.install_datetime as DATE)>='{$_REQUEST['form-date-range8-startdate']}' AND 
                CAST(io1.install_datetime as DATE)<='{$_REQUEST['form-date-range8-enddate']}'";
        $q = mysql_query($sql);
        $row = mysql_fetch_assoc($q);
        $network_revenue = $row[network_rev]; 
        if($network_revenue == NULL) $network_revenue = 0;              
    } 
    else //for campign, subid, country 
    {
        $sql = "SELECT count(pd.id) as clicks FROM projects_downloads pd, projects p 
                WHERE hour(pd.download_datetime)={$nHour} AND p.id=pd.proj_id AND p.proj_name LIKE '%{$camp}%' AND pd.download_country LIKE '%{$country}%' AND 
                (pd.download_subid1 LIKE '%{$subid}%' OR pd.download_subid2 LIKE '%{$subid}%' OR pd.download_subid3 LIKE '%{$subid}%' OR pd.download_subid4 LIKE '%{$subid}%' OR pd.download_subid5 LIKE '%{$subid}%') AND
                CAST(pd.download_datetime as DATE)>='{$_REQUEST['form-date-range8-startdate']}' AND 
                CAST(pd.download_datetime as DATE)<='{$_REQUEST['form-date-range8-enddate']}'";
        $q = mysql_query($sql);
        $row = mysql_fetch_assoc($q);
        $clicks = $row[clicks];  
        
        $sql = "SELECT count(ip.proj_id) as install_started 
                FROM install_projects ip, projects p, projects_downloads pd 
                WHERE hour(ip.install_datetime)={$nHour} AND ip.install_state=0 AND ip.proj_id=p.id AND 
                ip.download_id=pd.download_id AND p.proj_name LIKE '%{$camp}%' AND pd.download_country LIKE '%{$country}%' AND 
                (pd.download_subid1 LIKE '%{$subid}%' OR pd.download_subid2 LIKE '%{$subid}%' OR pd.download_subid3 LIKE '%{$subid}%' OR pd.download_subid4 LIKE '%{$subid}%' OR pd.download_subid5 LIKE '%{$subid}%') AND
                CAST(ip.install_datetime as DATE)>='{$_REQUEST['form-date-range8-startdate']}' AND 
                CAST(ip.install_datetime as DATE)<='{$_REQUEST['form-date-range8-enddate']}'";
        $q = mysql_query($sql);
        $row = mysql_fetch_assoc($q);
        $install_started = $row[install_started]; 
        
        $sql = "SELECT count(ip.proj_id) as install_completed 
                FROM install_projects ip, projects p, projects_downloads pd 
                WHERE hour(ip.install_datetime)={$nHour} AND ip.install_state=1 AND ip.proj_id=p.id AND 
                ip.download_id=pd.download_id AND p.proj_name LIKE '%{$camp}%' AND pd.download_country LIKE '%{$country}%' AND 
                (pd.download_subid1 LIKE '%{$subid}%' OR pd.download_subid2 LIKE '%{$subid}%' OR pd.download_subid3 LIKE '%{$subid}%' OR pd.download_subid4 LIKE '%{$subid}%' OR pd.download_subid5 LIKE '%{$subid}%') AND
                CAST(ip.install_datetime as DATE)>='{$_REQUEST['form-date-range8-startdate']}' AND 
                CAST(ip.install_datetime as DATE)<='{$_REQUEST['form-date-range8-enddate']}'";
        $q = mysql_query($sql);
        $row = mysql_fetch_assoc($q);
        $install_completed = $row[install_completed]; 
        
        $sql = "SELECT SUM(o.offer_price) as total_rev 
                FROM install_offers io, offers o, projects p, projects_downloads pd
                WHERE hour(io.install_datetime)={$nHour} AND io.install_state=1 AND io.offer_id=o.id AND io.proj_id=p.id AND io.download_id=pd.download_id AND
                p.proj_name LIKE '%{$camp}%' AND pd.download_country LIKE '%{$country}%' AND 
                (pd.download_subid1 LIKE '%{$subid}%' OR pd.download_subid2 LIKE '%{$subid}%' OR pd.download_subid3 LIKE '%{$subid}%' OR pd.download_subid4 LIKE '%{$subid}%' OR pd.download_subid5 LIKE '%{$subid}%') AND
                CAST(io.install_datetime as DATE)>='{$_REQUEST['form-date-range8-startdate']}' AND 
                CAST(io.install_datetime as DATE)<='{$_REQUEST['form-date-range8-enddate']}'";
        $q = mysql_query($sql);
        $row = mysql_fetch_assoc($q);
        $revenue = $row[total_rev];  
        if($revenue == NULL) $revenue = 0; 
        
        $sql = "SELECT SUM(o.offer_price*(100-u2.user_revenue-u3.user_revenue-u4.user_revenue)/100) as network_rev 
                FROM install_offers io, offers o, projects p, projects_downloads pd, users u1, users u2, users u3, users u4
                WHERE hour(io.install_datetime)={$nHour} AND io.install_state=1 AND io.offer_id=o.id AND io.proj_id=p.id AND io.download_id=pd.download_id AND
                p.proj_name LIKE '%{$camp}%' AND pd.download_country LIKE '%{$country}%' AND 
                (pd.download_subid1 LIKE '%{$subid}%' OR pd.download_subid2 LIKE '%{$subid}%' OR pd.download_subid3 LIKE '%{$subid}%' OR pd.download_subid4 LIKE '%{$subid}%' OR pd.download_subid5 LIKE '%{$subid}%') AND 
                o.assigned_user_id=u1.id AND u1.user_manager=u2.id AND p.assigned_user_id=u3.id AND u3.user_manager=u4.id AND
                CAST(io.install_datetime as DATE)>='{$_REQUEST['form-date-range8-startdate']}' AND 
                CAST(io.install_datetime as DATE)<='{$_REQUEST['form-date-range8-enddate']}'";
        $q = mysql_query($sql);
        $row = mysql_fetch_assoc($q);
        $network_revenue = $row[network_rev];
        if($network_revenue == NULL) $network_revenue = 0;       
        
    }
?>
  
<?php
    $total_clicks += $clicks;
    $total_install_started += $install_started;
    $total_install_successed += $install_completed;
    $total_revenue += $revenue;
    $total_network += $network_revenue;
    
?>
                                                            <tr class="odd gradeX">
                                                                <td class="highlight"><div class="success"></div><?= $time_arr[$nHour] ?></td>
                                                                <?php if($adv!="") {?>
                                                                    <td>&nbsp;</td>
                                                                <?php }else {?>
                                                                <td><?= $clicks?></td>
                                                                <?php } ?>
                                                                <td> <?=$install_started?></td>
                                                                <th> <?=$install_completed?></th>
                                                                <td>$<?= number_format($revenue,2)?></td>
                                                                <td>$<?= number_format($revenue/$install_completed,2)?></td>
                                                                <?php if($adv!="") {?>
                                                                    <td>&nbsp;</td>
                                                                <?php }else {?>
                                                                <td><?= number_format($revenue/$clicks,2)?></td>
                                                                <?php } ?>
                                                                <td>$<?= number_format($network_revenue,2)?></td>
                                                                
                                                            </tr>
                                                            <?  
                                                                
                                                                
                                                                $str_gen .= $revenue;
                                                                $str_gen .= ",";
                                                                
                                                                if($revenue>$max_rev) $max_rev = $revenue;
}
                                                            ?>
                                                    </tbody>
                                                </table>
                                                <br>
                                                <table class="table table-striped table-bordered" style="margin: auto;width: 800px;">
                                                    <thead>
                                                        <tr>
                                                            <th>&nbsp</th>
                                                            <th>Clicks</th>
                                                            <th>Install Started</th>
                                                            <th>Install Successed</th>
                                                            <th>Revenue</th>                                                            
                                                            <th>Network Revenue</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="highlight" style="color: blue;font-weight: bold;">TOTAL VALUE</td>
                                                            <td><?= $total_clicks?></td>
                                                            <td><?= $total_install_started?></td>
                                                            <td><?= $total_install_successed?></td>
                                                            <td>$<?= number_format($total_revenue,2)?></td>                                                            
                                                            <td>$<?= number_format($total_network,2)?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                      
                                                  <?php  
                                                  $str_gen .= "0];";
                                                  //var_dump($str_gen);exit;
                                                  
                                                  $max_rev += 10;
                                                  
                                                  $str_max = "var max = [";
                                                  for($j=0;$j<24;$j++)
                                                  {
                                                      $str_max .= $max_rev . ",";
                                                  }
                                                  $str_max .= "0];";
                                                  ?>
                                                <script>    
                                                            <?=$str_gen?>
                                                            <?= $str_max?>
                                                            var time_arr = ["midnight-1AM", "1AM-2AM", "2AM-3AM", "3AM-4AM", "4AM-5AM", "5AM-6AM", "6AM-7AM", "7AM-8AM", "8AM-9AM", "9AM-10AM", "10AM-11AM", "11AM-12PM",
                                                                        "12PM-1PM", "1PM-2PM", "2PM-3PM", "3PM-4PM", "4PM-5PM", "5PM-6PM", "6PM-7PM", "7PM-8PM", "8PM-9PM", "9PM-10PM", "10PM-11PM", "11PM-midnight" ];
                                                               var line3 = new Array(10);
                                                              for (var i = 0; i < 24; i++) {
                                                                line3[i] = new Array(2);
                                                                line3[i][0] = time_arr[i];
                                                                line3[i][1] = revenue[i];
                                                              }
                                                                
 
                                                                var plot3 = $.jqplot('chart_sort_div_8', [line3], {
                                                              series:[],
                                                              axesDefaults: {
                                                                tickRenderer: $.jqplot.CanvasAxisTickRenderer
                                                                },
                                                              axes: {
                                                                xaxis: {
                                                                  renderer: $.jqplot.CategoryAxisRenderer,                                                                  
                                                                  labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
                                                                  tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                                                                  tickOptions: {
                                                                      angle: -30,
                                                                      fontFamily: 'Courier New',
                                                                      fontSize: '9pt'
                                                                  }
                                                                   
                                                                },
                                                                yaxis: {
                                                                    min: 0,
                                                                    autoscale: true,
                                                                    ticks: addDollarCommasToArray(numTicksForArray(max, 10)) ,
                                                                    tickOptions: {
                                                                        textColor: '#8d8d8d',
                                                                        fontFamily: 'Arial Narrow',
                                                                        fontSize: '10px',
                                                                        formatString:'%d'
                                                                    }
                                                                }
                                                              }
                                                            });
                                                </script>
                                            </div>
                                        <? } ?>
                                    </div>
                                </div>
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
