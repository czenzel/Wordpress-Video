<?php
header('Content-type: application/json');

require_once(dirname(__FILE__) . '/../../wp-load.php');

$seconds_watched = $_GET['ts'];

$user_logged_in = is_user_logged_in();

if ($user_logged_in) {
	$user_id = get_current_user_id();

	$watched_seconds = get_user_meta($user_id, 'video_seconds_watched', true);

	if (!isset($watched_seconds)) {
		$watched_seconds = 0;
	}

	$watched_seconds += $seconds_watched;

	update_user_meta($user_id, 'video_seconds_watched', $watched_seconds);

	echo json_encode(array('total' => $watched_seconds));
} else {
	echo json_encode(array());
}
?>