
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


            var pageviews = [
    <?= $ready_graph_array ?>
            ];





            $('#site_statistics_loading').hide();
            $('#site_statistics_content').show();

            var plot = $.plot($("#site_statistics"), [{
                    data: pageviews,
                    label: "Daily Revenue"
                }], {
                series: {
                    lines: {
                        show: true,
                        lineWidth: 2,
                        fill: true,
                        fillColor: {
                            colors: [{
                                    opacity: 0.05
                                }, {
                                    opacity: 0.01
                                }]
                        }
                    },
                    points: {
                        show: true
                    },
                    shadowSize: 2
                },
                grid: {
                    hoverable: true,
                    clickable: true,
                    tickColor: "#eee",
                    borderWidth: 0
                },
                colors: ["#d12610", "#37b7f3", "#52e136"],
                xaxis: {
                    ticks: 11,
                    tickDecimals: 0
                },
                yaxis: {
                    ticks: 11,
                    tickDecimals: 0
                }
            });

    //            var plot = $.plot($("#site_statistics"), {
    //                series: {
    //                    stack: stack,
    //                    lines: {
    //                        show: lines,
    //                        fill: true,
    //                        steps: steps
    //                    },
    //                    bars: {
    //                        show: bars,
    //                        barWidth: 0.6
    //                    }
    //                }
    //            });


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
<? } else { ?>
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