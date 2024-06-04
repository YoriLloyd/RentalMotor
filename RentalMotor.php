<?php
// Harga rental per hari untuk setiap jenis motor
$harga_per_hari = [
    "Scooter" => 7000,
    "Beat" => 10000,
    "Vario" => 8000,
    "Zx" => 12000
];

// Inisialisasi variabel hasil dan info
$hasil = "";
$info = "";

// Proses input dan hitung total biaya jika tombol 'hitung' ditekan
if(isset($_POST['submit'])) {
    // Memastikan semua input diisi
    if(!empty($_POST['nama_pelanggan']) && !empty($_POST['lama_waktu']) && !empty($_POST['motor'])) {
        $nama_pelanggan = $_POST['nama_pelanggan'];
        $lama_waktu = $_POST['lama_waktu'];
        $motor = $_POST['motor'];

        // Menghitung total biaya rental
        function hitungBiayaRental($nama_pelanggan, $lama_waktu, $motor)
        {
            // Pajak 10000
            $pajak = 10000;

            // Diskon untuk member
            $diskon_member = 0.05; // 5%

            // Pelanggan merupakan member
            $nama_member = ["ana", "budi", "charlie", "kenzo"]; // Daftar nama membernya
            $is_member = in_array(strtolower($nama_pelanggan), $nama_member); // strtolower untuk mengubah sebuah string menjadi kecil

            global $harga_per_hari; // Menggunakan variabel global $harga_per_hari

            // Hitung total biaya rental
            $total_biaya = $harga_per_hari[$motor] * $lama_waktu;

            // Jika pelanggan merupakan member, berikan diskon 5%
            if ($is_member) {
                $total_biaya -= $total_biaya * $diskon_member;
            }

            // Tambahkan pajak tambahan
            $total_biaya += $pajak;

            return $total_biaya;
        }

        // Hitung total biaya rental
        $hasil = hitungBiayaRental($nama_pelanggan, $lama_waktu, $motor);
        // Menampilkan informasi sesuai kebutuhan
        if($hasil > 0) {
            $info .= $nama_pelanggan . " berstatus sebagai ";
            if(in_array(strtolower($nama_pelanggan), ["ana", "budi", "charlie"])) {
                $info .= "member ";
            } else {
                $info .= "non-member ";
            }
            if(in_array(strtolower($nama_pelanggan), ["ana", "budi", "charlie"])) {
                $info .= "mendapatkan diskon 5%. ";
            } else {
                $info .= "tidak mendapatkan diskon 5%. ";
            }
            $info .= "Jenis motor yang dirental adalah " . $motor . " selama " . $lama_waktu . " hari dengan harga rental per hari-harinya: " . $harga_per_hari[$motor] . ".<br>";
            $info .= "Biaya yang harus dibayarkan adalah Rp. " . number_format($hasil, 0, ',', '.') . ",-";
        } else {
            $info = "Input tidak valid";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>UKK | Rental Motor</title>
    <style>
            body {
            text-align: center;
            margin: 0;
            padding: 0;
        }
        
        form {
            margin-bottom: 20px;
        }
        
        @media screen and (max-width: 600px) {
            hr {
                width: 50%;
            }
        }
        label {
            display: block;
            margin-bottom: 10px;
        }

        input[for="jenis"], input[type="text"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[for="jenis"], input[type="number"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: lime;
            color: black;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: cyan;
            transition:1s;
        }
    </style>
</head>
<body>
<h2 class="judul">Rental Motor</h2>
<div class="kalkulator">
    <form method="post" action="">
        <div class="container">
            <div class="input-container">
                <h2 class="h21">Nama Pelanggan:</h2>
                <input type="text" name="nama_pelanggan" class="bil1" autocomplete="off" placeholder="Masukkan nama pelanggan" required>
            </div>
            <div class="input-container">
                <h2 class="h21">Lama Waktu:</h2>
                <input type="number" name="lama_waktu" class="bil2" autocomplete="off" placeholder="Masukkan lama waktu" required>
            </div>
        </div>
        <center>
            <div class="container">
                <h2 class="h21">Jenis Motor</h2>
                <select class="opt" name="motor">
                    <option value="Scooter">Scooter</option>
                    <option value="Beat">Beat</option>
                    <option value="Vario">Vario</option>
                    <option value="Zx">Zx</option>
                </select>
            </div>
        </center>
        <center>
            <br>
            <input type="submit" name="submit" value="Submit" class="tombol">
        </center>
    </form>
    <?php if(isset($_POST['submit'])){ ?>
    <div class="hasil-container">
        <p class="info"><?php echo $info; ?></p>
    </div>
<?php  } ?>

</div>
</body>
</html>