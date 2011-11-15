<? echo "<?xml version='1.0' encoding='UTF8' ?>\n"; ?>
<rss version="2.0">
<mediaDisplay name="photoView" showHeader="no" rowCount="2" columnCount="3" drawItemText="no" showDefaultInfo="no" itemOffsetXPC="20" itemOffsetYPC="34" sliding="yes" itemBorderColor="51:180:51" itemHeightPC="13" itemWidthPC="17.2" itemBackgroundColor="0:0:0" backgroundColor="0:0:0" bottomYPC="100" sideTopHeightPC="0" mainPartColor="-1:-1:-1" sideColorBottom="-1:-1:-1" sideColorTop="-1:-1:-1" fontSize="14">

<idleImage> image/POPUP_LOADING_01.png </idleImage>
<idleImage> image/POPUP_LOADING_02.png </idleImage>
<idleImage> image/POPUP_LOADING_03.png </idleImage>
<idleImage> image/POPUP_LOADING_04.png </idleImage>
<idleImage> image/POPUP_LOADING_05.png </idleImage>
<idleImage> image/POPUP_LOADING_06.png </idleImage>
<idleImage> image/POPUP_LOADING_07.png </idleImage>
<idleImage> image/POPUP_LOADING_08.png </idleImage>

<backgroundDisplay>
    <image offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>image/mele/backgd.jpg</image>
	<image offsetXPC=0 offsetYPC=2.8 widthPC=100 heightPC=15.6>/home/scripts/oscar-db/images/ch5.jpg</image>
	<text offsetXPC=28 offsetYPC=8 widthPC=35 heightPC=10 fontSize=20 backgroundColor=-1:-1:-1 foregroundColor=51:180:51>
	ReadonWebRadio Menu</text>
</backgroundDisplay>
</mediaDisplay>

<?
//
$dbname = "./db/oscar-db.db";
$tablename = "audio_table";
$mode = $_GET['m'];

echo "<channel>\n";

if ($db = new PDO("sqlite:$dbname")) {
	$query = @$db->query("SELECT * FROM $tablename");
	if ($query === false) {
		echo "<title>ReadonWebRadio (No Items)</title>\n";
		echo "<item>\n";
		echo "<title>Database Update From Web</title>\n";
		echo "<link>http://127.0.0.1:82/oscar-db/updateradio.php</link>\n";
		echo "</item>\n\n";
	} else {
	
		if($mode == "g") {
		echo "<title>Genres</title>\n";
		$r = $db->query("select distinct gnre from $tablename order by gnre");
		while ($row = $r->fetch(SQLITE_ASSOC)) {
			echo "<item>\n";
			echo "<title>".$row['gnre']."</title>\n";
			$tmpg = urlencode($row['gnre']);
			echo "<link>http://127.0.0.1:82/oscar-db/list_a.php?g=".$tmpg."</link>\n";
			echo "</item>\n\n";
		  }
		
		 } else if($mode == "c") {
		echo "<title>Countries</title>\n";
		$r = $db->query("select distinct cntr from $tablename order by cntr");
		while ($row = $r->fetch(SQLITE_ASSOC)) {
			echo "<item>\n";
			echo "<title>".$row['cntr']."</title>\n";
			$tmpc = urlencode($row['cntr']);
			echo "<link>http://127.0.0.1:82/oscar-db/list_a.php?c=".$tmpc."</link>\n";
			echo "</item>\n\n";
		  }

		 } else { // no parameters
		echo "<title>ReadonWebRadio Menu</title>\n";
		
		echo "<item>\n";
		echo "<title>Favorites</title>\n";
		echo "<link>http://127.0.0.1:82/oscar-db/list_a.php?f=0</link>\n";
		echo '<media:thumbnail url="/home/scripts/oscar-db/images/favorites.png" />';
		echo "\n</item>\n\n";
		
		echo "<item>\n";
		echo "<title>Search</title>\n";
		echo "<link>rss_command://search</link>\n";
		echo "<search url='http://127.0.0.1:82/oscar-db/list_a.php?s=%s' />\n";
		echo '<media:thumbnail url="/home/scripts/oscar-db/images/search.png" />';
		echo "\n</item>\n\n";
		 
		echo "<item>\n";
		echo "<title>Genres</title>\n";
		echo "<link>http://127.0.0.1:82/oscar-db/index_a.php?m=g</link>\n";
		echo '<media:thumbnail url="/home/scripts/oscar-db/images/genres.png" />';
		echo '<mediaDisplay name="photoView" showHeader="no" rowCount="7" columnCount="3" columnPerPage="3" drawItemText="yes" showDefaultInfo="no" itemOffsetXPC="5" itemOffsetYPC="22" sliding="yes" itemBorderColor="51:180:51" itemHeightPC="8" itemWidthPC="28" itemBackgroundColor="0:0:0" idleImageXPC="90" idleImageYPC="10" idleImageWidthPC="6" idleImageHeightPC="6" backgroundColor="0:0:0" bottomYPC="100" sideTopHeightPC="0" mainPartColor="-1:-1:-1" sideColorBottom="-1:-1:-1" sideColorTop="-1:-1:-1" fontSize="14" itemImageWidthPC="1" itemImageHeightPC="1" />';
		echo "\n</item>\n\n";

		echo "<item>\n";
		echo "<title>Database Update From Web</title>\n";
		echo "<link>http://127.0.0.1:82/oscar-db/updateradio.php</link>\n";
		echo '<media:thumbnail url="/home/scripts/oscar-db/images/update.png" />';
		echo "\n</item>\n\n";
		
		echo "<item>\n";
		echo "<title>Countries</title>\n";
		echo "<link>http://127.0.0.1:82/oscar-db/index_a.php?m=c</link>\n";
		echo '<media:thumbnail url="/home/scripts/oscar-db/images/countries.png" />';
		echo '<mediaDisplay name="photoView" showHeader="no" rowCount="7" columnCount="3" columnPerPage="3" drawItemText="yes" showDefaultInfo="no" itemOffsetXPC="5" itemOffsetYPC="22" sliding="yes" itemBorderColor="51:180:51" itemHeightPC="8" itemWidthPC="28" itemBackgroundColor="0:0:0" idleImageXPC="90" idleImageYPC="10" idleImageWidthPC="6" idleImageHeightPC="6" backgroundColor="0:0:0" bottomYPC="100" sideTopHeightPC="0" mainPartColor="-1:-1:-1" sideColorBottom="-1:-1:-1" sideColorTop="-1:-1:-1" fontSize="14" itemImageWidthPC="1" itemImageHeightPC="1" />';
		echo "\n</item>\n\n";
		 }
	}
} else {
	echo "<item>\n";
	echo "<title>Problem</title>\n";
	echo "<link>/home/scripts/menu-oscar.rss</link>\n";
	echo '<media:thumbnail url="/home/scripts/oscar-db/images/error.png" />';
	echo "\n</item>\n\n";
}

?>
</channel>
</rss>

