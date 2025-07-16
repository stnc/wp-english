<?php
$CHfw_themeName = 'CHfw-';//for include data
$CHfw_prefix_video = $CHfw_themeName . "videoSetting_";
$CHfw_OptionsPageSettingvideo = array(
	'name' => $CHfw_prefix_video . 'meta-box-page',
	'nonce' => 'st_studio_video',
	'title' => __('Document Info', 'chthemes-video'),
	'page' => 'video',
	//'context' => 'side',
	'context' => 'normal',
	'priority' => 'default',
	'class' => '',
	'style' => '',
	'title_h2' => true,
	'fields' => array(

		array(
			'name' => $CHfw_prefix_video . 'pdf',
			'title' => __('PDF', 'chthemes-video'),
			'type' => 'text',
			'description' => __("pdf file ", 'chthemes-video'),
			'style' => '',
			'class' => '',
			'class_li' => '',
		),
		array(
			'name' => $CHfw_prefix_video . 'quiz',
			'title' => __('Quiz Link', 'chthemes-video'),
			'type' => 'text',
			'description' => __("add quiz link", 'chthemes-video'),
			'style' => '',
			'class' => '',
			'class_li' => '',
		
		),
		// array(
		// 	'name' => $CHfw_prefix_video . 'quiz',
		// 	'title' => __('Quiz Link', 'chthemes-video'),
		// 	'type' => 'select',
		// 	'description' => __("Select gender", 'chthemes-video'),
		// 	'style' => '',
		// 	'class' => '',
		// 	'class_li' => '',
		// 	'options' => array(
		// 		'male' => __('Male', 'chfw-lang'),
		// 		'female' => __('Female', 'chfw-lang'),
		// 	)
		// ),


		// array(
		// 	'name' => $CHfw_prefix_video . 'email',
		// 	'title' => __('Email', 'chthemes-video'),
		// 	'type' => 'text',
		// 	'description' => __("Enter email adress", 'chthemes-video'),
		// 	'style' => '',
		// 	'class' => '',
		// 	'class_li' => '',
		// ),


		// array(
		// 	'name' => 'page_header_type_info',
		// 	'title' => __('Professional Skills', 'chfw-lang'),
		// 	'type' => 'info',
		// 	'description' => '',
		// 	'style' => '',
		// 	'class' => '',
		// 	'class_li' => '',
		// 	'extra' => '',
		// ),

		// array(
		// 	'name' => $CHfw_prefix_video . 'education',
		// 	'title' => __('Education', 'chthemes-video'),
		// 	'type' => 'textarea',
		// 	'description' => '',
		// 	'style' => '',
		// 	'class' => '',
		// 	'class_li' => '',
		// ),


		// array(
		// 	'name' => $CHfw_prefix_video . 'degree',
		// 	'title' => __('Degree', 'chthemes-video'),
		// 	'type' => 'text',
		// 	'description' => '',
		// 	'style' => '',
		// 	'class' => '',
		// 	'class_li' => '',
		// ),


	




	)
);


/*LOCATIONS */

$CHfw_themeName = 'CHfw-';//for include data
$CHfw_prefix_video = $CHfw_themeName . "videoLocation-";
$CHfw_OptionsPageSettingvideoLocaiton = array(
	'name' => $CHfw_prefix_video . 'meta-box-page',
	'nonce' => 'st_studio_video',
	'title' => __('Location Info', 'chthemes-video'),
	'page' => 'locations',
	'context' => 'normal',
	'priority' => 'default',
	'class' => '',
	'style' => '',
	'title_h2' => true,
	'fields' => array(

		array(
			'name' => $CHfw_prefix_video . 'adress',
			'title' => __('Adress', 'chthemes-video'),
			'type' => 'textarea',
			'description' => __("Enter adress info", 'chthemes-video'),
			'style' => '',
			'class' => '',
			'class_li' => '',
		),
		array(
			'name' => $CHfw_prefix_video . 'zipCode',
			'title' => __('Zip Code', 'chthemes-video'),
			'type' => 'text',
			'description' => __("Enter zip code", 'chthemes-video'),
			'style' => '',
			'class' => '',
			'class_li' => '',
		),


		array(
			'name' => $CHfw_prefix_video . 'email',
			'title' => __('Email', 'chthemes-video'),
			'type' => 'text',
			'description' => __("Enter email adress", 'chthemes-video'),
			'style' => '',
			'class' => '',
			'class_li' => '',
		),
		array(
			'name' => $CHfw_prefix_video . 'phone',
			'title' => __('Phone', 'chthemes-video'),
			'type' => 'text',
			'description' => __("Enter phone", 'chthemes-video'),
			'style' => '',
			'class' => '',
			'class_li' => '',
		),

		array(
			'name' => $CHfw_prefix_video . 'website',
			'title' => __('Website', 'chthemes-video'),
			'type' => 'text',
			'description' => __("Enter video member's Google+ profile URL.", 'chthemes-video'),
			'style' => '',
			'class' => '',
			'class_li' => '',
		),

		array(
			'name' => $CHfw_prefix_video . 'latitude',
			'title' => __('Lat,Long', 'chthemes-video'),
			'type' => 'text',
			'description' => __("Enter Latitude and Longitude eq 40.741895,-73.989308 / web site  https://www.gps-coordinates.net/  ", 'chthemes-video'),
			'style' => '',
			'class' => '',
			'class_li' => '',
		),
		
	

		array(
			'name' => $CHfw_prefix_video . 'media',
			'title' => __('Images', 'chfw-lang'),
			'type' => 'media-gallery',
			'description' => __('Select a custom uploaded image.', 'chthemes-video'),
			'style' => 'color:#fff;box-shadow:none;',
			'extra' => '',
			'class_li' => '',
			'class' => '',
		)


	)
);
