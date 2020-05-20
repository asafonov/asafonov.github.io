<?php
return [
  'pages' => [
    'index' => [
      'template' => 'main',
      'data' => [
        'title' => 'Alexander Safonov: I did write code once',
        'content' => file_get_contents('data/index'),
        'class' => 'main_page',
        'intro' => '<div class="glitch_content"><h1 class="text glitch is-glitching" data-text="alexander safonov">alexander safonov</h1></div>'
      ]
    ],
    'about' => [
      'template' => 'main',
      'data' => [
        'title' => 'Alexander Safonov: I did write code once',
        'content' => file_get_contents('data/about'),
        'class' => 'wrap',
        'tiramisu' => '<div class="tiramisu" onclick="topFunction()" id="tiramisu">tira mi su</div>',
        'about_active' => 'active'
      ]
    ],
  ]
];
