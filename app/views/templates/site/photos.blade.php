<?
/**
 * TITLE: Фотогалерея
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
<?
$photoalbums = Dic::valuesBySlug('photoalbums', function($query){
    $query->orderBy('created_at', 'DESC');
});
$photoalbums = DicVal::extracts($photoalbums, null, true, true);
$photoalbums = DicLib::loadGallery($photoalbums, 'gallery_id');
#Helper::tad($photoalbums);
?>
@extends(Helper::layout())


@section('page_class')photos @stop


@section('style')
@stop


@section('title-wrapper')
    <div class="title-holder">
        <div class="title">
            <div class="left">Фото</div>
            <div class="icon"><img src="{{ Config::get('site.theme_path') }}/images/ico-photos.svg"></div>
            <div class="right">кадры</div>
        </div>
    </div>
@stop


@section('content')

    <div class="popup-slider-wrapper">
        <div class="close"></div>
        <div class="bar"></div>
        <div class="center">
            <div class="close">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" preserveaspectratio="none" x="0px" y="0px" width="120px" height="100px" viewbox="0 0 120 100">
                    <defs>
                        <g id="Layer0_0_FILL">
                            <path fill="" stroke="none" d=" M 107 6.95 L 104.4 4.35 60.9 47.95 17.35 4.35 14.75 6.95 58.1 50.3 14.75 93.65 17.35 96.25 60.9 52.75 104.4 96.25 107 93.65 63.65 50.3 107 6.95 Z"></path>
                        </g>
                    </defs>
                    <g transform="matrix( 1, 0, 0, 1, 0,0) ">
                        <use xlink:href="#Layer0_0_FILL"></use>
                    </g>
                </svg>
            </div>
            <div class="prev">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" preserveaspectratio="none" x="0px" y="0px" width="60px" height="100px" viewbox="0 0 60 100">
                    <defs>
                        <g id="Layer0_0_FILL">
                            <path stroke="none" d=" M 54.1 6.95 L 51.5 4.35 5.6 50.3 5.6 50.35 51.5 96.25 54.1 93.65 10.75 50.3 54.1 6.95 Z"></path>
                        </g>
                    </defs>
                    <g transform="matrix( 1, 0, 0, 1, 0,0) ">
                        <use xlink:href="#Layer0_0_FILL"></use>
                    </g>
                </svg>
            </div>
            <div class="next">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" preserveaspectratio="none" x="0px" y="0px" width="60px" height="100px" viewbox="0 0 60 100">
                    <defs>
                        <g id="Layer0_0_FILL">
                            <path stroke="none" d=" M 54.1 6.95 L 51.5 4.35 5.6 50.3 5.6 50.35 51.5 96.25 54.1 93.65 10.75 50.3 54.1 6.95 Z"></path>
                        </g>
                    </defs>
                    <g transform="matrix( 1, 0, 0, 1, 0,0) ">
                        <use xlink:href="#Layer0_0_FILL"></use>
                    </g>
                </svg>
            </div>
            <div class="holder">
                <div class="visual"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
            <div class="thumbs-wrapper">
                <div class="frame"></div>
                <div class="thumbs">
                    <div class="holder">
                        <div class="clrfx"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/video-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title video"></div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/video-2.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title video"></div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div style="background-image: url('http://dummyimage.com/1000x1000')" data-json="json/photo-1.json" class="unit">
            <div class="hover">
                <div class="bar"></div>
                <div class="title">Мастер класс по выпечке русских блинов</div>
            </div>
        </div>
        <div class="clrfx"></div>
    </div>


@stop


@section('footer')
@show


@section('scripts')
@stop