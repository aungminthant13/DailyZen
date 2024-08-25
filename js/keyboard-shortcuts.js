// document.addEventListener('DOMContentLoaded', function() {
//     console.log("DOM fully loaded and parsed");

//     document.addEventListener('keydown', function(event) {
//         console.log(`Key pressed: ${event.key}, Ctrl pressed: ${event.ctrlKey}`);

//         const key = event.key.toLowerCase(); // Use toLowerCase() for all comparisons

//         if (event.ctrlKey && key === 'h') {
//             event.preventDefault();
//             console.log("Ctrl + H pressed, clicking #greeting");
//             document.getElementById('greeting').click();
//         } else if (event.ctrlKey && key === 'q') {
//             event.preventDefault();
//             console.log("Ctrl + Q pressed, clicking #quote");
//             document.getElementById('quote').click();
//         } else if (event.ctrlKey && key === 't') {
//             event.preventDefault();
//             console.log("Ctrl + T pressed, clicking #ratings");
//             document.getElementById('ratings').click();
//         } else if (event.ctrlKey && key === 'd') {
//             event.preventDefault();
//             console.log("Ctrl + D pressed, clicking #dashboard");
//             document.getElementById('dashboard').click();
//         }
//     });
// });
