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

$application_folder = __DIR__.'/application';

// Determine the CodeIgniter system folder expected in this directory.
$system_path = __DIR__.'/system';

if (!is_dir($system_path)) {
    $expected = rtrim(str_replace('\\', '/', $system_path), '/');
    exit(
        'Your system folder path does not appear to be set correctly. '
        . 'Please ensure the "system" directory exists in: '
        . $expected
    );

}

$system_path = rtrim(str_replace('\\', '/', realpath($system_path)), '/') . '/';
$application_folder = rtrim(str_replace('\\', '/', realpath($application_folder) ?: $application_folder), '/') . '/';

define('BASEPATH', $system_path);
define('APPPATH', $application_folder);
define('ENVIRONMENT', 'development');

// Load the bootstrap file from the system folder.
require_once BASEPATH.'core/CodeIgniter.php';

