<script>
	$("#btn-print").on('click', function() {
		var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById('report').innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
        document.close();
        document.location.reload(true);
	});
</script>