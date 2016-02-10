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
                                    <li <? if ($_REQUEST[tab] == '5') { ?>class="active"<? } ?>><a href="#portlet_tab5" data-toggle="tab" >SubID</a></li>
                                    <li <? if (($_REQUEST[tab] == '4') || ($_REQUEST[tab] == '')) { ?>class="active"<? } ?>><a href="#portlet_tab4" data-toggle="tab" >Campaigns</a></li>
                                </ul>


                                <div class="tab-content">                            

                                    <div class="tab-pane <? if (($_REQUEST[tab] == '4') || ($_REQUEST[tab] == '')) { ?>active<? } ?>" id="portlet_tab4">                                    
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
                                                <table class="table table-striped table-bordered" id="sample_1">
                                                    <thead>
                                                        <tr>
                                                            <th>CID</th>                                                            
                                                            <th>Campaign</th>
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
SELECT  pum.proj_id, pum.proj_name, pum.manager_id,pum.manager_first_name, pum.manager_last_name, piiop.total, piiop.AM_revenue, 
        piiop.pub_revenue, piiop.PM_revenue, piiop.network_revenue, 
        (SELECT COUNT(pd.id) FROM projects_downloads pd WHERE pd.proj_id=pum.proj_id GROUP BY pd.proj_id) as clicks, 
        (SELECT COUNT(ip.id) FROM install_projects ip WHERE ip.proj_id=pum.proj_id AND install_state=0 GROUP BY ip.proj_id) as install_started,  
        (SELECT COUNT(ip.id) FROM install_projects ip WHERE ip.proj_id=pum.proj_id AND install_state=1 GROUP BY ip.proj_id) as install_successed 
FROM    (SELECT p.id as proj_id, p.proj_name, um.user_id,um.user_first_name,um.user_last_name,um.manager_id,um.manager_first_name,um.manager_last_name
        FROM projects p , (SELECT u1.id as user_id,u1.user_first_name,u1.user_last_name, u2.id as manager_id,u2.user_first_name as manager_first_name, u2.user_last_name as manager_last_name FROM users u1, users u2 WHERE u1.user_manager=u2.id) um 
        WHERE um.user_id=p.assigned_user_id AND p.proj_name LIKE '%{$_REQUEST[search_string_4]}%'
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
                    WHERE p.assigned_user_id=up1.id AND up1.user_manager=up2.id 
                    ) uup, 
                    projects p 
            WHERE iio.offer_id=uuo.id AND iio.proj_id=uup.id  AND p.id=iio.proj_id 
            GROUP BY iio.proj_id
            ) piiop
ON pum.proj_id=piiop.proj_id
WHERE pum.user_id={$_SESSION[user_id]}
ORDER BY piiop.total DESC";   
                                                                                                                
                                                        //var_dump($sql); exit;
                                                        
                                                        $q = mysql_query($sql);
                                                        
                                                        $total_clicks = 0;
                                                        $total_install_started = 0;
                                                        $total_install_successed = 0;
                                                        $pub_revenue = 0;
                                                        
                                                        
                                                        while ($row = mysql_fetch_assoc($q)) {
                                                            
                                                            $total_clicks += $row[clicks];
                                                            $total_install_started += $row[install_started];
                                                            $total_install_successed += $row[install_successed];
                                                            $total_pub_revenue += number_format($row[pub_revenue], 2, ".", ",");
                                                        
                                                            
                                                            ?>
                                                            <tr class="odd gradeX">                                                                
                                                                <td class="highlight"><div class="success"></div><?= $row[proj_id] ?></td>
                                                                <td><a href="camp_edit.php?cid=<?= $row[proj_id] ?>"><?= $row[proj_name]?></a></td>
                                                                <td><?php if($row[clicks] == NULL) echo "0"; else echo $row[clicks]; ?></td>
                                                                <td><?php if($row[install_started] == NULL) echo "0"; else echo $row[install_started]; ?></td>
                                                                <td><?php if($row[install_successed] == NULL) echo "0"; else echo $row[install_successed];?></td>
                                                                <td>$<?= number_format($row[pub_revenue], 2, ".", ",") ?></td>
                                                                <td>$<? if(($row[install_successed]==NULL)||($row[install_successed]==0)) echo("0.00");
                                                                        else echo(number_format($row[pub_revenue]/$row[install_successed], 2, ".", ","));?></td>
                                                                <td>$<? if(($row[clicks]==NULL)||($row[clicks]==0)) echo("0.00");
                                                                        else echo(number_format($row[pub_revenue]/$row[clicks], 2, ".", ","));?></td>
                                                                
                                                                
                                                            </tr>
                                                            <?
                                                            if($row[pub_revenue] == NULL ) $row[pub_revenue] = 0;
                                                            if ($i < 5) {
                                                                $generate_arr.="
                                                                data.setCell(" . $i . ", 0, '" . $row[proj_name]. "');
                                                                data.setCell(" . $i . ", 1, $row[pub_revenue]);
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
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="highlight" style="color: blue;font-weight: bold;">TOTAL VALUE</td>
                                                            <td><?= $total_clicks?></td>
                                                            <td><?= $total_install_started?></td>
                                                            <td><?= $total_install_successed?></td>
                                                            <td>$<?= $total_pub_revenue?></td>
                                                            <td>$<?= number_format($total_pub_revenue / $total_install_successed, 2, ".", ",")?></td>
                                                            <td>$<?= number_format($total_pub_revenue / $total_clicks, 2, ".", ",")?></td>
                                                            
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
                                                <table class="table table-striped table-bordered" id="sample_2">
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
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?
                                                        $i = 0;

$sql = "
SELECT  pdum.*,SUM(pdum.install_started) as install_started1, SUM(pdum.install_successed) as install_successed1,COUNT(pdum.download_id) as clicks, SUM(dr.total) as total, SUM(dr.pub_revenue) as pub_revenue, SUM(dr.AM_revenue) as AM_revenue, 
        SUM(dr.PM_revenue) as PM_revenue, SUM(dr.network_revenue) as network_revenue 
FROM    (SELECT p.assigned_user_id, pd.proj_id, pd.download_id, pd.download_subid1, pd.download_subid2, pd.download_subid3, 
            pd.download_subid4, pd.download_subid5 , p.proj_name, 
            (SELECT COUNT(ip.proj_id) FROM install_projects ip WHERE ip.install_state=0 AND ip.download_id=pd.download_id) as install_started, 
            (SELECT COUNT(ip.proj_id) FROM install_projects ip WHERE ip.install_state=1 AND ip.download_id=pd.download_id) as install_successed 
        FROM projects_downloads pd , projects p 
        WHERE   pd.proj_id=p.id AND 
                ( pd.download_subid1 LIKE '%{$_REQUEST[search_string_5]}%' OR pd.download_subid2 LIKE '%{$_REQUEST[search_string_5]}%' OR 
                pd.download_subid3 LIKE '%{$_REQUEST[search_string_5]}%' OR pd.download_subid4 LIKE '%{$_REQUEST[search_string_5]}%' OR 
                pd.download_subid5 LIKE '%{$_REQUEST[search_string_5]}%' OR p.proj_name LIKE '%{$_REQUEST[search_string_5]}%' ) 
        ) pdum 
LEFT JOIN   (SELECT um.user_id, io.download_id,io.proj_id, io.offer_id, SUM(o.offer_price) as total, SUM(o.offer_price*um.user_revenue/100) as pub_revenue, 
                SUM(o.offer_price*um.manager_revenue/100) as PM_revenue, SUM(o.offer_price*um1.manager_revenue/100) as AM_revenue, 
                SUM(o.offer_price*(100-um.user_revenue-um.manager_revenue-um1.manager_revenue)/100) as network_revenue 
             FROM install_offers io, projects p, offers o, 
                (SELECT u1.id as user_id, u1.user_revenue , u2.user_revenue as manager_revenue FROM users u1, users u2 WHERE u1.user_manager=u2.id) um, 
                (SELECT u1.id as user_id, u1.user_revenue , u2.user_revenue as manager_revenue FROM users u1, users u2 WHERE u1.user_manager=u2.id) um1 
             WHERE p.id=io.proj_id AND um.user_id=p.assigned_user_id AND o.id=io.offer_id AND o.assigned_user_id=um1.user_id AND io.install_state=1 AND 
                CAST(io.install_datetime as DATE)>='{$_REQUEST['form-date-range5-startdate']}' AND CAST(io.install_datetime as DATE)<='{$_REQUEST['form-date-range5-enddate']}' GROUP BY io.download_id 
             ) dr
ON dr.download_id=pdum.download_id 
WHERE pdum.assigned_user_id={$_SESSION[user_id]}
GROUP BY pdum.proj_id, pdum.download_subid1, pdum.download_subid2, pdum.download_subid3, pdum.download_subid4, pdum.download_subid5 
ORDER BY total DESC";
                                                                
                                                        //var_dump($sql);exit;
                                                        $q = mysql_query($sql);
                                                        
                                                        $total_clicks = 0;
                                                        $total_install_started = 0;
                                                        $total_install_successed = 0;
                                                        $total_pub_revenue = 0;
                                                        
                                                        
                                                        while ($row = mysql_fetch_assoc($q)) {
                                                            
                                                            $total_clicks += $row[clicks];
                                                            $total_install_started += $row[install_started1];
                                                            $total_install_successed += $row[install_successed1];
                                                            $total_pub_revenue += number_format($row[pub_revenue], 2, ".", ",");
                                                            
                                                           
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
                                                                <td><? if($row[install_started1]==NULL) echo "0"; else echo($row[install_started1]); ?></td>
                                                                <td><? if($row[install_successed1]==NULL) echo "0"; else echo($row[install_successed1]); ?></td>
                                                                <td>$<?= number_format($row[pub_revenue], 2, ".", ",")?></td>
                                                                <td>$<?= number_format($row[pub_revenue]/$row[install_successed1], 2, ".", ",")?></td>
                                                                <td>$<?= number_format($row[pub_revenue]/$row[clicks], 2, ".", ",")?></td>
                                                                
                                                            </tr>
                                                            <?
                                                            if($row[pub_revenue] == NULL) $row[pub_revenue] = 0;
                                                            if ($i < 5) {
                                                                $generate_arr.="
                                                                data.setCell(" . $i . ", 0, '" . $row[proj_name] . "');
                                                                data.setCell(" . $i . ", 1, $row[pub_revenue]);
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
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="highlight" style="color: blue;font-weight: bold;">TOTAL VALUE</td>
                                                            <td><?= $total_clicks?></td>
                                                            <td><?= $total_install_started?></td>
                                                            <td><?= $total_install_successed?></td>
                                                            <td>$<?= $total_pub_revenue?></td>
                                                            <td>$<?= number_format($total_pub_revenue / $total_install_successed, 2, ".", ",")?></td>
                                                            <td>$<?= number_format($total_pub_revenue / $total_clicks, 2, ".", ",")?></td>
                                                            
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
                                                <table class="table table-striped table-bordered" id="sample_3">
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
FROM    (SELECT p.assigned_user_id, pd.download_id, pd.download_country_code, 
            (SELECT count(ip.id) FROM install_projects ip WHERE ip.download_id=pd.download_id AND ip.install_state=0) as install_started , 
            (SELECT count(ip.id) FROM install_projects ip WHERE ip.download_id=pd.download_id AND ip.install_state=1) as install_successed 
        FROM projects_downloads pd , projects p
        WHERE  p.id=pd.proj_id AND
               (
                    pd.download_country LIKE '%{$_REQUEST[search_string_6]}%' OR 
                    pd.download_country_code LIKE '%{$_REQUEST[search_string_6]}%' OR
                    p.proj_name LIKE '%{$_REQUEST[search_string_6]}%' 
               )
        )  di 
LEFT JOIN   (SELECT um.user_id, io.download_id,io.proj_id, io.offer_id, SUM(o.offer_price) as total, SUM(o.offer_price*um.user_revenue/100) as pub_revenue, 
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
WHERE di.assigned_user_id={$_SESSION[user_id]}
GROUP BY di.download_country_code
ORDER BY total DESC";

                                                        
                                                        //var_dump($sql); exit;
                                                        $q = mysql_query($sql);
                                                        
                                                        $total_clicks = 0;
                                                        $total_install_started = 0;
                                                        $total_install_successed = 0;
                                                        $total_pub_revenue = 0;
                                                        
                                                        while ($row = mysql_fetch_assoc($q)) {
                                                            
                                                            $total_clicks += $row[clicks];
                                                            $total_install_started += $row[install_started];
                                                            $total_install_successed += $row[install_successed];
                                                            $total_pub_revenue += number_format($row[pub_revenue], 2, ".", ",");
                                                            
                                                            ?>
                                                            <tr class="odd gradeX">
                                                                <td class="highlight"><div class="success"></div><?= $row[download_country_code] ?></td>
                                                                <td><? if($row[clicks] == NULL) echo "0"; else echo($row[clicks]);?></td>
                                                                <td><? if($row[install_started] == NULL) echo "0"; else echo($row[install_started]);?></td>
                                                                <td><? if($row[install_successed] == NULL) echo "0"; else echo($row[install_successed]);?></td>
                                                                <td>$<?= number_format($row[pub_revenue], 2, ".", ",") ?></td>
                                                                <td><?= number_format($row[pub_revenue]/$row[install_successed], 2, ".", ",") ?></td>
                                                                <td><?= number_format($row[pub_revenue]/$row[clicks], 2, ".", ",")?></td>
                                                                
                                                            </tr>
                                                            <?
                                                            if ($row[pub_revenue]==NULL) $row[pub_revenue] = 0;
                                                            if ($i < 5) {
                                                                $generate_arr.="
                                                                data.setCell(" . $i . ", 0, '" . $row[download_country_code] . "');
                                                                data.setCell(" . $i . ", 1, $row[pub_revenue] );
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
                                                        <td>$<?= $total_pub_revenue?></td>
                                                        <td>$<?= number_format($total_pub_revenue / $total_install_successed, 2, ".", ",")?></td>
                                                        <td>$<?= number_format($total_pub_revenue / $total_clicks, 2, ".", ",")?></td>
                                                        
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