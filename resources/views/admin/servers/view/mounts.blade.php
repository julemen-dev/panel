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

                        @foreach ($server->mounts as $mount)
                            <tr>
                                <td><code>{{ $mount->source }}</code></td>
                                <td><code>{{ $mount->target }}</code></td>
                                <td><code>{{ ($mount->readonly) ? 'true' : 'false' }}</code></td>
                                <td>{{ $mount->type }}</td>

                                <td class="text-center">
                                    <button data-action="remove" data-id="{{ $mount->id }}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-5">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Mount</h3>
                </div>

                <form action="{{ route('admin.servers.view.mounts', $server->id) }}" method="POST">
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
                                <div class="radio radio-success radio-inline">
                                    <input type="radio" id="pReadOnly_enabled" name="readonly" value="0">
                                    <label for="pReadOnly">Enabled</label>
                                </div>

                                <div class="radio radio-danger radio-inline">
                                    <input type="radio" id="pReadOnly_disabled" name="readonly" value="1" checked>
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

    <script>
        $('[data-action="remove"]').click(function (event) {
            event.preventDefault();
            var self = $(this);
            swal({
                title: '',
                type: 'warning',
                text: 'Are you sure that you want to delete this mount?',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                confirmButtonColor: '#d9534f',
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function () {
                $.ajax({
                    method: 'DELETE',
                    url: '/admin/servers/view/{{ $server->id }}/mounts/' + self.data('id') + '/delete',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                }).done(function () {
                    self.parent().parent().slideUp();
                    swal.close();
                }).fail(function (jqXHR) {
                    console.error(jqXHR);
                    swal({
                        type: 'error',
                        title: 'Whoops!',
                        text: (typeof jqXHR.responseJSON.error !== 'undefined') ? jqXHR.responseJSON.error : 'An error occurred while processing this request.',
                    });
                });
            });
        });
    </script>
@endsection
