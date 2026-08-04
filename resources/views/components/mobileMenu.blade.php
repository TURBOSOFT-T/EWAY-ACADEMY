@php
    $config = DB::table('configs')->first();

    $service = DB::table('services')->get();
    $produit = DB::table('produits')->get();

@endphp

<head>
    <style>
        .mobile-nav__container {
            background-color: #000 !important;
            /* fond noir forcé */
            color: #fff !important;
            /* texte blanc forcé */
            padding: 15px;
        }

        .mobile-nav__container a {
            color: #fff !important;
            text-decoration: none;
        }

        .mobile-nav__container a:hover {
            color: #ccc !important;
        }

        .mobile-nav__container .dropdown-menu {
            background-color: #111 !important;
        }

        .mobile-nav__container .dropdown-menu a {
            color: #fff !important;
        }
    </style>
</head>



<style></style>
<style>
    .logo-small {
        width: 40px;
        height: 40px;
    }
</style>

<style>


</style>
<div class="mobile-nav__wrapper">
    <div class="mobile-nav__overlay mobile-nav__toggler"></div>
    <!-- /.mobile-nav__overlay -->
    <div class="mobile-nav__content">
        <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

        <!-- Logo -->
        <div class="logo-box">
            <a href="{{ url('/') }}" aria-label="logo image">
                <img src="{{ Storage::url($config->logo) }}" class="logo-small" width="150"
                    alt="{{ __('Logo') }}" />
            </a>
        </div>
        <!-- /.logo-box -->

        <!-- Dynamic Navigation Menu -->
        <div class="mobile-nav__container">
            <ul class="list-unstyled">
                <li><a href="{{ url('/') }}">Acueil</a></li>
                <li class="dropdown">
                    <a href="{{ route('about') }}">A propos</a>

                </li>


                <li class="dropdown">
                    <a href="#">Events</a>
                    <ul>
                        @foreach ($catevents as $category)
                            <li><a href="/category_event/{{ $category->id }}">{{ $category->nom }}</a></li>
                        @endforeach
                    </ul>
                </li>



                <li class="dropdown">
                    <a href="#">Actualités</a>
                    <ul>
                        @foreach ($catblogs as $category)
                            <li><a href="/category_blog/{{ $category->id }}">
                             {{ \App\Helpers\TranslationHelper::TranslateText($category->nom) }}
                            </a></li>
                        @endforeach
                    </ul>

                </li>






            </ul>
        </div>

        <style>
            .mobile-nav__container {
                background-color: #000;
                /* Fond noir */
                color: #fff;
                /* Texte blanc */
                padding: 15px;
            }

            .mobile-nav__container a {
                color: #fff;
                /* Liens en blanc */
                text-decoration: none;
            }

            .mobile-nav__container a:hover {
                color: #ccc;
                /* Optionnel : un gris clair au survol */
            }

            .mobile-nav__container .dropdown-menu {
                background-color: #111;
                /* Menu déroulant légèrement plus clair */
            }

            .mobile-nav__container .dropdown-menu a {
                color: #fff;
            }
        </style>

        <div class="mobile-nav__container">

            <ul class="main-menu__list list-unstyled">
                @guest
                    <li class="list-unstyled">
                        <a href="{{ url('login') }}">

                             {{ \App\Helpers\TranslationHelper::TranslateText('Login') }}
                        </a>
                    </li>
                @else
                    <li class="dropdown list-unstyled">
                        <a href="#" data-toggle="dropdown">
                            @if (auth()->user()->role != 'client')
                                Dashboard
                            @else
                                {{ \App\Helpers\TranslationHelper::TranslateText('Mon compte') }}
                            @endif
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu list-unstyled">
                            @if (auth()->user()->role != 'client')
                                <li>
                                    <a href="{{ url('dashboard') }}">Dashboard</a>
                                </li>
                            @endif

                            <li class="list-unstyled">
                                <a href="{{ route('account') }}">
                                    {{ \App\Helpers\TranslationHelper::TranslateText('Mon compte') }}
                                </a>
                            </li>

                            <li class="list-unstyled">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest


                <li>

                    <div class="custom-dropdown">
                        <form action="{{ route('locale.change') }}" method="POST">
                            @csrf
                            <div class="dropdown">
                                <button class="dropbtn">
                                    @if (app()->getLocale() == 'fr')
                                        <img src="https://img.icons8.com/color/20/france-circular.png" alt="fr">
                                    @elseif(app()->getLocale() == 'en')
                                        <img src="https://img.icons8.com/color/20/great-britain-circular.png"
                                            alt="en">
                                    @elseif(app()->getLocale() == 'de')
                                        <img src="https://img.icons8.com/color/20/germany-circular.png" alt="de">
                                    @else
                                        <img src="https://img.icons8.com/color/20/france-circular.png" alt="fr">
                                    @endif

                                </button>
                                <div class="dropdown-content">
                                    <button type="submit" name="locale" value="fr" class="dropdown-item">
                                        <img src="https://img.icons8.com/color/20/france-circular.png" alt="fr">
                                        Français
                                    </button>
                                    <button type="submit" name="locale" value="en" class="dropdown-item">
                                        <img src="https://img.icons8.com/color/20/great-britain-circular.png"
                                            alt="en">
                                        English
                                    </button>
                                    <button type="submit" name="locale" value="de" class="dropdown-item">
                                        <img src="https://img.icons8.com/color/20/germany-circular.png" alt="de">
                                        Deutsch
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>



                    <style>
                        .custom-dropdown {
                            position: relative;
                            display: inline-block;


                        }

                        .dropbtn {
                            background-color: #f7fef7;
                            color: white;
                            padding: 10px;
                            font-size: 16px;
                            border: none;
                            cursor: pointer;
                        }

                        .dropdown-content {
                            display: none;
                            position: absolute;
                            background-color: #f9f9f9;
                            min-width: 160px;
                            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                            z-index: 1;
                        }

                        .dropdown-content .dropdown-item {
                            background-color: white;
                            border: none;
                            width: 100%;
                            text-align: left;
                            padding: 8px 16px;
                            cursor: pointer;
                            display: flex;
                            align-items: center;
                        }

                        .dropdown-content .dropdown-item img {
                            margin-right: 8px;
                        }

                        .dropdown-content .dropdown-item:hover {
                            background-color: #f8f3f3;
                        }

                        .dropdown:hover .dropdown-content {
                            display: block;
                        }

                        .dropdown:hover .dropbtn {
                            background-color: #eef4ee;
                        }

                        /* Responsive adjustments */
                        @media (max-width: 600px) {
                            .dropbtn {
                                font-size: 10px;
                                padding: 8px;
                            }

                            .dropdown-content .dropdown-item {
                                font-size: 14px;
                                padding: 5px 10px;
                            }
                        }
                    </style>

                </li>
            </ul>



        </div>
        <!-- Contact Info -->
        <ul class="mobile-nav__contact list-unstyled">
            <li>
                <i class="fa fa-envelope"></i>
                <a href="mailto:nafiz125@gmail.com">{{ $config->email }}</a>
            </li>
            <li>
                <i class="fa fa-phone-alt"></i>
                <a href="https://wa.me/{{ preg_replace('/\D/', '', $config->telephone) }}" target="_blank">
                    {{ $config->telephone }}
                    <i class="fab fa-whatsapp"></i>

                </a>
            </li>
        </ul>
        <!-- /.mobile-nav__contact -->

        <!-- Social Links -->
        <div class="mobile-nav__top">
            <div class="mobile-nav__social">

                @if ($config->facebook)
                    <a href="{{ $config->facebook }}" title="Facebook" aria-label="Facebook"><i
                            class="icon-facebook"></i></a>
                @endif

                @if ($config->instagram)
                    <a href="{{ $config->instagram }}" title="Instagram" aria-label="Instagram"><i
                            class="icon-instagram"></i></a>
                @endif

                @if ($config->youtube)
                    <a href="{{ $config->youtube }}" title="YouTube" aria-label="YouTube"><i
                            class="fab fa-youtube"></i></a>
                @endif

                @if ($config->tiktok)
                    <a href="{{ $config->tiktok }}" title="TikTok" aria-label="TikTok">
                        <i class="fab fa-tiktok"></i>
                    </a>
                @endif

            </div>
        </div>
        <!-- /.mobile-nav__top -->
    </div>
    <!-- /.mobile-nav__content -->
</div>
<!-- /.mobile-nav__wrapper -->
