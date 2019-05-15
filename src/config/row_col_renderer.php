<?php

return [

    'namespace' => 'App\\Renderers\\',

    'append_on_last_row' => true,

    'class_to_append' => 'mb-5',

    'max_per_row' => 4,

    'row_classes' => [
        'row',
        'text-center',
    ],

    'define_open_row' => '<div class="{row_classes}">',

    'define_close_row' => '</div>',
];