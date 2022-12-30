<?php
declare(strict_types=1);

/**
 * @var \App\Models\Girl $girl
 */

?>
@extends('admin.layouts.layout')

@section('content')
    <h1 class="text-center">Update girl</h1>
    <ul class="list-inline text-center">
        <li class="list-inline-item">
            <a class="btn btn-default" href="{{ route('girls.index') }}">List</a>
        </li>
        <li class="list-inline-item">
            <a class="btn btn-default" href="{{ route('girls.show', ['girl' => $girl]) }}">View</a>
        </li>
    </ul>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form method="POST" action="{{ route('girls.update', ['girl' => $girl]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3 required">
                    <label class="form-label" for="name">Name</label>
                    <input id="name" class="form-control @error('name') is-invalid @enderror" name="name"
                           value="{{ old('name', $girl->name) }}"/>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @if (file_exists($girl->getFilePath()))
                <div class="mb-3 required">
                    <div class="col-md-6">
                        <img src="{{ $girl->getFileUrl() }}" alt="image" class="img-fluid">
                    </div>
                </div>
                @endif
                <div class="mb-3 required">
                    <label class="form-label" for="image">Image</label>
                    <input
                        id="image"
                        class="form-control @error('imageFile') is-invalid @enderror"
                        name="image"
                        type="file"
                    />
                    @error('imageFile')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                        <button type="submit" class="btn btn-default">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
