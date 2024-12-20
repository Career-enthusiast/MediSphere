<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN FORM</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <!-- Include navbar from the external PHP file -->
    <?php include 'navbar.php'; ?>
    <div class="searchbar-container">
        <form id="search-form" class="search-form" action="search_medicines.php" method="get">
            <span class="dropdown-icon">
                <ion-icon name="medkit-outline"></ion-icon> <!-- Placeholder icon (medical kit) -->
            </span>
            <select id="category-select" name="category" aria-label="Category">
                <option value="conditions">Conditions</option>
                <option value="symptoms">Symptoms</option>
            </select>
            <input type="text" id="search-input" name="query" placeholder="Search..." aria-label="Search">
            <button type="submit"><ion-icon name="search"></ion-icon></button>
        </form>
    </div>

      
    <!-- JavaScript for Search -->
<script>
    function searchFunction() {
    const category = document.getElementById('category-select').value;
    const searchInput = document.getElementById('search-input').value;

    if (!searchInput.trim()) {
        alert("Please enter a search term.");
        return false;
    }

    // Modify action URL to include selected category
    const form = document.getElementById('search-form');
    let actionUrl = '';
    if (category === 'conditions') {
        actionUrl = `medicines.php?condition=${encodeURIComponent(searchInput)}`;
    } else if (category === 'symptoms') {
        actionUrl = `medicines.php?symptom=${encodeURIComponent(searchInput)}`;
    } else {
        alert("Please select a valid category.");
        return false;
    }

    alert("Redirecting to: " + actionUrl); // Debugging line
    form.action = actionUrl;

    return true;
}




    window.addEventListener('scroll', function() {
        const searchbarContainer = document.querySelector('.searchbar-container');
        const scrollPosition = window.scrollY;

        if (scrollPosition > 10) {
            searchbarContainer.classList.add('scroll-right');
        } else {
            searchbarContainer.classList.remove('scroll-right');
        }
    });
</script>
    
  
    <div class="carousel">
        <div class="carousel-slides">
           
         
        <div class="slide active"><img src="image.png" alt="Banner 1" width="5" height="1"></div>
        
            <div class="slide"><a href="non_generic.php"><img src="image.png" alt="Banner 2"></a></div>
            <div class="slide"><a href="non_generic.php"><img src="image.png" alt="Banner 3"></a></div>
            <div class="slide"><a href="non_generic.php"><img src="image.png" alt="Banner 4"></a></div>
            <div class="slide"><a href="non_generic.php"><img src="image.png" alt="Banner 5"></a></div>
            <div class="slide"><a href="non_generic.php"><img src="image.png" alt="Banner 6"></a></div>

        </div>
        <button class="carousel-button prev" onclick="moveSlide(-1)">&#10094;</button>
        <button class="carousel-button next" onclick="moveSlide(1)">&#10095;</button>
    </div>
      

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
        function searchFunction() {
            const query = document.getElementById('search-input').value.trim();
            if (query) {
                window.location.href = `search_results.html?query=${query}`;
            } else {
                alert('Please enter a search term');
            }
            return false; // Prevent form from submitting the traditional way
        }

        let currentSlide = 0;

        function showSlide(index) {
            const slides = document.querySelectorAll('.slide');
            const totalSlides = slides.length;

            if (index >= totalSlides) {
                currentSlide = 0; // Go back to first slide
            } else if (index < 0) {
                currentSlide = totalSlides - 1; // Go to last slide
            } else {
                currentSlide = index; // Set to the given index
            }

            // Move the carousel
            const offset = -currentSlide * 100; // Calculate offset
            document.querySelector('.carousel-slides').style.transform = `translateX(${offset}%)`;

            slides.forEach((slide, i) => {
                slide.style.opacity = (i === currentSlide) ? 1 : 0;
            });
        }

        function moveSlide(step) {
            showSlide(currentSlide + step); // Change slide
        }

        // Auto slide every 5 seconds
        setInterval(() => {
            moveSlide(1);
        }, 5000);

        // Initial slide
        showSlide(currentSlide);

    </script>
    <section class="section">
        <h2>Popular Categories</h2>
        <div class="category-container">
            <div class="category-item">
                <a href="product-page.html">
                    <img src="https://cdn01.pharmeasy.in/dam/discovery/categoryImages/fa936f30b4563fc4abd187fb22fe5258.png?f=png?dim=360x0"
                        alt="Best Offers">
                    <p class="product-name"> Elderly Care</p>

                </a>
            </div>
            <div class="category-item">
                <a href="product-page.html">
                    <img src="https://cdn01.pharmeasy.in/dam/discovery/categoryImages/eecea6d6d8d73267a175b77346c05dc2.png?f=png?dim=360x0"
                        alt="Vitamins & Supplements">
                    <p class="product-name">Mother and baby care</p>

                </a>
            </div>
            <div class="category-item">
                <a href="product-page.html">
                    <img src="https://cdn01.pharmeasy.in/dam/discovery/categoryImages/81fa3c44e0503863b3778895d5ed0bec.png?f=png?dim=360x0"
                        alt="Vitamins & Supplements">
                    <p class="product-name">Skincare</p>

                </a>
            </div>
            <div class="category-item">
                <a href="product-page.html">
                    <img src="https://cdn01.pharmeasy.in/dam/discovery/categoryImages/e4ca54bc1d1d3ed18253afcb2ca77870.png?f=png?dim=360x0"
                        alt="Vitamins & Supplements">
                    <p class="product-name">Personal care</p>

                </a>
            </div>
            <div class="category-item">
                <a href="product-page.html">
                    <img src="https://cdn01.pharmeasy.in/dam/discovery/categoryImages/d2c31b9f3ad13d5aa181796350117659.png?f=png?dim=360x0"
                        alt="Vitamins & Supplements">
                    <p class="product-name">Homeopathy care</p>

                </a>
            </div>
            <div class="category-item">
                <a href="product-page.html">
                    <img src="https://cdn01.pharmeasy.in/dam/discovery/categoryImages/7459ca90bd0b3877b61c782254355bf2.png?f=png?dim=360x0"
                        alt="Vitamins & Supplements">
                    <p class="product-name">Health food and drinks</p>

                </a>
            </div>
            <!-- Repeat for other categories -->
        </div>
    </section>

    <!-- Other sections (Deals of the Day, Top Offers, etc.) follow similarly with additional items -->
    <section class="section">
        <h2>Deals of the Day</h2>
        <div class="category-container">
            <div class="category-item">
                <a href="product-page.html">
                    <img src="https://cdn01.pharmeasy.in/dam/products_otc/S04683/evion-400mg-strip-of-20-capsule-2-1723105891.jpg?dim=1440x0"
                        alt="Best Offers">
                    <p class="product-name">Evion 400mg Strip Of 20 Capsule</p>
                    <p class="product-price">Price: $20</p>

                </a>
            </div>
            <div class="category-item">
                <a href="product-page.html">
                    <img src="https://cdn01.pharmeasy.in/dam/products_otc/I05393/protinex-nutritional-drink-mix-for-adults-with-high-protein-creamy-vanilla-250-gm-2-1685706483.jpg?dim=1024x0"
                        alt="Vitamins & Supplements">
                    <p class="product-name">Protinex Nutritional Drink Mix For Adults</p>
                    <p class="product-price">Price: $15</p>

                </a>
            </div>
            <div class="category-item">
                <a href="product-page.html">
                    <img src="https://cdn01.pharmeasy.in/dam/products_otc/J88340/swisse-ultivite-womens-multivitamin-for-energy-stamina-vitality-and-mental-performance-60-tablets-2-1667983848.jpg?dim=1024x0"
                        alt="Vitamins & Supplements">
                    <p class="product-name">Swisse Ultivite Women'S Multivitamin</p>
                    <p class="product-price">Price: $15</p>

                </a>
            </div>
            <div class="category-item">
                <a href="product-page.html">
                    <img src="https://cdn01.pharmeasy.in/dam/discovery/categoryImages/fa936f30b4563fc4abd187fb22fe5258.png?f=png?dim=360x0"
                        alt="Vitamins & Supplements">
                    <p class="product-name">Volini </p>
                    <p class="product-price">Price: $15</p>
                </a>
            </div>
            <div class="category-item">
                <a href="product-page.html">
                    <img src="https://cdn01.pharmeasy.in/dam/products_otc/159115/shelcal-500mg-strip-of-15-tablets-2-1679999355.jpg?dim=1440x0"
                        alt="Vitamins & Supplements">
                    <p class="product-name">Shelcal 500mg Strip Of 15 Tablets</p>
                    <p class="product-price">Price: $15</p>
                </a>
            </div>
            <div class="category-item">
                <a href="product-page.html">
                    <img src="https://cdn01.pharmeasy.in/dam/products_otc/L79986/everherb-karela-jamun-juice-helps-maintains-healthy-sugar-levels-helps-in-weight-management-1l-2-1723875556.jpg?dim=1024x0"
                        alt="Vitamins & Supplements">
                    <p class="product-name">Everherb Karela Jamun Juice</p>
                    <p class="product-price">Price: $15</p>
                </a>
            </div>
            <div class="category-item">
                <a href="product-page.html">
                    <img src="https://cdn01.pharmeasy.in/dam/products_otc/188996/zincovit-strip-of-15-tablets-green-2-1702990444.jpg?dim=1024x0"
                        alt="Vitamins & Supplements">
                    <p class="product-name">Zincovit Strip Of 15 Tablets (Green)</p>
                    <p class="product-price">Price: $15</p>
                </a>
            </div>

            <!-- Repeat for other categories -->
        </div>
        </script>
        <div class="carousel second-carousel">
            <div class="carousel-slides">
                <div class="slide active"><img src="banner1.jpg" alt="Banner 7"></div>
                <div class="slide"><img src="banner2.jpg" alt="Banner 8"></div>
                <div class="slide"><img src="banner3.jpg" alt="Banner 9"></div>
                <div class="slide"><img src="banner4.jpg" alt="Banner 10"></div>
            </div>
            <button class="carousel-button prev" onclick="moveSlideSecond(-1)">&#10094;</button>
            <button class="carousel-button next" onclick="moveSlideSecond(1)">&#10095;</button>
        </div>

        <script>
            let currentSlideSecond = 0;

            function showSlideSecond(index) {
                const slides = document.querySelectorAll('.second-carousel .slide');
                const totalSlides = slides.length;

                if (index >= totalSlides) {
                    currentSlideSecond = 0; // Go back to first slide
                } else if (index < 0) {
                    currentSlideSecond = totalSlides - 1; // Go to last slide
                } else {
                    currentSlideSecond = index; // Set to the given index
                }

                const offset = -currentSlideSecond * 100; // Calculate offset
                document.querySelector('.second-carousel .carousel-slides').style.transform = `translateX(${offset}%)`;

                slides.forEach((slide, i) => {
                    slide.style.opacity = (i === currentSlideSecond) ? 1 : 0;
                });
            }

            function moveSlideSecond(step) {
                showSlideSecond(currentSlideSecond + step); // Change slide
            }

            // Auto slide every 5 seconds for the second carousel
            setInterval(() => {
                moveSlideSecond(1);
            }, 5000);

            // Initial slide for the second carousel
            showSlideSecond(currentSlideSecond);
        </script>

    </section>
    <section class="section">
        <h2> Best Offers at 50</h2>
        <div class="category-container">
            <div class="category-item">
                <a href="product-page.html">
                    <img src="https://assets.mrmed.in/product-images/product-images-1717913612572-806063722-Cibinqo%20100mg%20Tablet_203238.jpg?w=828&q=75"
                        alt="Best Offers">
                    <p class="product-name">Cibinqo 100mg Tablet</p>
                    <p class="product-price">Price: 50</p>

                </a>
            </div>
            <div class="category-item">
                <a href="product-page.html">
                    <img src="https://assets.mrmed.in/product-images/product-images-1692171390057-999107507-EXEMPTIA%2020MG%20INJECTION_200895_1.jpg?w=828&q=75"
                        alt="Vitamins & Supplements">
                    <p class="product-name">Exemptia 20mg Injection</p>
                    <p class="product-price">Price: 50</p>

                </a>
            </div>
            <div class="category-item">
                <a href="product-page.html">
                    <img src="https://assets.mrmed.in/product-images/product-images-1708493762603-116649369-Gluta%20Ace%20Plus%20Tablet_202307.jpg?w=828&q=75"
                        alt="Vitamins & Supplements">
                    <p class="product-name">Gluta Ace Plus Tablet</p>
                    <p class="product-price">Price: 50 </p>

                </a>
            </div>
            <div class="category-item">
                <a href="product-page.html">
                    <img src="https://assets.mrmed.in/product-images/product-images-1644303947400-664390630-100295_1%20CA%20ATRA%2010MG%20CAPSULE.jpg?w=828&q=75"
                        alt="Vitamins & Supplements">
                    <p class="product-name">CA Retrans 10mg Capsule</p>
                    <p class="product-price">Price: 50</p>

                </a>
            </div>
            <div class="category-item">
                <a href="product-page.html">
                    <img src="https://assets.mrmed.in/product-images/product-images-1705576521501-499530542-Qrolz%20Plus%20250mg%20Tablet_200039.jpg?w=828&q=75"
                        alt="Vitamins & Supplements">
                    <p class="product-name">Qrolz Plus 250mg Tablet</p>
                    <p class="product-price">Price: 50</p>

                </a>
            </div>
            <div class="category-item">
                <a href="product-page.html">
                    <img src="https://assets.mrmed.in/product-images/product-images-1692171390057-999107507-EXEMPTIA%2020MG%20INJECTION_200895_1.jpg?w=828&q=75"
                        alt="Vitamins & Supplements">
                    <p class="product-name">Exemptia 20mg Injection</p>
                    <p class="product-price">Price: 50</p>

                </a>
            </div>
            <var>
                <div class="category-item">
                    <a href="product-page.html">
                        <img src="https://assets.mrmed.in/product-images/product-images-1692171390057-999107507-EXEMPTIA%2020MG%20INJECTION_200895_1.jpg?w=828&q=75"
                            alt="Vitamins & Supplements">
                        <p class="product-name">Exemptia 20mg Injection</p>
                        <p class="product-price">Price: 50</p>

                    </a>
                </div>
            </var>
            <!-- Repeat for other categories -->
        </div>
    </section>

    <div class="bottom"> @ Medi Sphere</div>
</body>

</html>