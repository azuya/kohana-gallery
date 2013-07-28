# Simple image uploader via FTP #
----------------

For KohanaPHP Framework 3.3 

- Upload Image
- Change Image Permission
- Change Image Name (random) or Select Original
- Create Image Thumb with your width and height configuration
- Add Image to Database
- Configuration via config/gallery OR database


Included, modification and validated for Kohana 3.3 FTP module by Eduardo Pacheco https://github.com/kanema/kohana-ftp


----------------
# Examples: (this is controller where $_POST action is going) #

<blockquote>
	<div>	$input = 'vImage';</div>
	<div>	$photo = new Gallery;</div>
	<div>	$photo = $photo->add($input, 'yes', NULL);</div>
</blockquote>

<br />

$input → Name of file input<br />
$photo->image['thumb_filename'] → Result full thumb path
$photo->image['img_filename'] → Result full big image path

