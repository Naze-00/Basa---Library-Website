<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Basa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="./css/style.css" rel="stylesheet" />
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="./img/basa.png" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#team">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    
                </ul>
                <a href="book_shop.php" class="btn btn-brand ms-lg-3">Shop Now</a>
            </div>
        </div>
    </nav>

    <section id="home" class="min-vh-100 d-flex align-items-center">
        <div id="particles-js"></div>
        <div class="container">
            <div class="row" data-aos="fade-up" data-aos-delay="50">
                <div class="col-8">
                    <h1 class="text-uppercase f2-semibold display-1">Welcome to <span class="basa">BASA</span>: THE
                        WONDERFUL WORLD OF READING.</h1>
                    <h5 class="mt-3 mb-4">"Nothing is pleasanter than exploring a library."</h5>
                    <div>
                        <a href="book_shop.php" class="btn btn-brand me-2">Shop Now</a>
                        <a href="#contact" class="btn btn-light ms-2">Contact Us</a>
                    </div>
                </div>
                <div class="col-4" data-aos="fade-up">
                    <img src="./img/undraw_bookshelves_re_lxoy.svg" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </section>
    <section id="about" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-up" data-aos-delay="50">
                    <div class="section-title">
                        <h1 class="text-white display-4 fw-semibold">About Us</h1>
                        <div class="l"></div>
                        <h6 class="text-white">What is BASA?</h6>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between align-items-center ">
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="50">
                    <img src="./img/undraw_bibliophile_re_xarc.svg" alt="" class="img-fluid about-img">
                </div>
                <div class="col-lg-6" data-aos="fade-down" data-aos-delay="50">
                    <h1 class="text-white">About BASA</h1>
                    <p class="mt-3 mb-4">We're passionate about making libraries even more convenient and accessible for
                        everyone. That's why we created this website, a one-stop shop for reserving library materials
                        and managing your library experience.</p>
                    <div class="d-flex pt-4 mb-3">
                        <div class="icons me-4">
                            <i class="ri-reserved-fill"></i>
                        </div>
                        <div>
                            <h5 class="text-white">EFFORTLESSLY RESERVE BOOKS</h5>
                            <p>No more waiting lists or wondering if that must-read is available. Reserve your copy with
                                a few clicks! Forget the frustration of waiting for a book to become available.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="icons me-4">
                            <i class="ri-hourglass-2-fill"></i>
                        </div>
                        <div>
                            <h5 class="text-white">SEE REAL-TIME AVAILABILITY</h5>
                            <p>Skip the guesswork! Our platform shows you exactly what's available and when, ensuring a
                                smooth library visit. Ditch the wasted trips!</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="icons me-4">
                            <i class="ri-account-pin-box-fill"></i>
                        </div>
                        <div>
                            <h5 class="text-white">MANAGE YOUR RESERVATIONS AND ACCOUNT WITH EASE.</h5>
                            <p>Keep track of your reservations, account details, and library activity – all in one
                                convenient place. No more scrambling for confirmation emails or wondering about upcoming
                                due dates.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="50">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Our Services</h1>
                        <div class="li"></div>
                        <h6>What Can We Offer?</h6>
                    </div>
                </div>
            </div>
            <div class="row g-4 text-center d-flex justify-content-center ">
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="150">
                    <div class="service shadow p-lg-5 p-4">
                        <div class="icons2">
                            <i class="ri-find-replace-line"></i>
                        </div>
                        <h5 class="mt-4 mb-3">Find & Reserve</h5>
                        <p>Easily find books and more with our powerful search engine. Reserve
                            items in demand and get notified when they're ready for pickup. See if an item is available,
                            on hold before you make a reservation.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="250">
                    <div class="service shadow p-lg-5 p-4">
                        <div class="icons2">
                            <i class="ri-account-circle-fill"></i>
                        </div>
                        <h5 class="mt-4 mb-3">Your Account</h5>
                        <p>Update your contact information, manage borrowing history, and set notification preferences.
                            Share your library account with family members for convenient shared borrowing. </p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="350">
                    <div class="service shadow p-lg-5 p-4">
                        <div class="icons2">
                            <i class="ri-bookmark-2-fill"></i>
                        </div>
                        <h5 class="mt-4 mb-3">Discover New Reads & Resources</h5>
                        <p>Refine your search by format, genre, publication date, and more to find exactly what you're
                            looking for. Get personalized suggestions based on your borrowing history.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="450">
                    <div class="service shadow p-lg-5 p-4">
                        <div class="icons2">
                            <i class="ri-links-fill"></i>
                        </div>
                        <h5 class="mt-4 mb-3">Stay Connected & Informed</h5>
                        <p>Get notified by email, text, or app message about hold availability, due dates, and library
                            updates. Get help with reservations, recommendations, or library services.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="650">
                    <div class="service shadow p-lg-5 p-4">
                        <div class="icons2">
                            <i class="ri-group-line"></i>
                        </div>
                        <h5 class="mt-4 mb-3">Accessibility for All</h5>
                        <p>Access the website and resources in multiple devices to ensure everyone feels welcome.
                            Learn about library programs and resources.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="section-padding bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="50">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Our Team</h1>
                        <div class="li"></div>
                        <h6>Who Are We?</h6>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 mt-4" data-aos="fade-up-right" data-aos-delay="150">
                    <div class="member d-flex align-items-start">
                        <div class="member-img">
                            <img src="./img/Members/a.jpg" alt="Darren" class="img-fluid">
                        </div>
                        <div class="member-info">
                            <h4>Darren Tuban</h4>
                            <span>Web Developer/Project Manager</span>
                            <p>I do see the beauty in the rules, the invisible code of chaos hiding behind the menacing face of order.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-4" data-aos="fade-up-left" data-aos-delay="250">
                    <div class="member d-flex align-items-start">
                        <div class="member-img">
                            <img src="./img/Members/rj.jpg" alt="Darren" class="img-fluid">
                        </div>
                        <div class="member-info">
                            <h4>Rj Arzadon</h4>
                            <span>Quality Tester</span>
                            <p>Thrive to be free-spirited and love to be able to go with the flow and get along well in
                                small groups of people.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-4" data-aos="fade-up-right" data-aos-delay="350">
                    <div class="member d-flex align-items-start">
                        <div class="member-img">
                            <img src="./img/Members/ximon.jpg" alt="Darren" class="img-fluid">
                        </div>
                        <div class="member-info">
                            <h4>Ximon Miguel Urbina</h4>
                            <span>Product Manager</span>
                            <p>I am a person who works hard, pushes for the greatness of the people that surround me,
                                and always thrives for the better outcome of my life.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-4" data-aos="fade-up-left" data-aos-delay="450">
                    <div class="member d-flex align-items-start">
                        <div class="member-img">
                            <img src="./img/Members/cj.png" alt="Darren" class="img-fluid">
                        </div>
                        <div class="member-info">
                            <h4>Cj Amboy</h4>
                            <span>UI Designer</span>
                            <p>A passionate Person and sincerity to achieve success and walk on my own journey to the
                                goal and to make sure I inspire anyone who wants to step on my footsteps.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-4" data-aos="fade-up" data-aos-delay="550">
                    <div class="member d-flex align-items-start">
                        <div class="member-img">
                            <img src="./img/Members/ivan.jpg" alt="Darren" class="img-fluid">
                        </div>
                        <div class="member-info">
                            <h4>Ivan Trovela</h4>
                            <span>Project Manager</span>
                            <p>Blah Blah Blah Blah Blah Blah Blah Blah Blah BlahBlah Blah Blah Blah Blah Blah Blah Blah
                                Blah Blah</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="50">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Contact Us</h1>
                        <div class="li"></div>
                        <h6>Questions? Send us a message!</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-lg-center">
                <div class="col-12 col-lg-9" data-aos="fade-down" data-aos-delay="50">
                    <div class="bg-white border rounded shadow-sm overflow-hidden">

                        <form action="./php/sendmail.php" method="post">
                            <div class="row gy-4 gy-xl-5 p-4 p-xl-5">
                                <div class="col-12">
                                    <label for="fullname" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="fullname" name="fullname" value="" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="ri-mail-fill"></i>
                                        </span>
                                        <input type="email" class="form-control" id="email" name="email" value="" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="ri-phone-line"></i>
                                        </span>
                                        <input type="tel" class="form-control" id="phone" name="phone" value="">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn btn-brand btn-lg submit-button" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="./js/script.js"></script>
    <script src="./js/particles.js"></script>
    <script src="./js/app.js"></script>
</body>

</html>