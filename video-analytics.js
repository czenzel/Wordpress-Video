/*
 HTML 5 Video Tracker for Wordpress
 */

// Keep this at 10 seconds to prevent
// server overload

var wp_video_timer = 10;

$(document).ready(function() {
	$.ajax({
		url: '/wp-content/video/video-watched.php',
		success: function(result) {
			var htmlData = result.html;
			$('.w-video-watched').html(htmlData);
		}
	});

	$(document).arrive('video', function() {
		var videoTimer = 0;
		var videoPlayLength = 0;

		var video_src = $(this).attr('src');

		$(this).on('play', function() {
			videoTimer = setInterval(function() {
				videoPlayLength += wp_video_timer;
				console.log('User watched a video for ' + videoPlayLength + ' seconds for ' + video_src);
				if (videoPlayLength > 0) {
					$.ajax({
						url: '/wp-content/video/video-seconds.php?ts=' + wp_video_timer,
						success: function(result) {
						}
					});
				}
			}, 1000 * wp_video_timer);
		});

		$(this).on('pause', function() {
			clearInterval(videoTimer);
		});

		$(this).on('ended', function() {
			clearInterval(videoTimer);
		});
	});
});
