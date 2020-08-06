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
    'books' => [
      'template' => 'main',
      'data' => [
        'title' => 'Alexander Safonov: Damaging my eyes',
        'content' => file_get_contents('data/books'),
        'class' => 'books wrap',
        'tiramisu' => '<div class="tiramisu" onclick="topFunction()" id="tiramisu">tira mi su</div>',
        'books_active' => 'active'
      ]
    ],
    'cv' => [
      'template' => 'main',
      'data' => [
        'title' => 'Alexander Safonov: CV',
        'content' => file_get_contents('data/cv'),
        'class' => 'books wrap',
        'tiramisu' => '<div class="tiramisu" onclick="topFunction()" id="tiramisu">tira mi su</div>',
        'cv_active' => 'active'
      ]
    ],
    'projects' => [
      'template' => 'main',
      'data' => [
        'title' => 'Alexander Safonov: Projects',
        'content' => file_get_contents('data/projects'),
        'class' => 'wrap',
        'projects_active' => 'active'
      ]
    ],
    'monly' => [
      'template' => 'main',
      'data' => [
        'title' => 'Alexander Safonov: Projects/Monly',
        'content' => file_get_contents('data/monly'),
        'class' => 'wrap',
        'projects_active' => 'active'
      ]
    ],
    'sunrise' => [
      'template' => 'main',
      'data' => [
        'title' => 'Alexander Safonov: Projects/Sunrise DAW',
        'content' => file_get_contents('data/sunrise'),
        'class' => 'wrap',
        'projects_active' => 'active'
      ]
    ],
    'tangerine' => [
      'template' => 'main',
      'data' => [
        'title' => 'Alexander Safonov: Projects/Tangerine CMS',
        'content' => file_get_contents('data/tangerine'),
        'class' => 'wrap',
        'projects_active' => 'active'
      ]
    ],
    'travels' => [
      'template' => 'main',
      'data' => [
        'title' => 'Alexander Safonov: Wherever I may roam',
        'content' => '<div style="text-align: center"><p>This website is <p>being updated. <p>This section is <p>coming soon</div>',
        'class' => 'wrap',
        'travels_active' => 'active'
      ]
    ],
    'blog' => [
      'template' => 'main',
      'data' => [
        'title' => 'Alexander Safonov: My manywords twitter',
        'content' => '<div style="text-align: center"><p>This website is <p>being updated. <p>This section is <p>coming soon</div>',
        'class' => 'wrap',
        'blog_active' => 'active'
      ]
    ]
  ]
];
