<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    /* General body styles */
    .main {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    /* Contact container */
    .contact-container {
        background-color: #fff;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 600px;
        padding: 30px;
        border-radius: 8px;
        margin: 20px;
        text-align: center;
    }

    /* Header */
    .contact-container h2 {
        color: #333;
        font-size: 2em;
        margin-bottom: 20px;
        text-transform: uppercase;
    }

    /* Form elements */
    form {
        display: flex;
        flex-direction: column;
    }

    form label {
        text-align: left;
        margin: 10px 0 5px;
        font-weight: bold;
        color: #333;
    }

    form input,
    form textarea {
        padding: 12px;
        margin: 8px 0;
        border: 2px solid #ddd;
        border-radius: 5px;
        font-size: 1em;
        transition: border-color 0.3s ease;
    }

    form input:focus,
    form textarea:focus {
        border-color: #3498db;
        outline: none;
    }

    form textarea {
        resize: vertical;
        min-height: 150px;
    }

    /* Submit button */
    button {
        padding: 12px;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1.2em;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #2980b9;
    }

    /* Success or error message */
    .message {
        margin-top: 20px;
        font-size: 1.1em;
        color: #2ecc71;
        /* Green for success */
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .contact-container {
            padding: 20px;
            width: 90%;
        }

        form label {
            font-size: 1em;
        }

        form input,
        form textarea {
            font-size: 0.9em;
        }

        button {
            font-size: 1em;
        }
    }
</style>

<body>
    <?php include('./navbar.php'); ?>

    <div class="main">


        <div class="contact-container">
            <h2>Contact Us</h2>
            <form action="../Backend/submit_contact.php" method="POST" id="contact-form">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required placeholder="Your Full Name">

                <label for="phone_number">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" required placeholder="Your Phone Number">

                <label for="message">Message</label>
                <textarea id="message" name="message" required placeholder="Your Message"></textarea>

                <button type="submit">Submit</button>
            </form>

            <!-- Success/Error Message -->
            <div class="message" id="form-message"></div>
        </div>
    </div>

    <script>
        document.getElementById('contact-form').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission

            const formData = new FormData(this);

            // Use fetch to submit the form data to the backend
            fetch('../Backend/submit_contact.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json()) // Parse JSON response
                .then(data => {
                    const messageElement = document.getElementById('form-message');

                    // Check if the response status is 'success'
                    if (data.status === 'success') {
                        messageElement.textContent = data.message; // Show success message
                        messageElement.style.color = '#2ecc71'; // Green color for success
                    } else {
                        messageElement.textContent = data.message; // Show error message
                        messageElement.style.color = '#e74c3c'; // Red color for error
                    }
                })
                .catch(error => {
                    // If there's an error during the fetch process
                    const messageElement = document.getElementById('form-message');
                    messageElement.textContent = 'Something went wrong. Please try again.'; // Generic error message
                    messageElement.style.color = '#e74c3c'; // Red color for error
                });
        });

    </script>
</body>

</html>