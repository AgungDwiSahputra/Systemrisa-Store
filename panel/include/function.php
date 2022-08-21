<?php
//====================
//YANG HARUS DIGANTI
//====================

$konek = mysqli_connect('localhost', 'risa', 'Agungganteng275!', 'systemrisa_store');
//UNTUK LOCALHOST
//$link = "http://localhost/Backup_SERVER(31082020)/panel";
//$link_awal = "http://localhost/Backup_SERVER(31082020)";

//UNTUK SERVER
$link = "https://r-i-s-a.com/panel";
$link_awal = "https://r-i-s-a.com";


$description = "Platform SMM Panel Termurah dan Terbaik di Indonesia yang menyediakan berbagai Layanan Social Media yang bergerak terutama di Indonesia. Kamu dapat menambah Followers, Likes, Views, Subscriber, untuk beragam Social Media: Instagram, Youtube, Facebook, Twitter, TikTok, Likee App, dll dengan harga Termurah.";
$keywords = "smm panel, smm panel termurah, smm panel terbaik, smm panel indonesia, panel smm, panel smm termurah, panel smm terbaik, panel smm indonesia, sosial media marketing, smm, smm termurah, smm terbaik, smm indonesia";
$author = "Agung Dwi Sahputra";
$versi = "v3.1";
//================================================================================


//--------------------------------------------
/* Semua Data yang ada di Database Web Service */
$query = mysqli_query($konek, "SELECT * FROM web_service");
$web_service = mysqli_fetch_array($query);

//------------------------------------------------------------
$data1 = array();
$data2 = array();
$data3 = array();
/* Menghitung Semua Data yang ada di Database Service */
$query1 = mysqli_query($konek, "SELECT * FROM service");
while (($row1 = mysqli_fetch_array($query1)) != null) {
    $data1[] = $row1;
}
$j_service = count($data1);

/* Menghitung Semua Data yang ada di Database Riwayat_Sosmed */
$query2 = mysqli_query($konek, "SELECT * FROM riwayat");
while (($row2 = mysqli_fetch_array($query2)) != null) {
    $data2[] = $row2;
}
$j_riwayat = count($data2);

/* Menghitung Semua Data yang ada di Database User */
$query3 = mysqli_query($konek, "SELECT * FROM user");
while (($row3 = mysqli_fetch_array($query3)) != null) {
    $data3[] = $row3;
}
$j_user = count($data3);

//------------------------------------------------------------
//MAINTENANCE
$query4 = mysqli_query($konek, "SELECT * FROM maintenance");
$maintenance = mysqli_fetch_assoc($query4);
//------------------------------------------------------------



date_default_timezone_set('Asia/Jakarta');
$tanggal = date('d M Y');
$waktu = date('G:i:s');

function alert($tipe, $isi, $lokasi)
{
    setcookie($tipe, $isi, time() + 2, '/');
    header("location:../" . $lokasi);
    exit();
}

function jumlahQuery($sql)
{
    $q = mysqli_query($konek, $sql);
    return mysqli_num_rows($q);
}

function jumlah_ti()
{
    global $konek;
    global $username;
    $q = mysqli_query($konek, "SELECT * FROM id_ticket WHERE username = '$username' AND status = 'Unread-Member'");
    if (mysqli_num_rows($q) > 0) {
        return mysqli_num_rows($q);
    }
}

function lalu($timestamp)
{

    $selisih = time() - strtotime($timestamp);
    $detik = $selisih;
    $menit = round($selisih / 60);
    $jam = round($selisih / 3600);
    $hari = round($selisih / 86400);
    $minggu = round($selisih / 604800);
    $bulan = round($selisih / 2419200);
    $tahun = round($selisih / 29030400);
    if ($detik === 0) {
        $waktu = 'Baru saja';
    } else if ($detik >= 1 and $detik <= 60) {
        $waktu = $detik . ' detik lalu';
    } else if ($menit <= 60) {
        $waktu = $menit . ' menit lalu';
    } else if ($jam <= 24) {
        $waktu = $jam . ' jam lalu';
    } else if ($hari <= 7) {
        $waktu = $hari . ' hari lalu';
    } else if ($minggu <= 4) {
        $waktu = $minggu . ' minggu lalu';
    } else if ($bulan <= 12) {
        $waktu = $bulan . ' bulan lalu';
    } else {
        $waktu = $tahun . ' tahun lalu';
    }
    return $waktu;
}

class Api
{
    public $api_url = 'https://s2.buzzerpanel.id/api/json.php'; // API Url Borneo Panel API

    public $api_key = 'CF524fdKeaw6VxMRuncmOz7LIEoUvp'; // Your API Key In Borneo Panel

    public $user_key = '6gy28RH3ksQCbmz5DSwKXeZ7fjEpMUqud41naTlcIVNLPvGYxh'; // Your User Key In Borneo Panel

    //BORNEO PANEL
    /* public function buy_sosmed($data) {
        return json_decode($this->connect($this->api_url, array_merge(array(
            'api' => $this->api_key,
            'user' => $this->user_key, 
            'action' => 'buy',
            'jenis' => 'buy_sosmed'
        ), $data)), true);
    } */

    // contoh membuat pesanan
    public function buy_sosmed($data)
    {
        return json_decode($this->connect($this->api_url, array_merge(array(
            'api_key' => $this->api_key,  // api key Anda
            'action' => 'order',
            'secret_key' => $this->user_key // secret_key Anda
        ), $data)), true);
    }


    //BORNEO PANEL
    /* public function profile() {
        return json_decode($this->connect($this->api_url, array(
            'api' => $this->api_key,
            'user' => $this->user_key,
            'action' => 'profile'
        )), true);
    } */

    // contoh mengecek profil akun
    public function profile()
    {
        return json_decode($this->connect($this->api_url, array(
            'api_key' => $this->api_key, // api key Anda
            'secret_key' => $this->user_key, // secret_key Anda
            'action' => 'profile'
        )), true);
    }

    //BORNEO PANEL
    /* public function status($trx_pembelian) {
        return json_decode($this->connect($this->api_url, array(
            'api' => $this->api_key,
            'user' => $this->user_key, 
            'action' => 'check',
            'id' => $trx_pembelian
        )), true);
    } */

    // contoh mengecek status pesanan
    public function status($data)
    {
        return json_decode($this->connect($this->api_url, array_merge(array(
            'api_key' => $this->api_key, // api key Anda
            'secret_key' => $this->user_key, // secret_key Anda
            'action' => 'status'
        ), $data)), true);
    }

    //BORNEO PANEL
    /* public function service($jenis) {
        return json_decode($this->connect($this->api_url, array(
            'api' => $this->api_key,
            'user' => $this->user_key, 
            'action' => 'service',
            'jenis' => $jenis
        )), true);
    } */

    // contoh menampilkan layanan
    public function service()
    {
        return json_decode($this->connect($this->api_url, array(
            'api_key' => $this->api_key,
            'secret_key' => $this->user_key,
            'action' => 'services'
        )), true);
    }

    // contoh api
    function connect($end_point, $post)
    {
        $_post = array();
        if (is_array($post)) {
            foreach ($post as $name => $value) {
                $_post[] = $name . '=' . urlencode($value);
            }
        }
        $ch = curl_init($end_point);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if (is_array($post)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, join('&', $_post));
        }
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        $result = curl_exec($ch);
        if (curl_errno($ch) != 0 && empty($result)) {
            $result = false;
        }
        curl_close($ch);
        return $result;
    }
}

$api = new Api();
