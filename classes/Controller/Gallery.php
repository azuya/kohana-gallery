<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Gallery extends Controller {

	public function action_index()
	{ 		
		echo View::factory('gallery')->render();
	}
	
	public function action_upload()
	{		
		$input = 'vImage';
		$photo = Gallery::add($input, 'yes', NULL);

		echo View::factory('gallery')->bind('photo', $photo->image['thumb_filename'])->render();
	}

}
