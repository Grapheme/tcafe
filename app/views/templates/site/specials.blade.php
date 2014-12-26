<?
/**
 * TITLE: Акции
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
<?
$specials = Dic::valuesBySlug('actions', function($query){
    #$query->orderBy('created_at', 'DESC');
});
$specials = DicVal::extracts($specials, null, true, true);
$specials = DicLib::loadImages($specials, 'image_id');
#Helper::tad($specials);
$specials_chunk = array_chunk($specials->toArray(), 2);
#Helper::tad($specials_chunk);
?>
@extends(Helper::layout())


@section('page_class')specials @stop


@section('style')
@stop


@section('title-wrapper')
    <div class="title-holder">
        <div class="title">
            <div class="left">Специальные</div>
            <div class="icon"><img src="{{ Config::get('site.theme_path') }}/images/ico-wow.svg"></div>
            <div class="right">предложения</div>
        </div>
    </div>
@stop


@section('content')

    <div class="content w860">
        <div class="holder">

            @if (count($specials_chunk))

                @foreach ($specials_chunk as $special_chunk)

                    <div class="col">

                        @foreach ($special_chunk as $special_chunk_one)
                            <?
                            $special = $specials[$special_chunk_one['id']];
                            #Helper::tad($special);
                            ?>
                            <div class="unit">
                                @if (is_object($special->image_id))
                                    <img src="{{ $special->image_id->full() }}" class="visual">
                                @endif
                                <div class="title">{{ $special->name }}</div>
                                <div class="description">
                                    {{ $special->description }}
                                </div>
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
                            </div>

                        @endforeach

                    </div>

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