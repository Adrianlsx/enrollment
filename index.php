<?php
// Database configuration
$host = getenv('DB_HOST'); // Use environment variable
$dbname = getenv('DB_NAME');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to insert student data into the table
function insertStudent($conn, $data) {
    $stmt = $conn->prepare("INSERT INTO student (student_name, phone_number, religion, mothers_name, mothers_number, fathers_name, fathers_number, guardian_name, guardian_number, email, lrn_number, address, grade, strand, track, date_of_birth) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssssssss", 
        $data['student_name'], $data['phone_number'], $data['religion'], 
        $data['mothers_name'], $data['mothers_number'], $data['fathers_name'], 
        $data['fathers_number'], $data['guardian_name'], $data['guardian_number'], 
        $data['email'], $data['lrn_number'], $data['address'], $data['grade'], 
        $data['strand'], $data['track'], $data['date_of_birth']
    );

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentData = array(
        'student_name' => $_POST['student_name'],
        'phone_number' => $_POST['phone_number'],
        'religion' => $_POST['religion'],
        'mothers_name' => $_POST['mothers_name'],
        'mothers_number' => $_POST['mothers_number'],
        'fathers_name' => $_POST['fathers_name'],
        'fathers_number' => $_POST['fathers_number'],
        'guardian_name' => $_POST['guardian_name'],
        'guardian_number' => $_POST['guardian_number'],
        'email' => $_POST['email'],
        'lrn_number' => $_POST['lrn_number'],
        'address' => $_POST['address'],
        'grade' => $_POST['grade'],
        'strand' => $_POST['strand'],
        'track' => $_POST['track'],
        'date_of_birth' => $_POST['date_of_birth']
    );

    // Call the insert function
    insertStudent($conn, $studentData);
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Online Enrollment Form</title>
</head>
<body>
    <div class="container">
        <h1>LUNHS SHS Enrollment Form</h1>
        <div class="form-box">
            <form action="" method="post">
                <label for="student_name">Student Name:</label>
                <input type="text" id="student_name" name="student_name" required>
                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" pattern="\d{11}" maxlength="11" required>
                <label for="religion">Religion:</label>
                <input type="text" id="religion" name="religion" required>
                <label for="mothers_name">Mother's Name:</label>
                <input type="text" id="mothers_name" name="mothers_name" required>
                <label for="mothers_number">Mother's No.:</label>
                <input type="text" id="mothers_number" name="mothers_number" pattern="\d{11}" maxlength="11" required>
                <label for="fathers_name">Father's Name:</label>
                <input type="text" id="fathers_name" name="fathers_name" required>
                <label for="fathers_number">Father's No.:</label>
                <input type="text" id="fathers_number" name="fathers_number" pattern="\d{11}" maxlength="11" required>
                <label for="guardian_name">Guardian Name:</label>
                <input type="text" id="guardian_name" name="guardian_name" required>
                <label for="guardian_number">Guardian No.:</label>
                <input type="text" id="guardian_number" name="guardian_number" pattern="\d{11}" maxlength="11" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="lrn_number">LRN Number (12 digits):</label>
                <input type="text" id="lrn_number" name="lrn_number" pattern="\d{12}" maxlength="12" required>
                <label for="address">Address:</label>
                <textarea id="address" name="address" required></textarea>
                <label for="grade">Select Grade:</label>
                <select id="grade" name="grade" required>
                    <option value="Grade 11">Grade 11</option>
                    <option value="Grade 12">Grade 12</option>
                </select>
                <label for="strand">Select Strand:</label>
                <select id="strand" name="strand" required>
                    <option value="STEM">STEM</option>
                    <option value="TVL">TVL</option>
                    <option value="ABM">ABM</option>
                    <option value="HUMSS">HUMSS</option>
                </select>
                <div id="tvl-tracks" style="display:none;">
                    <label for="track">Select TVL Track:</label>
                    <select id="track" name="track">
                        <option value="ICT">ICT</option>
                        <option value="HE">HE</option>
                    </select>
                </div>
                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" id="date_of_birth" name="date_of_birth" required>
                <input type="submit" value="Enroll">
            </form>
        </div>
        <script>
            document.getElementById('strand').addEventListener('change', function() {
                document.getElementById('tvl-tracks').style.display = this.value === 'TVL' ? 'block' : 'none';
            });
        </script>
    </div>
</body>
</html>
