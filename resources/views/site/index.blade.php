<?php
declare(strict_types=1);

/**
 * @var App\Models\Girl[] $girls
 */
?>
@extends('layouts.layout')

@section('content')

    <div class="row text-center">
        @foreach ($girls as $girl)
            <div class="col-lg-3 col-sm-6">
                <img class="img-fluid img-thumbnail"
                     src="{{ $girl->getFileUrl() }}"
                     alt="{{ $girl->name }}">
                <h3>{{ $girl->name }}</h3>
                <h6>{{ $girl->rating }}</h6>
            </div>
        @endforeach
    </div>

@endsection
