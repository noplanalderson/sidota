    var baseURI = $('base').attr('href');

    $('#access_lists').DataTable( {
        'info': false,
        'searchable':true,
        'responsive': true,
        'lengthMenu': [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        "language": {
          "zeroRecords": "No Access Type Found"
        },
        "order": [[ 0, "asc" ]],
        'columnDefs': [ 
            {
                'targets': [1,2],
                'orderable': false,
            }
        ],
        "dom": '<"left"l>rtip',
    });

    $(function(){
        $('.add-access').on('click', function() {
        	$('.modal-title').html('Add Access Type');
            $('.modal-footer button[type=submit]').html('Add');
            $('.modal-body form').attr('action', baseURI + 'add-access');

            $('#type_id').val('');
            $('#type_code').val('');
            $('#menu_id').select2({
                width: '100%',
                dropdownParent: $('#accessModal'),
                minimumResultsForSearch: Infinity,
                placeholder: 'Choose Privileges'
            }).val('').trigger('change');
        });
        $('.edit-access').on('click', function() {
            $('.modal-title').html('Edit Access Type');
            $('.modal-footer button[type=submit]').html('Edit');
            $('.modal-body form').attr('action', baseURI + 'edit-access');

            const type_id = $(this).data('id');
            $.ajax({
                url: baseURI + 'get-access',
                data: {
                        id: type_id, 
                        debu_token: $('.csrf_token').attr('value')
                    },
                method: 'post',
                dataType: 'json',
                success: function(data){
                    $('.csrf_token').val(data.token);
                    $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);
                    $('#type_id').val(type_id);
                    $('#type_code').val(data.type_code);

                    var priv = data.priv;

                    if (priv) {
                        var arrayRoles = priv.split(',');
                        $('#menu_id').select2({
                            width: '100%',
                            dropdownParent: $('#accessModal'),
                            minimumResultsForSearch: Infinity,
                            placeholder: 'Choose Privileges'
                        }).val(arrayRoles).trigger('change');
                    }
                    else
                    {
                        $('#menu_id').select2({
                            dropdownParent: $('#accessModal'),
                            minimumResultsForSearch: Infinity,
                            placeholder: 'Choose Privileges'
                        }).val('').trigger('change');
                    }
                }
            });
        });
    });

    $("#submit").click(function() {
        var formAction = $("#accessForm").attr('action');
        var accessData = {
            type_id: $("#type_id").val(),
            type_code: $("#type_code").val(),
            menu_id: $("#menu_id").val(),
            debu_token: $('.csrf_token').attr('value')
        };

        $.ajax({
            type: "POST",
            url: formAction,
            data: accessData,
            dataType: 'json',
            success: function(data) {
                
                $('.csrf_token').val(data.token);
                $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);
                
                $('.message').html(data.msg);
                $("#message").slideDown('slow');

                if (data.result == 1) {
                    $('#message').attr('class', 'alert alert-success');
                    setTimeout(location.reload.bind(location), 1000);
                } else {
                    $('#message').attr('class', 'alert alert-danger');
                    $("#message").alert().delay(3000).slideUp('slow');
                }
            }
        });
        return false;
    });

    $("#access_lists").on('click', '.delete-btn', function(){
        var result = confirm("Are You Sure to Delete Access Type?");

        if (result) {
            var $tr = $(this).closest('tr');
            const type_id = $(this).data('id');
            $.ajax({
                url: baseURI + 'delete-access',
                data: {
                        id: type_id, 
                        debu_token: $('.csrf_token').attr('value')
                    },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('.csrf_token').val(data.token);
                    $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);

                    $('.delete_msg').html(data.msg);
                    $("#delete_msg").slideDown('slow');
                    
                    if (data.result == 1) {
                        $('#delete_msg').attr('class', 'alert alert-success');
                        $tr.find('td').fadeOut(1000,function(){ 
                            $tr.remove();                    
                        });
                    } else {
                        $('#delete_msg').attr('class', 'alert alert-danger');
                    }
                    $("#delete_msg").alert().delay(6000).slideUp('slow');
                }
            });
        }
    });

    $("#access_lists").on('change', '.index_page', function(){
        
        const type_id = $(this).data('id');
        var index_page = $('select[data-id="'+type_id+'"]').val();

        $.ajax({
            url: baseURI + 'update-index',
            data: { 
                id: type_id,
                index_page: index_page,
                debu_token: $('meta[name="X-CSRF-TOKEN"]').attr('content')
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {

                $('.csrf_token').val(data.token);
                $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);

                if(data.result == 0) {
                    $('.index_page option').prop('selected', function() {
                        return this.defaultSelected;
                    });;
                }
            }
        });
    });