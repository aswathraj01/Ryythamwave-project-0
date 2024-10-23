let playpause_btn = document.getElementById("play-pause");
let next_btn = document.getElementById("next");
let prev_btn = document.getElementById("prev");
let shuffle_btn = document.getElementById("shuffle");
let volume_slider = document.querySelector(".volume_slider");
let curr_time = document.getElementById("current-time");
let total_duration = document.getElementById("total-time");
let seek_slider = document.getElementById("seek-slider"); // Ensure this is defined early

let track_index = 0;
let isPlaying = false;
let isShuffling = false;
let updateTimer;

let curr_track = document.createElement('audio');

// Define the tracks
let track_list = [
  {
    name: "Big Dawgs",
    artist: "HanuMankind and Kalmi",
    image: "../public/assets/images/hanumankind1.jpg",
    path: "../public/assets/resource/Big Dawgs.mp3"
  },
  {
    name: "Sunflower (Spider-Man: Into the Spider-Verse) Radio",
    artist: "Post Malone & Swae Lee",
    image: "https://c.saavncdn.com/658/Sunflower-Spider-Man-Into-the-Spider-Verse--English-2018-20181018121039-500x500.jpg",
    path: "../public/assets/resource/Sunflower.mp3"
  }
];

// Load the first track
loadTrack(track_index);

// Event listeners for buttons
playpause_btn.addEventListener("click", playpauseTrack);
next_btn.addEventListener("click", nextTrack);
prev_btn.addEventListener("click", prevTrack);
shuffle_btn.addEventListener("click", toggleShuffle);
seek_slider.addEventListener("input", seekTo); // Event listener for seek slider

function loadTrack(track_index) {
  clearInterval(updateTimer);
  resetValues();
  curr_track.src = track_list[track_index].path;
  curr_track.load();

  // Update track details
  document.getElementById("album-cover").src = track_list[track_index].image;
  document.getElementById("song-title").textContent = track_list[track_index].name;
  document.getElementById("song-artist").textContent = track_list[track_index].artist;

  updateTimer = setInterval(seekUpdate, 1000);
  curr_track.addEventListener("ended", nextTrack);
}

function playpauseTrack() {
  if (!isPlaying) {
    playTrack();
  } else {
    pauseTrack();
  }
}

function playTrack() {
  curr_track.play();
  isPlaying = true;
  playpause_btn.innerHTML = '<i class="fa fa-pause"></i>'; // Change icon to pause
}

function pauseTrack() {
  curr_track.pause();
  isPlaying = false;
  playpause_btn.innerHTML = '<i class="fa fa-play"></i>'; // Change icon to play
}

function nextTrack() {
  if (isShuffling) {
    track_index = Math.floor(Math.random() * track_list.length);
  } else {
    track_index = (track_index + 1) % track_list.length;
  }
  loadTrack(track_index);
  playTrack();
}

function prevTrack() {
  if (track_index > 0) {
    track_index -= 1;
  } else {
    track_index = track_list.length - 1;
  }
  loadTrack(track_index);
  playTrack();
}

function toggleShuffle() {
  isShuffling = !isShuffling;
  shuffle_btn.classList.toggle("active", isShuffling);
}

function resetValues() {
  curr_time.textContent = "00:00";
  total_duration.textContent = "00:00";
  seek_slider.value = 0;
}

function setVolume() {
  curr_track.volume = volume_slider.value / 100;
}

function seekTo() {
  if (!isNaN(curr_track.duration)) { // Check if duration is valid
    let seekto = curr_track.duration * (seek_slider.value / 100); // Only define seekto here
    curr_track.currentTime = seekto; // Set the current time of the audio
  } else {
    console.error("Current track duration is not valid.");
  }
}

function seekUpdate() {
  if (!isNaN(curr_track.duration)) {
    let seekPosition = curr_track.currentTime * (100 / curr_track.duration);
    seek_slider.value = seekPosition;

    let currentMinutes = Math.floor(curr_track.currentTime / 60);
    let currentSeconds = Math.floor(curr_track.currentTime - currentMinutes * 60);
    let durationMinutes = Math.floor(curr_track.duration / 60);
    let durationSeconds = Math.floor(curr_track.duration - durationMinutes * 60);

    curr_time.textContent = `${String(currentMinutes).padStart(2, '0')}:${String(currentSeconds).padStart(2, '0')}`;
    total_duration.textContent = `${String(durationMinutes).padStart(2, '0')}:${String(durationSeconds).padStart(2, '0')}`;
  }
}
