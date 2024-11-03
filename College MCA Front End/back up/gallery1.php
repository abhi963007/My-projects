<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Gallery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4; /* Light background for contrast */
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: flex-start; /* Align items to the left */
        }

        h1 {
            color: #333; /* Darker color for the header */
            margin-bottom: 20px;
            text-align: center; /* Center the text */
            width: 100%; /* Ensure the text takes full width */
        }

        .button-container {
            display: flex;
            justify-content: space-between; /* Place buttons at extreme ends */
            width: 100%; /* Full width for alignment */
            margin-bottom: 20px;
        }

        .button-container button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #007bff; /* Blue button */
            color: white; /* White text */
            transition: background-color 0.3s, transform 0.3s; /* Smooth transitions */
        }

        .button-container button:hover {
            background-color: #0056b3; /* Darker blue on hover */
            transform: scale(1.05); /* Slightly enlarge button on hover */
        }

        .image-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 columns per row */
            gap: 20px; /* Space between grid items */
            width: 100%;
        }

        .image-grid div {
            background: #fff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            transition: transform 0.3s; /* Smooth scaling effect on hover */
            overflow: hidden; /* Ensure the image doesn't overflow */
        }

        .image-grid img {
            width: 100%;
            height: 200px; /* Set a fixed height for all images */
            object-fit: cover; /* Ensure images fill the div while maintaining aspect ratio */
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Shadow for images */
            transition: transform 0.3s; /* Smooth scaling effect on hover */
            cursor: pointer; /* Change cursor to pointer on hover */
        }

        .image-grid div:hover {
            transform: scale(1.1); /* Bulge effect on hover */
        }

        .image-grid img:hover {
            transform: scale(1.2); /* Additional scaling for the image itself */
        }

        /* Fullscreen modal */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9); /* Black background with transparency */
            justify-content: center;
            align-items: center;
        }

        .modal img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 30px;
            color: #fff;
            font-size: 30px;
            font-weight: bold;
            cursor: pointer;
        }

    </style>
</head>
<body>

<h1>Event Gallery</h1>

<div class="button-container">
    <button onclick="window.location.href='index.html'">Home</button>
    <button onclick="window.location.href='upload.html'">Upload</button>
</div>

<div class="image-grid">
    <?php
    $dir = 'C:/xampp/htdocs/arjun/College-Website-master/Event uploads/'; // Updated path on server
    $urlDir = 'Event uploads/'; // URL path relative to the web server
    
    // Fetch images from the directory
    $images = glob($dir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
    
    if ($images) {
        foreach ($images as $image) {
            $imageUrl = $urlDir . basename($image); // URL path for the image
            echo '<div><img src="' . $imageUrl . '" alt="Gallery Image" onclick="openModal(this.src)"></div>';
        }
    } else {
        echo '<div>No images found in the gallery.</div>';
    }
    ?>
</div>

<!-- Fullscreen modal -->
<div id="myModal" class="modal">
    <span class="modal-close" onclick="closeModal()">&times;</span>
    <img id="modalImage" src="">
</div>

<script>
    // Function to open the modal and display the clicked image
    function openModal(imageSrc) {
        var modal = document.getElementById("myModal");
        var modalImg = document.getElementById("modalImage");
        modal.style.display = "flex"; // Show the modal
        modalImg.src = imageSrc; // Set the modal image source to the clicked image
    }

    // Function to close the modal
    function closeModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none"; // Hide the modal
    }
</script>

</body>
</html>
