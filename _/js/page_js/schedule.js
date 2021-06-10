	$('#month').on('change', function(e) {
		e.preventDefault();
		$('#periodForm').submit();
	})

	$("#btn-print").on('click', function() {
		var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById('schedule').innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
        document.close();
        document.location.reload(true);
	});