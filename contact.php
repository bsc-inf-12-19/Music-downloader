<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #333;
            color: white;
            padding: 15px 0;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            text-align: center;
        }

        nav ul li {
            display: inline;
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        .container {
            width: 90%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .contact-content {
            text-align: center;
        }

        .contact-content h2 {
            margin-bottom: 20px;
        }

        .contact-content p {
            line-height: 1.6;
            color: #555;
        }

        .contact-content form {
            max-width: 600px;
            margin: 0 auto;
        }

        .contact-content form input,
        .contact-content form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .contact-content form button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: white;
            cursor: pointer;
        }

        .contact-content form button:hover {
            background-color: #45a049;
        }
    </style>
    <title>Contact Us - SoundBeyond</title>
</head>
<body>
    <header>
        <h1><i class="fa-solid fa-music"></i> SoundBeyond</h1>
        <nav>
            <ul>
                <li><a href="index.php"><i class="fa-solid fa-home"></i> Home</a></li>
                <li><a href="contact.php"><i class="fa-solid fa-phone"></i> Contact Us</a></li>
                <li><a href="login.php"><i class="fa-solid fa-right-to-bracket"></i> Admin</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="contact-content">
            <h2>Contact Us</h2>
            <form action="https://formspree.io/f/xovaqqpr" method="POST">
                <input type="text" name="Name" placeholder="Your Name" required>
                <input type="text" name="User PhoneNumber" placeholder="Your Phone Number" required>
                <textarea name="Message" rows="5" placeholder="Your Message" required></textarea>
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
</body>
</html>
