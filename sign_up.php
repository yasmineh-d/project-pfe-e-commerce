<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Homelectronique</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
    <link rel="stylesheet" href="css/sign_up.css" />
    <!-- Ensure 'combined_style.css' is the correct path to your CSS file -->
  </head>
  <body>
    <!-- Header Section Start (from e-commerce page) -->
    <header class="site-header">
      <div class="top-bar">
        <p>FREE SHIPPING FOR ORDERS OVER 40 €. FREE RETURNS OVER 60 DAYS.</p>
      </div>

      <div class="main-header">
        <div class="logo">
          <a href="index.html">
            <!-- Make sure image path is correct -->
            <img src="images/logo_Y.png" alt="House Electronics Logo" />
          </a>
        </div>
        <div class="header-content">
          <nav class="nav-menu">
            <ul>
              <li>
                <a href="index.html">Home <i class="fas fa-angle-down"></i></a>
              </li>
              <li><a href="about.html">About</a></li>
              <li>
                <a href="products.html"
                  >Categories <i class="fas fa-angle-down"></i
                ></a>
              </li>
              <li><a href="contact.html">Contact</a></li>
            </ul>
          </nav>

          <div class="header-actions">
            <a href="#"
              ><div class="icon-circle"><i class="fas fa-search"></i></div
            ></a>
            <a href="#"
              ><div class="icon-circle">
                <i class="far fa-heart"></i></div
            ></a>
            <a href="#"
              ><div class="icon-circle">
                <i class="fas fa-shopping-bag"></i></div
            ></a>
            <a href="login.html" class="signin-btn">Sign-in</a>
          </div>
        </div>
      </div>
    </header>
    <!-- Header Section End -->

    <!-- ======================================================= -->
    <!--          CONTAINER LKBIR LI JAME3 KOULCHI (Auth)      -->
    <!-- ======================================================= -->
    <div class="auth-container">
      <!-- ======================================================= -->
      <!--          LJIHA LISSRYA: FORM DYAL CREATE ACCOUNT      -->
      <!-- ======================================================= -->
      <div class="form-section">
        <h1>Create Account</h1>
        <form action="#">
          <div class="input-group">
            <label for="full-name">Full Name</label>
            <input type="text" id="full-name" name="full-name" required />
          </div>
          <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required />
          </div>
          <div class="input-group">
            <label for="number">Number</label>
            <input type="tel" id="number" name="number" required />
          </div>
          <div class="input-group">
            <label for="passeword">Password</label>
            <!-- Corrected typo -->
            <input type="password" id="passeword" name="passeword" required />
          </div>
          <!-- Bouton Sign Up ghadi ywelli orange mn CSS -->
          <button type="submit" class="btn btn-signup">Sign Up</button>
        </form>
      </div>

      <!-- ======================================================= -->
      <!--          LJIHA LIMNYA: MESSAGE D'ACCUEIL W SIGN IN    -->
      <!-- ======================================================= -->
      <div class="info-section">
        <h2>WELCOME TO<br />ELECTRONIQUE<br />HOUSE</h2>
        <!-- Corrected typo -->
        <p>Already have an account?</p>
        <!-- Changed text for context -->
        <!-- This button should ideally link to your login page -->
        <button
          onclick="window.location.href='login.html'"
          class="btn btn-signin"
        >
          Sign In
        </button>
      </div>
    </div>
    <!-- Auth Container End -->

    <!-- Footer Section Start (from e-commerce page) -->
    <footer class="site-footer">
      <div class="footer-container">
        <div class="footer-main">
          <!-- Column 1: Get Help -->
          <div class="footer-column">
            <h4>Get Help</h4>
            <ul>
              <li><a href="#">Help Center</a></li>
              <li><a href="#">Live Chat</a></li>
              <li><a href="#">Check Order Status</a></li>
              <li><a href="#">Refunds</a></li>
              <li><a href="#">Report Abuse</a></li>
            </ul>
          </div>

          <!-- Column 2: Catégorie -->
          <div class="footer-column">
            <h4>Catégorie</h4>
            <ul>
              <li><a href="#">Small Appliances</a></li>
              <li><a href="#">Kitchen Appliances</a></li>
              <li><a href="#">Laundry Appliances</a></li>
              <li><a href="#">Heating and Air Conditioning</a></li>
            </ul>
          </div>

          <!-- Column 3: Payments -->
          <div class="footer-column">
            <h4>Payments and Protections</h4>
            <ul>
              <li><a href="#">Secure and Easy Payments</a></li>
              <li><a href="#">Refund Policy</a></li>
              <li><a href="#">On-Time Delivery</a></li>
              <li><a href="#">After-Sales Protections</a></li>
              <li>
                <a href="#">Production Monitoring and Inspection Services</a>
              </li>
            </ul>
          </div>

          <!-- Column 4: About -->
          <div class="footer-column">
            <h4>About the Company</h4>
            <ul>
              <li><a href="#">Who Are We?</a></li>
              <li><a href="#">Social Responsibility</a></li>
            </ul>
          </div>

          <!-- Column 5: Contact -->
          <div class="footer-column">
            <h4>Contact</h4>
            <div class="contact-icons">
              <!-- Make sure image paths are correct -->
              <a href="#"
                ><img src="images/whatsapp-svgrepo-com.svg" alt="WhatsApp"
              /></a>
              <a href="#"
                ><img src="images/gmail-svgrepo-com.svg" alt="Gmail"
              /></a>
            </div>
          </div>

          <!-- Column 6: Follow Us -->
          <div class="footer-column">
            <h4>Follow Us</h4>
            <div class="social-icons">
              <a href="#" class="social-icon facebook-bg"
                ><i class="fab fa-facebook-f"></i
              ></a>
              <a href="#" class="social-icon twitter-bg"
                ><i class="fab fa-twitter"></i
              ></a>
              <a href="#" class="social-icon linkedin-bg"
                ><i class="fab fa-linkedin-in"></i
              ></a>
              <a href="#" class="social-icon instagram-bg"
                ><i class="fab fa-instagram"></i
              ></a>
            </div>
          </div>
        </div>

        <hr class="footer-divider" />

        <div class="footer-bottom">
          <p class="copyright-text">
            © 2025 House Electronics. All Rights Reserved
          </p>
          <div class="footer-legal-links">
            <a href="#">Terms & Conditions</a>
            <span>|</span>
            <a href="#">Privacy Policy</a>
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer Section End -->
  </body>
</html>
