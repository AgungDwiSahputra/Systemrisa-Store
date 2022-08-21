<?php 
require '../include/function.php';

if (isset($_POST['trx'])) {
	$trx = $_POST['trx'];
	$q = mysqli_query($konek, "SELECT * FROM saldo WHERE id = '$trx'");
	if (mysqli_num_rows($q) === 1 ) {
		$f = mysqli_fetch_assoc($q);

		if ($f['efek'] === "- Saldo"){
			$saldo_aktivity = '<span class="label label-danger"><b>-</b> Rp. '.number_format($f['saldo_aktifity'],0,',','.').'</span>';
		} else {
			$saldo_aktivity = '<span class="label label-success"><b>+</b> Rp. '.number_format($f['saldo_aktifity'],0,',','.').'</span>';
		} 

		echo '
			<table class="table table-bordered table-striped table-hover">
				<tr>
					<td>Keterangan</td>
					<td>'.$f['aksi'].'</td>
				</tr>
				<tr>
					<td>Saldo Awal</td>
                    <td>Rp. '.number_format($f['saldo_awal'],0,',','.').'</td>
                </tr>
                <tr>
					<td>Perubahan Saldo</td>
					<td>'.$saldo_aktivity.'</td>
				</tr>
				<tr>
					<td>Saldo Jadi</td>
					<td>Rp. '.number_format($f['saldo_jadi'],0,',','.').'</td>
				</tr>
				<tr>
					<td>Tanggal</td>
					<td>'.$f['tanggal'].'</td>
				</tr>
			</table>
		';

	} else {
		echo '<div class="alert alert-danger">Pembelian tidak di temukan</div>';
	}
} else {
	require '../404.shtml';
}
?>
