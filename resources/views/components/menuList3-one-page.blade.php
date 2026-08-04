

<nav class="main-menu main-menu-three">
    <div class="main-menu__wrapper">
        <div class="main-menu__wrapper-inner">
            <div class="main-menu__left">
                <div class="main-menu__logo">
                    <a href="{{ url('/') }}"><img src="assets/images/resources/logo-1.png" alt=""></a>
                </div>
            </div>
            <div class="main-menu__right">
                <div class="main-menu__main-menu-box">
                    <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                    <ul class="main-menu__list one-page-scroll-menu">
                        <li class="dropdown scrollToLink">
                            <a href="#home">Home </a>
                            <ul>
                                <li><a href="{{ url('/') }}">Home One</a></li>
                                <li><a href="#">Home Two</a></li>
                                <li><a href="#">Home Three</a></li>
                                <li class="dropdown">
                                    <a href="#">Header Styles</a>
                                    <ul>
                                        <li><a href="{{ url('/') }}">Header One</a></li>
                                        <li><a href="#">Header Two</a></li>
                                        <li><a href="#">Header Three</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#">One Page Styles</a>
                                    <ul>
                                        <li><a href="#">One Page Styles One</a></li>
                                        <li><a href="#">One Page Styles Two</a></li>
                                        <li><a href="#">One Page Styles Three</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="scrollToLink">
                            <a href="#services">Services</a>
                        </li>
                        <li class="scrollToLink">
                            <a href="#event">Event</a>
                        </li>
                        <li class="scrollToLink">
                            <a href="#team">Team</a>
                        </li>
                        <li class="scrollToLink">
                            <a href="#pricing">Pricing</a>
                        </li>
                        <li class="scrollToLink">
                            <a href="#blog">Blog</a>
                        </li>
                    </ul>
                </div>
                <div class="main-menu__btn-box">
                    <a href="#" class="main-menu__btn thm-btn">Buy Ticket <span
                            class="icon-arrow-right"></span> </a>
                </div>
            </div>
        </div>
    </div>
</nav>