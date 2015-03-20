<?
/**
 * TITLE: Страница одного мероприятия
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
<?
$status = Input::get('show') == 'archive' ? 'archive' : 'active';
?>
@extends(Helper::layout())


@section('page_class')afisha common @stop


@section('style')
@stop


@section('title-wrapper')
    <div class="title-holder">
        <div class="title">
            <div class="left">Афиша</div>
            <div class="icon"><img src="{{ Config::get('site.theme_path') }}/images/ico-mic-white.svg"></div>
            <div class="right">событий</div>
        </div>
    </div>
@stop


@section('content')

    <div class="content w974">
        <div class="holder">
            <a href="/afisha/" class="back-cross">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" preserveAspectRatio="none" x="0px" y="0px" width="120px" height="100px" viewBox="0 0 120 100">
                    <defs>
                        <g id="Layer0_0_FILL">
                            <path fill="" stroke="none" d=" M 107 6.95 L 104.4 4.35 60.9 47.95 17.35 4.35 14.75 6.95 58.1 50.3 14.75 93.65 17.35 96.25 60.9 52.75 104.4 96.25 107 93.65 63.65 50.3 107 6.95 Z"></path>
                        </g>
                    </defs>
                    <g transform="matrix( 1, 0, 0, 1, 0,0) ">
                        <use xlink:href="#Layer0_0_FILL"></use>
                    </g>
                </svg>
            </a>
            <div class="where">
                @if (count($event->cafe_id) > 1)
                    Вся сеть
                @elseif (count($event->cafe_id) == 1)
                    <?
                    $cafe = $event->cafe_id->toArray();
                    $cafe = array_shift($cafe);
                    #Helper::ta($cafe);
                    ?>
                    {{ $cafe['name'] }}
                @endif
            </div>
            <h1>{{ $event->name }}</h1>
            <div class="info">

                <?
                $md = (new \Carbon\Carbon())->createFromFormat('Y-m-d', $event->measure_date);
                ?>
                {{ mb_strtolower($md->formatLocalized('%d')) }}
                {{ @mb_strtolower($monthes[$md->formatLocalized('%m')-1]) }}

                @if ($event->measure_time)
                    | {{ $event->measure_time }}
                @endif

                @if ($event->photoalbum_id)
                    <a href="{{ URL::route('page', 'photos') }}{{ $event->photoalbum_id ? '#gallery-' . $event->photoalbum_id : '' }}">
                        <div class="photo"></div>
                    </a>
                @endif
                @if ($event->measure_age_limit && $status == 'active')
                    <div class="age">{{ $event->measure_age_limit }}</div>
                @endif
            </div>
            <br/>
            @if (is_object($event->image_id))
                <img src="{{ $event->image_id->full() }}" style="width: 100%;"/>
            @endif
            {{ $event->full_description }}
        </div>
    </div>

@stop


@section('scripts')
@stop