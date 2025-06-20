<?php
include 'db.php';
session_start();

// Set header for JSON response
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Static fallback user
    $static_email = 'admin@example.com';
    $static_password = 'admin123'; // plain text for this example

    // Check against static user first
    if ($email === $static_email && $password === $static_password) {
        $_SESSION['user_id'] = 0; // use 0 or -1 for static/fake user
        $_SESSION['user_name'] = 'Static Admin';
        
        // Return JSON response instead of redirect
        echo json_encode([
            'success' => true,
            'redirect' => '../backend/dashboard.php'
        ]);
        exit();
    }

    // Else fallback to DB user check
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $name, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            
            // Return JSON response instead of redirect
            echo json_encode([
                'success' => true,
                'redirect' => '../backend/dashboard.php'
            ]);
            exit();
        } else {
            // Return JSON error
            echo json_encode([
                'success' => false,
                'message' => 'Invalid credentials'
            ]);
            exit();
        }
    } else {
        // Return JSON error
        echo json_encode([
            'success' => false,
            'message' => 'User not found'
        ]);
        exit();
    }
}

// If request method is not POST
echo json_encode([
    'success' => false,
    'message' => 'Invalid request method'
]);
?>