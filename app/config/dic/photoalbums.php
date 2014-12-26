<?php

return array(

    'fields' => function($dicval = NULL) {

        return array(
            'image_id' => array(
                'title' => 'Фото-превью для галереи или видео',
                'type' => 'image',
            ),
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
        );
    },


    'seo' => 0,

    'versions' => 0,
);