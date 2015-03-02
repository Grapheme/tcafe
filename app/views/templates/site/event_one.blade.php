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
            <div class="left">Страница</div>
            <div class="icon"><img src="{{ Config::get('site.theme_path') }}/images/ico-mic-white.svg"></div>
            <div class="right">мероприятия</div>
        </div>
    </div>
@stop


@section('content')

    <div class="content w974">
        <div class="holder">
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
                <img src="{{ $event->image_id->full() }}"/>
            @endif
            {{ $event->full_description }}
        </div>
    </div>

@stop


@section('scripts')
@stop