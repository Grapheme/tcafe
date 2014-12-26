<?php

class ApplicationController extends BaseController {

    public static $name = 'application';
    public static $group = 'application';

    /****************************************************************************/

    ## Routing rules of module
    public static function returnRoutes($prefix = null) {

        Route::group(array(), function() {

            Route::get('/', array('as' => 'app.mainpage', 'uses' => __CLASS__.'@getAppMainPage'));
            Route::get('/cafe/{cafe}', array('as' => 'app.cafe', 'uses' => __CLASS__.'@getCafe'));
            Route::get('/ajax/json-photoalbum-{id}', array('as' => 'app.ajaxJsonPhotoalbum', 'uses' => __CLASS__.'@ajaxJsonPhotoalbum'));
        });
    }

    /****************************************************************************/


	public function __construct(){
        #
	}


    public function getAppMainPage() {

        /**
         * Все кафе
         */
        $cafes = Dic::valuesBySlug('cafe');
        $cafes = DicVal::extracts($cafes, null, true, true);
        #Helper::ta($cafes);

        /**
         * Делим на два
         */
        $cafes_chunk = array();
        if (count($cafes)) {
            $cafes_chunk = array_chunk($cafes->toArray(), ceil(count($cafes)/2));
        }
        #Helper::tad($cafes_chunk);

        /**
         * Мероприятие, Новинка меню, Акция недели
         */

        return View::make(Helper::layout('index'), compact('cafes', 'cafes_chunk', 'measure', 'new_menu', 'action'));
    }

    public function getCafe($cafe_slug) {

        $current_cafe = Dic::valueBySlugs('cafe', $cafe_slug);
        if (!is_object($current_cafe) || !$current_cafe->id)
            App::abort(404);

        $current_cafe->extract(true);
        DicLib::loadImages($current_cafe, ['image_id']);
        #Helper::tad($current_cafe);

        /**
         * Все кафе
         */
        $cafes = Dic::valuesBySlug('cafe');
        $cafes = DicVal::extracts($cafes, null, true, true);
        #Helper::ta($cafes);

        /**
         * Делим на два
         */
        $cafes_chunk = array();
        if (count($cafes)) {
            $cafes_chunk = array_chunk($cafes->toArray(), ceil(count($cafes)/2));
        }
        #Helper::tad($cafes_chunk);



        return View::make(Helper::layout('cafe'), compact('current_cafe', 'cafes', 'cafes_chunk'));
    }


    public function ajaxJsonPhotoalbum($id) {

        $photoalbum = Dic::valueBySlugAndId('photoalbums', $id);
        if (!is_object($photoalbum) || !$photoalbum->id)
            App::abort(404);

        $photoalbum->extract(true);
        $photoalbum = DicLib::loadImages($photoalbum, 'image_id');
        #Helper::tad($photoalbum);

        if ($photoalbum->video_link) {

            $json_request = array(
                "type" => "video",
                "poster" => is_object($photoalbum->image_id) ? $photoalbum->image_id->full() : '',
                "video" => $photoalbum->video_link
            );
        } else {

            $photoalbum = DicLib::loadGallery($photoalbum, 'gallery_id');

            #Helper::tad($photoalbum);

            $temp = array();
            if (is_object($photoalbum->gallery_id) && is_object($photoalbum->gallery_id->photos) && count($photoalbum->gallery_id->photos)) {

                foreach ($photoalbum->gallery_id->photos as $photo) {

                    if (!is_object($photo))
                        continue;

                    $temp[] = array(
                        "img" => $photo->full(),
                        "thumb" => $photo->thumb(),
                        "title" => $photoalbum->name
                    );
                }
            }

            $json_request = array(
                "type" => "photo",
                "photo-list" => $temp
            );

        }

        return Response::json($json_request, 200);
    }

}