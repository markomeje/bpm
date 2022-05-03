        {{-- Jquery JS --}}
        <script src="{{ env('APP_URL') }}/jquery/jquery.min.js"></script>
        {{-- Pooper JS --}}
        <script src="{{ env('APP_URL') }}/bootstrap/popper.min.js"></script>
        {{-- bootstrap JS --}}
        <script src="{{ env('APP_URL') }}/bootstrap/bootstrap.min.js"></script>
        {{-- index JS --}}
        <script src="{{ env('APP_URL') }}/js/index.js"></script>
        {{-- forms JS --}}
        <script src="{{ env('APP_URL') }}/js/forms.js"></script>
        {{-- Uploader images --}}
        {{-- <script src="{{ env('APP_URL') }}/js/upload.js"></script> --}}
        {{-- Sending Ajax request --}}
        <script src="{{ env('APP_URL') }}/js/ajax.js"></script>
        {{-- Social Sharing --}}
        <script src="https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js"></script>
        {{-- Sagreit --}}
        {{-- <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=61a5e6cb1bd25500123c9634&product=inline-share-buttons" async="async"></script> --}}
        {{-- Chartjs --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        {{-- Chart loading script --}}
        <script src="{{ env('APP_URL') }}/js/charts.js"></script>
        <!-- Summernote -->
        <script src="{{ env('APP_URL') }}/summernote/summernote-lite.min.js" type="text/javascript"></script>

        {{-- File Pond Scripts --}}
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js"></script>
        <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

        <script type="text/javascript">
            var description = $('#description');
            if (description) {
                description.summernote({
                    tabsize: 4,
                    height: 500
                });
            }

            @if(!empty($property) || !empty($material) || !empty($posts) || !empty($services) || !empty($profile))
                FilePond.registerPlugin(FilePondPluginFileEncode, FilePondPluginFileValidateSize, FilePondPluginImageExifOrientation, FilePondPluginImagePreview);

                const fieldName = document.querySelector('.filepond');
                if (fieldName) {
                    var pond = FilePond.create(fieldName, {
                        labelIdle: `Drag & Drop other images here`,
                    });

                    var files = fieldName.files;
                    pond.setOptions({
                        maxFiles: "{{ empty($max) ? '' : $max }}",
                        server: {
                            process: {
                                url: fieldName.getAttribute('data-url'),
                                method: 'post',
                                headers: {
                                    'X-CSRF-TOKEN': "{{ @csrf_token() }}",
                                },
                                onload: (response) => {
                                    console.log(JSON.parse(response));
                                },
                                onerror: (response) => {
                                    var response = JSON.parse(response)
                                    console.log(response.info);
                                    alert(response.info);
                                    return;
                                },
                            },

                            revert: (uniqueFileId, load, error) => {
                                alert('Not allowed. Reload page and try again.');
                                window.location.reload(true)
                            },
                        },
                    });
                }

                $('.upload-image').click(function() {
                    uploader({target: $(this), button: 'upload-image', input: 'image-input', loader: 'image-loader', preview: 'image-preview'});
                });   
            @endif

            @if(!empty($adverts))
                @foreach($adverts as $advert)
                    $('.upload-image-{{ $advert->id }}').click(function() {
                        uploader({target: $(this), button: 'upload-image-{{ $advert->id }}', input: 'image-input-{{ $advert->id }}', loader: 'image-loader-{{ $advert->id }}', preview: 'image-preview-{{ $advert->id }}'});
                    });
                @endforeach     
            @endif

            @if(!empty($blogs))
                @foreach($blogs as $blog)
                    $('.upload-image-{{ $blog->id }}').click(function() {
                        uploader({target: $(this), button: 'upload-image-{{ $blog->id }}', input: 'image-input-{{ $blog->id }}', loader: 'image-loader-{{ $blog->id }}', preview: 'image-preview-{{ $blog->id }}'});
                    });
                @endforeach     
            @endif
        </script>
    </body>
</html>