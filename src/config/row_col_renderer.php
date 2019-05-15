<?php

return [

    /*
     * Where your renderers are stored.
     */
    'namespace' => 'App\\Renderers\\',

    /*
     * Where your models are stored in your app.
     * Only really used for the make:renderer command.
     *
     * Need a leading and finishing \
     * ie: '\\App\\'
     */
    'models_namespace' => '\\App\\',

    /*
     * Append an additional class to the last row?
     */
    'append_on_last_row' => true,

    /*
     * The class to append on last row.
     */
    'class_to_append' => 'mb-5',

    /*
     * Maximum number of items per row.
     */
    'max_per_row' => 4,

    /*
     * Classes to be added to the opening tag of a row.
     */
    'row_classes' => [
        'row',
        'text-center',
    ],

    /*
     * The HTML opening tag of a row.
     *
     * {row_classes} is automatically replaced
     */
    'define_open_row' => '<div class="{row_classes}">',

    /*
     * The HTML closing tag of a row.
     */
    'define_close_row' => '</div>',
];