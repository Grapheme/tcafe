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
</div>
