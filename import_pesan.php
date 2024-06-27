<?php session_start(); // Mulai sesi jika belum dimulai
include 'db.php';

$successCount = 0; // Inisialisasi hitung data yang berhasil diinsert

if (isset($_POST["Import"])) {
    if ($_FILES["file"]["error"] == 0) {
        $filename = $_FILES["file"]["tmp_name"];
        $file = fopen($filename, "r");

        if ($file) {
            while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {
                // Perhatikan indeks kolom yang benar
                $pesan = $emapData[0]; // Ganti dengan indeks yang sesuai

                if (!empty($pesan)) {
                    // Periksa apakah nama sudah ada dalam tabel
                    $checkQuery = $conn->prepare("SELECT COUNT(*) FROM pesan WHERE pesan = ?");
                    $checkQuery->bind_param("s", $pesan);
                    $checkQuery->execute();
                    $checkQuery->bind_result($count);
                    $checkQuery->fetch();
                    $checkQuery->close();

                    if ($count == 0) {
                        // Nama belum ada dalam tabel, lakukan operasi INSERT
                        $insertQuery = $conn->prepare("INSERT INTO pesan (pesan) VALUES (?)");

                        if (!$insertQuery) {
                            echo "Error: " . $conn->error . "<br>";
                        } else {
                            $insertQuery->bind_param("s", $pesan);

                            if ($insertQuery->execute()) {
                                $successCount++; // Tambah hitungan data yang berhasil diinsert
                            } else {
                                echo "Error: " . $conn->error . "<br>";
                            }

                            // Tutup prepared statement
                            $insertQuery->close();
                        }
                    } else {
                        // Nama sudah ada dalam tabel, skip operasi INSERT
                        echo "Pesan '$pesan' sudah ada dalam tabel, data tidak diinsert.<br>";
                    }
                }
            }

            // Tutup file
            fclose($file);

            $_SESSION['success_message'] = "$successCount data berhasil diinsert.";
            header('Location: index.php');
            exit;
        } else {
            echo "Gagal membuka file.<br>";
        }
    } else {
        echo "Error dalam mengunggah file.<br>";
    }
}

// Tutup koneksi
$conn->close();
 ?>