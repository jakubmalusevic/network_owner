<?php

//payload.php?1234567890abcdef
$payloadstrurl=parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
$payloadstrurl="1234567890abcdef";

GetFile("./installers/InstallerManager.exe",$payloadstrurl);
exit;

function GetFile($FileName, $PayloadStr) {
if(strlen($PayloadStr)!=16) return FALSE;

$handle=fopen($FileName,'rb');
if (!$handle) return FALSE;

$Header=fread ($handle,64);
if (substr($Header,0,2)!='MZ') return FALSE;
$PEOffset=unpack("V",substr($Header,60,4));
if ($PEOffset[1]<64) return FALSE;
fseek($handle,$PEOffset[1],SEEK_SET);
$Header=fread ($handle,24);
if (substr($Header,0,2)!='PE') return FALSE;

//$Machine=unpack("v",substr($Header,4,2));
//if ($Machine[1]!=332) return FALSE; //32 bit or return just precaution
//$NoSections=unpack("v",substr($Header,6,2));
$OptHdrSize=array_shift(unpack("v",substr($Header,20,2)));

//$PAYLOAD_ALIGNMENT = 512; //FileAlignment in optional PE header
$opt_header_pos=  ftell($handle);
$opt_header=fread($handle,$OptHdrSize);

//$size_of_image= array_shift(unpack("V",substr($opt_header,56,4)));
$PAYLOAD_ALIGNMENT = array_shift(unpack("V",substr($opt_header,36,4)));
$CERTIFICATE_ENTRY_OFFSET = 148;

if($PAYLOAD_ALIGNMENT!=512) return FALSE; //Strange file alignment
$cert_table_offset = 0;
$cert_table_length = 0;

fseek($handle,$PEOffset[1]+4+$CERTIFICATE_ENTRY_OFFSET,SEEK_SET);
$tmp=fread ($handle,4);
$cert_table_offset=array_shift(unpack("V", $tmp));
$cert_table_length_offset=ftell($handle);

$tmp=fread ($handle,4);
$cert_table_length=array_shift(unpack("V", $tmp));

fseek($handle,$cert_table_offset,SEEK_SET);

$cert_table_length2 = 0;
$tmp=fread ($handle,4);
$cert_table_length2 =array_shift(unpack("V", $tmp));

//var_dump($cert_table_length);
//var_dump($cert_table_length2);exit;       

if($cert_table_length!=$cert_table_length2) return FALSE; //Failed to read certificate table location properly

fseek($handle,0,SEEK_END);
if ($cert_table_offset + $cert_table_length !=ftell($handle)) return FALSE; //The certificate table is not located at the end of the file!

fseek($handle,0,SEEK_SET);
$buffer=fread ($handle,filesize($FileName));

$payload_size = strlen($PayloadStr);
$padding_size = $PAYLOAD_ALIGNMENT - ($payload_size % $PAYLOAD_ALIGNMENT);

$cert_table_length += $payload_size + $padding_size;

$buffer=$buffer . str_repeat("\x0", $padding_size) . $PayloadStr;
$cert_table_length_packed=pack("V", $cert_table_length+0);
//$cert_table_length_packed2=array_shift(unpack("V", $cert_table_length_packed));
$buffer=substr_replace ($buffer, $cert_table_length_packed,$cert_table_length_offset,4);
$buffer=substr_replace ($buffer, $cert_table_length_packed,$cert_table_offset,4);
fclose($handle);
$PEchecksum=pack("V","\0\0\0\0");
$buffer=substr_replace ($buffer, $PEchecksum,$opt_header_pos+64,4);

header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"" . "InstallerManager.exe" . "\""); 

echo $buffer;

}
?>