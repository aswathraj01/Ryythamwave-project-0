<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: adminlogin.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "ryythmwave");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch track details if an ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM tracks WHERE id = $id");
    $track = $result->fetch_assoc();
} else {
    die("No track ID specified.");
}

// Update track details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $title = $_POST['title'];
    $album_id = $_POST['album_id'];
    $artist_id = $_POST['artist_id'];
    $path = $_POST['path'];

    $sql = "UPDATE tracks SET title = '$title', album_id = '$album_id', artist_id = '$artist_id', path = '$path' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Track updated successfully";
        header("Location: edit_track.php?id=$id"); // Refresh page to show updated data
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Track</title>
    <style>
        /* Existing styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #0c697d;
        }

        .container {
            padding: 20px;
        }

        .header {
            background-color: #2196F3;
            color: #fff;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            border-radius: 5px;
            margin-bottom: 20px;
            position: relative;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .form-group input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group input[type="text"]:focus {
            border-color: #4CAF50;
            outline: none;
        }

        .submit-btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }

        .back-button {
            position: absolute;
            left: 20px;
            top: 5px;
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="../../admin_panel.php" class="back-button">Back</a>
            Edit Track
        </div>
        <div class="form-container">
            <h2>Edit Track</h2>
            <form action="edit_track.php" method="post">
                <input type="hidden" name="id" value="<?php echo $track['id']; ?>">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($track['title']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="album_id">Album ID:</label>
                    <input type="text" id="album_id" name="album_id" value="<?php echo htmlspecialchars($track['album_id']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="artist_id">Artist ID:</label>
                    <input type="text" id="artist_id" name="artist_id" value="<?php echo htmlspecialchars($track['artist_id']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="path">Track Path:</label>
                    <input type="text" id="path" name="path" value="<?php echo htmlspecialchars($track['path']); ?>" required>
                </div>
                <button type="submit" class="submit-btn">Update Track</button>
            </form>
        </div>
    </div>
</body>
</html>
