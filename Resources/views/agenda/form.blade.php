<div class="box-typical-body padding-panel">
    <div class="row">
        <div class="col-md-8">

            <fieldset class="form-group {{ $errors->has('judul')?'form-group-error':'' }}">
                <label for="judul" class="form-label">
                    {{ __('agenda::general.form.title.label') }} <span class="text-danger">*</span>
                </label>
                <div class="form-control-wrapper">
                    {!! Form::textarea('judul', null, ['class' => 'form-control', 'placeholder' => __('agenda::general.form.title.placeholder'), 'rows' => 5]) !!}
                    {!! $errors->first('judul', '<span class="text-muted"><small>:message</small></span>') !!}
                </div>
            </fieldset>

    		<fieldset class="form-group {{ $errors->has('tempat')?'form-group-error':'' }}">
	            <label for="tempat" class="form-label">
                    {{ __('agenda::general.form.place.label') }} <span class="text-danger">*</span>
                </label>
	            <div class="form-control-wrapper">
	                {!! Form::text('tempat', null, ['class' => 'form-control', 'placeholder' => __('agenda::general.form.place.placeholder')]) !!}
                    {!! $errors->first('tempat', '<span class="text-muted"><small>:message</small></span>') !!}
	            </div>
	        </fieldset>

    		<fieldset class="form-group {{ $errors->has('dihadiri_oleh')?'form-group-error':'' }}">
                <label for="dihadiri_oleh" class="form-label">
                    {{ __('agenda::general.form.guest.label') }} <span class="text-danger">*</span>
                </label>
	            <div class="form-control-wrapper">
	                {!! Form::text('dihadiri_oleh', null, ['class' => 'form-control', 'placeholder' => __('agenda::general.form.guest.placeholder')]) !!}
	                {!! $errors->first('dihadiri_oleh', '<span class="text-muted"><small>:message</small></span>') !!}
	            </div>
	        </fieldset>

        </div>
        <div class="col-md-4">
            <div class="alert alert-info text-center">
                <small>{!! __('agenda::general.form.time.desc') !!}</small>
            </div>
            <fieldset class="form-group {{ $errors->has('waktu')?'form-group-error':'' }}">
                <div class="form-control-wrapper">
                    <div id="waktu"></div>
                    <input type="hidden" name="tanggal" id="tanggal">
                </div>
            </fieldset>
        </div>
    </div>
</div>