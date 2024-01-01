@extends('layouts.cms')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-dark" role="alert">
                    <button type="button" class="float-end btn-close" aria-label="Close" onclick="location.href='./../'"></button>
                    <a href="/home">Heuschrecken-Monitoring</a> - Content-Management-System (CMS)
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-6 mb-2">
                <router-link to="/cms/images">
                    <div class="d-grid gap-2">
                        <button class="btn btn-custom-orange">
                            <span class="icon more"></span> Bilder
                        </button>
                    </div>
                </router-link>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4 col-6 mb-2">
                <router-link to="/cms/projekte">
                    <div class="d-grid gap-2">
                        <button class="btn btn-custom-orange">
                            <span class="icon more"></span> Projekte
                        </button>
                    </div>
                </router-link>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4 col-6 mb-2">
                <router-link to="/cms/methodik">
                    <div class="d-grid gap-2">
                        <button class="btn btn-custom-orange">
                            <span class="icon more"></span> Methodik
                        </button>
                    </div>
                </router-link>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4 col-6 mb-2">
                <router-link to="/cms/arten">
                    <div class="d-grid gap-2">
                        <button class="btn btn-custom-orange">
                            <span class="icon more"></span> Artenliste
                        </button>
                    </div>
                </router-link>                    
            </div>
        </div>
      
        <div class="row">
            <div class="col-12">
                <router-view></router-view>
            </div>
        </div>
    </div>
@endsection
