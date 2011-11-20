<? echo "<?xml version='1.0' encoding='UTF8' ?>\n"; ?>
<rss version="2.0">
<!--
##   http://code.google.com/media-translate/
#   Copyright (C) 2010  Serge A. Timchenko
##   This program is free software: you can redistribute it and/or modify
#   it under the terms of the GNU General Public License as published by
#   the Free Software Foundation, either version 3 of the License, or
#   (at your option) any later version.
##   This program is distributed in the hope that it will be useful,
#   but WITHOUT ANY WARRANTY; without even the implied warranty of
#   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#   GNU General Public License for more details.
##   You should have received a copy of the GNU General Public License
#   along with this program. If not, see <http://www.gnu.org/licenses/>.
#-->
<onEnter>
    translate_base_url  = "http://127.0.0.1/cgi-bin/translate?";
  screenXp = 4;
  screenYp = 3;
  rssconf = readStringFromFile(getStoragePath("key")+"translate.dat");
  print("rssconf:",rssconf);
  if(rssconf != null)
  {
    value = getStringArrayAt(rssconf, 0);
    if(value != null &amp;&amp; value != "")
      translate_base_url = value;
    value = getStringArrayAt(rssconf, 1);
    if(value != null &amp;&amp; value != "")
      screenXp = Integer(value);
    value = getStringArrayAt(rssconf, 2);
    if(value != null &amp;&amp; value != "")
      screenYp = Integer(value);
  }
  print("rssconf:",translate_base_url,screenXp,screenYp);
  testStream = 0;
  if(rssconf != null)
  {
    value = getStringArrayAt(rssconf, 10);
    if(value != null &amp;&amp; value != "")
      testStream = Integer(value);
  }
  storagePath             = getStoragePath("tmp");
  storagePath_stream      = storagePath + "stream.dat";
  storagePath_playlist    = storagePath + "playlist.dat";
    
  error_info          = "";
    startitem = "";
		
</onEnter>
<script>
  setRefreshTime(1);
</script>
<onRefresh>
  setRefreshTime(-1);
  itemCount = getPageInfo("itemCount");
  middleItem = Integer(itemCount / 2);
  if(startitem == "middle")
    setFocusItemIndex(middleItem);
  else
  if(startitem == "last")
    setFocusItemIndex(itemCount);
  else
  if(startitem &gt; 0 &amp;&amp; startitem &lt;= itemCount)
    setFocusItemIndex(startitem-1);
  redrawDisplay();
</onRefresh>
<mediaDisplay name="onePartView"
	sideLeftWidthPC="0"
	sideRightWidthPC="0"
		headerImageWidthPC="0"
	selectMenuOnRight="no"
	autoSelectMenu="no"
	autoSelectItem="no"
	itemImageHeightPC="0"
	itemImageWidthPC="0"
	itemXPC="8"
	itemYPC="25"
	itemWidthPC="48"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="48"
	capHeightPC="64"
	itemBackgroundColor="0:0:0"
	itemPerPage="8"
  itemGap="0"
	bottomYPC="90"
	backgroundColor="0:0:0"
	showHeader="no"
	showDefaultInfo="no"
	sliding="no"
	imageFocus=""
	imageUnFocus=""
	imageParentFocus=""
>		
  	<text align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20" fontSize="25" backgroundColor="48:150:48" foregroundColor="115:230:115">
		  <script>getPageInfo("pageTitle");</script>
		</text>
		<image offsetXPC=5 offsetYPC=2 widthPC=21 heightPC=19 >
		  <script>channelImage;</script>
      <widthPC>
        <script>
          21 * screenYp / screenXp;
        </script>
      </widthPC>
      <offsetXPC>
        <script>
          5 + 21 * (1 - screenYp / screenXp) / 2;
        </script>
      </offsetXPC>
		</image>
  	<text redraw="yes" offsetXPC="80" offsetYPC="12" widthPC="15" heightPC="6" fontSize="18" backgroundColor="48:150:48" foregroundColor="86:186:86">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
		<text align="justify" redraw="yes" 
          lines="14" fontSize=14
		      offsetXPC=55 offsetYPC=25 widthPC=40 heightPC=60 
		      backgroundColor=32:122:32 foregroundColor=200:200:200>
			<script>print(annotation); annotation;</script>
		</text>
		
		<text align="center" redraw="yes" offsetXPC=55 offsetYPC=85 widthPC=40 heightPC=5 fontSize=13 backgroundColor=32:122:32 foregroundColor=0:0:0>
			<script>print(location); location;</script>
		</text>
		
		<text align="center" redraw="yes" offsetXPC=55 offsetYPC=90 widthPC=40 heightPC=5 fontSize=13 backgroundColor=0:0:0 foregroundColor=200:80:80>
			<script>if(getItemInfo(focus, "idfav") == "no") "Press 0 to see Favorites"; else if(getItemInfo(focus, "idfav") > 0) "Press 0 to add to Favorites"; else " Press 0 to remove from Favorites";</script>
		</text>

  	<idleImage idleImageYPC="45" idleImageHeightPC="10">../etc/translate/rss/image/POPUP_LOADING_01.png<idleImageWidthPC><script>10 * screenYp / screenXp;</script></idleImageWidthPC><idleImageXPC><script>45 + 10 * (1 - screenYp / screenXp) / 2;</script></idleImageXPC></idleImage>
  	<idleImage idleImageYPC="45" idleImageHeightPC="10">../etc/translate/rss/image/POPUP_LOADING_02.png<idleImageWidthPC><script>10 * screenYp / screenXp;</script></idleImageWidthPC><idleImageXPC><script>45 + 10 * (1 - screenYp / screenXp) / 2;</script></idleImageXPC></idleImage>
  	<idleImage idleImageYPC="45" idleImageHeightPC="10">../etc/translate/rss/image/POPUP_LOADING_03.png<idleImageWidthPC><script>10 * screenYp / screenXp;</script></idleImageWidthPC><idleImageXPC><script>45 + 10 * (1 - screenYp / screenXp) / 2;</script></idleImageXPC></idleImage>
  	<idleImage idleImageYPC="45" idleImageHeightPC="10">../etc/translate/rss/image/POPUP_LOADING_04.png<idleImageWidthPC><script>10 * screenYp / screenXp;</script></idleImageWidthPC><idleImageXPC><script>45 + 10 * (1 - screenYp / screenXp) / 2;</script></idleImageXPC></idleImage>
  	<idleImage idleImageYPC="45" idleImageHeightPC="10">../etc/translate/rss/image/POPUP_LOADING_05.png<idleImageWidthPC><script>10 * screenYp / screenXp;</script></idleImageWidthPC><idleImageXPC><script>45 + 10 * (1 - screenYp / screenXp) / 2;</script></idleImageXPC></idleImage>
  	<idleImage idleImageYPC="45" idleImageHeightPC="10">../etc/translate/rss/image/POPUP_LOADING_06.png<idleImageWidthPC><script>10 * screenYp / screenXp;</script></idleImageWidthPC><idleImageXPC><script>45 + 10 * (1 - screenYp / screenXp) / 2;</script></idleImageXPC></idleImage>
  	<idleImage idleImageYPC="45" idleImageHeightPC="10">../etc/translate/rss/image/POPUP_LOADING_07.png<idleImageWidthPC><script>10 * screenYp / screenXp;</script></idleImageWidthPC><idleImageXPC><script>45 + 10 * (1 - screenYp / screenXp) / 2;</script></idleImageXPC></idleImage>
  	<idleImage idleImageYPC="45" idleImageHeightPC="10">../etc/translate/rss/image/POPUP_LOADING_08.png<idleImageWidthPC><script>10 * screenYp / screenXp;</script></idleImageWidthPC><idleImageXPC><script>45 + 10 * (1 - screenYp / screenXp) / 2;</script></idleImageXPC></idleImage>
		<itemDisplay>
			<text align="left" lines="1" offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>
				<script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
					if(focus==idx) 
					{
					  location = getItemInfo(idx, "location");
					  annotation = getItemInfo(idx, "annotation");
					  if(annotation == "" || annotation == null)
					    annotation = getItemInfo(idx, "stream_genre");
					  streamurl = getItemInfo(idx, "stream_url");
					}
					getItemInfo(idx, "title");
				</script>
				<fontSize>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "16"; else "14";
  				</script>
				</fontSize>
			  <backgroundColor>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "32:122:32"; else "-1:-1:-1";
  				</script>
			  </backgroundColor>
			  <foregroundColor>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "255:255:255"; else "140:140:140";
  				</script>
			  </foregroundColor>
			</text>
		</itemDisplay>
		
  <onUserInput>
    <script>
      ret = "false";
      userInput = currentUserInput();
      majorContext = getPageInfo("majorContext");
      
      print("*** majorContext=",majorContext);
      print("*** userInput=",userInput);
      
      if(userInput == "enter" || userInput == "ENTR")
      {
        showIdle();
        focus = getFocusItemIndex();
        request_title = getItemInfo(focus, "title");
        request_url = getItemInfo(focus, "location");
        request_options = getItemInfo(focus, "options");
        request_image = getItemInfo(focus, "image");
        stream_url = getItemInfo(focus, "stream_url");
        stream_title = getItemInfo(focus, "stream_title");
        stream_type = getItemInfo(focus, "stream_type");
        stream_protocol = getItemInfo(focus, "stream_protocol");
        stream_soft = getItemInfo(focus, "stream_soft");
        stream_class = getItemInfo(focus, "stream_class");
        stream_server = getItemInfo(focus, "stream_server");
        stream_status_url = "";
        stream_current_song = "";
        stream_genre = getItemInfo(focus, "stream_genre");
        stream_bitrate = getItemInfo(focus, "stream_bitrate");
        playlist_autoplay = getItemInfo(focus, "autoplay");
        if(playlist_autoplay == "" || playlist_autoplay == null)
          playlist_autoplay = 1;
        
        if(stream_class == "" || stream_class == null || testStream == 1)
          stream_class = "unknown";
        if(stream_url == "" || stream_url == null)
          stream_url = request_url;
        if(stream_server != "" &amp;&amp; stream_server != null)
          stream_status_url = translate_base_url + "status," + urlEncode(stream_server) + "," + urlEncode(stream_url);
        if(stream_title == "" || stream_title == null)
          stream_title = request_title;
        if(stream_url != "" &amp;&amp; stream_url != null)
        {
          if(stream_protocol == "file" || (stream_protocol == "http" &amp;&amp; stream_soft != "shoutcast"))
          {
            url = stream_url;
          }
          else
          {
            if(stream_type != null &amp;&amp; stream_type != "")
            {
              request_options = "Content-type:"+stream_type+";"+request_options;
            }
            url = translate_base_url + "stream," + request_options + "," + urlEncode(stream_url);
          }
        
          executeScript(stream_class+"Dispatcher");
        }
        
        cancelIdle();
        ret = "true";
      }
      else if(userInput == "right" || userInput == "R") 
      {
        ret = "true";
	  } 
	  
	  else if (userInput == "zero" || userInput == "0") 
	  {
		ret = "true";
		showIdle();
		focus = getFocusItemIndex();
		favphp = "http://127.0.0.1:82/oscar-db/list_a.php?f=" + getItemInfo(focus, "idfav");
		dontredraw = doModalRss(favphp, "mediaDisplay", "text", 0); 
	  }
	  	 
      else if (userInput == "pagedown" || userInput == "pageup" || userInput == "PD" || userInput == "PG")
      {
        itemSize = getPageInfo("itemCount");
        idx = Integer(getFocusItemIndex());
        if (userInput == "pagedown")
        {
          idx -= -8;
          if(idx &gt;= itemSize)
            idx = itemSize-1;
        }
        else
        {
          idx -= 8;
          if(idx &lt; 0)
            idx = 0;
        }
        setFocusItemIndex(idx);
        setItemFocus(idx);
        redrawDisplay();
        ret = "true";
      }
      ret;
    </script>
  </onUserInput>
		
	</mediaDisplay>
		<item_template>
		<mediaDisplay  name="threePartsView">
    	<idleImage idleImageYPC="45" idleImageHeightPC="10">../etc/translate/rss/image/POPUP_LOADING_01.png<idleImageWidthPC><script>10 * screenYp / screenXp;</script></idleImageWidthPC><idleImageXPC><script>45 + 10 * (1 - screenYp / screenXp) / 2;</script></idleImageXPC></idleImage>
    	<idleImage idleImageYPC="45" idleImageHeightPC="10">../etc/translate/rss/image/POPUP_LOADING_02.png<idleImageWidthPC><script>10 * screenYp / screenXp;</script></idleImageWidthPC><idleImageXPC><script>45 + 10 * (1 - screenYp / screenXp) / 2;</script></idleImageXPC></idleImage>
    	<idleImage idleImageYPC="45" idleImageHeightPC="10">../etc/translate/rss/image/POPUP_LOADING_03.png<idleImageWidthPC><script>10 * screenYp / screenXp;</script></idleImageWidthPC><idleImageXPC><script>45 + 10 * (1 - screenYp / screenXp) / 2;</script></idleImageXPC></idleImage>
    	<idleImage idleImageYPC="45" idleImageHeightPC="10">../etc/translate/rss/image/POPUP_LOADING_04.png<idleImageWidthPC><script>10 * screenYp / screenXp;</script></idleImageWidthPC><idleImageXPC><script>45 + 10 * (1 - screenYp / screenXp) / 2;</script></idleImageXPC></idleImage>
    	<idleImage idleImageYPC="45" idleImageHeightPC="10">../etc/translate/rss/image/POPUP_LOADING_05.png<idleImageWidthPC><script>10 * screenYp / screenXp;</script></idleImageWidthPC><idleImageXPC><script>45 + 10 * (1 - screenYp / screenXp) / 2;</script></idleImageXPC></idleImage>
    	<idleImage idleImageYPC="45" idleImageHeightPC="10">../etc/translate/rss/image/POPUP_LOADING_06.png<idleImageWidthPC><script>10 * screenYp / screenXp;</script></idleImageWidthPC><idleImageXPC><script>45 + 10 * (1 - screenYp / screenXp) / 2;</script></idleImageXPC></idleImage>
    	<idleImage idleImageYPC="45" idleImageHeightPC="10">../etc/translate/rss/image/POPUP_LOADING_07.png<idleImageWidthPC><script>10 * screenYp / screenXp;</script></idleImageWidthPC><idleImageXPC><script>45 + 10 * (1 - screenYp / screenXp) / 2;</script></idleImageXPC></idleImage>
    	<idleImage idleImageYPC="45" idleImageHeightPC="10">../etc/translate/rss/image/POPUP_LOADING_08.png<idleImageWidthPC><script>10 * screenYp / screenXp;</script></idleImageWidthPC><idleImageXPC><script>45 + 10 * (1 - screenYp / screenXp) / 2;</script></idleImageXPC></idleImage>
		</mediaDisplay>
	</item_template>
  <videoDispatcher>
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, request_url);
    streamArray = pushBackStringArray(streamArray, request_options);
    streamArray = pushBackStringArray(streamArray, stream_url);
    streamArray = pushBackStringArray(streamArray, url);
    streamArray = pushBackStringArray(streamArray, stream_type);
    streamArray = pushBackStringArray(streamArray, stream_title);
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file://../etc/translate/rss/xspf/videoRenderer.rss"); 
  </videoDispatcher>
  
  <audioDispatcher>
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, request_url);
    streamArray = pushBackStringArray(streamArray, request_options);
    streamArray = pushBackStringArray(streamArray, stream_url);
    streamArray = pushBackStringArray(streamArray, url);
    streamArray = pushBackStringArray(streamArray, stream_type);
    streamArray = pushBackStringArray(streamArray, stream_status_url);
    streamArray = pushBackStringArray(streamArray, stream_current_song);
    streamArray = pushBackStringArray(streamArray, stream_genre);
    streamArray = pushBackStringArray(streamArray, stream_bitrate);
    streamArray = pushBackStringArray(streamArray, stream_title);
    streamArray = pushBackStringArray(streamArray, request_image);
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file://../etc/translate/rss/xspf/audioRenderer.rss");
  </audioDispatcher>
  
  <playlistDispatcher>
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, stream_url);
    streamArray = pushBackStringArray(streamArray, stream_url);
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "playlist");
    streamArray = pushBackStringArray(streamArray, playlist_autoplay);
    writeStringToFile(storagePath_playlist, streamArray);
    doModalRss("rss_file://../etc/translate/rss/xspf/xspfBrowser.rss");
  </playlistDispatcher>
  
  <rssDispatcher>
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, stream_url);
    streamArray = pushBackStringArray(streamArray, stream_url);
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file://../etc/translate/rss/xspf/rss_mediaFeed.rss");
  </rssDispatcher>
  <unknownDispatcher>
    if(testStream == 1 &amp;&amp; playlist_autoplay == 1)
      request_options = "Resolve-playlist:1";
    info_url    = translate_base_url + "info," + request_options + "," + urlEncode(request_url);
    error_info  = "";
    res = loadXMLFile(info_url);
    
    if (res != null)
    {
      error = getXMLElementCount("info","error");
      
      if(error != 0)
      {
  	    value = getXMLText("info","error");
  	    if(value != null)
  	    {
  	     error_info = value;
  	    }
      }
      else
      {
  	    value = getXMLAttribute("info","stream","url");
  	    if(value != null)
  	     stream_url = value;
  
  	    value = getXMLAttribute("info","stream","type");
  	    if(value != null)
  	     stream_type = value;
  	    
  	    value = getXMLAttribute("info","stream","class");
  	    if(value != null)
  	     stream_class = value;
  
  	    value = getXMLAttribute("info","stream","protocol");
  	    if(value != null)
  	     stream_protocol = value;
  
  	    value = getXMLAttribute("info","stream","server");
  	    if(value != null)
  	     stream_soft = value;
  
        stream_status_url = "";
        
  	    value = getXMLAttribute("info","stream","server_url");
  	    if(value != null)
  	    {
  	     stream_server_url = value;
  	     if((stream_soft == "icecast" || stream_soft == "shoutcast") &amp;&amp; stream_server_url!="")
  	     {
    	      stream_status_url = translate_base_url+"status,"+urlEncode(stream_server_url)+","+urlEncode(stream_url);
    	   }
  	    }
  	     
        value = getXMLText("info","status","stream-title");
  	    if(value != null)
  	     stream_title = value;
  
        stream_current_song = "";
  	    value = getXMLText("info","status","current-song");
  	    if(value != null)
    		  stream_current_song = value;
    		  
  	    value = getXMLText("info","status","stream-genre");
  	    if(value != null)
  	      stream_genre = value;
        
  	    value = getXMLText("info","status","stream-bitrate");
  	    if(value != null)
  	      stream_bitrate = value;
  
        options = "";
        
        if(stream_type != "")
          options = "Content-type:"+stream_type;
        
        if(options == "")
          options = stream_options;
        else
          options = options + ";" + stream_options;
  
  	    stream_translate_url = translate_base_url + "stream," + options + "," + urlEncode(stream_url);
  	    
  	    url = null;
  	    
  	    if(stream_class == "video" || stream_class == "audio")
    	  {
          if(stream_protocol == "file" || (stream_protocol == "http" &amp;&amp; stream_soft != "shoutcast"))
    	      url = stream_url;
    	    else
    	      url = stream_translate_url;
    	  }
    	  else
    	  {
  	      url = stream_url;
    	  }
    	     
    	  if(url != null)
    	  {
          if(stream_class == "audio" || stream_class == "video" || stream_class == "playlist" || stream_class == "rss")
          {
            executeScript(stream_class+"Dispatcher");
          }
          else
          {
            error_info = "Unsupported media type: " + stream_type;
          }
  	    }
  	    else
  	    {
          error_info = "Empty stream url!";
  	    }
      }
    }
    else
    {
      error_info = "CGI translate module failed!";
    }
    print("error_info=",error_info);
  </unknownDispatcher>
<script>
    channelImage = "/home/scripts/oscar-db/images/ch6.jpg";
</script>
<channel>
<?
$dbname = "./db/oscar-db.db";
$tablename = "audio_table";
$tablefav = "audio_fav";

$srch = $_GET['s'];
$genre = $_GET['g'];
$country = $_GET['c'];
$fav = $_GET['f'];
$db = new PDO("sqlite:$dbname");
// check if this script was called with argument
if($srch or $genre or $country) {
echo "<title>".$srch." ".$country." ". $genre."</title>\n";
$r = $db->query("select * from $tablename WHERE cntr LIKE '%$country%' AND gnre LIKE '%$genre%' AND chn LIKE '%$srch%' order by id");
while ($row = $r->fetch(SQLITE_ASSOC)) {
	echo "<item>\n";
    echo "<title>".$row['chn']."</title>\n";
	echo "<location>http://www.readonwebtv.com/pages/".$row['asxl'].".asx</location>\n";
	echo "<annotation>Ch.#: ".$row['asxl']." : ".$row['cntr']." : ".$row['gnre']."</annotation>\n";
	echo "<idfav>".$row['id']."</idfav>\n";
    echo "</item>\n\n";
    }
} else if (isset ($fav)) {
		if($fav==0) {  // list favorites
		echo "<title>Radio Favorites List</title>\n"; 
		 } else if($fav<0) {  // remove 
			$fav = -$fav;
			echo "<title>Radio Favorite #".$fav." Deleted</title>\n"; 
			$r = $db->query("delete from $tablefav WHERE id=$fav");
			$row = $r->fetch(SQLITE_ASSOC);
		} else if($fav>0) {  // Add
			echo "<title>Ch.# ".$fav." Added to Radio Favorites</title>\n"; 
			$r = $db->query("INSERT INTO $tablefav SELECT NULL,asxl, cntr, gnre,chn FROM $tablename WHERE id=$fav");
			$row = $r->fetch(SQLITE_ASSOC);
		} 
		$r = $db->query("select * from $tablefav order by id");
		 while ($row = $r->fetch(SQLITE_ASSOC)) {
			echo "<item>\n";
			echo "<title>".$row['chn']."</title>\n";
			echo "<location>http://www.readonwebtv.com/pages/".$row['asxl'].".asx</location>\n";
			echo "<annotation>Ch.#: ".$row['asxl']." : ".$row['cntr']." : ".$row['gnre']."</annotation>\n";
			echo "<idfav>".-$row['id']."</idfav>\n";  // negative for future removing
			echo "</item>\n\n";
		  } 
} else {
    echo "<title>List</title>\n";
	echo "<item>\n";
    echo "<title>Empty</title>\n";
    echo "</item>\n\n";
}
?>
<item>
<title>- - - end - - -</title>
<idfav>no</idfav>
</item>
</channel>
</rss>
