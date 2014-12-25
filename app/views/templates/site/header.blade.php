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
                <a href="index.html">СЕТЬ КАФЕ</a>
                <div class="small">
                    <a href="redstreet.html">Красная, 16</a>
                    <a href="">40 лет Победы, 144/5</a>
                    <a href="">Кр. Партизан, 173</a>
                    <a href="">Тургенева, 138/6</a>
                </div>
                <a href="afisha.html" class="active">АФИША</a>
                <a href="menu.html">МЕНЮ</a>
                <a href="about.html">О СЕТИ КАФЕ</a>
                <a href="specials.html">АКЦИИ</a>
                <a href="photos.html">ФОТОГАЛЛЕРЕЯ</a>
                <a href="reviews.html">ОТЗЫВЫ</a>
                <a href="contacts.html">КОНТАКТЫ</a>
            </div>
        </div>
        <!--.clrfx-->
    </div>
    <div class="title-wrapper">
        @section('title-wrapper')@show
    </div>
</div>
