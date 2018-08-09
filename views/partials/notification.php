
<?php 

	if (isset($_SESSION['sukses'])) {

		if ($_SESSION['sukses'] != NULL) {
			echo '
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<strong>Sukses! </strong>'.$_SESSION["sukses"].'
						</div>
					</div>
				</div><br><br>
			';
			$_SESSION['sukses'] = NULL;
		}

	}

	if (isset($_SESSION['gagal'])) {
		
		if ($_SESSION['gagal'] != NULL) {
			echo '
				<div class="row>
					<div class="col-md-12">
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<strong>Error! </strong>'.$_SESSION["gagal"].'
						</div>
					</div>
				</div><br><br>
			';
			$_SESSION['gagal'] = NULL;
		}

	}

?>

							

				