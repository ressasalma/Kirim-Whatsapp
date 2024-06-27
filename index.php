<?php
session_start();
include 'db.php';
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <style type="text/css">.nav-item.dropdown {
    position: relative;
}

.nav-item.dropdown .dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 10rem;
    padding: 0.5rem 0;
    margin: 0.125rem 0 0;
    font-size: 1rem;
    color: #212529;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem;
}

.nav-item.dropdown:hover .dropdown-menu {
    display: block;
}

.nav-item.dropdown .dropdown-item {
    display: block;
    width: 100%;
    padding: 0.25rem 1.5rem;
    clear: both;
    font-weight: 400;
    color: #212529;
    text-align: inherit;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
}

.nav-item.dropdown .dropdown-item:hover,
.nav-item.dropdown .dropdown-item:focus {
    color: #007bff;
    background-color: #f8f9fa;

}</style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col">
                    <br>
                    <div class="card custom-card">
                        <div class="card-content">
                            <h1 align="center">Whatsapp Delivery</h1><br>
                            <div class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" aria-expanded="true" href="javascript:void(0)">
                                <span>
                                    <div class="d-flex badge-pill">
                                        <span class="fa fa-user mr-2"><b> <?php echo $_SESSION['username']; ?></b></span>
                                        <span class="fa fa-angle-down ml-2"></span>
                                    </div>
                                </span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="account_settings" style="">
                                <a class="dropdown-item" onclick="openManagePopup()" id="manage_account"><i
                                        class="fa fa-cog" ></i> Manage Account</a>
                                <a class="dropdown-item" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
                            </div>
                        </div>
<br><br><br><br>
                        <div class="modal" id="manageModal">
                            <div class="modal-content">
                                <h5 class="modal-title">Update Data User</h5><br><br>
                                <form action="update_user.php" method="post">
                                    <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
                                    <div class="form-group">
                                        <label for="newUsername">New Username:</label>
                                        <input type="text" class="form-control" id="newUsername" name="newUsername" value="<?php echo $_SESSION['username']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="newPassword">New Password:</label>
                                        <input type="password" class="form-control" id="newPassword" name="newPassword">
                                    </div>
                                    <!-- Add other form fields for additional attributes -->

                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                                <button class="btn btn-secondary" onclick="closeManagePopup()">Close</button><br>
                            </div>
                        </div>
                <div class="modal" id="formatModal" style="overflow-y: auto;">
                    <div class="modal-content">
                        <h5 class="modal-title">Excel Format</h5>
                        <p>Ini adalah format file excel kontak yang akan diupload:</p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Whatsapp</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Your whatsapp</td>
                                    <td>Your nama</td>
                                    <td>Your kategori</td>
                                </tr>
                            </tbody>
                        </table><form class="form-horizontal well" action="import.php" method="post" name="upload_excel" enctype="multipart/form-data">
                    <fieldset>
                        <div class="control-group">
                            <div class="control-label">
                                <label>CSV/Excel File:</label>
                            </div>
                            <div class="controls">
                                <input type="file" name="file" id="file" class="input-large">
                            </div>
                        </div>
                        <br>
                        <div class="control-group">
                            <div class="controls">
                            <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
                            </div>
                        </div>
                    </fieldset>
                </form><br>
                <p>Ini adalah format file excel pesan yang akan diupload:</p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Pesan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Your message</td>
                                </tr>
                            </tbody>
                        </table>
                <form class="form-horizontal well" action="import_pesan.php" method="post" name="upload_excel" enctype="multipart/form-data">
                    <fieldset>
                        <div class="control-group">
                            <div class="control-label">
                                <label>CSV/Excel File:</label>
                            </div>
                            <div class="controls">
                                <input type="file" name="file" id="file" class="input-large">
                            </div>
                        </div>
                        <br>
                        <div class="control-group">
                            <div class="controls">
                            <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
                            </div>
                        </div>
                    </fieldset>
                </form><br>
                        <a href="download_format.php" class="btn btn-primary">Download Format as Excel</a><br>
                        <button class="btn btn-secondary" onclick="closeFormatPopup()">Close</button>
                    </div>
                </div>
                
                <button class="btn btn-primary" onclick="openFormatPopup()">Import</button>
                <br><br>
                <table class="table table-striped">
                    <a href="tambah_pesan.php" class="btn btn-primary">Tambah Data Pesan</a>
                    <br><br>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" width="75%">Pesan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Mendapatkan daftar tabel dari database
                            $querykontak = "SELECT * FROM pesan";
                            $kontakResult = $conn->query($querykontak);
                            $counter = 1;
                            if ($kontakResult->num_rows > 0) {
                                while ($kontakRow = $kontakResult->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<th scope='row'>" . $counter . "</th>";
                                    echo "<td>" . $kontakRow['pesan'] . "</td>";
                                    echo "<td><a href='edit_pesan.php?id=" . $kontakRow['id'] . "' class='btn btn-warning'>Edit</a> <a href='delete_pesan.php?id=" . $kontakRow['id'] . "' class='btn btn-danger'>Delete</a>
                                        <a href='pilih_kontak.php?id=" . $kontakRow['id'] . "' class='btn btn-primary'>Proses</a></td>";
                                    echo "</tr>";
                                    $counter++;
                                }
                            }
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

        <script>
    function selectPesan(selectedWhatsApp) {
        var pesanSelect = document.getElementById("pesan");
        var selectedOption = pesanSelect.options[pesanSelect.selectedIndex].value;
        document.getElementById("selected_pesan").value = selectedOption;
    }
    function openFormatPopup() {
        const formatModal = document.getElementById('formatModal');
        formatModal.classList.add('show-modal');
    }

    function closeFormatPopup() {
        const formatModal = document.getElementById('formatModal');
        formatModal.classList.remove('show-modal');
    }
    function openManagePopup() {
        const formatModal = document.getElementById('manageModal');
        formatModal.classList.add('show-modal');
    }

    function closeManagePopup() {
        const formatModal = document.getElementById('manageModal');
        formatModal.classList.remove('show-modal');
    }

</script>
    
    </body></html>