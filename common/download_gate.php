<?
 
function RandomString()
{
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $len = strlen($characters);
    
     
    $randstring = "";
    for ($i = 0; $i < 16; $i++) {
        $randstring .= $characters[rand(0, $len-1)];
    }
    return $randstring;     
}

//$download_url = "http://installmetrix.com/common/download_from_gate.php?cid=";
$download_url = "download_from_gate.php?cid=";
   
$filename = $_REQUEST['file'];
$proj_id = $_REQUEST['cid']; 
$ip_addr = $_SERVER['REMOTE_ADDR'];
$agent = $_SERVER['HTTP_USER_AGENT'];
if($ip_addr == "::1")
    $ip_addr = "206.225.132.11";
    
$download_id = RandomString();   

     

$str = '<script type="text/javascript"> document.cookie="installmetrix_downloadid=' . $download_id . '; expires=Wen, 31 Dec 2014 12:00:00 GMT"; </script>';

echo($str); 
      
$res = '<script language="JavaScript">window.location.href = "' . $download_url . $proj_id . '&file=' . $filename . '&ip_addr=' . $ip_addr;
$res .=  '&agent=' . $agent . '&referer=' . $_SERVER[HTTP_REFERER] . '&subid1=' . $_REQUEST[subid1];
$res .=  '&subid2=' . $_REQUEST[subid2] . '&subid3=' . $_REQUEST[subid3] . '&subid4=' . $_REQUEST[subid4] . '&subid5=' . $_REQUEST[subid5] . '&download_id=' . $download_id . '"</script>';  
echo($res);
//var_dump($res);exit;


?>