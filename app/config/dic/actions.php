<?php

return array(

    'fields' => function($dicval = NULL) {

        /**
         * Предзагружаем нужные словари с данными, по системному имени словаря, для дальнейшего использования.
         * Делается это одним SQL-запросом, для снижения нагрузки на сервер БД.
         */
        $dics_slugs = array(
            'cafe',
            'photoalbums',
        );
        $dics = Dic::whereIn('slug', $dics_slugs)
            ->with(array('values_no_conditions' => function($query){
                $query->orderBy('created_at', 'DESC');
            }))
            ->get()
        ;
        $dics = Dic::modifyKeys($dics, 'slug');
        #Helper::tad($dics);
        $lists = Dic::makeLists($dics, 'values_no_conditions', 'name', 'id');
        $lists_ids = Dic::makeLists($dics, null, 'id', 'slug');
        #Helper::dd($lists);

        return array(
            'active' => array(
                'no_label' => true,
                'title' => 'Активно',
                'type' => 'checkbox',
                'label_class' => 'normal_checkbox',
            ),
            'image_id' => array(
                'title' => 'Изображение',
                'type' => 'image',
            ),
            'description' => array(
                'title' => 'Описание',
                'type' => 'textarea',
            ),
            'cafe_id' => array(
                'title' => 'Место проведения:',
                'type' => 'checkboxes',
                'columns' => 2, ## Количество колонок
                'values' => $lists['cafe'],
                'handler' => function ($value, $element) use ($lists_ids) {
                    $value = DicLib::formatDicValRel($value, 'cafe_id', $element->dic_id, $lists_ids['cafe']);
                    $element->related_dicvals()->sync($value);
                    return @count($value);
                },
                'value_modifier' => function ($value, $element) {
                    $return = (is_object($element) && $element->id)
                        ? $element->related_dicvals()->get()->lists('name', 'id')
                        : $return = array();
                    return $return;
                },
            ),
        );
    },


    'seo' => 0,

    'versions' => 0,
);