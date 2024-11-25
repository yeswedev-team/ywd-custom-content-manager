<?php

/**
 * Plugin Name:  YesWeDev Custom Content Manager
 * Description:  Define and register Custom Post Types, Blocks, and their ACF fields
 * Version:      1.0.0
 * Author:       YesWeDev
 */

if (! file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}

require dirname(__FILE__) . '/vendor/autoload.php';

use YwdCustomContentManager\PostTypes\ExamplePostType;
use YwdCustomContentManager\Taxonomies\ExampleTaxonomy;

function registerCustomTaxonomies()
{
    // List all your taxonomies here
    $taxonomies = [
        ExampleTaxonomy::class,
    ];

    add_action('init', static function () use ($taxonomies): void {
        foreach ($taxonomies as $taxonomy) {
            $taxonomy::register();
        }
    }, 10);
}

function registerCustomPostTypes()
{
    // List all your custom post types here
    $postTypes = [
        ExamplePostType::class,
    ];

    add_action('init', static function () use ($postTypes): void {
        foreach ($postTypes as $postType) {
            $postType::register();
            $postType::getInstance();
        }
    }, 10);
}

registerCustomTaxonomies();
registerCustomPostTypes();
