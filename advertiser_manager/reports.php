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
                                    <li <? if ($_REQUEST[tab] == '6') { ?>class="active"<? } ?>><a href="#portlet_tab6" data-toggle="tab" >Geo</a></li>
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
                                                            <th>Advertiser</th>
                                                            <th>Offer</th>
                                                            <th>Install Started</th>
                                                            <th>Install Successed</th>
                                                            <th>Advertiser Revenue</th>
                                                            <th>AM Commission</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?
                                                        $i = 0;  
 
$tmp_id = (int)$_REQUEST[search_string_1];
$sql = "
SELECT  oiop.id, 
        (SELECT COUNT(id) FROM install_offers WHERE install_state=0 AND offer_id=oiop.offer_id) as install_started, 
        (SELECT COUNT(id) FROM install_offers WHERE install_state=1 AND offer_id=oiop.offer_id) as install_successed ,
        oiop.offer_name, um.*, SUM(oiop.adv_revenue) as adv_revenue, SUM(oiop.adv_revenue*oiop.AM_revenue/100) as AM_revenue, 
        SUM(oiop.adv_revenue*oiop.PM_revenue/100) as PM_revenue, SUM(oiop.adv_revenue*oiop.pub_revenue/100) as puv_revenue, 
        SUM(oiop.adv_revenue*oiop.network_revenue/100) as net_revenue 
FROM    (SELECT o.id, o.assigned_user_id, o.offer_name,iop.*, iop.offer_price*iop.amount as adv_revenue 
            FROM offers o 
            LEFT JOIN   (SELECT iio.offer_id, iio.proj_id, iio.amount ,uuo.offer_price, uuo.AM_revenue, uup.pub_revenue, uup.PM_revenue, (100-uuo.AM_revenue-uup.pub_revenue-uup.PM_revenue) as network_revenue 
                        FROM    (SELECT io.id, io.offer_id, io.proj_id, COUNT(io.id) as amount 
                                FROM install_offers io 
                                WHERE io.install_state=1 AND 
                                    CAST(io.install_datetime as DATE)>='{$_REQUEST['form-date-range1-startdate']}' AND 
                                    CAST(io.install_datetime as DATE)<='{$_REQUEST['form-date-range1-enddate']}' 
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
            ON iop.offer_id=o.id 
            
            ) oiop, 
            (SELECT u1.id as user_id, u1.subid as user_subid, u1.user_first_name, u1.user_last_name, u2.id as manager_id, u2.user_first_name as manager_first_name, u2.user_last_name as manager_last_name 
            FROM users u1, users u2 WHERE u1.user_manager=u2.id ) um 
WHERE   oiop.assigned_user_id=um.user_id AND um.manager_id={$_SESSION[user_id]} AND
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
                                                        
                                                        
                                                        while ($row = mysql_fetch_assoc($q)) { 
                                                            $total_install_started += $row[install_started];
                                                            $total_install_successed += $row[install_successed];
                                                            
                                                            $total_revenue += number_format($row[adv_revenue],2);
                                                            $total_AM += number_format($row[AM_revenue],2);
                                                            
                                                            ?>
                                                            <tr class="odd gradeX">
                                                                <td class="highlight"><div class="success"></div><?= $row[user_subid] ?></td>
                                                                
                                                                <td>
                                                                    <a href="adv_edit.php?id=<?= $row[user_id] ?>">
                                                                    <?
                                                                    echo($row[user_first_name] . ' ' . $row[user_last_name]);
                                                                    ?>
                                                                    </a>
                                                                </td>
                                                                <td><a href="offer_edit.php?id=<?= $row[id] ?>"><?= $row[offer_name]?></a></td>
                                                                <th><?= $row[install_started] ?></th>
                                                                <th><?= $row[install_successed] ?></th>
                                                                <td>$<?= number_format($row[adv_revenue],2) ?></td>
                                                                <td>$<?= number_format($row[AM_revenue],2) ?></td>
                                                               
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
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="highlight" style="color: blue;font-weight: bold;">TOTAL VALUE</td>
                                                            <td><?= $total_install_started?></td>
                                                            <td><?= $total_install_successed?></td>
                                                            <td>$<?= $total_revenue?></td>
                                                            <td>$<?= $total_AM?></td>
                                                            
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
                                                <table class="table table-striped table-bordered" id="sample_2">
                                                    <thead>
                                                        <tr>
                                                            <th>Country</th>
                                                            <th>Clicks</th>
                                                            <th>Installs Started</th>
                                                            <th>Installs Completed</th>
                                                            <th>Revenue</th>
                                                            <th>RPI</th>
                                                            <th>EPC</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?
                                                        $i = 0;
 
$sql = "
 SELECT  di.download_country_code, COUNT(di.download_id) as clicks, SUM(dr.total) as total, SUM(dr.AM_revenue) as AM_revenue, SUM(dr.PM_revenue) as PM_revenue , SUM(dr.pub_revenue) as pub_revenue, SUM(dr.network_revenue) as network_revenue 
        ,SUM(di.install_started) as install_started, SUM(di.install_successed) as install_successed
FROM    (SELECT pd.download_id, pd.download_country_code, 
            (SELECT count(ip.id) FROM install_projects ip WHERE ip.download_id=pd.download_id AND ip.install_state=0) as install_started , 
            (SELECT count(ip.id) FROM install_projects ip WHERE ip.download_id=pd.download_id AND ip.install_state=1) as install_successed 
        FROM projects_downloads pd, projects p 
        WHERE  p.id=pd.proj_id AND
               (
                    pd.download_country LIKE '%{$_REQUEST[search_string_6]}%' OR 
                    pd.download_country_code LIKE '%{$_REQUEST[search_string_6]}%' OR
                    p.proj_name LIKE '%{$_REQUEST[search_string_6]}%' 
               )
        )  di
LEFT JOIN   (SELECT io.download_id,io.proj_id, io.offer_id, um1.manager_id as AM_id, SUM(o.offer_price) as total, SUM(o.offer_price*um.user_revenue/100) as pub_revenue, 
                SUM(o.offer_price*um.manager_revenue/100) as PM_revenue, SUM(o.offer_price*um1.manager_revenue/100) as AM_revenue, 
                SUM(o.offer_price*(100-um.user_revenue-um.manager_revenue-um1.manager_revenue)/100) as network_revenue 
             FROM install_offers io, projects p, offers o, 
                (SELECT u1.id as user_id, u1.user_revenue , u2.user_revenue as manager_revenue FROM users u1, users u2 WHERE u1.user_manager=u2.id) um, 
                (SELECT u1.id as user_id, u1.user_revenue , u2.id as manager_id, u2.user_revenue as manager_revenue FROM users u1, users u2 WHERE u1.user_manager=u2.id) um1 
             WHERE p.id=io.proj_id AND um.user_id=p.assigned_user_id AND o.id=io.offer_id AND o.assigned_user_id=um1.user_id AND io.install_state=1 
                AND CAST(io.install_datetime as DATE)>='{$_REQUEST['form-date-range6-startdate']}' AND CAST(io.install_datetime as DATE)<='{$_REQUEST['form-date-range6-enddate']}'  
             GROUP BY io.download_id
             ) dr
ON dr.download_id=di.download_id
WHERE dr.AM_id={$_SESSION[user_id]} 
GROUP BY di.download_country_code
ORDER BY total DESC";

                                                        
                                                        //var_dump($sql); exit;
                                                        $q = mysql_query($sql);
                                                        
                                                        $total_clicks = 0;
                                                        $total_install_started = 0;
                                                        $total_install_successed = 0;
                                                        $total_revenue = 0;
                                                        
                                                        
                                                        while ($row = mysql_fetch_assoc($q)) {
                                                            
                                                            $total_clicks += $row[clicks];
                                                            $total_install_started += $row[install_started];
                                                            $total_install_successed += $row[install_successed];
                                                            $total_revenue += number_format($row[total], 2, ".", ",");
                                                            
                                                            ?>
                                                            <tr class="odd gradeX">
                                                                <td class="highlight"><div class="success"></div><?= $row[download_country_code] ?></td>
                                                                <td><? if($row[clicks] == NULL) echo "0"; else echo($row[clicks]);?></td>
                                                                <td><? if($row[install_started] == NULL) echo "0"; else echo($row[install_started]);?></td>
                                                                <td><? if($row[install_successed] == NULL) echo "0"; else echo($row[install_successed]);?></td>
                                                                <td>$<?= number_format($row[total], 2, ".", ",") ?></td>
                                                                <td><?= number_format($row[total]/$row[install_successed], 2, ".", ",") ?></td>
                                                                <td><?= number_format($row[total]/$row[clicks], 2, ".", ",")?></td>
                                                                
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
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td class="highlight" style="color: blue;font-weight: bold;">TOTAL VALUE</td>
                                                        <td><?= $total_clicks?></td>
                                                        <td><?= $total_install_started?></td>
                                                        <td><?= $total_install_successed?></td>
                                                        <td>$<?= $total_revenue?></td>
                                                        <td>$<?= number_format($total_revenue / $total_install_successed, 2, ".", ",")?></td>
                                                        <td>$<?= number_format($total_revenue / $total_clicks, 2, ".", ",")?></td>
                                                        
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
                                </div>
                            </div>

                            <!-- BEGIN FORM-->



                            <!-- END FORM-->
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