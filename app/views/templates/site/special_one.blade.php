<?
/**
 * TITLE: Страница одного спец. предложения
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
<?
$seo = $special->seo;
?>
@extends(Helper::layout())


@section('page_class')about common @stop


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
            <h1>{{ $special->name  }}</h1>
            @if (is_object($special->image_id))
                <img src="{{ $special->image_id->full() }}"/>
            @endif
            <br/>
            {{ $special->description }}
        </div>
    </div>

@stop


@section('scripts')
@stop