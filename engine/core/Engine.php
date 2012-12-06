<?php
class Engine {

	function construct() 
	{
		var_dump($GLOBALS);
	}
	
	function Run()
	{
		$this->Source();
	}
	
	function Source()
	{
		?>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
		<style>
		.menu_item
		{
			width:250px;
			height:40px;
			border:1px solid #000;
			font-size:30px;
			color:#fff;
			background:#404040;
			list-style:none;
			cursor:pointer;
			padding:10px;
			margin:2px;
			-moz-box-shadow:inset 0 0 10px #000000;
			-webkit-box-shadow:inset 0 0 10px #000000;
			box-shadow:inset 0 0 10px #000000;
		}
		.menu_item:hover
		{
			background:#5C5C5C;
		}
		.mini_menu_item
		{
			width:200px;
			height:15px;
			border:1px solid #000;
			font-size:14px;
			color:#fff;
			background:#404040;
			list-style:none;
			cursor:pointer;
			padding:10px;
			margin:2px;
			float:left;
			-moz-box-shadow:inset 0 0 10px #000000;
			-webkit-box-shadow:inset 0 0 10px #000000;
			box-shadow:inset 0 0 10px #000000;
		}
		.mini_menu_item:hover
		{
			background:#5C5C5C;
		}
		.text-block
		{
			width:500px;
			height:170px;
			margin:30px 50px;
			padding:10px;
			background-color:#000;
			border:1px solid #000;
			color:#fff;
			/* for IE */
			filter:alpha(opacity=60);
			/* CSS3 standard */
			opacity:0.6;
		}
		body
		{
			margin:0px;
			padding:30px;
			overflow:hidden;
			height:100%;
			background: url('<?php echo $this->main_screen_bg; ?>');
		}
		</style>
		<script>
		function playSound(soundfile) 
		{
			document.getElementById("dummy").innerHTML="<audio autoplay='autoplay'><source src='<?=$this->config['source_path']?>/sounds/"+soundfile+".wav' type='audio/wav' /></audio>";
		}
		function load_view(view)
		{
			$("body").html("<h3>Loading...</h3>").load("index.php?screen="+view);
		}
		</script>
		<body onload="load_view('main');"></body>
		<div id="dummy" style="display:none;"></div>
		<?
	}
	
	function Image($img, $position = 'top-left')
	{
		$pos = $this->Position_Handler($position);
		echo "<img src='".$this->config['source_path']."/images/$img' style='$pos'>";
	}
	
	function Canvas($html)
	{
		echo "<div id='canvas'>$html</div>";
	}
	
	function Text($text, $position = "custom=top:100;left:20%;position:absolute;margin:30px;")
	{
		$pos = $this->Position_Handler($position);
		echo "<p class='text-block' style='$pos'>$text</p>";
	}
	
	function playSound($src, $controls = false)
	{
		if($controls){
			$audio = "<audio loop='loop' controls='controls' autoplay='autoplay'>\n";
		} else {
			$audio = "<audio loop='loop' autoplay='autoplay'>\n";
		}
		$audio .= "<source src='".$this->config['source_path']."/sounds/$src.ogg' type='audio/ogg' />\n";
		$audio .= "<source src='".$this->config['source_path']."/sounds/$src.mp3' type='audio/mp3' />\n";
		$audio .= "</audio>";
		echo $audio;
		return $audio;
	}
	
	function MiniMenu($items, $position = 'top-left')
	{
		$items = explode(",", $items);
		$pos = $this->Position_Handler($position);
		echo "<div id='Menu' style='position:absolute;margin:30px;$pos'>";
		for($i=0;$i<count($items);$i++){
			$nav_item = explode("=", $items[$i]);
			?><li class="mini_menu_item" onmouseover="playSound('boing2');" onclick="load_view('<?php echo $nav_item[1]; ?>');"><?php echo $nav_item[0]; ?></li><?
		}
		echo "</div>";
	}
	
	function Position_Handler($position)
	{
		$custom = strpos($position, "=");
		if($custom===false) {
			$custom = false;
		} else {
			$position = explode("=", $position);
			$css = $position[1];
			$position = "custom";
		}
		if($position=="top-left"){
			$pos = "top:0;left:0;position:absolute;";
		} else if($position=="top-center"){
			$pos = "top:0;left:37%;position:absolute;";
		} else if($position=="top-right"){
			$pos = "top:0;right:0;position:absolute;";
		} else if($position=="middle-left"){
			$pos = "top:25%;left:0;position:absolute;";
		} else if($position=="middle-center"){
			$pos = "top:25%;left:37%;position:absolute;";
		} else if($position=="middle-right"){
			$pos = "top:25%;right:0;position:absolute;";
		} else if($position=="bottom-right"){
			$pos = "bottom:0;right:0;position:absolute;";
		} else if($position=="bottom-center"){
			$pos = "bottom:0;left:37%;position:absolute;";
		} else if($position=="bottom-left"){
			$pos = "bottom:0;left:0;position:absolute;";
		} else if($position=="custom"){
			$pos = $css;
		}
		return $pos;
	}
	
	function Menu($items, $position)
	{
		$items = explode(",", $items);
		$pos = $this->Position_Handler($position);
		echo "<div id='Menu' style='$pos'>";
		for($i=0;$i<count($items);$i++){
			$nav_item = explode("=", $items[$i]);
			?><li class="menu_item" onmouseover="playSound('boing2');" onclick="load_view('<?php echo $nav_item[1]; ?>');"><?php echo $nav_item[0]; ?></li><?
		}
		echo "</div>";
	}
	
	function Alert($message, $type = 'info')
	{
		echo $message;
	}
}