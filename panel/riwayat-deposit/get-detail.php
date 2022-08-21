<?php 
require '../include/function.php';

if (isset($_POST['trx'])) {
	$trx = $_POST['trx'];
	$q = mysqli_query($konek, "SELECT * FROM deposit WHERE id_deposit = '$trx'");
	if (mysqli_num_rows($q) === 1 ) {
		$f = mysqli_fetch_assoc($q);

		echo '
			<table class="table table-bordered table-striped table-hover">
				<tr>
					<td>ID Deposit</td>
					<td>'.$f['id_deposit'].'</td>
				</tr>
				<tr>
					<td>Saldo Diterima</td>
					<td>Rp. '.number_format($f['saldo_didapat'],0,',','.').'</td>
				</tr>
				<tr>
					<td>Tipe Deposit</td>
					<td>'.$f['tipe_deposit'].'</td>
				</tr>
				<tr>
					<td>Metode Deposit</td>
					<td>'.$f['metode_deposit'].'</td>
				</tr>
				<tr>
					<td>Tujuan</td>
					<td>'.$f['tujuan_deposit'].'</td>
				</tr>
				<tr>
					<td>Status</td>
					<td>'.$f['status'].'</td>
				</tr>
				<tr>
					<td>Tanggal Depsoit</td>
					<td>'.$f['tanggal'].' '.$f['waktu'].'</td>
				</tr>
			</table>
		';

	} else {
		echo '<div class="alert alert-danger">Deposit tidak di temukan</div>';
	}
} else {
	require '../404.shtml';
}
?>
