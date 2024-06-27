<?php
include 'db.php';
if (isset($_POST['selected_kontak'])) {
    $pesan = $_POST['pesan'];
    $whatsapp = $_POST['selected_kontak'];

    $sql="SELECT nama FROM kontak WHERE whatsapp='$whatsapp'";
    $result = $conn->query($sql);

        // Periksa apakah hasil query mengembalikan baris data
        if ($result->num_rows > 0) {
            // Ambil data dari hasil query
            $data = $result->fetch_assoc();
            
            $nama = ucwords($data['nama']); //nama pengirim
        } else {
            echo "Data pengguna tidak ditemukan";
        }
    // Periksa apakah pesan mengandung kata kunci "$nama"
    if (strpos($pesan, '$nama') !== false) {
        // Ganti kata kunci "$nama" dengan nama penerima
        $pesan = str_replace('$nama', $nama, $pesan);
    } else {
    echo "gagal";
}   
  
}

    

?>
<html>

<head>
    <title>Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
    /* Gaya umum untuk toolbar */
    .toolbar {
        display: flex;
        align-items: center;
        background-color: #f0f0f0;
        padding: 5px;
    }

    /* Gaya untuk item toolbar */
    .item {
        cursor: pointer;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin-right: 5px;
    }

    /* Gaya untuk item yang aktif */
    .item.active {
        background-color: #007bff;
        color: #fff;
    }

    /* Gaya untuk textarea */
    #input-message {
        width: 100%;
        height: 100px;
        /* Untuk mencegah textarea dapat diresize */
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <br><br>
                <h1>Pesan</h1>
                <br><br>
                <button onclick="goBack()" class="btn btn-secondary">Kembali</button>
                <br><br>
                <div class="card custom-card">
                    <div class="card-content">
                        <form method="POST" action="proses_kirim.php" target="_blank">
                            <div class="form-group">

                                <div class="form-group">
                                    <div class="form-group will-hide">
                                        <div class="toolbar">
                                            <div class="item" data-tool="bold">B</div>
                                            <div class="item" data-tool="italic">I</div>
                                            <div class="item" data-tool="striketrhough">S</div>
                                        </div>
                                        <input type="hidden" name="whatsapp" value="<?php echo $whatsapp; ?>">
                                        <input type="hidden" name="nama" value="<?php echo $nama; ?>">
                                        <textarea class="form-control" name="pesan"
                                            id="input-message"><?php echo $pesan; ?></textarea>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit" name="kirim">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    function goBack() {
        window.history.back(); // Fungsi ini akan mengarahkan kembali ke halaman sebelumnya
    }
    </script>
    <script src="https://wa.wizard.id/assets/js/app.js"></script>
    <script src="https://wa.wizard.id/assets/js/clipboard.min.js"></script>
    <script src="https://wa.wizard.id/assets/js/custom.js"></script>
</body>

</html>