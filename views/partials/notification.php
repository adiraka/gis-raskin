
<?php 

	if (isset($_SESSION['sukses'])) {

		if ($_SESSION['sukses'] != NULL) {
			echo '
				<div class="row bt-mrg-10">
					<div class="col-md-12">
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<strong>Sukses! </strong>'.$_SESSION["sukses"].'
						</div>
					</div>
				</div>
			';
			$_SESSION['sukses'] = NULL;
		}

	}

	if (isset($_SESSION['gagal'])) {
		
		if ($_SESSION['gagal'] != NULL) {
			echo '
				<div class="row bt-mrg-10">
					<div class="col-md-12">
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<strong>Error! </strong>'.$_SESSION["gagal"].'
						</div>
					</div>
				</div>
			';
			$_SESSION['gagal'] = NULL;
		}

	}

?>

							

				