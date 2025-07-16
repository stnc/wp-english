<?php
namespace Helix\Api\Wordpress\Pages;

use Helix\Api\Wordpress\Pages\PostDate;
use Helix\Api\Wordpress\Pages\AuthorDetails;
use Helix\Api\Wordpress\Pages\FeaturedImage;

class Pages {

    /**
    * Construct Function
    * @since 2.0.0
    */
    public function __construct() {
        $this->init();
    }

    /**
    * Init Function
    * @since 2.0.0
    */
    public function init() {
        new FeaturedImage();
        new AuthorDetails();
        new PostDate();
    }

}