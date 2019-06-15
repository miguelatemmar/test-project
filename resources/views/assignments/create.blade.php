@extends('layout')
@section('title', 'Opdrachten')
@section('content')

    <h1>Maak een opdracht aan</h1>

    <form method="POST" action={{ url("/assignments") }}>

        {{ csrf_field() }}

        <div class="form-group">
            <label for="naamInput">Naam:</label>
            <input type="text" class="form-control" id="naamInput" name="naamInput" required>
        </div>

        <div class="form-group">
            <label for="beschrijvingTextArea">Beschrijving</label>
            <textarea class="form-control" id="beschrijvingTextArea"
                      name="beschrijvingTextArea" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="form-control btn btn-primary mb-2">Toevoegen</button>
        </div>
        <a href="{{URL::to("/assignments/")}}">
            <button type="button" class="btn btn-secondary">Terug</button></a>
    </form>

@endsection