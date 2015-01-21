<?
/**
 * TITLE: Простая страница
 */
?>
@extends(Helper::layout())


@section('page_class')about common @stop


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

            <h1>{{ $page->name }}</h1>

            @if (isset($page->blocks) && count($page->blocks))
                @foreach ($page->blocks as $block)
                    {{ $page->block($block->slug) }}
                @endforeach
            @endif

        </div>
    </div>

@stop


@section('scripts')
@stop