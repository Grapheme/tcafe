<?php

return array(

    'fields' => function($dicval = NULL) {

        /**
         * Предзагружаем нужные словари с данными, по системному имени словаря, для дальнейшего использования.
         * Делается это одним SQL-запросом, для снижения нагрузки на сервер БД.
         */
        $dics_slugs = array(
            'menu_category',
        );
        $dics = Dic::whereIn('slug', $dics_slugs)->with('values')->get();
        $dics = DicLib::modifyKeys($dics, 'slug');
        #Helper::tad($dics);
        $lists = Dic::makeLists($dics, 'values', 'name', 'id');

        return array(
            'category_id' => array(
                'title' => 'Категория меню',
                'type' => 'select',
                'values' => $lists['menu_category'], ## Используется предзагруженный словарь
            ),
            'description' => array(
                'title' => 'Описание',
                'type' => 'textarea',
            ),
            'image' => array(
                'title' => 'Изображение',
                'type' => 'image',
            ),
            'price' => array(
                'title' => 'Цена (число, без валюты)',
                'type' => 'text',
            ),
            'serving' => array(
                'title' => 'Вес, порция',
                'type' => 'text',
            ),
        );
    },

    'seo' => 0,

    'versions' => 0,
);