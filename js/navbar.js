window.onscroll = function () {
    myFunction();
};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky");
    } else {
        navbar.classList.remove("sticky");
    }
}

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        const targetID = this.getAttribute('href');
        const targetElement = document.querySelector(targetID);
        const navbarHeight = document.getElementById('navbar').offsetHeight;

        window.scrollTo({
            top: targetElement.offsetTop - navbarHeight,
            behavior: 'smooth'
        });
    });
});