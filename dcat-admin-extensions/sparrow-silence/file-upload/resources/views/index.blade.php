<div class="{{ $viewClass['form-group'] }} {{ $class }}">

    <label for="{{$column}}" class="{{$viewClass['label']}} control-label">{!! $label !!}</label>

    <div class="{{$viewClass['field']}}">

        @include('admin::form.error')

        <input name="{{$name}} silence" type="file" class="file-input" multiple>

        @include('admin::form.help-block')
    </div>
</div>

<script require="@sparrow-silence.file-upload">
    const $self = $('{!! $selector !!}');

    let options = {!! $options !!},
        inputSelector = $self.find('.file-input');

    inputSelector.fileinput(options);

</script>
