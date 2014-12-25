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
        });
    }


    /****************************************************************************/


	public function __construct(){
        #
	}


    public function getAppMainPage() {

        $cafes = Dic::valuesBySlug('cafe');
        Helper::tad($cafes);
    }

    public function getCafe($cafe) {

        Helper::tad($cafe);
    }

}