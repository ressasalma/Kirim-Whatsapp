<?php
include 'db.php';

// Create MySQL connection (Updated connection method)
$connection = mysqli_connect($servername, $username, $password, $dbname);

$sql = "SELECT kategori, nama, link FROM data_jambi"; // Exclude 'id' column
$result = mysqli_query($connection, $sql);

// Generate HTML table for preview
echo '<table border="1">';
echo '<tr>';
echo '<th>Kategori</th>';
echo '<th>Nama</th>';
echo '<th>Link</th>';
echo '</tr>';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['kategori'] . '</td>';
    echo '<td>' . $row['nama'] . '</td>';
    echo '<td>' . $row['link'] . '</td>';
    echo '</tr>';
}

echo '</table>';

mysqli_close($connection);
?>
