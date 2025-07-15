<?php
$StncBabOneEng_themeName = 'StncBabOneEng-';//for include data
 $StncBabOneEng_prefix_video = $StncBabOneEng_themeName . "meta_";

// <![CDATA[CHfw-videoSetting_pdf]]>
// <![CDATA[StncBabOneEng-meta_pdf]]>


// <![CDATA[CHfw-videoSetting_quiz]]>
// <![CDATA[StncBabOneEng-meta_quiz]]>


$StncBabOneEng_OptionsPageSettingvideo = array(
	'name' => $StncBabOneEng_prefix_video . 'meta-box-page',
	'nonce' => 'st_studio_video',
	'title' => __('Document Info', 'chthemes-video'),
	'page' => 'stnc-babOne-Eng',// Admin page (or post type)
	//'context' => 'side',
	'context' => 'normal',
	'priority' => 'default',
	'class' => '',
	'style' => '',
	'title_h2' => true,
	'fields' => array(

		array(
			'name' => $StncBabOneEng_prefix_video . 'pdf',
			'title' => __('PDF', 'chthemes-video'),
			'type' => 'text',
			'description' => __("pdf file ", 'chthemes-video'),
			'style' => '',
			'class' => '',
			'class_li' => '',
		),
		array(
			'name' => $StncBabOneEng_prefix_video . 'quiz',
			'title' => __('Quiz Link', 'chthemes-video'),
			'type' => 'text',
			'description' => __("add quiz link", 'chthemes-video'),
			'style' => '',
			'class' => '',
			'class_li' => '',
		
		),
		// array(
		// 	'name' => $StncBabOneEng_prefix_video . 'quiz',
		// 	'title' => __('Quiz Link', 'chthemes-video'),
		// 	'type' => 'select',
		// 	'description' => __("Select gender", 'chthemes-video'),
		// 	'style' => '',
		// 	'class' => '',
		// 	'class_li' => '',
		// 	'options' => array(
		// 		'male' => __('Male', 'StncBabOneEng-lang'),
		// 		'female' => __('Female', 'StncBabOneEng-lang'),
		// 	)
		// ),


		// array(
		// 	'name' => $StncBabOneEng_prefix_video . 'email',
		// 	'title' => __('Email', 'chthemes-video'),
		// 	'type' => 'text',
		// 	'description' => __("Enter email adress", 'chthemes-video'),
		// 	'style' => '',
		// 	'class' => '',
		// 	'class_li' => '',
		// ),


		// array(
		// 	'name' => 'page_header_type_info',
		// 	'title' => __('Professional Skills', 'StncBabOneEng-lang'),
		// 	'type' => 'info',
		// 	'description' => '',
		// 	'style' => '',
		// 	'class' => '',
		// 	'class_li' => '',
		// 	'extra' => '',
		// ),

		// array(
		// 	'name' => $StncBabOneEng_prefix_video . 'education',
		// 	'title' => __('Education', 'chthemes-video'),
		// 	'type' => 'textarea',
		// 	'description' => '',
		// 	'style' => '',
		// 	'class' => '',
		// 	'class_li' => '',
		// ),


		// array(
		// 	'name' => $StncBabOneEng_prefix_video . 'degree',
		// 	'title' => __('Degree', 'chthemes-video'),
		// 	'type' => 'text',
		// 	'description' => '',
		// 	'style' => '',
		// 	'class' => '',
		// 	'class_li' => '',
		// ),


	




	)
);


