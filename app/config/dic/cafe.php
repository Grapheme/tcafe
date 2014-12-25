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
            'image_id' => array(
                'title' => 'Фоновое изображение',
                'type' => 'image',
            ),
            'info' => array(
                'title' => 'Информационный блок (режим работы, телефон и т.д.)',
                'type' => 'textarea_redactor',
            ),
            'cafe_lat' => array(
                'title' => 'Широта',
                'type' => 'text',
            ),
            'cafe_lng' => array(
                'title' => 'Долгота',
                'type' => 'text',
            ),
        );
    },


    'seo' => 0,

    'versions' => 0,
);