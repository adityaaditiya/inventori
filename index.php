<?php
/**
 * Front controller for the Inventory Management Application.
 *
 * This file bootstraps CodeIgniter.  It defines the paths to the
 * application and system folders and then includes the core framework.
 *
 * CodeIgniter uses the Model-View-Controller (MVC) pattern to keep
 * presentation, business logic and data layers separate【907651110350654†L1383-L1413】.
 */

$system_path = '../system';
$application_folder = 'application';

/*
 * Resolve the system and application paths.  You may need to update these
 * variables depending on where you place CodeIgniter's `system` folder.
 */
$system_path = rtrim(str_replace('\\', '/', $system_path), '/');
$application_folder = rtrim(str_replace('\\', '/', $application_folder), '/');

define('BASEPATH', $system_path.'/');
define('APPPATH', $application_folder.'/');
define('ENVIRONMENT', 'development');

// Load the bootstrap file from the system folder.
require_once BASEPATH.'core/CodeIgniter.php';