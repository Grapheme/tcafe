<?
/**
 * TEMPLATE_IS_NOT_SETTABLE
 */
?>

<div class="header">
    <div class="holder"><a href="/" class="logo"><img src="{{ Config::get('site.theme_path') }}/images/logo-index.svg"></a>
        <div class="menu-wrapper">
            <div class="menu-btn">
                <div class="label">Меню сайта</div>
                <div class="icon">
                    <div class="bar first"></div>
                    <div class="bar second"></div>
                    <div class="bar third"></div>
                </div>
            </div>
            <div class="menu-holder">

                {{ Menu::placement('main_menu') }}

                @if (0)
                <ul>
                    <li><a href="index.html">СЕТЬ КАФЕ</a>
                        <ul>
                            <li class="active"><a href="redstreet.html">Красная, 16</a></li>
                            <li><a href="">40 лет Победы, 144/5</a></li>
                            <li><a href="">Кр. Партизан, 173</a></li>
                            <li><a href="">Тургенева, 138/6</a></li>
                        </ul>
                    </li>
                    <li class="active"><a href="afisha.html">АФИША</a></li>
                    <li><a href="menu.html">МЕНЮ</a></li>
                    <li><a href="about.html">О СЕТИ КАФЕ</a></li>
                    <li><a href="specials.html">АКЦИИ</a></li>
                    <li><a href="photos.html">ФОТОГАЛЛЕРЕЯ</a></li>
                    <li><a href="reviews.html">ОТЗЫВЫ</a></li>
                    <li><a href="contacts.html">КОНТАКТЫ</a></li>
                </ul>
                @endif

            </div>
        </div>
        <!--.clrfx-->
    </div>
    <div class="title-wrapper">
        @section('title-wrapper')@show
    </div>
    <div class="back-url-wrapper">
        <a href="#" class="back-url">
            <{{ '?' }}xml version="1.0"{{ '?' }}>
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="27" height="24">
                <desc ivinci="yes" version="4.5" gridstep="20" showgrid="no" snaptogrid="no" codeplatform="0">
                <g id="Layer1" opacity="1">
                    <g id="Shape1">
                        <desc shapeid="1" type="0" basicinfo-basictype="0" basicinfo-roundedrectradius="12" basicinfo-polygonsides="6" basicinfo-starpoints="5" bounding="rect(-4,-4.925,8,9.85)" text="" font-familyname="" font-pixelsize="20" font-bold="0" font-underline="0" font-alignment="1" strokestyle="0" markerstart="0" markerend="0" shadowenabled="0" shadowoffsetx="0" shadowoffsety="2" shadowblur="4" shadowopacity="160" blurenabled="0" blurradius="4" transform="matrix(1,0,0,1,7.05,7.325)" pers-center="0,0" pers-size="0,0" pers-start="0,0" pers-end="0,0" locked="0" mesh="" flag="">
                        <path id="shapePath1" d="M3.05,7.35 L11.05,12.25 L11.05,7.5 L11.05,2.4 L3.05,7.35 Z" style="stroke:none;fill-rule:nonzero;fill-opacity:1">
                    </g>
                    <g id="Shape2">
                        <desc shapeid="2" type="0" basicinfo-basictype="0" basicinfo-roundedrectradius="12" basicinfo-polygonsides="6" basicinfo-starpoints="5" bounding="rect(-5.925,-6.425,11.85,12.85)" text="" font-familyname="" font-pixelsize="20" font-bold="0" font-underline="0" font-alignment="1" strokestyle="0" markerstart="0" markerend="0" shadowenabled="0" shadowoffsetx="0" shadowoffsety="2" shadowblur="4" shadowopacity="160" blurenabled="0" blurradius="4" transform="matrix(1,0,0,1,16.975,13.925)" pers-center="0,0" pers-size="0,0" pers-start="0,0" pers-end="0,0" locked="0" mesh="" flag="">
                        <path id="shapePath2" d="M11.05,7.5 C14.15,7.73333 16.8333,8.98333 19.1,11.25 C21.6,13.75 22.8667,16.7833 22.9,20.35 " style="stroke-opacity:1;stroke-width:3;stroke-linejoin:round;stroke-miterlimit:2;stroke-linecap:round;fill:none">
                    </g>
                </g>
            </svg>
            <div class="type">
              Вернуться<br>
              на страницу кафе
            </div>
        </a>
    </div>
</div>
