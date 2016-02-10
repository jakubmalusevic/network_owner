<?php

include '../config.php';
   
if ($_REQUEST["download_id"] != '') {
    
    header("Content-type: text/xml");
    set_time_limit(0);
    ob_implicit_flush();
       
    $download_id = $_REQUEST["download_id"];
    $sql = "SELECT u.subid, p.* FROM projects p, projects_downloads pd, users u WHERE p.assigned_user_id=u.id AND p.id=pd.proj_id AND pd.download_id='{$download_id}'";
     
    //var_dump($sql); exit;    
    
    $q = mysql_query($sql);
    $row = mysql_fetch_assoc($q); 
    
    

    foreach ($row as $key => $value) {
        $row[$key] = htmlspecialchars($value);
    }
  
    $proj_id = $row[id]; 
    $pub_id = $row[assigned_user_id]; 
    $pub_subid = $row[subid];
    
    
    ///// make template html
    $sql = "SELECT * FROM projects_template WHERE proj_id={$proj_id}";
    $q = mysql_query($sql);
    $rand_val = rand(0,100);
    $tmp_val = 0;
    $tmpl_id = 0;
    while ($row = mysql_fetch_assoc($q))
    {
        $tmp_val += $row[rate];
        if($rand_val<=$tmp_val)
        {
            $tmpl_id = $row[tmpl_id];
            break;
        }
    }
        
    $html_path = $my_common_path . "interface/htmls/";
    $html_url = $common_path_url . "interface/htmls/";
    
    $sql = "SELECT * FROM templates WHERE id={$tmpl_id}";
    $q = mysql_query($sql);
    $row = mysql_fetch_assoc($q);
    
    $main_path = $row[maintemplate_filepath];
    $download_path = $row[downloadtemplate_filepath];
    $thank_path = $row[thanktemplate_filepath];
    
    
    $sql_p = "SELECT * FROM projects WHERE id={$proj_id}";
    $q_p = mysql_query($sql_p);
    $row_p = mysql_fetch_assoc($q_p);
    
    $logo_url = $common_path_url . "installer_logos/" . $proj_id . ".jpg";
    
    //get software description for template 
    $sql_t = "SELECT * FROM projects_template WHERE proj_id={$proj_id} AND tmpl_id='{$tmpl_id}'";
    $q_t = mysql_query($sql_t);
    $desc_for_template = "";
    if(mysql_numrows($q_t)>0)
    {
        $row_t = mysql_fetch_assoc($q_t);
        if($row_t[description]!="")
        {
            $desc_for_template = $row_t[description];
        }  
    }
    if($desc_for_template == "")
    {
        $desc_for_template = $row_p[software_description]; // project default description    
    }
     
    {
    //make main template html      
    //var_dump($main_path); exit;    
    $homepage = file_get_contents($main_path);    
    
    if($row_p[software_tos_url] == "")
        $homepage = str_replace("@tos_url_enable@", "return false;", $homepage); 
    else
        $homepage = str_replace("@tos_url_enable@", "return true;", $homepage); 
        
    if($row_p[software_pp_url] == "")
        $homepage = str_replace("@pp_url_enable@", "return false;", $homepage); 
    else
        $homepage = str_replace("@pp_url_enable@", "return true;", $homepage); 
        
    if($row_p[software_eula_url] == "")
        $homepage = str_replace("@eula_url_enable@", "return false;", $homepage); 
    else
        $homepage = str_replace("@eula_url_enable@", "return true;", $homepage); 

    $strdesc =  $desc_for_template;     
    //var_dump($strdesc);exit;   
    $strdesc = str_replace("\\r\\n","",$strdesc);
    $strdesc = str_replace("\\","",$strdesc);
    
    $homepage = str_replace("@description@", $strdesc, $homepage);
    
    $homepage = str_replace("@logo_image@", $logo_url, $homepage);
    $homepage = str_replace("@title@", $row_p[software_name] , $homepage);
    $homepage = str_replace("@version@", $row_p[software_version] , $homepage);        
    $homepage = str_replace("@tos_url@", $row_p[software_tos_url], $homepage); 
    $homepage = str_replace("@pp_url@", $row_p[software_pp_url], $homepage); 
    $homepage = str_replace("@eula_url@", $row_p[software_eula_url], $homepage); 
    
    $homepage_path = $html_path . "main-" . $download_id . ".htm";
    file_put_contents($homepage_path, $homepage); 
    
    $main_homepage_url = $html_url . "main-" . $download_id . ".htm";  
    }
    
    {
    //make download template html          
    $homepage = file_get_contents($download_path);    
    
    if($row_p[software_tos_url] == "")
        $homepage = str_replace("@tos_url_enable@", "return false;", $homepage); 
    else
        $homepage = str_replace("@tos_url_enable@", "return true;", $homepage); 
        
    if($row_p[software_pp_url] == "")
        $homepage = str_replace("@pp_url_enable@", "return false;", $homepage); 
    else
        $homepage = str_replace("@pp_url_enable@", "return true;", $homepage); 
        
    if($row_p[software_eula_url] == "")
        $homepage = str_replace("@eula_url_enable@", "return false;", $homepage); 
    else
        $homepage = str_replace("@eula_url_enable@", "return true;", $homepage); 

    $strdesc =  $row_p[software_description];        
    $strdesc = str_replace("\\r\\n","",$strdesc);
    $strdesc = str_replace("\\","",$strdesc);
    
    $homepage = str_replace("@logo_image@", $logo_url, $homepage);
    $homepage = str_replace("@title@", $row_p[software_name] , $homepage);
    $homepage = str_replace("@version@", $row_p[software_version] , $homepage);        
    $homepage = str_replace("@description@", $strdesc, $homepage);
    $homepage = str_replace("@tos_url@", $row_p[software_tos_url], $homepage); 
    $homepage = str_replace("@pp_url@", $row_p[software_pp_url], $homepage); 
    $homepage = str_replace("@eula_url@", $row_p[software_eula_url], $homepage); 
    
    $homepage_path = $html_path . "download-" . $download_id . ".htm";
    file_put_contents($homepage_path, $homepage); 
    
    $download_homepage_url = $html_url . "download-" . $download_id . ".htm";  
    }
    
    {
    //make thank template html          
    $homepage = file_get_contents($thank_path);    
    
    if($row_p[software_tos_url] == "")
        $homepage = str_replace("@tos_url_enable@", "return false;", $homepage); 
    else
        $homepage = str_replace("@tos_url_enable@", "return true;", $homepage); 
        
    if($row_p[software_pp_url] == "")
        $homepage = str_replace("@pp_url_enable@", "return false;", $homepage); 
    else
        $homepage = str_replace("@pp_url_enable@", "return true;", $homepage); 
        
    if($row_p[software_eula_url] == "")
        $homepage = str_replace("@eula_url_enable@", "return false;", $homepage); 
    else
        $homepage = str_replace("@eula_url_enable@", "return true;", $homepage); 

    $strdesc =  $row_p[software_description];        
    $strdesc = str_replace("\\r\\n","",$strdesc);
    $strdesc = str_replace("\\","",$strdesc);
    
    $homepage = str_replace("@logo_image@", $logo_url, $homepage);
    $homepage = str_replace("@title@", $row_p[software_name] , $homepage);
    $homepage = str_replace("@version@", $row_p[software_version] , $homepage);        
    $homepage = str_replace("@description@", $strdesc, $homepage);
    $homepage = str_replace("@tos_url@", $row_p[software_tos_url], $homepage); 
    $homepage = str_replace("@pp_url@", $row_p[software_pp_url], $homepage); 
    $homepage = str_replace("@eula_url@", $row_p[software_eula_url], $homepage); 
    
    $homepage_path = $html_path . "thank-" . $download_id . ".htm";
    file_put_contents($homepage_path, $homepage); 
    
    $thank_homepage_url = $html_url . "thank-" . $download_id . ".htm";  
    }
    
    ///////  make xml

    $xmlmsg = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
    $xmlmsg .= "<response>";
    $xmlmsg .= "<ip>" . $_SERVER["REMOTE_ADDR"] . "</ip>";
    $xmlmsg .= "<application>";
    $xmlmsg .= "<software_id>" . $proj_id . "</software_id>";    
    $xmlmsg .= "<software_name>" . $row_p[software_name] . "</software_name>"; 
    $xmlmsg .= "<software_url>" . $row_p[software_url] . "</software_url>";
    
    $slient = str_replace("@pubid@", $pub_id, $row_p[software_silent]); 
    $xmlmsg .= "<software_silent>" . $slient . "</software_silent>";     
    $xmlmsg .= "<software_templateid>" . $tmpl_id . "</software_templateid>"; 
    $xmlmsg .= "<software_html1>" . $main_homepage_url . "</software_html1>";     
    $xmlmsg .= "<software_html2>" . $download_homepage_url . "</software_html2>";     
    $xmlmsg .= "<software_html3>" . $thank_homepage_url . "</software_html3>";     
    $xmlmsg .= "<software_exiturl>" . $row_p[software_exit_url] . "</software_exiturl>";  
    $xmlmsg .= "</application>";

     //echo $xmlmsg;exit;

     
        ///// offers part
    
    // get categories and order from project id
    $offer_count = 0;
    $sql_cat = "SELECT cat_id FROM projects_offer WHERE proj_id={$proj_id} GROUP BY cat_id ORDER BY cat_order";    
    $q_cat = mysql_query($sql_cat);
    
    $count_cat = mysql_numrows($q_cat);
    $xmlmsg .= "<category_count>" . $count_cat . "</category_count>";    
    while ($row_cat = mysql_fetch_assoc($q_cat))
    {
        ///list offers
        $cat_id = $row_cat[cat_id];
        
        //identicate offer or group
        $sql_og = "SELECT isgroup FROM offer_categories WHERE category_id={$cat_id}";
        $q_og = mysql_query($sql_og);
        $row_og = mysql_fetch_assoc($q_og);

        if($row_og[isgroup]=="1")
        {
            //this is group
            
            $sql_group = "SELECT og.* FROM offergroups og, offer_categories oc WHERE oc.category_id={$cat_id} AND og.id=oc.offer_id";
            //var_dump($sql_group);exit;
            $q_group = mysql_query($sql_group);
            $row_group = mysql_fetch_assoc($q_group);
            $xmlmsg .= "<offer_category>";     
            $xmlmsg .= "<group>";
            $xmlmsg .= "<group_name>" . $row_group[name] . "</group_name>";
                        
            /// replace key in group description                                
            $group_desc = $row_group[description]; 
            $group_desc = str_replace("@title@", $row_p[software_name] , $group_desc);
            $group_desc = str_replace("@version@", $row_p[software_version] , $group_desc);                        
                       
            $xmlmsg .= "<group_description>" . $group_desc . "</group_description>";  
            
              
            
            $offer_id_arr = array($row_group[offer1_id],$row_group[offer2_id],$row_group[offer3_id],$row_group[offer4_id],$row_group[offer5_id]);
            $isdefault_arr = array($row_group[isdefault_1],$row_group[isdefault_2],$row_group[isdefault_3],$row_group[isdefault_4],$row_group[isdefault_5]);
             
            for($i=0;$i<5;$i++)
            {
                if($offer_id_arr[$i] != 0)
                {
                    $xmlmsg .= "<offer_application>"; 
                    $xmlmsg .= "<isdefault>" . $isdefault_arr[$i] . "</isdefault>";
                    $xmlmsg .= "<offer_id>" . $offer_id_arr[$i] . "</offer_id>";
                    
                    //get offer1
                    $sql_offer = "SELECT * FROM offers WHERE id={$offer_id_arr[$i]}";
                    $q_offer = mysql_query($sql_offer);
                    $row_offer = mysql_fetch_assoc($q_offer);
                    
                    $xmlmsg .= "<offer_name>" . $row_offer[offer_name] . "</offer_name>"; 
                       
                    /// replace key to contents in offer description
                    
                    $homepage = $row_offer[offer_description];
                    if($row_offer[offer_tos_url] == "")
                        $homepage = str_replace("@tos_url_enable@", "return false;", $homepage); 
                    else
                        $homepage = str_replace("@tos_url_enable@", "return true;", $homepage); 
                        
                    if($row_offer[offer_pp_url] == "")
                        $homepage = str_replace("@pp_url_enable@", "return false;", $homepage); 
                    else
                        $homepage = str_replace("@pp_url_enable@", "return true;", $homepage); 
                        
                    if($row_offer[offer_eula_url] == "")
                        $homepage = str_replace("@eula_url_enable@", "return false;", $homepage); 
                    else
                        $homepage = str_replace("@eula_url_enable@", "return true;", $homepage); 
                    
                    $homepage = str_replace("@logo_image@", $logo_url, $homepage);
                    $homepage = str_replace("@title@", $row_p[software_name] , $homepage);
                    $homepage = str_replace("@version@", $row_p[software_version] , $homepage);        
                    $homepage = str_replace("@tos_url@", $row_offer[offer_tos_url], $homepage); 
                    $homepage = str_replace("@pp_url@", $row_offer[offer_pp_url], $homepage); 
                    $homepage = str_replace("@eula_url@", $row_offer[offer_eula_url], $homepage); 
                    
                    ///
                    
                    $xmlmsg .= "<offer_desc>" . $homepage . "</offer_desc>";
                    $xmlmsg .= "<offer_url>" . $row_offer[offer_url] . "</offer_url>";
                    
                    /// slient keys
                    $slient = str_replace("@pubid@", $pub_subid, $row_offer[offer_silent_main]); 
                    $xmlmsg .= "<offer_silent_main>" . $slient . "</offer_silent_main>";
                    
                    $xmlmsg .= "<offer_silent_check1_on>" . $row_offer[offer_silent_check1_on] . "</offer_silent_check1_on>";
                    $xmlmsg .= "<offer_silent_check1_off>" . $row_offer[offer_silent_check1_off] . "</offer_silent_check1_off>";
                    $xmlmsg .= "<offer_silent_check2_on>" . $row_offer[offer_silent_check2_on] . "</offer_silent_check2_on>";
                    $xmlmsg .= "<offer_silent_check2_off>" . $row_offer[offer_silent_check2_off] . "</offer_silent_check2_off>";
                    $xmlmsg .= "<offer_silent_check3_on>" . $row_offer[offer_silent_check3_on] . "</offer_silent_check3_on>";
                    $xmlmsg .= "<offer_silent_check3_off>" . $row_offer[offer_silent_check3_off] . "</offer_silent_check3_off>";
                    $xmlmsg .= "<offer_silent_check4_on>" . $row_offer[offer_silent_check4_on] . "</offer_silent_check4_on>";
                    $xmlmsg .= "<offer_silent_check4_off>" . $row_offer[offer_silent_check4_off] . "</offer_silent_check4_off>";
                    $xmlmsg .= "<offer_silent_check5_on>" . $row_offer[offer_silent_check5_on] . "</offer_silent_check5_on>";
                    $xmlmsg .= "<offer_silent_check5_off>" . $row_offer[offer_silent_check5_off] . "</offer_silent_check5_off>";
                    
                    ///
                    $sql_check = "SELECT method_name FROM checkinstalled_method WHERE id={$row_offer[checkinstalled_method]}";
                    $q_check = mysql_query($sql_check);
                    $row_check = mysql_fetch_assoc($q_check);
                    
                    $xmlmsg .= "<checkinstalled_method>" . $row_check[method_name] . "</checkinstalled_method>";
                    $row_offer[reg_path_pre] = str_replace("\\\\","\\",$row_offer[reg_path_pre]);
                    $xmlmsg .= "<offer_registry_path_pre>" . $row_offer[reg_path_pre] . "</offer_registry_path_pre>";
                    $row_offer[reg_path_64_pre] = str_replace("\\\\","\\",$row_offer[reg_path_64_pre]);
                    $xmlmsg .= "<offer_registry_path_64_pre>" . $row_offer[reg_path_64_pre] . "</offer_registry_path_64_pre>";
                    $row_offer[reg_path_post] = str_replace("\\\\","\\",$row_offer[reg_path_post]);
                    $xmlmsg .= "<offer_registry_path_post>" . $row_offer[reg_path_post] . "</offer_registry_path_post>";
                    $row_offer[reg_path_64_post] = str_replace("\\\\","\\",$row_offer[reg_path_64_post]);
                    $xmlmsg .= "<offer_registry_path_64_post>" . $row_offer[reg_path_64_post] . "</offer_registry_path_64_post>"; 
                    $xmlmsg .= "<offer_rate>" . $row_offer[rate_rotation] . "</offer_rate>";
                    
                    $xmlmsg .= "</offer_application>";                  
                    
                    
                }
                else
                {
                    //offer id is null
                    break;
                }            
            }
            $xmlmsg .= "</group>";                  
            
        }
        else
        {
            //this is offer
            $sql_offer = "SELECT o.*,po.rate_rotation FROM offers o, projects_offer po WHERE o.id=po.offer_id AND po.proj_id={$proj_id} AND po.cat_id={$cat_id} AND po.rate_rotation>0";
            $q_offer = mysql_query($sql_offer);      
            
            $count = mysql_numrows($q_offer);
            $xmlmsg .= "<offer_category>";
            $xmlmsg .= "<offer_count>" . $count . "</offer_count>";
            if($count>0)
            {
                while ($row_offer = mysql_fetch_assoc($q_offer))
                {
                     
                    $xmlmsg .= "<offer_application>";
                    $xmlmsg .= "<isdefault>1</isdefault>";
                    $xmlmsg .= "<offer_id>" . $row_offer[id] . "</offer_id>";
                    $xmlmsg .= "<offer_name>" . $row_offer[offer_name] . "</offer_name>"; 
                    
                       
                    //$xmlmsg .= "<offer_desc>" .  htmlspecialchars( $row_offer[offer_description], ENT_QUOTES ) . "</offer_desc>";
                    
                    //$row_offer[offer_description] = str_replace("\"","&quot;",$row_offer[offer_description]);
                    
                    /// replace key to contents in offer description
                    
                    $homepage = $row_offer[offer_description];
                    if($row_offer[offer_tos_url] == "")
                        $homepage = str_replace("@tos_url_enable@", "return false;", $homepage); 
                    else
                        $homepage = str_replace("@tos_url_enable@", "return true;", $homepage); 
                        
                    if($row_offer[offer_pp_url] == "")
                        $homepage = str_replace("@pp_url_enable@", "return false;", $homepage); 
                    else
                        $homepage = str_replace("@pp_url_enable@", "return true;", $homepage); 
                        
                    if($row_offer[offer_eula_url] == "")
                        $homepage = str_replace("@eula_url_enable@", "return false;", $homepage); 
                    else
                        $homepage = str_replace("@eula_url_enable@", "return true;", $homepage); 
                    
                    $homepage = str_replace("@logo_image@", $logo_url, $homepage);
                    $homepage = str_replace("@title@", $row_p[software_name] , $homepage);
                    $homepage = str_replace("@version@", $row_p[software_version] , $homepage);        
                    $homepage = str_replace("@tos_url@", $row_offer[offer_tos_url], $homepage); 
                    $homepage = str_replace("@pp_url@", $row_offer[offer_pp_url], $homepage); 
                    $homepage = str_replace("@eula_url@", $row_offer[offer_eula_url], $homepage); 
                    
                    ///
                    
                    $xmlmsg .= "<offer_desc>" . $homepage . "</offer_desc>";
                    $xmlmsg .= "<offer_url>" . $row_offer[offer_url] . "</offer_url>";
                    
                    /// slient keys
                    $slient = str_replace("@pubid@", $pub_subid, $row_offer[offer_silent_main]); 
                    $xmlmsg .= "<offer_silent_main>" . $slient . "</offer_silent_main>";
                    
                    $xmlmsg .= "<offer_silent_check1_on>" . $row_offer[offer_silent_check1_on] . "</offer_silent_check1_on>";
                    $xmlmsg .= "<offer_silent_check1_off>" . $row_offer[offer_silent_check1_off] . "</offer_silent_check1_off>";
                    $xmlmsg .= "<offer_silent_check2_on>" . $row_offer[offer_silent_check2_on] . "</offer_silent_check2_on>";
                    $xmlmsg .= "<offer_silent_check2_off>" . $row_offer[offer_silent_check2_off] . "</offer_silent_check2_off>";
                    $xmlmsg .= "<offer_silent_check3_on>" . $row_offer[offer_silent_check3_on] . "</offer_silent_check3_on>";
                    $xmlmsg .= "<offer_silent_check3_off>" . $row_offer[offer_silent_check3_off] . "</offer_silent_check3_off>";
                    $xmlmsg .= "<offer_silent_check4_on>" . $row_offer[offer_silent_check4_on] . "</offer_silent_check4_on>";
                    $xmlmsg .= "<offer_silent_check4_off>" . $row_offer[offer_silent_check4_off] . "</offer_silent_check4_off>";
                    $xmlmsg .= "<offer_silent_check5_on>" . $row_offer[offer_silent_check5_on] . "</offer_silent_check5_on>";
                    $xmlmsg .= "<offer_silent_check5_off>" . $row_offer[offer_silent_check5_off] . "</offer_silent_check5_off>";
                    
                    ///
                    $sql_check = "SELECT method_name FROM checkinstalled_method WHERE id={$row_offer[checkinstalled_method]}";
                    $q_check = mysql_query($sql_check);
                    $row_check = mysql_fetch_assoc($q_check);
                    
                    $xmlmsg .= "<checkinstalled_method>" . $row_check[method_name] . "</checkinstalled_method>";
                    $row_offer[reg_path_pre] = str_replace("\\\\","\\",$row_offer[reg_path_pre]);
                    $xmlmsg .= "<offer_registry_path_pre>" . $row_offer[reg_path_pre] . "</offer_registry_path_pre>";
                    $row_offer[reg_path_64_pre] = str_replace("\\\\","\\",$row_offer[reg_path_64_pre]);
                    $xmlmsg .= "<offer_registry_path_64_pre>" . $row_offer[reg_path_64_pre] . "</offer_registry_path_64_pre>";
                    $row_offer[reg_path_post] = str_replace("\\\\","\\",$row_offer[reg_path_post]);
                    $xmlmsg .= "<offer_registry_path_post>" . $row_offer[reg_path_post] . "</offer_registry_path_post>";
                    $row_offer[reg_path_64_post] = str_replace("\\\\","\\",$row_offer[reg_path_64_post]);
                    $xmlmsg .= "<offer_registry_path_64_post>" . $row_offer[reg_path_64_post] . "</offer_registry_path_64_post>";
                    
                    
                            
                    $xmlmsg .= "<offer_rate>" . $row_offer[rate_rotation] . "</offer_rate>";
                    $xmlmsg .= "</offer_application>";                  
                }  
            }  
        }
        $xmlmsg .= "</offer_category>";  
                 
    }
    
    $xmlmsg .= "</response>";
    echo $xmlmsg;
}

?>