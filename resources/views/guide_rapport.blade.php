<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Internship Finder</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('dist/style.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('dist/guide-rapport.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('dist/fonts.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('dist/navbar.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('dist/footer.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>

<body>
  <a id="back-to-top-button"></a>
  <div class="navbar">
    <img class="zoom" src="{{asset('images/logo.png')}}" alt="" />
    <ul class="nav navbar-nav">
      <li><a class=" navbar-link" href="{{ route('index') }}">ACCUEIL</a></li>
      <li><a href="{{ route('societes') }}">SOCIETES</a></li>
      <li><a class="active" href="{{ route('guide_rapport') }}">GUIDE RAPPORT</a></li>
      <li><a href="{{ route('a_propos') }}">A PROPOS</a></li>
    </ul>
  </div>
  <div class="title">
    <h1>Maîtrisez l'Art du</h1>
    <h1>Rapport de Stage</h1>
  </div>
  <p class="description">
    Explorez la liste des entreprises offrant des opportunités de stage en
    informatique. Chacune de ces entreprises propose des expériences uniques.
    Découvrez-les ci-dessous pour trouver votre opportunité de stage idéale.
  </p>

  <h5>
    <ul>
      <li>Directives de Présentation :</li>
    </ul>
  </h5>
  <div class="directives">
    <ul>
      <li>
        Utilisez la police Times New Roman, taille 12, avec un interligne de
        1,5.
      </li>
      <li>Les marges doivent être définies à 2,5 cm de tous les côtés.</li>
      <li>
        Les figures, les tableaux et les illustrations doivent être incorporés
        dans le texte avec des légendes claires.
      </li>
      <li>
        Les énumérations doivent être utilisées, avec différents types de
        puces pour différents niveaux.
      </li>
      <li>
        Suivez les directives typographiques recommandées pour les
        présentations si vous avez des diapositives.
      </li>
    </ul>
  </div>
  <h5>
    <ul>
      <li>Support du rapport :</li>
    </ul>
  </h5>
  <h6>Veuillez choisir votre niveau de stage :</h6>
  <select name="niveau_de_stage" id="niveau_de_stage" onchange="changeIframeLink()">
    <option value="" disabled selected>Niveau de Stage</option>
    <option value="initiation">Initiation</option>
    <option value="perfectionnement">Perfectionnement</option>
    <option value="fin_etude">Fin d'études</option>
  </select>

  <div class="example-paper" id="examplePaper">
    <iframe id="iframeContainer"
      src=""
      frameborder="0" allowfullscreen style="background-color: white;"></iframe>
  </div>
  <footer>
    <img class="footer-img zoom" src="{{asset('images/logo-negative.png')}}" alt="">
    <div>
      <h5>Notre Objectif : </h5>
      <p>
        Notre projet simplifie la recherche de stages en informatique. La plateforme offre une liste organisée
        d'opportunités, des outils de filtrage et des conseils pour des rapports de stage de qualité. C'est une
        ressource précieuse pour la recherche de stages en informatique. </p>
    </div>
    <div>
      <h5>Lien Utiles : </h5>
      <h6><a class="active" href="{{route('index')}}">Accueil</a></h6>
      <h6><a href="{{route('societes')}}">Sociétés</a></h6>
      <h6><a href="{{route('guide_rapport')}}">Guide Rapport</a></h6>
      <h6><a href="{{route('a_propos')}}">A Propos</a></h6>
    </div>

    <div class="contact">
      <img class="zoom" src="{{asset('images/facebook.svg')}}" alt="">
      <img class="zoom" src="{{asset('images/whatsapp.svg')}}" alt="">
      <img class="zoom" src="{{asset('images/instagram.svg')}}" alt="">
    </div>
  </footer>

</body>

<script src="{{asset('js/script.js')}}"></script>

</html>