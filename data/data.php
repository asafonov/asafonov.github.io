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
        'about_active' => 'active'
      ]
    ],
    'reading' => [
      'template' => 'main',
      'data' => [
        'title' => 'Alexander Safonov: Damaging my eyes',
        'content' => file_get_contents('data/books'),
        'class' => 'books wrap',
        'books_active' => 'active'
      ]
    ],
    'cv' => [
      'template' => 'main',
      'data' => [
        'title' => 'Alexander Safonov: Resume',
        'content' => file_get_contents('data/cv'),
        'class' => 'wrap'
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
    'accelerace' => [
      'template' => 'main',
      'data' => [
        'title' => 'Alexander Safonov: Projects/Acceleeace',
        'content' => file_get_contents('data/accelerace'),
        'class' => 'wrap',
        'projects_active' => 'active'
      ]
    ],
    'blockbuster' => [
      'template' => 'main',
      'data' => [
        'title' => 'Alexander Safonov: Projects/Block\'Buster',
        'content' => file_get_contents('data/blockbuster'),
        'class' => 'wrap',
        'projects_active' => 'active'
      ]
    ],
    'spass' => [
      'template' => 'main',
      'data' => [
        'title' => 'Alexander Safonov: Projects/Spass',
        'content' => file_get_contents('data/spass'),
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
    'cards' => [
      'template' => 'main',
      'data' => [
        'title' => 'Alexander Safonov: Projects/Cards',
        'content' => file_get_contents('data/cards'),
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
    'tgirc' => [
      'template' => 'main',
      'data' => [
        'title' => 'Alexander Safonov: Projects/TgIrc. A bridge between telegram and irc',
        'content' => file_get_contents('data/tgirc'),
        'class' => 'wrap',
        'projects_active' => 'active'
      ]
    ],
    'stille' => [
      'template' => 'main',
      'data' => [
        'title' => 'Alexander Safonov: Projects/Stille. A collection of bots for matrix',
        'content' => file_get_contents('data/stille'),
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
    ]
  ]
];
