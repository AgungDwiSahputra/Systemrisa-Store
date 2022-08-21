<?php 
require '../../include/function.php';

if (isset($_POST['trx'])) {
	$trx = $_POST['trx'];
	$q = mysqli_query($konek, "SELECT * FROM riwayat WHERE order_id = '$trx'");
	if (mysqli_num_rows($q) === 1 ) {
		$f = mysqli_fetch_assoc($q);
		$statusPembelian = $f['status'];
		if ($statusPembelian === "Pending") {
			$statusNa = '<span class="label label-warning">Pending</span>';
		} else if ($statusPembelian === "Success" || $statusPembelian === "Sukses") {
			$statusNa = '<span class="label label-success">Success</span>';
		} else if ($statusPembelian === "Error" || $statusPembelian === "Gagal") {
			$statusNa = '<span class="label label-danger">Error</span>';
		} else {
			$statusNa = '<span class="label label-danger">'.$statusPembelian.'</span>';
		}
		echo '
			<table class="table table-bordered table-striped table-hover">
				<tr>
					<td>Username Pembeli</td>
					<td>'.$f['username'].'</td>
				</tr>
				<tr>
					<td>Order ID</td>
					<td>'.$f['order_id'].'</td>
				</tr>
				<tr>
					<td>Jumlah</td>
					<td>'.number_format($f['jumlah'],0,',','.').'</td>
				</tr>
				<tr>
					<td>Harga</td>
					<td>Rp. '.number_format($f['harga'],0,',','.').'</td>
				</tr>
				<tr>
					<td>Target</td>
					<td>'.$f['target'].'</td>
				</tr>
				<tr>
					<td>Jumlah Mulai</td>
					<td>'.number_format($f['start_count'],0,',','.').'</td>
				</tr>
				<tr>
					<td>Jumlah Kurang</td>
					<td>'.number_format($f['remains'],0,',','.').'</td>
				</tr>
				<tr>
					<td>Status</td>
					<td>'.$statusNa.'</td>
				</tr>
				<tr>
					<td>Tanggal</td>
					<td>'.$f['tanggal'].' '.$f['waktu'].'</td>
				</tr>
			</table>
		';

	} else {
		echo '<div class="alert alert-danger">Pembelian tidak di temukan</div>';
	}
} else {
	require '../../404.shtml';
}
?>
