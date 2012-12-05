<?php
require("engine.php");
$engine = new Game_Engine("Game Name", "mainbg.jpg", "logo.png");
$engine->Run();

/*
 * Below we are going to create our game screens
 * /

if($engine->screen=="main"){
	$engine->Game_Logo("custom|top:40;left:32%;position:absolute;margin:30px;");
	$engine->Menu("Play=play,About=about", "middle-center");
	$engine->playSound("beyond");
	die();
} else if($engine->screen=="play"){
	$engine->MiniMenu("Main=main", "top-left");
	$engine->Text("this is the play screen");
	die();
} else if($engine->screen=="about"){
	$engine->MiniMenu("Main=main", "top-left");
	$engine->Text("A quick game made with a simple game engine", "custom|top:100;left:20%;position:absolute;margin:30px;");
}