<?php
require_once __DIR__ . '/../app/controllers/ContactController.php';

$controller = new ContactController();

$base = 'contacts-management-system/public/';
$uri = str_replace($base, '', $_SERVER['REQUEST_URI']);
$url = parse_url($uri);

if ($url['path'] === '/') {
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $controller->listContacts($page, $search, 5);
} else if ($url['path'] === '/i') {
    $page = isset($_GET['page']) ? (intval($_GET['page']) == 0 ? 1 : $_GET['page']) : 1;
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $limit = isset($_GET['pagelimit']) ? (intval($_GET['pagelimit']) == 0 ? 5 : $_GET['pagelimit']) : 5;
    $res = $controller->searchContacts($page, $search, $limit);
    echo $res;
} else if ($url['path'] === '/add') {
    $controller->addContact();
} else if ($url['path'] === '/update') {
    $controller->updateContact();
    // } else if (isset($url['query']) && strpos($url['query'], 'page') !== false) {
    //     $page = $_GET['page'];
    //     $controller->listContacts($page);
} else if (isset($url['query']) && $url['path'] === '/edit') {
    $id = $_GET['id'];
    $controller->editContact($id);
} else if (isset($url['query']) && $url['path'] === '/delete') {
    $id = $_GET['id'];
    $controller->deleteContact($id);
    // } else if (isset($url['query']) && strpos($url['path'], 'search') !== false) {
    //     $query = explode('=', $url['query'])[1];
    // $res = $controller->searchContacts($query);
    // echo $res;
} else if (strpos($url['path'], '/css') !== false) {
    $css = file_get_contents(__DIR__ . '/../public' . $url['path']);
    header('Content-Type: text/css');
    echo $css;
} else if (strpos($url['path'], '/js') !== false) {
    $js = file_get_contents(__DIR__ . '/../public' . $url['path']);
    echo $js;
} else if ($uri === '/about') {
    include __DIR__ . '/../app/views/about.php';
} else {
    var_dump($url);
    echo $uri;
    http_response_code(404);
    include __DIR__ . '/../app/views/error.php';
}
