<?
/**
 * TITLE: Контакты
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
<?
/**
 * Все кафе
 */
$cafes = Dic::valuesBySlug('cafe');
$cafes = DicVal::extracts($cafes, null, true, true);
#Helper::tad($cafes);
$json = array();
if (count($cafes)) {
    foreach ($cafes as $cafe) {
        $json[] = array(
            "latitude" => $cafe->cafe_lat,
            "longitude" => $cafe->cafe_lng,
            "title" => $cafe->name,
            "slug" => $cafe->slug,
            "address" => $cafe->address1,
            "content" => $cafe->info
        );
    }
}
$json = array(
    "markers" => $json
);
?>
@extends(Helper::layout())


@section('page_class')contacts @stop


@section('style')
@stop


@section('title-wrapper')
    <div class="title-holder">
        <div class="title">
            <div class="left">Как нас</div>
            <div class="icon"><img src="{{ Config::get('site.theme_path') }}/images/ico-map-dots.svg"></div>
            <div class="right">найти</div>
        </div>
    </div>
@stop


@section('content')

    <div class="content w874">
        <div class="top-btns">
            <div class="bar"></div>
        </div>
    </div>
    <div class="contacts-map"></div>
    <div class="content w874">
        <div class="holder">
            <div class="col">
                <div class="unit texted">
                    <div class="icon"><img src="{{ Config::get('site.theme_path') }}/images/ico-people.svg"></div>
                    <div class="title">
                        <div class="holder">Сотрудничество</div>
                    </div>
                    <div class="text">
                        <p></p>
                        {{ $page->block('cooperation') }}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="unit form-holder">
                    <div class="final">
                        <div class="bar"></div>
                        <div class="text">Спасибо! <br> Ваше сообщение отправлено.</div>
                    </div>
                    <center>
                        <div class="icon"><img src="{{ Config::get('site.theme_path') }}/images/ico-letter.svg"></div>
                        <div class="title">
                            <div class="holder">Сотрудничество</div>
                        </div>
                    </center>
                    <form novalidate="novalidate" action="{{ URL::route('app.ajaxSendMessage') }}" class="contacts-form">
                        <label class="name">
                            <div class="label">Ваше имя:</div>
                            <input name="name">
                        </label>
                        <label class="email">
                            <div class="label">E-mail:</div>
                            <input name="email">
                        </label>
                        <label class="text">
                            <div class="label">Сообщение:</div>
                            <textarea name="text"></textarea>
                        </label>
                        <center>
                            <button type="submit">Отправить</button>
                        </center>
                    </form>
                </div>
            </div>
            <div class="clrfx"></div>
        </div>
    </div>


@stop


@section('scripts')
    <script>
        //_TCAFE_.mapJson = '{"markers":[{"latitude":45.017031,"longitude":38.964304,"title":"На Пушкина","slug":"pushkina27","address":"Пушкина 27","content":"<strong>Режим работы</strong><br>пн-пт: с 12<sup>00</sup> до 00<sup>00</sup><br><strong>Тел.:</strong> (834) 225-75-18"},{"latitude":45.02707292149134,"longitude":38.86372348070145,"title":"На Бульварном","slug":"bulvarniy28","address":"Бульварный 28","content":"<strong>Режим работы</strong><br>пн-пт: с 12<sup>00</sup> до 00<sup>00</sup><br><strong>Тел.:</strong> (834) 225-75-18"}]}';

        _TCAFE_.mapJson = '{{ json_encode($json) }}';

        _TCAFE_.mapJsonNative = {{ json_encode($json) }};
    </script>
@stop