<?

include 'config.php';

error_reporting(E_ALL ^ E_NOTICE);

?>
<html>
  <head>
    
  </head>
  <body>

  <?php
  $flag = 1;
  $t = 0;
  while($flag==1)
  {
    $sql = "SELECT ttt.id, ttt.download_id FROM projects_downloads ttt WHERE ttt.download_id IN (SELECT tt.download_id FROM (SELECT download_id, count(download_id) as c FROM projects_downloads GROUP BY download_id) tt WHERE tt.c>1) GROUP BY ttt.download_id ";
    $q = mysql_query($sql);
    $k = 0;
    while ($row = mysql_fetch_assoc($q)) 
    {
        echo $row[download_id];  echo "<br>";
        $sql1 = "DELETE FROM projects_downloads WHERE download_id='{$row[download_id]}' AND id='{$row[id]}'";
        $q1 = mysql_query($sql1);
        
        $k = $k + 1;
        
        $t = $t + 1;
    }
    if($k == 0)
        break;
  }
  
  var_dump($t); exit;
?>
  </body>
</html>
