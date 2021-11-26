<div class="file-input-ext">
    <input name="file-demo" type="file" class="_file_input_ext_" multiple>
</div>

<style>

</style>

<script require="@sparrow-silence.file-upload">
    Dcat.init('._file_input_ext_', function (self) {
        self.fileinput({
            language: 'zh',
            uploadUrl: '/file-upload',
            previewFileType: 'any',
            theme: 'fa',
            initialPreview: [
                '<img src="{{$value}}" class="file-preview-image">'
            ],
        }).on('filebatchpreupload', function (event, data) {
            // return false;
        });
    })
</script>
