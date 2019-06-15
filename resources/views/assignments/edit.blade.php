<!-- assignments.blade.php -->
@extends('layout')
@section('title', 'Assignments')
@section('content')

    <h1>{{ $assignment->naam }} bewerken </h1>
    <small>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to("/assignments/")}}">Opdrachten</a></li>
                <li class="breadcrumb-item active" aria-current="page">Bewerken</li>
            </ol>
        </nav>
    </small>
    <hr class="sub">
    <form method="POST" class="form-horizontal" action="{{ URL("/assignments/$assignment->id") }}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <div class="form-group">
            <div class="row">
                <div class="col"><label class="col-form-label"><strong>Naam:</strong></label></div>
                <div class="col col-md-9">
                    <input type="text" class="form-control" id="naamInput"
                           name="naamInput" value="{{ $assignment->naam }}">
                </div>
            </div>
            <div class="row">
                <div class="col"><label class="col-form-label"><strong>Beschrijving:</strong></label></div>
                <div class="col col-md-9">
                    <textarea class="form-control" id="beschrijvingTextArea"
                              name="beschrijvingTextArea" rows="8">{{ $assignment->beschrijving }}</textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="form-control btn btn-primary mb-2">Bewerken</button>
        </div>


        <a href="{{URL::to("/assignments/")}}">
            <button type="button" class="btn btn-secondary">Terug</button></a>

        <a href="{{URL::to("assignments/" . $assignment->id)}}">
            <button type="button" class="btn btn-light">Details</button></a>

    </form>
@endsection