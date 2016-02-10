
<? include 'z_header.php'; ?>
<?php
 
?>
<!-- BEGIN PAGE -->
<div id="body">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">

                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    Dashboard
                    <small>statistics and more</small>
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> <span class="divider">/</span>
                    </li>
                    <li><a href="dashboard.php">Dashboard</a></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div id="page" class="dashboard">

            <!--                        <div class="alert alert-warning">
                                        <button class="close" data-dismiss="alert">×</button>
                                        After completion of the second project these fake data will be replaced with real data. I left these indicators here to show how the dashboard page will look in future.
                                    </div>-->
            <!-- BEGIN OVERVIEW STATISTIC BARS-->
            <div class="row-fluid stats-overview-cont">
                
                <div class="span2 responsive" data-tablet="span4" data-desktop="span2">
                    <div class="stats-overview block clearfix">

                        <div class="details">
                            <div class="title">Today's Revenue<br>&nbsp;</div>
                            <div class="numbers">$<?= number_format(mysql_result(mysql_query("SELECT SUM(o.offer_price) FROM offers o, install_offers io WHERE io.install_datetime >= DATE_FORMAT(NOW(), '%Y-%m-%d') AND io.offer_id=o.id AND io.install_state=1"), 0),2); ?></div>
                            <!--<div class="numbers">$16,329.56</div>-->
                        </div>
                        <div class="progress progress-warning">
                            <div class="bar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="span2 responsive" data-tablet="span4" data-desktop="span2">
                    <div class="stats-overview block clearfix">

                        <div class="details">
                            <div class="title">Yesterday's Revenue<br>&nbsp;</div>
                            <div class="numbers">$<?= number_format(mysql_result(mysql_query("SELECT SUM(o.offer_price) FROM offers o, install_offers io WHERE io.install_datetime>=(DATE_FORMAT(DATE_ADD(NOW(), INTERVAL -1 DAY), '%Y-%m-%d')) AND io.install_datetime < (DATE_FORMAT(NOW(), '%Y-%m-%d')) AND io.offer_id=o.id AND io.install_state=1"), 0),2); ?></div>
                            <!--<div class="numbers">$21,007.83</div>-->
                        </div>

                        <div class="progress progress-warning">
                            <div class="bar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="span2 responsive " data-tablet="span4" data-desktop="span2">
                    <div class="stats-overview block clearfix">

                        <div class="details">
                            <div class="title">Month To Date Revenue<br>&nbsp;</div>
                            <div class="numbers">$<?= number_format(mysql_result(mysql_query("SELECT SUM(o.offer_price) FROM offers o, install_offers io WHERE date_format(io.install_datetime, '%Y%m') = date_format(now(), '%Y%m') AND io.offer_id=o.id AND io.install_state=1"), 0),2); ?></div>
                            <!--<div class="numbers">$338,550.25</div>-->
                        </div>
                        <div class="progress progress-warning">
                            <div class="bar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>

                <div class="span2 responsive" data-tablet="span4" data-desktop="span2">
                    <div class="stats-overview block clearfix">

                        <div class="details">
                            <div class="title">Today's Installs Completed</div>
                            <div class="numbers"><?= mysql_result(mysql_query("SELECT COUNT(id) FROM install_projects WHERE install_datetime >= DATE_FORMAT(NOW(), '%Y-%m-%d') AND install_state=1"), 0); ?></div>
                            <!--<div class="numbers">13,608</div>-->
                        </div>
                        <div class="progress progress-warning">
                            <div class="bar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
                <div class="span2 responsive" data-tablet="span4" data-desktop="span2">
                    <div class="stats-overview block clearfix">

                        <div class="details">
                            <div class="title">Yesterday's Installs Completed</div>
                            <div class="numbers"><?= mysql_result(mysql_query("SELECT COUNT(id) FROM install_projects WHERE install_datetime >= (DATE_FORMAT(DATE_ADD(NOW(), INTERVAL -1 DAY), '%Y-%m-%d')) AND install_datetime < (DATE_FORMAT(NOW(), '%Y-%m-%d')) AND install_state=1"), 0); ?></div>
                            <!--<div class="numbers">17,506</div>-->
                        </div>
                        <div class="progress progress-warning">
                            <div class="bar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
                <div class="span2 responsive " data-tablet="span4" data-desktop="span2">
                    <div class="stats-overview block clearfix">

                        <div class="details">
                            <div class="title">Month To Date Installs Completed</div>
                            <div class="numbers"><?= mysql_result(mysql_query("SELECT COUNT(id) FROM install_projects WHERE date_format(install_datetime, '%Y%m') = date_format(now(), '%Y%m') AND install_state=1"), 0); ?></div>
                            <!--<div class="numbers">282,125</div>-->
                        </div>
                        <div class="progress progress-warning">
                            <div class="bar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- END OVERVIEW STATISTIC BARS-->
            <div class="row-fluid">
                <div class="span8">
                    <!-- BEGIN SITE VISITS PORTLET-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-signal"></i>Network Revenue by hour</h4>
                        </div>
                        <div class="widget-body">
                            <div id="site_statistics_loading">
                                <img src="../common/assets/img/loading.gif" alt="loading" />
                            </div>
                            <div id="site_statistics_content" class="hide">

                                <div id="site_statistics" class="chart"></div>
                            </div>
                        </div>
                    </div>
                    <script>
                        jQuery(document).ready(function() {
                            function randValue() {
                                return 10;
                            }
                                        
                            <?php
                            $str_max = "var max = [";
                            $str_today = "var today = [";
                            $str_yesterday = "var yesterday = [";
                            
                            $max = 0;
                            
                            for($nHour=0; $nHour<24; $nHour++)
                            {
                                $sql = "SELECT SUM(o.offer_price) as revenue
                                        FROM offers o, install_offers io 
                                        WHERE io.install_datetime >= DATE_FORMAT(NOW(), '%Y-%m-%d') AND io.offer_id=o.id AND io.install_state=1 AND 
                                            hour(io.install_datetime)={$nHour}";
                                            
                                $q = mysql_query($sql);
                                $row = mysql_fetch_assoc($q);
                                $revenue = $row[revenue];
                                if($revenue==NULL) $revenue = 0;
                                if($max<$revenue) $max = $revenue;
                                
                                $str_today .= $revenue . ",";
                                
                                $sql = "SELECT SUM(o.offer_price) as revenue
                                        FROM offers o, install_offers io 
                                        WHERE io.install_datetime>=(DATE_FORMAT(DATE_ADD(NOW(), INTERVAL -1 DAY), '%Y-%m-%d')) AND io.install_datetime < (DATE_FORMAT(NOW(), '%Y-%m-%d')) AND 
                                        io.offer_id=o.id AND io.offer_id=o.id AND io.install_state=1 AND hour(io.install_datetime)={$nHour}";
                                            
                                $q = mysql_query($sql);
                                $row = mysql_fetch_assoc($q);
                                $revenue = $row[revenue];
                                if($revenue==NULL) $revenue = 0;
                                if($max<$revenue) $max = $revenue;
                                
                                $str_yesterday .= $revenue . ",";                                 
                            }
                            $str_today .= "0];";
                            $str_yesterday .= "0];";
                            
                            $max += 10;
                            for($nHour=0; $nHour<24; $nHour++)   
                            {
                                $str_max .= $max . ",";
                            }
                            $str_max .= "0];";
                            
                            echo ($str_today);
                            echo ($str_yesterday);
                            echo ($str_max);
                            ?>
                             /*
                             var yesterday = [ 300.48, 340.35, 400.24, 500.25, 500.43, 632.24, 728.22, 830.54, 900.55, 1100.23, 1200.33, 1350.23,
                                               1380.22, 1200.43, 1250.68, 1324.56, 1380.45, 1450.89, 1230.24, 890.53, 770.48, 600.22, 500.12, 360.25
                             ];
                             var today = [ 350.33, 321.24, 315.22, 555.45, 650.38, 787.68, 890.23, 1000.23, 1080.88, 1200.12, 1322.23, 1450.65,
                                             1558.98, 1643.12, 1432.12, 1588.78, 1324.18, 1628.98, 1200.23, 900.56, 888.75, 750.23, 0, 0
                             ]; 
                             xticks = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23];
                             max = [3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000];
                                            
                             $('#site_statistics_loading').hide();
                             $('#site_statistics_content').show();

                             
                             
                             var title = '<div style="float:left;width:150px;"><div class="jqplot-table-legend-type-color" style="border-radius: 10px;width:40px;height:7px;background-color:#278CC0;float:left;margin-top:5px;margin-right:5px;"></div><div class="jqplot-table-legend-type-label" style="clear:none;float:left;padding:0 0 0 0;color:#00547D;font-weight:bold;max-width:300px;">';
                                 title += 'Yesterday';
                                 title += '</div></div> <div style="float:left;width:150px;"><div class="jqplot-table-legend-type-color" style="border-radius: 10px;width:40px;height:7px;background-color:#C1D01F;float:left;margin-top:5px;margin-right:5px;"></div><div class="jqplot-table-legend-type-label" style="clear:none;float:left;padding:0 0 0 0;color:#00547D;font-weight:bold;max-width:300px;">';
                                 title += 'Today';
                                 title += '</div></div>';
                             var label1 = "Revenue1";
                             var label2 = "Revenue2";                          
                             var labels = [label1, label2];                    
                             $.jqplot(
                                         'site_statistics',
                                                 [ yesterday,today],
                                                 {       
                               
                                                     legend: {
                                                         show: true,
                                                         renderer: $.jqplot.EnhancedLegendRenderer,
                                                         rendererOptions: {
                                                             numberRows: 1
                                                         },
                                                         placement: 'outside',
                                                         labels: labels,
                                                         location: 'n'
                                                     },
                                                     
                                                     stackSeries: true,
                                                     seriesDefaults: {
                                                         //renderer:$.jqplot.BezierCurveRenderer,
                                                         showMarker: true,
                                                         fill: false,
                                                         rendererOptions: {
                                                             highlightMouseOver: true,
                                                             //highlightMouseDown: false,
                                                             //highlightColor: null,
                                                             shadow:false
                                                         },
                                                         shadow: false 
                                                     },
                                                     series: [                           
                                                         {label: 'Portofolio A',showLabel : false, color: '#278CC0', fillColor: '#548cbd' ,padding: 20,type: 'linear'},
                                                         {label: 'Portofolio B',showLabel : false, color: '#C1D01F', fill: false, disableStack: true,padding: 20,type: 'linear' }                                                                   
                                                     ],
                                                     
                                                     grid: {
                                                         drawGridLines: true,
                                                         gridLineColor: '#B7B7B7',
                                                         background: '#ffffff',
                                                         borderColor: '#B6B7B7',
                                                         shadow: false,
                                                         borderWidth: 1.0
                                                     },
                                                     
                                                     title : {
                                                         text : title,
                                                         textAlign:'right'
                                                         
                                                     }  ,
                                                     
                                                     highlighter: {
                                                         show:false
                                                     },
                                                     axesDefaults: {
                                                         tickRenderer: $.jqplot.CanvasAxisTickRenderer
                                                     },
                                                     axes: {

                                                         xaxis: {
                                                             tickOptions: {
                                                                 formatString:'%d',
                                                                 textColor: '#8d8d8d',
                                                                 fontFamily: 'Arial Narrow',
                                                                 fontSize: '10px'   ,
                                                                 showGridline: false   
                                                             },
                                                             
                                                             //label: 'hrs',
                                                             labelOptions: {
                                                                 textColor: '#8d8d8d',
                                                                 fontFamily: 'Arial',
                                                                 fontSize: '10px'
                                                             } ,
                                                             ticks: xticks
                                                             
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
                                                 }
                                         );
                                         */
                                     
                             $('#site_statistics_loading').hide();
                             $('#site_statistics_content').show();   
                             
                            var time_arr = ["midnight-1AM", "1AM-2AM", "2AM-3AM", "3AM-4AM", "4AM-5AM", "5AM-6AM", "6AM-7AM", "7AM-8AM", "8AM-9AM", "9AM-10AM", "10AM-11AM", "11AM-12PM",
                                                                        "12PM-1PM", "1PM-2PM", "2PM-3PM", "3PM-4PM", "4PM-5PM", "5PM-6PM", "6PM-7PM", "7PM-8PM", "8PM-9PM", "9PM-10PM", "10PM-11PM", "11PM-midnight" ];
                           var line3 = new Array(24);  
                           var line2 = new Array(24);
                           for (var i = 0; i < 24; i++) {
                                line3[i] = new Array(2);
                                line3[i][0] = time_arr[i];
                                line3[i][1] = today[i];    
                                
                                line2[i] = new Array(2);
                                line2[i][0] = time_arr[i];
                                line2[i][1] = yesterday[i];    
                           }     
                            var title = '<div style="float:left;width:150px;"><div class="jqplot-table-legend-type-color" style="border-radius: 10px;width:40px;height:7px;background-color:#EAA228;float:left;margin-top:5px;margin-right:5px;"></div><div class="jqplot-table-legend-type-label" style="clear:none;float:left;padding:0 0 0 0;color:#00547D;font-weight:bold;max-width:300px;">';
                                 title += 'Yesterday';
                                 title += '</div></div> <div style="float:left;width:150px;"><div class="jqplot-table-legend-type-color" style="border-radius: 10px;width:40px;height:7px;background-color:#278CC0;float:left;margin-top:5px;margin-right:5px;"></div><div class="jqplot-table-legend-type-label" style="clear:none;float:left;padding:0 0 0 0;color:#00547D;font-weight:bold;max-width:300px;">';
                                 title += 'Today';
                                 title += '</div></div>';
                                 
                            var label1 = "Revenue1";
                             var label2 = "Revenue2";                          
                             var labels = [label1, label2];                    

                            var plot3 = $.jqplot('site_statistics', [line3,line2], {
                            legend: {
                                 show: false,
                                 renderer: $.jqplot.EnhancedLegendRenderer,
                                 rendererOptions: {
                                     numberRows: 1
                                 },
                                 placement: 'outside',
                                 labels: labels,
                                 location: 'n'
                             },
                            series:[],
                            title : {
                                 text : title,
                                 textAlign:'right'                                 
                             }, 
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
                        
                        function showTooltip(x, y, contents) {
                                $('<div id="tooltip">' + contents + '</div>').css({
                                    position: 'absolute',
                                    display: 'none',
                                    top: y + 5,
                                    left: x + 15,
                                    border: '1px solid #333',
                                    padding: '4px',
                                    color: '#fff',
                                    'border-radius': '3px',
                                    'background-color': '#333',
                                    opacity: 0.80
                                }).appendTo("body").fadeIn(200);
                            }

                            var previousPoint = null;
                            $("#site_statistics").bind("plothover", function(event, pos, item) {
                                $("#x").text(pos.x.toFixed(2));
                                $("#y").text(pos.y.toFixed(2));

                                if (item) {
                                    if (previousPoint != item.dataIndex) {
                                        previousPoint = item.dataIndex;

                                        $("#tooltip").remove();
                                        var x = item.datapoint[0].toFixed(0),
                                                y = item.datapoint[1];

                                        showTooltip(item.pageX, item.pageY, "$" + y + " (" + x + " <?= date("M") ?>)");
                                    }
                                } else {
                                    $("#tooltip").remove();
                                    previousPoint = null;
                                }
                            });

                            //server load
                            var options = {
                                series: {
                                    shadowSize: 1
                                },
                                lines: {
                                    show: true,
                                    lineWidth: 0.5,
                                    fill: true,
                                    fillColor: {
                                        colors: [{
                                                opacity: 0.1
                                            }, {
                                                opacity: 1
                                            }]
                                    }
                                },
                                yaxis: {
                                    min: 0,
                                    max: 100,
                                    tickFormatter: function(v) {
                                        return v + "%";
                                    }
                                },
                                xaxis: {
                                    show: false
                                },
                                colors: ["#e14e3d"],
                                grid: {
                                    tickColor: "#a8a3a3",
                                    borderWidth: 0
                                }
                            };

                            $('#load_statistics_loading').hide();
                            $('#load_statistics_content').show();

                            App.setMainPage(true);
                            App.init();
                        });
                    </script>
                    <!-- END SITE VISITS PORTLET-->
                </div>
                <div class="span4">
                    <!-- BEGIN NOTIFICATIONS PORTLET-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-warning-sign"></i> Latest News</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-refresh"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <ul class="item-list scroller padding" data-height="295" data-always-visible="1">
                                <?
                                $sql = "SELECT `news`.*, `users`.`user_first_name`, `users`.`user_last_name` FROM `news`, `users` WHERE (`news`.`network_id`=-1 OR `news`.`network_id`={$_SESSION[network_id]}) AND `news`.`user_id`=`users`.`id` ORDER by `news`.`news_datetime` DESC";
                                $q = mysql_query($sql);
                                while ($row = mysql_fetch_assoc($q)) {
                                    ?>
                                    <li>
                                        <? if ($row[network_id] == '-1') { ?>
                                            <span class="label label-success">System News</span>
                                        <? } else { ?>
                                            <span class="label label-warning">Network News</span>
                                        <? } ?>

                                        <span class="bold">Posted <?= date_format(date_create($row[news_datetime]), SHORTDATETIME) ?> by <?= $row[user_first_name] . ' ' . $row[user_last_name] ?></span><br>
                                        <h4><?= $row[news_title] ?></h4>
                                        <span><?= $row[news_text] ?></span>
                                    </li>
                                <? } ?>

                            </ul>
                            <div class="space5"></div>
                            <div class="clearfix no-top-space no-bottom-space"></div>
                        </div>
                    </div>
                    <!-- END NOTIFICATIONS PORTLET-->
                </div>
            </div>
            <!-- BEGIN OVERVIEW STATISTIC BLOCKS-->
            <!--                        <div class="row-fluid">
                                        <div class="span3 responsive" data-tablet="span6" data-desktop="span3">
                                            <div class="circle-stat block">
                                                <div class="visual">
                                                    <input class="knobify" data-width="115" data-thickness=".2" data-skin="tron" data-displayprevious="true" value="+89" data-max="100" data-min="-100" />
                                                </div>
                                                <div class="details">
                                                    <div class="title">Unique Visits <i class="icon-caret-up"></i></div>
                                                    <div class="number">10112</div>
                                                    <span class="label label-success"><i class="icon-map-marker"></i>&nbsp;123</span>
                                                    <span class="label label-warning"><i class="icon-comment"></i>&nbsp;3</span>
                                                    <span class="label label-info"><i class="icon-bullhorn"></i>&nbsp;3</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span3 responsive" data-tablet="span6" data-desktop="span3">
                                            <div class="circle-stat block">
                                                <div class="visual">
                                                    <input class="knobify" data-width="115" data-fgcolor="#66EE66" data-thickness=".2" data-skin="tron" data-displayprevious="true" value="+19" data-max="100" data-min="-100" />
                                                </div>
                                                <div class="details">
                                                    <div class="title">New Users <i class="icon-caret-up"></i></div>
                                                    <div class="number">987</div>
                                                    <span class="label label-important"><i class="icon-bullhorn"></i>&nbsp;567</span>
                                                    <span class="label"><i class="icon-plus"></i>&nbsp;16</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span3 responsive" data-tablet="span6 fix-margin" data-desktop="span3">
                                            <div class="circle-stat block">
                                                <div class="visual">
                                                    <input class="knobify" data-width="115" data-fgcolor="#e23e29" data-thickness=".2" data-skin="tron" data-displayprevious="true" value="-12" data-max="100" data-min="-100" />
                                                </div>
                                                <div class="details">
                                                    <div class="title">Downtime <i class="icon-caret-down down"></i></div>
                                                    <div class="number">0.01%</div>
                                                    <span class="label label-info"><i class="icon-bookmark-empty"></i>&nbsp;23</span>
                                                    <span class="label label-warning"><i class="icon-ok"></i>&nbsp;31</span>
                                                    <span class="label label-success"><i class="icon-briefcase"></i>&nbsp;39</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span3 responsive" data-tablet="span6" data-desktop="span3">
                                            <div class="circle-stat block">
                                                <div class="visual">
                                                    <input class="knobify" data-width="115" data-fgcolor="#fdbb39" data-thickness=".2" data-skin="tron" data-displayprevious="true" value="+58" data-max="100" data-min="-100" />
                                                </div>
                                                <div class="details">
                                                    <div class="title">Profit <i class="icon-caret-up"></i></div>
                                                    <div class="number">1120.32$</div>
                                                    <span class="label label-success"><i class="icon-comment"></i>&nbsp;453</span>
                                                    <span class="label label-inverse"><i class="icon-globe"></i>&nbsp;123</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
            <!-- END OVERVIEW STATISTIC BLOCKS-->





        </div>
        <!-- END PAGE CONTENT-->
    </div>
    <!-- END PAGE CONTAINER-->
</div>


<? include 'z_footer.php'; ?>