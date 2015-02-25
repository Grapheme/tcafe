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
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" width="27px" height="24px" viewBox="0 0 27 24">
                <defs>
                <g id="Layer0_0_FILL">
                <path stroke="none" d="
                M 3.05 7.35
                L 11.05 12.25 11.05 7.5 11.05 2.4 3.05 7.35 Z"></path>
                </g>
                
                <path id="Layer0_0_1_STROKES" stroke-width="3" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
                M 11.05 7.5
                Q 15.7 7.85 19.1 11.25 22.85 15 22.9 20.35"></path>
                </defs>
                
                <g transform="matrix( 1, 0, 0, 1, 0,0) ">
                <use xlink:href="#Layer0_0_FILL"></use>
                
                <use xlink:href="#Layer0_0_1_STROKES"></use>
                </g>
            </svg>
            <div class="type">
              Вернуться<br>
              на страницу кафе
            </div>
        </a>
    </div>
</div>
