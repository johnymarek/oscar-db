<? echo "<?xml version='1.0' encoding='UTF8' ?>\n"; ?>
<rss version="2.0">
<mediaDisplay name=meleThreePartView
   itemBackgroundColor=0:0:0
   backgroundColor=0:0:0
   sideLeftWidthPC=10
   sideRightWidthPC=100
   showHeader="yes"
   imageParentFocus="image/mele/focus.bmp"
   imageFocus="image/mele/focus.bmp"
   imageUnFocus="image/mele/unfocus.bmp"
   unFocusFontColor="110:110:110"
   focusFontColor=255:130:30
   suffixXPC=89
   suffixYPC=12.2
   suffixBgColor=-1:-1:-1
   suffixTextColor=101:101:101
   suffixClearImage="/home/scripts/rtmp-db/images/ch4.jpg"
   suffixClearImageXPC=0
   suffixClearImageYPC=2.8
   suffixClearImageWPC=100
   suffixClearImageHPC=15.6
   headerColor=-1:-1:-1
   headerXPC=26
   headerYPC=8
   headerFontSize=20
   fontSize=16
   itemXPC=10.9
   itemYPC=20
   itemWidthPC=78.13
   itemHeightPC=10
   itemGap=0
   itemImageWidthPC=0
   itemImageHeightPC=0
   itemAlignt="left"
	menuXPC = 4
	popupXPC = 5
	popupYPC = 24.5
	popupFontSize = 17
	popupWidthPC = 15
	popupBorderColor = 255:255:255
   >
<idleImage>image/POPUP_LOADING_01.png</idleImage>
<idleImage>image/POPUP_LOADING_02.png</idleImage>
<idleImage>image/POPUP_LOADING_03.png</idleImage>
<idleImage>image/POPUP_LOADING_04.png</idleImage>
<idleImage>image/POPUP_LOADING_05.png</idleImage>
<idleImage>image/POPUP_LOADING_06.png</idleImage>
<idleImage>image/POPUP_LOADING_07.png</idleImage>
<idleImage>image/POPUP_LOADING_08.png</idleImage>
  	<text align="center" redraw="yes" offsetXPC="1" offsetYPC="40" widthPC="95" heightPC="40" fontSize="24" backgroundColor="-1:-1:-1" foregroundColor="209:170:242">
<?
set_time_limit(180);	
//foreach($_POST AS $key => $value) { ${$key} = $value; }
//foreach($_GET AS $key => $value) { ${$key} = $value; }

iconv_set_encoding("input_encoding", "UTF-8");
iconv_set_encoding("output_encoding", "UTF-8");
iconv_set_encoding("internal_encoding", "UTF-8");

$dir1 = dirname(__FILE__);
$sqliteDB = "rtmp-db.db";
$table="rtmplist";
$tablefav = "rtmp_fav";
$n = 0;
$newDB = $dir1."/db/".$sqliteDB;
$fileCopy = "last.xml";
$xmlCopy=$dir1."/db/".$fileCopy;
//$USERAGENT="Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.2.13) Gecko/20101203 Firefox/3.6.13";
//$WGET="/opt/bin/wget";

//known file URL and nodes in the XML to be created as columns in the table
$xmlPath='http://apps.ohlulz.com/rtmpgui/list.xml';
$fldArr = array('title','swfUrl','link','pageUrl','playpath','language','advanced');

function url_exists($url) {
     if ((strpos($url, "http")) === false) $url = "http://" . $url;
     if (is_array(@get_headers($url)))
          return true;
     else
          return false;
}

///// begin //////
//exec($WGET.' -q -O '.$xmlCopy.'  --header "User-Agent: '.$USERAGENT.'" "'.$xmlPath.'"');
//sleep(2);

if(url_exists($xmlPath) || file_exists($xmlCopy)){

	$db = new PDO('sqlite:'.$newDB);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$dropTable = "DROP TABLE IF EXISTS ".$table;
	$dropRes = $db->exec($dropTable);

	// create the new main table
	$sqlCreateStr = "CREATE TABLE ".$table."(id INTEGER,";        
	$sqlCreateStr .= implode(",",$fldArr);
	$sqlCreateStr .= ",PRIMARY KEY ( id))";
	$createRes = $db->exec($sqlCreateStr);
	
	// create the new fav table if not exists
	$sqlCreateStr = "CREATE TABLE IF NOT EXISTS ".$tablefav."(id INTEGER,";        
	$sqlCreateStr .= implode(",",$fldArr);
	$sqlCreateStr .= ",PRIMARY KEY ( id))";
	$createRes = $db->exec($sqlCreateStr);
	
	// read local or online XML 
	$msgo = "Online";
	if (file_exists($xmlCopy)){
		$xmlPath = $xmlCopy;
		$msgo = "Local";
	}
	$xmlText = simplexml_load_file($xmlPath, null, LIBXML_NOCDATA);
	foreach ($xmlText->stream as $stream) {
		$n++;
    	$f1 = htmlspecialchars(trim($stream->title));
    	$f2 = htmlspecialchars(trim($stream->swfUrl));
    	$f3 = htmlspecialchars(trim($stream->link));
		$f4 = htmlspecialchars(trim($stream->pageUrl));///<----------------
		$f5 = htmlspecialchars(trim($stream->playpath));
		$f6 = htmlspecialchars(trim($stream->language));
		$f7 = htmlspecialchars(trim($stream->advanced));
    	    	 
		$query = "insert into ".$table." (id,". implode(',',$fldArr ).") VALUES (\"".$n."\",\"".$f1."\",\"".$f2."\",\"".$f3."\",\"".$f4."\",\"".$f5."\",\"".$f6."\",\"".$f7."\");";
		$insert = $db->prepare($query);
	
		try{
			$insertRes = $insert->execute();
			$inserted += $insertRes;
			}
		catch (PDOException $e){
			$msgo = htmlspecialchars($e->getMessage());
			echo "Error: ".$msgo;
			die('Execute err: '.$msgo);
 			}
    }

    echo "Done: ".$inserted." ".$msgo." Rtmp Channels";
} else 
    echo $msgo." source is not available!";

?>
  		</text>
<backgroundDisplay>
    <image  offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>/home/scripts/rtmp-db/images/bkgr.jpg</image>
</backgroundDisplay>
</mediaDisplay>
<channel>
	<title>Updating ...</title>
	<item>
	<title></title>
	</item>
</channel>
</rss>
