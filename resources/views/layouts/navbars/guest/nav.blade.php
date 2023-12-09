<header class="{{ (Request::is('/') || Request::is('home')) ? '' : 'header1' }}" >
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg">
            <!-- Brand -->
            <a class="navbar-brand" href="">
                <img src="{{asset('assets/frontend/images/logo.png')}}" class="img-fluid"></a>
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="fa fa-bars"></span>
            </button>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
                <ul class="navbar-nav pull-right">
                    <li class="nav-item">
                        <a class="my-btn rounded-0" href="">{{ __('Home') }}</a>
                    </li>
                    <li class="dropdown submenu nav-item">
                        <a class="nav-link" href="">{{ __('About') }}</a>
                        <ul class="dropdown-menu about dropdown-content">
                            <li><a href="">{{ __('Careers') }}</a></li><hr>
                            <li><a href="">{{ __('Staff') }}</a></li>
                        </ul>
                    </li>						
                    <li class="nav-item">
                        <a class="nav-link" href="">{{ __('Services') }}</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="">{{ __('Bid Opportunities') }}</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="">{{ __('Bid Results') }}</a>
                    </li> 
                  
                    <li class="nav-item">
                      <a class="nav-link" href="">{{ __('Portfolio') }}</a>
                     
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link hover btn btn-sm preview contact_btn" href="">{{ __('Contact') }}</a>
                    </li> 
                </ul>
            </div> 
        </nav>
    </div>
</header>
@if(Request::is('/') || Request::is('home'))
<section class="slider as">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active slide1">
                <div class="carousel-caption  d-md-block">
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@if(Request::is('about-us'))
<section class="title_wrapper1 overlaycp text-center">
	<div class="container">
		<div class="row">
			<div class="col-sm-12"><h3 class="title_heading1">{{ __('ABOUT US') }}</h3></div>			
		</div>	
	</div>
</section>
@endif
