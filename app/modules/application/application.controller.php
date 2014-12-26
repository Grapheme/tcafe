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

            Route::any('/ajax/send-review', array('as' => 'app.ajaxSendReview', 'uses' => __CLASS__.'@ajaxSendReview'));
            Route::any('/ajax/send-message', array('as' => 'app.ajaxSendMessage', 'uses' => __CLASS__.'@ajaxSendMessage'));
        });

        $monthes = array("Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря");
        View::share('monthes', $monthes);
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


    public function ajaxSendReview() {

        $name = Input::get('name');
        $email = Input::get('email');
        $review = Input::get('review');

        $dicval = DicVal::inject('reviews', array(
            'slug' => NULL,
            'name' => $name,
            'fields' => array(
                'email' => $email,
                'active' => 1,
            ),
            'textfields' => array(
                'review' => $review,
            ),
        ));

        return '1';
    }

    public function ajaxSendMessage() {

        $name = Input::get('name');
        $email = Input::get('email');
        $text = Input::get('text');

        $json_request = array('status' => FALSE, 'responseText' => '');

        /**
         * Более-менее стандартный функционал для отправки сообщения на e-mail
         */
        $data = Input::all();
        Mail::send('emails.feedback', $data, function ($message) use ($data) {

            #$message->from(Config::get('mail.from.address'), Config::get('mail.from.name'));

            /**
             * Данные (адрес и имя) для отправки сообщения, берутся из словаря Опции
             */
            #/*
            $from_email = Dic::valueBySlugs('options', 'from_email');
            $from_email = is_object($from_email) && $from_email->name ? $from_email->name : (Config::get('mail.from.address') ?: 'no@reply.ru');
            $from_name = Dic::valueBySlugs('options', 'from_name');
            $from_name = is_object($from_name) && $from_name->name ? $from_name->name : (Config::get('mail.from.name') ?: 'No-reply');
            #*/

            /**
             * Адрес, на который будет отправлено письмо, берется из словаря Опции
             */
            $email = Dic::valueBySlugs('options', 'email');
            $email = is_object($email) && $email->name ? $email->name : (Config::get('mail.feedback.address') ?: 'dev@null.ru');

            /**
             * Если в адресе есть запятая - значит нужно отправить копию на все адреса
             */
            $ccs = array();
            if (strpos($email, ',')) {
                $ccs = explode(',', $email);
                foreach ($ccs as $e => $email)
                    $ccs[$e] = trim($email);
                $email = array_shift($ccs);
            }

            $message->from($from_email, $from_name);
            $message->subject('Т-кафе: сообщение обратной связи - ' . @$data['name']);
            $message->to($email);

            if (isset($ccs) && is_array($ccs) && count($ccs))
                foreach ($ccs as $cc)
                    $message->cc($cc);
        });

        $json_request['status'] = TRUE;
        #$json_request['responseText'] = Input::all();

        return Response::json($json_request, 200);

        return '1';
    }

}