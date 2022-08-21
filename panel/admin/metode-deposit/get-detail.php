<?php 
require '../../include/function.php';

if (isset($_POST['trx'])) {
	$trx = $_POST['trx'];
	$q = mysqli_query($konek, "SELECT * FROM metode WHERE id = '$trx'");
	if (mysqli_num_rows($q) === 1 ) {
		$f = mysqli_fetch_assoc($q);

		echo '
			<form class="form-horizontal" role="form" action="" method="POST">
			<table class="table table-bordered table-striped table-hover">
				<tr>
					<td>Tipe Deposit</td>
					<td><input type="text" required class="form-control" name="tipe" autocomplete="off" placeholder="'.$f['tipe'].'" value="'.$f['tipe'].'"></td>
				</tr>
				<tr>
					<td>Metode Deposit</td>
					<td><input type="text" required class="form-control" name="metode" autocomplete="off" placeholder="'.$f['metode'].'" value="'.$f['metode'].'"></td>
				</tr>
				<tr>
					<td>Rate</td>
					<td><input type="text" required class="form-control" name="rate" autocomplete="off" placeholder="'.$f['rate'].'" value="'.$f['rate'].'"></td>
				</tr>
				<tr>
					<td>No. Tujuan</td>
					<td><input type="text" required class="form-control" name="tujuan" autocomplete="off" placeholder="'.$f['tujuan'].'" value="'.$f['tujuan'].'"></td>
				</tr>
				<tr>
					<td colspan="2" align="right">
						<button class="btn btn-danger" type="reset">Reset</button>
						<button class="btn btn-success" type="submit" name="tombol">Edit Metode</button>
					</td>
				</tr>
			</table>
			</form>
		';

	} else {
		echo '<div class="alert alert-danger">Deposit tidak di temukan</div>';
	}
} else {
	require '../../404.shtml';
}
?>
