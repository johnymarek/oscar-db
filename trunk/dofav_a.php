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
   focusFontColor=51:180:51
   suffixXPC=89
   suffixYPC=12.2
   suffixBgColor=-1:-1:-1
   suffixTextColor=101:101:101
   suffixClearImage="/home/scripts/oscar-db/images/ch5.jpg"
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

  		<text redraw="yes" offsetXPC="10" offsetYPC="30" widthPC="60" heightPC="40" fontSize="18" backgroundColor="-1:-1:-1" foregroundColor="51:180:51">
<?
$dbname = "./db/oscar-db.db";
$tablename = "audio_table";

$favasxl=$_GET['n'];
$oper=$_GET['o'];

echo "asx : ".$favasxl." , Do: ". $oper." , ";

?>
		</text>
<backgroundDisplay>
    <image  offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>image/mele/backgd.jpg</image>
</backgroundDisplay>
</mediaDisplay>
<channel>
	<title>Radio Favorites</title>
	<item>
	<title>Nothing yet</title>
	</item>
</channel>
</rss>


