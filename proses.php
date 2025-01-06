<?php
// Delay untuk memberikan efek "Proses berjalan"
$delay = 3; // waktu delay dalam detik

// Tentukan halaman tujuan setelah proses selesai
$nextPage = "checkout.php";

// Redirect otomatis setelah delay
header("refresh:$delay;url=$nextPage");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Berjalan</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .message-container {
            background: white;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        h1 {
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <div class="spinner"></div>
        <h1>Proses berjalan... Mohon tunggu sebentar.</h1>
    </div>
</body>
</html>
