    var baseURI = $('base').attr('href');

    $('#background_tbl').DataTable( {
        'info': false,
        'searchable':true,
        'responsive': true,
        'lengthMenu': [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        "language": {
          "zeroRecords": "No Background Found"
        },
        "dom": '<"left"l>rtip',
    });

    $(function(){
        $('.add-background').on('click', function() {
        	$('.modal-title').html('Add Background');
            $('.modal-footer button[type=submit]').html('Add');
            var url = baseURI + $('.add-background').attr('id');
        
            $(".picture_upload").fileinput({
                theme: "fas",
                uploadUrl: url,
                showRemove: false,
                showUpload: false,
                fileActionSettings: {
                    showZoom: false,
                    showDrag: false
                },
                showBrowse: false,
                browseOnZoneClick: true,
                showCancel: true,
                autoReplace: false,
                maxFileCount: 10,
                append: true,
                autoOrientImage: true
            });  
        });   
    });

    $("#background_tbl").on('click', '.delete-btn', function(e){

        e.preventDefault();

        Swal.fire({
            text: 'Are You sure to delete this image?',
            showCancelButton: true,
            type: 'warning',
            confirmButtonText: 'Yes',
            reverseButtons: true
        }).then((result) => {

            if (result.value == true) {
                var $tr = $(this).closest('tr');
                const image_hash = $(this).data('id');
                var url = $('.delete-btn').attr('id');

                $.ajax({
                    url: baseURI + url,
                    data: {
                            hash: image_hash, 
                            debu_token: $('.csrf_token').attr('value')
                        },
                    method: 'post',
                    dataType: 'json',
                    success: function(data) {
                        $('.csrf_token').val(data.token);
                        $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);
                        
                        if (data.result == 1) {
                            Swal.fire('Success!', data.msg, 'success');
                            $tr.find('td').fadeOut(1000,function(){ 
                                $tr.remove();                    
                            });
                        } else {
                            Swal.fire('Failed!', data.msg, 'error');
                        }
                    }
                });
            }
        })
    });