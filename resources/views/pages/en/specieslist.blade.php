@extends('layouts.app')

@section('title', 'species list')

@section('content')
<div class="container-fluid">
      <div class="row">
          <div class="col-12">
              <h1 class="headline">
                Check list 
                <sup>
                  <a href="./artenliste" class="hint--bottom hint--rounded" data-hint="gesamte Artenliste anzeigen">
                    <button type="button" class="btn btn-sm btn-light">
                          <i class="fa-solid fa-rotate"></i>
                    </button>                      
                  </a>                
                </sup>
              </h1>
          </div>
      </div>
    <router-view></router-view>
  </div>
@endsection
