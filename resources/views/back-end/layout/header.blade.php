<header class="c-header c-header-light c-header-fixed c-header-with-subheader">
    <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
        <span class="c-header-toggler-icon"></span>
    </button>
    <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button>
    <ul class="c-header-nav d-md-down-none">
        <li class="c-header-nav-item px-3"><a class="c-header-nav-link" id="grin"><i class="far fa-grin-beam fa-lg fa-fw"></i>&nbsp;<span id="hi-">Hi ~ {{Auth::user()->name}}</span></a></li>
    </ul>
    <ul class="c-header-nav mfs-auto">
        <li class="c-header-nav-item px-3">
            <button class="c-class-toggler c-header-nav-btn" type="button" id="header-tooltip" data-target="body" data-class="c-dark-theme" data-toggle="c-tooltip" data-placement="bottom" title="" data-original-title="Toggle Light/Dark Mode">
            <i class="c-icon fas fa-adjust"></i>
            </button>
        </li>
    </ul>
    @php
        $test = DB::raw('DATE(created)');
    @endphp
    <ul class="c-header-nav ">
        <li class="c-header-nav-item dropdown">
              <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                  <div class="c-avatar"><img class="c-avatar-img" src="back-end/image/ex.png" alt="user@email.com"></div><br>
                  
              </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2 dark:bg-white dark:bg-opacity-10">
                    <div class="fw-semibold">Settings</div>
                    
                </div>
                <a class="dropdown-item" href="/webpanel/users/profile"><i class="fas fa-user fa-fw"></i> Profile</a>
                <a class="dropdown-item" href="/webpanel/users/change-password"><i class="fas fa-key fa-fw"></i> Change Password</a>
                <div class="dropdown-divider"></div>
                
                <a class="dropdown-item" href="/webpanel/logout"><i class="fas fa-sign-out-alt fa-fw"></i> Logout</a>
            </div>
        </li>
        <li class="c-header-nav-item d-md-down-none mx-2"></li>
    </ul>
</header>
<!-- Overlay Projects -->
<div class="Overlay">
    <img src="<?php echo url('/') ?>/img/loading.gif" class="ImgLoading">
</div>
<style>
    .Overlay {
	    position: fixed;
	    min-width: 100%;
	    min-height: 100%;
	    width: 100%;
	    background: rgba(0, 0, 0, 0.21);
	    z-index: 2500;
	    display: none;
	    top: 0px;
	    margin-left: 0px;
	}
    .ImgLoading {
	    display: block;
	    position: absolute;
	    top: 40%;
	    left: 45%;
	    width: 3em;
	    height: 3em;
	}
    .AClass{
        right:4px;
        position: absolute;
    }
</style>
<script>
    function OpenLoading() {
        $('.Overlay').delay(5).fadeIn();
    }
    function CloseLoading() {
        $('.Overlay').delay(10).fadeOut();
    }
    const grin = document.getElementById('grin');
    grin.onmouseover = function(e){
        let b = this;
        b.style.color = 'rgb(219,0,77)';
        b.children[0].classList.toggle('fa-grin-hearts','fa-grin-beam');
    }
    grin.onmouseout = function(e){
        let c = this;
        c.style.color = null;
        c.children[0].classList.remove('fa-grin-hearts');
    }

</script>