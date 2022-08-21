<option value="0">Pilih salah satu</option>
<?php
require_once("../include/function.php");
 $category = $_POST['category'];
 $category = mysqli_real_escape_string($konek, $category);
 $query = "SELECT * FROM service WHERE category = '$category' ORDER BY id ASC";
 $exe = mysqli_query($konek, $query);
 $cek = mysqli_num_rows($exe);
 $no = 1;
 while($row = mysqli_fetch_assoc($exe)):
  $id = $row['id'];
  $service = $row['service'];
?>
<option value="<?php echo $id; ?>"><?php echo $service; ?></option>
<?php
$no++;
endwhile; ?>