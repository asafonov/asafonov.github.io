<?php
return
    ['pages' =>
     ['index' =>
      ['template' => 'main',
       'data' =>
       [
           'title' => 'Alexander Safonov: I did write code once',
           'content' => file_get_contents('data/about')
       ]
      ],
      'projects' =>
      [
          'template' => 'main',
          'data' =>
          [
              'title' => 'Alexander Safonov: my awesome projects',
              'content' => file_get_contents('data/projects'),
          ]
      ],
      'books' => [
          'template' => 'main',
          'data' =>
          [
              'title' => 'Alexander Safonov: damaging my eyes',
              'content' => file_get_contents('data/books'),
          ]
      ]
     ]
    ];
