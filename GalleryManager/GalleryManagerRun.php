<?php
/*
    Plugin Name: Custom Gallery
    Description: Culturepair Gallery for various event images
    Plugin URI: http://atiqul.me
    Version: 1.0
    Author: Md.Atiqul Haque
    Author URI: http://atiqul.me
    License: GPLv2

    Copyright 2014 Md.Atiqul Haque (email : md_atiqulhaque@yahoo.com)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA

*/
if ( ! defined( 'WPINC' ) ) {
    die;
}

require_once plugin_dir_path( __FILE__ ) . 'includes/GalleryManager.php';

function runGalleryManager() {

    $spmm = new GalleryManager();
    $spmm->run();
}
runGalleryManager();