<?php 
/* 
Plugin Name: Search Keyword Redirect 
URI: http://werkpress.com 
Description: This plugin is designed to intercept and match keywords to wordpress searches and redirect to specific pages if a match is made
Version: 0.1
Author: Nick Pelton
Author URI: http://werkpress.com
License: GPLv2
*/

/* Copyright 2012 Nick Pelton (email : nick@werkpress.com)

This program is free software; you can redistribute it and/ or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version. This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA */ 

// @todo Add restrict access script here

// Paths
define( 'WW_PLUGIN_DIR',plugin_dir_path( __FILE__ )); 
define( 'WW_PLUGIN_URL', plugins_url('',__FILE__));


// Plugin setup
require_once(WW_PLUGIN_DIR . 'includes/setup.php');

// Plugin Main code
require_once(WW_PLUGIN_DIR . 'includes/main.php');

// Plugin Dashboard
require_once(WW_PLUGIN_DIR . 'includes/dashboard.php');