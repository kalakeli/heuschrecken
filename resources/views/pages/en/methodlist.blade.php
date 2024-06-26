@extends('layouts.app')

@section('title', 'Methods')

@section('content')
  <div class="container">
      <div class="row">
          <div class="col-12">
            <h1 class="headline">
                Methods 
                <sup>
                  <a href="./methods" class="hint--bottom hint--rounded" data-hint="show all method entries">
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