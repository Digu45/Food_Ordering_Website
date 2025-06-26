<?php
// Step 1: Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant_feedback";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Fetch hotel data including the logo_url from m_hotel table
$sql_hotel = "SELECT hotel_name, hotel_address, contact, logo_url FROM m_hotel WHERE status_id = 1"; 
$result_hotel = $conn->query($sql_hotel);
$hotel = $result_hotel->fetch_assoc(); // Fetch the first result

// Step 3: Fetch services from m_services table
$sql_services = "SELECT service_id, service_name, status_id, `date/time` FROM m_services";
$result_services = $conn->query($sql_services);

// Fetch all services with their category names
$query = "SELECT m_services.service_id, m_services.service_name, m_services.status_id, m_services.`date/time`, service_detail.category_name 
FROM m_services 
LEFT JOIN service_detail ON m_services.service_id = service_detail.service_id";
$result_services = $conn->query($query);

// Your SQL query to fetch only type_name
$sql = "SELECT `type_name` FROM `m_ratingtype`";
$result = $conn->query($sql);





// $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Feedback Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: "Roboto", sans-serif;
            overflow-x:hidden;
           
        }

        .navbar {
            padding: 0.65rem;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .restaurant-name {
            font-weight: 700;
            color: #444;
            letter-spacing: 0.05rem;
            margin-bottom: 20px;
            text-align: center;
            font-size: 1.75rem;
        }

        .card {
            border: none;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .btn-primary {
            background-color: #6dd4ee;
            border-color: #6dd4ee;
        }

        .btn-primary:hover {
            background-color: #6dd4ee;
        }

        .form-group {
        margin-bottom: 9px;
    }
    
    .form-group label {
        display: block;
        margin-top: -2px;
    }
    
    .flex-container {
        display: flex;
        justify-content: space-between;
    }
    
    .flex-container .form-group {
        width: 70%; /* Increased width to 70% for both fields */
    }
    
    input {
        width: 100%; /* Ensure the input field takes the full width of its container */
        padding: 5px;
        box-sizing: border-box;
    }
       
        /* Input and textarea fields */
        input[type="text"], input[type="email"], input[type="date"], textarea {
            background-color: #e9ecef;
            border-radius: 0.5rem;
            border: 1px solid #ced4da;
            padding: 0.5rem;
            width: 100%;
            margin-bottom: 1rem;
        }

        textarea {
            resize: none;
        }
      

        /* Mobile View */
        @media (max-width: 576px) {
            .restaurant-name {
                font-size: 1.5rem;
            }

            .navbar-text h4 {
                font-size: 1.25rem;
            }
        }
        
        /* Modal Background */
.success-modal-content {
    border-radius: 20px;
    background-color: #f9f9f9;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

/* Checkmark Icon Styling */
.icon-container {
    background-color: #4caf50; /* green background */
    color: white;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    margin: 0 auto;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 30px;
    margin-bottom: 15px;
}

.checkmark-icon {
    font-weight: bold;
}

/* Modal Title */
.modal-title {
    font-size: 18px;
    font-weight: 600;
    color: #333;
}

/* Modal Footer Buttons */
.modal-footer .btn {
    width: 100px;
    margin: 5px;
}

.modal-footer .btn-secondary {
    background-color: #f2f2f2;
    color: #333;
}

.modal-footer .btn-primary {
    background-color: #4caf50;
    color: white;
}
 .restaurant-details {
            text-align: center;
            margin-bottom: 20px;
           

 }
            .restaurant-details img {
    display: block;
    margin: 0 auto; /* Center the logo */
    max-width: 150px; /* Control the size */
    margin-bottom: 10px; /* Space between logo and hotel name */
}
        
        input[type="date"] {
    max-width: 50%;
}
.service-name {
        font-size: 0.89rem; /* Increase service name font size */
        font-weight: bold; /* Keep service name bold */
        margin-top:3%;
       
    }


    /* Light blue border for the select dropdown */
    .category-dropdown {
        border: 1px solid #ced4da; /* Default border */
        transition: border-color 0.3s ease;
        font-size: 0.670rem; /* Reduce category dropdown font size */
        margin-bottom:3%;
        margin-top:-20px;
    }

    /* Light blue border when "Select Your Answer" is selected */
    .category-dropdown option[value=""][selected] {
        color: #0d6efd; /* Light blue text for the default option */
    }

    /* Give the select box a light blue border if the default option is selected */
    .category-dropdown:focus {
        border-color: #0d6efd; /* Light blue border on focus */
        outline: none;
        box-shadow: 0 0 5px rgba(13, 110, 253, 0.5); /* Light blue shadow on focus */
    }

    .star-container {
    display: flex;
    align-items: center; /* Vertically aligns the stars and text */
    margin-left: 50px; /* Adds some space on the left side */
}

.star {
    font-size: 2rem;
    cursor: pointer;
    color: gray;
    transition: color 0.2s ease;
    margin-right: 10px; /* Adds space between stars and text */
}

/* Highlight selected stars */
.star.selected {
    color: gold;
}

/* Hover effect for all stars */
.star-container:hover .star {
    color: lightgray;
}

/* Don't change color on hover for selected stars */
.star-container .star.selected:hover {
    color: gold;
}

.star-container h3 {
    margin: 0; /* Removes any extra margin around the heading */
}
.rating-parameter {
        margin-bottom: 20px; /* Space between each rating parameter */
    }

    .rating-parameter {
    margin-bottom: 20px; /* Space between each rating parameter */
    display: flex;
    justify-content: space-between; /* Spread the label and stars to opposite ends */
    align-items: center; /* Vertically align the content */
}

.star-container {
    display: inline-block;
    margin-left: auto; /* Push the stars to the right */
}
  

    label {
        font-weight: bold;
        margin-right: 10px;
    }
    .form-actions {
        text-align: center; /* Center the button */
        margin-top: -35px;   /* Add some space above the button */
    }
    
    .btn {
        padding: 10px 20px;
        font-size: 16px;
    }
    </style>
</head>
<body>
  
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg">
                    <div class="card-header text-center">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <div class="container-fluid">
                               
                                <span class="navbar-text mx-auto">
                                    <h4 class="text-center mb-0">Feedback</h4>
                                </span>
                            </div>
                        </nav>
                    </div>
                    <div class="card-body" style="margin-left:1%; margin-right:3%;">
                        
        <div class="restaurant-details">
       
        <?php if (isset($hotel['logo_url']) && !empty($hotel['logo_url'])): ?>
    <img src="<?php echo htmlspecialchars($hotel['logo_url'], ENT_QUOTES, 'UTF-8'); ?>" alt="Hotel Logo" class="img-fluid" style="max-width: 150px; margin-bottom: 10px;">
<?php endif; ?>


            <h2 class="restaurant-name"><?php echo $hotel['hotel_name']; ?></h2>
            <p style="font-size: 10px;"><?php echo $hotel['hotel_address']; ?></p>
<p style="font-size: 10px;">Contact: <?php echo $hotel['contact']; ?></p>

        </div>
        
        <form action="submit_feedback.php" method="POST">
    <div class="form-group">
        <label for="customer_name">Name</label>
        <input type="text" id="customer_name" name="customer_name" placeholder="Enter Name" required>
    </div>
    
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter Email" required>
    </div>
    
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone" placeholder="Enter Phone" required>
    </div>
    
    <div class="flex-container"  style="width:100%;">
        <div class="form-group" style="width:100%;">
            <label for="birthdate">Birthdate</label>
            <input type="date" id="birthdate" name="birthdate" required>
        </div>

        <div class="form-group" style="width:100%;">
            <label for="anniversary">Anniversary</label>
            <input type="date" id="anniversary" name="anniversary">
        </div>
    </div>
    
    
    <!-- Hidden input for status_id with default value 1 -->
    <input type="hidden" name="status_id" value="1"> 
   
    <?php
// Fetch rating types from the m_ratingtype table
$query = "SELECT `type_id`, `type_name`, `status_id`, `data/time` FROM `m_ratingtype` WHERE `status_id` = 1"; // Adjust condition as needed
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0):
    while ($row = mysqli_fetch_assoc($result)): 
        $ratingType = $row['type_name'];
        ?>
        <form action="save_feedback.php" method="POST">
        <form action="save_feedback.php" method="POST">
    <div class="rating-parameter">
        <input type="hidden" name="rating_value[<?php echo htmlspecialchars($ratingType, ENT_QUOTES, 'UTF-8'); ?>][type_id]" value="<?php echo htmlspecialchars($row['type_id']); ?>"> <!-- Example ID for each type -->
        
        <label for="rating-<?php echo htmlspecialchars($ratingType, ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo htmlspecialchars($ratingType); ?>
        </label>

        <div class="star-container">
            <!-- Star choices for rating, each with a numerical value -->
            <span class="star" data-value="1" onclick="setRating('<?php echo htmlspecialchars($ratingType); ?>', 1)">★</span>
            <span class="star" data-value="2" onclick="setRating('<?php echo htmlspecialchars($ratingType); ?>', 2)">★</span>
            <span class="star" data-value="3" onclick="setRating('<?php echo htmlspecialchars($ratingType); ?>', 3)">★</span>
            <span class="star" data-value="4" onclick="setRating('<?php echo htmlspecialchars($ratingType); ?>', 4)">★</span>
            <span class="star" data-value="5" onclick="setRating('<?php echo htmlspecialchars($ratingType); ?>', 5)">★</span>
        </div>

        <!-- Hidden field to store selected rating value -->
        <input type="hidden" name="rating_value[<?php echo htmlspecialchars($ratingType); ?>][value]" id="rating-<?php echo htmlspecialchars($ratingType); ?>" value="">
    </div>
    <?php endwhile; ?>
<?php endif; ?>


                        <!-- Display Services List with Category -->
<div class="services-list mt-4">
    <ul class="list-group">
        <?php if ($result_services->num_rows > 0) {
            $displayed_services = []; // To keep track of services already displayed
        ?>
            <?php while($service = $result_services->fetch_assoc()) { 
                // Check if this service has already been displayed
                if (!in_array($service['service_id'], $displayed_services)) {
                    $displayed_services[] = $service['service_id']; // Mark this service as displayed
            ?>
            <!-- Service Name -->
            <li class="list-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <strong class="service-name"><?= $service['service_name']; ?></strong> <!-- Service name with custom class -->
                </div>

                <!-- Dropdown for categories -->
                <div class="mt-1">
    <label for="category_<?= $service['service_id']; ?>" class="form-label"></label>
    <select class="form-select category-dropdown" id="category_<?= $service['service_id']; ?>" name="category_<?= $service['service_id']; ?>">
        <option value="" disabled selected>Select Your Answer</option>
        
        <?php
        // Fetch categories for the current service ID from the service_detail table
        $service_id = $service['service_id'];
        $sql_categories = "SELECT `sr.no`, `category_name` FROM service_detail WHERE service_id = $service_id";
        $result_categories = $conn->query($sql_categories);

        // Check if categories exist and display them as options
        if ($result_categories->num_rows > 0) {
            while ($category = $result_categories->fetch_assoc()) {
                echo '<option value="' . $category['category_name'] . '">' . $category['category_name'] . '</option>';
            }
        } else {
            echo '<option value="" disabled>No categories available</option>';
        }
        ?>
    </select>
</div>

            <?php } // End of if block to check repeated services 
            } ?>
        <?php } else { ?>
            <li class="list-group-item">No services available.</li>
        <?php } ?>
    </ul>
</div>
                                <div class="mb-3" style="margin-top:6%;">
                                <textarea name="comments" placeholder="Enter Comments"></textarea>
                                    
                                </div>
                            </div>
                           
                 <!-- Align submit button at the bottom -->
                  <div class="form-actions" style="margin-bottom:4%;"> 
                      <button type="submit" class="btn btn-primary">Submit Feedback</button>
                </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content success-modal-content">
            <div class="modal-body text-center">
                <div class="icon-container">
                    <i class="checkmark-icon">✔</i>
                </div>
                <h5 class="modal-title mb-2" id="successModalLabel">Feedback Submitted</h5>
                <p>Thank you for your feedback!</p>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='feedbackrestro.php'" data-bs-dismiss="modal">Back</button>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='homepage.php'">Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$conn->close(); // Close connection
?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        
        function setRating(ratingType, value) {
    document.getElementById('rating-' + ratingType).value = value;
}
        
       // Function to handle the star selection
    function selectStar(e) {
        const section = e.target.closest('.star-container').getAttribute('data-section'); // Get the section identifier
        const value = e.target.getAttribute('data-value');  // Get the star value
        const stars = e.target.closest('.star-container').querySelectorAll('.star');  // Get stars of the current section
        let selectedRating = e.target.closest('.star-container').querySelector('.selected-rating'); // Check if a rating is displayed in this section

        // Remove 'selected' class from all stars in this section
        stars.forEach(star => {
            star.classList.remove('selected');
        });

        // Add 'selected' class to the stars up to the clicked one
        for (let i = 0; i < value; i++) {
            stars[i].classList.add('selected');
        }

        // Display the selected rating in the section
        if (!selectedRating) {
            const ratingDisplay = document.createElement('div');
            ratingDisplay.classList.add('selected-rating');
          
            e.target.closest('.star-container').appendChild(ratingDisplay);
        } else {
           
        }

        // Optionally, store or log the rating value for the section
        console.log(`Section: ${section}, Rating: ${value} stars`);
    }

    // Add event listeners to all stars in all sections
    document.querySelectorAll('.star').forEach(star => {
        star.addEventListener('click', selectStar);
    });
       
        // Function to show the success modal
        function showSuccessModal(event) {
            event.preventDefault(); // Prevent form submission for demo purposes
            $('#successModal').modal('show');

            // Simulate form submission (remove this line in production)
            setTimeout(function() {
                // Uncomment the line below to submit the form
                // event.target.submit();
            }, 1000);

            return false; // Prevent default form submission here
        }

        // Validate phone number input
        function validatePhone() {
            const phoneInput = document.getElementById('phone');
            const phoneError = document.getElementById('phoneError');
            if (phoneInput.value.length === 10) {
                phoneError.style.display = 'none';
            } else {
                phoneError.style.display = 'block';
            }
        }

       
    </script>
    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
    <script>
        $(document).ready(function(){
            $('#successModal').modal('show');
        });
    </script>
<?php endif; ?>

    
</body>
</html>
