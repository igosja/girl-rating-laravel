<?php
declare(strict_types=1);

/**
 * @var \App\Models\Vote[] $votes
 */

?>
@extends('admin.layouts.layout')

@section('content')
    <h1 class="text-center">Votes</h1>

    <div class="row">
        <div id="w0" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
            <div class="summary">
                Показані <b>
                    {{ ($votes->currentPage() - 1) * $votes->perPage() + 1 }}
                    -
                    @if($votes->currentPage() * $votes->perPage() < $votes->total())
                        {{ $votes->currentPage() * $votes->perPage() }}
                    @else
                        {{ $votes->total() }}
                    @endif
                </b> із <b>
                    {{ $votes->total() }}
                </b> записів.
            </div>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="col-lg-1">
                        <a
                            class="@if ('id' === app('request')->query('sort'))
                                    asc
                                @elseif ('-id' === app('request')->query('sort'))
                                    desc
                                @endif"
                            href="{{ route('votes.index', ['sort' => ('id' === app('request')->query('sort') ? '-id' : 'id')]) }}"
                        >
                            ID
                        </a>
                    </th>
                    <th>
                        <a
                            class="@if ('girl_one_id' === app('request')->query('sort'))
                                    asc
                                @elseif ('-girl_one_id' === app('request')->query('sort'))
                                    desc
                                @endif"
                            href="{{ route('votes.index', ['sort' => ('girl_one_id' === app('request')->query('sort') ? '-girl_one_id' : 'girl_one_id')]) }}"
                        >
                            Girl one
                        </a>
                    </th>
                    <th>
                        <a
                            class="@if ('girl_two_id' === app('request')->query('sort'))
                                    asc
                                @elseif ('-girl_two_id' === app('request')->query('sort'))
                                    desc
                                @endif"
                            href="{{ route('votes.index', ['sort' => ('girl_two_id' === app('request')->query('sort') ? '-girl_two_id' : 'girl_two_id')]) }}"
                        >
                            Girl two
                        </a>
                    </th>
                    <th>
                        <a
                            class="@if ('girl_winner_id' === app('request')->query('sort'))
                                    asc
                                @elseif ('-girl_winner_id' === app('request')->query('sort'))
                                    desc
                                @endif"
                            href="{{ route('votes.index', ['sort' => ('girl_winner_id' === app('request')->query('sort') ? '-girl_winner_id' : 'girl_winner_id')]) }}"
                        >
                            Girl winner
                        </a>
                    </th>
                    <th class="col-lg-1">&nbsp;</th>
                </tr>
                <tr class="filters" data-url="{{ route('votes.index') }}">
                    <td>
                        <label for="filter-id" style="display: none;"></label>
                        <input id="filter-id" type="text" class="form-control" name="id"
                               value="{{ app('request')->query('id') }}">
                    </td>
                    <td>
                        <label for="filter-girl_one_id" style="display: none;"></label>
                        <input id="filter-girl_one_id" type="text" class="form-control" name="girl_one_id"
                               value="{{ app('request')->query('girl_one_id') }}">
                    </td>
                    <td>
                        <label for="filter-girl_two_id" style="display: none;"></label>
                        <input id="filter-girl_two_id" type="text" class="form-control" name="girl_two_id"
                               value="{{ app('request')->query('girl_two_id') }}">
                    </td>
                    <td>
                        <label for="filter-girl_winner_id" style="display: none;"></label>
                        <input id="filter-girl_winner_id" type="text" class="form-control" name="girl_winner_id"
                               value="{{ app('request')->query('girl_winner_id') }}">
                    </td>
                    <td>&nbsp;</td>
                </tr>
                </thead>
                <tbody>
                @foreach ($votes as $vote)
                    <tr data-key="{{ $vote->id }}">
                        <td>{{ $vote->id }}</td>
                        <td>{{ $vote->girlOne()->first()->name }}</td>
                        <td>{{ $vote->girlTwo()->first()->name }}</td>
                        <td>{{ $vote->girl_winner_id ? $vote->girlWinner()->first()->name : '' }}</td>
                        <td class="text-center">
                            <a href="{{ route('votes.show', ['vote' => $vote]) }}" title="Переглянути"
                               aria-label="Переглянути" data-pjax="0">
                                <svg aria-hidden="true"
                                     style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1.125em"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path fill="currentColor"
                                          d="M573 241C518 136 411 64 288 64S58 136 3 241a32 32 0 000 30c55 105 162 177 285 177s230-72 285-177a32 32 0 000-30zM288 400a144 144 0 11144-144 144 144 0 01-144 144zm0-240a95 95 0 00-25 4 48 48 0 01-67 67 96 96 0 1092-71z"></path>
                                </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                <ul class="pagination">
                    <li class="page-item prev @if($votes->currentPage() - 1 < 1) disabled @endif">
                        <a class="page-link"
                           href="{{ route(Route::currentRouteName(), ['page' => $votes->currentPage() - 1]) }}">
                            <span aria-hidden="true">«</span>
                        </a>
                    </li>
                    @for ($i = $votes->currentPage() - 2; $i < $votes->currentPage() + 2; $i++)
                        @if ($i >= 1 && $i <= $votes->lastPage())
                            <li class="page-item @if($votes->currentPage() === $i) active @endif"
                                aria-current="page">
                                <a class="page-link" href="{{ route(Route::currentRouteName(), ['page' => $i]) }}">
                                    {{ $i }}
                                </a>
                            </li>
                        @endif
                    @endfor
                    <li class="page-item next @if($votes->currentPage() + 1 > $votes->lastPage()) disabled @endif">
                        <a class="page-link"
                           href="{{ route(Route::currentRouteName(), ['page' => $votes->currentPage() + 1]) }}">
                            <span aria-hidden="true">»</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
