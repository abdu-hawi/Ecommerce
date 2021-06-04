<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    @if(!empty(setting()->icon))
    <link rel="icon" href="{!! Storage::url(setting()->icon) !!}">
    @endif
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{!! !empty($title)?$title:'' !!}@yield('title')</title>

    <!-- Theme style -->
    @if(a_dir() == 'rtl')
        <link rel="stylesheet" href="{!! url('/') !!}/adminLTE/dist/css/adminlte.rtl.css">
        <link rel="stylesheet" href="{!! url('/') !!}/adminLTE/dist/css/bootstrap-RTL-4.1.1.css">
        <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
        <style>
            html,body,h1,h2,h3,h4,h5,h6,button{
                font-family: 'Cairo', sans-serif;
            }
        </style>
    @else
        <link rel="stylesheet" href="{!! url('/') !!}/adminLTE/dist/css/adminlte.min.css">
    @endif

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{!! url('/') !!}/adminLTE/plugins/fontawesome-free/css/all.min.css">




    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @yield('cssDataTable')

</head>

