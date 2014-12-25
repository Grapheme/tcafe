<?
/**
 * TITLE: Главная страница
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
@extends(Helper::layout())


@section('page_class')index @stop


@section('style')
@stop


@section('content')

    <div class="tilt-header">
        <div class="wings">
            <div class="left">
                <div class="line-1 angle-15">
                    <div class="hr-holder">
                        <hr class="first">
                        <hr class="second">
                    </div><a href="redstreet.html" class="link">
                        <nobr>RED STREET</nobr>
                        <nobr>НА КРАСНОЙ, 16</nobr></a>
                </div>
                <div class="line-2 angle-15 nolink">
                    <div class="hr-holder">
                        <hr class="first">
                        <hr class="second">
                    </div>
                </div>
                <div class="line-3 angle-15">
                    <div class="hr-holder">
                        <hr class="first">
                        <hr class="second">
                    </div><a href="" class="link">
                        <nobr>40 лет Победы, 144/5</nobr></a>
                </div>
                <!--.line-4.angle-15-->
            </div>
            <div class="right">
                <div class="line-1 angle-15"><a href="" class="link">
                        <nobr>Красных Партизан, 173</nobr></a>
                    <div class="hr-holder">
                        <hr class="first">
                        <hr class="second">
                    </div>
                </div>
                <div class="line-2 angle-15 nolink">
                    <div class="hr-holder">
                        <hr class="first">
                        <hr class="second">
                    </div>
                </div>
                <div class="line-3 angle-15"><a href="" class="link">
                        <nobr>Тургенева, 138/6</nobr></a>
                    <div class="hr-holder">
                        <hr class="first">
                        <hr class="second">
                    </div>
                </div>
            </div>
        </div>
        <div class="middle-wrapper">
            <div class="middle-holder">
                <div class="first">Сеть</div>
                <div class="second">городских</div>
                <div class="third">кафе</div>
            </div>
        </div>
    </div>
    <div class="content w850px">
        <div class="rest-nav">
            <div class="unit">
                <div class="icon"><img src="{{ Config::get('site.theme_path') }}/images/ico-mic-min.svg"></div>
                <div class="head-title-wrapper">
                    <div class="title">Скоро</div>
                </div><a href="" class="link">
                    <div class="visual"><img src="http://dummyimage.com/440x264"></div>
                    <div class="title">Джазовый концерт
                        <div class="date">13 ноября | Четверг | 20:30</div>
                    </div></a>
            </div>
            <div class="unit">
                <div class="icon"><img src="{{ Config::get('site.theme_path') }}/images/ico-new.svg"></div>
                <div class="head-title-wrapper">
                    <div class="title">Новинка меню</div>
                </div><a href="" class="link">
                    <div class="visual"><img src="http://dummyimage.com/440x264"></div>
                    <div class="title">Суп с блинами и фасолью</div></a>
            </div>
            <div class="unit">
                <div class="icon"><img src="{{ Config::get('site.theme_path') }}/images/ico-act.svg"></div>
                <div class="head-title-wrapper">
                    <div class="title">Акция недели</div>
                </div><a href="" class="link">
                    <div class="visual"><img src="http://dummyimage.com/440x264"></div>
                    <div class="title">Сочные крылышки всего за <span class="black">399 .--</span></div></a>
            </div>
        </div>
    </div>

@stop


@section('scripts')
@stop