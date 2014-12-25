<?php

return array(

    'fields' => function($dicval = NULL) {

        return array(
            'gallery_id' => array(
                'title' => 'Галерея изображений',
                'type' => 'gallery',
                'params' => array(
                    'maxfilesize' => 2, // MB
                    'acceptedfiles' => 'image/*',
                ),
                'handler' => function($array, $element) {
                    return ExtForm::process('gallery', array(
                        'module'  => 'DicValMeta',
                        'unit_id' => $element->id,
                        'gallery' => $array,
                        'single'  => true,
                    ));
                }
            ),
            'video_link' => array(
                'title' => 'ИЛИ полная ссылка на видеофайл',
                'type' => 'text',
            ),
            'video_image' => array(
                'title' => 'Фото-превью для видео',
                'type' => 'image',
            ),
        );
    },


    'seo' => 0,

    'versions' => 0,
);