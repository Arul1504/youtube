<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip Dokumen Kuliah</title>
</head>
<style>
    body {
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    #container {
        width: 100%;
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    #header {
        background-color: #4caf50;
        color: #fff;
        padding: 15px;
    }

    #header h1 {
        margin: 0;
    }

    #header span {
        font-style: italic;
    }

    #menu {
        background-color: #333;
        overflow: hidden;
    }

    #menu a {
        float: left;
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    #menu a.active {
        background-color: #555;
    }

    #menu a:hover {
        background-color: #555;
    }

    #content {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
    }

    .searchInput {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .searchInput input {
        flex: 1;
        background-color: #fff;
        color: #000;
        border: none;
        padding: 10px;
        text-align: center;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 4px;
    }

    .searchInput button {
        background-color: #4caf50;
        color: white;
        border: none;
        padding: 10px 20px;
        text-align: center;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 4px;
    }

    #results {
        list-style: none;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-evenly;
    }

    #results li {
        width: 45%;
        margin-bottom: 20px;
        text-align: center;
    }

    @media screen and (max-width: 768px) {
        #results li {
            width: 100%;
            margin-bottom: 10px;
        }
    }

    @media screen and (min-width: 769px) {
        #results li {
            width: 45%;
            margin-bottom: 20px;
        }
    }

    .thumbnail-iframe {
        width: 100%;
        height: 180px;
        border: none;
        cursor: pointer;
        object-fit: cover;
    }


    #fullscreen-btn {
        background-color: #4caf50;
        color: white;
        border: none;
        padding: 10px 20px;
        text-align: center;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 4px;
    }
</style>


<body>

    <div id="container">
        <div id="header">
            <h1>Arsip Dokumen Kuliah</h1>
            <span>@Arul</span>
        </div>

        <div id="menu">
            <a href="index.php" class="active">Home</a>
            <a href="upload.php">Upload Data</a>
            <a href="download.php">Data Kuliah</a>
            <form id="logout" method="post" style="display: inline-block;">
                <button name='logout' type="submit" id="logoutButton" onclick="confirmLogout()">Logout</button>
            </form>
        </div>

        <div id="content">
            <h2>Home</h2>
            <p>Selamat Datang!</p>
            <p>Berikut merupakan search untuk YOUTUBE</p>
            <div class="searchInput">
                <img src="youtube.png" alt="YouTube Logo" width="30" height="30">
                <!-- Ganti 'youtube_logo.png' dengan URL atau path logo YouTube Anda -->
                <input type="text" id="searchInput" placeholder="Enter search keywords">
                <button onclick="searchYouTube()">Search</button>
            </div>
            <div>
                <ul id="results"></ul>
            </div>
        </div>
    </div>
    <button id="fullscreen-btn" onclick="toggleFullscreen()">Toggle Fullscreen</button>


</body>
<script>
    function toggleFullscreen() {
        const doc = window.document;
        const docEl = doc.documentElement;

        const requestFullScreen = docEl.requestFullscreen || docEl.mozRequestFullScreen || docEl.webkitRequestFullScreen || docEl.msRequestFullscreen;
        const cancelFullScreen = doc.exitFullscreen || doc.mozCancelFullScreen || doc.webkitExitFullscreen || doc.msExitFullscreen;

        if (!doc.fullscreenElement && !doc.mozFullScreenElement && !doc.webkitFullscreenElement && !doc.msFullscreenElement) {
            requestFullScreen.call(docEl);
        } else {
            cancelFullScreen.call(doc);
        }
    }
    var videoPlayer = document.getElementById('mainVideo');
    var currentVideoIndex = 0;
    var videoUrls = [];

    function playPreviousVideo() {
        if (!searchPerformed) {
            alert("Silahkan cari lagu terlebih dahulu.");
            return;
        }

        currentVideoIndex = (currentVideoIndex - 1 + videoUrls.length) % videoUrls.length;
        playVideoAtIndex(currentVideoIndex);
    }

    function playNextVideo() {
        if (!searchPerformed) {
            alert("Silahkan cari lagu terlebih dahulu.");
            return;
        }

        currentVideoIndex = (currentVideoIndex + 1) % videoUrls.length;
        playVideoAtIndex(currentVideoIndex);
    }


    function playVideoAtIndex(index) {
    // Hentikan pemutaran video saat ini jika ada
    if (videoPlayer && !videoPlayer.paused) {
        videoPlayer.pause();
    }

    // Mulai memutar video baru
    var nextVideoUrl = videoUrls[index];
    videoPlayer.src = nextVideoUrl;
    videoPlayer.play();
}

    function confirmLogout() {
        var confirmation = confirm("Anda yakin ingin logout?");
        if (!confirmation) {
            event.preventDefault(); // Mencegah formulir di-submit jika pembatalan dilakukan
        }
    }

    function showRecommendations() {
        // Daftar rekomendasi video (ganti sesuai kebutuhan)
        var recommendations = [
            { title: 'Recommended Video 1', url: 'https://www.youtube.com/embed/example_video_url_1' },
            { title: 'Recommended Video 2', url: 'https://www.youtube.com/embed/example_video_url_2' },
            { title: 'Recommended Video 3', url: 'https://www.youtube.com/embed/example_video_url_3' },
        ];

        // Tampilkan rekomendasi video
        var recommendationsContainer = document.getElementById('recommendations');
        recommendationsContainer.innerHTML = '';

        recommendations.forEach(function (recommendation) {
            var iframe = document.createElement('iframe');
            iframe.width = '280';
            iframe.height = '160';
            iframe.src = recommendation.url;
            iframe.title = recommendation.title;
            iframe.classList.add('recommendation');
            iframe.onclick = function () {
                videoPlayer.src = recommendation.url;
                videoPlayer.play();
            };

            recommendationsContainer.appendChild(iframe);
        });
    }
    function displayResults(results) {
    const resultsContainer = document.getElementById('results');
    resultsContainer.innerHTML = '';

    if (results && results.length > 0) {
        results.reverse();

        results.forEach(result => {
            const videoId = result.id.videoId;
            const playlistId = result.id.playlistId;
            const title = result.snippet.title;
            const isPlaylist = result.id.kind === 'youtube#playlist';

            const iframe = document.createElement('iframe');
            iframe.width = '100%';
            iframe.height = '180';
            iframe.allowFullscreen = true;

            if (isPlaylist) {
                iframe.src = `https://www.youtube.com/embed/videoseries?list=${playlistId}`;
            } else {
                iframe.src = `https://www.youtube.com/embed/${videoId}?si=${videoId}`;
                iframe.onclick = function () {
                    videoPlayer.src = `https://www.youtube.com/embed/${videoId}?si=${videoId}`;
                    videoPlayer.play();
                };
            }

            iframe.title = title;
            iframe.classList.add('thumbnail-iframe');

            const downloadButton = document.createElement('a');
            downloadButton.href = `https://www.ssyoutube.com/watch?v=${videoId}`; // Contoh tautan menggunakan layanan ssyoutube.com
            downloadButton.target = '_blank';
            downloadButton.innerText = 'Download';

            const listItem = document.createElement('li');
            listItem.innerHTML = `
                <h3>${title}</h3>
                ${iframe.outerHTML}
                <p>${downloadButton.outerHTML}</p>
            `;

            resultsContainer.appendChild(listItem);
        });
    } else {
        console.error('Results are undefined or empty:', results);
    }
}





    function searchYouTube() {
        const apiKey = 'AIzaSyDX0aOP6Fs4LRj2dpZ6WKns4XZlKuvlGJ8'; // Ganti dengan kunci API Anda
        const searchInput = document.getElementById('searchInput');
        const encodedSearchInput = encodeURIComponent(searchInput.value);

        // Buat URL untuk permintaan pencarian
        const apiUrl = `https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=10&q=${encodedSearchInput}&key=${apiKey}`;

        // Lakukan permintaan HTTP dengan Fetch API
        fetch(apiUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                searchPerformed = true; // Setelah pencarian berhasil, tandai bahwa pencarian telah dilakukan
                displayResults(data.items);
                searchInput.value = ''; // Reset the search input value
            })
            .catch(error => console.error('Error:', error));
    }
    var videoUrls = []; // Kosongkan array videoUrls

    var searchPerformed = false;

</script>

</html>