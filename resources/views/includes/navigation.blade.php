<div class="custom-navbar" >
  
     <navigation></navigation> <!-- nur Menüfelder -->


    @if (Auth::check())
      <li class="nav-item {{ Request::is('cms*') ? 'active-item' : '' }} " >
        <a class="nav-link" href="cms">CMS</a>
      </li>
    @endguest 



  <mobile-nav></mobile-nav>

  <button class="btn btn-dark btn-sm topbar-icon" onclick="shMobileNav()">
      <i class="fa-solid fa-bars"></i>
      <!-- <i class="fa-solid fa-x"></i> -->
  </button>    
</div>
