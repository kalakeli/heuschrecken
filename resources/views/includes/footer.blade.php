<!-- Footer -->
<footer class="footer mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-end">
                <small>
                    <a href="dsgvo">
                        Datenschutz
                        <sup class="icon anchor"></sup>
                    </a>
                    &nbsp;&nbsp; | &nbsp;&nbsp;
                    <a href="impressum">
                        Impressum 
                        <sup class="icon anchor"></sup>
                    </a>
                    &nbsp;&nbsp; | &nbsp;&nbsp;
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                    <a  href="{{ route('login') }}">{{ __('Login') }}</a>
                            @endif
                            @if (Route::has('register'))
                                    <!-- &nbsp;&nbsp; | &nbsp;&nbsp; -->
                                    <!-- <a  href="{{ route('register') }}">{{ __('Register') }}</a> -->
                            @endif
                        @else
                            {{ Auth::user()->name }}
                            &nbsp;&nbsp; 
                                <a href="{{ route('logout') }}"
                                    title="abmelden"
                                    class="nosign btn btn-sm btn-danger"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="nav-icon fa fa-power-off"></i>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </a>
                        @endguest  
                </small>
            </div>            
        </div>
        <div class="row">
            <div class="col-12 text-end">
                <small>
                    <small>
                        Laravel {{ Illuminate\Foundation\Application::VERSION }} &nbsp;&nbsp; | &nbsp;&nbsp; PHP {{ PHP_VERSION }}
                    </small>                    
                </small>
            </div>
        </div>
    </div>
</footer>