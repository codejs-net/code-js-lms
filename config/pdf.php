<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'orientation'          	=> 'P',
	'author'                => '',
	'subject'               => 'LMS',
	'keywords'              => '',
	'creator'               => 'Code-js',
	'display_mode'          => 'fullpage',
	'margin_header'        	=> 0,
	'margin_footer'        	=> 0,
	'tempDir'               => base_path('../temp/'),
	'font_path' => base_path('resources/fonts/'),
	'font_data' => [
		'abhayalibre' => [
			'R'  => 'abhayalibreregular.ttf',
			'B'  => 'abhayalibrebold.ttf',
			'useOTL' 	=> 0xFF,
			'useKashida' => 75,
		],
		'iskpota' => [
			'R'  => 'iskpota.ttf',
			'B'  => 'iskpotab.ttf',
			'useOTL' 	=> 0xFF,
			'useKashida' => 75,
		],
		'nirmala' => [
			'R'  => 'nirmala.ttf',
			'B'  => 'nirmala.ttf',
		],
		// ...add as many as you want.
	]
];
