<?
/**
 * TITLE: Страница одного кафе
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
@extends(Helper::layout())


@section('page_class')index redstreet @stop


@section('page_style') @if(is_object($current_cafe->image_id)) background-image: url({{ $current_cafe->image_id->full() }}); @endif; @stop


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
                            @if ($cafe->slug == $current_cafe->slug)
                                <a href="{{ URL::route('app.mainpage') }}" class="link">
                                    <nobr>Сеть кафе</nobr>
                                </a>
                            @else
                                <a href="{{ URL::route('app.cafe', $cafe->slug) }}" class="link">
                                    <nobr>{{ $cafe->name }}</nobr>
                                    @if ($c == 0)
                                    <nobr>НА {{ $cafe->address2 }}</nobr>
                                    @endif
                                </a>
                            @endif
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
                            @if ($cafe->slug == $current_cafe->slug)
                                <a href="{{ URL::route('app.mainpage') }}" class="link">
                                    <nobr>Сеть кафе</nobr>
                                </a>
                            @else
                                <a href="{{ URL::route('app.cafe', $cafe->slug) }}" class="link">
                                    <nobr>{{ $cafe->name }}</nobr>
                                </a>
                            @endif
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
                {{ $current_cafe->fullname }}
            </div>
        </div>
    </div>
    <div class="content w850px">
        <div class="rest-nav">
            <div class="unit-wrapper">
                @if (is_object($measure) && $measure->id)
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
                @endif
            </div>

            <div class="unit-wrapper">
                @if (isset($dish) && is_object($dish) && $dish->id && FALSE)
                <?
                $image = $dish->image_id;
                ?>
                <div class="unit" data-type="menu">
                    <div class="icon"><img src="{{ Config::get('site.theme_path') }}/images/ico-new.svg"></div>
                    <div class="head-title-wrapper">
                        <div class="title">Новинка меню</div>
                    </div>
                    <a href="{{ URL::route('page', ['menu', 'cafe' => $current_cafe->slug]) }}" class="link">{{-- , 'cat' => $menu[$dish->category_id]->slug --}}
                        @if (is_object($image) && $image->id)
                            <div style="background-image: url('{{ $image->full() }}')" class="visual"></div>
                        @endif
                        <div class="title">{{ $dish->name }}</div>
                    </a>
                </div>
                @endif
            </div>

            <div class="unit-wrapper">
                @if (is_object($actions) && $actions->count())
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
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
            
            <div class="unit-wrapper">
                <div class="unit">
                    <div class="icon"></div>
                    <div class="head-title-wrapper">
                        <div class="title">Коротко о главном</div>
                    </div>
                    <a href="{{ URL::route('page', 'contacts') }}#{{ $current_cafe->slug }}" class="link">
                        <div class="address">
                            <div class="wrapper">
                                <div class="title-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" preserveaspectratio="none" x="0px" y="0px" width="35px" height="50px" viewbox="0 0 35 50">
                                        <defs>
                                            <g id="Layer4_0_FILL">
                                                <path fill="" stroke="none" d=" M 234 171.6 Q 235.05 173.95 236.65 176.05 L 256.25 208.95 256.5 209.9 276.95 175.65 Q 278.25 173.85 279.15 171.9 281.35 167.25 281.35 161.65 281.35 151.5 274.1 144.4 266.85 137.25 256.65 137.25 246.4 137.25 239.15 144.4 231.95 151.5 231.95 161.65 231.95 167.05 234 171.6 M 257 176.8 Q 250.9 176.8 246.55 172.5 242.3 168.2 242.3 162.1 242.3 155.95 246.55 151.65 250.9 147.35 257 147.35 263.15 147.35 267.4 151.65 271.75 155.95 271.75 162.1 271.75 168.2 267.4 172.5 263.15 176.8 257 176.8 Z"></path>
                                            </g>
                                            <g id="Layer3_0_FILL">
                                                <path fill="" stroke="none" d=" M 24.45 13.9 L 21.35 13.9 21.35 16.15 24.45 16.15 24.45 13.9 Z"></path>
                                            </g>
                                            <g id="Layer2_0_FILL">
                                                <path fill="" stroke="none" d=" M 32.5 24.15 Q 34 21.05 34 17.3 34 10.55 29.15 5.8 24.3 1 17.5 1 10.65 1 5.8 5.8 1 10.55 1 17.3 1 20.9 2.35 23.95 3.05 25.55 4.1 26.95 L 17.2 48.9 31.05 26.65 Q 31.9 25.45 32.5 24.15 M 26.6 15.4 L 24.45 15.4 24.45 13.9 19.05 13.9 19.05 24.7 21.05 24.7 21.05 26.55 14.4 26.55 14.4 24.7 16.3 24.7 16.3 13.9 11.15 13.9 11.15 15.4 8.95 15.4 8.95 11.15 26.6 11.15 26.6 15.4 Z"></path>
                                            </g>
                                        </defs>
                                        <g transform="matrix( 1, 0, 0, 1, 0,0) ">
                                            <use xlink:href="#Layer4_0_FILL"></use>
                                        </g>
                                        <g transform="matrix( 1, 0, 0, 1, 0,0) ">
                                            <use xlink:href="#Layer3_0_FILL"></use>
                                        </g>
                                        <g transform="matrix( 1, 0, 0, 1, 0,0) ">
                                            <use xlink:href="#Layer2_0_FILL"></use>
                                        </g>
                                    </svg>
                                    <div class="title">{{ $current_cafe->address1  }}</div>
                                </div>
                                <div class="text">
                                    {{ $current_cafe->info  }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

@stop


@section('scripts')
@stop