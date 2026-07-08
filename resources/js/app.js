import AOS from 'aos';
import 'aos/dist/aos.css';

AOS.init({
    duration: 900,
    once: true,
    offset: 100,
    easing: 'ease-out-cubic',
});

document.addEventListener("DOMContentLoaded", () => {

    console.log("JS APP AKTIF");

    const navbar = document.getElementById("navbar");
    const mobileButton = document.getElementById("mobileButton");
    const mobileMenu = document.getElementById("mobileMenu");
    const closeMenu = document.getElementById("closeMenu");
    const mobileOverlay = document.getElementById("mobileOverlay");
    const mobileLinks = document.querySelectorAll(".mobile-nav-link");

    // SCROLL NAVBAR
    if (navbar) {
        window.addEventListener("scroll", () => {

            if (window.scrollY > 50) {
                navbar.classList.add("bg-white", "shadow", "text-slate-900");
                navbar.classList.remove("text-white");
            } else {
                navbar.classList.remove("bg-white", "shadow", "text-slate-900");
                navbar.classList.add("text-white");
            }

        });
    }

    // FUNCTION OPEN MENU
    function openMobileMenu() {
        if (!mobileMenu || !mobileOverlay) return;

        console.log("HAMBURGER DIKLIK");

        mobileMenu.classList.remove("translate-x-full");
        mobileMenu.classList.add("translate-x-0");

        mobileOverlay.classList.remove("opacity-0", "invisible", "pointer-events-none");
        mobileOverlay.classList.add("opacity-100");

        document.body.classList.add("overflow-hidden");
    }

    // FUNCTION CLOSE MENU
    function closeMobileMenu() {
        if (!mobileMenu || !mobileOverlay) return;

        console.log("MENU DITUTUP");

        mobileMenu.classList.add("translate-x-full");
        mobileMenu.classList.remove("translate-x-0");

        mobileOverlay.classList.add("opacity-0", "invisible", "pointer-events-none");
        mobileOverlay.classList.remove("opacity-100");

        document.body.classList.remove("overflow-hidden");
    }

    // OPEN BUTTON
    if (mobileButton) {
        mobileButton.addEventListener("click", (event) => {
            event.preventDefault();
            event.stopPropagation();

            openMobileMenu();
        });
    }

    // CLOSE BUTTON
    if (closeMenu) {
        closeMenu.addEventListener("click", (event) => {
            event.preventDefault();
            event.stopPropagation();

            closeMobileMenu();
        });
    }

    // CLOSE BY OVERLAY
    if (mobileOverlay) {
        mobileOverlay.addEventListener("click", () => {
            closeMobileMenu();
        });
    }

    // CLOSE AFTER CLICK MENU LINK
    mobileLinks.forEach((link) => {
        link.addEventListener("click", () => {
            closeMobileMenu();
        });
    });

    // CLOSE WITH ESC KEY
    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") {
            closeMobileMenu();
        }
    });

});