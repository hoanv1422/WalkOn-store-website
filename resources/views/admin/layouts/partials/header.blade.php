<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title')</title>
    <!-- <link rel="icon" href="img/logo.png" type="image/png"> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('./css/bootstrap1.min.css') }}" />
    <!-- themefy CSS -->
    <link rel="stylesheet" href="{{ asset('./vendors/themefy_icon/themify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('./vendors/niceselect/css/nice-select.css') }}" />
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('./vendors/owl_carousel/css/owl.carousel.css') }}" />
    <!-- select2 CSS -->
    <!-- gijgo css -->
    <link rel="stylesheet" href="{{ asset('./vendors/gijgo/gijgo.min.css') }}" />
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('./vendors/font_awesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('./vendors/tagsinput/tagsinput.css') }}" />
    <!-- date picker -->
    <link rel="stylesheet" href="{{ asset('./vendors/datepicker/date-picker.css') }}" />
    <link rel="stylesheet" href="{{ asset('./vendors/vectormap-home/vectormap-2.0.2.css') }}" />
    <!-- scrollabe  -->
    <link rel="stylesheet" href="{{ asset('./vendors/scroll/scrollable.css') }}" />
    <!-- datatable CSS -->
    <link rel="stylesheet" href="{{ asset('./vendors/datatable/css/jquery.dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('./vendors/datatable/css/responsive.dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('./vendors/datatable/css/buttons.dataTables.min.css') }}" />
    <!-- text editor css -->
    <link rel="stylesheet" href="{{ asset('./vendors/text_editor/summernote-bs4.css') }}" />
    <!-- morris css -->
    <link rel="stylesheet" href="{{ asset('./vendors/morris/morris.css') }}" />
    <!-- metarial icon css -->
    <link rel="stylesheet" href="{{ asset('./vendors/material_icon/material-icons.css') }}" />
    <!-- menu css  -->
    <link rel="stylesheet" href="{{ asset('./css/metisMenu.css') }}" />
    <!-- style CSS -->
    <link rel="stylesheet" href="{{ asset('./css/style1.css') }}" />
    <link rel="stylesheet" href="{{ asset('./css/colors/default.css') }}" id="colorSkinCSS">

</head>

<body class="crm_body_bg">
    <nav class="sidebar vertical-scroll  ps-container ps-theme-default ps-active-y">
        <div class="logo d-flex justify-content-between">
            <a href="{{url('/admin')}}"><img src="{{asset('img/logo.png')}}" alt=""></a>
            <div class="sidebar_close_icon d-lg-none">
                <i class="ti-close"></i>
            </div>
        </div>
