<?php

return array(

    'fields' => function($dicval = NULL) {

        return array(
            'address1' => array(
                'title' => 'Адрес',
                'type' => 'text',
            ),
            'address2' => array(
                'title' => 'Адрес (предложный падеж)',
                'type' => 'text',
            ),
            'fullname' => array(
                'title' => 'Полное название (заголовок на странице)',
                'type' => 'textarea',
            ),
        );
    },

    
    'seo' => 0,

    'versions' => 0,
);