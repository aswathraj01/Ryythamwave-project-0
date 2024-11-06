<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ryythmwave";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch music tracks from the 'tracks' table and artist names from the 'artists' table
$sql = "SELECT tracks.id, tracks.title, artists.artist_name 
        FROM tracks 
        JOIN artists ON tracks.artist_id = artists.id"; // Make sure to replace 'artist_id' with the actual foreign key name
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RhythmWave - Home</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script>
   function showSection(section) {
    // Hide all sections
    document.querySelectorAll('#home, #tracks').forEach((el) => {
        el.style.display = 'none';
    });

    // Reset all buttons
    document.querySelectorAll('.tabs button').forEach((btn) => {
        btn.classList.remove('active');
    });

    // Show the selected section
    document.getElementById(section).style.display = 'block';
    // Set the active button
    document.querySelector(`.tabs button:contains('${section === 'home' ? "Today's Top Picks" : "Trending Songs"}')`).classList.add('active');
}

    </script>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <img src="../public/assets/images/logo.png" alt="RhythmWave Logo" class="logo">
            <div class="sidebar-icons">
            <a href="javascript:void(0);" onclick="showSection('home')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                    <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z"/>
                </svg><span class="text"></span></a>
            </div>
            <div class="sidebar-icons">
                <a href="javascript:void(0);" onclick="showSection('tracks')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-file-earmark-music" viewBox="0 0 16 16">
                    <path d="M11 6.64a1 1 0 0 0-1.243-.97l-1 .25A1 1 0 0 0 8 6.89v4.306A2.6 2.6 0 0 0 7 11c-.5 0-.974.134-1.338.377-.36.24-.662.628-.662 1.123s.301.883.662 1.123c.364.243.839.377 1.338.377s.974-.134 1.338-.377c.36-.24.662-.628.662-1.123V8.89l2-.5z"/>
                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                </svg><span class="text"></span></a>
            </div>
            <div class="sidebar-icons">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-mic" viewBox="0 0 16 16">
                    <path d="M3.5 6.5A.5.5 0 0 1 4 7v1a4 4 0 0 0 8 0V7a.5.5 0 0 1 1 0v1a5 5 0 0 1-4.5 4.975V15h3a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1h3v-2.025A5 5 0 0 1 3 8V7a.5.5 0 0 1 .5-.5"/>
                    <path d="M10 8a2 2 0 1 1-4 0V3a2 2 0 1 1 4 0zM8 0a3 3 0 0 0-3 3v5a3 3 0 0 0 6 0V3a3 3 0 0 0-3-3"/>
                </svg>
            </div>
            <div class="sidebar-icons">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-collection-play" viewBox="0 0 16 16">
                    <path d="M2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3m2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1m2.765 5.576A.5.5 0 0 0 6 7v5a.5.5 0 0 0 .765.424l4-2.5a.5.5 0 0 0 0-.848z"/>
                    <path d="M1.5 14.5A1.5 1.5 0 0 1 0 13V6a1.5 1.5 0 0 1 1.5-1.5h13A1.5 1.5 0 0 1 16 6v7a1.5 1.5 0 0 1-1.5 1.5zm13-1a.5.5 0 0 0 .5-.5V6a.5.5 0 0 0-.5-.5h-13A.5.5 0 0 0 1 6v7a.5.5 0 0 0 .5.5z"/>
                </svg>
            </div>
            <div class="sidebar-icons">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-music-note-list" viewBox="0 0 16 16">
                    <path d="M12 13c0 1.105-1.12 2-2.5 2S7 14.105 7 13s1.12-2 2.5-2 2.5.895 2.5 2"/>
                    <path fill-rule="evenodd" d="M12 3v10h-1V3z"/>
                    <path d="M11 2.82a1 1 0 0 1 .804-.98l3-.6A1 1 0 0 1 16 2.22V4l-5 1z"/>
                    <path fill-rule="evenodd" d="M0 11.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5m0-4A.5.5 0 0 1 .5 7H8a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5m0-4A.5.5 0 0 1 .5 3H8a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5"/>
                </svg>
            </div>
            <div class="sidebar-icons">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3H4a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                </svg>
            </div>
            <div class="sidebar-icons">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
              </svg>
            </div>
        </div>
    
        
        <!-- Main Content -->
        <div id="home" class="main-content">
            <div class="top-nav">
                <div class="search-container">
                    <input type="text" placeholder="Search...">
                    <button class="search-button"><i class="bi bi-search"></i></button>
                </div>
                <div class="auth">
                    <button class="auth-button register" onclick="location.href='../userreg.html'">Register</button>
                    <button class="auth-button login" onclick="location.href='../Login.html'">Login</button>
                </div>                
            </div>

            <div class="music-section">
                <div class="tabs">
                    <button class="active">Today's Top Picks</button>
                    <button>Trending Songs</button>
                    <button>New Releases</button>
                    <div class="active-slide"></div>
                </div>
                <?php
                if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="music-item" data-index="' . $row["id"] . '">';
        echo '<div class="cover"><button class="play-btn"><i class="bi bi-play-circle"></i></button></div>';
        echo '<div class="info"><h4>' . $row["title"] . '</h4><p>' . $row["artist_name"] . '</p></div>'; // Change 'artist' to 'artist_name'
        echo '<div class="actions"><i class="fas fa-heart"></i><i class="fas fa-ellipsis-h"></i></div>';
        echo '</div>';
    }
} else {
    echo "No tracks found.";
}                
          
$conn->close();
?>      
            </div>
        </div>


        <div id="tracks" class="main-content" style="display: none;">
    <div class="top-nav">
        <div class="search-container">
            <input type="text" placeholder="Search...">
            <button class="search-button">Search</button>
        </div>
        <div class="auth">
            <button class="auth-button register" onclick="location.href='../userreg.html'">Register</button>
            <button class="auth-button login" onclick="location.href='../Login.html'">Login</button>
        </div>                
    </div>
    <h2>Your Tracks</h2>
</div>

        <!-- Player Controls -->
        <div id="player">
            <div id="song-info">
              <img id="album-cover" src="path-to-default-image.jpg" alt="Album cover" />
              <div id="song-details">
                <p id="song-title">Song Title</p>
                <p id="song-artist">Artist Name</p>
              </div>
            </div>
          
            <div id="controls">
              <button id="prev"><i class="fa fa-backward"></i></button>
              <button id="play-pause"><i class="fa fa-play"></i></button>
              <button id="next"><i class="fa fa-forward"></i></button>
              <button id="shuffle"><i class="fa fa-random"></i></button>
            </div>
          
            <div id="progress">
                <div id="current-time">00:00</div>
                <input type="range" min="0" max="100" value="0" class="seek_slider" id="seek-slider">
                <div id="total-time">00:00</div>
            </div>
            
          
            <div id="volume">
                <i class="fa fa-volume-down"></i>
                <input type="range" min="1" max="100"
                    value="99" class="volume_slider" onchange="setVolume()">
                <i class="fa fa-volume-up"></i>
                </div>
        </div>
    <script src="music.js"></script>
    <script src="script.js"></script>
</div>
</body>
</html>