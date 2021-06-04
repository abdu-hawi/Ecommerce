<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @if(lang() == 'ar')
            {!! setting()->site_name_ar !!}
        @else
            {!! setting()->site_name_en !!}
        @endif
    </title>

    @if(!empty(setting()->icon))
        <link rel="icon" href="{!! Storage::url(setting()->icon) !!}">
    @endif

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{!! url('/') !!}/style/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{!! url('/') !!}/style/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{!! url('/') !!}/style/css/owl.carousel.css">
    <link rel="stylesheet" href="{!! url('/') !!}/style/style.css">
    <link rel="stylesheet" href="{!! url('/') !!}/style/css/responsive.css">

    @if(lang() == 'ar')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.2.0/css/bootstrap-rtl.min.css">
    @endif

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>