<?
/**
 * TITLE: Афиша
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
<?
$status = Input::get('show') == 'archive' ? 'archive' : 'active';
$measures = Dic::valuesBySlug('measure', function($query) use ($status) {
    if ($status == 'active') {
        $query->filter_by_field('measure_date', '>', date('Y-m-d'));
        $query->filter_by_field('measure_time', '>', date('H:i'));
    } else {
        $query->filter_by_field('measure_date', '<=', date('Y-m-d'));
        $query->filter_by_field('measure_time', '<=', date('H:i'));
    }
});
#Helper::tad($measures);
$measures = DicVal::extracts($measures, null, true, true);
$measures = DicLib::loadImages($measures, 'image_id');
#Helper::tad($measures);

#setlocale(LC_TIME, 'ru_RU.CP1251', 'ru_RU','rus_RUS','Russian');
?>
@extends(Helper::layout())


@section('page_class')afisha @stop


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

    <div class="content w860">
        <div class="top-btns">
            <div class="bar"></div><a href="{{ URL::route('page', 'afisha') }}"{{ $status == 'active'  ? ' class="active"' : '' }}>Предстоящие</a>
            <div class="bar"></div><a href="{{ URL::route('page', 'afisha') }}?show=archive"{{ $status == 'archive' ? ' class="active"' : '' }}>Архив и фото</a>
            <div class="bar"></div>
        </div>
        <div class="holder">

            @if (is_object($measures) && count($measures)))
                @foreach ($measures as $measure)
                    <a href="{{ URL::route('page', 'photos') }}{{ $measure->photoalbum_id ? '#gallery-' . $measure->photoalbum_id : '' }}" class="unit">
                        @if (is_object($measure->image_id))
                            <img src="{{ $measure->image_id->full() }}" class="visual">
                        @endif
                        <div class="info">

                            <?
                            $md = (new \Carbon\Carbon())->createFromFormat('Y-m-d', $measure->measure_date);
                            ?>
                            {{ mb_strtolower($md->formatLocalized('%d')) }}
                            {{ @mb_strtolower($monthes[$md->formatLocalized('%m')-1]) }}

                            @if ($measure->measure_time)
                                | {{ $measure->measure_time }}
                            @endif
                            @if ($measure->photoalbum_id && $status == 'archive')
                                <div class="photo"></div>
                            @endif
                            @if ($measure->measure_age_limit && $status == 'active')
                                <div class="age">{{ $measure->measure_age_limit }}</div>
                            @endif
                        </div>
                        <div class="title">{{ $measure->name }}</div>
                        <div class="where">
                            @if (count($special->cafe_id) > 1)
                                Вся сеть
                            @elseif (count($special->cafe_id) == 1)
                                <?
                                $cafe = $special->cafe_id->toArray();
                                $cafe = array_shift($cafe);
                                #Helper::ta($cafe);
                                ?>
                                {{ $cafe['name'] }}
                            @endif
                        </div>
                    </a>
                @endforeach
            @else
                <h1>Нет событий</h1>
            @endif
            <div class="clrfx"></div>
        </div>
    </div>

@stop


@section('scripts')
@stop