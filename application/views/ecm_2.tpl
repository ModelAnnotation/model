{*
<?php
	/**
     * @author  Dennis A. Simpson
     * @copyright  2014
     * @version 0.5
     * @abstract  Handles displaying zoomable maps.
     */
?>
*}

	<style type="text/css">
		html, body{
			background-color:#000000;
			margin: 0px;
			padding: 0px;
			width:100%;
			height:100%;
		}
	</style>
	
	
	<script type="text/javascript">
		var megazoom;
		
		FWDUtils.onReady(function(){
			megazoom =  new FWDMegazoom({
				//----main----//
				parentId:"myDiv",
				playListAndSkinId:"megazoomPlayList",
				displayType:"responsive",
				skinPath:"zoom/skin_round_silver/skin/",
				imagePath:"ecm/ecm_2.svg",
				preloaderText:"Image Loading....",
				useEntireScreen:"yes",
				addKeyboardSupport:"yes",
				addDoubleClickSupport:"yes",
				imageWidth:1615,
				imageHeight:578,
				zoomFactor:5,
				doubleClickZoomFactor:1.6,
				startZoomFactor:"default",
				panSpeed:8,
				zoomSpeed:.1,
				backgroundColor:"#FFFFFF",
				preloaderFontColor:"#585858",
				preloaderBackgroundColor:"#FFFFFF",
				//----lightbox-----//
				lightBoxWidth:800,
				lightBoxHeight:550,
				lightBoxBackgroundOpacity:.8,
				lightBoxBackgroundColor:"#000000",
				//----controller----//
				buttons:"moveLeft, moveRight, moveDown, moveUp, scrollbar, hideOrShowMarkers, hideOrShowController, info, fullscreen",
				buttonsToolTips:"Move left, Move right, Move down, Move up, Zoom level: , Hide markers/Show markers, Hide controller/Show controller, Info, Full screen/Normal screen",
				controllerPosition:"bottom",
				inversePanDirection:"yes",
				startSpaceBetweenButtons:10,
				spaceBetweenButtons:10,
				startSpaceForScrollBarButtons:20,
				startSpaceForScrollBar:6,
				hideControllerDelay:3,
				controllerMaxWidth:900,
				controllerBackgroundOpacity:1,
				controllerOffsetY:0,
				scrollBarOffsetX:0,
				scrollBarHandlerToolTipOffsetY:4,
				zoomInAndOutToolTipOffsetY:-4,
				buttonsToolTipOffsetY:0,
				hideControllerOffsetY:2,
				buttonToolTipFontColor:"#585858",
				//----navigator----//
				showNavigator:"yes",
				showNavigatorOnMobile:"yes",
				navigatorImagePath:"zoom/skin_embossed_grey/navigatorImage.jpg",
				navigatorPosition:"topright",
				navigatorOffsetX:6,
				navigatorOffsetY:6,
				navigatorHandlerColor:"#FF0000",
				navigatorBorderColor:"#FFFFFF",
				//----info window----//
				infoWindowBackgroundOpacity:.6,
				infoWindowBackgroundColor:"#FFFFFF",
				infoWindowScrollBarColor:"#585858",
				//----markers-----//
				showMarkersInfo:"yes",
				markerToolTipOffsetY:0,
				markerToolTipOffsetY:2,
				//----context menu----//
				showScriptDeveloper:"yes",
				contextMenuLabels:"Move left, Move right, Move down, Move up, Zoom in/Zoom out, Hide markers/Show markers, Hide controller/Show controller, Info, Full screen/Normal screen",
				contextMenuBackgroundColor:"#d1cfcf",
				contextMenuBorderColor:"#8f8d8d",
				contextMenuSpacerColor:"#acacac",
				contextMenuItemNormalColor:"#585858",
				contextMenuItemSelectedColor:"#FFFFFF",
				contextMenuItemDisabledColor:"#b7b4b4"
			});
		})
	</script>
		
	<!-- the div which is the zoomer parent (zoomer holder)style="width:940px; height:550px; -->
	<div id="myDiv" style="width:1200px; height:500px; margin:auto;"></div>
	
	<!-- start viewer, display:none is added in case that js is disabled! -->
	<div id="megazoomPlayList" style="display:none">

		<!-- info window-->
		<ul data-info="">
			<div class="infoDiv">
				<h1 class="largeLabel">LOREM IPSUM DOLOR SIT AMET</h1>
				<img class="leftImage" src="zoom/skin_round_silver/css_graphics/camera1.png" width="197" height="136">
				<p class="leftImageParagraph"><span class="boldDark">This type of window support unlimited text</span>, if the html content is too large on a mouse enabled device a scrollbar will appear and if the device has touch support the html content can be scrolled with the finger. This window has a responsive layout this means that it will adapt based on the available space (resize the browser window to see this feature in action). <a class="link" href="http://www.google.com" target="_blank">external link</a> amet tincidunt ligula semper. Sed luctus lorem dui, ut lobortis diam. Curabitur est sapien, viverra et aliquet ut, semper nec magna. In molestie, leo a ornare mollis, orci lacus fermentum felis, a scelerisque ante urna tincidunt diam. Ut pharetra est eu neque feugiat molestie. Sed nec laoreet ligula. Nulla cursus sapien ac massa ultrices id placerat massa varius.Nunc ac turpis nulla. Vestibulum placerat metus urna.</p>
				<div class="separator"></div>
				<h1 class="largeLabel">LOREM IPSUM DOLOR SIT AMET</h1>
				<img class="rightImage" src="zoom/skin_round_silver/css_graphics/camera2.png" width="197" height="136"/>
				<p class="rightImageParagraph"><span class="boldDark">Lorem ipsum dolor sit amet</span>, consectetur adipiscing elit. Aenean interdum enim eu ligula volutpat nec imperdiet nisi faucibus. Donec est diam, congue sed dapibus non, <a class="link" href="http://www.google.com" target="_blank">external link</a> rhoncus id felis. Nullam aliquam leo vel sem blandit sit amet tincidunt ligula semper. Sed luctus lorem dui, ut lobortis diam. Curabitur est sapien, viverra et aliquet ut, semper nec magna. In molestie, leo a ornare mollis, orci lacus fermentum felis, a scelerisque ante urna tincidunt diam. Ut pharetra est eu neque feugiat molestie. Sed nec laoreet ligula. Nulla cursus sapien ac massa ultrices id placerat massa varius. Nunc ac turpis nulla. Vestibulum placerat metus urna. Suspendisse leo purus, euismod vitae sollicitudin vitae, viverra nec eros orem ipsum dolor sit amet, consectetur adipiscing elit.</p>
				<div class="columnsSeparator"></div>
				<div class="columns">
					<p class="columnsFirstParagraph"><span class="boldDark">Lorem ipsum dolor sit amet</span>, consectetur adipiscing elit. Aenean interdum enim eu ligula volutpat nec imperdiet nisi faucibus. Donec est diam, congue sed dapibus non, rhoncus id felis. Nullam aliquam leo vel sem blandit sit amet tincidunt ligula semper. Sed luctus lorem dui, ut lobortis diam. Curabitur est sapien, viverra et aliquet ut, semper nec magna. In molestie, leo a ornare mollis, orci lacus fermentum felis, a scelerisque ante urna tincidunt diam. Ut pharetra est eu neque feugiat molestie. Sed nec laoreet ligula.</p>
					<p><span class="boldDark">Lorem ipsum dolor sit amet</span>, consectetur adipiscing elit. Aenean interdum enim eu ligula volutpat nec imperdiet nisi faucibus. Donec est diam, congue sed dapibus non, rhoncus id felis. Nullam aliquam leo vel sem blandit sit amet tincidunt ligula semper. Sed luctus lorem dui, ut lobortis diam. Curabitur est sapien, viverra et aliquet ut, semper nec magna. In molestie, leo a ornare mollis, orci lacus fermentum felis, a scelerisque ante urna tincidunt diam. Ut pharetra est eu neque feugiat molestie. Sed nec laoreet ligula.</p>
					<p class="columnsLastParagraph"><span class="boldDark">Lorem ipsum dolor sit amet</span>, consectetur adipiscing elit. Aenean interdum enim eu ligula volutpat nec imperdiet nisi faucibus. Donec est diam, congue sed dapibus non, rhoncus id felis. Nullam aliquam leo vel sem blandit sit amet tincidunt ligula semper. Sed luctus lorem dui, ut lobortis diam. Curabitur est sapien, viverra et aliquet ut, semper nec magna. In molestie, leo a ornare mollis, orci lacus fermentum felis, a scelerisque ante urna tincidunt diam. Ut pharetra est eu neque feugiat molestie. Sed nec laoreet ligula.</p>	
				</div>
				<div class="separator"></div>
				<h1 class="largeLabel">LOREM IPSUM DOLOR SIT AMET</h1>
				<iframe  class="youtubeVideo" src="http://www.youtube.com/embed/tC6uAfGun54?wmode=opaque" frameborder="0" allowfullscreen></iframe>
				<p class="lastParagraph"><span class="boldDark">Lorem ipsum dolor sit amet</span>, consectetur adipiscing elit. Aenean interdum enim eu ligula volutpat nec imperdiet nisi faucibus. Donec est diam, congue sed dapibus non, rhoncus id felis. Nullam aliquam leo vel sem blandit sit <a class="link" href="http://www.google.com" target="_blank">external link</a> amet tincidunt ligula semper. Sed luctus lorem dui, ut lobortis diam. Curabitur est sapien, viverra et aliquet ut, semper nec magna. In molestie, leo a ornare mollis, orci lacus fermentum felis, a scelerisque ante urna tincidunt diam. Ut pharetra est eu neque feugiat molestie. Sed nec laoreet ligula. Nulla cursus sapien ac massa ultrices id placerat massa varius. Nunc ac turpis nulla. Vestibulum placerat metus urna. Suspendisse leo purus, euismod vitae sollicitudin vitae, viverra nec eros orem ipsum dolor sit amet, consectetur adipiscing elit. Aenean interdum enim eu ligula volutpat nec imperdiet nisi faucibus. Donec est diam, congue sed dapibus non, rhoncus id felis. Nullam aliquam leo vel sem blandit sit amet tincidunt ligula semper. Sed luctus lorem dui, ut lobortis diam. Curabitur est sapien, viverra et aliquet ut, semper nec magna. In molestie, leo a ornare mollis, orci lacus fermentum felis, a scelerisque ante urna tincidunt diam. Ut pharetra.</p>
			</div>
		</ul>
	
	<!--------- markers --------->
		<ul data-markers="">
					
			<li data-marker-type="link" data-reg-point="center" data-marker-normal-state-path="zoom/skin_round_silver/skin/marker1.png" data-marker-selected-state-path="skin_round_silver/skin/marker1-rollover.png" data-marker-left="595" data-marker-top="255" data-marker-width="26" data-marker-height="26" data-show-after-zoom-factor=".65" data-tool-tip-label="External link (url and target can be specified)" data-marker-url="http://www.google.com" data-marker-target="_blank"></li>
			
			<li data-marker-type="link" data-reg-point="centerbottom" data-marker-normal-state-path="zoom/skin_round_silver/skin/marker3.png" data-marker-selected-state-path="skin_round_silver/skin/marker3-rollover.png" data-marker-left="250" data-marker-top="275" data-marker-width="28" data-marker-height="36" data-show-after-zoom-factor=".65" data-tool-tip-label="External link (url and target can be specified)" data-marker-url="http://www.google.com" data-marker-target="_blank"></li>
			
			<li data-marker-type="tooltip" data-show-content="yes" data-reg-point="centerbottom" data-marker-normal-state-path="zoom/skin_round_silver/skin/marker1.png" data-marker-selected-state-path="skin_round_silver/skin/marker1-rollover.png" data-marker-left="1102" data-marker-top="272" data-marker-width="28" data-marker-height="36" data-show-after-zoom-factor="0">
				<div class="groenlandToolTipInfoDiv">
					<div>
						<img class="groenland1Image" src="" width="83" height="124"/>
						<p class="groenland1P">This type of tooltip windows can be added with ease, they have a responsive layout and CSS support <a class="link" href="http://www.google.com" target="_blank">external link</a>.</p>
					</div>
					<div>
						<p class="groenland2P">The <span class="dark">hotspots</span> / <span class="dark">markers</span> can be of any size or shape (jpg, gif or png).</p>
						<img class="groenland2Image" src="zoom/skin_round_silver/css_graphics/groenland2.png" width="202" height="97"/>
					</div>
				</div>
			</li>
			
		</ul>
	</div>