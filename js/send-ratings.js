$(document).ready(function () {
    // Handle form submission for adding ratings
    $('form[action="../api/addRatings.php"]').on('submit', function (event) {
        event.preventDefault(); // Prevent the form from submitting normally

        // Retrieve the values of the selected radio buttons
        var happiness = $('input[name="happiness"]:checked').val();
        var workload = $('input[name="workload"]:checked').val();
        var anxiety = $('input[name="anxiety"]:checked').val();

        // Post the data to addRatings.php
        $.post('../api/addRatings.php', {
            happiness: happiness,
            workload: workload,
            anxiety: anxiety
        }, function (response) {
            // Handle the response from the server
            var data = JSON.parse(response);
            if (data.status === "success") {
                location.reload();
                alert("Ratings added/updated successfully!");
            } else {
                // Display an error message
                alert("Error: " + data.message);
            }
        });
    });

    // Reset the form if the user presses the cancel-rating button
    $('#cancel-rating').on('click', function (event) {
        event.preventDefault(); // Prevent the default button behavior
        $('form[action="../api/addRatings.php"]')[0].reset(); // Reset the form to its initial state
    });
});
