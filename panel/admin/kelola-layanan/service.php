<?php
require '../../include/function.php';
    
    $service = $api->service();

  if ($service['status'] == 'true') {
    mysqli_query($konek, "TRUNCATE TABLE service");
    foreach ($service['data'] as $layanan) {
        $id = $layanan['id'];
        $name = str_replace(["Buzzerpanel","buzzerpanel","BUZZERPANEL"], "Systemrisa Store", $layanan['name']);
        $price = $layanan['price']+5000;
        $min = $layanan['min'];
        $max = $layanan['max'];
        $note = str_replace(["Buzzerpanel","buzzerpanel","BUZZERPANEL"], ["Systemrisa Store","Systemrisa Store","systemrisa_store"], $layanan['note']);
        $category = str_replace(["Buzzerpanel","buzzerpanel","BUZZERPANEL"], "Systemrisa Store", $layanan['category']);
        mysqli_query($konek, "INSERT INTO service (service, harga, min, max, category, note, provider_id) VALUES ('$name','$price','$min','$max','$category','$note','$id')");
    }
    alert('berhasil', 'Pengambilan layanan berhasil', 'kelola-layanan');
  } else {
    alert('gagal', 'API Key gagal terhubung ke server', 'kelola-layanan');
  }
        