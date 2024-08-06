<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wpBrigade_challenge
 */

get_header();
?>

<main id="primary" class="site-main">

<?php
            $options = get_option('theme_options_settings');
            $slider_items = isset($options['slider_repeater']) ? $options['slider_repeater'] : array();
            if (!empty($slider_items)): 
?>

<!-- /********** Embedding Youtube Link for pop up **********/ -->
<?php
function get_youtube_embed_url($url) {
    parse_str(parse_url($url, PHP_URL_QUERY), $query);
    return isset($query['v']) ? 'https://www.youtube.com/embed/' . $query['v'] : '';
}
?>
<div class="slider-container">
    <div class="image-slider">
        <?php foreach ($slider_items as $item): ?>
            <div class="slider-item">
                <img src="<?php echo esc_url($item['image']); ?>" alt="<?php echo esc_attr($item['title']); ?>" />
                <div class="slider-content">
                    <h2><?php echo esc_html($item['title']); ?></h2>
                    <p><?php echo esc_html($item['description']); ?></p>
                    <?php if (!empty($item['video'])): ?>
                        <a href="<?php echo esc_url(get_youtube_embed_url($item['video'])); ?>" class="video-icon" data-fancybox>▶</a>
                        <!-- <a href="<php echo esc_url($item['video']); ?>" class="video-icon" data-fancybox data-type="iframe">▶</a> -->
                        <!-- <a href="<php echo esc_url($item['video']); ?>" class="video-icon" target="_blank">▶</a> -->
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
	<!-- <div class="custom-dots"></div> Custom pagination -->
</div>

<!-- <div class="main-container" style="background-image: url('<php echo get_the_post_thumbnail_url() ? esc_url(get_the_post_thumbnail_url()) : get_template_directory_uri() . "/assets/images/pettern-3.png"; ?>');"> -->
<div class="main-container" style="background-image: url('<?php echo get_template_directory_uri() . "/assets/images/pettern-2.png"; ?>');">







<div class="content-area">
        
    <div class="posts">


    
    <div class="custom-slider">
    <div class="slider-containers">
        <div class="slider-wrapper">
            <?php
            $args = array(
                'post_type' => 'slider',
                'posts_per_page' => -1,
            );
            $slider_query = new WP_Query($args);

            if ($slider_query->have_posts()) :
                while ($slider_query->have_posts()) : $slider_query->the_post();
                    ?>
                    <div class="slider-item">
                         <!-- <div class="bg-style"> -->
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                            <h3><?php the_title(); ?></h3>
                        </a>
                         <!-- </div>  -->
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
            <!-- Custom Separator -->
<div class="custom-separator"></div>

<!-- sticky post start -->
<?php
$random_post = get_random_sticky_post();

if ($random_post) :
?>
    <div class="custom-sticky-post-container">
        <div class="custom-sticky-post">
            <?php if (has_post_thumbnail($random_post->ID)) : ?>
                <div class="custom-sticky-post-thumbnail">
                    <?php echo get_the_post_thumbnail($random_post->ID, 'full'); ?>
                </div>
            <?php endif; ?>
            <div class="custom-sticky-post-details">
                <h2 class="custom-sticky-post-title"><?php echo esc_html($random_post->post_title); ?></h2>
                <div class="custom-sticky-post-content">
                    <?php echo wpautop($random_post->post_excerpt); ?>
                </div>
            </div>
        </div>
    </div>
   <?php endif; ?>
<!-- sticky post end -->









    </div> <!-- slider-containers div -->
    <button class="slider-prev"></button>
    <button class="slider-next"></button>

</div>    <!-- custom-sliderdiv -->
<!-- sticky post start -->
<!-- <php
$random_post = get_random_sticky_post();

if ($random_post) :
?>
    <div class="custom-sticky-post-container">
        <div class="custom-sticky-post">
            <php if (has_post_thumbnail($random_post->ID)) : ?>
                <div class="custom-sticky-post-thumbnail">
                    <php echo get_the_post_thumbnail($random_post->ID, 'full'); ?>
                </div>
            <php endif; ?>
            <h2 class="custom-sticky-post-title"><php echo esc_html($random_post->post_title); ?></h2>
            <div class="custom-sticky-post-content">
                <php echo wpautop($random_post->post_content); ?>
            </div>
        </div>
    </div>
<php endif; ?> -->
<!-- sticky post end -->

<!-- recent post start -->
<?php
// Fetch the 3 most recent posts
$recent_posts = new WP_Query([
    'posts_per_page' => 3,
    'post_status' => 'publish',
    'ignore_sticky_posts' => 1, // Ignore sticky posts
]);

if ($recent_posts->have_posts()) : ?>
    <div class="recent-posts-container" >
        <?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
            <div class="single-post" style="background-image: url('<?php echo get_template_directory_uri() . "/assets/images/pettern-1.png"; ?>');" >
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); // Change 'medium' to any size you need ?>
                        </a>
                    </div>
                <?php endif; ?>
                <div class="post-content">
                    <div class="post-title">
                        <h2><?php the_title(); ?></h2>
                    </div>
                    <div class="post-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <div class="read-more" style="background-image: url('<?php echo get_template_directory_uri() . "/assets/images/pettern-3.png"; ?>');">
                   
                        <a href="<?php the_permalink(); ?>">READ MORE</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>
<!-- recent post end -->


<!-- New container for two additional divs -->
<div class="additional-content-container">
<div class="additional-item">
    <h3>Latest Tweets</h3>
    <div class="additional-div">
        <!-- Twitter Timeline Embed using a tag -->
         <div class="twitter-page">
        <a class="twitter-timeline" data-width="" data-height="400" href="https://twitter.com/adidas?ref_src=twsrc%5Etfw">Tweets by adidas</a>

                </div>
        <!-- Content for the first additional div -->
        <!-- <p>This is some additional content.</p> -->
    </div>

    <!-- Include Twitter Widgets Script -->
    <!-- <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> -->

      <!-- Ensure Twitter Widgets Load -->
      <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof twttr !== 'undefined' && twttr.widgets) {
                twttr.widgets.load();
            }
        });
    </script>
</div>


    <div class="additional-item">
        <h3>Facebook Page</h3>
        <div class="additional-div">
            <!-- Content for the second additional div -->
            <div class="fb-page" data-href="https://www.facebook.com/facebook" data-tabs="timeline" data-width="" data-height="400" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                <blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore">
                    <a href="https://www.facebook.com/facebook">Facebook</a>
                </blockquote>
            </div>
        </div>
    </div>
</div>







            <!-- Your posts will go here -->
        </div> <!-- post div -->




        <!-- sidebar -->
    <!-- sidebar -->
    <div class="sidebar" style="background-image: url('<?php echo get_template_directory_uri() . "/assets/images/pettern-2.png"; ?>');">
    <?php if (!is_active_sidebar('sidebar-1')) {
        return;
    }
    ?>

    <?php
    // echo 'Debug: Entering sidebar.php';
    if (is_active_sidebar('sidebar-1')) :
    ?>
        <aside id="secondary" class="widget-area widget-title">
            <?php
            // echo 'Debug: Before dynamic_sidebar';
            dynamic_sidebar('sidebar-1');
            // echo 'Debug: After dynamic_sidebar';
            ?>
        </aside>
    <?php endif; ?>
</div>


<!-- sidebar end hhere -->

    </div> <!-- content area div -->

<!-- sticky post -->

<!-- TAB START -->

<div id="match-tabs" style="padding: 0; background-image: url('<?php echo get_template_directory_uri() . "/assets/images/pettern-1.png"; ?>');">
<ul class="nav nav-tabs" style=" padding: 20px; background-image: url('<?php echo get_template_directory_uri() . "/assets/images/pettern-3.png"; ?>');">
        <li class="nav-item">
            <a class="nav-link active" data-tab="match-info" href="#">Match Info</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-tab="match-results" href="#">Match Results</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-tab="match-schedule" href="#">Match Schedule</a>
        </li>
    </ul>

    <div class="tab-content" style="margin-top: 20px; color: #fff;">
        <div id="match-info" class="tab-pane active" style=" padding: 20px;">
            <?php echo nl2br(esc_html(get_option('theme_tab_content_settings')['match_info_content'])); ?>
        </div>
        <div id="match-results" class="tab-pane" style=" padding: 20px; display: none;">
            <?php echo nl2br(esc_html(get_option('theme_tab_content_settings')['match_results_content'])); ?>
        </div>
        <div id="match-schedule" class="tab-pane" style=" padding: 20px; display: none;">
            <?php echo nl2br(esc_html(get_option('theme_tab_content_settings')['match_schedule_content'])); ?>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    $('.nav-tabs a').click(function(e) {
        e.preventDefault();
        var targetTab = $(this).data('tab');

        $('.nav-tabs a').removeClass('active');
        $(this).addClass('active');

        $('.tab-pane').hide();
        $('#' + targetTab).show();
    });
});
</script>

<style>
    .nav-tabs .nav-link {
        margin-right: 0;
    }
</style>



<!-- TAB END -->






</div> <!-- main container div -->











<style>

 /* .widget-area {
    padding: 15px;
    background: rgba(255, 255, 255, 0.8); 
    border-radius: 5px; 
}

.widget {
    margin-bottom: 20px; 
} */

#block-4 h2 {
    /* font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #fff; */
    display: none;

}   


.category-widget-wrapper {
    background-color: #f5f5f5; /* Set your desired background color */
    border: 1px solid #ddd; /* Optional: Add a border */
    padding: 20px; /* Adjust padding as needed */
    margin-bottom: 20px; /* Space below the widget */
    position: relative; /* Required for positioning the arrow */
}

.category-widget-label {
    font-size: 18px;
    font-weight: bold;
    color: #333; /* Set the color of the label text */
    margin-bottom: 10px; /* Space between the label and the widget */
    position: absolute; /* Position the label at the top */
    top: 0;
    left: 20px; /* Adjust to align label */
    background-color: #fff; /* Optional: Background color for the label */
    padding: 5px 10px; /* Adjust padding as needed */
    border-radius: 5px; /* Optional: Rounded corners for the label */
}

.category-widget-wrapper .widget {
    padding-top: 30px; /* Add padding to make space for the label */
}

.widget .category-list {
    list-style: none; /* Remove default bullets */
    padding: 0;
    margin: 0;
}

.widget .category-list li {
    position: relative; /* Required for positioning the arrow */
    padding-left: 30px; /* Space for the arrow */
    margin-bottom: 10px; /* Space between list items */
}

.widget .category-list li::before {
    content: '\f054'; /* Font Awesome right arrow icon */
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    color: #333; /* Set the color of the arrow */
}


/* Hide widget titles */
/* .widget-title {
    display: none;
}

#secondary .widget-title {
    display: none;
} */

/* Hide widget titles */



/* Tab navigation styles */
#match-tabs {
    padding: 0;
    background-image: url('<?php echo get_template_directory_uri() . "/assets/images/pettern-1.png"; ?>');
    height: 400px; /* Set the desired fixed height */
    display: flex;
    flex-direction: column;
}


.nav-tabs {
    list-style: none;
    padding: 0;
    margin:0;
    display: flex;
    /* border-bottom: 1px solid #ddd; */
}

.nav-tabs .nav-item {
    margin-right: 5px;
    left:0;
}

.nav-tabs .nav-link {
    /* display: block; */
    /* to stretch tabs */
    padding: 22px 30px; 
    /* border: 1px solid transparent; */
    /* border-radius: 3px; */
    /* background-color: #007bff; */
    color: #fff;
    text-decoration: none;
}

.nav-tabs .nav-link.active {
    /* background-color: #fff;
    border-color: #fff; */

    background-color: #0a7c37; 
	   clip-path: polygon(10% 0%, 100% 0%, 90% 100%, 0% 100%);
	  z-index: -1; 

}

/* .nav-tabs .nav-link:hover {
    background-color: #0056b3;
    border-color: #0056b3;
    color: #fff;
} */

.nav-tabs .nav-link:hover{
      background-color: #0a7c37; 
	   clip-path: polygon(10% 0%, 100% 0%, 90% 100%, 0% 100%);
	  z-index: -1; 
}

/* tabs styling finish */

.tweets-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.tweet {
    background-color: #fff;
    padding: 10px;
    border: 1px solid #ddd;
    width: calc(33.333% - 20px); /* Adjust the width as needed */
    box-sizing: border-box;
}

.tweet-image img {
    width: 100%;
    height: auto;
}

.tweet-content {
    margin-top: 10px;
}

.tweet-text {
    font-size: 1em;
    color: #333;
}



/* .tweets-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.tweet {
    background-color: #fff;
    padding: 10px;
    border: 1px solid #ddd;
    width: calc(33.333% - 20px); 
    box-sizing: border-box;
}

.tweet-image img {
    width: 100%;
    height: auto;
}

.tweet-content {
    margin-top: 10px;
}

.tweet-text {
    font-size: 1em;
    color: #333;
} */







/* Additional content styling */
.additional-content-container {
    display: flex;
    gap: 20px;
    margin-top: 40px; /* Adjust as needed to create space between recent posts and additional content */
}

.additional-item {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: flex-start; /* Align items to the start of the flex container */
}

.additional-item h3{
    color: #fff;
    
}

.additional-div {
    background-color: #fff; /* Set the background color */
    padding: 20px;
    
    width: 100%; /* Ensure it takes full width of the container */
    box-sizing: border-box;
    border-radius: 10px; /* Add rounded corners */
}

.fb-page {
  width: 100%; /* Ensures it fits within the .additional-div */
  height: 400px; /* Adjust this height as needed */
  background-color: #fff; /* Optional background color */
  padding: 10px; /* Optional padding */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Optional shadow */
  box-sizing: border-box; /* Ensures padding and border are included in the width and height */
  overflow: hidden; /* Ensures content doesn't overflow */
}

.twitter-page{
    width: 100%; /* Ensures it fits within the .additional-div */
  height: 400px; /* Adjust this height as needed */
  background-color: #fff; /* Optional background color */
  padding: 10px; /* Optional padding */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Optional shadow */
  box-sizing: border-box; /* Ensures padding and border are included in the width and height */
  overflow: hidden; /* Ensures content doesn't overflow */
}


/********** Styling for slider **********/

/* sticky post styling start */
.custom-sticky-post-container {
    /* Add your container styling here */
    margin: 20px 0;
}

.custom-sticky-post {
    /* Add your sticky post styling here */
    display: flex;
    align-items: flex-start; /* Align items to the start */
    /* border: 1px solid #ddd; */
    padding: 15px;
    background-color: #0a432b;
    font-family: 'Poppins', sans-serif; /* Apply Poppins font to the entire post */
}

.custom-sticky-post-thumbnail {
    /* Add your thumbnail container styling here */
    margin-right: 20px; /* Increased margin for more space */
    flex-shrink: 0; /* Prevent the image from shrinking */
}

.custom-sticky-post-thumbnail img {
    /* Ensure the thumbnail is large */
    max-width: 400px; /* Adjust width as needed */
    height: auto;
    display: block;
}

.custom-sticky-post-details {
    flex: 1;
}

.custom-sticky-post-title {
    font-size: 1.5em; /* Larger font size */
    margin-bottom: 10px;
    font-family: 'Poppins', sans-serif; /* Apply Poppins font */
    color: #fff;
    font-weight: 400;
}

.custom-sticky-post-content {
    font-size: 1em;
    font-family: 'Poppins', sans-serif; /* Apply Poppins font */
    color: #fff;
}
/* sticky post styling end */


/* 
.custom-sticky-post-container {
  
    margin: 20px 0;
}

.custom-sticky-post {
  
    display: flex;
    border: 1px solid #ddd;
    padding: 15px;
    background-color: #f9f9f9;
}

.custom-sticky-post-thumbnail {
    
    margin-right: 15px;
}

.custom-sticky-post-thumbnail img {
    
    max-width: 200px; 
    height: 200;
    display: block;
}

.custom-sticky-post-details {
    flex: 1;
}

.custom-sticky-post-title {
    font-size: 1.5em;
    margin-bottom: 10px;
}

.custom-sticky-post-content {
    font-size: 1em;
} */





/* .custom-sticky-post-container {
  
    margin: 20px 0;
}

.custom-sticky-post {
  
    border: 1px solid #ddd;
    padding: 15px;
    background-color: #f9f9f9;
}

.custom-sticky-post-thumbnail img {
   
    max-width: 100%;
    height: auto;
    display: block;
}

.custom-sticky-post-title {
    font-size: 1.5em;
    margin-bottom: 10px;
}

.custom-sticky-post-content {
    font-size: 1em;
} */


    .slider-container {
            width: 100%;
            height: 400px; /* Set your desired height */
            /* overflow: hidden; Hide any content that overflows the container */
            position: relative;
            overflow: hidden;
            background-position: center center;
            background-size: cover;
            background-repeat: no-repeat; 
        }
    .image-slider {
        width: 100%;
        height: 100%;

    }
    /* .slider-item {
        position: relative;
        width: 100%;
        height: 100%;
    }  */
    .slider-item img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensure the image covers the container without distortion */
		display: block; /* Removes any extra space below the image */
        
    }
  

    /********** Styling for slider container **********/
.slider-content {
    position: absolute;
    top: 120px;
    left: 150px;
    right:150px;
    padding: 40px;
    color: #fff;
    background: rgba(0, 0, 0, 0.5); /* Optional: to make the text stand out */
    padding: 10px;
    border-radius: 5px; /* Optional: Add rounded corners */
    z-index: 1; /* Ensure the content is above the image */
    max-width: 90%; /* Ensure the content does not exceed container width */
    box-sizing: border-box; /* Include padding and border in the element's total width and height */
    
}
.slider-item {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0; /* Remove internal padding */
    margin: 0; /* Remove external margin */
}
/* blog 3 styling help*/

.slider-item a {
    display: block;
    text-align: center;

    background-image: url('/wp-content/themes/wpbrigade-challenge/assets/images/pettern-2.png');

    background-size: cover; /* Ensure the image covers the entire container */
    background-position: center; /* Center the image */
    background-repeat: no-repeat; /* Prevent the image from repeating */
    /* border-radius: 8px; */
     padding: 1px; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 150px; 
    box-sizing: border-box; /* Include padding and border in the width/height */
    /* height: 200px; if want to fix height of each post */
    color: #fff; /* Text color */
    
} 

/* .slider-item a {
    
    text-align: center;
    background-color: #f8f9fa; 
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    
    width: 100%; 
    max-width: 200px; 
    height: 200px; 
    margin-bottom: 10px;
    
}  */

.bg-style a{


}


.video-icon {
    display: inline-block;
    background: rgba(0, 0, 0, 0.7);
    color: #fff;
    padding: 15px;
    border-radius: 50%;
    font-size: 24px;
    text-decoration: none;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    transition: background 0.3s;
    z-index: 2; /* Ensure the video icon is above the text */
}

.slider-content p {
    margin: 0; /* Remove default margin */
    font-size: 16px; /* Adjust font size as needed */
    line-height: 1.5; /* Adjust line height for spacing */
    max-width: 80%; /* Adjust width as needed to control line breaks */
    text-align: left; /* Center-align text */
    word-wrap: break-word; /* Ensure long words break properly */
    overflow-wrap: break-word; /* Ensure long words break properly */
}

.video-icon:hover {
    background: rgba(0, 0, 0, 0.9);
}



/********** Styling for prev and next icons **********/
	.slick-prev, .slick-next {
    font-size: 24px;
    color: #ffffff; /* Arrow color */
    /* background-color: rgba(0, 0, 0, 0.5); Arrow background */
    border: none; 
    /* border-radius: 50%; */
	background-color: transparent; /* Transparent background */
    width: 40px;
    height: 40px;
    z-index: 1;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    align-items: center;
    justify-content: center;
    text-indent: -9999px; /* Hide default text content */
	cursor: pointer; /* Optional: add a pointer cursor */
}

.slick-prev {
    left: 80px; /* Adjust as needed */
}

.slick-next {
    right: 80px; /* Adjust as needed */
}

.slick-prev::before, .slick-next::before {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
	text-indent: 0; /* Ensure icon is visible */
    /* content: ""; */
}

.slick-prev::before {
    content: "\f053" !important; /* Font Awesome left arrow */
}

.slick-next::before {
    content: "\f054" !important; /* Font Awesome right arrow */
}


/* Alternatively, hide all controls and keep only dots */
/* .slick-slide-control {
    display: none !important;
} */
button[id^="slick-slide-control"] {
    display: none !important;
}

/* .custom-dots {
    position: absolute;
    bottom: 10px; 
    width: 100%;
    text-align: center;
    display: flex !important;
    justify-content: center;
}

.custom-dots span {
    display: inline-block !important;
    width: 10px !important; /
    height: 2px !important; 
    background-color: #fff !important; 
    margin: 0 2px !important; 
    opacity: 0.5 !important; 
    transition: opacity 0.3s !important;
}

.custom-dots span.active {
    opacity: 1 !important; 
} */

/* to display dots */
.slick-dots {
    display: block !important; 
}

.slick-dots {
    bottom: 2px; 
    text-align: center;
    width: 100%;
    position: absolute;
	display: flex;
	margin-left:50px !important;
	 margin-top: 5px; 
	 color: #000000 !important;
	 justify-content: center !important;
	 /* list-style: none; Remove default list styling */
	
}
.slick-dots ul li {
	
    display: inline-block !important; /* Display dots inline */
    margin: 0 4px; /* Adjust spacing between dots */
}

/* main area */
/* Container for the whole layout */
 .main-container {
    width: 100%;
    padding: 20px; /* Adjust padding as needed */
    box-sizing: border-box; /* Ensure padding and border are included in the total width */
}


.content-area {
    display: flex; /* Use flexbox to align items horizontally */
    gap: 20px; /* Space between the content and sidebar */
 
} 

/* Posts area */
.posts {
    flex: 3; /* Takes up more space, adjust as needed */
    /* background-color: #f9f9f9; Background color for the posts area */
    padding: 20px; /* Padding inside the posts area */
    box-sizing: border-box; Ensure padding is included in the width
}

/* Sidebar area */
.sidebar {
    flex: 1; /* Takes up less space, adjust as needed */
    background-color: #e0e0e0; /* Background color for the sidebar */
    padding: 20px; /* Padding inside the sidebar */
    box-sizing: border-box; /* Ensure padding is included in the width */
}

/* Optional: Add responsiveness */
@media (max-width: 768px) {
    .content-area {
        flex-direction: column; /* Stack posts and sidebar vertically on smaller screens */
    }
}




    </style>
    <script>
    jQuery(document).ready(function($) {
        $('.image-slider').slick({
            // Your Slick slider settings
            dots: true,
            arrows: true,
            autoplay: true,
            autoplaySpeed: 5000
        });
    });
    </script>
<?php endif; ?>


		<!-- <php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><php single_post_title(); ?></h1>
				</header>
				<php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?> -->

	</main>

<?php

// echo 'Debug: Before sidebar inclusion';
// get_sidebar();
// echo 'Debug: After sidebar inclusion';
//  get_sidebar();
get_footer();
