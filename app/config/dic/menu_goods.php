<?php

return array(

    'fields' => function($dicval = NULL) {

        $menu = Dic::valuesBySlug('menu_category', function($query){
            $query->orderBy(DB::raw('-lft'), 'DESC'); ## 0, 1, 2 ... NULL, NULL
        });
        $menu = Dic::modifyKeys($menu, 'id');
        #Helper::ta($menu);
        $menu = DicLib::nestedModelToTree($menu);
        #Helper::tad($menu);

        return array(
            'category_id' => array(
                'title' => 'Категория меню',
                'type' => 'select',
                'values' => $menu,
            ),
            'description' => array(
                'title' => 'Описание',
                'type' => 'textarea',
            ),
            'image_id' => array(
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
            'show_on_mainpage' => array(
                'title' => 'Выводить на главной',
                'type' => 'checkbox',
                'no_label' => true,
                'label_class' => 'normal_checkbox',
            ),
        );
    },


    /**
     * MENUS - дополнительные пункты верхнего меню, под названием словаря.
     */
    'menus' => function($dic, $dicval = NULL) {

        $menus = array();
        $menus[] = array('raw' => '<br/>');

        $menu = Dic::valuesBySlug('menu_category', function($query){
            $query->orderBy(DB::raw('-lft'), 'DESC'); ## 0, 1, 2 ... NULL, NULL
        });
        $menu = Dic::modifyKeys($menu, 'id');
        $menu = DicLib::nestedModelToTree($menu);

        /**
         * Добавляем доп. элементы в меню, в данном случае: выпадающие поля для организации фильтрации записей по их свойствам
         */
        $menus[] = DicLib::getDicValMenuDropdown('category_id', 'Все меню', $menu, $dic);
        return $menus;
    },


    'seo' => 0,

    'versions' => 0,
);