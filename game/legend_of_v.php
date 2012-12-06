<?php
/**
 ** Legend of V
 ** Sample game script using the Pipe Dream Engine
 ** Create an adventure using simple if else logic
 **/

if($this->screen == 'main'){
	$this->Image('logo.png', 'custom=top:40;left:32%;position:absolute;margin:30px;');
	$this->Menu('Play=play,About=about', 'middle-left');
	$this->playSound('beyond');
} else if($this->screen == 'about') {
	$this->MiniMenu('Back=main');
	$this->Text('Just testing this out');
}