<?php
require_once("../include/function.php");
$id = $_POST['service'];
$id = mysqli_real_escape_string($konek, $id);
$query = mysqli_query($konek, "SELECT * FROM service WHERE id = '$id'");
$count = mysqli_num_rows($query);
$data = mysqli_fetch_array($query);
$max = $data['max'];
$min = $data['min'];
$price = $data['harga'];
$catatan = $data['note'];
if ($count == 0) : ?>
Data tidak di temukan
<?php else : ?>

<div class="alert alert-info">
	<b>Minimal Pembelian</b> : <?php echo number_format($min,0,",","."); ?><br/>
	<b>Maksimal Pembelian</b> : <?php echo number_format($max,0,",","."); ?><br/>
	<b>Harga</b> : Rp <?php echo number_format($price,0,",","."); ?> / 1.000<br/>
	<b>Catatan : </b> <?php echo $catatan; ?><br>
	<?php if ($data['category'] == "Instagram Followers Indonesia" || $data['category'] == "Instagram Followers [Guaranteed]" || $data['category'] == "Instagram Followers [Not Guaranteed]" || $data['category'] == "Instagram Followers [Targeted]"): ?>
	<small><b class="text-danger">(Masukan Username Instagram tanpa tanda @)</b></small>
	<?php endif; ?>
</div>
<?php endif; ?>