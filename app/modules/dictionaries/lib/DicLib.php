<?php

/**
 * Class DicLib
 * Класс для работы с модулем словарей
 */
class DicLib extends BaseController {
	
	public function __construct(){
		##
	}


    /**
     * В функцию передается коллекция объектов, полученная из Eloguent методом ->get(),
     * а также название поля, значение которого будет установлено в качестве ключа для каждого элемента коллекции.
     *
     * @param object $collection - Eloquent Collection
     * @param string $key
     * @return object
     *
     * @author Alexander Zelensky
     */
    public static function modifyKeys($collection, $key = 'slug') {
        #Helper::tad($collection);
        #$array = array();
        $array = new Collection;
        foreach ($collection as $c => $col) {
            $current_key = is_object($col) ? $col->$key : @$col[$key];
            if (NULL !== $current_key) {
                $array[$current_key] = $col;
            }
        }
        return $array;
    }


    /**
     * С помощью данного метода можно подгрузить изображения (Photo) к элементам коллекции
     * В качестве третьего параметра можно передать название поля элемента коллекции, например связи один-ко-многим.
     *
     * Пример вызова:
     * $specials = DicLib::loadImages($specials, ['special_photo', 'special_plan']);
     *
     * @param $collection
     * @param string $key
     * @param string/null $field
     * @return bool
     */
	public static function loadImages($collection, $key = 'image_id', $field = null){

        if (is_array($key))
            $key = (array)$key;

        if (!count($collection) || !count($key))
            return false;

        $images_ids = array();
        /**
         * Перебираем все объекты в коллекции
         */
        foreach ($collection as $obj) {

            /**
             * Если при вызове указано поле (связь) - берем ее вместо текущего объекта
             */
            $work_obj = $field ? $obj->$field : $obj;

            /**
             * Перебираем все переданные ключи с ID изображений
             */
            foreach ($key as $attr)
                if (is_numeric($work_obj->$attr)) {

                    /**
                     * Собираем ID изображений - в общий список и в список с разбиением по ключу
                     */
                    $images_ids_attr[$attr][] = $work_obj->$attr;
                    $images_ids[] = $work_obj->$attr;
                }
        }
        #Helper::dd($images_ids);
        #Helper::d($images_ids_attr);


        $images = [];
        if (count($images_ids)) {

            $images = Photo::whereIn('id', $images_ids)->get();
            $images = self::modifyKeys($images, 'id');
            #Helper::tad($images);
        }


        if (count($images)) {

            /**
             * Перебираем все объекты в коллекции
             */
            foreach ($collection as $o => $obj) {

                /**
                 * Если при вызове указано поле (связь) - берем ее вместо текущего объекта
                 */
                $work_obj = $field ? $obj->$field : $obj;

                /**
                 * Перебираем все переданные ключи с ID изображений
                 */
                foreach ($key as $attr)
                    if (is_numeric($work_obj->$attr)) {

                        if (@$images[$work_obj->$attr]) {

                            $tmp = $work_obj->$attr;
                            $image = $images[$tmp];

                            $work_obj->setAttribute($attr, $image);
                        }
                    }

                if ($field) {
                    $obj->$field = $work_obj;
                }

                $collection->put($o, $obj);
            }
        }

        return $collection;

    }


}