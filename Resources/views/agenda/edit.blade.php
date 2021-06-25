@extends('core::page.content')
@section('inner-title', __('agenda::general.edit.title', ['attribute' => $title]) . ' - ')
@section('mAgenda', 'opened')

@section('css')
    <link rel="stylesheet" href="https://cdn.enterwind.com/template/epanel/css/separate/vendor/bootstrap-datetimepicker.min.css">
@endsection

@section('js')
    <script type="text/javascript" src="https://cdn.enterwind.com/template/epanel/js/lib/match-height/jquery.matchHeight.min.js"></script>
    <script src="https://cdn.enterwind.com/template/epanel/js/lib/moment/moment-with-locales.min.js"></script>
    <script src="https://cdn.enterwind.com/template/epanel/js/lib/eonasdan-bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdn.enterwind.com/template/epanel/js/lib/fullcalendar/fullcalendar.min.js"></script>
    <script src="https://cdn.enterwind.com/template/epanel/js/lib/fullcalendar/fullcalendar-init.js"></script>
    <script type="text/javascript">
        $(function () {
        	$('#tanggal').val('{{ $edit->waktu_awal }}');
            $('#waktu').datetimepicker({
                inline: true,
                sideBySide: false,
                defaultDate: '{{ date("m/d/Y", strtotime($edit->waktu_awal))}}',
            });
            $('#waktu').on('dp.change', function(event) {
                var formatted_date = event.date.format('YYYY-MM-DD hh:mm:ss A');
                $('#tanggal').val(formatted_date);
            });
        });
    </script>
@endsection

@section('content')
    <section class="box-typical">

        {!! Form::model($edit, ['route' => ["$prefix.update", $edit->uuid], 'autocomplete' => 'off', 'method' => 'put']) !!}

            @include('core::layouts.components.top', [
                'judul' => __('agenda::general.edit.title', ['attribute' => $title]),
                'subjudul' =>  __('agenda::general.edit.desc'),
                'kembali' => route("$prefix.index")
            ])
        
            <div class="card">
                @include("$view.form")
                @include('core::layouts.components.submit')
            </div>
            
        {!! Form::close() !!}

    </section>
@endsection