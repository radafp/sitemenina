<?php //$this->pageTitle = 'TV Mocinha On Line'; ?>
<div id="player_tvmocinha_gerador_wrapper" style="position: relative; display: block; width: 690px; height: 440px;">
	<object type="application/x-shockwave-flash" data="http://p.jwpcdn.com/6/12/jwplayer.flash.swf" width="100%" height="100%" bgcolor="#000000" id="player_tvmocinha_gerador" name="player_tvmocinha_gerador" class="jwswf">
		<param name="allowfullscreen" value="true"><param name="allowscriptaccess" value="always">
		<param name="seamlesstabbing" value="true"><param name="wmode" value="opaque">
	</object>
	<div id="player_tvmocinha_gerador_aspect" style="display: none;"></div>
</div>
<script src="http://jwpsrv.com/library/zJkgsJZJEeK6GCIACpYGxA.js"></script>
<script src="http://jwpsrv.com/library/5V3tOP97EeK2SxIxOUCPzg.js"></script>
<script type="text/javascript">

   if (navigator.userAgent.match(/android/i) != null){
      jwplayer("player_tvmocinha_gerador").setup({
         file: "http://173.236.10.10:1935/tvmocinha/tvmocinha/playlist.m3u8",
         type: "mp4",
         primary: "html5"
      });
   } else {
      jwplayer("player_tvmocinha_gerador").setup({
         sources: [{
            file: "rtmp://173.236.10.10:1935/tvmocinha/tvmocinha"
         },{
            file: "http://173.236.10.10:1935/tvmocinha/tvmocinha/playlist.m3u8"
         }],
         rtmp: {
            bufferlength: 3,
         },
         image: ' http://173.236.10.10/assets/img/logo_player.jpg',
         title: 'TV MOCINHA',
         width: '690',
         height: '440',
         aspectratio: '16:9',
         autostart: 'true',
         repeat: 'true',
         fallback: false,
      });
   }
</script>


<?php /*
   <div>
      <object class="player_tv" id="NSPlay" 
         codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,5,715" 
         type="application/x-oleobject" height="419" 
         standby="Loading Microsoft Windows Media Player components..." width="600" 
         classid="CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95">
            <param name="Filename" value="mms://tvmocinha.radioamfm.com.br/tvmocinha" />
         <param name="ShowDisplay" value="1" />
         <param name="ShowGotoBar" value="0" />
         <param name="ShowPositionControls" value="1" />
         <param name="ShowStatusBar" value="0" />
         <param name="ShowTracker" value="0" />
         <param name="TransparentAtStart" value="-1" />
         <param name="AutoRewind" value="1" />
         <param name="PlayCount" value="0" />
         <embed width="600" height="419" type="application/x-mplayer2" 
         pluginspage="http://www.microsoft.com/isapi/redir.dll?prd=windows&amp;sbp=mediaplayer&amp;ar=Media&amp;sba=Plugin&amp;" 
             showdisplay="0" showgotobar="0" showpositioncontrols="0" 
         showstatusbar="0" showtracker="0" transparentatstart="-1" filename="mms://tvmocinha.radioamfm.com.br/tvmocinha" autorewind="1" playcount="0"> </embed>
      </object>
   </div>
 */
 ?>
 
