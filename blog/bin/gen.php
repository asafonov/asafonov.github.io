<?php

function get_page_num($current, $count, $per_page) {
  $page_num = intval(($count - $current) / $per_page) + 1;
  return $page_num;
}

function get_page_name($page_num, $file) {
  return $page_num == 1 ? "$file.html" : "{$file}{$page_num}.html";
}

function get_article_name($title, $date) {
  return 'blog/' . preg_replace('/[^A-z0-9_\-]/', '_', $date . '_' . $title) . '.html';
}

$file = count($argv) > 1 ? $argv[1] : 'blog';
$records = file_exists("./data/$file.json") ? json_decode(file_get_contents("./data/$file.json")) : [];

if (count($records) == 0) {
  die("No records found");
}

$per_page = 15;
$prev_page = 1;
$pages = [];
$main_template = file_get_contents('./templates/blog');
$item_template = file_get_contents('./templates/blogitem');
$list_template = file_get_contents('./templates/bloglist');
$image_template = file_get_contents('./templates/blogimage');

for ($i = count($records) - 1, $count = $i; $i >= 0; --$i) {
  $page_num = get_page_num($i, $count, $per_page);
  $page_name = get_page_name($page_num, $file);
  $item_url = get_article_name($records[$i]->title, $records[$i]->date);
  $content = isset($records[$i]->plain) ? '<p>' . str_replace("\n", '<p>', $records[$i]->plain) : $records[$i]->html;
  $listcontent = str_replace(['{title}', '{date}', '{announce}', '{item_url}'], [$records[$i]->title, $records[$i]->date, isset($records[$i]->announce) ? $records[$i]->announce : '', $item_url], $list_template);

  if (! empty($records[$i]->files)) {
    $images_count = substr_count($content, '{img}');

    for ($f = 0; $f < $images_count; ++$f) {
      $img = str_replace('{filename}', $records[$i]->files[$f], $image_template);
      $content = preg_replace('/\{img\}/', $img, $content, 1);
    }

    for ($f = $images_count, $j = count($records[$i]->files); $f < $j; ++$f) {
      $content .= str_replace('{filename}', $records[$i]->files[$f], $image_template);
    }
  }

  if (! isset($pages[$page_name])) {
    $pages[$page_name] = ['content' => ''];
    $pages[$page_name]['title'] = 'Alexander Safonov: Blog';
  }

  $pages[$page_name]['content'] .= $listcontent;
  $pages[$item_url] = [
    'content' => $content,
    'title' => "Alexander Safonov: {$records[$i]->title}",
    'item_title' => $records[$i]->title,
    'date' => $records[$i]->date,
    'page_name' => $page_name,
    'is_item' => true
  ];

  if ($prev_page != $page_num) {
    $prev_page_name = get_page_name($prev_page, $file);
    $pages[$prev_page_name]['prev'] = $page_name;
    $pages[$page_name]['next'] = $prev_page_name;
    $prev_page = $page_num;
  }
}

foreach ($pages as $name => $page) {
  if (isset($page['is_item']) && $page['is_item']) {
    file_put_contents($name, str_replace(
      ['{content}', '{title}', '{item_title}', '{date}', '{menu}'],
      [$page['content'], $page['title'], $page['item_title'], $page['date'], $pages[$page['page_name']]['content']],
      $item_template)
    );
  } else {
    file_put_contents($name, str_replace(
      ['{content}', '{title}', '{prev}', '{next}'],
      [$page['content'], $page['title'], isset($page['prev']) ? '<a href="' . $page['prev'] . '">Previous page</a>' : '', isset($page['next']) ? '<a href="' . $page['next'] . '">Next page</a>': ''],
      $main_template)
    );
  }
}
