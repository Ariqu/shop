document.addEventListener("DOMContentLoaded", function() {
    const navbar = document.getElementById("navbar");
    const navLinks = document.querySelectorAll(".nav-link");

    navbar.style.zIndex = "2";

    const changeNavbarColor = () => {
        if (window.scrollY > 0) {
            navbar.classList.add("bg-black", "text-white");
            navbar.classList.remove("bg-white", "text-black");
            navLinks.forEach(link => {
                link.classList.add("text-white");
                link.classList.remove("text-black");
            });
        } else {
            navbar.classList.add("bg-white", "text-black");
            navbar.classList.remove("bg-black", "text-white");
            navLinks.forEach(link => {
                link.classList.add("text-black");
                link.classList.remove("text-white");
            });
        }
    };

    changeNavbarColor();

    window.addEventListener("scroll", changeNavbarColor);
});
