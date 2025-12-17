<?php

/**
 * Project:     Takhreej: Simple PHP Open Source Web Addresses (URLs) Manager
 * File:        index.php
 *
 * Copyright (c) 2014, Mohammad Anini
 * The project is licensed under:
 *    Creative Commons BY-SA 4.0 License <https://creativecommons.org/licenses/by-sa/4.0/>
 *
 * @link https://takhreej.anini.me/
 * @copyright 2014 Anini
 * @author Mohammad Anini <https://anini.me/>
 * @version 1.0.0 (Feb 3, 2014)
 * @package Takhreej
 */

/**
 * Important notes:
 * 
 * 1. The .htacess file should have the following lines:
 * 
 *    RewriteEngine On
 *    RewriteCond %{REQUEST_FILENAME} !-f
 *    RewriteCond %{REQUEST_FILENAME} !-d
 *    RewriteRule ^/?(.*) index.php [L]
 *
 * 2. All the pages should be saved as .php files
 *
 * 3. This URL Manager supposed that all the pages are stored under "pages" directory which
 *    is under the root directory (you can change it!).
 *
 * 4. The main layout (footer & header) should be stored under "layouts" directory which is
 *    under the root directory (you can change it!).
 */

if (!empty($_SERVER['REQUEST_URI']))
{
    $root = dirname(__FILE__);

    // The requested URI
    $file_name = $_SERVER['REQUEST_URI'];

    // The actual index page (home page) must have another name or another location to avoid
    // recursion, we supposed that it's in the pages directory with "home.php" name (you can
    // change it!).
    if ($file_name == '/index.php' || $file_name == '/')
    {
        $file_name = 'home';
    }
    
    // Change the following to set title and description for every page in your site, and you
    // can use these variables in the header if you are using layout (header & footer),
    // otherwise just remove or comment out the following switch satement.
    switch ($file_name) {
        case 'banana':
            $title = 'I love banana!';
            $description = 'I love banana!';
            break;
        default:
            // Used for the home page
            $title = 'My lovely site!';
            $description = 'You will fall in love with my site!';
            break;
    }

    // If the requested file is not exists, the 404 page (which must be in the "pages"
    // directory) will be rendered.
    if (!file_exists($root . '/pages/' . $file_name . '.php'))
    {
        header('HTTP/1.0 404 Not Found');
        $file_name = '404';
    }

    // Rendering the header
    require_once $root . '/layout/header.php';
    // Rendering the requested page
    require_once $root . '/pages/' . $file_name . '.php';
    // Rendering the footer
    require_once $root . '/layout/footer.php';
    exit;
}
