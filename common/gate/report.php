<?php

include '../config.php';

/*
input sample : ../report.php?download_id=LFA0Z4eE9iV2Q52D&mode=2&os_name=Windows 7&os_add=&os_build=7600&proj_id=1012&offer_id=1027
mode => 0 : project install try , 1: project install success, 2: offer install try , 3: offer install success 
*/
if ($_REQUEST["download_id"] != '') 
{   
    
    $download_id = $_REQUEST["download_id"]; 
    $mode = $_REQUEST["mode"];
    $os_name = $_REQUEST["os_name"];
    $os_add = $_REQUEST["os_add"];
    $os_build = $_REQUEST["os_build"];
    $proj_id = $_REQUEST["proj_id"];         
    $offer_id = $_REQUEST["offer_id"]; 
    $templateid = $_REQUEST["templateid"]; 
    
    $remote_ip = $_SERVER["REMOTE_ADDR"];                                         
    
    if($mode == "0")
    {
        $sql = "UPDATE projects p SET p.install_started = p.install_started +1 WHERE p.id=" . $proj_id;
        //var_dump($sql);
        $q = mysql_query($sql);  
        
        $sql = "INSERT INTO install_projects (`id`, `proj_id`, `download_id`, `template_id`, `install_datetime`, `install_state`) VALUES (NULL, '{$proj_id}', '{$download_id}', '{$templateid}', CURRENT_TIMESTAMP, '0');";
        $q = mysql_query($sql);  
    }
    else if($mode == "1")
    {

        $sql = "UPDATE projects p SET p.install_successed = p.install_successed +1 WHERE p.id=" . $proj_id;
        //var_dump($sql);
        $q = mysql_query($sql);    
        
        $sql = "INSERT INTO install_projects (`id`, `proj_id`, `download_id`, `template_id`, `install_datetime`, `install_state`) VALUES (NULL, '{$proj_id}', '{$download_id}', '{$templateid}', CURRENT_TIMESTAMP, '1');";
        $q = mysql_query($sql);  
    }
    else if($mode == "2")       
    {        
        $sql = "INSERT INTO install_offers (`id`, `network_id`, `proj_id`, `offer_id`, `template_id`, `install_datetime`, `install_state`, `os_name`, `os_additional`, `os_build`, `ip`,`download_id`) VALUES (NULL, '-1', '{$proj_id}', '{$offer_id}', '{$templateid}', NOW(), '0', '{$os_name}', '{$os_add}', '{$os_build}', '{$remote_ip}', '{$download_id}');";
        $q = mysql_query($sql);       
    }
    else if($mode == "3")       
    {        
        $sql = "INSERT INTO install_offers (`id`, `network_id`, `proj_id`, `offer_id`, `template_id`, `install_datetime`, `install_state`, `os_name`, `os_additional`, `os_build`, `ip`,`download_id`) VALUES (NULL, '-1', '{$proj_id}', '{$offer_id}', '{$templateid}', NOW(), '1', '{$os_name}', '{$os_add}', '{$os_build}', '{$remote_ip}', '{$download_id}');";
        $q = mysql_query($sql);       
    }
}  
 
?>