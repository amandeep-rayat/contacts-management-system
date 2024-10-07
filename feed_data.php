<?php
$conn = new mysqli('localhost', 'root', '', 'contacts_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "DELETE FROM contacts";
$conn->query($sql);
for ($i = 0; $i < 50; $i++) {
    $name = 'User' . $i;
    $email = 'user' . $i . '@example.com';
    $phone = random_int(pow(10, 9), pow(10, 10) - 1). '';
    $address = '0'.$i.' Main St, Springfield, IL';
    $sql = "INSERT INTO contacts (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";
    $conn->query($sql);
}
$conn->close();
echo 'Data inserted successfully!';
?>