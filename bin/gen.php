<?php

define('ROOT_DIR', '.');
$data = require_once(ROOT_DIR . '/data/data.php');

if (empty($data)) {
    throw new Exception("data is empty");
}

$templates = [];

foreach ($data['pages'] as $pagename => $param) {
    echo "\nProcessing page: $pagename";

    if (empty($templates[$param['template']])) {
        $templates[$param['template']] = file_get_contents(ROOT_DIR . '/templates/' . $param['template']);
    }

    $page = $templates[$param['template']];

    foreach ($param['data'] as $name => $value) {
        $page = str_replace('{' . $name . '}', $value, $page);
    }

    file_put_contents(ROOT_DIR . '/' . $pagename . '.html', $page);
}
echo "\n";
