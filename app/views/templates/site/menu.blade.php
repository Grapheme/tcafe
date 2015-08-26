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
    #Helper::ta($first_cafe);

    Redirect(URL::route('page', array('menu', 'cafe' => $first_cafe['slug'])));
}

/**
 * Текущее кафе
 */
$current_cafe = Dic::valueBySlugs('cafe', Input::get('cafe'));
if (!is_object($current_cafe) || !$current_cafe->id)
    Redirect(URL::route('page', 'menu'));

#echo '<!--'; Helper::ta($current_cafe); echo '-->';

/**
 * Категории меню ВО ВСЕХ КАФЕ
 */
$menu = Dic::valuesBySlug('menu_category', function($query) use ($current_cafe) {
    /**
     * Фильтр по related_dicvals - тут не нужен! Иначе неверно построится Nested Set Model Tree!!
     */
    #$query->filter_by_related($current_cafe->id);
    $query->orderBy('lft', 'ASC');
});
#Helper::smartQueries(1);
$menu = DicVal::extracts($menu, null, true, true);
#Helper::ta($menu);
/**
 * Nested Set Model
 */
$menu_tree = DicLib::nestedModelToTree($menu, '|');
#Helper::ta($menu_tree);
#echo '<!--'; Helper::ta($menu_tree); echo '-->';

/**
 * Если не выбрана категория - определяем первую в текущем кафе и редиректим
 */
if (!Input::get('cat')) {

    /**
     * Получаем первую категорию в текущем кафе - комбинируя все категории и Nested Set Model из них
     */
    $first_cat = false;
    foreach ($menu_tree as $cat_id => $cat_name) {
        $cat = isset($menu[$cat_id]) ? $menu[$cat_id] : false;
        if (mb_substr($cat_name, 0, 1) == '|' || !$cat || !is_object($cat) || !$cat->cafe_id || !count($cat->cafe_id) || !isset($cat->cafe_id[$current_cafe->id]))
            continue;
        $first_cat = $cat;
        break;
    }
    #Helper::tad($first_cat);
    #echo '<!--'; Helper::ta($first_cat); echo '-->';

    if (is_object($first_cat) && $first_cat->slug)
        Redirect(URL::route('page', array('menu', 'cafe' => $current_cafe->slug, 'cat' => $first_cat->slug)));
}

/**
 * Если выбрана категория - загрузим блюда
 */
if (Input::get('cat')) {

    /**
     * Текущая категория
     */
    $current_cat = Dic::valueBySlugs('menu_category', Input::get('cat'));
    if (!is_object($current_cat) || !$current_cat->id)
        Redirect(URL::route('page', ['menu', 'cafe' => Input::get('cafe')]));

    $ids = array($current_cat->id);

    /**
     * Получаем дочерние категории
     */
    $child_cats = Dic::valuesBySlug('menu_category', function($query) use ($current_cat) {
        $query->where('lft', '>', $current_cat->lft);
        $query->where('rgt', '<', $current_cat->rgt);
        $query->orderBy('lft', 'ASC');
        /**
         * Тут не хватает фильтра по записям related_dicvals
         */
    });
    #Helper::smartQueries(1);
    $child_cats = DicVal::extracts($child_cats, null, true, true);
    #Helper::ta($child_cats);
    foreach ($child_cats as $c => $child_cat) {

        /**
         * Отфильтруем категории, которых нет в текущем кафе
         */
        if (!is_object($child_cat) || !$child_cat->cafe_id || !count($child_cat->cafe_id) || !isset($child_cat->cafe_id[$current_cafe->id])) {

            unset($child_cats[$c]);

        } else {

            /**
             * Собираем ID всех категорий, по которым нужно загрузить блюда
             */
            $ids[] = $child_cat->id;
        }
    }
    #Helper::ta($child_cats);
    #Helper::ta($ids);

    /**
     * Загружаем товары в текущей категории, и во всех ее дочерних категориях
     */
    $goods = Dic::valuesBySlug('menu_goods', function($query) use ($ids) {

        $qjf = $query->join_field('category_id', 'category_id');
        $query->whereIn($qjf.'.value', $ids);
        $query->orderBy('lft', 'ASC');
    });
    #Helper::smartQueries(1);
    $goods = DicVal::extracts($goods, null, true, true);
    $goods = DicLib::loadImages($goods, 'image_id');
    #Helper::tad($goods);
    #dd($goods);

    /**
     * Раскладываем товары по категориям
     */
    $cat_good = new Collection();
    foreach ($ids as $id) {
        $cat_good[$id] = new Collection();
    }
    if ($goods && count($goods)) {
        foreach ($goods as $good) {
            if (!isset($cat_good[$good->category_id]))
                $cat_good[$good->category_id] = new Collection();
            $cat_good[$good->category_id][$good->id] = $good;
        }
    }
    #Helper::tad($cat_good);

    /**
     *
     * МОЖНО ВЫВОДИТЬ!
     * с учетом $current_cat и $child_cats
     *
     */

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

    <!--
    {{ print_r($menu_tree, 1) }}
    -->
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
                        if (mb_substr($m_tree, 0, 1) == '|')
                            continue;
                        $menu_el = @$menu[$m];
                        if (!$menu_el || !is_object($menu_el) || !$menu_el->cafe_id || !count($menu_el->cafe_id) || !@$menu_el->cafe_id[$current_cafe->id])
                            continue;
                        ?>
                        <li{{ Input::get('cat') == $menu_el->slug ? ' class="active"' : '' }}><a href="{{ URL::route('page', ['menu', 'cafe' => Input::get('cafe'), 'cat' => $menu_el->slug]) }}">{{ $menu_el->name }}</a></li>
                    @endforeach
                </ul>
            @endif

            <div class="menu-dishes-list">

                @if (@count($cat_good))

                    @if (@count($cat_good[$current_cat->id]))
                        @foreach ($cat_good[$current_cat->id] as $good)
                            <?
                            $image = $good->image_id;
                            ?>
                            <div class="unit">
                                @if (is_object($image) && $image->id)
                                    <div style="background-image:url('{{ $image->full() }}')" class="visual"></div>
                                @endif
                                <div class="title">{{ $good->name }}</div>
                                <div class="description">{{ $good->description }}</div>
                                <div class="info">
                                    @if ($good->price)
                                        <div class="price">{{ $good->price }}.-</div>
                                    @endif
                                    @if ($good->serving)
                                        <div class="weight">{{ $good->serving }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @if (count($cat_good))
                        @foreach ($cat_good as $cat_id => $cat)
                            <?
                            if ($cat_id == $current_cat->id || !isset($child_cats[$cat_id]) || !is_object($child_cats[$cat_id]))
                                continue;
                            $child_cat = $child_cats[$cat_id];
                            ?>

                            @if (@count($cat_good[$child_cat->id]))

                                <h2>{{ $child_cat->name }}</h2>

                                @foreach ($cat_good[$child_cat->id] as $good)
                                    <?
                                    $image = $good->image_id;
                                    ?>
                                    <div class="unit">
                                        @if (is_object($image) && $image->id)
                                            <div style="background-image:url('{{ $image->full() }}')" class="visual"></div>
                                        @endif
                                        <div class="title">{{ $good->name }}</div>
                                        <div class="description">{{ $good->description }}</div>
                                        <div class="info">
                                            @if ($good->price)
                                                <div class="price">{{ $good->price }}.-</div>
                                            @endif
                                            @if ($good->serving)
                                                <div class="weight">{{ $good->serving }}</div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                                <div class="clrfx"></div>

                            @endif

                        @endforeach
                    @endif

                @else

                    Ничего не найдено

                @endif



            </div>
            <div class="clrfx"></div>
        </div>
    </div>

@stop


@section('scripts')
@stop