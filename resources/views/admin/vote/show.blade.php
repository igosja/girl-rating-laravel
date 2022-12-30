<?php
declare(strict_types=1);

/**
 * @var \App\Models\Vote $vote
 */

?>
@extends('admin.layouts.layout')

@section('content')
    <h1 class="text-center">#{{ $vote->id }}</h1>
    <ul class="list-inline text-center">
        <li class="list-inline-item">
            <a class="btn btn-default" href="{{ route('votes.index') }}">List</a>
        </li>
    </ul>
    <div class="row">
        <table class="table table-striped table-bordered detail-view">
            <tbody>
            <tr>
                <th>Id</th>
                <td>{{ $vote->id }}</td>
            </tr>
            <tr>
                <th>Girl One</th>
                <td>{{ $vote->girlOne()->first()->name }}</td>
            </tr>
            <tr>
                <th>Girl Two</th>
                <td>{{ $vote->girlTwo()->first()->name }}</td>
            </tr>
            <tr>
                <th>Girl Winner</th>
                <td>{{ $vote->girl_winner_id ? $vote->girlWinner()->first()->name : '' }}</td>
            </tr>
            <tr>
                <th>Created at</th>
                <td>{{ $vote->created_at }}</td>
            </tr>
            <tr>
                <th>Updated at</th>
                <td>{{ $vote->updated_at }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
