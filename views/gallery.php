<html>
    <head>
        <title>Upload Photo</title>
    </head>
    <body>
<?php	
		echo"<h1>Upload your photo</h1>";
		echo Form::open('/gallery/upload/', array('enctype'=>'multipart/form-data')); 
		
		echo "<p>Choose file:</p>";
		echo Form::file('vImage');
		
		echo Form::submit('submit', 'Upload');
		echo Form::close(); 
		
		if ( IsSet($photo) )
		{
			echo Html::image($photo);
		}
?>		
    </body>
</html>
