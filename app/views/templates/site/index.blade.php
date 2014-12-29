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
                @if (@count($cafes_chunk[0]))
                    @foreach ($cafes_chunk[0] as $c => $cfch)
                        <?
                        $cafe = @$cafes[$cfch['id']];
                        if (!is_object($cafe))
                            continue;
                        $n = $c ? $c + 2 : $c + 1;
                        ?>
                        <div class="line-{{ $n }} angle-15">
                            <div class="hr-holder">
                                <hr class="first">
                                <hr class="second">
                            </div>
                            <a href="{{ URL::route('app.cafe', $cafe->slug) }}" class="link">
                                {{ $cafe->name_mainpage }}
                            </a>
                        </div>
                        @if ($c == 0)
                        <div class="line-2 angle-15 nolink">
                            <div class="hr-holder">
                                <hr class="first">
                                <hr class="second">
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endif
                <!--.line-4.angle-15-->
            </div>
            <div class="right">


                @if (@count($cafes_chunk[1]))
                    @foreach ($cafes_chunk[1] as $c => $cfch)
                        <?
                        $cafe = @$cafes[$cfch['id']];
                        if (!is_object($cafe))
                            continue;
                        $n = $c ? $c + 2 : $c + 1;
                        ?>
                        <div class="line-{{ $n }} angle-15">
                            <a href="{{ URL::route('app.cafe', $cafe->slug) }}" class="link">
                                <nobr>{{ $cafe->name }}</nobr>
                            </a>
                            <div class="hr-holder">
                                <hr class="first">
                                <hr class="second">
                            </div>
                        </div>
                        @if ($c == 0)
                            <div class="line-2 angle-15 nolink">
                                <div class="hr-holder">
                                    <hr class="first">
                                    <hr class="second">
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif

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