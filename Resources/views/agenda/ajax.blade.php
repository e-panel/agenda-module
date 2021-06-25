@extends('core::layouts.modal')
@section('title', __('agenda::general.detail.title'))

@section('content')
    <div class="card-header">
        <h5 class="card-title" style="margin-bottom:0">{{ strtoupper(__('agenda::general.detail.title')) }}</h5>
    </div>
    <div class="card-block" style="padding:0">
        <table class="table table-sm table-bordered">
                <tr>
                    <th class="table-active" width="15%">{{ __('agenda::general.detail.content') }}</th>
                    <td>{{ $data->judul }}</td>
                </tr>
                <tr>
                    <th class="table-active">{{ __('agenda::general.detail.place') }}</th>
                    <td>{{ $data->tempat }}</td>
                </tr>
                <tr>
                    <th class="table-active">{{ __('agenda::general.detail.guest') }}</th>
                    <td>{{ $data->dihadiri_oleh }}</td>
                </tr>
                <tr>
                    <th class="table-active">{{ __('agenda::general.detail.time') }}</th>
                    <td>{{ tgl_indo($data->waktu_awal) }}, {{ $data->waktu_akhir }}</td>
                </tr>
                <tr>
                    <th class="table-active">{{ __('agenda::general.detail.visit') }}</th>
                    <td>{{ $data->view }} {{ __('agenda::general.detail.times') }}</td>
                </tr>
                <tr>
                    <th class="table-active">{{ __('agenda::general.detail.uploader') }}</th>
                    <td>
                        <i class="font-icon font-icon-user"></i>
                        {{ optional($data->operator)->nama }}
                    </td>
                </tr>
            </table>
    </div>
@endsection