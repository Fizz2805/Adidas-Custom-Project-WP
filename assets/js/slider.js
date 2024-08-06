jQuery(document).ready(function($) {
    var currentIndex = 0;
    var itemsPerPage = 4;
    var totalItems = $('.slider-item').length;
    var totalPages = Math.ceil(totalItems / itemsPerPage);

    function updateSlider() {
        var offset = -(currentIndex * 100 / totalPages) + '%';
        $('.slider-wrapper').css('transform', 'translateX(' + offset + ')');
    }

    $('.slider-next').click(function() {
        if (currentIndex < totalPages - 1) {
            currentIndex++;
            updateSlider();
        }
    });

    $('.slider-prev').click(function() {
        if (currentIndex > 0) {
            currentIndex--;
            updateSlider();
        }
    });

    // Set the wrapper width to accommodate all items
    $('.slider-wrapper').css('width', (totalItems * 25) + '%');

    updateSlider();
});
