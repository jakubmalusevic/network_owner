<?php
include '../common/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
}

if($_REQUEST[mode] == "category_offer")
{
    $category_id = $_REQUEST['category_id'];
    $cid = $_REQUEST['cid'];

    $sql="SELECT o.* FROM offers o, offer_categories oc WHERE oc.category_id='{$category_id}' AND o.id=oc.offer_id AND o.id NOT IN (SELECT offer_id FROM projects_offer WHERE proj_id='{$cid}')";
    //var_dump($sql);exit;
    $result = mysql_query($sql);
    $str = '<div id="comment_"><b>Please select offer to add</b></div>';
    $str .= "<select size='5' name='new_offer_id' data-placeholder='Select an offer to add' class='chosen-with-diselect' tabindex='-1' id='selCSI_{$category_id}' style='width: 500px; z-index: 1000; overflow: auto;'>";
            $str .= '<option value=""></option>';
                                            
            while ($row = mysql_fetch_assoc($result)) {
                $str .= "<option value='{$row[id]}'>{$row[offer_name]}</option>";
                
            }
    $str .= '</select>';
    echo($str);
}
else if($_REQUEST[mode] == "getorderstable_by_categoryid")
{
    $proj_id = $_REQUEST[proj_id];//campign id
    $cat_id = $_REQUEST[cat_id]; //category id
    
    //identify offer or group
    $sql = "SELECT isgroup FROM offer_categories WHERE category_id={$cat_id}";
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);
    if($row[isgroup]==0)
    {
        //this is offer
    
        $sql = "SELECT o.id, o.offer_name, po.rate_rotation FROM offers o, (SELECT * FROM offer_categories WHERE category_id={$cat_id}) oc LEFT OUTER JOIN (SELECT * FROM projects_offer WHERE cat_id={$cat_id} AND proj_id={$proj_id}) po ON oc.offer_id=po.offer_id WHERE o.id=oc.offer_id ";
        
        $result = mysql_query($sql); 
        $str = '<table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>OID</th>
                            <th>Offer Name</th>
                            <th>% Rotation</th>                                                        
                        </tr>
                    </thead>
                    <tbody>';
        while ($row = mysql_fetch_assoc($result)) {
            
            if($row[rate_rotation] == NULL)
                $row[rate_rotation] = 0;    
            $str = $str . '<tr class="odd gradeX"><td class="highlight"><a href="offer_edit.php?oid=' . $row[id] . '"><div class="success"></div>' . $row[id] . '</a></td>';
            $str = $str . '<td>' . $row[offer_name] . '</td>';
            //$str = $str . '<td><input style="width:50px;" type="text" name="' . $row[id] . '_txt" value="' . $row[rate_rotation] . '"> %</td></tr>';
            $str = $str . '<td><input type="hidden" name="offer_ids[]" value="' . $row[id] . '"><input style="width:50px;" type="text" name="rate[]" value="' . $row[rate_rotation] . '"> %</td></tr>';
        } 
        $str = $str . '</tbody> </table>';
    }
    else
    {
        //this is group
        $sql = "SELECT og.id, og.name FROM offergroups og, offer_categories oc WHERE og.id=oc.offer_id AND oc.category_id={$cat_id}";
        
        $result = mysql_query($sql); 
        $str = '<table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>OID</th>
                            <th>Offer Name</th>
                            <th>% Rotation</th>                                                        
                        </tr>
                    </thead>
                    <tbody>';
        while ($row = mysql_fetch_assoc($result)) { 
            $str = $str . '<tr class="odd gradeX"><td class="highlight"><a href="offergroup_edit.php?id=' . $row[id] . '"><div class="success"></div>' . $row[id] . '</a></td>';
            $str = $str . '<td>' . $row[name] . '</td>';
            //$str = $str . '<td><input style="width:50px;" type="text" name="' . $row[id] . '_txt" value="' . $row[rate_rotation] . '"> %</td></tr>';
            $str = $str . '<td><input type="hidden" name="offer_ids[]" value="' . $row[id] . '"><input style="width:50px;" type="text" name="rate[]" value="100" > %</td></tr>';
        } 
        $str = $str . '</tbody> </table>';
        
    }
    echo($str);
}

?>