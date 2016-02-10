<?

include 'config.php';

error_reporting(E_ALL ^ E_NOTICE);

//$gate_url = 'http://publishers.startinstaller.com/gate/installer_gate.php?id=20';
//
//$image_file = $_SERVER['DOCUMENT_ROOT'] . '/installers/startinstaller.exe';
//$new_file = $_SERVER['DOCUMENT_ROOT'] . '/installers/startinstaller_temp.exe';
//$gate_url = "http://" . $_SERVER['SERVER_NAME'] . "/gate/installer_gate.php?id=" . $proj_id;
//$gate_url = str_pad($gate_url, 150, " ");
//copy($image_file, $new_file);
//
//$handle = fopen($new_file, "a+");
//fwrite($handle, $gate_url);
//fclose($handle);
//$url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452&sensor=false&language=en";

?>
<html>
  <head>
    
  </head>
  <body>


    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>  
    <script type="text/javascript">
    //var ax = new ActiveXObject("WScript.Network");
        document.cookie="installmetrix_downloadid=243aa123123123; expires=Sat, 25 Jan 2014 12:00:00 GMT";
        
        //var x = document.cookie;
        
        //document.cookie="testcookie1=ttest; expires=Sat, 25 Jan 2014 12:00:00 GMT";
        
        var x1 = document.cookie;
        alert(x1);

    </script>

  </body>
</html>