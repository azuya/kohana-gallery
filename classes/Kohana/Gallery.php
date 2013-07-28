<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Database object creation helper methods.
 *
 * @package    Kohana/Gallery
 * @category   Network
 * @author     Rafał Osiński ( rafalosinski.com ) 
 * @copyright  (c) 2013 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Kohana_Gallery {
	
	// Image Extension Allowed
	public $_extlimit = array
	(
		'gif', 'jpg', 'png', 'jpeg', 'bmp'
	);
	
	public function __construct()
	{
		if ( ! extension_loaded('ftp') ) {
			throw new Kohana_Exception("PHP extension FTP is not loaded.");
		}		
		
		if ( ! extension_loaded('gd') ) {
			throw new Kohana_Exception("PHP extension GD is not loaded.");
		}		
		
		if( ! Arr::get(Kohana::modules(), 'image') )
		{
			throw new Kohana_Exception("KohanaPHP image module is not loaded.");
		}
		
	}
	
	public static function random( $ext )
	{
		$file->image['name'] = strtolower(crc32(Text::random('alnum', 20))) . '.' . $ext;
		return $file;
	}
	
	public static function change( $name, $ext )
	{	
		$getExt 				= explode ('.', $name);
		$file->image['name'] 	= $getExt[0] . '_' .strtolower(Text::random('alnum', 5)) . '.' . $ext;	
		return $file;
	}
	
	public function extension( $file_name )
	{
		$file = new Gallery;
		
		$ext 		= strrchr($file_name,'.');
		$ext 		= strtolower($ext);

		$getExt 	= explode ('.', $file_name);
		$ext 		= $getExt[count($getExt)-1];
		
		$file->_check( $ext );		
		$file->image['ext'] = $ext;
		
		return $file;
	}
	
	public function _check( $ext )
	{		
		if ( !in_array($ext,$this->_extlimit) ) { 
			throw new Kohana_Exception( "Uploading file is not image" );
			exit();
		}		
	}
	
	public static function add($input, $is_thumb, $galleryID = NULL)
	{			
		$file 		= new Gallery;
		$ftp 		= Kohana::$config->load('ftp')->get('default');
		$gallery 	= Kohana::$config->load('gallery')->get('default');				
		
		$file_type = $_FILES[$input]['type'];
		$file_name = $_FILES[$input]['name'];
		$file_size = $_FILES[$input]['size'];
		$file_tmp  = $_FILES[$input]['tmp_name'];
		
		$dir = $ftp['docroot'] . '/' . $ftp['docdir'];
		
		
		if ( $file_type && $file_name && $file_size && $file_tmp ) 
		{
			$file->extension = $file->extension($file_name)->image['ext'];

			if ( $gallery['img_name'] === 'random' ) 
			{							
				$file_name = $file->random($file->extension)->image['name'];
			}	 
			
			$check 		= DOCROOT . $ftp['docdir'] . '/' . $file_name;						
			$is_exists 	= file_exists($check);
			
			if ( $is_exists && $gallery['img_name'] === 'random') 
			{
				$file_name = $file->random($file->extension)->image['name'];
			} 
			 elseif ( $is_exists )
			{
				$file_name = $file->change($file_name, $file->extension)->image['name'];
			}
			
			$big_filename = $dir . '/' . $file_name;
			Ftp::instance()->upload( $file_tmp, $big_filename, $gallery['img_chmod'] );
			
			if ( $is_thumb === 'yes' ) 
			{ 
				$thumb_filename = $dir . '/' . $gallery['thumb_name'] . $file_name;
				$thumb = Image::factory ( DOCROOT . $ftp['docdir'] . '/' . $file_name );					
				$thumb->resize( $gallery['thumb_width'], NULL )->save( DOCROOT . $ftp['docdir'] . '/' . $gallery['thumb_name'] . $file_name, $gallery['img_quality'] );
				Ftp::instance()->chmod( $thumb_filename, $gallery['img_chmod'] );
			}		
			
			if ( $gallery['img_resize'] === 'yes' )
			{
				$img = Image::factory (DOCROOT . $ftp['docdir'] . '/' . $file_name );	
				$img->resize( $gallery['img_width'], NULL )->save( DOCROOT . $ftp['docdir'] . '/' . $file_name, $gallery['img_quality'] );
				Ftp::instance()->chmod( $big_filename, $gallery['img_chmod'] );
			} 		
			
			if ( $gallery['database'] == 'yes' ) 
			{
				$insert 		= ORM::factory('Gallery');
				$insert->parent	= $galleryID;
				$insert->name	= $file_name;
				$insert->url	= $file_name;
				$insert->save();
			}
			
			$photo->image['thumb_filename'] = $ftp['docdir'] . '/' . $gallery['thumb_name'] . $file_name;
			$photo->image['img_filename'] 	= $ftp['docdir'] . '/' . $file_name;
			return $photo;
		} 
		 else 
		{
			throw new Kohana_Exception("Empty image. Select any image.");	
		}
	}	
}	
