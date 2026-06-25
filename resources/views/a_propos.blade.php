<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Internship Finder</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('dist/style.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('dist/a-propos.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('dist/fonts.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('dist/navbar.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('dist/footer.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>

<body>
  <a id="back-to-top-button"></a>
  <div class="navbar">
    <img class="zoom" src="{{ asset('images/logo.png') }}" alt="" />
    <ul class="nav navbar-nav">
      <li><a href="{{ route('index') }}">ACCUEIL</a></li>
      <li><a href="{{ route('societes') }}">SOCIETES</a></li>
      <li><a href="{{ route('guide_rapport') }}">GUIDE RAPPORT</a></li>
      <li><a class="active" href="{{ route('a_propos') }}">A PROPOS</a></li>
    </ul>
  </div>
  <div class="title">
    <h1>Un Projet Inspiré par les</h1>
    <h1>Défis des Etudiants</h1>
  </div>
  <p class="description">
    Notre projet d'intégration en informatique, développé avec l'encadrement
    du professeur Sahbi, a été inspiré par les défis que les étudiants ont
    rencontrés lors de la recherche de stages et de la rédaction des rapports
    de stage, en raison de la dispersion des informations.
  </p>
  <p class="description">
    Cette plateforme vise à simplifier la recherche de stages pour les
    étudiants de notre université. Elle offre une liste d'entreprises
    proposant des stages, des outils de filtrage, et des conseils pour rédiger
    des rapports de stage de qualité. Le projet est le fruit du travail dévoué
    de notre équipe d'étudiants passionnés, désireux d'améliorer l'expérience
    de stage. Nous espérons que cette ressource sera précieuse pour votre
    recherche de stages en informatique.
  </p>
  <h5><b>Professeur : </b>Mr.Sahbi Moalla</br>
    <b>Etudiants : </b>Khalil Horri - Mourad Safagine - Mohamed Aziz Kalamoun
  </h5>
  <footer>
    <img class="footer-img zoom" src="{{ asset('images/logo-negative.png') }}" alt="">
    <div>
      <h5>Notre Objectif : </h5>
      <p>
        Notre projet simplifie la recherche de stages en informatique. La plateforme offre une liste organisée d'opportunités, des outils de filtrage et des conseils pour des rapports de stage de qualité. C'est une ressource précieuse pour la recherche de stages en informatique.
      </p>
    </div>
    <div>
      <h5>Lien Utiles : </h5>
      <h6><a class="active" href="{{ route('index') }}">Accueil</a></h6>
      <h6><a href="{{ route('societes') }}">Sociétés</a></h6>
      <h6><a href="{{ route('guide_rapport') }}">Guide Rapport</a></h6>
      <h6><a href="{{ route('a_propos') }}">A Propos</a></h6>
    </div>
    <div class="contact">
      <img class="zoom" src="{{ asset('images/facebook.svg') }}" alt="">
      <img class="zoom" src="{{ asset('images/whatsapp.svg') }}" alt="">
      <img class="zoom" src="{{ asset('images/instagram.svg') }}" alt="">
    </div>
  </footer>
  <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
