<?
/**
 * TITLE: Главная страница
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
@extends(Helper::layout())


@section('page_class')not-found @stop


@section('style')
@stop


@section('title-wrapper')
    <div class="title-holder">
        <div class="title">
            <div class="left">Ошибка</div>
            <div class="icon"><img src="{{ Config::get('site.theme_path') }}/images/404.png"></div>
            <div class="right">404</div>
        </div>
    </div>
@stop


@section('content')
@stop


@section('scripts')
@stop