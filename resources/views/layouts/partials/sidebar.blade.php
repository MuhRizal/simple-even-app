    <style>
			body:not(.sidebar-mini) .sidebar-style-2 .sidebar-menu > li.active > a:before {
				background-color: #fb8c3b; }

			.main-sidebar .sidebar-menu li ul.dropdown-menu li a:hover {
				color: #fb8c3b;
				background-color: inherit; }

			.main-sidebar .sidebar-menu li ul.dropdown-menu li.active > a {
				color: #fb8c3b;
			}
		</style>
    <?php $boost_url=config('app.mysatisfactory_url');?>
		<div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
          <form class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
              <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            </ul>
          </form>

          <ul class="navbar-nav navbar-right">
            <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
			       <img width="30" class="rounded-circle mr-1" src="{{ Avatar::create(Auth::user()->name)->setShape('circle')->setBackground('#000000')->setForeground('#FFFFFF')->toBase64() }}" alt="{{ Auth::user()->name }}">
              <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div></a>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title"></div>
                <div class="dropdown-divider"></div>
                <a href="{{ url('/logout') }}" class="dropdown-item has-icon text-danger">
                  <i class="fas fa-sign-out-alt"></i> Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>

        <div class="main-sidebar">
          <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
              <a href="{{ url('/') }}">
                
              </a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
              <a href="{{ url('/') }}">
               
              </a>
            </div>
            <ul class="sidebar-menu">
			       <li class="menu-header"></li>
              <li class="{{ ('events' == $active) ? 'active' : '' }}"><a class="nav-link" href="{{ url('/events') }}"><i class="far fa-calendar"></i><span>Events</span></a></li>
            </ul>
          </aside>
        </div>
		<script>
  		if ($(".sidebar-menu").length > 0) {
  			let pathname_split = window.location.pathname.split('/');
  			$(".sidebar-menu li a").each(function () {

  				let this_url = $(this).attr('href');
  				let this_url_end = this_url.split('/').filter(Boolean).pop();

  				if (this_url_end.indexOf(pathname_split[1]) !== -1) {

  					$(this).closest('li').addClass('active')
  					let parent = $(this).closest('li').parent();
  					if (parent.prop('tagName') == 'UL') {
  						parent.css('display', 'block')
  					}

  				}
  			});
  		}
		</script>
