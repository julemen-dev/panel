{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.admin')

@section('title')
    Server — {{ $server->name }}: Mounts
@endsection

@section('content-header')
    <h1>{{ $server->name }}<small>Manage server mounts.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.servers') }}">Servers</a></li>
        <li><a href="{{ route('admin.servers.view', $server->id) }}">{{ $server->name }}</a></li>
        <li class="active">Mounts</li>
    </ol>
@endsection

@section('content')
    @include('admin.servers.partials.navigation')
    <div class="row">
        <div class="col-sm-7">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Mounts</h3>
                </div>

                <div class="box-body table-responsible no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>Source</th>
                            <th>Target</th>
                            <th>Read Only</th>
                            <th>Type</th>
                            <th></th>
                        </tr>

                        <tr>
                            <td><code>/srv/mounts/whatever</code></td>
                            <td><code>/home/share/mount1</code></td>
                            <td><code>false</code></td>
                            <td>Bind</td>

                            <td class="text-center">
                                <button data-action="remove" data-id="" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-5">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Mount</h3>
                </div>

                <form action="{{ route('admin.servers.view.database', $server->id) }}" method="POST">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="pSource" class="control-label">Source</label>
                            <input type="text" id="pSource" name="source" class="form-control" value="/path/on/system" />
                            <p class="text-muted small">Coming Soon&trade;</p>
                        </div>

                        <div class="form-group">
                            <label for="pTarget" class="control-label">Target</label>
                            <input type="text" id="pTarget" name="target" class="form-control" value="/path/on/container" />
                            <p class="text-muted small">Coming Soon&trade;</p>
                        </div>

                        <div class="form-group">
                            <label for="pReadOnly" class="control-label">Read Only</label>

                            <div>
                                <div class="radio radio-danger radio-inline">
                                    <input type="radio" id="pReadOnly" name="readonly" value="0">
                                    <label for="pReadOnly">Enabled</label>
                                </div>

                                <div class="radio radio-success radio-inline">
                                    <input type="radio" id="pReadOnly" name="readonly" value="1" checked>
                                    <label for="pReadOnly">Disabled</label>
                                </div>

                                <p class="text-muted small">Coming Soon&trade;</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pType" class="form-label">Type</label>
                            <select id="pType" name="type" class="form-control">
                                <option value="bind">Bind</option>
                                <option value="volume">Volume</option>
                                <option value="tmpfs">Temporary FS</option>
                            </select>

                            <p class="text-muted small">Think of a Nest as a category. You can put multiple Eggs in a nest, but consider putting only Eggs that are related to each other in each Nest.</p>
                        </div>
                    </div>

                    <div class="box-footer">
                        {!! csrf_field() !!}
                        <input type="submit" class="btn btn-sm btn-success pull-right" value="Add Mount" />
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    @parent
@endsection
