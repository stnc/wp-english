<?php
namespace Helix\Api\Wordpress\Posts;

use Helix\Api\Wordpress\Posts\PostDate;
use Helix\Api\Wordpress\Posts\PostTerms;
use Helix\Api\Wordpress\Posts\AuthorDetails;
use Helix\Api\Wordpress\Posts\FeaturedImage;

class Posts {

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
        new PostTerms();
    }

}