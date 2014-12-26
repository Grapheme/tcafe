<?php

return array(

    'fields' => function($dicval = NULL) {

        /**
         * Предзагружаем нужные словари с данными, по системному имени словаря, для дальнейшего использования.
         * Делается это одним SQL-запросом, для снижения нагрузки на сервер БД.
         */
        $dics_slugs = array(
            'cafe',
        );
        $dics = Dic::whereIn('slug', $dics_slugs)->with('values')->get();
        $dics = Dic::modifyKeys($dics, 'slug');
        #Helper::tad($dics);
        $lists = Dic::makeLists($dics, 'values', 'name', 'id');
        $lists_ids = Dic::makeLists($dics, null, 'id', 'slug');
        #Helper::dd($lists);

        /**
         * Отдельно загружаем словарь с меню, т.к. там Nested Set Models, и его нужно обрабатывать отдельно
         */
        $menu = Dic::valuesBySlug('menu_category', function($query){
            $query->orderBy(DB::raw('-lft'), 'DESC'); ## 0, 1, 2 ... NULL, NULL
        });
        $menu = Dic::modifyKeys($menu, 'id');
        #Helper::ta($menu);
        $menu = DicLib::nestedModelToTree($menu);
        #Helper::tad($menu);

        return array(
            'cafe_id' => array(
                'title' => 'Доступно в следующих кафе:',
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


    /**
     * ACTIONS - дополнительные элементы в столбце "Действия", на странице списка записей словаря.
     * Внутри данной функции не должно производиться запросов к БД!
     * Все запросы следует выносить в хуки (описание хуков ниже).
     */
    'actions' => function($dic, $dicval) {

        /**
         * Получаем данные, которые были созданы с помощью хука before_index_view (описание ниже).
         */
        $dics = Config::get('temp.index_dics');
        #Helper::tad($dics);
        $dic_menu_goods = $dics['menu_goods'];
        $counts = Config::get('temp.index_counts');

        /**
         * Возвращаем доп. элементы в столбец "Действия": кнопки со ссылками и счетчиками, индивидуальны для каждой записи
         */
        return '
            <span class="block_ margin-bottom-5_">
                <a href="' . URL::route('entity.index', array('menu_goods', 'filter[fields][category_id]' => $dicval->id)) . '" class="btn btn-default">
                    Блюда (' . @(int)$counts[$dicval->id][$dic_menu_goods->id]. ')
                </a>
            </span>
        ';
    },

    /**
     * HOOKS - набор функций-замыканий, которые вызываются в некоторых местах кода модуля словарей, для выполнения нужных действий.
     */
    'hooks' => array(

        /**
         * Вызывается в методе index, перед выводом данных в представление (вьюшку).
         * На этом этапе уже известны все элементы, которые будут отображены на странице.
         */
        'before_index_view' => function ($dic, $dicvals) {
            /**
             * Предзагружаем нужные словари
             */
            $dics_slugs = array(
                'menu_goods',
            );
            $dics = Dic::whereIn('slug', $dics_slugs)->get();
            $dics = Dic::modifyKeys($dics, 'slug');
            #Helper::tad($dics);
            Config::set('temp.index_dics', $dics);

            /**
             * Создаем списки из полученных данных
             */
            $dic_ids = Dic::makeLists($dics, false, 'id');
            #Helper::dd($dic_ids);
            $dicval_ids = Dic::makeLists($dicvals, false, 'id');
            #Helper::dd($dicval_ids);

            /**
             * Получаем количество необходимых нам данных, одним SQL-запросом.
             * Сохраняем данные в конфиг - для дальнейшего использования в функции-замыкании actions (см. выше).
             */
            $counts = array();
            if (count($dic_ids) && count($dicval_ids))
                $counts = DicVal::counts_by_fields($dic_ids, array('category_id' => $dicval_ids));
            #Helper::dd($counts);
            Config::set('temp.index_counts', $counts);
        },
    ),

    'seo' => 0,

    'versions' => 0,
);