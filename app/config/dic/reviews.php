<?php

return array(

    'fields' => function($dicval = NULL) {

        return array(
            'email' => array(
                'title' => 'E-Mail',
                'type' => 'text',
            ),
            'active' => array(
                'no_label' => true,
                'title' => 'Активно',
                'type' => 'checkbox',
                'label_class' => 'normal_checkbox',
            ),
            'review' => array(
                'title' => 'Текст отзыва',
                'type' => 'textarea',
            ),
            'review_answer' => array(
                'title' => 'Ответ администрации',
                'type' => 'textarea',
            ),

        );
    },


    'seo' => 0,

    'versions' => 0,
);