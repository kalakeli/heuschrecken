@extends('layouts.app')

@section('title', 'Fehler')

@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  text-danger">
        <h1 style="text-center">Ups! Entschuldigen Sie, aber ...</h1>
        <p>... die angegebene Adresse hat keinen Inhalt. Bitte überprüfen Sie 
          die Angaben in der Adresszeile des Browsers. 
        </p>
      </div>
    </div>
  </div>
@endsection
