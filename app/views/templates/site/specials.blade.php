<?
/**
 * TITLE: Акции
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
<?
$specials = Dic::valuesBySlug('actions', function($query){
    #$query->orderBy('created_at', 'DESC');
    $query->orderBy('lft', 'ASC');
});
$specials = DicVal::extracts($specials, null, true, true);
$specials = DicLib::loadImages($specials, 'image_id');
#Helper::tad($specials);
$specials_chunk = Helper::partition($specials->toArray(), 3);
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
                            <a href="{{ URL::route('app.special', $special->id) }}" class="unit">
                                @if (is_object($special->image_id))
                                    <div style="background-image:url('{{ $special->image_id->full() }}')" class="visual"></div>
                                @endif
                                <div class="title">
                                    {{ $special->name }}
                                </div>
                                <div class="description">
                                    {{ $special->description }}
                                </div>
                                    @if (count($special->cafe_id))
                                        @foreach ($special->cafe_id as $cafe_id)
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