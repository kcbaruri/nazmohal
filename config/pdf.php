<?php

return [
	'mode'                 => '',
	'format'               => 'A4',
	'default_font_size'    => '12',
	'default_font'         => 'sans-serif',
	'margin_left'          => 10,
	'margin_right'         => 10,
	'margin_top'           => 10,
	'margin_bottom'        => 10,
	'margin_header'        => 0,
	'margin_footer'        => 0,
	'orientation'          => 'P',
	'title'                => 'Laravel mPDF',
	'author'               => '',
	'watermark'            => '',
	'show_watermark'       => false,
	'watermark_font'       => 'Kalpurush',
	'display_mode'         => 'fullpage',
	'watermark_text_alpha' => 0.1,
	'custom_font_dir'      => '',
	'custom_font_data' 	   => [],
	'auto_language_detection'  => false,
	'temp_dir'               => rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR),
	'pdfa' 			=> false,
	'pdfaauto' 		=> false,
	'custom_font_dir' => base_path('resources/fonts/'), // don't forget the trailing slash!
	'custom_font_data' => [
	'examplefont' => [
	'R'  => 'kalpurush.ttf',
	'useOTL' => 0xFF,   
	'useKashida' => 75, 
	]
		// ...add as many as you want.
	]
];
