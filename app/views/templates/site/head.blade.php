<?
/**
 * TEMPLATE_IS_NOT_SETTABLE
 */
?>
@section('title'){{{ isset($page_title) ? $page_title : Config::get('app.default_page_title') }}}@stop
@section('description'){{{ isset($page_description) ? $page_description : Config::get('app.default_page_description') }}}@stop
@section('keywords'){{{ isset($page_keywords) ? $page_keywords : Config::get('app.default_page_keywords') }}}@stop
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="description" content="@yield('description')">
        <meta name="keywords" content="@yield('keywords')">
        <meta name="viewport" content="width=device-width">

        <link rel="apple-touch-icon" sizes="57x57" href="{{ Config::get('site.theme_path') }}/images/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ Config::get('site.theme_path') }}/images/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ Config::get('site.theme_path') }}/images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ Config::get('site.theme_path') }}/images/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ Config::get('site.theme_path') }}/images/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ Config::get('site.theme_path') }}/images/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ Config::get('site.theme_path') }}/images/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ Config::get('site.theme_path') }}/images/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ Config::get('site.theme_path') }}/images/apple-touch-icon-180x180.png">
        <link rel="shortcut icon" href="{{ Config::get('site.theme_path') }}/images/favicon.ico">
        <link rel="icon" type="image/png" href="{{ Config::get('site.theme_path') }}/images/favicon-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="{{ Config::get('site.theme_path') }}/images/favicon-160x160.png" sizes="160x160">
        <link rel="icon" type="image/png" href="{{ Config::get('site.theme_path') }}/images/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="{{ Config::get('site.theme_path') }}/images/favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="{{ Config::get('site.theme_path') }}/images/favicon-32x32.png" sizes="32x32">

        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-TileImage" content="{{ Config::get('site.theme_path') }}/images/mstile-144x144.png">
        <meta name="msapplication-config" content="{{ Config::get('site.theme_path') }}/images/browserconfig.xml">

        {{ HTML::stylemod(Config::get('site.theme_path').'/styles/main.css') }}
