<?
/**
 * TITLE: О сети кафе
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
@extends(Helper::layout())


@section('page_class')about @stop


@section('style')
@stop


@section('title-wrapper')
    <div class="title-holder">
        <div class="title">
            <div class="left">О сети</div>
            <div class="icon"><img src="{{ Config::get('site.theme_path') }}/images/ico-cup.svg"></div>
            <div class="right">кафе</div>
        </div>
    </div>
@stop


@section('content')

    <div class="content w974">
        <div class="holder">

            @if (NULL !== ($c = count($page->blocks)))
                <?
                $i = 0;
                ?>
                @foreach($page->blocks as $block_slug => $block)
                    <?
                    ++$i;
                    ?>
                    @if ($i%2 == 1)
                        <div class="wrapper">
                    @endif
                    <div class="unit{{ $i == $c ? ' large' : '' }}">
                        {{ $page->block($block_slug) }}
                    </div>
                    @if ($i%2 == 0 || ($i%2 == 1 && $i == $c))
                        <div class="clrfx"></div>
                        </div>
                    @endif
                @endforeach
            @endif

            <div class="clrfx"></div>
        </div>
    </div>


@stop


@section('scripts')
@stop