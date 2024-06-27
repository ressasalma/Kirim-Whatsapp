<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id = mysqli_real_escape_string($conn, $id); // Sanitize the input

    $query = "DELETE FROM kontak WHERE id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        session_start();
        $_SESSION['success_message'] = "Data has been successfully deleted.";
        header("Location: index.php");
        exit();
    } else {
        // Error handling
        echo "Delete failed: " . $stmt->error;
    }
} else {
    // Redirect or show an error message
    echo "Failed";
}
?>
