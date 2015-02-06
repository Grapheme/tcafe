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
                                {{ $cafe->name_mainpage }}
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
        
            @if (is_object($measures) && $measures->count())
            <div class="unit-wrapper">
                @foreach ($measures as $measure)
                    <?
                    $image = $measure->image_id;
                    ?>
                    <div class="unit" data-type="measure">
                        <div class="icon"><img src="{{ Config::get('site.theme_path') }}/images/ico-mic-min.svg"></div>
                        <div class="head-title-wrapper">
                            <div class="title">Скоро</div>
                        </div>
                        <a href="{{ URL::route('page', 'afisha') }}" class="link">
                            @if (is_object($image) && $image->id)
                                <div style="background-image: url('{{ $image->full() }}')" class="visual"></div>
                            @endif
                            <div class="title">
                                {{ $measure->name }}
                                <div class="date">
                                    @if (preg_match('~\d{4}-\d{2}-\d{2}~is', $measure->measure_date))
                                        <?
                                        $md = (new \Carbon\Carbon())->createFromFormat('Y-m-d', $measure->measure_date);
                                        ?>
                                        {{ mb_strtolower($md->formatLocalized('%d')) }}
                                        {{ @mb_strtolower($monthes[$md->formatLocalized('%m')-1]) }}
                                        | {{ $days[$md->formatLocalized('%w')] }}

                                        @if ($measure->measure_time)
                                            | {{ $measure->measure_time }}
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            @endif
            @if (is_object($new_menu) && $new_menu->count())
            <div class="unit-wrapper">
                @foreach ($new_menu as $dish)
                    <?
                    $image = $dish->image_id;
                    ?>
                    <div class="unit" data-type="menu">
                        <div class="icon"><img src="{{ Config::get('site.theme_path') }}/images/ico-new.svg"></div>
                        <div class="head-title-wrapper">
                            <div class="title">Новинка меню</div>
                        </div>
                        <a href="{{ URL::route('page', ['menu']) }}" class="link">{{-- , 'cafe' => $current_cafe->slug, 'cat' => $menu[$dish->category_id]->slug --}}
                            @if (is_object($image) && $image->id)
                                <div style="background-image: url('{{ $image->full() }}')" class="visual"></div>
                            @endif
                            <div class="title">{{ $dish->name }}</div>
                            <div class="info">
                                @if ($dish->price)
                                    <div class="price">{{ $dish->price }}.-</div>
                                @endif
                                @if ($dish->serving)
                                    <div class="weight">{{ $dish->serving }}</div>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            @endif
            
            @if (is_object($actions) && $actions->count())
            <div class="unit-wrapper">
                @foreach ($actions as $action)
                    <?
                    $image = $action->image_id;
                    ?>
                    <div class="unit" data-type="action">
                        <div class="icon"><img src="{{ Config::get('site.theme_path') }}/images/ico-act.svg"></div>
                        <div class="head-title-wrapper">
                            <div class="title">Акция</div>
                        </div>
                        <a href="{{ URL::route('page', ['specials']) }}" class="link">{{-- , 'cafe' => $current_cafe->slug, 'cat' => $menu[$dish->category_id]->slug --}}
                            @if (is_object($image) && $image->id)
                                <div style="background-image: url('{{ $image->full() }}')" class="visual"></div>
                            @endif
                            <div class="title">{{ $action->name }}</div>
                            <div class="where">
                                @if (count($action->cafe_id) > 1)
                                    Вся сеть
                                @elseif (count($action->cafe_id) == 1)
                                    <?
                                    $cafe = $action->cafe_id->toArray();
                                    $cafe = array_shift($cafe);
                                    #Helper::ta($cafe);
                                    ?>
                                    {{ $cafe['name'] }}
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            @endif
                
        </div>
        @if ($page->block('description'))
            <div class="text-block-wrapper">
                <div class="text-block">
                    <div class="title">Коротко о нас</div>
                    <p>{{ $page->block('description') }}</p>
                    <p><a href="{{ URL::route('page', 'about') }}" class="btn">О сети кафе</a></p>
                </div>
            </div>
        @endif
    </div>

@stop


@section('scripts')
@stop