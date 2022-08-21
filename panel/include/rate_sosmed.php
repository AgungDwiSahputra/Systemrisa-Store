<?php
require_once("../include/function.php");
$id = $_POST['service'];
$id = mysqli_real_escape_string($konek, $id);
$query = mysqli_query($konek, "SELECT * FROM service WHERE id = '$id'");
$count = mysqli_num_rows($query);
$data = mysqli_fetch_array($query);
$show = $data['harga'];
if ($count == 0) : ?>
0
<?php else : ?>
<?php echo $show; ?>
<?php endif; ?>