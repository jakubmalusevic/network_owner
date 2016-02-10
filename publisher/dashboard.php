
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
                            <div class="title">Today's Revenue</div>
                            <!--<div class="numbers">$<?= number_format(mysql_result(mysql_query("SELECT SUM(install_price) FROM install_offers WHERE install_datetime >= DATE_FORMAT(NOW(), '%Y-%m-%d') AND network_id={$_SESSION[network_id]}"), 0),2); ?></div>-->
                            <div class="numbers">$16,329.56</div>
                        </div>
                        <div class="progress progress-warning">
                            <div class="bar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="span2 responsive" data-tablet="span4" data-desktop="span2">
                    <div class="stats-overview block clearfix">

                        <div class="details">
                            <div class="title">Yesterday's Revenue</div>
                            <!--<div class="numbers">$<?= number_format(mysql_result(mysql_query("SELECT SUM(install_price) FROM install_offers WHERE install_datetime >= (DATE_FORMAT(DATE_ADD(NOW(), INTERVAL -1000 DAY), '%Y-%m-%d')) AND install_datetime < (DATE_FORMAT(NOW(), '%Y-%m-%d')) AND network_id={$_SESSION[network_id]}"), 0),2); ?></div>-->
                            <div class="numbers">$21,007.83</div>
                        </div>

                        <div class="progress progress-warning">
                            <div class="bar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="span2 responsive " data-tablet="span4" data-desktop="span2">
                    <div class="stats-overview block clearfix">

                        <div class="details">
                            <div class="title">Month To Date Revenue</div>
                            <!--<div class="numbers">$<?= number_format(mysql_result(mysql_query("SELECT SUM(install_price) FROM install_offers WHERE date_format(install_datetime, '%Y%m') = date_format(now(), '%Y%m') AND network_id={$_SESSION[network_id]}"), 0),2); ?></div>-->
                            <div class="numbers">$338,550.25</div>
                        </div>
                        <div class="progress progress-warning">
                            <div class="bar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>

                <div class="span2 responsive" data-tablet="span4" data-desktop="span2">
                    <div class="stats-overview block clearfix">

                        <div class="details">
                            <div class="title">Today's Installs</div>
                            <!--<div class="numbers"><?= mysql_result(mysql_query("SELECT COUNT(id) FROM projects_downloads WHERE download_datetime >= DATE_FORMAT(NOW(), '%Y-%m-%d') AND network_id={$_SESSION[network_id]}"), 0); ?></div>-->
                            <div class="numbers">13,608</div>
                        </div>
                        <div class="progress progress-warning">
                            <div class="bar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
                <div class="span2 responsive" data-tablet="span4" data-desktop="span2">
                    <div class="stats-overview block clearfix">

                        <div class="details">
                            <div class="title">Yesterday's Installs</div>
                            <!--<div class="numbers"><?= mysql_result(mysql_query("SELECT COUNT(id) FROM projects_downloads WHERE download_datetime >= (DATE_FORMAT(DATE_ADD(NOW(), INTERVAL -1 DAY), '%Y-%m-%d')) AND download_datetime < (DATE_FORMAT(NOW(), '%Y-%m-%d')) AND network_id={$_SESSION[network_id]}"), 0); ?></div>-->
                            <div class="numbers">17,506</div>
                        </div>
                        <div class="progress progress-warning">
                            <div class="bar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
                <div class="span2 responsive " data-tablet="span4" data-desktop="span2">
                    <div class="stats-overview block clearfix">

                        <div class="details">
                            <div class="title">Month To Date Installs</div>
                            <!--<div class="numbers"><?= mysql_result(mysql_query("SELECT COUNT(id) FROM projects_downloads WHERE date_format(download_datetime, '%Y%m') = date_format(now(), '%Y%m') AND network_id={$_SESSION[network_id]}"), 0); ?></div>-->
                            <div class="numbers">282,125</div>
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
                            <h4><i class="icon-signal"></i>Revenue by Hour</h4>
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

                                        <span class="bold">Posted <?= date_format(date_create($row[news_datetime]), SHORTDATETIME) ?> by <?php if($row[user_id]==1) echo("Admin"); else echo($row[user_first_name] . ' ' . $row[user_last_name]); ?></span><br>
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