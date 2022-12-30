<?php
declare(strict_types=1);

/**
 * @var App\Models\Vote $vote
 */
?>
@extends('layouts.layout')

@section('content')

    <div class="row text-center">
        <div class="col-lg-12">
            <h1>Vote #{{ $vote->id }}</h1>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-lg-5 col-md-6 offset-lg-1">
            <a href="{{ route('vote_vote', ['girl' => $vote->girlOne()->first(), 'vote' => $vote]) }}">
                <img
                    alt="{{ $vote->girlOne()->first()->name }}"
                    class="img-fluid img-thumbnail"
                    src="{{ $vote->girlOne()->first()->getFileUrl() }}
                    "/>
            </a>
            <h3>{{ $vote->girlOne()->first()->name }}</h3>
        </div>
        <div class="col-lg-5 col-md-6">
            <a href="{{ route('vote_vote', ['girl' => $vote->girlTwo()->first(), 'vote' => $vote]) }}">
                <img
                    alt="{{ $vote->girlTwo()->first()->name }}"
                    class="img-fluid img-thumbnail"
                    src="{{ $vote->girlTwo()->first()->getFileUrl() }}
                    "/>
            </a>
            <h3>{{ $vote->girlTwo()->first()->name }}</h3>
        </div>
    </div>

@endsection
