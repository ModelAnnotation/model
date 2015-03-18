<?php /* Smarty version Smarty-3.1.17, created on 2015-03-09 15:51:10
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\ecm_3.tpl" */ ?>
<?php /*%%SmartyHeaderCode:778554fdf9ae7e29c4-41224355%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '57c67147eb4b5242bcbd3f4b2bd02782d376486b' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\ecm_3.tpl',
      1 => 1395275893,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '778554fdf9ae7e29c4-41224355',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54fdf9ae82cd52_05732728',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54fdf9ae82cd52_05732728')) {function content_54fdf9ae82cd52_05732728($_smarty_tpl) {?>

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
				imagePath:"ecm/ecm_3.svg",
				preloaderText:"Image Loading....",
				useEntireScreen:"yes",
				addKeyboardSupport:"yes",
				addDoubleClickSupport:"yes",
				imageWidth:1906,
				imageHeight:1314,
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
	
	</div><?php }} ?>
