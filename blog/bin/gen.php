<?php

function get_page_num($current, $count, $per_page) {
    $page_num = intval(($count - $current) / $per_page) + 1;
    return $page_num;
}

function get_page_name($page_num, $file) {
    return $page_num == 1 ? "$file.html" : "{$file}{$page_num}.html";
}

function get_article_name($title, $date) {
    return preg_replace('/[^A-z0-9_\-]/', '_', $date . '_' . $title) . '.html';
}

$file = count($argv) > 1 ? $argv[1] : 'blog';
$records = file_exists("./$file.json") ? json_decode(file_get_contents("./$file.json")) : [];

if (count($records) == 0) {
    die("No records found");
}

$config = require_once('./config/config.php');

$per_page = isset($config['records_per_page']) ? $config['records_per_page'] : 10;

$prev_page = 1;
$pages = [];
$item_template = file_get_contents('./templates/item.html');
$blog_template = file_get_contents('./templates/blog.html');
$image_template = file_get_contents('./templates/image.html');
for ($i=count($records) - 1, $count = $i; $i>=0; $i--) {
    $page_num = get_page_num($i, $count, $per_page);
    $page_name = get_page_name($page_num, $file);
    $item_url = get_article_name($records[$i]->title, $records[$i]->date);
    $content = isset($records[$i]->plain) ? nl2br($records[$i]->plain) : $records[$i]->html;
    $content = str_replace(['{title}', '{date}', '{content}', '{item_url}'], [$records[$i]->title, $records[$i]->date, $content, $item_url], $item_template);
    if (!empty($records[$i]->files)) {
        $images_count = substr_count($content, '{img}');
        for ($f=0; $f<$images_count; $f++) {
            $img = str_replace('{filename}', $records[$i]->files[$f], $image_template);
            $content = preg_replace('/\{img\}/', $img, $content, 1);
        }
        for ($f=$images_count, $j=count($records[$i]->files); $f<$j; $f++) {
            $content .= str_replace('{filename}', $records[$i]->files[$f], $image_template);
        }
    }
    if (!isset($pages[$page_name])) {
        $pages[$page_name] = ['content' => ''];
    }
    $pages[$page_name]['content'] .= $content;
    $pages[$item_url]['content'] = $content;
    if ($prev_page != $page_num) {
        $prev_page_name = get_page_name($prev_page, $file);
        $pages[$prev_page_name]['prev'] = $page_name;
        $pages[$page_name]['next'] = $prev_page_name;
        $prev_page = $page_num;
    }
}

foreach ($pages as $name => $page) {
    file_put_contents($name, str_replace(
        ['{content}', '{prev}', '{next}'],
        [$page['content'], isset($page['prev']) ? '<a href="' . $page['prev'] . '">Previous page</a>' : '', isset($page['next']) ? '<a href="' . $page['next'] . '">Next page</a>': ''],
        $blog_template)
    );
}
