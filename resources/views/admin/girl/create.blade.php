<?php
declare(strict_types=1);
?>
@extends('admin.layouts.layout')

@section('content')
    <h1 class="text-center">Create girl</h1>
    <ul class="list-inline text-center">
        <li class="list-inline-item">
            <a class="btn btn-default" href="{{ route('girls.index') }}">List</a>
        </li>
    </ul>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form method="POST" action="{{ route('girls.store') }}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="mb-3 required">
                    <label class="form-label" for="name">Name</label>
                    <input id="name" class="form-control @error('name') is-invalid @enderror" name="name"
                           value="{{ old('name') }}"/>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
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
