    var baseURI = $('base').attr('href');

	$(function(){
        $('.show').on('click', function() {
            $('.modal-title').html('Image Preview');
            $('#image').attr('src', baseURI + "_/images/curve-loading.gif").attr('class', 'w-50');

            const picture = $(this).data('id');
            $.ajax({
                url: baseURI + '/preview-documentation/' + picture,
                data: { picture_hash: picture },
                method: 'get',
                dataType: 'json',
                success: function(data){
                    $('#image').attr('src', data.picture).attr('class', 'w-100');
                }
            });
        });
    });

    $(".delete-btn").on('click', function(e){
        e.preventDefault();

        Swal.fire({
          text: 'Are You sure to delete this image?',
          showCancelButton: true,
          type: 'question',
          confirmButtonText: 'Yes',
          reverseButtons: true
        }).then((result) => {

            if (result.value == true) {
                const hash = $(this).data('id');
                $.ajax({
                    url: baseURI + '/delete-documentation',
                    data: { 
                        hash: hash,
                        debu_token: $('meta[name="X-CSRF-TOKEN"]').attr('content')
                    },
                    method: 'post',
                    dataType: 'json',
                    success: function(data) {
                        $('.csrf_token').val(data.token);
                        $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);

                        if (data.result == 1) {
                            Swal.fire('Success!', data.msg, 'success');
                            $('.' + hash).fadeOut(1000,function(){ 
                                $('.' + hash).remove();                    
                            });
                        } else {
                            Swal.fire('Failed!', data.msg, 'error');
                        }
                    }
                });
            }
        })
    });

    $("#btn-print").on('click', function() {
        $('#btn-print').remove();
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById('printable-area').innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
        document.close();
        document.location.reload(true);
    });