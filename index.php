<?php
/*
 *---------------------------------------------------------------
 * PIPE DREAM GAME ENGINE v1.0
 * BY Ronald A. Richardson
 * www.ronaldarichardson.com
 * theprestig3@gmail.com
 *---------------------------------------------------------------
 */
	define('ENGINENAME', 'Pipe Dream');
	define('ENGINEVERSION', '1.0');
/*
 *---------------------------------------------------------------
 * GAME ENVIRONMENT
 *---------------------------------------------------------------
 */
	define('ENVIRONMENT', 'development');
/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 */

if (defined('ENVIRONMENT'))
{
	switch (ENVIRONMENT)
	{
		case 'development':
			error_reporting(E_ALL);
		break;
	
		case 'testing':
		case 'production':
			error_reporting(0);
		break;

		default:
			exit('The application environment is not set correctly.');
	}
}

/*
 *---------------------------------------------------------------
 * ENGINE FOLDER NAME
 *---------------------------------------------------------------
 */
	$engine_path = 'engine';

/*
 *---------------------------------------------------------------
 * GAME FOLDER NAME
 *---------------------------------------------------------------
 */
	$game_folder = 'game';




/*
 * -------------------------------------------------------------------
 *  CONFIG
 * -------------------------------------------------------------------
 */
	$config['game_name'] = '';
	$config['source_path'] = 'source';
	$config['default_script'] = 'legend_of_v';

/*
 * ---------------------------------------------------------------
 *  Resolve the engine path for increased reliability
 * ---------------------------------------------------------------
 */

	// Set the current directory correctly for CLI requests
	if (defined('STDIN'))
	{
		chdir(dirname(__FILE__));
	}

	if (realpath($engine_path) !== FALSE)
	{
		$engine_path = realpath($engine_path).'/';
	}

	// ensure there's a trailing slash
	$engine_path = rtrim($engine_path, '/').'/';

	// Is the system path correct?
	if ( ! is_dir($engine_path))
	{
		exit("Your engine folder path does not appear to be set correctly. Please open the following file and correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME));
	}

/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */
	// The name of THIS file
	define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

	// The PHP file extension
	// this global constant is deprecated.
	define('EXT', '.php');

	// Path to the system folder
	define('ENGINEPATH', str_replace("\\", "/", $engine_path));

	// Path to the front controller (this file)
	define('FCPATH', str_replace(SELF, '', __FILE__));

	// Name of the "system folder"
	define('SYSDIR', trim(strrchr(trim(ENGINEPATH, '/'), '/'), '/'));


	// The path to the "application" folder
	if (is_dir($game_folder))
	{
		define('GAMEPATH', $game_folder.'/');
	}
	else
	{
		if ( ! is_dir(ENGINEPATH . $game_folder.'/'))
		{
			exit("Your game folder path does not appear to be set correctly. Please open the following file and correct this: ".SELF);
		}

		define('GAMEPATH', ENGINEPATH . $game_folder . '/');
	}
/*
 * --------------------------------------------------------------------
 * LOAD ENGINE
 * --------------------------------------------------------------------
 */
 include ENGINEPATH . 'core/Engine.php';

/*
 * --------------------------------------------------------------------
 * LOAD PIPE DREAM
 * --------------------------------------------------------------------
 *
 * And away we go...
 *
 */
require_once ENGINEPATH . 'core/PipeDream.php';