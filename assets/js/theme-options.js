
// Theme Options Slider Management from dashboard
jQuery(document).ready(function($) {
    function initMediaUploader() {
        var frame;
        $('.upload_image_button').off('click').on('click', function(e) {
            e.preventDefault();
            var $button = $(this);
            if (frame) {
                frame.open();
                return;
            }
            frame = wp.media({
                title: 'Select Image',
                button: {
                    text: 'Use Image'
                },
                multiple: false
            });
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $button.siblings('.image-url').val(attachment.url);
                $button.siblings('.image-preview').attr('src', attachment.url).show();
            });
            frame.open();
        });
    }

    function initializeFancybox() {
        if ($('[data-fancybox]').length) {
            $('[data-fancybox]').fancybox({
                iframe : {
                    css : {
                        width : '80%',
                        height : '80%'
                    }
                },
                youtube : {
                    controls : 1,
                    showinfo : 1,
                    autoplay : 1
                }
            });
        }
    }

    function initializeSlick() {
        if ($('.image-slider').length) {
            $('.image-slider').slick('unslick'); // Destroy previous instance
            $('.image-slider').slick({
                slidesToShow: 1, // Show 1 slide at a time
                slidesToScroll: 1,
                arrows: true,
                dots: true,
                prevArrow: '<button type="button" class="slick-prev"></button>',
                nextArrow: '<button type="button" class="slick-next"></button>',
                appendDots: '.slider-container', // Place dots inside the slider container
                customPaging: function(slider, i) {
                    return '<button></button>'; // Use button for each dot
                }
            });

            // Ensure text content is removed
            $('.slick-prev').text('');
            $('.slick-next').text('');

            // Manually adjust dots positioning if needed
            $('.slick-dots').css({
                'display': 'flex',
                'justify-content': 'center',
                'position': 'absolute',
                'bottom': '10px',
                'width': '100%'
            });
        }
    }

    $('#add_slider_item_button').on('click', function() {
        var index = $('#slider-repeater-container .slider-repeater-item').length;
        var html = '<div class="slider-repeater-item">';
        html += '<input type="hidden" name="theme_options_settings[slider_repeater][' + index + '][index]" value="' + index + '" />';
        html += '<label>Image</label><input type="hidden" class="image-url" name="theme_options_settings[slider_repeater][' + index + '][image]" value="" /><img src="" class="image-preview" style="max-width: 150px; display: none;" /><button type="button" class="upload_image_button button">Upload Image</button>';
        html += '<label>Title</label><input type="text" name="theme_options_settings[slider_repeater][' + index + '][title]" value="" />';
        html += '<label>Description</label><textarea name="theme_options_settings[slider_repeater][' + index + '][description]"></textarea>';
        html += '<label>Video Link</label><input type="url" name="theme_options_settings[slider_repeater][' + index + '][video]" value="" />';
        html += '<button type="button" class="remove_slider_item_button button">Remove</button></div>';
        $('#slider-repeater-container').append(html);
        initMediaUploader();
        initializeSlick();
    });

    $(document).on('click', '.remove_slider_item_button', function() {
        $(this).closest('.slider-repeater-item').remove();
        initializeSlick();
    });

    // Initial function calls
    initMediaUploader();
    initializeFancybox();
    initializeSlick();
});
