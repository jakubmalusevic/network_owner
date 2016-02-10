<?

include 'config.php';

error_reporting(E_ALL ^ E_NOTICE);

?>
<html>
  <head>
    
  </head>
  <body>

  <?php
    $sql = "select download_datetime, download_id from projects_downloads order by download_datetime desc";
    $q = mysql_query($sql);
    $row = mysql_fetch_assoc($q);
    echo $row[download_id];
?>
  </body>
</html>