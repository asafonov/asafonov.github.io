<?php
return [
  'pages' => [
    'index' => [
      'template' => 'main',
      'data' => [
        'title' => 'Alexander Safonov: I did write code once',
        'content' => file_get_contents('data/index'),
        'class' => 'main_page'
      ]
    ]
  ]
];
