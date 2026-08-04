@php
    $config = DB::table('configs')->select('*')->first();
@endphp
<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title> @yield('titre') - (Admin) {{ config('app.name') }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" href="{{ Storage::url($config->icon) }}" type="image/png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="/../../assets/vendor/libs/fullcalendar/fullcalendar.css" />
    <!-- Icons -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->

    <link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />

    <link rel="stylesheet" href="../../assets/css/demo.css" />


    <link rel="stylesheet" href="/../../assets/vendor/css/pages/app-calendar.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />

    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../../assets/vendor/js/template-customizer.js"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>


    @yield('header')


    <script>
        function url(url) {
            document.location.href = url;
        }

        function url2(url) {
            window.open(url, '_blank');
        }

        function toggle_confirmation(productId) {
            const confirmBtn = document.getElementById('confirmBtn' + productId);
            if (!confirmBtn.classList.contains('d-none')) {
                confirmBtn.classList.add('d-none');
            } else {
                // Masquer tous les autres boutons de confirmation s'ils sont visibles
                document.querySelectorAll('.confirm-btn').forEach(btn => {
                    if (!btn.classList.contains('d-none')) {
                        btn.classList.add('d-none');
                    }
                });
                confirmBtn.classList.remove('d-none');
            }
        }



        function preview_illustration(key) {
            const fileInput = document.getElementById('file-input-' + key);
            fileInput.click();
        }



        var old_total = 0;

        function fetchNotificationsAndUpdateComponent() {
            // Appel AJAX pour récupérer les données du contrôleur
            fetch('{{ route('live_notifications') }}')
                .then(response => response.json())
                .then(data => {
                    const total = data.total;
                    // ,set value in msg-count span select by class name
                    document.querySelector('.msg-count').textContent = total;
                    // Vérifier si le total est supérieur à l'ancien total
                    if (total > old_total) {
                        // Jouer l'audio uniquement s'il y a une nouvelle notification
                        const audio = new Audio('/icons/system-notification-199277.wav');
                        // const audio = new Audio('/icons/maribelle.wav');
                        audio.play();
                        // Actualiser le composant Livewire
                        Livewire.dispatch('notificationUpdated');
                        // Mettre à jour l'ancien total avec le nouveau total
                        old_total = total;
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la récupération des notifications :', error);
                });
        }

        // Exécuter la fonction toutes les 5 secondes
        setInterval(fetchNotificationsAndUpdateComponent, 6000);
    </script>

    @cloudinaryJS
</head>

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{ route('dashboard') }}" class="app-brand-link">

                        <img src="{{ Storage::url($config->icon) }}" width="50" height="50" class="logo-icon-2"
                            alt="" />
                        <span class="app-brand-text demo menu-text fw-bold small-text" style=" font-size:100%">
                            {{ config('app.name') }} </span>
                        <style>
                            .small-text {
                                font-size: 12px;
                                /* Ajustez la taille selon vos besoins */
                            }
                        </style>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
                        <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>


                <ul class="menu-inner py-1">
                    <!-- Dashboards -->
                    <li class="menu-item">




                        <a href="{{ route('dashboard') }}" class="menu-link">
                            <div class="row flex">

                                <div class="parent-icon icon-color-1 col-sm-1">
                                 
                                    <i class="menu-icon tf-icons ti ti-smart-home"></i>
                                </div>
                                <div class="menu-title col-sm-8 ">Mon Dashboard</div>
                            </div>

                        </a>



                    </li>



                    <li class="menu-item">
                        @can('category_view')
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-category"></i>
                                <div data-i18n="Catégories">Catégories</div>
                            </a>
                        @endcan
                        <ul class="menu-sub">
                            @can('category_view')
                                <li class="menu-item">
                                    <a href="{{ route('categories') }}" class="menu-link">
                                        <div data-i18n="Liste ">Liste </div>
                                    </a>
                                </li>
                            @endcan
                            @can('category_add')
                                <li class="menu-item">
                                    <a href="{{ route('category.add') }}" class="menu-link">
                                        <div data-i18n="Ajouter">Ajouter</div>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>


                    
                    <li class="menu-item">
                        
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                               <i class="menu-icon tf-icons ti ti-edit-circle"></i>
                                <div data-i18n="Les Quizs">Les Quizs</div>
                            </a>
                      
                        <ul class="menu-sub">
                           
                        
                                  <li class="menu-item">
                                    <a href="{{ route('manage_exam') }}" class="menu-link">
                                        <div data-i18n="Liste examens ">Liste examen </div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{ route('registered_students') }}" class="menu-link">
                                        <div data-i18n="Résultats">Tésultals</div>
                                    </a>
                                </li>
                           
                            
                              
                       
                        </ul>
                    </li>




                     <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-briefcase"></i> 
                            <div data-i18n="Services">Services</div>
                        </a>
                        <ul class="menu-sub">

                            <li class="menu-item">
                                <a href="{{ route('services') }}" class="menu-link">
                                    <div data-i18n="Liste">Liste</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('service.add') }}" class="menu-link">
                                    <div data-i18n="Ajouter">Ajouter</div>
                                </a>
                            </li>
                        </ul>
                    </li>  



                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-book"></i>
                            <div data-i18n="Actualités">Actualités</div>
                            <div class="badge bg-primary rounded-pill ms-auto"></div>
                        </a>
                        @can('blog_view')
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="{{ route('blogs') }}" class="menu-link">
                                        <div data-i18n="Liste ">Liste </div>
                                    </a>
                                </li>
                            </ul>
                        @endcan
                        @can('blog_add')
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="{{ route('blog.add') }}" class="menu-link">
                                        <div data-i18n=" Créer une actualité"> Créer une actualité</div>
                                    </a>
                                </li>
                            </ul>
                        @endcan

                        {{--  <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('comment') }}" class="menu-link">
                                    <div data-i18n="Commentaires ">Commentaires </div>
                                </a>
                            </li>
                        </ul> --}}




                    </li>



                
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-id"></i>
                            <div data-i18n=" Sponsors">Sponsors</div>
                            <div class="badge bg-primary rounded-pill ms-auto"></div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('sponsors') }}" class="menu-link">
                                    <div data-i18n="Liste des sponsors">Liste</div>
                                </a>
                            </li>


                        </ul>
                    </li>
 
                    <li class="menu-item">
                        <a href="{{ route('webinaires') }}" class="menu-link">
                            <i class="menu-icon tf-icons fas fa-video"></i>
                            <div data-i18n="Webinaires Zoom">Webinaires Zoom</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('documents') }}" class="menu-link">
                            <i class="menu-icon tf-icons fas fa-file-alt"></i>
                            <div data-i18n="Documents">Documents</div>
                        </a>
                    </li>


                    <!-- User interface -->
                  {{--   <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-color-swatch"></i>
                            <div data-i18n="Certifications">Certifications</div>
                        </a>
                        @can('certification_view')
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="{{ route('certifications') }}" class="menu-link">
                                        <div data-i18n=" Liste ">Certifications</div>
                                    </a>
                                </li>



                            </ul>
                        @endcan
                        @can('inscription_view')
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="{{ route('certifications-inscriptions-list') }}" class="menu-link">
                                        <div data-i18n=" Inscriptions ">Inscriptions</div>
                                    </a>
                                </li>



                            </ul>
                        @endcan



                    </li>
 --}}





                    {{--    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-id"></i>
                            <div data-i18n="Gestion des images">Gestion des images</div>
                            <div class="badge bg-primary rounded-pill ms-auto"></div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('images') }}" class="menu-link">
                                    <div data-i18n="Liste des images">Liste des images</div>
                                </a>
                            </li>


                        </ul>
                    </li> --}}
                    <!-- User interface -->
                    {{--  <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-color-swatch"></i>
                            <div data-i18n="Gestion des vidéos">Gestion vidéos</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('videos') }}" class="menu-link">
                                    <div data-i18n="Liste des vidéos">Liste de vidéos</div>
                                </a>
                            </li>



                        </ul>
                    </li>
 --}}
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-book"></i>
                            <div data-i18n="Nos formations">Formations</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('formations') }}" class="menu-link">
                                    <div data-i18n="Liste des formations">Liste des formations</div>
                                </a>
                            </li>

                        </ul>

                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('list_inscriptions') }}" class="menu-link">
                                    <div data-i18n="Liste des inscriptions">Liste des inscriptions</div>
                                </a>
                            </li>

                        </ul>
                    </li>






                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-users"></i>
                            <div data-i18n="Gestion du personnel">Gestion du personnel</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('personnels') }}" class="menu-link">
                                    <div data-i18n="Liste du personnel">Liste du personnel</div>
                                </a>
                            </li>

                        </ul>


                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('clients') }}" class="menu-link">
                                    <div data-i18n="Liste des étudiants ">Liste des étudiants</div>
                                </a>
                            </li>

                        </ul>


                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-users"></i>
                            <div data-i18n="Contacts">Contacts</div>
                        </a>


                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('admin_contact_form') }}" class="menu-link">
                                    <div data-i18n="Liste  des contacts">Contacts</div>
                                </a>
                            </li>

                        </ul>


                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('testimonials') }}" class="menu-link">
                                    <div data-i18n=" Témoignages"> Témoignages</div>
                                </a>
                            </li>

                        </ul>


                    </li>





                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="ti ti-settings me-3 ti-md"></i>
                            <div data-i18n="Configurations">Configurations</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('contact-admin') }}" class="menu-link">
                                    <div data-i18n="Informations">Informations</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('banner.index') }}" class="menu-link">
                                    <div data-i18n="Banières">Banières</div>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <!-- Misc -->

                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="ti ti-menu-2 ti-md"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item navbar-search-wrapper mb-0">
                                <a class="nav-item nav-link search-toggler d-flex align-items-center px-0"
                                    href="javascript:void(0);">
                                    <i class="ti ti-search ti-md me-2 me-lg-4 ti-lg"></i>
                                    <span class="d-none d-md-inline-block text-muted fw-normal">Search (Ctrl+/)</span>
                                </a>
                            </div>
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">

                            {{--     <li class="nav-item dropdown-language dropdown">
                                <a class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                    href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <i class="ti ti-language rounded-circle ti-md"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-language="en"
                                            data-text-direction="ltr">
                                            <span>English</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-language="fr"
                                            data-text-direction="ltr">
                                            <span>French</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-language="ar"
                                            data-text-direction="rtl">
                                            <span>Arabic</span>
                                        </a>
                                    </li>

                                </ul>
                            </li> --}}
                            <!--/ Language -->

                            <!-- Style Switcher -->
                            <li class="nav-item dropdown-style-switcher dropdown">
                                <a class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                    href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <i class="ti ti-md"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                                            <span class="align-middle"><i
                                                    class="ti ti-sun ti-md me-3"></i>Light</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                                            <span class="align-middle"><i
                                                    class="ti ti-moon-stars ti-md me-3"></i>Dark</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                                            <span class="align-middle"><i
                                                    class="ti ti-device-desktop-analytics ti-md me-3"></i>System</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- / Style Switcher-->



                            <!-- Notification -->
                            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">

                                <a class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                    href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                    aria-expanded="false">
                                    <span class="position-relative">
                                        <i class="ti ti-bell ti-md"></i>
                                        <span
                                            class="badge rounded-pill bg-danger badge-dot badge-notifications border msg-count">0</span>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:;">
                                        <div class="msg-header">
                                            <h6 class="msg-header-title">
                                                <span class="msg-count">0</span>
                                                Notifications
                                            </h6>
                                            <p class="msg-header-subtitle">
                                                Notifications sur {{ config('app.name') }}.
                                            </p>
                                        </div>
                                    </a>
                                    @livewire('AdminNotifications')
                                </div>
                            </li>
                            {{--   <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
                                <a class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                    href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                    aria-expanded="false">
                                    <span class="position-relative">
                                        <i class="ti ti-bell ti-md"></i>
                                        <span
                                            class="badge rounded-pill bg-danger badge-dot badge-notifications border "></span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end p-0">
                                    <li class="dropdown-menu-header border-bottom">
                                        <div class="dropdown-header d-flex align-items-center py-3">
                                            <h6 class="mb-0 me-auto">Notification</h6>
                                            <div class="d-flex align-items-center h6 mb-0">
                                                <span class="badge bg-label-primary me-2 msg-count">00</span>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-text-secondary rounded-pill btn-icon dropdown-notifications-all"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Mark all as read"><i
                                                        class="ti ti-mail-opened text-heading"></i>
                                                    <span class="msg-count">
                                                        0
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dropdown-notifications-list scrollable-container">
                                        <ul class="list-group list-group-flush">
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <img src="../../assets/img/avatars/1.png" alt
                                                                class="rounded-circle" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="small mb-1">Congratulation Lettie 🎉</h6>
                                                        <small class="mb-1 d-block text-body">Won the monthly best
                                                            seller gold badge</small>
                                                        <small class="text-muted">1h ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>
                                    </li>
                                    <li class="border-top">
                                        <div class="d-grid p-4">
                                            <a class="btn btn-primary btn-sm d-flex" href="javascript:void(0);">
                                                <small class="align-middle">View all notifications</small>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li> --}}
                            <!--/ Notification -->

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        {{--  <img src="../../assets/img/avatars/1.png" alt class="rounded-circle" /> --}}
                                        {{--    <img src="{{ asset('assets/avatars/' . Auth::user()->avatar) }}" alt
                                            class="rounded-circle"> --}}
                                        <img src="{{ asset('public/avatars/' . Auth::user()->avatar) }}" alt
                                            class="rounded-circle">
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item mt-0" href="pages-account-settings-account.html">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <div class="avatar avatar-online">
                                                        {{--  <img src="../../assets/img/avatars/1.png" alt
                                                            class="rounded-circle" /> --}}
                                                        <img src="{{ asset('public/avatars/' . Auth::user()->avatar) }}"
                                                            alt class="rounded-circle">

                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0">{{ Auth::user()->nom }}</h6>
                                                    <small class="text-muted">{{ Auth::user()->role }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider my-1 mx-n2"></div>
                                    </li>
                                    <a class="dropdown-item {{ request()->routeIs('home') ? 'active' : '' }}"
                                        href="{{ route('home') }}">
                                        <i class="ti ti-home me-3 ti-md"></i>
                                        <span>Accueil</span>
                                    </a>
                                    <li>
                                        <a class="dropdown-item"href="{{ route('parametres') }}">
                                            <i class="ti ti-settings me-3 ti-md"></i><span
                                                class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                                            {{--  <i class="ti ti-settings me-3 ti-md"></i> --}}
                                            <i class="menu-icon tf-icons ti ti-smart-home"></i>
                                            <span>Dashboard</span>
                                        </a>
                                    </li>



                                    <li>
                                        <div class="dropdown-divider my-1 mx-n2"></div>
                                    </li>

                                    <li>
                                        <div class="d-grid px-2 pt-2 pb-1">
                                            {{-- <a class="btn btn-sm btn-danger d-flex"href="{{ route('logout') }}"
                                                target="_blank">
                                                <small class="align-middle">Logout</small>
                                                <i class="ti ti-logout ms-2 ti-14px"></i>
                                            </a> --}}
                                            <a class="btn btn-sm btn-danger d-flex" href="{{ route('logout') }}"
                                                target="_blank"
                                                onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                                                <small class="align-middle">Logout</small>
                                                <i class="ti ti-logout ms-2 ti-14px"></i>
                                            </a>
                                            {{-- <a class="nav-link" href="{{ route('dashboard') }}">Dashboad</a> --}}
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>

                    <!-- Search Small Screens -->
                    <div class="navbar-search-wrapper search-input-wrapper d-none">
                        <input type="text" class="form-control search-input container-xxl border-0"
                            placeholder="Search..." aria-label="Search..." />
                        <i class="ti ti-x search-toggler cursor-pointer"></i>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="page-wrapper">

                        @yield('body')


                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div
                                class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                                <div class="text-body">
                                    <p class="mb-0">@ {{ date('Y') }} | Developed By :
                                        <a href="#" target="_blank" style="color: #20ee0d !important;">
                                            <strong>
                                                TURBOSOFT
                                            </strong>
                                        </a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="/../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/../../assets/vendor/libs/popper/popper.js"></script>
    <script src="/../../assets/vendor/js/bootstrap.js"></script>
    <script src="/../../assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="/../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/../../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="/../../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="/../../assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="/../../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="/../../assets/vendor/libs/moment/moment.js"></script>
    <script src="/../../assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="/../../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="/../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="/../../assets/js/app-academy-dashboard.js"></script>


    @stack('scripts')

    <script>
        @if (session('error'))
            <
            script >
                Swal.fire({
                    icon: 'error',
                    title: 'Accès refusé',
                    text: "{{ session('error') }}",
                });
    </script>
    @endif

    </script>

    @if (auth()->user()->is_admin)
        <script>
            function sendMarkRequest(id = null) {
                return $.ajax("{{ route('markNotification') }}", {
                    method: 'POST',
                    data: {
                        _token,
                        id
                    }
                });
            }
            $(function() {
                $('.mark-as-read').click(function() {
                    let request = sendMarkRequest($(this).data('id'));
                    request.done(() => {
                        $(this).parents('div.alert').remove();
                    });
                });
                $('#mark-all').click(function() {
                    let request = sendMarkRequest();
                    request.done(() => {
                        $('div.alert').remove();
                    })
                });
            });
        </script>
    @endif
</body>

</html>
