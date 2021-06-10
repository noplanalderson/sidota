
		var baseURI = $('base').attr('href');

		$(".formSearch").on('submit', function(e) {
	        e.preventDefault();
	        
	        var formAction = $(".formSearch").attr('action');
	        var dataLogin = {
	            query: $(".query").val(),
	            debu_token: $('.csrf_token').attr('value')
	        };

	        $.ajax({
	            type: "POST",
	            url: formAction,
	            data: dataLogin,
	            dataType: 'json',
	            success: function(data) {
	                
	                $('.csrf_token').val(data.token);
	                $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);

	                if (data.result == 1) {
	                    window.location.href = baseURI + '/' + data.url;
	                } else {
	                    alert(data.msg);
	                }
	            }
	        });
	        return false;
	    });
	    $(".formSearchLeft").on('submit', function(e) {
	        e.preventDefault();
	        
	        var formAction = $(".formSearchLeft").attr('action');
	        var dataLogin = {
	            query: $(".query_left").val(),
	            debu_token: $('.csrf_token').attr('value')
	        };

	        $.ajax({
	            type: "POST",
	            url: formAction,
	            data: dataLogin,
	            dataType: 'json',
	            success: function(data) {
	                
	                $('.csrf_token').val(data.token);
	                $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);
	                
	                if (data.result == 1) {
	                    window.location.href = baseURI + '/' + data.url;
	                } else {
	                    alert(data.msg);
	                }
	            }
	        });
	        return false;
	    });