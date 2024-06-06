<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Contact Us</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            text-align: center;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .contact {
            margin-top: 50px;
        }

        h2 {
            color: #333;
        }

        .contact-wrapper {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .contact-form,
        .contact-info {
            width: 45%;
        }

        h3 {
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        textarea {
            height: 100px;
        }

        button {
            padding: 10px;
            background-color: #4CAF50; /* Green color */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049; /* Darker green color on hover */
        }

        .contact-info p {
            margin-bottom: 10px;
        }

        footer {
            background-color: #ca1a5e;
            color: #fff;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <section class="contact">
        <div class="container">
            <h2>Contact Us</h2>
            <div class="contact-wrapper">
                <div class="contact-form">
                    <h3>Send Us a Message</h3>
                    <form method="post" action="send_message.php">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <textarea name="message" placeholder="Your Message"></textarea>
                        </div>
                        <button type="submit">Send Message</button>
                    </form>
                </div>
                <div class="contact-info">
                    <h3>Contact Information</h3>
                    <p><i class="fas fa-phone"></i>60+123538830</p>
                    <p><i class="fas fa-envelope"></i>aina@gmail.com</p>
                    <p><i class="fas fa-map-marker-alt"></i>Taska Sinar Mesra, Ampang, Kuala Lumpur</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        &copy; 2023 Taska Sinar Mesra. All rights reserved.
    </footer>

</body>

</html>
