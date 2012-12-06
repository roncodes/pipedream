<?php
class Pipe_Dream extends Engine {
	
	function __construct($config) 
	{		
		/*
		 * Load Helpers
		 */
		$this->Load_Helpers();
		 
		 /*
		  * Load Libraries
		  */
		$this->Load_Libraries();
		 
		 /*
		  * Config
		  */
		$this->config = $config;
		$this->engine = $this;
		$this->screen = $_GET['screen'];
		
		/* 
		 * Execute Engine 
		 */
		$this->Run();
		 
	}
	
	function Load_Helpers()
	{
		foreach (glob(ENGINEPATH . 'core/helpers/*.php') as $helper) {
			include($helper);
		}
	}
	
	function Load_Libraries()
	{
		foreach (glob(ENGINEPATH . 'core/libraries/*.php') as $lib) {
			include($lib);
		}
	}
	
	function Route()
	{
		$script = GAMEPATH . $this->config['default_script'] . EXT;
		if($script == NULL || !is_file($script)) {
			$this->Alert('No existing script selected to run on ' . ENGINENAME, 'error');
		}
		include($script);
	}

}

$pipe = new Pipe_Dream($config);
$pipe->Route();