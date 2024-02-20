@extends('layouts.app')

@section('title', 'Projects')

@section('content')
  <div class="container">
      <div class="row">
          <div class="col-12">
            <h1 class="headline">
                Projects 
                <sup>
                  <a href="./projekte" class="hint--bottom hint--rounded" data-hint="show all projects">
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
