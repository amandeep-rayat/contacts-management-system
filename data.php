<?php
$base = 'contacts-management-system/';
$uri = str_replace($base, '', $_SERVER['REQUEST_URI']);
$url = parse_url($uri);
var_dump($url);
new PDO("mysql:host=localhost;dbname=contacts_management_system", "root", "");
?>