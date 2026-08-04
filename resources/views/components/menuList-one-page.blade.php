

        <nav class="main-menu">
            <div class="main-menu__wrapper">
                <div class="main-menu__wrapper-inner">
                    <div class="main-menu__left">
                        <div class="main-menu__logo">
                            <a href="{{ url('/') }}"><img src="assets/images/resources/logo-1.png" alt=""></a>
                        </div>
                    </div>
                    <div class="main-menu__main-menu-box">
                        <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                        <ul class="main-menu__list one-page-scroll-menu">
                            <li class="dropdown scrollToLink">
                                <a href="#home">Home </a>
                                <ul>
                                    <li><a href="{{ url('/') }}">Home One</a></li>
                                    <li><a href="{{ route('index2') }}">Home Two</a></li>
                                    <li><a href="{{ route('index3') }}">Home Three</a></li>
                                    <li class="dropdown">
                                        <a href="#">Header Styles</a>
                                        <ul>
                                            <li><a href="{{ url('/') }}">Header One</a></li>
                                            <li><a href="{{ route('index2') }}">Header Two</a></li>
                                            <li><a href="{{ route('index3') }}">Header Three</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#">One Page Styles</a>
                                        <ul>
                                            <li><a href="{{ route('index-one-page') }}">One Page Styles One</a></li>
                                            <li><a href="{{ route('index2-one-page') }}">One Page Styles Two</a></li>
                                            <li><a href="{{ route('index3-one-page') }}">One Page Styles Three</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="scrollToLink">
                                <a href="#services">Services</a>
                            </li>
                            <li class="scrollToLink">
                                <a href="#about">About</a>
                            </li>
                            <li class="scrollToLink">
                                <a href="#team">Team</a>
                            </li>
                            <li class="scrollToLink">
                                <a href="#event">Event</a>
                            </li>
                            <li class="scrollToLink">
                                <a href="#blog">Blog</a>
                            </li>
                        </ul>
                    </div>
                    <div class="main-menu__right">
                        <div class="main-menu__cart-search-nav-sidebar-icon-and-btn-box">
                            <a href="#" class="main-menu__cart  icon-cart"></a>
                            <a href="#" class="main-menu__search search-toggler"><span
                                    class="icon-loupe"></span></a>
                            <div class="main-menu__nav-sidebar-icon">
                                <a class="navSidebar-button" href="#">
                                    <span class="icon-menu1"></span>
                                </a>
                            </div>
                        </div>
                        <div class="main-menu__btn-box">
                            <a href="{{ route('contact') }}" class="main-menu__btn thm-btn">Buy Ticket <span
                                    class="icon-arrow-right"></span> </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
 
