<?php
header('Content-type: application/json');

require_once(dirname(__FILE__) . '/../../wp-load.php');

$user_logged_in = is_user_logged_in();

if ($user_logged_in) {
	$user_id = get_current_user_id();

	$watched_seconds = get_user_meta($user_id, 'video_seconds_watched', true);

	if (!isset($watched_seconds)) {
		$watched_seconds = 0;
	}

	$watched_minutes = round($watched_seconds / 60, 1);
	$use_s = '';

	if ($watched_minutes > 1) {
		$use_s = 's';
	}

	$html_data = '<p>You have watched about <strong>' . $watched_minutes . ' minute' . $use_s . '</strong> of video content on my site.</p>';

	echo json_encode(array('html' => $html_data));
} else {
	$html_data = '<p>Please login to track the amount of videos you have watched.</p>';

	echo json_encode(array('html' => $html_data));
}
?>