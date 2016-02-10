
<!-- END PAGE -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div id="footer">
    2013 &copy; StartInstaller.
    <div class="span pull-right">
        <span class="go-top"><i class="icon-arrow-up"></i></span>
    </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS -->
<!-- Load javascripts at bottom, this will reduce page load time -->
<script type="text/javascript" src="../common/assets/jQuery-slimScroll/slimScroll.min.js"></script>
<script type="text/javascript" src="../common/assets/fullcalendar/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript" src="../common/assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../common/assets/js/jquery.blockui.js"></script>
<script type="text/javascript" src="../common/assets/js/jquery.cookie.js"></script>
<!-- ie8 fixes -->
<!--[if lt IE 9]>
<script src="assets/js/excanvas.js"></script>
<script src="assets/js/respond.js"></script>
<![endif]-->
<script type="text/javascript" src="../common/assets/jqvmap/jqvmap/jquery.vmap.js" ></script>
<script type="text/javascript" src="../common/assets/jqvmap/jqvmap/maps/jquery.vmap.russia.js"></script>
<script type="text/javascript" src="../common/assets/jqvmap/jqvmap/maps/jquery.vmap.world.js"></script>
<script type="text/javascript" src="../common/assets/jqvmap/jqvmap/maps/jquery.vmap.europe.js"></script>
<script type="text/javascript" src="../common/assets/jqvmap/jqvmap/maps/jquery.vmap.germany.js"></script>
<script type="text/javascript" src="../common/assets/jqvmap/jqvmap/maps/jquery.vmap.usa.js"></script>
<script type="text/javascript" src="../common/assets/jqvmap/jqvmap/data/jquery.vmap.sampledata.js"></script>
<script type="text/javascript" src="../common/assets/jquery-knob/js/jquery.knob.js"></script>
<script type="text/javascript" src="../common/assets/flot/jquery.flot.js"></script>
<script type="text/javascript" src="../common/assets/flot/jquery.flot.resize.js"></script>
<script type="text/javascript" src="../common/assets/js/jquery.peity.min.js"></script>
<script type="text/javascript" src="../common/assets/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="../common/assets/uniform/jquery.uniform.min.js"></script>
<script type="text/javascript" src="../common/assets/js/jquery.pulsate.min.js"></script>
<script type="text/javascript" src="../common/assets/bootstrap-daterangepicker/date.js"></script>
<script type="text/javascript" src="../common/assets/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="../common/assets/fancybox/source/jquery.fancybox.pack.js"></script>

<script type="text/javascript" src="../common/assets/bootstrap/js/bootstrap-fileupload.js"></script>
<script type="text/javascript" src="../common/assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
<script type="text/javascript" src="../common/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="../common/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="../common/assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
<script type="text/javascript" src="../common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="../common/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="../common/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>

<script type="text/javascript" src="../common/assets/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="../common/assets/data-tables/DT_bootstrap.js"></script>
       
<script type="text/javascript" src="../common/assets/js/elrte.full.js" charset="utf-8"></script>
<link rel="stylesheet" href="../common/assets/css/elrte.min.css" type="text/css" media="screen" charset="utf-8">

<!-- elRTE translation messages -->
<script type="text/javascript" src="../common/assets/js/i18n/elrte.en.js" charset="utf-8"></script>

<!--  For graph on Dashboard -->
    <link rel="stylesheet" href="../common/assets/jqplot/jquery.jqplot.css" type="text/css" media="screen" charset="utf-8">
    <script type="text/javascript" src="../common/assets/jqplot/jquery.jqplot.js"></script> 
    <script type="text/javascript" src="../common/assets/jqplot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
    <script type="text/javascript" src="../common/assets/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
    <script type="text/javascript" src="../common/assets/jqplot/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
    <script type="text/javascript" src="../common/assets/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
    <script type="text/javascript" src="../common/assets/jqplot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
    <script type="text/javascript" src="../common/assets/jqplot/plugins/jqplot.barRenderer.min.js"></script>
    <script type="text/javascript" src="../common/assets/jqplot/plugins/jqplot.pieRenderer.min.js"></script>
    <script type="text/javascript" src="../common/assets/jqplot/plugins/jqplot.highlighter.min.js"></script>
    <script type="text/javascript" src="../common/assets/jqplot/nicenum.js"></script>

<?
if (strpos($_SERVER['REQUEST_URI'], 'dashboard.php') == true) {
    $sql = "SELECT DISTINCT(day(`install_datetime`)) as install_day, count(id) as install_count, sum(install_price) install_price FROM install_offers WHERE date_format(install_datetime, '%Y%m') = date_format(now(), '%Y%m') AND `network_id`='{$_SESSION[network_id]}' GROUP BY day(`install_datetime`)";
    $q = mysql_query($sql);
    while ($row = mysql_fetch_assoc($q)) {
        $graph_array[$row[install_day]] = '[' . $row[install_day] . ', ' . $row[install_price] . ']';
    }

    for ($i = 1; $i <= date("t"); $i++) {
        if (!isset($graph_array[$i]))
            $graph_array[$i] = '[' . $i . ', 0]';
    }

    ksort($graph_array);

    $ready_graph_array = implode(',', $graph_array);
    ?>
    <script>
        jQuery(document).ready(function() {
            function randValue() {
                return 10;
            }
                        
            
            var yesterday = [ 300.48, 340.35, 400.24, 500.25, 500.43, 632.24, 728.22, 830.54, 900.55, 1100.23, 1200.33, 1350.23,
                              1380.22, 1200.43, 1250.68, 1324.56, 1380.45, 1450.89, 1230.24, 890.53, 770.48, 600.22, 500.12, 360.25
            ];
            var today = [ 350.33, 321.24, 315.22, 555.45, 650.38, 787.68, 890.23, 1000.23, 1080.88, 1200.12, 1322.23, 1450.65,
                            1558.98, 1643.12, 1432.12, 1588.78, 0, 0, 0, 0, 0, 0, 0, 0
            ];
            xticks = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23];
            max = [3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000,3000];
                           
            $('#site_statistics_loading').hide();
            $('#site_statistics_content').show();

            var label1 = "Revenue1";
            var label2 = "Revenue2";
            
            var title = '<div style="float:left;width:150px;"><div class="jqplot-table-legend-type-color" style="border-radius: 10px;width:40px;height:7px;background-color:#278CC0;float:left;margin-top:5px;margin-right:5px;"></div><div class="jqplot-table-legend-type-label" style="clear:none;float:left;padding:0 0 0 0;color:#00547D;font-weight:bold;max-width:300px;">';
                title += 'Yesterday';
                title += '</div></div> <div style="float:left;width:150px;"><div class="jqplot-table-legend-type-color" style="border-radius: 10px;width:40px;height:7px;background-color:#C1D01F;float:left;margin-top:5px;margin-right:5px;"></div><div class="jqplot-table-legend-type-label" style="clear:none;float:left;padding:0 0 0 0;color:#00547D;font-weight:bold;max-width:300px;">';
                title += 'Today';
                title += '</div></div>';
                    
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
                                            
                                            label: 'hrs',
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
    </script> <? } else { ?>
    <script>
        jQuery(document).ready(function() {
            App.init();

            var opts = {
                cssClass: 'el-rte',
                // lang     : 'ru',
                height: 250,
                width: 700,
                toolbar: 'complete',
                cssfiles: ['assets/css/elrte-inner.css']
            }
            $('.editor').elrte(opts);
        });
    </script>
<? } ?>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>