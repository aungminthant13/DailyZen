$(document).ready(function () {
    // Show overlay when button is pressed
    $('#home-quote-search-btn').on('click', function () {
        $('.overlay').css('display', 'flex');
    });

    // Close overlay when clicking outside of it
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.overlay-content, #home-quote-search-btn').length) {
            $('#overlay').hide();
        }
    });

    // Prevent closing overlay when clicking inside the overlay content
    $('.overlay-content').on('click', function (e) {
        e.stopPropagation();
    });

    function performSearch() {
        $('#overlay-search-results').html("");
        var keyword = $('#overlay-search-bar').val().toLowerCase(); // Convert the keyword to lowercase
        var matchesFound = false; // Variable to track if any matches are found

        if (keyword) {
            $.getJSON('../data/quotes.json', function (data) {
                items = data.quotes;
                var output = '';

                $.each(items, function (key, value) {
                    var quoteLower = value.quote.toLowerCase(); // Convert quote to lowercase for comparison
                    var authorLower = value.author.toLowerCase(); // Convert author to lowercase for comparison

                    if (quoteLower.includes(keyword) || authorLower.includes(keyword)) {
                        matchesFound = true; // Set to true if a match is found
                        output += '<div>';
                        output += '<p class="overlay-search-result-quote">"' + value.quote + '"</p>';
                        output += '<p class="overlay-search-result-author">' + value.author + '</p>';
                        output += '</div>';
                        output += '<hr>';
                    }
                });

                if (!matchesFound) {
                    output = '<div>No matches found</div>'; // Display "No matches found" if no matches were found
                }

                $('#overlay-search-results').html(output);
            });
        }
    }

    // Trigger search on button click
    $('#overlay-search-btn').click(function () {
        performSearch();
    });

    // Trigger search on pressing Enter key
    $('#overlay-search-bar').keypress(function (e) {
        if (e.which === 13) {  // 13 is the Enter key code
            performSearch();
        }
    });

    // Show overlay when button is pressed
    $('#home-quote-search-btn').on('click', function () {
        $('.overlay').css('display', 'flex');
    });

    // Close overlay when clicking outside of it
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.overlay-content, #home-quote-search-btn').length) {
            $('#overlay').hide();

            // Clear search input and results when overlay is hidden
            $('#overlay-search-bar').val(''); // Clear search input
            $('#overlay-search-results').html(''); // Clear search results
        }
    });

    // Prevent closing overlay when clicking inside the overlay content
    $('.overlay-content').on('click', function (e) {
        e.stopPropagation();
    });
});