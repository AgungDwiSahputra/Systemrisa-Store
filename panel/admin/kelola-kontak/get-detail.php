<?php 
require '../../include/function.php';

if (isset($_POST['trx'])) {
	$trx = $_POST['trx'];
	$q = mysqli_query($konek, "SELECT * FROM kontak WHERE id = '$trx'");
	if (mysqli_num_rows($q) === 1 ) {
		$f = mysqli_fetch_assoc($q);

		echo '
			<form class="form-horizontal" role="form" action="" method="POST">
			<table class="table table-bordered table-striped table-hover">
				<tr>
					<td>Nama</td>
					<td><input type="text" class="form-control" name="nama" autocomplete="off" placeholder="'.$f['nama'].'" value="'.$f['nama'].'"></td>
				</tr>
				<tr>
					<td>Jabatan</td>
					<td><input type="text" class="form-control" name="jabatan" autocomplete="off" placeholder="'.$f['jabatan'].'" value="'.$f['jabatan'].'"></td>
				</tr>
				<tr>
					<td>No. WhatsApp</td>
					<td><input type="text" class="form-control" name="wa" autocomplete="off" placeholder="'.$f['wa'].'" value="'.$f['wa'].'"></td>
				</tr>
				<tr>
					<td>Nama Facebook</td>
					<td><input type="text" class="form-control" name="nama_facebook" autocomplete="off" placeholder="'.$f['fb'].'" value="'.$f['fb'].'"></td>
                </tr>
                <tr>
					<td>Link Facebook</td>
					<td><input type="text" class="form-control" name="link_facebook" autocomplete="off" placeholder="'.$f['link_fb'].'" value="'.$f['link_fb'].'"></td>
                </tr>
                <tr>
					<td>Username Instagram</td>
					<td><input type="text" class="form-control" name="username_ig" autocomplete="off" placeholder="'.$f['ig'].'" value="'.$f['ig'].'"></td>
				</tr>
				<tr>
					<td colspan="2" align="right">
						<button class="btn btn-danger" type="reset">Reset</button>
						<button class="btn btn-success" type="submit" name="tombol">Edit Kontak</button>
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
