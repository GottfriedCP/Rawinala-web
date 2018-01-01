<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
<!-- Icon-related markup START -->
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="apple-mobile-web-app-title" content="Rawinala">
<meta name="application-name" content="Rawinala">
<meta name="theme-color" content="#ffffff">
<!-- Icon-related markup END -->
<!-- Google Recaptcha START -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
    function onSubmit(token) {
        document.getElementById("form-ci").submit();
    }
</script> <!-- Google Recaptcha END -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap/bootstrap.min.css'); ?>">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Cabin:400,400i" rel="stylesheet"> 
<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/login.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/article.css'); ?>">
<title><?php echo $title; ?></title>
</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-light" id="rawinala-navbar">
    <a class="navbar-brand" href="/">
        <img src="<?php echo base_url('assets/images/logo.png')?>" width="80" height="80" alt="logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav" itemscope itemtype="http://schema.org/SiteNavigationElement">
            <li class="nav-item">
                <a class="nav-link" href="/">Beranda</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/blog">Blog</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Tentang Kami</a>
                <ul class="dropdown-menu">
                    <a class="nav-link" href="/about#top"> Sejarah Rawinala</a>
                    <a class="nav-link" href="/about#susunan-pengurus"> Susunan Kepengurusan</a>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/donation">Donasi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/contact">Hubungi Kami</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto membership">
            <?php if (!$this->session->userdata('logged_in')) { ?>
            <li class="nav-item">
                <a class="nav-link" href="/member/login"><img src="<?php echo base_url('assets/images/account-login-2x.png'); ?>"> Login</a>
            </li>
            <?php } else { ?>
            <?php if ($this->session->userdata('unread_messages') > 0) { ?>
            <li class="nav-item">
                <a class="nav-link" href="/message"><img src="<?php echo base_url('assets/images/bell-2x.png'); ?>"> <?php echo $this->session->userdata('unread_messages') ?> pesan baru</a>
            </li>
            <?php } ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><img src="<?php echo base_url('assets/images/person-2x.png'); ?>"> <?php echo $this->session->userdata('name'); ?>
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <a class="nav-link" href="/blog/create"><img src="<?php echo base_url('assets/images/document-2x.png'); ?>"> Buat artikel baru</a>
                    <a class="nav-link" href="/message"><img src="<?php echo base_url('assets/images/envelope-closed-2x.png'); ?>"> Lihat pesan</a>
                    <a class="nav-link" href="/newsletter/create"><img src="<?php echo base_url('assets/images/document-2x.png'); ?>"> Buat newsletter baru</a>
                    <a class="nav-link" href="/member/logout"><img src="<?php echo base_url('assets/images/account-logout-2x.png'); ?>"> Logout</a>
                </ul>
            </li>
            <?php } ?>
            <li class="nav-item">
                <div id="google_translate_element" style="padding: 5px 0 0 20px;"></div>
                <script type="text/javascript">
                    function googleTranslateElementInit() {
                        new google.translate.TranslateElement({pageLanguage: 'id', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
                    }
                </script>
                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            </li>
        </ul>
    </div>
</nav>