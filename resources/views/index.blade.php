<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Finder</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/index.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fonts.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/navbar.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/footer.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>

<body class="container">
    <div class="circle"></div>
    <div class="navbar">
        <img class="zoom" src="{{asset('images/logo.png')}}"alt="">
        <ul class="nav navbar-nav">
            <li><a class="active navbar-link" href="{{ route('index') }}">ACCUEIL</a></li>
<li><a href="{{ route('societes') }}">SOCIETES</a></li>
<li><a href="{{ route('guide_rapport') }}">GUIDE RAPPORT</a></li>
<li><a href="{{ route('a_propos') }}">A PROPOS</a></li>
        </ul>
    </div>
    <img class="banner-image" src="./images/banner.png" alt="">
    <div class="banner-text">
        <h6>TROUVER</h6></br>
        <h6>L'ENTREPRISE</h6></br>
        <h6>QUI VOUS CONVIENT...</h6></br>
        <h6><b> Découvrez des Entreprises <li>Filtres Personnalisés</li><li>Réussissez Votre Rapport de Stage</li></b> </h6>
    </div>
    <div style="height: 44.33rem;"></div>
    <a id="back-to-top-button"></a>
</body>
<script src="./js/script.js"></script>

</html>
