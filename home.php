

<?php

// Start the session
session_start();

// If the user is not logged in redirect to the login page.
if (!isset($_SESSION['loggedin'])) 
{
	header('Location: login.php');
	exit;
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Funky Pops Marketplace</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#why-choose-us">Why Choose Us</a></li>
                <li><a href="#contact">Contact</a></li>
                <li class="nav-login"><a href="login.php">Log in</a></li>
                <li class="nav-login"><a href="buyerd.php">Buyer's Dashboard</a></li>

            </ul>
        </nav>
    </header>
    <main>
        <section id="hero">       
            <div class="hero-content">
                <p>Welcome back, <?=$_SESSION['name']?>!</p>
                <h1>Welcome to Funky Pops Marketplace</h1>
                <p>Buy, Sell, and Connect with Fellow Funko Pop Collectors</p>
                <a href="register.html" class="cta-button">Join Now</a>
            </div>
        </section>
        <section id="about">
            <div class="container">
                <div class="col-md-6 about-image">
                    <img src="png/about-us.jpg" alt="About Us" />
                </div>
                <div class="row">
                    <div class="col-md-6 about-content">
                        <h2>About Us</h2>
                        <p>Funky Pops Marketplace is a premier online platform dedicated to providing a safe and vibrant
                            community for Funko Pop collectors to buy, sell,
                            and connect with fellow enthusiasts. With our user-friendly interface and robust features,
                            we make it easy for collectors of all levels to find, trade,
                            and showcase their favorite Funko Pops.</p>
                    </div>

                </div>
            </div>
        </section>
        <section id="services">
            <div class="container">
                <div class="services-content">
                    <h2>Our Services</h2>
                    <div class="services-list">
                        <div class="service-item">
                            <img src="png/buy-service.png" alt="Buy Service Icon">
                            <h3>Buy Funko Pops</h3>
                            <p>Explore our extensive collection of Funko Pops and find the ones you've been searching
                                for to complete your collection.</p>
                        </div>
                        <div class="service-item">
                            <img src="png/sell.jpg" alt="Sell Service Icon">
                            <h3>Sell Funko Pops</h3>
                            <p>List your Funko Pops for sale and connect with potential buyers in our community to sell
                                your items quickly and easily.</p>
                        </div>
                        <div class="service-item">
                            <img src="png/connect-others.png" alt="Connect Service Icon">
                            <h3>Connect with Collectors</h3>
                            <p>Join our community of Funko Pop collectors and connect with fellow enthusiasts to share
                                your passion, exchange tips, and build lasting friendships.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="why-choose-us">
            <div class="why-choose-us-content">
                <h2>Why Choose Us</h2>
                <div class="reasons-list">
                    <div class="reason-item">
                        <img src="png/community.png" alt="Community Reason Icon">
                        <h3>Dedicated Community</h3>
                        <p>Our platform fosters a vibrant community of Funko Pop collectors, allowing you to connect,
                            engage, and share your passion with fellow enthusiasts.</p>
                    </div>
                    <div class="reason-item">
                        <img src="png/Fair-price.png" alt="Pricing Reason Icon">
                        <h3>Fair and Transparent Pricing</h3>
                        <p>We strive to ensure that our platform maintains fair and transparent pricing practices,
                            creating a trustworthy marketplace for buyers and sellers alike.</p>
                    </div>
                    <div class="reason-item">
                        <img src="png/User-friendly.png" alt="User-Friendly Reason Icon">
                        <h3>User-Friendly Interface</h3>
                        <p>Our platform is designed with a user-friendly interface, making it easy for collectors of all
                            levels to navigate, search, and interact with the community.</p>
                    </div>
                    <div class="reason-item">
                        <img src="png/secure.jpg" alt="Secure Reason Icon">
                        <h3>Secure Transactions</h3>
                        <p>Your safety is our top priority. Our platform implements advanced security measures to ensure
                            secure transactions and protect your personal information.</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="contact">
            <div class="contact-content">
                <h2>Contact Us</h2>
                <p>If you have any questions, feedback, or inquiries, please don't hesitate to contact us. We're here to
                    help!</p>
                <form action="#">
                    <input type="text" placeholder="Your Name">
                    <input type="email" placeholder="Your Email">
                    <textarea placeholder="Your Message"></textarea>
                    <input type="submit" value="Submit" class="cta-button">
                </form>
            </div>
        </section>
    </main>
    <footer>
        <p>© 2023 Funky Pops Marketplace. All rights reserved.</p>
    </footer>

</body>

</html>