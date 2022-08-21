<?php 
if (isset($_POST['id'])) {
	require '../../include/function.php';
	$id = addslashes(htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['id']))));
	if (!empty($id) AND is_numeric($id)) {
		$q = mysqli_query($konek, "SELECT * FROM voucher WHERE id = '$id'");
		if (mysqli_num_rows($q) === 1) {
			$r = mysqli_fetch_assoc($q);
			echo '
			<div class="form-group row ">
                <div class="col-12 ">
                <label>Code Voucher</label>
                    <input class="form-control form-control-md" type="text" name="judul" required=" " value="'.$r['code_voucher'].'">
                </div>
            </div>
            <div class="form-group row ">
                <div class="col-12 ">
                <label>Jumlah</label>
                    <input class="form-control form-control-md" type="number" name="jumlah" required=" " value="'.number_format($r['jumlah'],0,',','.').'">
                </div>
            </div>
			';

		}
	} 
} else {
	require '../../404.shtml';
}
?>