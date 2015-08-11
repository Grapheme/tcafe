<?
/**
 * TITLE: Отзывы
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
<?
$reviews = Dic::valuesBySlug('reviews', function($query){
    $query->orderBy('created_at', 'DESC');
    $query->filter_by_field('active', '=', 1);
});
$reviews = DicVal::extracts($reviews, null, true, true);
#$specials = DicLib::loadImages($specials, 'image_id');
#Helper::tad($specials);
#$specials_chunk = array_chunk($specials->toArray(), 2);
#Helper::tad($reviews);
?>
@extends(Helper::layout())


@section('page_class')reviews @stop


@section('style')
@stop


@section('title-wrapper')
    <div class="title-holder">
        <div class="title">
            <div class="left">Отзывы</div>
            <div class="icon"><img src="{{ Config::get('site.theme_path') }}/images/ico-faq.svg"></div>
            <div class="right">клиентов</div>
        </div>
    </div>
@stop


@section('content')

    <div class="content w840">
        <div class="holder">
            <div class="col">
                <div class="unit form-holder">
                    <div class="final">
                        <div class="bar"></div>
                        <div class="text">Спасибо! <br> Ваш отзыв отправлен.</div>
                    </div>
                    <div class="title-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" preserveaspectratio="none" x="0px" y="0px" width="130px" height="130px" viewbox="0 0 130 130">
                            <defs>
                                <g id="Layer1_0_FILL">
                                    <path fill="" stroke="none" d=" M 127.15 64.5 Q 127.15 38.55 108.8 20.2 90.45 1.85 64.5 1.9 38.55 1.85 20.2 20.2 7.55 32.9 3.65 49.25 1.9 56.5 1.9 64.5 1.9 75.7 5.3 85.5 L 5.3 85.55 Q 9.8 98.4 20.2 108.8 38.55 127.15 64.5 127.15 90.45 127.15 108.8 108.8 127.15 90.45 127.15 64.5 M 102.95 26.05 Q 118.85 41.95 118.9 64.5 118.9 87.05 102.95 102.95 87.05 118.9 64.5 118.9 41.95 118.85 26.05 102.95 17 93.9 13.1 82.8 10.1 74.3 10.15 64.5 10.1 57.5 11.65 51.2 L 11.65 51.15 Q 15.05 37 26.05 26 L 26.05 26.05 Q 41.95 10.15 64.5 10.15 87.05 10.15 102.95 26.05 Z"></path>
                                </g>
                                <g id="Layer0_0_FILL">
                                    <path fill="" stroke="none" d=" M 104 70 L 104 60 70.5 60 70.5 27.5 60.5 27.5 60.5 60 27 60 27 70 60.5 70 60.5 104.5 70.5 104.5 70.5 70 104 70 Z"></path>
                                </g>
                            </defs>
                            <g transform="matrix( 1, 0, 0, 1, 0,0) ">
                                <use xlink:href="#Layer1_0_FILL"></use>
                            </g>
                            <g transform="matrix( 1, 0, 0, 1, 0,0) ">
                                <use xlink:href="#Layer0_0_FILL"></use>
                            </g>
                        </svg>
                        <div class="title">ДОБАВИТЬ ОТЗЫВ <br>ИЛИ ЗАДАТЬ ВОПРОС</div>
                    </div>
                    <form novalidate="novalidate" action="{{ URL::route('app.ajaxSendReview') }}" method="POST" class="review-form">
                        <label class="name">
                            <div class="label">Ваше имя:</div>
                            <input name="name">
                        </label>
                        <label class="email">
                            <div class="label">E-mail:</div>
                            <input name="email">
                        </label>
                        <label class="text">
                            <div class="label">Отзыв:</div>
                            <textarea name="review"></textarea>
                        </label>
                        <center>
                            <button type="submit">Отправить</button>
                        </center>
                    </form>
                </div>

                @if (count($reviews))
                    @foreach ($reviews as $review)
                        <?
                            @++$i;
                        ?>
                        <div class="unit">
                            <div class="q">
                                {{ $review->review }}
                            </div>
                            <div class="user-info">
                                {{ $review->name }},
                                <?
                                $md = (new \Carbon\Carbon())->createFromFormat('Y-m-d H:i:s', $review->created_at);
                                ?>
                                {{ mb_strtolower($md->formatLocalized('%d')) }}
                                {{ @mb_strtolower($monthes[$md->formatLocalized('%m')-1]) }}
                            </div>
                            @if ($review->review_answer)
                            <div class="a">
                                {{ $review->review_answer }}
                            </div>
                            @endif
                        </div>

                    @if (count($reviews) > 1 && ceil(count($reviews)/2) == $i)
                    </div>
                    <div class="col">
                    @endif


                    @endforeach
                @endif

            </div>
            <div class="clrfx"></div>
        </div>
    </div>

@stop


@section('scripts')
@stop