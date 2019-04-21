<?php

/**
 * Return a unique url tag for each user
 * to use in feed id
 */
if (!function_exists('users_tag_uri')) {

	function users_tag_uri($user)
	{
		$parsed = parse_url(route('user_info_path',[$user->id]));

		$output[] = 'tag:';
		$output[] = $parsed['host'] . ",";
		$output[] = $user->created_at->format('Y-m-d') . ":";
		$output[] = $parsed['path'];

		return implode('',$output);
	}
}

