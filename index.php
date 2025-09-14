<?php
/**
 * Front controller for the Inventory Management Application.
 *
 * This file bootstraps CodeIgniter.  It defines the paths to the
 * application and system folders and then includes the core framework.
 *
 * CodeIgniter uses the Model-View-Controller (MVC) pattern to keep
 * presentation, business logic and data layers separate.
*/

$system_path = __DIR__.'/system';
$application_folder = __DIR__.'/application';

/*
 * Resolve the system and application paths. Attempt to locate the system
 * folder in the current directory or one level up.
 */
if (!is_dir($system_path)) {
    $system_path = __DIR__.'/../system';
}

$system_path = rtrim(str_replace('\\', '/', $system_path), '/');
$application_folder = rtrim(str_replace('\\', '/', $application_folder), '/');

if (!is_dir($system_path)) {
    exit('Your system folder path does not appear to be set correctly.');
}

define('BASEPATH', $system_path.'/');
define('APPPATH', $application_folder.'/');
define('ENVIRONMENT', 'development');

// Load the bootstrap file from the system folder.
require_once BASEPATH.'core/CodeIgniter.php';
