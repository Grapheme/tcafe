<?
/**
 * TITLE: Меню
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

/**
 * Если не выбрано кафе - делаем редирект на страницу с меню первого кафе
 */
if (!Input::get('cafe')) {
    $first_cafe = $cafes->toArray();
    $first_cafe = array_shift($first_cafe);
    #Helper::dd($first_cafe);
    Redirect(URL::route('page', array('menu', 'cafe' => $first_cafe['slug'])));
}

/**
 * Текущее кафе
 */
$current_cafe = Dic::valueBySlugs('cafe', Input::get('cafe'));
if (!is_object($current_cafe) || !$current_cafe->id)
    Redirect(URL::route('page', 'menu'));

/**
 * Категории меню
 */
$menu = Dic::valuesBySlug('menu_category');
$menu = DicVal::extracts($menu, null, true, true);
/**
 * Nested Set Model
 */
$menu_tree = DicLib::nestedModelToTree($menu);
#Helper::tad($menu);

/**
 * Если выбрана категория - загрузим блюда
 */
if (Input::get('cat')) {

    /**
     * Текущая категория
     */
    $current_cat = Dic::valueBySlugs('menu_category', Input::get('cat'));
    if (!is_object($current_cat) || !$current_cat->id)
        Redirect(URL::route('page', ['menu'] + ['cafe' => Input::get('cafe')]));

    $ids = array($current_cat->id);

    /**
     * Получаем дочерние категории
     */
    $child_cats = Dic::valuesBySlug('menu_category', function($query) use ($current_cat) {
        $query->where('lft', '>', $current_cat->lft);
        $query->where('rgt', '<', $current_cat->rgt);
        /**
         * Тут не хватает фильтра по записям related_dicvals
         */
    });
    $child_cats = DicVal::extracts($child_cats, null, true, true);
    foreach ($child_cats as $c => $child_cat) {
        if (!is_object($child_cat) || !$child_cat->cafe_id || !count($child_cat->cafe_id) || !isset($child_cat->cafe_id[$current_cafe->id])) {
            unset($child_cats[$c]);
        }
        $ids[] = $child_cat->id;
    }
    #Helper::tad($child_cats);

    #Helper::tad($ids);

    /**
     * Загружаем товары в текущей категории, и во всех ее дочерних категориях
     */
    $goods = Dic::valuesBySlug('menu_goods', function($query) use ($ids) {

        $query->filter_by_field('category_id', 'IN', '(' . implode(',', $ids) . ')');
    });

    Helper::smartQueries(1);

    Helper::tad($goods);

}

?>
@extends(Helper::layout())


@section('page_class')menu @stop


@section('style')
@stop


@section('title-wrapper')
    <div class="title-holder">
        <div class="title">
            <div class="left">Наше</div>
            <div class="icon"><img src="{{ Config::get('site.theme_path') }}/images/ico-plate.svg"></div>
            <div class="right">меню </div>
        </div>
    </div>
@stop


@section('content')

    <div class="content w1076">
        <div class="top-btns">
            @if (count($cafes))
                @foreach ($cafes as $cafe)
                    <div class="bar"></div><a href="?cafe={{ $cafe->slug }}"{{ $cafe->slug == $current_cafe->slug ? ' class="active"' : '' }}>{{ $cafe->name }}</a>
                @endforeach
            @endif
            <div class="bar"></div>
        </div>
        <div class="holder">

            {{ Helper::tad_($menu) }}

            @if (count($menu_tree))
                <ul class="menu-cat-list">
                    @foreach ($menu_tree as $m => $m_tree)
                        <?
                        if (mb_substr($m_tree, 0, 1) == '&')
                            continue;
                        $menu_el = @$menu[$m];
                        if (!$menu_el || !is_object($menu_el) || !$menu_el->cafe_id || !count($menu_el->cafe_id) || !@$menu_el->cafe_id[$current_cafe->id])
                            continue;
                        ?>
                        <li{{ Input::get('cat') == $menu_el->slug ? ' class="active"' : '' }}><a href="{{ URL::route('page', ['menu'] + Input::all() + ['cat' => $menu_el->slug]) }}">{{ $menu_el->name }}</a></li>
                    @endforeach
                </ul>
            @endif

            <div class="menu-dishes-list">
                <h2>Вегетарианская</h2>
                <div href="" class="unit"><img src="http://dummyimage.com/552x368" class="visual">
                    <div class="title">Маргарита с грибами</div>
                    <div class="description">Сыр, томатная паста, базилик, лимон, специи, cыр, томатная паста, базилик, лимон, специи</div>
                    <div class="info">
                        <div class="price">359.-</div>
                        <div class="weight">550 гр.</div>
                    </div>
                </div>
                <div href="" class="unit"><img src="http://dummyimage.com/552x368" class="visual">
                    <div class="title">Маргарита с грибами</div>
                    <div class="description">Сыр, томатная паста, базилик</div>
                    <div class="info">
                        <div class="price">359.-</div>
                        <div class="weight">300/550/30 гр.</div>
                    </div>
                </div>
                <div href="" class="unit"><img src="http://dummyimage.com/552x368" class="visual">
                    <div class="title">Маргарита с грибами</div>
                    <div class="description">Сыр, томатная паста, базилик, лимон, специи, cыр, томатная паста, базилик, лимон, специи</div>
                    <div class="info">
                        <div class="price">359.-</div>
                        <div class="weight">300/550/30 гр.</div>
                    </div>
                </div>
                <div href="" class="unit"><img src="http://dummyimage.com/552x368" class="visual">
                    <div class="title">Маргарита с грибами</div>
                    <div class="description">Сыр, томатная паста, базилик, лимон, специи, cыр, томатная паста, базилик, лимон, специи</div>
                    <div class="info">
                        <div class="price">359.-</div>
                        <div class="weight">550 гр.</div>
                    </div>
                </div>
                <div class="clrfx"></div>
                <h2>Вегетарианская</h2>
                <div href="" class="unit"><img src="http://dummyimage.com/552x368" class="visual">
                    <div class="title">Маргарита с грибами</div>
                    <div class="description">Сыр, томатная паста, базилик, лимон, специи, cыр, томатная паста, базилик, лимон, специиСыр, томатная паста, базилик, лимон, специи, cыр, томатная паста, базилик, лимон, специиСыр, томатная паста, базилик, лимон, специи, cыр, томатная паста, базилик, лимон, специиСыр, томатная паста, базилик, лимон, специи, cыр, томатная паста, базилик, лимон, специи</div>
                    <div class="info">
                        <div class="price">359.-</div>
                        <div class="weight">550 гр.</div>
                    </div>
                </div>
                <div href="" class="unit"><img src="http://dummyimage.com/552x368" class="visual">
                    <div class="title">Маргарита с грибами</div>
                    <div class="description">Сыр, томатная паста, базилик</div>
                    <div class="info">
                        <div class="price">359.-</div>
                        <div class="weight">300/550/30 гр.</div>
                    </div>
                </div>
                <div href="" class="unit"><img src="http://dummyimage.com/552x368" class="visual">
                    <div class="title">Маргарита с грибами</div>
                    <div class="description">Сыр, томатная паста, базилик, лимон, специи, cыр, томатная паста, базилик, лимон, специи</div>
                    <div class="info">
                        <div class="price">359.-</div>
                        <div class="weight">300/550/30 гр.</div>
                    </div>
                </div>
                <div href="" class="unit"><img src="http://dummyimage.com/552x368" class="visual">
                    <div class="title">Маргарита с грибами</div>
                    <div class="description">Сыр, томатная паста, базилик, лимон, специи, cыр, томатная паста, базилик, лимон, специи</div>
                    <div class="info">
                        <div class="price">359.-</div>
                        <div class="weight">550 гр.</div>
                    </div>
                </div>
                <div href="" class="unit"><img src="http://dummyimage.com/552x368" class="visual">
                    <div class="title">Маргарита с грибами</div>
                    <div class="description">Сыр, томатная паста, базилик, лимон, специи, cыр, томатная паста, базилик, лимон, специиСыр, томатная паста, базилик, лимон, специи, cыр, томатная паста, базилик, лимон, специиСыр, томатная паста, базилик, лимон, специи, cыр, томатная паста, базилик, лимон, специиСыр, томатная паста, базилик, лимон, специи, cыр, томатная паста, базилик, лимон, специи</div>
                    <div class="info">
                        <div class="price">359.-</div>
                        <div class="weight">550 гр.</div>
                    </div>
                </div>
                <div href="" class="unit"><img src="http://dummyimage.com/552x368" class="visual">
                    <div class="title">Маргарита с грибами</div>
                    <div class="description">Сыр, томатная паста, базилик</div>
                    <div class="info">
                        <div class="price">359.-</div>
                        <div class="weight">300/550/30 гр.</div>
                    </div>
                </div>
                <div href="" class="unit"><img src="http://dummyimage.com/552x368" class="visual">
                    <div class="title">Маргарита с грибами</div>
                    <div class="description">Сыр, томатная паста, базилик, лимон, специи, cыр, томатная паста, базилик, лимон, специи</div>
                    <div class="info">
                        <div class="price">359.-</div>
                        <div class="weight">300/550/30 гр.</div>
                    </div>
                </div>
                <div href="" class="unit"><img src="http://dummyimage.com/552x368" class="visual">
                    <div class="title">Маргарита с грибами</div>
                    <div class="description">Сыр, томатная паста, базилик, лимон, специи, cыр, томатная паста, базилик, лимон, специи</div>
                    <div class="info">
                        <div class="price">359.-</div>
                        <div class="weight">550 гр.</div>
                    </div>
                </div>
                <div href="" class="unit"><img src="http://dummyimage.com/552x368" class="visual">
                    <div class="title">Маргарита с грибами</div>
                    <div class="description">Сыр, томатная паста, базилик, лимон, специи, cыр, томатная паста, базилик, лимон, специиСыр, томатная паста, базилик, лимон, специи, cыр, томатная паста, базилик, лимон, специиСыр, томатная паста, базилик, лимон, специи, cыр, томатная паста, базилик, лимон, специиСыр, томатная паста, базилик, лимон, специи, cыр, томатная паста, базилик, лимон, специи</div>
                    <div class="info">
                        <div class="price">359.-</div>
                        <div class="weight">550 гр.</div>
                    </div>
                </div>
                <div href="" class="unit"><img src="http://dummyimage.com/552x368" class="visual">
                    <div class="title">Маргарита с грибами</div>
                    <div class="description">Сыр, томатная паста, базилик</div>
                    <div class="info">
                        <div class="price">359.-</div>
                        <div class="weight">300/550/30 гр.</div>
                    </div>
                </div>
                <div href="" class="unit"><img src="http://dummyimage.com/552x368" class="visual">
                    <div class="title">Маргарита с грибами</div>
                    <div class="description">Сыр, томатная паста, базилик, лимон, специи, cыр, томатная паста, базилик, лимон, специи</div>
                    <div class="info">
                        <div class="price">359.-</div>
                        <div class="weight">300/550/30 гр.</div>
                    </div>
                </div>
                <div href="" class="unit"><img src="http://dummyimage.com/552x368" class="visual">
                    <div class="title">Маргарита с грибами</div>
                    <div class="description">Сыр, томатная паста, базилик, лимон, специи, cыр, томатная паста, базилик, лимон, специи</div>
                    <div class="info">
                        <div class="price">359.-</div>
                        <div class="weight">550 гр.</div>
                    </div>
                </div>
                <div class="clrfx"></div>
            </div>
            <div class="clrfx"></div>
        </div>
    </div>

@stop


@section('scripts')
@stop