<?
dd($page);
/**
 * TITLE: О сети кафе
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
@extends(Helper::layout())


@section('page_class')about @stop


@section('style')
@stop


@section('title-wrapper')
    <div class="title-holder">
        <div class="title">
            <div class="left">О сети</div>
            <div class="icon"><img src="images/ico-cup.svg"></div>
            <div class="right">кафе</div>
        </div>
    </div>
@stop


@section('content')

    <div class="content w974">
        <div class="holder">

            {{ count($page->blocks) }}

            <div class="unit">
                <div class="icon"><img src="images/ico-cutlery.svg"></div>
                <div class="title">
                    <div class="holder">Наша сеть</div>
                </div>
                <div class="text">
                    <p>
                        За&nbsp;основу приготовления блюд повар взял
                        самые лучшие техники, поварские секреты
                        европейской кухни и&nbsp;дополнил их&nbsp;
                        интернациональными мотивами.
                    </p>
                </div>
            </div>
            <div class="unit">
                <div class="icon"><img src="images/ico-wine.svg"></div>
                <div class="title">
                    <div class="holder">Проведение банкетов</div>
                </div>
                <div class="text">
                    <p>
                        Вашим малышам не&nbsp;будет скучно: стульчики,
                        раскраски, карандаши, любимые мультфильмы
                        и&nbsp;специальное детское меню&nbsp;&mdash; все для услады
                        маленьких гурманов.
                    </p>
                </div>
            </div>
            <div class="unit">
                <div class="icon"><img src="images/ico-baloons.svg"></div>
                <div class="title">
                    <div class="holder">Проведение банкетов</div>
                </div>
                <div class="text">
                    <p>
                        Мы&nbsp;рады предложить Вам полный комплекс
                        работ по&nbsp;организации и&nbsp;проведению
                        праздничных и&nbsp;деловых мероприятий
                        в&nbsp;<nobr>Ростове-на-Дону</nobr>.
                    </p>
                </div>
            </div>
            <div class="unit">
                <div class="icon"><img src="images/ico-chief_hat.svg"></div>
                <div class="title">
                    <div class="holder">Вакансии</div>
                </div>
                <div class="text">
                    <p><a href="">Администратор в кафе на Красной</a></p>
                    <p><a href="">Официант на Набережную реки Кубани</a></p>
                    <p><a href="">Уборщица на Пушкина, 18</a></p>
                </div>
            </div>
            <div class="unit large">
                <div class="icon"><img src="images/ico-chief_hat.svg"></div>
                <div class="title">
                    <div class="holder">Вакансии</div>
                </div>
                <div class="text">
                    <p><a href="">Администратор в кафе на Красной</a></p>
                    <p><a href="">Официант на Набережную реки Кубани</a></p>
                    <p><a href="">Уборщица на Пушкина, 18</a></p>
                </div>
            </div>
            <div class="clrfx"></div>
        </div>
    </div>


@stop


@section('scripts')
@stop