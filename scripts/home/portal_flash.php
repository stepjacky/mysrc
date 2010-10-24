  <?php 

    		   require_once '../../tools/utils.php';
    		   use data\BaseDao;
    		   
    		   $entityName = "flashstatus";
    		   $dao = new BaseDao($entityName);
    		   $list = $dao->getBeans();
    		   if(count($list)<8){
    		   	    echo "document.write('没有足够的flash图片');";
    		   	    exit(0);
    		   }
    		   $image_0_image = $list[4]['image'];
    		   $image_0_href = $list[4]['href'];
    		   $image_1_image = $list[5]['image'];
    		   $image_1_href = $list[5]['href'];
    		   $image_2_image = $list[6]['image'];
    		   $image_2_href = $list[6]['href'];
    		   $image_3_image = $list[7]['image'];
    		   $image_3_href = $list[7]['href'];
    		   

    		echo <<<JSCODE

    		    imgUrl1="$image_0_image";
    		    imgtext1="11";
    		    imgLink1=escape("$image_0_href");
    		    //imgLink1="";
    		    
    		    imgUrl2="$image_1_image";
    		    imgtext2="22";
    		    imgLink2=escape('$image_1_href');
    		    //imgLink2="";
    		    
    		  
    		    imgUrl3="$image_2_image";
    		    imgtext3="33";
    		    imgLink3=escape("$image_2_href");
    		    //imgLink3="";
    			
    			imgUrl4="$image_3_image";
    		    imgtext4="4555555";
    		    imgLink4=escape("$image_3_href");
    		    //imgLink4="";

    		    
    		    var focus_width=253;
    		     var focus_height=194;
    		     var text_height=0;
    		     var swf_height = focus_height+text_height;
    		     
    		     var pics=imgUrl1+"|"+imgUrl2+"|"+imgUrl3+"|"+imgUrl4;
    		     var links=imgLink1+"|"+imgLink2+"|"+imgLink3+"|"+imgLink4;
    		     var texts=imgtext1+"|"+imgtext2+"|"+imgtext3+"|"+imgtext4;
    		     var flashCode = '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/hotdeploy/flash/swflash.cab#version=6,0,0,0" width="'+ focus_width +'" height="'+ swf_height +'">';
    		     flashCode = flashCode + '<param name="allowScriptAccess" value="sameDomain"><param name="movie" value="scripts/home/focus2.swf"><param name="quality" value="high"><param name="bgcolor" value="#F0F0F0">';
    		     flashCode = flashCode + '<param name="menu" value="false"><param name=wmode value="opaque">';
    		     flashCode = flashCode + '<param name="FlashVars" value="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'">';
    		     flashCode = flashCode + '<embed src="scripts/home/focus2.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="'+ focus_width +'" height="'+ swf_height +'" FlashVars="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'"></embed>';
    		     flashCode = flashCode + '</object>';
    		     document.write(flashCode);
JSCODE;
    		     
?>  