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
   focusFontColor=51:153:255
   suffixXPC=89
   suffixYPC=12.2
   suffixBgColor=-1:-1:-1
   suffixTextColor=101:101:101
   suffixClearImage="/home/scripts/readon/images/ch1.jpg"
   suffixClearImageXPC=0
   suffixClearImageYPC=2.8
   suffixClearImageWPC=100
   suffixClearImageHPC=15.6
   headerColor=-1:-1:-1
   headerXPC=26
   headerYPC=8
   headerFontSize=20
   fontSize=17
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
<backgroundDisplay>
    <image  offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>image/mele/backgd.jpg</image>
</backgroundDisplay>
</mediaDisplay>

<?
// УТФ
$dbname = "./db/readon.db";
$tablename = "video_table";
$mode = $_GET['m'];
$db = new PDO("sqlite:$dbname");
echo "<channel>\n";

if($mode == "g") {
echo "<title>Genres</title>\n";
$r = $db->query("select distinct gnre from $tablename order by gnre");
while ($row = $r->fetch(SQLITE_ASSOC)) {
	echo "<item>\n";
    echo "<title>".$row['gnre']."</title>\n";
	$tmpg = urlencode($row['gnre']);
	echo "<link>http://127.0.0.1:82/readon/list.php?g=".$tmpg."</link>\n";
    echo "</item>\n\n";
  }
  
 } else if($mode == "c") {
echo "<title>Countries</title>\n";
$r = $db->query("select distinct cntr from $tablename order by cntr");
while ($row = $r->fetch(SQLITE_ASSOC)) {
	echo "<item>\n";
    echo "<title>".$row['cntr']."</title>\n";
	$tmpc = urlencode($row['cntr']);
	echo "<link>http://127.0.0.1:82/readon/list.php?c=".$tmpc."</link>\n";
    echo "</item>\n\n";
  }

 } else { // no parameters
echo "<title>ReadonWebTv Menu</title>\n";

echo "<item>\n";
echo "<title>Search</title>\n";
echo "<link>rss_command://search</link>\n";
echo "<search url='http://127.0.0.1:82/readon/list.php?s=%s' />\n";
echo "</item>\n\n";
 
echo "<item>\n";
echo "<title>Genres</title>\n";
echo "<link>http://127.0.0.1:82/readon/index.php?m=g</link>\n";
echo "</item>\n\n";

echo "<item>\n";
echo "<title>Countries</title>\n";
echo "<link>http://127.0.0.1:82/readon/index.php?m=c</link>\n";
echo "</item>\n\n";
 
echo "<item>\n";
echo "<title>________________________</title>\n";
echo "</item>\n\n";

echo "<item>\n";
echo "<title>Database Update From Web</title>\n";
echo "<link>http://127.0.0.1:82/readon/updatetv.php</link>\n";
echo "</item>\n\n";
  }
?>
</channel>
</rss>

