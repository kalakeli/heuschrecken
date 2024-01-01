@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} <br>
                    Oben rechts im Menü ist jetzt ein Punkt &bdquo;<a href="cms">CMS</a>&ldquo; hinzugekommen. 
                    Sie können auch einfach die <a href="./">Startseite aufrufen</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
