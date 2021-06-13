<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        @foreach($file->uploads as $upload)
            console.log('foreach in script')
        @endforeach

        $('#formUpload').on('submit', function (e) {
            e.preventDefault()
            const url = $(this).attr('action')
            let formData = new FormData(this)

            $.ajax({
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(data){
                    console.log('data')
                }
            });
        })
    })
</script>