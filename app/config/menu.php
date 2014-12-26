<?php

return array(

    'functions' => array(

        /*
        'mainpage' => function() {
            return array(
                'url' => URL::route('app.mainpage'),
                'text' => 'Главная страница',
                'type' => 'link',
            );
        },
        */

        'allcafe' => function() {

            $return = array(
                'text' => 'Ссылки на все кафе',
            );

            $cafes = Dic::valuesBySlug('cafe');
            $cafes = DicVal::extracts($cafes, null, true, true);

            if (count($cafes)) {
                foreach ($cafes as $cafe) {
                    $return[] = array(
                        'url' => URL::route('app.cafe', $cafe->slug),
                        'text' => $cafe->name,
                        'type' => 'link',
                    );
                }
            }

            return $return;
        }

    ),

	'default' => function($params = array()) {

        return array(

            'active_class' => 'active',

            'tpl' => array(
                'container' => '<ul>%elements%</ul>',
                'element_container' => '<li%attr%>%element%</li>',
                'element' => '<a href="%url%"%attr%>%text%</a>',
            ),

            'elements' => array(

                array(
                    '_route' => 'page',
                    '_params' => 'about',
                    '_text' => 'Об ателье'
                ),
                array(
                    '_route' => 'page',
                    '_params' => 'service',
                    '_text' => 'Услуги'
                ),
                array(
                    '_route' => 'page',
                    '_params' => 'examples',
                    '_text' => 'Примеры работ'
                ),
                array(
                    '_route' => 'page',
                    '_params' => 'advice',
                    '_text' => 'Советы стилиста'
                ),
                array(
                    '_route' => 'page',
                    '_params' => 'newslist',
                    '_text' => 'Новости'
                ),
                array(
                    '_route' => 'page',
                    '_params' => 'contacts',
                    '_text' => 'Контакты'
                ),

                /*
                array(
                    '_raw' => '123123123',
                    '_container_attributes' => array(
                        'class' => 'normal_li'
                    ),
                ),
                array(
                    '_href' => 'http://ya.ru',
                    '_text' => 'Яндекс',
                    'target' => '_blank',
                ),
                */
            ),
        );
    }

);
