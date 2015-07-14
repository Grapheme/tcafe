<?
/**
 * TITLE: Страница одного спец. предложения
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
<?
$seo = $special->seo;

## Все кафе
$cafes = Dic::valuesBySlug('cafe');
$cafes = DicVal::extracts($cafes, null, true, true);
?>
@extends(Helper::layout())


@section('page_class')about common special @stop


@section('style')
@stop


@section('title-wrapper')
    <div class="title-holder">
        <div class="title">
            <div class="left">Специальное</div>
            <div class="icon"><img src="{{ Config::get('site.theme_path') }}/images/ico-wow.svg"></div>
            <div class="right">предложение</div>
        </div>
    </div>
@stop


@section('content')

    <div class="content w974">
        <div class="holder">
            <a href="/specials/" class="back-cross">
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

            @if (count($special->cafe_id))
                @if (count($special->cafe_id) == count($cafes))
                    <div class="where">
                        Вся сеть
                    </div>
                @else
                    @foreach ($special->cafe_id as $cafe_id)
                        <?
                        $cafe = $cafe_id->toArray();
                        ?>
                        <div class="where">
                            {{ $cafe['name'] }}
                        </div>
                    @endforeach
                @endif
            @endif

            <h1>{{ $special->name  }}</h1>
            @if (is_object($special->image_id))
                <img src="{{ $special->image_id->full() }}"/>
            @endif
            <br/>
            {{ $special->full_description ? $special->full_description : $special->description }}
        </div>
    </div>

@stop


@section('scripts')
@stop