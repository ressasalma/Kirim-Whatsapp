<?php
// Include your database connection file
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $pesan = $_POST['pesan'];
    // Retrieve other form fields

    // Prepare the SQL query to insert data into the database
    $query = "INSERT INTO pesan (pesan) VALUES (?)";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $pesan);

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
                    <div class="card custom-card">
                        <div class="card-content">
                           <form method="POST" action="">
                                <div class="form-group">
                                    <h1>Tambah Data Pesan</h1>
                                    <br><br>
                                    <a href="index.php" class="btn btn-primary">Back to Index</a><br><br>
                                        <div class="form-group">
                                           <div class="form-group will-hide">
                                                <div class="toolbar">
                                                <div class="item" data-tool="bold">B</div>
                                                <div class="item" data-tool="italic">I</div>
                                                <div class="item" data-tool="striketrhough">S</div>
                                                </div>
                                                <textarea class="form-control" name="pesan" placeholder="Isi pesan Whatapps anda ..." id="input-message"></textarea>
                                                </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit" name="submit">Tambah</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<script src="https://wa.wizard.id/assets/js/app.js"></script>
<script src="https://wa.wizard.id/assets/js/clipboard.min.js"></script>
<script src="https://wa.wizard.id/assets/js/custom.js"></script>
</body>
</html>
