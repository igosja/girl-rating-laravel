<?php
declare(strict_types=1);

/**
 * @var \App\Models\Girl[] $girls
 */

?>
@extends('admin.layouts.layout')

@section('content')
    <h1 class="text-center">Girls</h1>

    <ul class="list-inline text-center">
        <li class="list-inline-item">
            <a class="btn btn-default" href="{{ route('girls.create') }}">Create</a>
        </li>
    </ul>

    <div class="row">
        <div id="w0" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
            <div class="summary">
                Показані <b>
                    {{ ($girls->currentPage() - 1) * $girls->perPage() + 1 }}
                    -
                    @if($girls->currentPage() * $girls->perPage() < $girls->total())
                        {{ $girls->currentPage() * $girls->perPage() }}
                    @else
                        {{ $girls->total() }}
                    @endif
                </b> із <b>
                    {{ $girls->total() }}
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
                            href="{{ route('girls.index', ['sort' => ('id' === app('request')->query('sort') ? '-id' : 'id')]) }}"
                        >
                            ID
                        </a>
                    </th>
                    <th>
                        <a
                            class="@if ('name' === app('request')->query('sort'))
                                    asc
                                @elseif ('-name' === app('request')->query('sort'))
                                    desc
                                @endif"
                            href="{{ route('girls.index', ['sort' => ('name' === app('request')->query('sort') ? '-name' : 'name')]) }}"
                        >
                            Name
                        </a>
                    </th>
                    <th class="col-lg-3">
                        <a
                            class="@if ('rating' === app('request')->query('sort'))
                                    asc
                                @elseif ('-rating' === app('request')->query('sort'))
                                    desc
                                @endif"
                            href="{{ route('girls.index', ['sort' => ('rating' === app('request')->query('sort') ? '-rating' : 'rating')]) }}"
                        >
                            Rating
                        </a>
                    </th>
                    <th class="col-lg-1">&nbsp;</th>
                </tr>
                <tr class="filters" data-url="{{ route('girls.index') }}">
                    <td>
                        <label for="filter-id" style="display: none;"></label>
                        <input id="filter-id" type="text" class="form-control" name="id"
                               value="{{ app('request')->query('id') }}">
                    </td>
                    <td>
                        <label for="filter-code" style="display: none;"></label>
                        <input id="filter-name" type="text" class="form-control" name="name"
                               value="{{ app('request')->query('name') }}">
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                </thead>
                <tbody>
                @foreach ($girls as $girl)
                    <tr data-key="{{ $girl->id }}">
                        <td>{{ $girl->id }}</td>
                        <td>{{ $girl->name }}</td>
                        <td>{{ $girl->rating }}</td>
                        <td class="text-center">
                            <a href="{{ route('girls.show', ['girl' => $girl]) }}" title="Переглянути"
                               aria-label="Переглянути" data-pjax="0">
                                <svg aria-hidden="true"
                                     style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1.125em"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path fill="currentColor"
                                          d="M573 241C518 136 411 64 288 64S58 136 3 241a32 32 0 000 30c55 105 162 177 285 177s230-72 285-177a32 32 0 000-30zM288 400a144 144 0 11144-144 144 144 0 01-144 144zm0-240a95 95 0 00-25 4 48 48 0 01-67 67 96 96 0 1092-71z"></path>
                                </svg>
                            </a>
                            <a href="{{ route('girls.edit', ['girl' => $girl]) }}" title="Оновити"
                               aria-label="Оновити" data-pjax="0">
                                <svg aria-hidden="true"
                                     style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1em"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="currentColor"
                                          d="M498 142l-46 46c-5 5-13 5-17 0L324 77c-5-5-5-12 0-17l46-46c19-19 49-19 68 0l60 60c19 19 19 49 0 68zm-214-42L22 362 0 484c-3 16 12 30 28 28l122-22 262-262c5-5 5-13 0-17L301 100c-4-5-12-5-17 0zM124 340c-5-6-5-14 0-20l154-154c6-5 14-5 20 0s5 14 0 20L144 340c-6 5-14 5-20 0zm-36 84h48v36l-64 12-32-31 12-65h36v48z"></path>
                                </svg>
                            </a>
                            <form
                                action="{{ route('girls.destroy', ['girl' => $girl]) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <a href="javascript:" title="Видалити" aria-label="Видалити"
                                   onclick="$(this).closest('form').submit()">
                                    <svg aria-hidden="true"
                                         style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:.875em"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path fill="currentColor"
                                              d="M32 464a48 48 0 0048 48h288a48 48 0 0048-48V128H32zm272-256a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zM432 32H312l-9-19a24 24 0 00-22-13H167a24 24 0 00-22 13l-9 19H16A16 16 0 000 48v32a16 16 0 0016 16h416a16 16 0 0016-16V48a16 16 0 00-16-16z"></path>
                                    </svg>
                                </a>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                <ul class="pagination">
                    <li class="page-item prev @if($girls->currentPage() - 1 < 1) disabled @endif">
                        <a class="page-link"
                           href="{{ route(Route::currentRouteName(), ['page' => $girls->currentPage() - 1]) }}">
                            <span aria-hidden="true">«</span>
                        </a>
                    </li>
                    @for ($i = $girls->currentPage() - 2; $i < $girls->currentPage() + 2; $i++)
                        @if ($i >= 1 && $i <= $girls->lastPage())
                            <li class="page-item @if($girls->currentPage() === $i) active @endif"
                                aria-current="page">
                                <a class="page-link" href="{{ route(Route::currentRouteName(), ['page' => $i]) }}">
                                    {{ $i }}
                                </a>
                            </li>
                        @endif
                    @endfor
                    <li class="page-item next @if($girls->currentPage() + 1 > $girls->lastPage()) disabled @endif">
                        <a class="page-link"
                           href="{{ route(Route::currentRouteName(), ['page' => $girls->currentPage() + 1]) }}">
                            <span aria-hidden="true">»</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
