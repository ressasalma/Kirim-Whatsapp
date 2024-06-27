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
<?php
include 'db.php';

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
}

// ... Your HTML and form code
?>


<head>
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
                           <form method="POST" action="update_pesan.php">
                                <div class="form-group">
                                    <h1>Edit Pesan</h1>
                                    <br><br>
                                    <a href="index.php" class="btn btn-primary">Back to Index</a><br><br>
                                        <div class="form-group">
                                           <div class="form-group will-hide">
                                                <div class="toolbar">
                                                <div class="item" data-tool="bold">B</div>
                                                <div class="item" data-tool="italic">I</div>
                                                <div class="item" data-tool="striketrhough">S</div>
                                                </div>
                                                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                                <textarea class="form-control" name="pesan" placeholder="Isi pesan Whatapps anda ..." id="input-message"><?php echo $data['pesan']; ?></textarea>
                                                </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit" name="submit">Update</button>
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