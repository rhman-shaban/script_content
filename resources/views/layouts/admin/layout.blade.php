@include('layouts.admin.header')
<body id="page-top" class="body_bg">
    @php
        $websiteLang=App\ManageText::all();
        $app_setting=App\Setting::first();
    @endphp

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="{{ $app_setting->dashbaord_header_icon }}"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{ $app_setting->dashboard_header }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Route::is('admin.dashboard')?'active':'' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>{{ $websiteLang->where('id',68)->first()->custom_text }}</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#listing-pages"
                    aria-expanded="true" aria-controls="listing-pages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span> {{ $websiteLang->where('id',56)->first()->custom_text }}</span>
                </a>
                <div id="listing-pages" class="collapse {{Route::is('admin.location.*') || Route::is('admin.listing-category.*') || Route::is('admin.listing.*') || Route::is('admin.aminity.*') || Route::is('admin.listing-package.*') || Route::is('admin.day.*') || Route::is('admin.my.listing') || Route::is('admin.pending.listing') || Route::is('admin.listing-review') || Route::is('admin.user') || Route::is('admin.user.show') || Route::is('admin.order') || Route::is('admin.order-show') || Route::is('admin.user.listing') || Route::is('admin.listing-claim') || Route::is('admin.pending-order') || Route::is('admin.pending-payment') ?'show':''}}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Route::is('admin.user.listing')?'active':'' }}" href="{{ route('admin.user.listing') }}">{{ $websiteLang->where('id',439)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.my.listing') || Route::is('admin.listing.*') ?'active':'' }}" href="{{ route('admin.my.listing') }}">{{ $websiteLang->where('id',368)->first()->custom_text }}</a>
                        <a class="collapse-item {{ Route::is('admin.pending.listing')?'active':'' }}" href="{{ route('admin.pending.listing') }}">{{ $websiteLang->where('id',369)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.listing-category.*')?'active':'' }}" href="{{ route('admin.listing-category.index') }}">{{ $websiteLang->where('id',51)->first()->custom_text }}</a>


                        <a class="collapse-item {{ Route::is('admin.location.*')?'active':'' }}" href="{{ route('admin.location.index') }}">{{ $websiteLang->where('id',360)->first()->custom_text }}</a>
                        <a class="collapse-item {{ Route::is('admin.aminity.*')?'active':'' }}" href="{{ route('admin.aminity.index') }}">{{ $websiteLang->where('id',355)->first()->custom_text }}</a>
                        <a class="collapse-item {{ Route::is('admin.listing-package.*')?'active':'' }}" href="{{ route('admin.listing-package.index') }}">{{ $websiteLang->where('id',86)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.listing-review')?'active':'' }}" href="{{ route('admin.listing-review') }}">{{ $websiteLang->where('id',334)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.user') ||  Route::is('admin.user.show')?'active':'' }}" href="{{ route('admin.user') }}">{{ $websiteLang->where('id',330)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.order') || Route::is('admin.order-show') ?'active':'' }}" href="{{ route('admin.order') }}">{{ $websiteLang->where('id',73)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.pending-order') || Route::is('admin.pending-payment') ?'active':'' }}" href="{{ route('admin.pending-order') }}">{{ $websiteLang->where('id',512)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.day.*') ?'active':'' }}" href="{{ route('admin.day.index') }}">{{ $websiteLang->where('id',132)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.listing-claim') ?'active':'' }}" href="{{ route('admin.listing-claim') }}">{{ $websiteLang->where('id',457)->first()->custom_text }}</a>







                    </div>
                </div>
            </li>



             <!-- Nav Item - Pages Collapse Menu -->
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>{{ $websiteLang->where('id',314)->first()->custom_text }}</span>
                </a>
                <div id="collapsePages" class="collapse {{
                Route::is('admin.about.index') || Route::is('admin.terms-privacy.index') || Route::is('admin.custom-page.*') || Route::is('admin.error-page.*')
                 ? 'show':'' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Route::is('admin.about.index')?'active':'' }}" href="{{ route('admin.about.index') }}">{{ $websiteLang->where('id',315)->first()->custom_text }}</a>
                        <a class="collapse-item {{ Route::is('admin.terms-privacy.index')?'active':'' }}" href="{{ route('admin.terms-privacy.index') }}">{{ $websiteLang->where('id',316)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.custom-page.*')?'active':'' }}" href="{{ route('admin.custom-page.index') }}">{{ $websiteLang->where('id',411)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.error-page.*')?'active':'' }}" href="{{ route('admin.error-page.index') }}">{{ $websiteLang->where('id',518)->first()->custom_text }}</a>



                    </div>
                </div>
            </li>



            <!-- Nav Item - Pages Collapse Menu -->
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#section-control"
                    aria-expanded="true" aria-controls="section-control">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>{{ $websiteLang->where('id',305)->first()->custom_text }}</span>
                </a>
                <div id="section-control" class="collapse {{Route::is('admin.about-section.*') || Route::is('admin.home-section.*') || Route::is('admin.package-section.*') || Route::is('admin.menu-section')
                 ? 'show':'' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Route::is('admin.about-section.*')?'active':'' }}" href="{{ route('admin.about-section.index') }}">{{ $websiteLang->where('id',306)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.menu-section')?'active':'' }}" href="{{ route('admin.menu-section') }}">{{ $websiteLang->where('id',308)->first()->custom_text }}</a>


                        <a class="collapse-item {{ Route::is('admin.home-section.*')?'active':'' }}" href="{{ route('admin.home-section.index') }}">{{ $websiteLang->where('id',277)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.package-section.*')?'active':'' }}" href="{{ route('admin.package-section.index') }}">{{ $websiteLang->where('id',307)->first()->custom_text }}</a>
                    </div>
                </div>
            </li>


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#home-section-2-pages"
                    aria-expanded="true" aria-controls="home-section-2-pages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>{{ $websiteLang->where('id',277)->first()->custom_text }}</span>
                </a>
                <div id="home-section-2-pages" class="collapse {{ Route::is('admin.feature.index') || Route::is('admin.banner.index') || Route::is('admin.overview.index') || Route::is('admin.overview.video') || Route::is('admin.partner.index') || Route::is('admin.testimonial.index') ? 'show': '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Route::is('admin.banner.index')?'active':'' }}" href="{{ route('admin.banner.index') }}">{{ $websiteLang->where('id',278)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.feature.index')?'active':'' }}" href="{{ route('admin.feature.index') }}">{{ $websiteLang->where('id',279)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.overview.index') || Route::is('admin.overview.video') ?'active':'' }}" href="{{ route('admin.overview.index') }}">{{ $websiteLang->where('id',280)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.testimonial.index') ?'active':'' }}" href="{{ route('admin.testimonial.index') }}">{{ $websiteLang->where('id',281)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.partner.index')?'active':'' }}" href="{{ route('admin.partner.index') }}">{{ $websiteLang->where('id',282)->first()->custom_text }}</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#page-setup-pages"
                    aria-expanded="true" aria-controls="page-setup-pages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>{{ $websiteLang->where('id',268)->first()->custom_text }}</span>
                </a>
                <div id="page-setup-pages" class="collapse {{
                    Route::is('admin.home-seo-setup') ||
                    Route::is('admin.listing-seo-setup') ||
                    Route::is('admin.about-us-seo-setup') ||
                    Route::is('admin.pricing-seo-setup') ||
                    Route::is('admin.listing-category-seo-setup') ||
                    Route::is('admin.blog-seo-setup') ||
                    Route::is('admin.contact-us-seo-setup') ? 'show':'' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Route::is('admin.home-seo-setup')?'active':'' }}" href="{{ route('admin.home-seo-setup',1) }}">{{ $websiteLang->where('id',269)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.listing-seo-setup')?'active':'' }}" href="{{ route('admin.listing-seo-setup',2) }}">{{ $websiteLang->where('id',270)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.about-us-seo-setup')?'active':'' }}" href="{{ route('admin.about-us-seo-setup',3) }}">{{ $websiteLang->where('id',271)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.pricing-seo-setup')?'active':'' }}" href="{{ route('admin.pricing-seo-setup',4) }}">{{ $websiteLang->where('id',272)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.listing-category-seo-setup')?'active':'' }}" href="{{ route('admin.listing-category-seo-setup',5) }}">{{ $websiteLang->where('id',273)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.blog-seo-setup')?'active':'' }}" href="{{ route('admin.blog-seo-setup',6) }}">{{ $websiteLang->where('id',274)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.contact-us-seo-setup')?'active':'' }}" href="{{ route('admin.contact-us-seo-setup',7) }}">{{ $websiteLang->where('id',275)->first()->custom_text }}</a>



                    </div>
                </div>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#website-setup-pages"
                    aria-expanded="true" aria-controls="website-setup-pages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>{{ $websiteLang->where('id',320)->first()->custom_text }}</span>
                </a>
                <div id="website-setup-pages" class="collapse {{
                    Route::is('admin.setup.text') || Route::is('admin.validation.errors') || Route::is('admin.notification.text') ? 'show':'' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <a class="collapse-item {{ Route::is('admin.setup.text')?'active':'' }}" href="{{ route('admin.setup.text') }}">{{ $websiteLang->where('id',321)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.validation.errors')?'active':'' }}" href="{{ route('admin.validation.errors') }}">{{ $websiteLang->where('id',322)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.notification.text')?'active':'' }}" href="{{ route('admin.notification.text') }}">{{ $websiteLang->where('id',323)->first()->custom_text }}</a>



                    </div>
                </div>
            </li>




            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#setting-pages"
                    aria-expanded="true" aria-controls="setting-pages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span> {{ $websiteLang->where('id',156)->first()->custom_text }}</span>
                </a>
                <div id="setting-pages" class="collapse {{
                Route::is('admin.settings.index') ||
                Route::is('admin.comment.setting') ||
                Route::is('admin.cookie.consent.setting') ||
                Route::is('admin.payment-account.index') ||
                Route::is('admin.captcha.setting') ||
                Route::is('admin.livechat.setting') ||
                Route::is('admin.preloader.setting') ||
                Route::is('admin.google.analytic.setting') ||
                Route::is('admin.theme-color') ||
                Route::is('admin.clear.database') ||
                Route::is('admin.banner.image') ||
                Route::is('admin.email.template') || Route::is('admin.email-edit') || Route::is('admin.email-configuration') || Route::is('admin.login.image') || Route::is('admin.profile.image') || Route::is('admin.bg.image') || Route::is('admin.paginator') ? 'show' :'' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Route::is('admin.settings.index')?'active':'' }}" href="{{ route('admin.settings.index') }}">{{ $websiteLang->where('id',157)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.comment.setting')?'active':'' }}" href="{{ route('admin.comment.setting') }}">{{ $websiteLang->where('id',158)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.cookie.consent.setting')?'active':'' }}" href="{{ route('admin.cookie.consent.setting') }}">{{ $websiteLang->where('id',159)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.payment-account.index')?'active':'' }}" href="{{ route('admin.payment-account.index') }}">{{ $websiteLang->where('id',160)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.captcha.setting')?'active':'' }}" href="{{ route('admin.captcha.setting') }}">{{ $websiteLang->where('id',161)->first()->custom_text }}</a>
                        <a class="collapse-item {{ Route::is('admin.livechat.setting')?'active':'' }}" href="{{ route('admin.livechat.setting') }}">{{ $websiteLang->where('id',162)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.google.analytic.setting')?'active':'' }}" href="{{ route('admin.google.analytic.setting') }}">{{ $websiteLang->where('id',164)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.paginator')?'active':'' }}" href="{{ route('admin.paginator') }}">{{ $websiteLang->where('id',423)->first()->custom_text }}</a>


                        <a class="collapse-item {{ Route::is('admin.clear.database')?'active':'' }}" href="{{ route('admin.clear.database') }}">{{ $websiteLang->where('id',166)->first()->custom_text }}</a>


                        <a class="collapse-item {{ Route::is('admin.theme-color')?'active':'' }}" href="{{ route('admin.theme-color') }}">{{ $websiteLang->where('id',499)->first()->custom_text }}</a>


                        <a class="collapse-item {{ Route::is('admin.email.template') || Route::is('admin.email-edit')?'active':'' }}" href="{{ route('admin.email.template') }}">{{ $websiteLang->where('id',167)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.email-configuration')?'active':'' }}" href="{{ route('admin.email-configuration') }}">{{ $websiteLang->where('id',447)->first()->custom_text }}</a>



                        <a class="collapse-item {{ Route::is('admin.banner.image')?'active':'' }}" href="{{ route('admin.banner.image') }}">{{ $websiteLang->where('id',168)->first()->custom_text }}</a>
                        <a class="collapse-item {{ Route::is('admin.login.image')?'active':'' }}" href="{{ route('admin.login.image') }}">{{ $websiteLang->where('id',169)->first()->custom_text }}</a>
                        <a class="collapse-item {{ Route::is('admin.profile.image')?'active':'' }}" href="{{ route('admin.profile.image') }}">{{ $websiteLang->where('id',170)->first()->custom_text }}</a>
                        <a class="collapse-item {{ Route::is('admin.bg.image')?'active':'' }}" href="{{ route('admin.bg.image') }}">{{ $websiteLang->where('id',171)->first()->custom_text }}</a>






                    </div>
                </div>
            </li>

            @php
                $admin=Auth::guard('admin')->user();
            @endphp
            @if ($admin->admin_type==1)
            <li class="nav-item {{ Route::is('admin.admin-list.*')?'active':'' }}">
                <a class="nav-link" href="{{ route('admin.admin-list.index') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>{{ $websiteLang->where('id',264)->first()->custom_text }}</span></a>
            </li>
            @endif

            <li class="nav-item {{ Route::is('admin.staff')?'active':'' }}">
                <a class="nav-link" href="{{ route('admin.staff') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>{{ $websiteLang->where('id',324)->first()->custom_text }}</span></a>
            </li>


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#blog-pages"
                    aria-expanded="true" aria-controls="blog-pages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>{{ $websiteLang->where('id',230)->first()->custom_text }}</span>
                </a>
                <div id="blog-pages" class="collapse {{ Route::is('admin.blog-comment') || Route::is('admin.blog-category.*') || Route::is('admin.blog.index') || Route::is('admin.blog.edit') || Route::is('admin.blog.create')  ? 'show': '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <a class="collapse-item {{ Route::is('admin.blog-category.*')?'active':'' }}" href="{{ route('admin.blog-category.index') }}">{{ $websiteLang->where('id',231)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.blog.index') || Route::is('admin.blog.create') || Route::is('admin.blog.edit') ? 'active':'' }}" href="{{ route('admin.blog.index') }}">{{ $websiteLang->where('id',230)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.blog-comment')?'active':'' }}" href="{{ route('admin.blog-comment') }}">{{ $websiteLang->where('id',232)->first()->custom_text }}</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#contact-2-pages"
                    aria-expanded="true" aria-controls="contact-2-pages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>{{ $websiteLang->where('id',244)->first()->custom_text }}</span>
                </a>
                <div id="contact-2-pages" class="collapse {{ Route::is('admin.contact.message') || Route::is('admin.contact-information.index') ? 'show': '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Route::is('admin.contact-information.index')?'active':'' }}" href="{{ route('admin.contact-information.index') }}">{{ $websiteLang->where('id',245)->first()->custom_text }}</a>
                        <a class="collapse-item {{ Route::is('admin.contact.message')?'active':'' }}" href="{{ route('admin.contact.message') }}">{{ $websiteLang->where('id',246)->first()->custom_text }}</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#subscriber-2-pages"
                    aria-expanded="true" aria-controls="subscriber-2-pages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>{{ $websiteLang->where('id',261)->first()->custom_text }}</span>
                </a>
                <div id="subscriber-2-pages" class="collapse {{ Route::is('admin.subscriber') || Route::is('admin.subscriber.email') ? 'show': '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Route::is('admin.subscriber')?'active':'' }}" href="{{ route('admin.subscriber') }}">{{ $websiteLang->where('id',261)->first()->custom_text }}</a>

                        <a class="collapse-item {{ Route::is('admin.subscriber.email')?'active':'' }}" href="{{ route('admin.subscriber.email') }}">{{ $websiteLang->where('id',262)->first()->custom_text }}</a>
                    </div>
                </div>
            </li>



















            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fas fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item no-arrow mx-1 pt-4">

                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">

                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @php
                                    $adminInfo=Auth::guard('admin')->user();
                                    $default_profile=App\BannerImage::find(15);
                                @endphp
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ ucfirst($adminInfo->name) }}</span>

                                <img class="img-profile rounded-circle"
                                    src="{{ $adminInfo->image ? asset($adminInfo->image) : asset($default_profile->image) }}">

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ $websiteLang->where('id',72)->first()->custom_text }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ $websiteLang->where('id',74)->first()->custom_text }}
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                   @yield('admin-content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->



        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

@include('layouts.admin.footer')
