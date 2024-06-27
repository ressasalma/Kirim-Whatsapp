<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $kategori = $_POST['kategori'];
    $nama = $_POST['nama'];
    $whatsapp = $_POST['whatsapp'];
    // Retrieve other form fields
    
    $query = "UPDATE kontak SET kategori=?, nama=?, whatsapp=? WHERE id=?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $kategori, $nama, $whatsapp, $id);

    if ($stmt->execute()) {
        // Successful update
        session_start();
        $_SESSION['success_message'] = "Data has been successfully updated.";
        header("Location: index.php");
        exit();
    } else {
        // Error handling
        echo "Update failed: " . $stmt->error;
    }
} else {
    // Redirect or show an error message
    echo "Failed";
}
?>
