<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $pesan = $_POST['pesan'];
    // Retrieve other form fields
    
    $query = "UPDATE pesan SET pesan=? WHERE id=?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $pesan,$id);

    if ($stmt->execute()) {
        // Successful update
        session_start();
        $_SESSION['success_message'] = "Data has been successfully updated.";
        header('Location: index.php');
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
