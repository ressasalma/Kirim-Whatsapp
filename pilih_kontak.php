<?php 
include 'db.php';
session_start();

if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']); // Clear the message
} else if (isset($_SESSION['error_message'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']); // Hapus pesan dari session
        }

?>  
 <html><head>
        <title>Form</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="Import Excel File To MySql Database Using php">
	    <link rel="stylesheet" href="css/bootstrap.min.css">
	    <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
	    <link rel="stylesheet" href="css/bootstrap-custom.css">
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <style>
          input[type="radio"][name="selected_kontak"] {
            display: none; /* Menggunakan display: none; untuk menyembunyikan radio button */
          }
        </style>

	    <?php
    // ... Kode yang ada sebelumnya

    // Menghitung jumlah total data dalam tabel
    $total_records = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kontak"));

	$SQLSELECT = "SELECT * FROM kontak";
	$result_set = mysqli_query($conn, $SQLSELECT);


    // ... Kode yang ada setelahnya
    ?>
    </head>
    <?php

    $SQLSELECT = "SELECT * FROM kontak";
    $result_set = mysqli_query($conn, $SQLSELECT);


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id = mysqli_real_escape_string($conn, $id); // Sanitize the input

    $query = "SELECT * FROM pesan WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "Failed to fetch data: " . mysqli_error($conn);
        exit;
    }
} else {
    // Redirect or show an error message
    echo "Gagal";
    exit;
}?>
    <body>
        <div class="container">
            <div class="row">
                <div class="col">
                    <br><br>
                    <div class="card custom-card">
                        <div class="card-content">
                		<h1 align="center">Pilih Kontak</h1><br>
                		<div class="form-group">
					    <label for="kategori">Pilih Kategori:</label>
					    <select class="form-control" id="kategori" onchange="filterKategori()">
					        <option value="">Semua Kategori</option>
					        <?php
					        // Query untuk mengambil daftar kategori unik dari tabel kontak
					        $queryKategori = "SELECT DISTINCT kategori FROM kontak";
					        $kategoriResult = mysqli_query($conn, $queryKategori);
					        
					        while ($kategoriRow = mysqli_fetch_assoc($kategoriResult)) {
					            echo "<option value='" . $kategoriRow['kategori'] . "'>" . $kategoriRow['kategori'] . "</option>";
					        }
					        ?>
					    </select>
					</div>
					<div class="form-group">
				    <label for="search">Cari Kontak:</label>
				    <input type="text" class="form-control" id="search" onkeyup="searchData()" placeholder="Masukkan kata kunci">
				</div>


							<br>
							<form action="send.php" method="post" id="pesan-form">
                                <a href="index.php" class="btn btn-secondary">Back to Index</a><br><br>
								<a href="tambah_kontak.php" class="btn btn-primary">Tambah Data Kontak</a><br><br>
							    <input type="hidden" name="pesan" id="pesan" value="<?php echo $data['pesan']; ?>">
							    <table class="table table-bordered" >
							        <thead>
							            <tr>
							                <th>Kategori</th>
							                <th>Nama</th>
							                <th>Whatsapp</th>
							                <th>Action</th><!-- Tambah kolom untuk radio button -->
							            </tr>
							        </thead>
							        <tbody>
							            <?php while ($row = mysqli_fetch_array($result_set)) { ?>
							                <tr>
							                    <td><?php echo $row['kategori']; ?></td>
							                    <td><?php echo $row['nama']; ?></td>
							                    <td><?php echo $row['whatsapp']; ?></td>
							                    <td>
							                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
							                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                                                    <button class="btn btn-primary" onclick="whatsapp(this)">Kirim</button>
                                                    <input type="radio" name="selected_kontak" value="<?php echo $row['whatsapp']; ?>" required>
							                    </td>
							                    
							                </tr>
							            <?php } ?>
							        </tbody>
							    </table>
							    <br><br>
							    <!-- Tombol "Proses" untuk form -->
							    
							</form>
							
						</div>
					</div>
				</div>
			</div>
		</div>
<script>
function whatsapp(button) {
    // Menggunakan parentNode untuk mencari elemen <tr> yang mengandung tombol "Kirim"
    var row = button.parentNode.parentNode;
    
    // Menggunakan querySelector untuk mencari radio button di dalam baris tersebut
    var radioButton = row.querySelector('input[type="radio"][name="selected_kontak"]');
    
    // Memeriksa apakah ada radio button yang ditemukan
    if (radioButton) {
        radioButton.checked = true; // Menandai radio button sebagai terpilih
    }
}

    function openFormatPopup() {
        const formatModal = document.getElementById('formatModal');
        formatModal.classList.add('show-modal');
    }

    function closeFormatPopup() {
        const formatModal = document.getElementById('formatModal');
        formatModal.classList.remove('show-modal');
    }
    function filterKategori() {
        var selectedKategori = document.getElementById("kategori").value;
        var table = document.querySelector("table");
        var rows = table.getElementsByTagName("tr");

        for (var i = 1; i < rows.length; i++) {
            var currentRow = rows[i];
            var cell = currentRow.getElementsByTagName("td")[0]; // Kolom Kategori

            if (cell) {
                var kategori = cell.textContent || cell.innerText;

                if (selectedKategori === "" || kategori === selectedKategori) {
                    currentRow.style.display = "";
                } else {
                    currentRow.style.display = "none";
                }
            }
        }
    }
    function searchData() {
        var input, filter, table, tr, td, i, j, txtValue, found;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.querySelector("table");
        tr = table.getElementsByTagName("tr");

        for (i = 1; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");

            found = false;

            for (j = 0; j < td.length; j++) {
                txtValue = td[j].textContent || td[j].innerText;

                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }

            if (found) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }

</script>

    </body>
</html>

				

