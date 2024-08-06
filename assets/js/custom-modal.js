
// To add youtube popup upon clicking

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.video-icon').forEach(function(element) {
        element.addEventListener('click', function(e) {
            e.preventDefault();
            var videoUrl = this.getAttribute('href');
            document.getElementById('youtube-video').src = videoUrl;
            document.getElementById('video-modal').style.display = 'block';
        });
    });

    document.querySelector('.close').addEventListener('click', function() {
        document.getElementById('video-modal').style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target == document.getElementById('video-modal')) {
            document.getElementById('video-modal').style.display = 'none';
        }
    });
});
