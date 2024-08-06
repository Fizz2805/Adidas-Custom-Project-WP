

//SIDEBAR EVENTS Widget PREV AND NEXT BUTTON AJAX 

jQuery(document).ready(function($) {
    var currentOffset = 0; // Initialize offset

    function loadEvents(offset) {
        $.ajax({
            url: ajaxobject.ajaxurl,  // Use the localized variable
            type: 'POST',
            data: {
                action: 'load_events',
                offset: offset
            },
            success: function(response) {
                $('#events-widget .events-content').html(response);
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });
    }

    // Load initial events
    loadEvents(currentOffset);

    $('.next-events').click(function() {
        currentOffset += 3; // Increment offset by 3
        loadEvents(currentOffset);
    });

    $('.prev-events').click(function() {
        if (currentOffset > 0) { // Ensure offset is not negative
            currentOffset -= 3; // Decrement offset by 3
            loadEvents(currentOffset);
        }
    });
});
