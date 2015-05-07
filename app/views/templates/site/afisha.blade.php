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
        #$query->filter_by_field('measure_time', '>', date('H:i'));
    } else {
        $query->filter_by_field('measure_date', '<=', date('Y-m-d'));
        #$query->filter_by_field('measure_time', '<=', date('H:i'));
    }
    $query->order_by_field('measure_date', 'DESC');
});
#Helper::smartQueries(1);
#Helper::tad($measures);

if ($status == 'active' && !count($measures)) {
    Redirect(URL::route('page', ['afisha', 'show' => 'archive', 'noactive' => 1]));
}

$measures = DicVal::extracts($measures, null, true, true);
$measures = DicLib::loadImages($measures, 'image_id');
#Helper::tad($measures);

#setlocale(LC_TIME, 'ru_RU.CP1251', 'ru_RU','rus_RUS','Russian');
?>
@extends(Helper::layout())
<?
$bg = Dic::valueBySlugs('options', 'background_afisha');
#Helper::tad($bg);
?>


@section('page_class')afisha @stop


@section('page_style') @if(is_object($bg) && $bg->name) background-image: url({{ $bg->name }}); @endif; @stop


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
            @if (!Input::get('noactive'))
            <div class="bar"></div><a href="{{ URL::route('page', 'afisha') }}"{{ $status == 'active'  ? ' class="active"' : '' }}>Предстоящие</a>
            <div class="bar"></div><a href="{{ URL::route('page', 'afisha') }}?show=archive"{{ $status == 'archive' ? ' class="active"' : '' }}>Архив и фото</a>
            <div class="bar"></div>
            @endif
        </div>
        <div class="holder">

            @if (is_object($measures) && count($measures))
                @foreach ($measures as $measure)
                    @if (0)
                        <?
                        $tag = $measure->photoalbum_id ? 'a' : 'span';
                        ?>
                        <{{ $tag }} href="{{ URL::route('page', 'photos') }}{{ $measure->photoalbum_id ? '#gallery-' . $measure->photoalbum_id : '' }}" class="unit">
                    @endif
                    <a href="{{ URL::route('app.event', $measure->id) }}" class="unit">
                        @if (is_object($measure->image_id))
                            <div style="background-image:url('{{ $measure->image_id->full() }}')" class="visual"></div>
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
                            @if (count($measure->cafe_id))
                                @foreach ($measure->cafe_id as $cafe_id)
                                    <?
                                    $cafe = $cafe_id->toArray();
                                    ?>
                                    <div class="where">
                                        {{ $cafe['name'] }}
                                    </div>
                                @endforeach
                            @endif
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