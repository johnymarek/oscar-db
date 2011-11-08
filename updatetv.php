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
   suffixClearImage="/home/scripts/oscar-db/images/ch4.jpg"
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
<idleImage> image/POPUP_LOADING_01.png </idleImage>
<idleImage> image/POPUP_LOADING_02.png </idleImage>
<idleImage> image/POPUP_LOADING_03.png </idleImage>
<idleImage> image/POPUP_LOADING_04.png </idleImage>
<idleImage> image/POPUP_LOADING_05.png </idleImage>
<idleImage> image/POPUP_LOADING_06.png </idleImage>
<idleImage> image/POPUP_LOADING_07.png </idleImage>
<idleImage> image/POPUP_LOADING_08.png </idleImage>
  		<text redraw="yes" offsetXPC="10" offsetYPC="30" widthPC="60" heightPC="40" fontSize="18" backgroundColor="-1:-1:-1" foregroundColor="51:153:255">
<?
// ЯЯЯ
set_time_limit(240);
$dbname = "./db/oscar-db.db";

$tablename = "video_table";
$targetfile = "http://www.readonwebtv.com/video2.htm" ;
$targetenc = "html-entities";

$genre = 0;
$asxnum = 0;
$chname = 0;
$country = 0;
$n=0;

function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = mb_strpos($string, $start); 
	if ($ini == 0) return ""; $ini += mb_strlen($start); $len = mb_strpos($string,$end,$ini) - $ini; 
	return mb_substr($string,$ini,$len); 
}

 function ucs2html($str) {
    $str=trim($str); // if you are reading from file
    $len=mb_strlen($str);
    $html='';
    for($i=0;$i<$len;$i+=2)
        $html.='&#'.hexdec(dechex(ord($str[$i+1])).
                   sprintf("%02s",dechex(ord($str[$i])))).';';
    return($html);
 }

if ($db = new PDO("sqlite:$dbname")) {
	$query = @$db->query("SELECT * FROM $tablename");
	if ($query === false) {
		$db->query("CREATE TABLE $tablename (
				   id INT,
				   asxl TEXT ,
				   cntr  TEXT ,
				   gnre TEXT ,
				   fav INT2,
				   chn TEXT ,
		           PRIMARY KEY ( id));");
//		echo "Created $tablename \n";
	} else {
 //               echo "$tablename and $dbname Already exists\n";
	}

	$db->query("delete from $tablename");
	$handle = fopen($targetfile, "r") or die("Couldn't get handle"); 
	if ($handle) { 
		$db->beginTransaction();
		while (!feof($handle)){         
			$buffer = fgets($handle, 1024);      
			    $buffer = ucs2html($buffer);
				$buffer = mb_convert_encoding($buffer, 'UTF-8',$targetenc);
				$cln = 0;
				if ($country = str_between($buffer, "<li><a href=\"#\">","</a><ul>")){  //Country
				  $country_mem = $country;
				  $asxnum = 0;
				  $chname = 0;
				} else 
				
				if ($genre = str_between($buffer, "<a href=\"#\">","</a>")){  //Genre
				  $genre_mem = $genre;
				  $country = 0;
				  $asxnum = 0;
				  $chname = 0;				  
				} else 
				
				if ($asxnum = str_between($buffer, "pages/",".htm")){
				$chname = str_between($buffer, "linkclass\">","<");
				$chname = SQLite3::escapeString($chname);
				if ((strstr($chname, "??")) or (!$chname)){
						$chname = "RadioCh_".$n;
						}
				} else 
				{
				$cln = 1;
				}
				if (($cln == 0)  and ( $chname != "0")  and ( $asxl != "0") )   {
					$n++;
					$sql="INSERT INTO $tablename ( id, asxl, cntr, gnre, fav, chn)	VALUES ('$n', '$asxnum' , '$country_mem', '$genre_mem', 0, '$chname');";
					$db->query($sql);
					if (($n % 100) == 0) {
					//echo "Channels = ".$n;
					flush();
					}
				}
		}     
		fclose($handle); 
	}
	$db->commit();	
	echo "Done, Total Channels : ".$n;
} else {
	echo "Failed";
	die($err);
}
?>
		</text>
<backgroundDisplay>
    <image  offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>image/mele/backgd.jpg</image>
</backgroundDisplay>
</mediaDisplay>
<channel>
	<title> Updating </title>
	<item>
	<title> Database Sync With Website </title>
	</item>
</channel>
</rss>




