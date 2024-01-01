<div class="custom-navbar" >
  <h4 class="text-white float-start mx-3 pt-2" id="topbar-title">Die Heuschrecken Deutschlands</h4>
  <ul class="nav justify-content-end topbar-ul" id="myNav">
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="orthopteraweb">OrthopteraWeb</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="projekte">Projekte</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="methodik">Methodik</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="artenliste">Arten</a>
    </li>

    @if (Auth::check())
      <li class="nav-item" >
        <a class="nav-cms" href="cms">CMS</a>
      </li>
    @endguest 
  </ul>

  <mobile-nav></mobile-nav>

  <button class="btn btn-dark btn-sm topbar-icon" onclick="shMobileNav()">
      <i class="fa-solid fa-bars"></i>
      <!-- <i class="fa-solid fa-x"></i> -->
  </button>    
</div>
