<?php

define('IMAGE_PREVIEW', false);

function get_page_num ($current, $count, $per_page) {
  $page_num = intval(($count - $current) / $per_page) + 1;
  return $page_num;
}

function get_page_name ($page_num, $file) {
  return $page_num == 1 ? "$file.html" : "{$file}{$page_num}.html";
}

function get_article_name ($title, $date) {
  return 'blog/' . preg_replace('/[^A-z0-9_\-]/', '_', $date . '_' . $title) . '.html';
}

function get_pager ($page_num, $num_pages, $file) {
  if ($num_pages == 1) {
    return '';
  }

  $ret = '<div class="pager">';

  for ($i = 1; $i <= $num_pages; ++$i) {
    $page_name = get_page_name($i, $file);
    $is_active = $page_num == $i ? ' class="active"' : '';
    $ret .= "<a href='$page_name'$is_active>$i</a>";
  }

  return "$ret</div>";
}

$file = count($argv) > 1 ? $argv[1] : 'blog';
$records = file_exists("./data/$file.json") ? json_decode(file_get_contents("./data/$file.json")) : [];

if (count($records) == 0) {
  die("No records found");
}

$per_page = 15;
$num_pages = intval(count($records) / $per_page) + (count($records) % $per_page > 0 ? 1 : 0);
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
  $content = isset($records[$i]->plain) ? '<p>' . str_replace("\n", '<p>', $records[$i]->plain) : (isset($records[$i]->html) ? $records[$i]->html : '');
  $listcontent = str_replace(['{title}', '{date}', '{announce}', '{item_url}', '{img}'], [$records[$i]->title, $records[$i]->date, isset($records[$i]->announce) ? $records[$i]->announce : '', $item_url, IMAGE_PREVIEW && ! empty($records[$i]->files) ? str_replace('{filename}', $records[$i]->files[0], $image_template) : ''], $list_template);

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
  $pages[$page_name]['page_num'] = $page_num;
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

$active_page = "{$file}_active";

foreach ($pages as $name => $page) {
  if (isset($page['is_item']) && $page['is_item']) {
    file_put_contents($name, str_replace(
      ['{content}', '{title}', '{item_title}', '{date}', "{{$active_page}}"],
      [$page['content'], $page['title'], $page['item_title'], $page['date'], 'active'],
      $item_template)
    );
  } else {
    file_put_contents($name, str_replace(
      ['{content}', '{title}', '{pager}', "{{$active_page}}"],
      [$page['content'], $page['title'], get_pager($page['page_num'], $num_pages, $file), 'active'],
      $main_template)
    );
  }
}
