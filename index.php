<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- remix icon cdn link  -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

    <title>The 4Koffee</title>
</head>

<body>

    <!-- header section starts  -->

    <header class="header">

        <a href="index.php" class="logo"> <i class="ri-store-2-line"></i>The 4Koffee</a>

        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#about">about</a>
            <a href="#popular">popular</a>
            <a href="#menu">menu</a>
            <a href="#order">order</a>
            <a href="#blogs">blogs</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="ri-menu-line"></div>
            <a href="search-btn" class="ri-search-line"></a>
            <a href="cart-btn" class="ri-shopping-cart-line"></a>
            <a href="./register.php" class="ri-user-line"></a>
        </div>

    </header>

    <!-- header section ends  -->


    <!-- search-form start -->

    <section class="search-form-container">

        <form action="">
            <input type="search" placeholder="search here..." id="search-box">
            <label for="search-box" class="ri-search-line"></label>
        </form>

    </section>

    <!-- search-form end -->


    <!-- shopping-cart section start -->

    <section class="shopping-cart-container">

        <div class="products-container">

            <h3 class="title">your products</h3>

            <div class="box-container">

                <div class="box">
                    <i class="ri-close-line close-icon"></i>
                    <img src="image/menu-1.png" alt="">
                    <div class="content">
                        <h3>delicious food</h3>
                        <span> quantity : </span>
                        <input type="number" name="" min="1" value="1" id="">
                        <br>
                        <span> price : </span>
                        <span class="price"> $40.00</span>
                    </div>
                </div>

                <div class="box">
                    <i class="ri-close-line close-icon"></i>
                    <img src="image/menu-2.png" alt="">
                    <div class="content">
                        <h3>delicious food</h3>
                        <span> quantity : </span>
                        <input type="number" name="" min="1" value="1" id="">
                        <br>
                        <span> price : </span>
                        <span class="price"> $32.00</span>
                    </div>
                </div>

                <div class="box">
                    <i class="ri-close-line close-icon"></i>
                    <img src="image/menu-3.png" alt="">
                    <div class="content">
                        <h3>delicious food</h3>
                        <span> quantity : </span>
                        <input type="number" name="" min="1" value="1" id="">
                        <br>
                        <span> price : </span>
                        <span class="price"> $25.00</span>
                    </div>
                </div>

                <div class="box">
                    <i class="ri-close-line close-icon"></i>
                    <img src="image/menu-4.png" alt="">
                    <div class="content">
                        <h3>delicious food</h3>
                        <span> quantity : </span>
                        <input type="number" name="" min="1" value="1" id="">
                        <br>
                        <span> price : </span>
                        <span class="price"> $19.00</span>
                    </div>
                </div>

                <div class="box">
                    <i class="ri-close-line close-icon"></i>
                    <img src="image/menu-5.png" alt="">
                    <div class="content">
                        <h3>delicious food</h3>
                        <span> quantity : </span>
                        <input type="number" name="" min="1" value="1" id="">
                        <br>
                        <span> price : </span>
                        <span class="price"> $38.00</span>
                    </div>
                </div>

            </div>

        </div>

        <div class="cart-total">

            <h3 class="title"> cart total </h3>

            <div class="box">
                <h3 class="subtitle">subtitle: <span>$200</span> </h3>
                <h3 class="total"> total : <span>$200</span> </h3>

                <a href="#" class="btn">proceed to checkout</a>
            </div>

        </div>

    </section>

    <!-- shopping-cart section end -->


    <!-- home section starts  -->

    <section class="home" id="home">
        <div class="image">
            <img src="image/banner-3.jpg" alt="" class="home-img">

            <div class="content">
                <span>Welcome to The Garden Cafe</span>
                <h3>Where Fresh Flavors And Come Together.</h3>
                <p>Experience fresh, farm-to-table cuisine in our garden-inspired cafe. Come for the food, stay for the
                    atmosphere.</p>
                <a href="#popular" class="btn">order now</a>
            </div>
        </div>

    </section>

    <!-- home section ends  -->


    <!-- category section starts  -->

    <section class="category">
    
    </section>

    <!-- <script src="js/menu.js"></script> -->
    <script src="js/menu.js" type="module"></script>


    <!-- category section ends -->


    <!-- about section starts  -->

    <section class="about" id="about">

        <div class="image">
            <img src="image/about-img.png" alt="">
        </div>

        <div class="content">
            <span>why choose us?</span>
            <h3 class="title">what's make our food delicious!</h3>
            <p>Delicious food, cozy ambiance, friendly service, and beautiful garden view. Choose us for an
                unforgettable dining experience.</p>
            <a href="#" class="btn">read more</a>
            <div class="icons-container">
                <div class="icons">
                    <img src="image/serv-1.png" alt="" width="40">
                    <h3>fast delivery</h3>
                </div>
                <div class="icons">
                    <img src="image/serv-2.png" alt="" width="40">
                    <h3>fresh food</h3>
                </div>
                <div class="icons">
                    <img src="image/serv-3.png" alt="" width="40">
                    <h3>best quality</h3>
                </div>
                <div class="icons">
                    <img src="image/serv-4.png" alt="" width="40">
                    <h3>24/7 support</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- about section ends -->


    <!-- popular section starts  -->

    <section class="popular" id="popular">
    <div class="heading">
        <span>popular coffee</span>
        <h3>our special dishes</h3>
    </div>

    <div class="box-container"></div>
</section>

<!-- <script src="js/drinks.js"></script> -->
<script src="js/drinks.js" type="module"></script>


    <!-- popular section ends -->


    <!-- banner section starts  -->

    <section class="banner">

        <div class="row-banner">
            <div class="content">
                <span>Dual Combo</span>
                <h3>Pizza</h3>
                <p>with cococola and fries</p>
                <a href="#" class="btn">order now</a>
            </div>
        </div>

        <div class="grid-banner">
            <div class="grid">
                <img src="image/banner-1.png" alt="">
                <div class="content">
                    <span>special offer</span>
                    <h3>upto 50% off</h3>
                    <a href="#" class="btn">order now</a>
                </div>
            </div>

            <div class="grid">
                <img src="image/banner-2.png" alt="">
                <div class="content center">
                    <span>special offer</span>
                    <h3>upto 25% off</h3>
                    <a href="#" class="btn">order now</a>
                </div>
            </div>

            <div class="grid">
                <img src="image/banner-3.png" alt="">
                <div class="content">
                    <span>limited offer</span>
                    <h3>100% cashback</h3>
                    <a href="#" class="btn">order now</a>
                </div>
            </div>
        </div>
    </section>

    <!-- banner section ends -->


    <!-- menu section starts  -->

    <section class="menu" id="menu">

        <div class="heading">
            <span>our menu</span>
            <h3>our top dishes</h3>
        </div>

        <div class="box-container">

            <a href="#" class="box">
                <img src="image/menu-1.png" alt="">
                <div class="content">
                    <h3>delicious food</h3>
                    <div class="price">$40.00</div>
                </div>
            </a>

            <a href="#" class="box">
                <img src="image/menu-2.png" alt="">
                <div class="content">
                    <h3>delicious food</h3>
                    <div class="price">$40.00</div>
                </div>
            </a>

            <a href="#" class="box">
                <img src="image/menu-3.png" alt="">
                <div class="content">
                    <h3>delicious food</h3>
                    <div class="price">$40.00</div>
                </div>
            </a>

            <a href="#" class="box">
                <img src="image/menu-4.png" alt="">
                <div class="content">
                    <h3>delicious food</h3>
                    <div class="price">$40.00</div>
                </div>
            </a>

            <a href="#" class="box">
                <img src="image/menu-5.png" alt="">
                <div class="content">
                    <h3>delicious food</h3>
                    <div class="price">$40.00</div>
                </div>
            </a>

            <a href="#" class="box">
                <img src="image/menu-6.png" alt="">
                <div class="content">
                    <h3>delicious food</h3>
                    <div class="price">$40.00</div>
                </div>
            </a>
        </div>
    </section>

    <!-- menu section ends -->


    <!-- order section starts  -->

    <section class="order" id="order">

        <div class="heading">
            <span>order now</span>
            <h3>fastest home delivery</h3>
        </div>

        <div class="icons-container">
            <div class="icons">
                <img src="image/icon-1.png" alt="">
                <h3>7:00am to 10:00 pm</h3>
            </div>

            <div class="icons">
                <img src="image/icon-2.png" alt="">
                <h3>+123 987654321</h3>
            </div>

            <div class="icons">
                <img src="image/icon-3.png" alt="">
                <h3>WestBengal, india 45896</h3>
            </div>
        </div>

        <form action="">

            <div class="flex">
                <div class="inputBox">
                    <span>your name</span>
                    <input type="text" name="" id="" placeholder="customer's name">
                </div>
                <div class="inputBox">
                    <span>your number</span>
                    <input type="number" name="" id="" placeholder="customer's number">
                </div>
            </div>

            <div class="flex">
                <div class="inputBox">
                    <span>your order</span>
                    <input type="text" name="" id="" placeholder="food you want">
                </div>
                <div class="inputBox">
                    <span>how much</span>
                    <input type="number" name="" id="" placeholder="number of orders">
                </div>
            </div>

            <div class="flex">
                <div class="inputBox">
                    <span>your details</span>
                    <input type="text" name="" id="" placeholder="your message">
                </div>
                <div class="inputBox">
                    <span>pick up time</span>
                    <input type="datetime-local" name="" id="">
                </div>
            </div>

            <div class="flex">
                <div class="inputBox">
                    <textarea placeholder="your address" name="" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="inputBox">
                    <iframe class="map"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3721767.259503259!2d85.60745827416464!3d24.362569215778873!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fa16ff1397e887%3A0x71543a3dc3e7a20a!2sWest%20Bengal!5e0!3m2!1sen!2sin!4v1680178059620!5m2!1sen!2sin"
                        allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <input type="submit" value="proceed to order" class="btn">

        </form>
    </section>

    <!-- order section ends -->


    <!-- blogs section starts  -->

    <section class="blogs" id="blogs">

        <div class="heading">
            <span>our blogs</span>
            <h3>our daily stories</h3>
        </div>

        <div class="box-container">

            <div class="box">
                <div class="image">
                    <h3> <i class="fas fa-calendar"></i> 21st may, 2021 </h3>
                    <img src="image/blog-1.jpeg" alt="">
                </div>
                <div class="content">
                    <div class="tags">
                        <a href="#"> <i class="fas fa-tag"></i> food / </a>
                        <a href="#"> <i class="fas fa-tag"></i> burgger / </a>
                        <a href="#"> <i class="fas fa-tag"></i> pizza </a>
                    </div>

                    <h3>blog title goes here..</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum, deleniti.</p>
                    <a href="#" class="btn">read more</a>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <h3> <i class="fas fa-calendar"></i> 21st may, 2021 </h3>
                    <img src="image/blog-2.jpeg" alt="">
                </div>
                <div class="content">
                    <div class="tags">
                        <a href="#"> <i class="fas fa-tag"></i> food / </a>
                        <a href="#"> <i class="fas fa-tag"></i> burgger / </a>
                        <a href="#"> <i class="fas fa-tag"></i> pizza </a>
                    </div>

                    <h3>blog title goes here..</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum, deleniti.</p>
                    <a href="#" class="btn">read more</a>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <h3> <i class="fas fa-calendar"></i> 21st may, 2021 </h3>
                    <img src="image/blog-3.jpeg" alt="">
                </div>
                <div class="content">
                    <div class="tags">
                        <a href="#"> <i class="fas fa-tag"></i> food / </a>
                        <a href="#"> <i class="fas fa-tag"></i> burgger / </a>
                        <a href="#"> <i class="fas fa-tag"></i> pizza </a>
                    </div>

                    <h3>blog title goes here..</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum, deleniti.</p>
                    <a href="#" class="btn">read more</a>
                </div>
            </div>
        </div>
    </section>

    <!-- blogs section ends -->


    <!-- footer section starts  -->

    <section class="footer">

        <div class="newsletter">
            <h3>newsletter</h3>
            <form action="">
                <input type="email" name="" id="" placeholder="enter your email">
                <input type="submit" value="subscribe">
            </form>
        </div>

        <div class="box-container">

            <div class="box">
                <h3>our menu</h3>
                <a href="#"> <i class="fas fa-arrow-right"></i> pizza </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> burger </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> chicken </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> pasta </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> and more.. </a>
            </div>

            <div class="box">
                <h3>quick links</h3>
                <a href="#home"> <i class="fas fa-arrow-right"></i> home </a>
                <a href="#about"> <i class="fas fa-arrow-right"></i> about </a>
                <a href="#popular"> <i class="fas fa-arrow-right"></i> popular </a>
                <a href="#menu"> <i class="fas fa-arrow-right"></i> menu </a>
                <a href="#order"> <i class="fas fa-arrow-right"></i> order </a>
                <a href="#blogs"> <i class="fas fa-arrow-right"></i> blogs </a>
            </div>

            <div class="box">
                <h3>extra links</h3>
                <a href="#"> <i class="fas fa-arrow-right"></i> my order </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> my account </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> my favorite </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> terms of use </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> privacy policy </a>
            </div>

            <div class="box">
                <h3>opening hours</h3>
                <p>monday : 7:am to 10:pm</p>
                <p>tuesday : 7:am to 10:pm</p>
                <p>wednesday : 7:am to 10:pm</p>
                <p>friday : 7:am to 10:pm</p>
                <p>saturday and sunday closed</p>
            </div>
        </div>

        <div class="bottom">
            <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
                <a href="#" class="fab fa-pinterest"></a>
            </div>

            <div class="credit"> created <span>Code with Aarzoo</span> | all rights reserved!</div>
        </div>

    </section>

    <!-- footer section ends -->

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>