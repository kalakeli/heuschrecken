@extends('layouts.app')

@section('title', 'Projekte')

@section('content')
  <div class="container">
      <div class="row">
          <div class="col-12">
            <h1 class="headline">
                Projekte 
                <sup>
                  <a href="./projekte" class="hint--bottom hint--rounded" data-hint="gesamte Projektliste anzeigen">
                    <button type="button" class="btn btn-sm btn-light">
                          <span class="icon list"></span>
                    </button>                      
                  </a>                
                </sup>
              </h1>
          </div>
      </div>
    <router-view></router-view>
  </div>
@endsection
