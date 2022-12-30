<?php
declare(strict_types=1);

/**
 * @var \App\Models\Girl $girl
 */

?>
@extends('admin.layouts.layout')

@section('content')
    <h1 class="text-center">{{ $girl->name }}</h1>
    <ul class="list-inline text-center">
        <li class="list-inline-item">
            <a class="btn btn-default" href="{{ route('girls.index') }}">List</a>
        </li>
        <li class="list-inline-item">
            <a class="btn btn-default" href="{{ route('girls.edit', ['girl' => $girl]) }}">Update</a>
        </li>
        <li class="list-inline-item">
            <form action="{{ route('girls.destroy', ['girl' => $girl]) }}" method="POST">
                @csrf
                @method('DELETE')
                <a class="btn btn-default" href="javascript:" onclick="$(this).closest('form').submit()">Delete</a>
            </form>
        </li>
    </ul>
    <div class="row">
        <table class="table table-striped table-bordered detail-view">
            <tbody>
            <tr>
                <th>Id</th>
                <td>{{ $girl->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $girl->name }}</td>
            </tr>
            <tr>
                <th>Image</th>
                <td>
                    @if ($girl->getFileUrl())
                        <img alt="img" src="{{ $girl->getFileUrl() }}" class="img-fluid">
                    @endif
                </td>
            </tr>
            <tr>
                <th>Rating</th>
                <td>{{ $girl->rating }}</td>
            </tr>
            <tr>
                <th>Votes</th>
                <td>{{ $girl->votes }}</td>
            </tr>
            <tr>
                <th>Created by</th>
                <td>{{ $girl->createdBy()->first()->name }}</td>
            </tr>
            <tr>
                <th>Created at</th>
                <td>{{ $girl->created_at }}</td>
            </tr>
            <tr>
                <th>Updated at</th>
                <td>{{ $girl->updated_at }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
