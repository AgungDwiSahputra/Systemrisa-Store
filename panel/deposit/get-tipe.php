<?php 
require '../include/function.php';
if (isset($_POST['tipe'])) {
	echo '<option value="0">Pilih salah satu</option>';
	$tipe = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['tipe'])));

	$q = mysqli_query($konek, "SELECT * FROM metode WHERE tipe = '$tipe'");
	if (mysqli_num_rows($q) > 0 ) {
		while ($r = mysqli_fetch_assoc($q)) {
			echo '<option value="' . $r['id'] . '">'.$r['metode'].'</option>';
		}
	} else {
		echo '<option value="0">Metode tidak di temukan</option>';
	}

} else if (isset($_POST['note'])) {
	$id = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['note'])));

	$q = mysqli_query($konek, "SELECT * FROM metode WHERE id = '$id'");
	$f = mysqli_fetch_assoc($q);
	echo "Rate deposit " . $f['rate'];
} else if (isset($_POST['rate'])) {
	$id = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['rate'])));
	$q = mysqli_query($konek, "SELECT * FROM metode WHERE id = '$id'");
	$f = mysqli_fetch_assoc($q);
	echo $f['rate'];
} else {
	require '../404.shtml';
}
?>