 <div>

    <style>
:root {

/**
 * colors
 */

--light-steel-blue: hsl(218, 33%, 77%);
--royal-blue-light: hsl(225, 68%, 53%);
--flickr-blue_30: hsla(225, 68%, 53%, 0.3);
--carolina-blue: hsl(201, 92%, 47%);
--oxford-blue-1: hsl(218, 70%, 18%);
--oxford-blue-2: hsl(217, 100%, 12%);
--oxford-blue-3: hsl(218, 71%, 11%);
--gainsboro_50: hsla(0, 0%, 85%, 0.5);
--lavender-web: hsl(225, 67%, 91%);
--sonic-silver: hsl(0, 0%, 47%);
--light-gray: hsl(0, 0%, 84%);
--cultured: hsl(0, 0%, 97%);
--black_10: hsla(0, 0%, 0%, 0.1);
--black_8: hsla(0, 0%, 0%, 0.08);
--white: hsl(0, 0%, 100%);
--black: hsl(0, 0%, 0%);
--jet: hsl(0, 0%, 20%);

/**
 * gradient color
 */

--gradient: linear-gradient( 90deg, var(--carolina-blue) 0%, var(--royal-blue-light) 100%);

/**
 * typography
 */

--ff-roboto: "Roboto", sans-serif;
--ff-poppins: "Poppins", sans-serif;

--fs-1: 4rem;
--fs-2: 3.6rem;
--fs-3: 3.2rem;
--fs-4: 2.4rem;
--fs-5: 2.2rem;
--fs-6: 1.8rem;
--fs-7: 1.6rem;

--fw-800: 800;
--fw-700: 700;
--fw-600: 600;
--fw-500: 500;

/**
 * spacing
 */

--section-padding: 120px;

/**
 * shadow
 */

--shadow-1: 4px 4px 15px var(--black_10);
--shadow-2: 0 10px 15px var(--black_10);
--shadow-3: 0px 20px 60px var(--black_8);
--shadow-4: 0px 10px 30px var(--flickr-blue_30);
--shadow-5: 0px 2px 60px 0px var(--black_10);

/**
 * border radius
 */

--radius-6: 6px;
--radius-4: 4px;

/**
 * transition
 */

--transition: 0.25s ease;
--cubic-out: cubic-bezier(0.33, 0.85, 0.4, 0.96);

}





/*-----------------------------------*\
#RESET
\*-----------------------------------*/

*,
*::before,
*::after {
margin: 0;
padding: 0;
box-sizing: border-box;
}

li { list-style: none; }

a {
text-decoration: none;
color: inherit;
}

a,
img,
span,
input,
button,
ion-icon { display: block; }

img { height: auto; }

input,
button {
background: none;
border: none;
font: inherit;
}

input { width: 100%; }

button { cursor: pointer; }

ion-icon { pointer-events: none; }

address { font-style: normal; }

html {
font-family: var(--ff-roboto);
font-size: 10px;
scroll-behavior: smooth;
}

body {
background-color: var(--white);
color: var(--sonic-silver);
font-size: 1.5rem;
}





/*-----------------------------------*\
#REUSED STYLE
\*-----------------------------------*/

.container { padding-inline: 25px; }

.section { padding-block: var(--section-padding); }

.section-subtitle {
color: var(--royal-blue-light);
font-family: var(--ff-poppins);
font-size: var(--fs-6);
font-weight: var(--fw-700);
text-transform: uppercase;
margin-block-end: 10px;
}

.h1,
.h2,
.h3 {
font-family: var(--ff-poppins);
line-height: 1.2;
}

.h1 {
color: var(--oxford-blue-1);
font-size: var(--fs-2);
}

.h2,
.h3 { color: var(--oxford-blue-2); }

.h2 { font-size: var(--fs-1); }

.h3 { font-size: var(--fs-5); }

.btn {
background-image: linear-gradient( var(--deg, 90deg), var(--carolina-blue) 0%, var(--royal-blue-light) 100%);
color: var(--white);
font-size: var(--fs-7);
text-transform: uppercase;
padding: 20px 30px;
text-align: center;
border-radius: var(--radius-4);
box-shadow: var(--shadow-4);
}

.btn:is(:hover, :focus) { --deg: -90deg; }

.w-100 { width: 100%; }

.text-center { text-align: center; }

.card-text,
.section-text { line-height: 1.7; }

.img-holder {
aspect-ratio: var(--width) / var(--height);
background-color: var(--light-gray);
}

.img-cover {
width: 100%;
height: 100%;
object-fit: cover;
}





/*-----------------------------------*\
#HEDER
\*-----------------------------------*/

.header-top,
.header-bottom .btn { display: none; }

.header-bottom {
position: absolute;
top: 0;
left: 0;
width: 100%;
padding-block: 15px;
z-index: 4;
}

.header-bottom.active {
position: fixed;
top: -81px;
background-color: var(--white);
box-shadow: var(--shadow-2);
animation: slideIn 0.5s var(--cubic-out) forwards;
}

@keyframes slideIn {
0% { transform: translateY(0); }
100% { transform: translateY(100%); }
}

.header-bottom > .container {
display: flex;
justify-content: space-between;
align-items: center;
gap: 20px;
}

.logo {
color: var(--oxford-blue-1);
font-family: var(--ff-poppins);
font-size: 3.4rem;
font-weight: var(--fw-800);
}

.nav-toggle-btn {
color: var(--black);
font-size: 30px;
border: 1px solid var(--black);
padding: 5px;
}

.nav-toggle-btn.active .menu-icon,
.nav-toggle-btn .close-icon { display: none; }

.nav-toggle-btn .menu-icon,
.nav-toggle-btn.active .close-icon { display: block; }

.navbar {
position: absolute;
top: calc(100% + 5px);
left: 25px;
right: 25px;
background-color: var(--white);
padding-inline: 0;
box-shadow: var(--shadow-1);
max-height: 0;
visibility: hidden;
overflow: hidden;
transition: 0.25s var(--cubic-out);
}

.navbar.active {
visibility: visible;
max-height: 244px;
transition-duration: 0.5s;
}

.navbar-list > li:not(:last-child) { border-block-end: 1px solid var(--gainsboro_50); }

.navbar-link {
color: var(--jet);
text-transform: uppercase;
font-weight: var(--fw-600);
padding: 15px;
}





/*-----------------------------------*\
#HERO
\*-----------------------------------*/

.hero {
background-repeat: no-repeat;
background-size: cover;
background-position: center;
padding-block-end: calc(var(--section-padding) / 2);
}

.hero-content { margin-block-end: 50px; }

.hero-title { margin-block: 15px 30px; }

.hero-text {
font-size: var(--fs-6);
line-height: 1.45;
margin-block-end: 40px;
}

.hero-form {
background-color: var(--white);
max-width: 95%;
padding: 15px;
border-radius: var(--radius-4);
box-shadow: var(--shadow-3);
}

.hero-form .email-field {
background-color: var(--cultured);
color: var(--black);
min-height: 70px;
padding-inline: 15px;
border-radius: var(--radius-4);
margin-block-end: 15px;
}

.hero-form .btn { width: 100%; }





/*-----------------------------------*\
#SERVICE
\*-----------------------------------*/

.service-banner { display: none; }

.service { padding-block-end: 0; }

.service .section-title { margin-block-end: 50px; }

.service-list {
display: grid;
gap: 15px;
}

.service-card {
display: flex;
align-items: flex-start;
gap: 30px;
min-height: 100%;
border: 1px solid var(--light-gray);
border-radius: var(--radius-4);
padding: 30px;
}

.service-card .card-icon {
width: 50px;
flex-shrink: 0;
}

.service-card .card-title { margin-block-end: 8px; }





/*-----------------------------------*\
#ABOUT
\*-----------------------------------*/

.about { padding-block-end: 0; }

.about-banner { margin-block-end: 50px; }

.about .section-text-1 { margin-block: 25px 15px; }

.about .btn {
font-size: unset;
max-width: max-content;
margin-block-start: 30px;
padding-inline: 15px;
}





/*-----------------------------------*\
#DOCTOR
\*-----------------------------------*/

.doctor .section-title { margin-block-end: 50px; }

.doctor-card .card-banner {
border-radius: var(--radius-4);
overflow: hidden;
margin-block-end: 25px;
}

.doctor-card {
padding: 30px;
border: 1px solid var(--light-gray);
border-radius: var(--radius-4);
text-align: center;
min-height: 100%;
}

.doctor-card .card-title {
font-size: var(--fs-4);
transition: var(--transition);
}

.doctor-card:is(:hover, :focus-within) .card-title { color: var(--royal-blue-light); }

.doctor-card .card-subtitle {
color: var(--royal-blue-light);
margin-block: 10px 15px;
}

.doctor-card .card-social-list {
display: flex;
justify-content: center;
align-items: center;
gap: 10px;
}

.doctor-card .card-social-link {
background-color: var(--lavender-web);
color: var(--royal-blue-light);
font-size: 16px;
padding: 12px;
border-radius: 50%;
transition: var(--transition);
}

.doctor-card .card-social-link:is(:hover, :focus) {
background-color: var(--royal-blue-light);
color: var(--white);
}

.has-scrollbar {
display: flex;
gap: 30px;
overflow-x: auto;
margin-inline: 15px;
padding-block-end: 40px;
margin-block-end: -20px;
scroll-snap-type: inline mandatory;
}

.scrollbar-item {
min-width: 100%;
scroll-snap-align: start;
}

.has-scrollbar::-webkit-scrollbar { height: 10px; }

.has-scrollbar::-webkit-scrollbar-track {
background-color: var(--light-gray);
border-radius: var(--radius-4);
}

.has-scrollbar::-webkit-scrollbar-thumb {
background-color: var(--royal-blue-light);
border-radius: var(--radius-4);
}

.has-scrollbar::-webkit-scrollbar-button { width: calc(25% - 30px); }





/*-----------------------------------*\
#CTA
\*-----------------------------------*/

.cta { background-color: var(--oxford-blue-1); }

.cta-banner { margin-block-end: 50px; }

.cta .section-subtitle { text-transform: capitalize; }

.cta .section-title {
color: var(--white);
font-size: var(--fs-3);
margin-block-end: 30px;
}

.cta .btn { max-width: max-content; }





/*-----------------------------------*\
#BLOG
\*-----------------------------------*/

.blog .section-title { margin-block-end: 50px; }

.blog-list {
display: grid;
gap: 30px;
}

.blog-card {
border-radius: var(--radius-4);
box-shadow: var(--shadow-5);
}

.blog-card .card-banner {
position: relative;
border-radius: var(--radius-4);
overflow: hidden;
}

.blog-card .card-banner img { transition: var(--transition); }

.blog-card:is(:hover, :focus-within) .card-banner img { transform: scale(1.1); }

.blog-card .card-badge {
background-color: var(--royal-blue-light);
color: var(--white);
position: absolute;
bottom: 25px;
left: 25px;
display: flex;
gap: 5px;
padding: 10px 15px;
border-radius: var(--radius-6);
}

.blog-card .card-content { padding: 30px; }

.blog-card .card-title { transition: var(--transition); }

.blog-card .card-title:is(:hover, :focus) { color: var(--royal-blue-light); }

.blog-card .card-text { margin-block: 15px; }

.blog-card .card-link {
position: relative;
color: var(--royal-blue-light);
font-weight: var(--fw-500);
text-transform: uppercase;
width: max-content;
transition: var(--transition);
}

.blog-card .card-link::after {
content: "";
position: absolute;
bottom: -5px;
left: 0;
width: 100%;
height: 3px;
background-color: var(--royal-blue-light);
transition: var(--transition);
}

.blog-card .card-link:is(:hover, :focus) { color: var(--oxford-blue-1); }

.blog-card .card-link:is(:hover, :focus)::after { background-color: var(--oxford-blue-1); }





/*-----------------------------------*\
#FOOTER
\*-----------------------------------*/

.footer-top {
background-color: var(--oxford-blue-2);
color: var(--light-steel-blue);
}

.footer-top .container {
display: grid;
gap: 30px;
}

.footer-brand .logo { color: var(--white); }

.footer-text {
line-height: 1.6;
margin-block: 15px;
}

.schedule {
display: flex;
align-items: center;
gap: 15px;
}

.schedule-icon,
.footer-item .item-icon {
background-image: var(--gradient);
color: var(--white);
font-size: 18px;
padding: 11px;
border-radius: 50%;
}

.schedule .span,
.footer-item .item-text { line-height: 1.6; }

.footer-list-title {
color: var(--white);
font-family: var(--ff-poppins);
font-size: var(--fs-4);
font-weight: var(--fw-700);
margin-block-end: 10px;
}

.footer-link {
display: flex;
align-items: center;
gap: 5px;
padding-block: 10px;
transition: var(--transition);
}

.footer-link ion-icon {
color: var(--royal-blue-light);
--ionicon-stroke-width: 50px;
}

.footer-link:is(:hover, :focus) { color: var(--white); }

.footer-item {
display: flex;
align-items: center;
gap: 10px;
}

.footer-item:not(:first-child) { margin-block-start: 20px; }

.footer-bottom {
background-color: var(--oxford-blue-3);
padding-block: 50px;
text-align: center;
}

.copyright {
color: var(--white);
line-height: 1.6;
margin-block-end: 25px;
}

.footer .social-list {
display: flex;
justify-content: center;
align-items: center;
gap: 15px;
}

.footer .social-link {
padding: 11px;
background-color: hsla(0, 0%, 100%, 0.2);
color: var(--white);
font-size: 18px;
border-radius: 50%;
}

.footer .social-link:is(:hover, :focus) { background-image: var(--gradient); }





/*-----------------------------------*\
#BACK TO TOP
\*-----------------------------------*/

.back-top-btn {
position: fixed;
bottom: 10px;
right: 20px;
background-color: var(--royal-blue-light);
font-size: 18px;
color: var(--white);
padding: 14px;
border-radius: 50%;
visibility: hidden;
opacity: 0;
transition: var(--transition);
}

.back-top-btn.active {
transform: translateY(-10px);
visibility: visible;
opacity: 1;
}





/*-----------------------------------*\
#MEDIA QUERIES
\*-----------------------------------*/

/**
* responsive for larger than 575px screen
*/

@media (min-width: 575px) {

/**
 * CUSTOM PROPERTY
 */

:root {

  /**
   * typography
   */

  --fs-1: 4.2rem;

}



/**
 * REUSED STYLE
 */

.container {
  max-width: 540px;
  width: 100%;
  margin-inline: auto;
}



/**
 * BLOG
 */

.blog-card .h3 { --fs-5: 2.6rem; }



/**
 * FOOTER
 */

.footer-top .container { grid-template-columns: 1fr 1fr; }

}





/**
* responsive for larger than 768px screen
*/

@media (min-width: 768px) {

/**
 * CUSTOM PROPERTY
 */

:root {

  /**
   * typography
   */

  --fs-2: 4.8rem;

}



/**
 * RESET
 */

body { font-size: 1.6rem; }



/**
 * REUSED STYLE
 */

.container { max-width: 750px; }

.section-subtitle { --fs-6: 2.2rem; }



/**
 * HERO
 */

.hero { overflow: hidden; }

.hero .container {
  display: grid;
  grid-template-columns: 1fr 0.75fr;
  align-items: center;
  gap: 20px;
}

.hero-content { margin-block-end: 0; }

.hero-form { position: relative; }

.hero-form .email-field {
  margin-block-end: 0;
  padding-inline-end: 190px;
}

.hero-form .btn {
  width: auto;
  position: absolute;
  top: 15px;
  right: 15px;
  bottom: 15px;
}

.hero-banner { margin-inline-end: -60px; }



/**
 * SERVICE
 */

.service-list {
  grid-template-columns: 1fr 1fr;
  column-gap: 30px;
}



/**
 * DOCTOR
 */

.scrollbar-item { min-width: calc(50% - 15px); }



/**
 * CTA
 */

.cta { padding-block: 0; }

.cta .container {
  display: grid;
  grid-template-columns: 1fr 1fr;
  align-items: flex-end;
  gap: 60px;
}

.cta-banner { margin-block-end: 0; }

.cta-content { padding-block: 60px; }



/**
 * BLOG
 */

.blog-list { grid-template-columns: 1fr 1fr; }



/**
 * FOOTER
 */

.footer-bottom { padding-block: 30px; }

.footer-bottom .container {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.copyright { margin-block-end: 0; }



/**
 * BACK TO TOP
 */

.back-top-btn {
  bottom: 70px;
  right: 50px;
}

}





/**
* responsive for larger than 992px screen
*/

@media (min-width: 992px) {

/**
 * CUSTOM PROPERTY
 */

:root {

  /**
   * typography
   */

  --fs-2: 6rem;
  --fs-1: 4.6rem;
  --fs-3: 4.6rem;

}



/**
 * REUSED STYLE
 */

.container { max-width: 980px; }



/**
 * HEADER
 */

.header-top {
  display: block;
  background-color: var(--oxford-blue-1);
  color: var(--white);
  padding-block: 20px;
}

.header-top :is(.container, .social-list),
.contact-list,
.contact-item {
  display: flex;
  align-items: center;
}

.header-top .container { justify-content: space-between; }

.contact-list { gap: 20px; }

.contact-item { gap: 5px; }

.contact-item ion-icon {
  color: var(--royal-blue-light);
  --ionicon-stroke-width: 40px;
}

.contact-link { font-size: 1.5rem; }

.header-top .social-list { gap: 15px; }

.header-top .social-link {
  font-size: var(--fs-6);
  transition: var(--transition);
}

.header-top .social-link:is(:hover, :focus) { color: var(--royal-blue-light); }

.header-bottom {
  top: 58px;
  padding-block: 20px;
}

.header-bottom.active { top: -95px; }

.nav-toggle-btn { display: none; }

.navbar,
.navbar.active {
  all: unset;
  margin-inline-start: auto;
}

.navbar-list {
  display: flex;
  align-items: center;
}

.navbar-list > li:not(:last-child) { border-block-end: none; }

.navbar-link {
  color: var(--oxford-blue-1);
  font-family: var(--ff-poppins);
  text-transform: capitalize;
  transition: var(--transition);
}

.navbar-link:is(:hover, :focus) { color: var(--royal-blue-light); }

.header-bottom .btn {
  display: block;
  padding: 15px 20px;
}



/**
 * SERVICE
 */

.service-list { grid-template-columns: repeat(3, 1fr); }

.service-banner {
  display: block;
  grid-column: 2 / 3;
  grid-row: 1 / 4;
  align-self: center;
}



/**
 * ABOUT
 */

.about .container {
  display: grid;
  grid-template-columns: 1fr 1fr;
  align-items: center;
  gap: 30px;
}

.about-banner { margin-block-end: 0; }



/**
 * DOCTOR
 */

.scrollbar-item { min-width: calc(33.33% - 20px); }



/**
 * CTA
 */

.cta-content { padding-block: 80px; }



/**
 * BLOG
 */

.blog-list { grid-template-columns: repeat(3, 1fr); }



/**
 * FOOTER
 */

.footer-top .container { grid-template-columns: 1fr 0.5fr 0.6fr 0.75fr; }

}





/**
* responsive for larger than 1200px screen
*/

@media (min-width: 1200px) {

/**
 * CUSTOM PROPERTY
 */

:root {

  /**
   * typography
   */

  --fs-2: 8rem;
  --fs-1: 5.5rem;
  --fs-3: 4.8rem;

}



/**
 * REUSED STYLE
 */

.container { max-width: 1180px; }



/**
 * HEADER
 */

.contact-list { gap: 30px; }

.header-bottom .btn { padding: 18px 30px; }

.header-bottom > .container { gap: 40px; }

.navbar-list { gap: 15px; }



/**
 * ABOUT
 */

.about .container {
  grid-template-columns: 0.85fr 1fr;
  gap: 100px;
}



/**
 * DOCTOR
 */

.doctor { padding-block-end: 180px; }

.scrollbar-item { min-width: calc(25% - 22.5px); }

.has-scrollbar {
  padding-block-end: 0;
  margin-block-end: 0;
}



/**
 * CTA
 */

.cta .container { align-items: center; }

.cta-banner { margin-block-start: -120px; }

}
    </style>
    <header class="header">

        <div class="header-top">
          <div class="container">
    
            <ul class="contact-list">
    
              <li class="contact-item">
                <ion-icon name="mail-outline"></ion-icon>
    
                <a href="mailto:info@example.com" class="contact-link">info@example.com</a>
              </li>
    
              <li class="contact-item">
                <ion-icon name="call-outline"></ion-icon>
    
                <a href="tel:+917052101786" class="contact-link">+91-7052-101-786</a>
              </li>
    
            </ul>
    
            <ul class="social-list">
    
              <li>
                <a href="#" class="social-link">
                  <ion-icon name="logo-facebook"></ion-icon>
                </a>
              </li>
    
              <li>
                <a href="#" class="social-link">
                  <ion-icon name="logo-instagram"></ion-icon>
                </a>
              </li>
    
              <li>
                <a href="#" class="social-link">
                  <ion-icon name="logo-twitter"></ion-icon>
                </a>
              </li>
    
              <li>
                <a href="#" class="social-link">
                  <ion-icon name="logo-youtube"></ion-icon>
                </a>
              </li>
    
            </ul>
    
          </div>
        </div>
    
        <div class="header-bottom" data-header>
          <div class="container">
    
            <a href="#" class="logo">Dentelo.</a>
    
            <nav class="navbar container" data-navbar>
              <ul class="navbar-list">
    
                <li>
                  <a href="#home" class="navbar-link" data-nav-link>Home</a>
                </li>
    
                <li>
                  <a href="#service" class="navbar-link" data-nav-link>Services</a>
                </li>
    
                <li>
                  <a href="#about" class="navbar-link" data-nav-link>About Us</a>
                </li>
    
                <li>
                  <a href="#blog" class="navbar-link" data-nav-link>Blog</a>
                </li>
    
                <li>
                  <a href="#" class="navbar-link" data-nav-link>Contact</a>
                </li>
    
              </ul>
            </nav>
    
            <a href="#" class="btn">Book appointment</a>
    
            <button class="nav-toggle-btn" aria-label="Toggle menu" data-nav-toggler>
              <ion-icon name="menu-sharp" aria-hidden="true" class="menu-icon"></ion-icon>
              <ion-icon name="close-sharp" aria-hidden="true" class="close-icon"></ion-icon>
            </button>
    
          </div>
        </div>
    
      </header>
    
    
    
    
    
      <main>
        <article>
    
          <!-- 
            - #HERO
          -->
    
          <section class="section hero" id="home" style="background-image: url('./assets/images/hero-bg.png')"
            aria-label="hero">
            <div class="container">
    
              <div class="hero-content">
    
                <p class="section-subtitle">Welcome To Dentelo</p>
    
                <h1 class="h1 hero-title">We Are Best Dental Service</h1>
    
                <p class="hero-text">
                  Donec vitae libero non enim placerat eleifend aliquam erat volutpat. Curabitur diam ex, dapibus purus
                  sapien, cursus sed
                  nisl tristique, commodo gravida lectus non.
                </p>
    
                <form action="" class="hero-form">
                  <input type="email" name="email_address" aria-label="email" placeholder="Your Email Address..." required
                    class="email-field">
    
                  <button type="submit" class="btn">Get Call Back</button>
                </form>
    
              </div>
    
              <figure class="hero-banner">
                <img src="./assets/images/hero-banner.png" width="587" height="839" alt="hero banner" class="w-100">
              </figure>
    
            </div>
          </section>
    
    
    
    
    
          <!-- 
            - #SERVICE
          -->
    
          <section class="section service" id="service" aria-label="service">
            <div class="container">
    
              <p class="section-subtitle text-center">Our Services</p>
    
              <h2 class="h2 section-title text-center">What We Provide</h2>
    
              <ul class="service-list">
    
                <li>
                  <div class="service-card">
    
                    <div class="card-icon">
                      <img src="./assets/images/service-icon-1.png" width="100" height="100" loading="lazy"
                        alt="service icon" class="w-100">
                    </div>
    
                    <div>
                      <h3 class="h3 card-title">Root Canal</h3>
    
                      <p class="card-text">
                        Aenean eleifend turpis tellus, nec laoreet metus elementum ac.
                      </p>
                    </div>
    
                  </div>
                </li>
    
                <li>
                  <div class="service-card">
    
                    <div class="card-icon">
                      <img src="./assets/images/service-icon-2.png" width="100" height="100" loading="lazy"
                        alt="service icon" class="w-100">
                    </div>
    
                    <div>
                      <h3 class="h3 card-title">Alignment Teeth</h3>
    
                      <p class="card-text">
                        Aenean eleifend turpis tellus, nec laoreet metus elementum ac.
                      </p>
                    </div>
    
                  </div>
                </li>
    
                <li>
                  <div class="service-card">
    
                    <div class="card-icon">
                      <img src="./assets/images/service-icon-3.png" width="100" height="100" loading="lazy"
                        alt="service icon" class="w-100">
                    </div>
    
                    <div>
                      <h3 class="h3 card-title">Cosmetic Teeth</h3>
    
                      <p class="card-text">
                        Aenean eleifend turpis tellus, nec laoreet metus elementum ac.
                      </p>
                    </div>
    
                  </div>
                </li>
    
                <li class="service-banner">
                  <figure>
                    <img src="./assets/images/service-banner.png" width="409" height="467" loading="lazy"
                      alt="service banner" class="w-100">
                  </figure>
                </li>
    
                <li>
                  <div class="service-card">
    
                    <div class="card-icon">
                      <img src="./assets/images/service-icon-4.png" width="100" height="100" loading="lazy"
                        alt="service icon" class="w-100">
                    </div>
    
                    <div>
                      <h3 class="h3 card-title">Oral Hygiene</h3>
    
                      <p class="card-text">
                        Aenean eleifend turpis tellus, nec laoreet metus elementum ac.
                      </p>
                    </div>
    
                  </div>
                </li>
    
                <li>
                  <div class="service-card">
    
                    <div class="card-icon">
                      <img src="./assets/images/service-icon-5.png" width="100" height="100" loading="lazy"
                        alt="service icon" class="w-100">
                    </div>
    
                    <div>
                      <h3 class="h3 card-title">Live Advisory</h3>
    
                      <p class="card-text">
                        Aenean eleifend turpis tellus, nec laoreet metus elementum ac.
                      </p>
                    </div>
    
                  </div>
                </li>
    
                <li>
                  <div class="service-card">
    
                    <div class="card-icon">
                      <img src="./assets/images/service-icon-6.png" width="100" height="100" loading="lazy"
                        alt="service icon" class="w-100">
                    </div>
    
                    <div>
                      <h3 class="h3 card-title">Cavity Inspection</h3>
    
                      <p class="card-text">
                        Aenean eleifend turpis tellus, nec laoreet metus elementum ac.
                      </p>
                    </div>
    
                  </div>
                </li>
    
              </ul>
    
            </div>
          </section>
    
    
    
    
    
          <!-- 
            - #ABOUT
          -->
    
          <section class="section about" id="about" aria-label="about">
            <div class="container">
    
              <figure class="about-banner">
                <img src="./assets/images/about-banner.png" width="470" height="538" loading="lazy" alt="about banner"
                  class="w-100">
              </figure>
    
              <div class="about-content">
    
                <p class="section-subtitle">About Us</p>
    
                <h2 class="h2 section-title">We Care For Your Dental Health</h2>
    
                <p class="section-text section-text-1">
                  Aliquam ac sem et diam iaculis efficitur. Morbi in enim odio. Nullam quis volutpat est, sed dapibus
                  sapien. Cras
                  condimentum eu velit id tempor. Curabitur purus sapien, cursus sed nisl tristique, commodo vehicula arcu.
                </p>
    
                <p class="section-text">
                  Aliquam erat volutpat. Aliquam enim massa, sagittis blandit ex mattis, ultricies posuere sapien. Morbi a
                  dignissim enim.
                  Fusce elementum, augue in elementum porta, sapien nunc volutpat ex, a accumsan nunc lectus eu lectus.
                </p>
    
                <a href="#" class="btn">Read more</a>
    
              </div>
    
            </div>
          </section>
    
    
    
    
    
          <!-- 
            - #DOCTOR
          -->
    
          <section class="section doctor" aria-label="doctor">
            <div class="container">
    
              <p class="section-subtitle text-center">Our Doctor</p>
    
              <h2 class="h2 section-title text-center">Best Expert Dentist</h2>
    
              <ul class="has-scrollbar">
    
                <li class="scrollbar-item">
                  <div class="doctor-card">
    
                    <div class="card-banner img-holder" style="--width: 460; --height: 500;">
                      <img src="./assets/images/doctor-1.png" width="460" height="500" loading="lazy" alt="Howard Holmes"
                        class="img-cover">
                    </div>
    
                    <h3 class="h3">
                      <a href="#" class="card-title">Howard Holmes</a>
                    </h3>
    
                    <p class="card-subtitle">Dentist</p>
    
                    <ul class="card-social-list">
    
                      <li>
                        <a href="#" class="card-social-link">
                          <ion-icon name="logo-facebook"></ion-icon>
                        </a>
                      </li>
    
                      <li>
                        <a href="#" class="card-social-link">
                          <ion-icon name="logo-twitter"></ion-icon>
                        </a>
                      </li>
    
                      <li>
                        <a href="#" class="card-social-link">
                          <ion-icon name="logo-instagram"></ion-icon>
                        </a>
                      </li>
    
                    </ul>
    
                  </div>
                </li>
    
                <li class="scrollbar-item">
                  <div class="doctor-card">
    
                    <div class="card-banner img-holder" style="--width: 460; --height: 500;">
                      <img src="./assets/images/doctor-2.png" width="460" height="500" loading="lazy" alt="Ella Thompson"
                        class="img-cover">
                    </div>
    
                    <h3 class="h3">
                      <a href="#" class="card-title">Ella Thompson</a>
                    </h3>
    
                    <p class="card-subtitle">Dentist</p>
    
                    <ul class="card-social-list">
    
                      <li>
                        <a href="#" class="card-social-link">
                          <ion-icon name="logo-facebook"></ion-icon>
                        </a>
                      </li>
    
                      <li>
                        <a href="#" class="card-social-link">
                          <ion-icon name="logo-twitter"></ion-icon>
                        </a>
                      </li>
    
                      <li>
                        <a href="#" class="card-social-link">
                          <ion-icon name="logo-instagram"></ion-icon>
                        </a>
                      </li>
    
                    </ul>
    
                  </div>
                </li>
    
                <li class="scrollbar-item">
                  <div class="doctor-card">
    
                    <div class="card-banner img-holder" style="--width: 460; --height: 500;">
                      <img src="./assets/images/doctor-3.png" width="460" height="500" loading="lazy" alt="Vincent Cooper"
                        class="img-cover">
                    </div>
    
                    <h3 class="h3">
                      <a href="#" class="card-title">Vincent Cooper</a>
                    </h3>
    
                    <p class="card-subtitle">Dentist</p>
    
                    <ul class="card-social-list">
    
                      <li>
                        <a href="#" class="card-social-link">
                          <ion-icon name="logo-facebook"></ion-icon>
                        </a>
                      </li>
    
                      <li>
                        <a href="#" class="card-social-link">
                          <ion-icon name="logo-twitter"></ion-icon>
                        </a>
                      </li>
    
                      <li>
                        <a href="#" class="card-social-link">
                          <ion-icon name="logo-instagram"></ion-icon>
                        </a>
                      </li>
    
                    </ul>
    
                  </div>
                </li>
    
                <li class="scrollbar-item">
                  <div class="doctor-card">
    
                    <div class="card-banner img-holder" style="--width: 460; --height: 500;">
                      <img src="./assets/images/doctor-4.png" width="460" height="500" loading="lazy" alt="Danielle Bryant"
                        class="img-cover">
                    </div>
    
                    <h3 class="h3">
                      <a href="#" class="card-title">Danielle Bryant</a>
                    </h3>
    
                    <p class="card-subtitle">Dentist</p>
    
                    <ul class="card-social-list">
    
                      <li>
                        <a href="#" class="card-social-link">
                          <ion-icon name="logo-facebook"></ion-icon>
                        </a>
                      </li>
    
                      <li>
                        <a href="#" class="card-social-link">
                          <ion-icon name="logo-twitter"></ion-icon>
                        </a>
                      </li>
    
                      <li>
                        <a href="#" class="card-social-link">
                          <ion-icon name="logo-instagram"></ion-icon>
                        </a>
                      </li>
    
                    </ul>
    
                  </div>
                </li>
    
              </ul>
    
            </div>
          </section>
    
    
    
    
    
          <!-- 
            - #CTA
          -->
    
          <section class="section cta" aria-label="cta">
            <div class="container">
    
              <figure class="cta-banner">
                <img src="./assets/images/cta-banner.png" width="1056" height="1076" loading="lazy" alt="cta banner"
                  class="w-100">
              </figure>
    
              <div class="cta-content">
    
                <p class="section-subtitle">Book Dentail Appointment</p>
    
                <h2 class="h2 section-title">We Are open And Welcoming Patients</h2>
    
                <a href="#" class="btn">Book appointment</a>
    
              </div>
    
            </div>
          </section>
    
    
    
    
    
          <!-- 
            - #BLOG
          -->
    
          <section class="section blog" id="blog" aria-label="blog">
            <div class="container">
    
              <p class="section-subtitle text-center">Our Blog</p>
    
              <h2 class="h2 section-title text-center">Latest Blog & News</h2>
    
              <ul class="blog-list">
    
                <li>
                  <div class="blog-card">
    
                    <figure class="card-banner img-holder" style="--width: 1180; --height: 800;">
                      <img src="./assets/images/blog-1.jpg" width="1180" height="800" loading="lazy"
                        alt="Cras accumsan nulla nec lacus ultricies placerat." class="img-cover">
    
                      <div class="card-badge">
                        <ion-icon name="calendar-outline"></ion-icon>
    
                        <time class="time" datetime="2022-03-24">24th March 2022</time>
                      </div>
                    </figure>
    
                    <div class="card-content">
    
                      <h3 class="h3">
                        <a href="#" class="card-title">Cras accumsan nulla nec lacus ultricies placerat.</a>
                      </h3>
    
                      <p class="card-text">
                        Curabitur sagittis libero tincidunt tempor finibus. Mauris at dignissim ligula, nec tristique orci.
                      </p>
    
                      <a href="#" class="card-link">Read More</a>
    
                    </div>
    
                  </div>
                </li>
    
                <li>
                  <div class="blog-card">
    
                    <figure class="card-banner img-holder" style="--width: 1180; --height: 800;">
                      <img src="./assets/images/blog-2.jpg" width="1180" height="800" loading="lazy"
                        alt="Dras accumsan nulla nec lacus ultricies placerat." class="img-cover">
    
                      <div class="card-badge">
                        <ion-icon name="calendar-outline"></ion-icon>
    
                        <time class="time" datetime="2022-03-24">24th March 2022</time>
                      </div>
                    </figure>
    
                    <div class="card-content">
    
                      <h3 class="h3">
                        <a href="#" class="card-title">Dras accumsan nulla nec lacus ultricies placerat.</a>
                      </h3>
    
                      <p class="card-text">
                        Curabitur sagittis libero tincidunt tempor finibus. Mauris at dignissim ligula, nec tristique orci.
                      </p>
    
                      <a href="#" class="card-link">Read More</a>
    
                    </div>
    
                  </div>
                </li>
    
                <li>
                  <div class="blog-card">
    
                    <figure class="card-banner img-holder" style="--width: 1180; --height: 800;">
                      <img src="./assets/images/blog-3.jpg" width="1180" height="800" loading="lazy"
                        alt="Seas accumsan nulla nec lacus ultricies placerat." class="img-cover">
    
                      <div class="card-badge">
                        <ion-icon name="calendar-outline"></ion-icon>
    
                        <time class="time" datetime="2022-03-24">24th March 2022</time>
                      </div>
                    </figure>
    
                    <div class="card-content">
    
                      <h3 class="h3">
                        <a href="#" class="card-title">Seas accumsan nulla nec lacus ultricies placerat.</a>
                      </h3>
    
                      <p class="card-text">
                        Curabitur sagittis libero tincidunt tempor finibus. Mauris at dignissim ligula, nec tristique orci.
                      </p>
    
                      <a href="#" class="card-link">Read More</a>
    
                    </div>
    
                  </div>
                </li>
    
              </ul>
    
            </div>
          </section>
    
        </article>
      </main>
    
    
    
    
    
      <!-- 
        - #FOOTER
      -->
    
      <footer class="footer">
    
        <div class="footer-top section">
          <div class="container">
    
            <div class="footer-brand">
    
              <a href="#" class="logo">Dentelo.</a>
    
              <p class="footer-text">
                Mauris non nisi semper, lacinia neque in, dapibus leo. Curabitur sagittis libero tincidunt tempor finibus.
                Mauris at
                dignissim ligula, nec tristique orci.Quisque vitae metus.
              </p>
    
              <div class="schedule">
                <div class="schedule-icon">
                  <ion-icon name="time-outline"></ion-icon>
                </div>
    
                <span class="span">
                  Monday - Saturday:<br>
                  9:00am - 10:00Pm
                </span>
              </div>
    
            </div>
    
            <ul class="footer-list">
    
              <li>
                <p class="footer-list-title">Other Links</p>
              </li>
    
              <li>
                <a href="#" class="footer-link">
                  <ion-icon name="add-outline"></ion-icon>
    
                  <span class="span">Home</span>
                </a>
              </li>
    
              <li>
                <a href="#" class="footer-link">
                  <ion-icon name="add-outline"></ion-icon>
    
                  <span class="span">About Us</span>
                </a>
              </li>
    
              <li>
                <a href="#" class="footer-link">
                  <ion-icon name="add-outline"></ion-icon>
    
                  <span class="span">Services</span>
                </a>
              </li>
    
              <li>
                <a href="#" class="footer-link">
                  <ion-icon name="add-outline"></ion-icon>
    
                  <span class="span">Project</span>
                </a>
              </li>
    
              <li>
                <a href="#" class="footer-link">
                  <ion-icon name="add-outline"></ion-icon>
    
                  <span class="span">Our Team</span>
                </a>
              </li>
    
              <li>
                <a href="#" class="footer-link">
                  <ion-icon name="add-outline"></ion-icon>
    
                  <span class="span">Latest Blog</span>
                </a>
              </li>
    
            </ul>
    
            <ul class="footer-list">
    
              <li>
                <p class="footer-list-title">Our Services</p>
              </li>
    
              <li>
                <a href="#" class="footer-link">
                  <ion-icon name="add-outline"></ion-icon>
    
                  <span class="span">Root Canal</span>
                </a>
              </li>
    
              <li>
                <a href="#" class="footer-link">
                  <ion-icon name="add-outline"></ion-icon>
    
                  <span class="span">Alignment Teeth</span>
                </a>
              </li>
    
              <li>
                <a href="#" class="footer-link">
                  <ion-icon name="add-outline"></ion-icon>
    
                  <span class="span">Cosmetic Teeth</span>
                </a>
              </li>
    
              <li>
                <a href="#" class="footer-link">
                  <ion-icon name="add-outline"></ion-icon>
    
                  <span class="span">Oral Hygiene</span>
                </a>
              </li>
    
              <li>
                <a href="#" class="footer-link">
                  <ion-icon name="add-outline"></ion-icon>
    
                  <span class="span">Live Advisory</span>
                </a>
              </li>
    
              <li>
                <a href="#" class="footer-link">
                  <ion-icon name="add-outline"></ion-icon>
    
                  <span class="span">Cavity Inspection</span>
                </a>
              </li>
    
            </ul>
    
            <ul class="footer-list">
    
              <li>
                <p class="footer-list-title">Contact Us</p>
              </li>
    
              <li class="footer-item">
                <div class="item-icon">
                  <ion-icon name="location-outline"></ion-icon>
                </div>
    
                <address class="item-text">
                  1247/Plot No. 39, 15th Phase,<br>
                  LHB Colony, Kanpur
                </address>
              </li>
    
              <li class="footer-item">
                <div class="item-icon">
                  <ion-icon name="call-outline"></ion-icon>
                </div>
    
                <a href="tel:+917052101786" class="footer-link">+91-7052-101-786</a>
              </li>
    
              <li class="footer-item">
                <div class="item-icon">
                  <ion-icon name="mail-outline"></ion-icon>
                </div>
    
                <a href="mailto:help@example.com" class="footer-link">help@example.com</a>
              </li>
    
            </ul>
    
          </div>
        </div>
    
        <div class="footer-bottom">
          <div class="container">
    
            <p class="copyright">
              &copy; 2022 All Rights Reserved by codewithsadee.
            </p>
    
            <ul class="social-list">
    
              <li>
                <a href="#" class="social-link">
                  <ion-icon name="logo-facebook"></ion-icon>
                </a>
              </li>
    
              <li>
                <a href="#" class="social-link">
                  <ion-icon name="logo-instagram"></ion-icon>
                </a>
              </li>
    
              <li>
                <a href="#" class="social-link">
                  <ion-icon name="logo-twitter"></ion-icon>
                </a>
              </li>
    
            </ul>
    
          </div>
        </div>
    
      </footer>
    
    
    
    
    
      <!-- 
        - #BACK TO TOP
      -->
    
      <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
        <ion-icon name="caret-up" aria-hidden="true"></ion-icon>
      </a>    
 </div>

 <script>
    'use strict';



/**
 * addEvent on element
 */

const addEventOnElem = function (elem, type, callback) {
  if (elem.length > 1) {
    for (let i = 0; i < elem.length; i++) {
      elem[i].addEventListener(type, callback);
    }
  } else {
    elem.addEventListener(type, callback);
  }
}



/**
 * navbar toggle
 */

const navbar = document.querySelector("[data-navbar]");
const navbarLinks = document.querySelectorAll("[data-nav-link]");
const navbarToggler = document.querySelector("[data-nav-toggler]");

const toggleNav = function () {
  navbar.classList.toggle("active");
  navbarToggler.classList.toggle("active");
}

addEventOnElem(navbarToggler, "click", toggleNav);

const closeNav = function () {
  navbar.classList.remove("active");
  navbarToggler.classList.remove("active");
}

addEventOnElem(navbarLinks, "click", closeNav);



/**
 * header active
 */

const header = document.querySelector("[data-header]");
const backTopBtn = document.querySelector("[data-back-top-btn]");

window.addEventListener("scroll", function () {
  if (window.scrollY >= 100) {
    header.classList.add("active");
    backTopBtn.classList.add("active");
  } else {
    header.classList.remove("active");
    backTopBtn.classList.remove("active");
  }
});
 </script>