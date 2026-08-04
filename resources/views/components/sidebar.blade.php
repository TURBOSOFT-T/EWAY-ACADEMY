@php
$config = DB::table('configs')->first();
$service = DB::table('services')->get();
$produit = DB::table('produits')->get();
@endphp
<!-- Start sidebar widget content -->
<div class="xs-sidebar-group info-group info-sidebar">
    <div class="xs-overlay xs-bg-black"></div>
    <div class="xs-sidebar-widget">
        <div class="sidebar-widget-container">
            <div class="widget-heading">
                <a href="#" class="close-side-widget">X</a>
            </div>
            <div class="sidebar-textwidget">
                <div class="sidebar-info-contents">
                    <div class="content-inner">
                        <div class="logo">
                            <a href="{{ url('/') }}">
                                <img   src="{{ Storage::url($config->logo) }}" class="logo-small" alt="Logo" />
                            </a>
                        </div>
                        <div class="content-box">
                            <h4>{{ __('About Us') }}</h4>
                            <p>{!! $config->description !!}</p>
                        </div>
                        <div class="form-inner">
                            <h4>{{ __('Get a free quote') }}</h4>
                            <form action="/front/assets/inc/sendemail.php" class="contact-form-validated" novalidate="novalidate" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="{{ __('Name') }}" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="{{ __('Email') }}" required>
                                </div>
                                <div class="form-group">
                                    <textarea name="message" placeholder="{{ __('Message...') }}"></textarea>
                                </div>
                                <div class="form-group message-btn">
                                    <button type="submit" class="thm-btn form-inner__btn">{{ __('Submit Now') }}</button>
                                </div>
                            </form>
                            <div class="result"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End sidebar widget content -->