<div>

    <header id="header" class="header ">
        <div class="header-wrapper">
            <div id="masthead" class="header-main hide-for-sticky nav-dark">
                <div class="header-inner flex-row container logo-left medium-logo-center" role="navigation">

                    <!-- Logo -->
                    <div id="logo" class="flex-col logo">

                        <!-- Header logo -->
                        <a href="{{ route('home') }}" title="TTPGLOBAL " rel="home">
                            <img width="1200" height="1200"
                                src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201200%201200'%3E%3C/svg%3E"
                                class="header_logo header-logo" alt="TTPGLOBAL "
                                data-lazy-src="/assets/logo123123-removebg-preview-removebg-preview.png" /><noscript><img
                                    width="1200" height="1200"
                                    src="/assets/logo123123-removebg-preview-removebg-preview.png"
                                    class="header_logo header-logo" alt="TTPGLOBAL " /></noscript><img
                                width="1200" height="1200"
                                src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201200%201200'%3E%3C/svg%3E"
                                class="header-logo-dark" alt="TTPGLOBAL "
                                data-lazy-src="/assets/logo123123-removebg-preview-removebg-preview.png" /><noscript><img
                                    width="1200" height="1200"
                                    src="/assets/logo123123-removebg-preview-removebg-preview.png"
                                    class="header-logo-dark" alt="TTPGLOBAL " /></noscript></a>
                    </div>

                    <!-- Mobile Left Elements -->
                    <div class="flex-col show-for-medium flex-left">
                        <ul class="mobile-nav nav nav-left ">
                            <li class="nav-icon has-icon">
                                <a href="#" data-open="#main-menu" data-pos="left"
                                    data-bg="main-menu-overlay" data-color="" class="is-small"
                                    aria-label="Menu" aria-controls="main-menu" aria-expanded="false">

                                    <i class="icon-menu"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Left Elements -->
                    <div class="flex-col hide-for-medium flex-left
        flex-grow">
        <ul class="header-nav header-nav-main nav nav-left nav-spacing-large nav-uppercase">
            <li class="html custom html_topbar_left">
                <h1 class="header-title">Công Ty TNHH Phân Bón Quốc Tế</h1>
                <h2 class="header-subtitle">Rồng Xanh</h2>
            </li>
        </ul>
        <style>
            #logo {
    width: 168px !important;
}
            .header-title {
    margin: 0;
    color: rgb(0, 0, 0); /* Màu xanh lá */

}

.header-subtitle {
    margin: 0;
    font-size: 2.4rem; /* Tăng kích thước chữ */
    color: #1a622b; /* Màu xanh lá */
    font-weight: bolder;
}
        </style>
                    </div>

                    <!-- Right Elements -->
                    <div class="flex-col hide-for-medium flex-right">
                        <ul class="header-nav header-nav-main nav nav-right  nav-spacing-large nav-uppercase">
                            <li class="html custom html_top_right_text"><img width="280" height="70"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20280%2070'%3E%3C/svg%3E"
                                    data-lazy-src="/assets/12123124123.png"><noscript><img
                                        width="280" height="70"
                                        src="/assets/12123124123.png"></noscript>
                            </li>
                        </ul>
                    </div>

                    <!-- Mobile Right Elements -->
                    <div class="flex-col show-for-medium flex-right">
                        <ul class="mobile-nav nav nav-right ">
                            <li class="cart-item has-icon">

                                <a href="https://ttpglobal.com.vn/cart-2/"
                                    class="header-cart-link off-canvas-toggle nav-top-link is-small"
                                    data-open="#cart-popup" data-class="off-canvas-cart" title="Giỏ hàng"
                                    data-pos="right">

                                    <span class="cart-icon image-icon">
                                        <strong>0</strong>
                                    </span>
                                </a>


                                <!-- Cart Sidebar Popup -->
                                <div id="cart-popup" class="mfp-hide widget_shopping_cart">
                                    <div class="cart-popup-inner inner-padding">
                                        <div class="cart-popup-title text-center">
                                            <h4 class="uppercase">Giỏ hàng</h4>
                                            <div class="is-divider"></div>
                                        </div>
                                        <div class="widget_shopping_cart_content">


                                            <p class="woocommerce-mini-cart__empty-message">Chưa có sản phẩm trong
                                                giỏ hàng.</p>


                                        </div>
                                        <div class="cart-sidebar-content relative"></div>
                                    </div>
                                </div>

                            </li>
                        </ul>
                    </div>
                </div>

                <div class="container">
                    <div class="inner">&nbsp;</div>
                    <div class="top-divider full-width"></div>

                </div>
            </div>
            <div id="wide-nav"
                class="header-bottom wide-nav hide-for-sticky nav-dark flex-has-center hide-for-medium">
                <div class="flex-row container">


                    <div class="flex-col hide-for-medium flex-center">
                        <ul class="nav header-nav header-bottom-nav nav-center nav-line-bottom nav-size-medium nav-spacing-xlarge nav-uppercase">
                            <li id="menu-item-3697" class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
                                <a href="{{ route('home') }}" aria-current="page" class="nav-top-link">TRANG CHỦ</a>
                            </li>
                            <li id="menu-item-6877" class="menu-item {{ request()->routeIs('product.list') || request()->routeIs('product.detail') ? 'active' : '' }}">
                                <a href="{{ route('product.list') }}" class="nav-top-link">SẢN PHẨM</a>
                            </li>
                            <li id="menu-item-368" class="menu-item {{ request()->routeIs('news') ? 'active' : '' }}">
                                <a href="{{ route('news') }}" class="nav-top-link">KIẾN THỨC NHÀ NÔNG</a>
                            </li>
                            <li id="menu-item-351" class="menu-item {{ request()->routeIs('about') ? 'active' : '' }}">
                                <a href="{{ route('about') }}" class="nav-top-link">GIỚI THIỆU</a>
                            </li>
                            <li style="position:relative;" class="menu-item menu-item-gtranslate gt-menu-24719">
                            </li>
                        </ul>
                    </div>



                </div>
            </div>

            <div class="header-bg-container fill">
                <div class="header-bg-image fill"></div>
                <div class="header-bg-color fill"></div>
            </div>
        </div>
    </header>

    <div id="main-menu" class="mobile-sidebar no-scrollbar mfp-hide">
        <div class="sidebar-menu no-scrollbar">
            <ul class="nav nav-sidebar nav-vertical nav-uppercase" data-tab="1">
                <li class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" aria-current="page">TRANG CHỦ</a>
                </li>
                <li class="menu-item {{ request()->routeIs('product.list') || request()->routeIs('product.detail') ? 'active' : '' }}">
                    <a href="{{ route('product.list') }}">SẢN PHẨM</a>
                </li>
                <li class="menu-item {{ request()->routeIs('news') ? 'active' : '' }}">
                    <a href="{{ route('news') }}">KIẾN THỨC NHÀ NÔNG</a>
                </li>
                <li class="menu-item {{ request()->routeIs('about') ? 'active' : '' }}">
                    <a href="{{ route('about') }}">GIỚI THIỆU</a>
                </li>
            </ul>
        </div>
    </div>
</div>
