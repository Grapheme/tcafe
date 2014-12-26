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
        #Helper::dd($lists_ids);

        return array(
            'image_id' => array(
                'title' => 'Изображение',
                'type' => 'image',
            ),
            'measure_date' => array(
                'title' => 'Дата проведения',
                'type' => 'date',
                'others' => array(
                    'class' => 'text-center',
                    'style' => 'width: 221px',
                    'placeholder' => 'Нажмите для выбора'
                ),
                'handler' => function($value) {
                    return $value ? @date('Y-m-d', strtotime($value)) : $value;
                },
                'value_modifier' => function($value) {
                    return $value ? date('d.m.Y', strtotime($value)) : date('d.m.Y');
                },
            ),
            'measure_time' => array(
                'title' => 'Время начала',
                'type' => 'text',
                'others' => array(
                    'class' => 'text-center',
                    'style' => 'width: 221px',
                ),
            ),
            'cafe_id' => array(
                'title' => 'Место проведения:',
                'type' => 'checkboxes',
                'columns' => 2, ## Количество колонок
                'values' => $lists['cafe'],
                'handler' => function ($value, $element) use ($lists_ids) {
                    #Helper::d($value);
                    #Helper::tad($element);
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
            'photoalbum_id' => array(
                'title' => 'Фото/Видео',
                'type' => 'select',
                'values' => array('не выбрано') + $lists['photoalbums'],
            ),
            'measure_age_limit' => array(
                'title' => 'Возрастные ограничения',
                'type' => 'text',
            ),
        );
    },


    'seo' => 0,

    'versions' => 0,
);