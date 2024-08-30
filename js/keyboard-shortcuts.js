document.addEventListener('DOMContentLoaded', function () {
    console.log("DOM fully loaded and parsed");

    document.addEventListener('keydown', function (event) {
        console.log(`Key pressed: ${event.key}, Ctrl pressed: ${event.ctrlKey}, Shift pressed: ${event.shiftKey}`);

        const key = event.key.toLowerCase(); // Use toLowerCase() for all comparisons

        if (event.ctrlKey && key === 'h') {
            event.preventDefault();
            console.log("Ctrl + H pressed, clicking #nav-greeting");
            document.getElementById('nav-greeting').click();
        } else if (event.ctrlKey && key === 'q') {
            event.preventDefault();
            console.log("Ctrl + Q pressed, clicking #nav-quote");
            document.getElementById('nav-quote').click();
        } else if (event.ctrlKey && key === 't') {
            event.preventDefault();
            console.log("Ctrl + T pressed, clicking #nav-ratings");
            document.getElementById('nav-ratings').click();
        } else if (event.ctrlKey && key === 'd') {
            event.preventDefault();
            console.log("Ctrl + D pressed, clicking #nav-dashboard");
            document.getElementById('nav-dashboard').click();
        } else if (event.ctrlKey && event.key === 'ArrowRight') {
            event.preventDefault();
            console.log("Ctrl + ArrowRight pressed, clicking .next-quote-btn");
            document.querySelectorAll('.next-quote-btn').forEach(function (btn) {
                btn.click();
            });
        } else if (event.ctrlKey && event.key === 'ArrowLeft') {
            event.preventDefault();
            console.log("Ctrl + ArrowLeft pressed, clicking .previous-quote-btn");
            document.querySelectorAll('.previous-quote-btn').forEach(function (btn) {
                btn.click();
            });
        } 
    });
});
