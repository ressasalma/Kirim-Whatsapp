
<?php
// Include your database connection file
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kategori = $_POST['kategori'];
    $nama = $_POST['nama'];
    $whatsapp = $_POST['whatsapp'];
    // Retrieve other form fields

    // Prepare the SQL query to insert data into the database
    $query = "INSERT INTO kontak (kategori, nama, whatsapp) VALUES (?, ?, ?)";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $kategori, $nama, $whatsapp);

    if ($stmt->execute()) {
        // Successful insertion
        session_start();
        $_SESSION['success_message'] = "Data has been successfully added.";
        header("Location: index.php");
        exit();
    } else {
        // Error handling
        echo "Insertion failed: " . $stmt->error;
    }
}
?>


<html><head>
        <title>Form</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <style>
            .custom-card {
                border: 1px solid #ccc;
                border-radius: 10px;
                margin-top: 20px;
                box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            }
            .card-content {
                padding: 20px;
            }
            .form-group label {
                font-weight: bold;
                margin-bottom: 5px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card custom-card">
                        <div class="card-content">
                           <form method="POST" action="">
                                <div class="form-group">
                                    <h1>Tambah Data Kontak</h1>
                                        <div class="form-group">
                                            <label for="whatsapp">Whatsapp :</label>
                                            <input type="text" name="whatsapp" placeholder="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori">Kategori :</label>
                                            <input type="text" name="kategori" placeholder="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="whatsapp">Nama  :</label>
                                            <input type="text" name="nama" placeholder="" class="form-control">
                                        </div>
                                        <button class="btn btn-primary" type="submit" name="submit">Tambah</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
    </body></html>