<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xpress Hotel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }

        .splash-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            background-color: #f8f9fa;
            position: relative;
        }

        .splash-image {
            width: 65%;
            height: auto;
            max-height: 80vh;
            display: none;
            animation: slide-up 1.5s forwards;
        }

        @keyframes slide-up {
            0% {
                transform: translateY(100%);
            }

            100% {
                transform: translateY(0);
            }
        }

        .loader {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
            text-align: center;
        }

        .loading-text {
            margin-top: 10px;
        }

        @media (min-width: 768px) {
            .splash-image {
                width: 70%;
                max-height: 80vh;
            }
        }

        @media (max-width: 767px) {
            .splash-image {
                width: 100%;
                max-height: 70vh;
            }
        }
    </style>
</head>

<body>
    <?php
    session_start();

    // this is used to genetare unique_device_id

    // Use device-specific information
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    // Combine the values with randomness and hash it
    $unique_id = md5($user_ip . $user_agent);

    // Store the generated unique ID in the session
    $_SESSION['unique_device_id'] = $unique_id;

    // echo $_SESSION['unique_device_id'];


    $parameter = isset($_GET['parameter']) ? $_GET['parameter'] : '';

    if ($parameter) {
        $_SESSION['parameter'] = $parameter;

        // Debugging: log the parameter value
        echo "<script>console.log('Parameter:', '$parameter');</script>";

        echo "<script>
        window.onload = function() {
            // Show splash image when parameter is present
            var splashImage = document.querySelector('.splash-image');
            splashImage.style.display = 'block';

            // Move splash image to the center
            setTimeout(function() {
                splashImage.classList.add('slide-up');

                // Show loader after image slides up
                setTimeout(function() {
                    splashImage.style.display = 'none'; // Hide the image
                    document.getElementById('loader').style.display = 'block'; // Show the loader
                    
                    // Redirect after a short delay
                    setTimeout(function() {
                        window.location.href = 'home.php';
                    }, 2500); // load the loader up to 2.5 seconds 
                }, 4000); // splash the image on screen up to 4 seconds 
            }, 200); // Start the image animation immediately after page load
        };
    </script>";
    } else {
        // Debugging: no parameter was provided
        echo "<script>console.log('No parameter provided');</script>";
    }
    ?>

    <div class="splash-container">
        <img src="food.png" class="splash-image" alt="Splash Image">
        <div class="loader" id="loader">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="loading-text">Loading...</div>
        </div>
    </div>

</body>

</html>