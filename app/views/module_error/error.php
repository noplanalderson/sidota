	<div class="error-page d-flex align-items-center flex-wrap justify-content-center pd-20 mt-5">
		<div class="pd-10 mt-5">
			<div class="error-page-wrap text-center mt-5">
				<h1 style="font-size: 100px;"><?= $heading ?></h1>
				<h3>Error: <?= $title ?></h3>
				<h6><?= $message ?></h6>
				<div class="pt-20 mx-auto max-width-200">
					<a href="<?= base_url() ?>" class="btn btn-primary btn-lg" style="border-radius: 5px;">Main Page</a>
				</div>
			</div>
		</div>
	</div>