<?

include 'config.php';

function user_browser($agent) {
    preg_match("/(MSIE|Opera|Firefox|Chrome|Version|Opera Mini|Netscape|Konqueror|SeaMonkey|Camino|Minefield|Iceweasel|K-Meleon|Maxthon)(?:\/| )([0-9.]+)/", $agent, $browser_info);
    list(, $browser, $version) = $browser_info;
    if (preg_match("/Opera ([0-9.]+)/i", $agent, $opera))
        return 'Opera|' . $opera[1];
    if ($browser == 'MSIE') {
        preg_match("/(Maxthon|Avant Browser|MyIE2)/i", $agent, $ie);
        if ($ie)
            return $ie[1] . ' based on IE|' . $version;
        return 'IE|' . $version;
    }
    if ($browser == 'Firefox') {
        preg_match("/(Flock|Navigator|Epiphany)\/([0-9.]+)/", $agent, $ff);
        if ($ff)
            return $ff[1] . '|' . $ff[2];
    }
    if ($browser == 'Opera' && $version == '9.80')
        return 'Opera|' . substr($agent, -5);
    if ($browser == 'Version')
        return 'Safari|' . $version;
    if (!$browser && strpos($agent, 'Gecko'))
        return 'Browser based on Gecko';
    return $browser . '|' . $version;
}

function user_os($userAgent) {
    $oses = array(
        'iPhone' => '(iPhone)',
        'Windows 3.11' => 'Win16',
        'Windows 95' => '(Windows 95)|(Win95)|(Windows_95)',
        'Windows 98' => '(Windows 98)|(Win98)',
        'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
        'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
        'Windows 2003' => '(Windows NT 5.2)',
        'Windows Vista' => '(Windows NT 6.0)|(Windows Vista)',
        'Windows 7' => '(Windows NT 6.1)|(Windows 7)',
        'Windows NT 4.0' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
        'Windows ME' => 'Windows ME',
        'Open BSD' => 'OpenBSD',
        'Sun OS' => 'SunOS',
        'Linux' => '(Linux)|(X11)',
        'Safari' => '(Safari)',
        'Mac OS' => '(Mac_PowerPC)|(Macintosh)',
        'QNX' => 'QNX',
        'BeOS' => 'BeOS',
        'OS/2' => 'OS/2',
        'Search Bot' => '(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp/cat)|(msnbot)|(ia_archiver)'
    );
    foreach ($oses as $os => $pattern) {
        if (eregi($pattern, $userAgent)) {
            return $os;
        }
    }
    return 'Unknown';
}

$fullPath = $my_common_path . 'installers/InstallerManager.exe';

if (file_exists($fullPath)) { 
    
    session_write_close(); //david important

    //var_dump($fullPath);exit;
    $filename = $_REQUEST['file'];
    $proj_id = $_REQUEST['cid'];  
        
    //$download_id = $_REQUEST['download_id']; 
    $download_id = RandomString();        
    
    $ip_addr = $_SERVER[REMOTE_ADDR];
    if($ip_addr == "::1")
        $ip_addr = "206.225.132.11";
    
    //david    
    $geoplugin = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip_addr));
    $url = 'http://www.geoplugin.net/php.gp?ip=' . $ip_addr;
    //$ch1 = curl_init();
    //curl_setopt($ch1, CURLOPT_URL, $url);
    //curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
    //$result = curl_exec($ch1);
    //$geoplugin = unserialize($result);      
                                                 
       
    $browser_ret = user_browser($_SERVER[HTTP_USER_AGENT]);
    $browser_ret_arr = explode('|', $browser_ret);     
                    
    $user_os = user_os($_SERVER[HTTP_USER_AGENT]); 

    $fsize = filesize($fullPath) + 16;
    
    $path_parts = pathinfo($fullPath);
    
    $ext = strtolower($path_parts["extension"]);
    switch ($ext) {
        case "pdf":
            header("Content-type: application/pdf"); // add here more headers for diff. extensions
            header("Content-Disposition: attachment; filename=\"" . $filename . "\""); // use 'attachment' to force a download
            break;
        default;
            header("Content-type: application/octet-stream");
            header("Content-Disposition: filename=\"" . urlencode($filename) . "\"");
    }
    header("Content-length: $fsize");
    header("Cache-control: private"); //use this to open files directly
    

    ob_clean();
    flush();
    readfile($fullPath);
    
      
    
    
    $ins_sql =  "INSERT INTO `projects_downloads`(
                `proj_id`,
                `download_datetime`,
                `download_ip`,
                `download_country_code`,
                `download_country`,
                `download_region`,
                `download_city`,
                `download_lat`,
                `download_lon`,
                `download_useragent`,
                `download_browser`,
                `download_browser_ver`,
                `download_os`,
                `download_referer_url`,
                `download_subid1`,
                `download_subid2`,
                `download_subid3`,
                `download_subid4`,
                `download_subid5`,
                `download_id`
                ) VALUES (
                '{$proj_id}',
                NOW(),
                '{$ip_addr}',
                 '{$geoplugin[geoplugin_countryCode]}',
                '{$geoplugin[geoplugin_countryName]}',
                '{$geoplugin[geoplugin_region]}',
                '{$geoplugin[geoplugin_city]}',
                '{$geoplugin[geoplugin_latitude]}',
                '{$geoplugin[geoplugin_longitude]}',
                '{$_SERVER[HTTP_USER_AGENT]}',
                '{$browser_ret_arr[0]}',
                '{$browser_ret_arr[1]}',
                '{$user_os}',
                '{$_SERVER[HTTP_REFERER]}',
                '{$_REQUEST[subid1]}',
                '{$_REQUEST[subid2]}',
                '{$_REQUEST[subid3]}',
                '{$_REQUEST[subid4]}',
                '{$_REQUEST[subid5]}',
                '{$download_id}'
                )";
    
    //var_dump($ins_sql);  exit;       
    
    mysql_query($ins_sql); 
    
     
}

?>