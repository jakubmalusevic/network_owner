<?
include 'z_header.php';


FB::log($_SERVER);


if (($_REQUEST[tid] != '') && ($_REQUEST[tryout] == '')) {
    $sql = "SELECT * FROM `templates` WHERE `template_id`='{$_REQUEST[tid]}'";
    $q = mysql_query($sql);
    $row = mysql_fetch_assoc($q);
  
    foreach ($row as $key => $value) {
        $_REQUEST[$key] = $value;
    }
    
    //var_dump($_REQUEST);exit;
}

if ($_REQUEST[tryout] == '1') {

    $errmsg = '';

    if ($_REQUEST[name] == '') {
        $errmsg.='<li>Field "Template Name" should not be empty</li>';
    }
 
    if ($errmsg != '') {
        $usermessage = '<b>Please correct the following errors:</b><br><ul>';
        $usermessage .= $errmsg;
        $usermessage .= '</ul>';
    } 
    else 
    {       
    
        $image_path = $my_common_path . "interface/images/";
        $template_path =  $my_common_path . "interface/templates/";    
        
        $templ_id = $_REQUEST[template_id];
        
        $image1 = $_REQUEST[img1];  $image2 = $_REQUEST[img2];  $image3 = $_REQUEST[img3];  $image4 = $_REQUEST[img4];  $image5 = $_REQUEST[img5];  
        $image6 = $_REQUEST[img6];  $image7 = $_REQUEST[img7];  $image8 = $_REQUEST[img8];  $image9 = $_REQUEST[img9];  $image10 = $_REQUEST[img10];  
        $image11 = $_REQUEST[img11];  $image12 = $_REQUEST[img12];  $image13 = $_REQUEST[img13];  $image14 = $_REQUEST[img14];  $image15 = $_REQUEST[img15];  
        
        //var_dump($_REQUEST);exit;
        
        $interface_url = $common_path_url . "interface/";
        
        if (is_uploaded_file($_FILES["img1_file"]["tmp_name"])) {               
            $image1 = $interface_url . "images/" . $templ_id . "_img1";
            move_uploaded_file($_FILES["img1_file"]["tmp_name"], $image_path . $templ_id . "_img1");
        } 
        if (is_uploaded_file($_FILES["img2_file"]["tmp_name"])) {       
            $image2 =  $interface_url . "images/" . $templ_id . "_img2";
            move_uploaded_file($_FILES["img2_file"]["tmp_name"], $image_path . $templ_id . "_img2");            
        }
        if (is_uploaded_file($_FILES["img3_file"]["tmp_name"])) {       
            $image3 = $interface_url . "images/" . $templ_id . "_img3";
            move_uploaded_file($_FILES["img3_file"]["tmp_name"], $image_path . $templ_id . "_img3");            
        }
        if (is_uploaded_file($_FILES["img4_file"]["tmp_name"])) {       
            $image4 = $interface_url . "images/" . $templ_id . "_img4";     
            move_uploaded_file($_FILES["img4_file"]["tmp_name"], $image_path . $templ_id . "_img4");            
        }
        if (is_uploaded_file($_FILES["img5_file"]["tmp_name"])) {       
            $image5 = $interface_url . "images/" . $templ_id . "_img5";
            move_uploaded_file($_FILES["img5_file"]["tmp_name"], $image_path . $templ_id . "_img5");            
        } 
        if (is_uploaded_file($_FILES["img6_file"]["tmp_name"])) {       
            $image6 = $interface_url . "images/" . $templ_id . "_img6";
            move_uploaded_file($_FILES["img6_file"]["tmp_name"], $image_path . $templ_id . "_img6");            
        } 
        if (is_uploaded_file($_FILES["img7_file"]["tmp_name"])) {       
            $image7 = $interface_url . "images/" . $templ_id . "_img7";
            move_uploaded_file($_FILES["img7_file"]["tmp_name"], $image_path . $templ_id . "_img7");            
        } 
        if (is_uploaded_file($_FILES["img8_file"]["tmp_name"])) {       
            $image8 = $interface_url . "images/" . $templ_id . "_img8";
            move_uploaded_file($_FILES["img8_file"]["tmp_name"], $image_path . $templ_id . "_img8");            
        } 
        if (is_uploaded_file($_FILES["img9_file"]["tmp_name"])) {       
            $image9 = $interface_url . "images/" . $templ_id . "_img9";
            move_uploaded_file($_FILES["img9_file"]["tmp_name"], $image_path . $templ_id . "_img9");            
        } 
        if (is_uploaded_file($_FILES["img10_file"]["tmp_name"])) {       
            $image10 = $interface_url . "images/" . $templ_id . "_img10";
            move_uploaded_file($_FILES["img10_file"]["tmp_name"], $image_path . $templ_id . "_img10");            
        } 
        if (is_uploaded_file($_FILES["img11_file"]["tmp_name"])) {       
            $image11 = $interface_url . "images/" . $templ_id . "_img11";
            move_uploaded_file($_FILES["img11_file"]["tmp_name"], $image_path . $templ_id . "_img11");            
        } 
        if (is_uploaded_file($_FILES["img12_file"]["tmp_name"])) {       
            $image12 = $interface_url . "images/" . $templ_id . "_img12";
            move_uploaded_file($_FILES["img12_file"]["tmp_name"], $image_path . $templ_id . "_img12");            
        } 
        if (is_uploaded_file($_FILES["img13_file"]["tmp_name"])) {       
            $image13 = $interface_url . "images/" . $templ_id . "_img13";
            move_uploaded_file($_FILES["img13_file"]["tmp_name"], $image_path . $templ_id . "_img13");            
        } 
        if (is_uploaded_file($_FILES["img14_file"]["tmp_name"])) {       
            $image14 = $interface_url . "images/" . $templ_id . "_img14";
            move_uploaded_file($_FILES["img14_file"]["tmp_name"], $image_path . $templ_id . "_img14");            
        }
        if (is_uploaded_file($_FILES["img15_file"]["tmp_name"])) {       
            $image15 = $interface_url . "images/" . $templ_id . "_img15";
            move_uploaded_file($_FILES["img15_file"]["tmp_name"], $image_path . $templ_id . "_img15");            
        }  
        

        $main_templ_path = $template_path . $_REQUEST[name] . "-main-" . $templ_id . ".htm";
        $download_templ_path = $template_path . $_REQUEST[name] . "-download-" . $templ_id . ".htm";
        $thank_templ_path = $template_path . $_REQUEST[name] . "-thank-" . $templ_id . ".htm"; 
        
        {
        if (!is_uploaded_file($_FILES["main_templ_html"]["tmp_name"])) 
        {         
            $homepage = file_get_contents($main_templ_path);
        }
        else
        {
            //var_dump($_FILES["templ_html"]);exit;  
            $homepage = file_get_contents($_FILES["main_templ_html"]["tmp_name"]);       
        }
        
        $homepage = str_replace("@image1@", $image1, $homepage); $homepage = str_replace("@image2@", $image2 ,$homepage); $homepage = str_replace("@image3@", $image3, $homepage);
        $homepage = str_replace("@image4@", $image4, $homepage); $homepage = str_replace("@image5@", $image5, $homepage); $homepage = str_replace("@image6@", $image6, $homepage);
        $homepage = str_replace("@image7@", $image7, $homepage); $homepage = str_replace("@image8@", $image8, $homepage); $homepage = str_replace("@image9@", $image9, $homepage);
        $homepage = str_replace("@image10@", $image10, $homepage); $homepage = str_replace("@image11@", $image11, $homepage); $homepage = str_replace("@image12@", $image12, $homepage);
        $homepage = str_replace("@image13@", $image13, $homepage); $homepage = str_replace("@image14@", $image14, $homepage); $homepage = str_replace("@image15@", $image15, $homepage);
                
        file_put_contents($main_templ_path, $homepage);
        }
        
        {
        if (!is_uploaded_file($_FILES["download_templ_html"]["tmp_name"])) 
        {         
            $homepage = file_get_contents($download_templ_path);
        }
        else
        {
            //var_dump($_FILES["templ_html"]);exit;  
            $homepage = file_get_contents($_FILES["download_templ_html"]["tmp_name"]);       
        }
        
        $homepage = str_replace("@image1@", $image1, $homepage); $homepage = str_replace("@image2@", $image2 ,$homepage); $homepage = str_replace("@image3@", $image3, $homepage);
        $homepage = str_replace("@image4@", $image4, $homepage); $homepage = str_replace("@image5@", $image5, $homepage); $homepage = str_replace("@image6@", $image6, $homepage);
        $homepage = str_replace("@image7@", $image7, $homepage); $homepage = str_replace("@image8@", $image8, $homepage); $homepage = str_replace("@image9@", $image9, $homepage);
        $homepage = str_replace("@image10@", $image10, $homepage); $homepage = str_replace("@image11@", $image11, $homepage); $homepage = str_replace("@image12@", $image12, $homepage);
        $homepage = str_replace("@image13@", $image13, $homepage); $homepage = str_replace("@image14@", $image14, $homepage); $homepage = str_replace("@image15@", $image15, $homepage);
                
        file_put_contents($download_templ_path, $homepage);
        }
        
        {
        if (!is_uploaded_file($_FILES["thank_templ_html"]["tmp_name"])) 
        {         
            $homepage = file_get_contents($thank_templ_path);
        }
        else
        {
            //var_dump($_FILES["templ_html"]);exit;  
            $homepage = file_get_contents($_FILES["thank_templ_html"]["tmp_name"]);       
        }
        
        $homepage = str_replace("@image1@", $image1, $homepage); $homepage = str_replace("@image2@", $image2 ,$homepage); $homepage = str_replace("@image3@", $image3, $homepage);
        $homepage = str_replace("@image4@", $image4, $homepage); $homepage = str_replace("@image5@", $image5, $homepage); $homepage = str_replace("@image6@", $image6, $homepage);
        $homepage = str_replace("@image7@", $image7, $homepage); $homepage = str_replace("@image8@", $image8, $homepage); $homepage = str_replace("@image9@", $image9, $homepage);
        $homepage = str_replace("@image10@", $image10, $homepage); $homepage = str_replace("@image11@", $image11, $homepage); $homepage = str_replace("@image12@", $image12, $homepage);
        $homepage = str_replace("@image13@", $image13, $homepage); $homepage = str_replace("@image14@", $image14, $homepage); $homepage = str_replace("@image15@", $image15, $homepage);
                
        file_put_contents($thank_templ_path, $homepage);
        }
        
        $sql =  "UPDATE `templates` SET `name`='{$_REQUEST[name]}', 
                `maintemplate_filepath`='{$main_templ_path}', `downloadtemplate_filepath`='{$download_templ_path}', `thanktemplate_filepath`='{$thank_templ_path}', 
                `img1`='{$image1}' , `img2`='{$image2}' , `img3`='{$image3}' , `img4`='{$image4}' , `img5`='{$image5}',
                `img6`='{$image6}' , `img7`='{$image7}' , `img8`='{$image8}' , `img9`='{$image9}' , `img10`='{$image10}',
                `img11`='{$image11}' , `img12`='{$image12}' , `img13`='{$image13}' , `img14`='{$image14}' , `img15`='{$image15}'
                 WHERE `template_id`='{$templ_id}'";
        //var_dump($sql); exit;
        mysql_query($sql);       
        
        ///update html of campigns what is using this template
      /*  
        if($_REQUEST[template_type] == '0')
        {
            $sql = "SELECT * FROM projects WHERE template_id='{$templ_id}'";    
        }
        else if($_REQUEST[template_type] == '1')
        {
            $sql = "SELECT * FROM projects WHERE template_id2='{$templ_id}'";    
        }
        else if($_REQUEST[template_type] == '2')
        {
            $sql = "SELECT * FROM projects WHERE template_id3='{$templ_id}'";    
        }
        $q = mysql_query($sql);
        while ($row = mysql_fetch_assoc($q)) 
        { 
            $proj_id = $row[id]; 
      
            $logo_url = $common_path_url . "installer_logos/" . $proj_id . ".jpg";                 
            
            //make html                 
                      
            $homepage = file_get_contents($templ_path);    
            
            if($row[software_tos_url] == "")
                $homepage = str_replace("@tos_url_enable@", "return false;", $homepage); 
            else
                $homepage = str_replace("@tos_url_enable@", "return true;", $homepage); 
                
            if($row[software_pp_url] == "")
                $homepage = str_replace("@pp_url_enable@", "return false;", $homepage); 
            else
                $homepage = str_replace("@pp_url_enable@", "return true;", $homepage); 
                
            if($row[software_eula_url] == "")
                $homepage = str_replace("@eula_url_enable@", "return false;", $homepage); 
            else
                $homepage = str_replace("@eula_url_enable@", "return true;", $homepage);                  
            
            $homepage = str_replace("@logo_image@", $logo_url, $homepage);
            $homepage = str_replace("@title@", $row[software_name] , $homepage);
            $homepage = str_replace("@version@", $row[software_version] , $homepage);                
            $homepage = str_replace("@description@", $row[software_description], $homepage);
            $homepage = str_replace("@tos_url@", $row[software_tos_url], $homepage); 
            $homepage = str_replace("@pp_url@", $row[software_pp_url], $homepage); 
            $homepage = str_replace("@eula_url@", $row[software_eula_url], $homepage); 
            
            if($_REQUEST[template_type] == '0')
            {
                $homepage_path = $my_common_path . "interface/htmls/camp_" . $proj_id . "_general.htm";
            }
            else if($_REQUEST[template_type] == '1')
            {
                $homepage_path = $my_common_path . "interface/htmls/camp_" . $proj_id . "_download.htm";
            }
            else if($_REQUEST[template_type] == '2')
            {
                $homepage_path = $my_common_path . "interface/htmls/camp_" . $proj_id . "_thankyou.htm";
            }
            
            file_put_contents($homepage_path, $homepage);   
        }           
     */
        echo('<script language="JavaScript">window.location.href = "template_list.php"</script>');
        break;
        
        
    }
}
?>


<div id="body">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

    <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN STYLE CUSTOMIZER-->
                <!-- END STYLE CUSTOMIZER-->
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    Edit Template
                    <small>edit HTML template for installer manager interface</small>
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> <span class="divider">/</span>
                    </li>
                    <li><a href="#">Edit Template</a></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div id="page">

            <? if ($usermessage != '') { ?>
                <div class="alert alert-error">
                    <button class="close" data-dismiss="alert">×</button>
                    <?= $usermessage ?>
                </div>
            <? } ?>

            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i>  General Template Settings</h4>
                        </div>
                        <div class="widget-body form">
                            <!-- BEGIN FORM--> 
                            <form action="template_edit.php" class="form-horizontal" method="POST" id="add_form" enctype="multipart/form-data">
                                <input type="hidden" name="tryout" value="1"/>
                                <input type="hidden" name="template_id" value="<?php echo($_REQUEST[template_id]); ?>">
                                <input type="hidden" name="img1" value="<?= $_REQUEST[img1]?>">
                                <input type="hidden" name="img2" value="<?= $_REQUEST[img2]?>">
                                <input type="hidden" name="img3" value="<?= $_REQUEST[img3]?>">
                                <input type="hidden" name="img4" value="<?= $_REQUEST[img4]?>">
                                <input type="hidden" name="img5" value="<?= $_REQUEST[img5]?>">
                                <input type="hidden" name="img6" value="<?= $_REQUEST[img6]?>">
                                <input type="hidden" name="img7" value="<?= $_REQUEST[img7]?>">
                                <input type="hidden" name="img8" value="<?= $_REQUEST[img8]?>">
                                <input type="hidden" name="img9" value="<?= $_REQUEST[img9]?>">
                                <input type="hidden" name="img10" value="<?= $_REQUEST[img10]?>">
                                <input type="hidden" name="img11" value="<?= $_REQUEST[img11]?>">
                                <input type="hidden" name="img12" value="<?= $_REQUEST[img12]?>">
                                <input type="hidden" name="img13" value="<?= $_REQUEST[img13]?>">
                                <input type="hidden" name="img14" value="<?= $_REQUEST[img14]?>">
                                <input type="hidden" name="img15" value="<?= $_REQUEST[img15]?>">
                                
                                <input type="hidden" name="file_path" value="<?= $_REQUEST[main_file_path]?>">                                

                                <div class="control-group">
                                    <label class="control-label" for="input3"><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Template Name</label>
                                    <div class="controls">
                                        <input type="text" id="name" name="name" value="<?= $_REQUEST[name] ?>" class="span6 popovers"  />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Image 1</label>                                      
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 250px; height: 100px;"><img src="<?= $_REQUEST[img1] ?>" alt=""/></div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 250px; max-height: 250px; line-height: 20px;"></div>
                                            <div>
                                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" class="default" name="img1_file"/></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>                                                    
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Image 2</label>                                    
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 250px; height: 100px;"><img src="<?= $_REQUEST[img2] ?>" alt=""/></div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 250px; max-height: 250px; line-height: 20px;"></div>
                                            <div>
                                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" class="default" name="img2_file"/></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>                                                    
                                    </div>
                                </div> 
                                
                                <div class="control-group">
                                    <label class="control-label">Image 3</label>                                    
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 250px; height: 100px;"><img src="<?= $_REQUEST[img3] ?>" alt=""/></div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 250px; max-height: 250px; line-height: 20px;"></div>
                                            <div>
                                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" class="default" name="img3_file"/></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>                                                    
                                    </div>
                                </div>  
                                                              
                                <div class="control-group">
                                    <label class="control-label">Image 4</label>                                    
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 250px; height: 100px;"><img src="<?= $_REQUEST[img4] ?>" alt=""/></div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 250px; max-height: 250px; line-height: 20px;"></div>
                                            <div>
                                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" class="default" name="img4_file"/></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>                                                    
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Image 5</label>                                    
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 250px; height: 100px;"><img src="<?= $_REQUEST[img5] ?>" alt=""/></div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 250px; max-height: 250px; line-height: 20px;"></div>
                                            <div>
                                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" class="default" name="img5_file"/></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>                                                    
                                    </div>
                                </div>  
                                
                                <div class="control-group">
                                    <label class="control-label">Image 6</label>                                    
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 250px; height: 100px;"><img src="<?= $_REQUEST[img6] ?>" alt=""/></div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 250px; max-height: 250px; line-height: 20px;"></div>
                                            <div>
                                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" class="default" name="img6_file"/></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>                                                    
                                    </div>
                                </div> 
                                
                                <div class="control-group">
                                    <label class="control-label">Image 7</label>                                    
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 250px; height: 100px;"><img src="<?= $_REQUEST[img7] ?>" alt=""/></div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 250px; max-height: 250px; line-height: 20px;"></div>
                                            <div>
                                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                    <input type="file" class="default" name="img7_file"/></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>                                                    
                                    </div>
                                </div>     
                                
                                <div class="control-group">
                                    <label class="control-label">Image 8</label>                                    
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 250px; height: 100px;"><img src="<?= $_REQUEST[img8] ?>" alt=""/></div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 250px; max-height: 250px; line-height: 20px;"></div>
                                            <div>
                                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                    <input type="file" class="default" name="img8_file"/></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>                                                    
                                    </div>
                                </div> 
                                
                                <div class="control-group">
                                    <label class="control-label">Image 9</label>                                    
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 250px; height: 100px;"><img src="<?= $_REQUEST[img9] ?>" alt=""/></div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 250px; max-height: 250px; line-height: 20px;"></div>
                                            <div>
                                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                    <input type="file" class="default" name="img9_file"/></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>                                                    
                                    </div>
                                </div> 
                                
                                <div class="control-group">
                                    <label class="control-label">Image 10</label>                                    
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 250px; height: 100px;"><img src="<?= $_REQUEST[img10] ?>" alt=""/></div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 250px; max-height: 250px; line-height: 20px;"></div>
                                            <div>
                                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                    <input type="file" class="default" name="img10_file"/></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>                                                    
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Image 11</label>                                    
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 250px; height: 100px;"><img src="<?= $_REQUEST[img11] ?>" alt=""/></div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 250px; max-height: 250px; line-height: 20px;"></div>
                                            <div>
                                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                    <input type="file" class="default" name="img11_file"/></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>                                                    
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Image 12</label>                                    
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 250px; height: 100px;"><img src="<?= $_REQUEST[img12] ?>" alt=""/></div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 250px; max-height: 250px; line-height: 20px;"></div>
                                            <div>
                                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                    <input type="file" class="default" name="img12_file"/></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>                                                    
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Image 13</label>                                    
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 250px; height: 100px;"><img src="<?= $_REQUEST[img13] ?>" alt=""/></div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 250px; max-height: 250px; line-height: 20px;"></div>
                                            <div>
                                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                    <input type="file" class="default" name="img13_file"/></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>                                                    
                                    </div>
                                </div>  
                                
                                <div class="control-group">
                                    <label class="control-label">Image 14</label>                                    
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 250px; height: 100px;"><img src="<?= $_REQUEST[img14] ?>" alt=""/></div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 250px; max-height: 250px; line-height: 20px;"></div>
                                            <div>
                                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                    <input type="file" class="default" name="img14_file"/></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>                                                    
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Image 15</label>                                    
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 250px; height: 100px;"><img src="<?= $_REQUEST[img15] ?>" alt=""/></div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 250px; max-height: 250px; line-height: 20px;"></div>
                                            <div>
                                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                    <input type="file" class="default" name="img15_file"/></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>                                                    
                                    </div>
                                </div>
                                        
                                <div class="control-group">
                                    <label class="control-label" for="input3"><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Main Template HTML file</label>                                    
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                  <div class="input-append">
                                                    <div class="uneditable-input span3">
                                                        <i class="icon-file fileupload-exists"></i> 
                                                        <span class="fileupload-preview"><?=$_REQUEST[name]?>_main</span>
                                                    </div>
                                                    <span class="btn btn-file">
                                                        <span class="fileupload-new">Select file</span>
                                                        <span class="fileupload-exists">Change</span>
                                                        <input type="file" class="default" name="main_templ_html"/>
                                                    </span>
                                                    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                  </div>
                                        </div>                                         
                                    </div>
                                </div> 
                                
                                <div class="control-group">
                                    <label class="control-label" for="input3"><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Download Template HTML file</label>                                    
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                  <div class="input-append">
                                                    <div class="uneditable-input span3">
                                                        <i class="icon-file fileupload-exists"></i> 
                                                        <span class="fileupload-preview"><?=$_REQUEST[name]?>_download</span>
                                                    </div>
                                                    <span class="btn btn-file">
                                                        <span class="fileupload-new">Select file</span>
                                                        <span class="fileupload-exists">Change</span>
                                                        <input type="file" class="default" name="download_templ_html"/>
                                                    </span>
                                                    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                  </div>
                                        </div>                                         
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label" for="input3"><span style="color: #FF0000; font-weight: bold; font-size: 10px; margin-top: -3px;"><i class="icon-asterisk"></i></span> Template HTML file</label>                                    
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                  <div class="input-append">
                                                    <div class="uneditable-input span3">
                                                        <i class="icon-file fileupload-exists"></i> 
                                                        <span class="fileupload-preview"><?=$_REQUEST[name]?>_thank</span>
                                                    </div>
                                                    <span class="btn btn-file">
                                                        <span class="fileupload-new">Select file</span>
                                                        <span class="fileupload-exists">Change</span>
                                                        <input type="file" class="default" name="thank_templ_html"/>
                                                    </span>
                                                    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                  </div>
                                        </div>                                         
                                    </div>
                                </div>  

                                <div class="form-actions">
                                    <a href="#" class="btn btn-success" onclick="$('#add_form').submit();
                                            return false;"><i class="icon-check"></i> Save Template</a>
                                    <a href="dashboard.php" class="btn">Cancel</a>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                </div>
            </div>

        </div>
        <!-- END PAGE CONTENT-->
    </div>
    <!-- END PAGE CONTAINER-->
</div>

<? include 'z_footer.php'; ?>
