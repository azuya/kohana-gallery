<?php defined('SYSPATH') or die('No direct access allowed.');

return array
(
	'default' => array
	(
		/**
		 * The following options are available for Gallery:
		 *
		 * string	img_name		'random' OR 'standard'
		 * int		img_width		image width in px 
		 * int		img_heigh		image height in px 
		 * int		thumb_width     thumb width in px 
		 * int		thumb_height	thumb height in px 
		 * string	thumb_name		thumb prefix or directory example: 'thumb_' (same directory but other name) OR 'thumb/' (same name but in subdirectory)
		 * int		img_quality		image compression in percent example: 99
		 * string	img_chmod		image and thumb ftp chmod. example: 0644
		 * string	img_resize		resize big image to => img_width <= and/or => img_height <= type: 'yes' OR if you want save oryginal size type: 'no'
		 * string	database		if 'yes' then add photo to database, if 'no' it just upload photo
		 * 
		 */
		'database'		=> 'yes',
		'img_name'		=> 'random',
		'img_width'		=> '1024',
		'img_heigh'		=> '1024',
		'thumb_width'	=> '250',
		'thumb_height'	=> '250',
		'thumb_name'	=> 'thumb_',
		'img_resize'	=> 'yes',
		'img_quality'	=> 99,
		'img_chmod'		=> 0644,				
	),
);
