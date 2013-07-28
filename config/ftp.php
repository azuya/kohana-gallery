<?php defined('SYSPATH') or die('No direct access allowed.');

return array
(
	'default' => array
	(
		/**
		 * The following options are available for FTP:
		 *
		 * string	host		server hostname
		 * string	username	server username
		 * string	password	server password
		 * int		port     	server port
		 * boolean	passive		use passive connections?
		 * string	docroot		server path to your doman directory example: '/public_html/domain.com' (with first slash '/' and without last slash '/' )
		 * string	docdir		path to your upload directory example: 'data/upload/' (without first slash / )
		 */
		'host'		=> 'hostname',					// change this
		'user'		=> 'usename',  					// change this
		'password'	=> 'password', 					// change this
		'port'		=> 21,
		'passive'	=> TRUE,
		'ssh'		=> FALSE,
		'timeout'	=> 90,
		'docroot'	=> '/public_html/domain.com', 	// change this
		'docdir'	=> 'data/uploads', 				// change this
	),
);
