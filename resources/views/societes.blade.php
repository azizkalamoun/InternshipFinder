<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Internship Finder</title>
    <link rel="icon" type="image/x-icon" href="asset{{('favicon.ico')}}" />
    <link rel="stylesheet" type="text/css" href="./dist/style.css" />
    <link rel="stylesheet" type="text/css" href="./dist/societes.css" />
    <link rel="stylesheet" type="text/css" href="./dist/fonts.css" />
    <link rel="stylesheet" type="text/css" href="./dist/navbar.css" />
    <link rel="stylesheet" type="text/css" href="./dist/footer.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>

<body>
    <a id="back-to-top-button"></a>
    <div class="navbar">
        <img class="zoom" src="./images/logo.png" alt="" />
        <ul class="nav navbar-nav">
            <li><a class=" navbar-link" href="{{ route('index') }}">ACCUEIL</a></li>
            <li><a class="active" href="{{ route('societes') }}">SOCIETES</a></li>
            <li><a  href="{{ route('guide_rapport') }}">GUIDE RAPPORT</a></li>
            <li><a href="{{ route('a_propos') }}">A PROPOS</a></li>
        </ul>
    </div>
    <div class="title">
        <h1>EXPLOREZ CES</h1>
        <h1>ENTREPRISES</h1>
    </div>
    <p class="description">
        Explorez la liste des entreprises offrant des opportunités de stage en
        informatique. Chacune de ces entreprises propose des expériences uniques.
        Découvrez-les ci-dessous pour trouver votre opportunité de stage idéale.
    </p>
    <div class="collection">
        <div class="sort">
            <h6>Trier Par :</h6>
            <select name="langue" id="langue">
                <option value="" disabled selected>Langue</option>
                <option value="Java">Java</option>
                <option value="C#">C#</option>
                <option value="Javascript">Javascript</option>
            </select>
            <select name="région" id="région">
                <option value="" disabled selected>Région</option>
                <option value="ariana">Ariana</option>
                <option value="beja">Béja</option>
                <option value="ben-arous">Ben Arous</option>
                <option value="bizerte">Bizerte</option>
                <option value="gabes">Gabès</option>
                <option value="gafsa">Gafsa</option>
                <option value="jendouba">Jendouba</option>
                <option value="kairouan">Kairouan</option>
                <option value="kasserine">Kasserine</option>
                <option value="kebili">Kebili</option>
                <option value="kef">Le Kef</option>
                <option value="mahdia">Mahdia</option>
                <option value="manouba">Manouba</option>
                <option value="medenine">Médenine</option>
                <option value="monastir">Monastir</option>
                <option value="nabeul">Nabeul</option>
                <option value="sfax">Sfax</option>
                <option value="sidi-bouzid">Sidi Bouzid</option>
                <option value="siliana">Siliana</option>
                <option value="sousse">Sousse</option>
                <option value="tataouine">Tataouine</option>
                <option value="tozeur">Tozeur</option>
                <option value="tunis">Tunis</option>
                <option value="zaghouan">Zaghouan</option>
            </select>
            <select name="niveau_de_stage" id="niveau_de_stage">
                <option value="" disabled selected>Niveau de Stage</option>
                <option value="initiation">Initiation</option>
                <option value="perfectionnement">Perfectionnement</option>
                <option value="fin_etude">Fin d'études</option>
            </select>
        </div>

        <div class="items">
            @foreach ($companies as $company)
                <a href="javascript:;" class="item item-trigger" data-company-id="{{ $company->id }}">
                    <img src="{{ asset('images/' . $company->logo_img) }}" alt="" />
                    <h6>{{ $company->name_company }}</h6>
                    <h6>{{ $company->adresse }}</h6>
                    <h6>{{ $company->language }}</h6>
                    <div class="rating">
                        @for ($i = 1; $i <= $company->rating; $i++)
                            <span class="fa fa-star fa-lg checked"></span>
                        @endfor
                        @for ($i = $company->rating + 1; $i <= 5; $i++)
                            <span class="fa fa-star fa-lg"></span>
                        @endfor
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    @foreach ($companies as $company)
    <div class="details-modal hidden" id="details-{{ $company->id }}">
        <div class="company-details" data-company-id="{{ $company->id }}">
            <img src="{{ asset('/images/close.svg') }}" alt="" class="close zoom closeModalBtn" data-modal-id="{{ $company->id }}">
            <div class="images">
                <img class="arrow zoom leftArrow" src="{{ asset('images/arrow.svg') }}" alt="" data-direction="left" data-company-id="{{ $company->id }}">
                <img class="arrow zoom rightArrow" src="{{ asset('images/arrow.svg') }}" alt="" data-direction="right" data-company-id="{{ $company->id }}">

                @if (!$company->images->isEmpty())
                    @foreach ($company->images as $image)
                        <img src="{{ asset('images/' . $image->image_path) }}" alt="" class="company-image image" />
                    @endforeach
                @else
                    <img src="{{ asset('/images/default_image.jpg') }}" alt="Pas Disponible" class="company-image" />
                @endif
            </div>

            <div class="information">
                <img src="{{ asset('images/' . ($company->logo_img ?: 'default_logo.jpg')) }}" alt="" />
                <h4>{{ $company->name_company }}</h4>
                <div class="rating">
                    @for ($i = 1; $i <= $company->rating; $i++)
                        <span class="fa fa-star fa-lg checked"></span>
                    @endfor
                    @for ($i = $company->rating + 1; $i <= 5; $i++)
                        <span class="fa fa-star fa-lg"></span>
                    @endfor
                </div>
                <h5>Description : {{ $company->description ?: 'Pas Disponible' }}</h5>
                <h6>Services : {{ $company->services ?: 'Pas Disponible' }}</h6>
                <hr>
                <h4>Informations de contact</h4>
                <div class="contact">
                    <img class="zoom" src="{{ asset('images/phone.svg') }}" alt=""><a href=""> +216
                        {{ $company->phone ?: 'Pas Disponible' }}</a>
                    <img class="zoom" src="{{ asset('images/mail.svg') }}" alt=""> <a
                        href="">{{ $company->email ?: 'Pas Disponible' }}</a>
                    <img class="zoom" src="{{ asset('images/location.svg') }}" alt=""><a
                        href="">{{ $company->full_location ?: 'Pas Disponible' }}</a>
                    <img class="zoom" src="{{ asset('images/linkedin.svg') }}" alt=""><a href="">
                        linkedin.com/in/{{ $company->linked_in_name ?: 'Pas Disponible' }}</a>
                    <img class="zoom" src="{{ asset('images/globe.svg') }}" alt=""> <a
                        href="">{{ $company->website ?: 'Pas Disponible' }}</a>
                </div>
            </div>
        </div>
    </div>
@endforeach



    <footer>
        <img class="footer-img zoom" src="./images/logo-negative.png" alt="" />
        <div>
            <h5>Notre Objectif :</h5>
            <p>
                Notre projet simplifie la recherche de stages en informatique. La plateforme offre une liste organisée
                d'opportunités, des outils de filtrage et des conseils pour des rapports de stage de qualité. C'est une
                ressource précieuse pour la recherche de stages en informatique. </p>
            </p>
        </div>
        <div>
            <h5>Lien Utiles :</h5>
            <h6><a class="active" href="./index.html">Accueil</a></h6>
            <h6><a href="./societes.html">Sociétés</a></h6>
            <h6><a href="./guide-rapport.html">Guide Rapport</a></h6>
            <h6><a href="./a-propos.html">A Propos</a></h6>
        </div>

        <div class="contact">
            <img class="zoom" src="./images/facebook.svg" alt="" />
            <img class="zoom" src="./images/whatsapp.svg" alt="" />
            <img class="zoom" src="./images/instagram.svg" alt="" />
        </div>
    </footer>
    <div class="footer-bottom">
        <hr>
        <h6>Copyright © Sukuna All Rights Reserved</h6>
    </div>
</body>

<script src="{{ asset('js/script.js') }}"></script>

</html>
