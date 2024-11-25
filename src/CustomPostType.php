<?php

namespace YwdCustomContentManager;

abstract class CustomPostType extends SingletonInit
{
    public const SLUG = '';
    public const SUPPORTS = ['title'];
    public const REWRITE_SLUG = self::SLUG;
    public const TAXONOMIES = [];
    public const MENU_POSITION = 2;

    protected function __construct()
    {
        add_action('admin_footer', [$this, 'enforceRequiredTitle']);
    }

    public static function getWPFields()
    {
        return [
            'supports' => static::SUPPORTS,
            'show_in_rest' => true,
            'label' => __(static::getPluralName(), 'textdomain'),
            'description' => __('', 'textdomain'),
            'names' => [
                'slug' => static::SLUG,
                'singular' => static::getSingularName(),
                'plural' => static::getPluralName(),
            ],
            'labels' => [
                'name' => _x(static::getPluralName(), 'Post Type General Name', 'textdomain'),
                'singular_name' => _x(static::getSingularName(), 'Post Type Singular Name', 'textdomain'),
                'menu_name' => _x(static::getPluralName(), 'Admin Menu text', 'textdomain'),
                'name_admin_bar' => _x(static::getPluralName(), 'Add New on Toolbar', 'textdomain'),
                'attributes' => __('Landing page attributes', 'textdomain'),
                'all_items' => __('All the ' . static::getPluralName(), 'textdomain'),
                'add_new_item' => __('Add a new ' . static::getSingularName(), 'textdomain'),
                'add_new' => __('Add', 'textdomain'),
                'new_item' => __('New ' . static::getSingularName(), 'textdomain'),
                'edit_item' => __('Edit the ' . static::getSingularName(), 'textdomain'),
                'update_item' => __('Update the  ' . static::getSingularName(), 'textdomain'),
                'view_item' => __('See the ' . static::getSingularName(), 'textdomain'),
                'view_items' => __('See all ' . static::getPluralName(), 'textdomain'),
                'search_items' => __('Search in ' . static::getSingularName(), 'textdomain'),
                'not_found' => __('No ' . static::getSingularName() . ' found.', 'textdomain'),
                'not_found_in_trash' => __('No ' . static::getSingularName() . ' found in the trash.', 'textdomain'),
                'items_list' => __(static::getPluralName() . 'list', 'textdomain'),
                'items_list_navigation' => __('Navigation of ' . static::getPluralName() . 'list', 'textdomain'),
                'filter_items_list' => __('Filter ' . static::getPluralName() . 'list', 'textdomain'),
            ],
            'menu_icon' => static::getMenuIcon(),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => static::MENU_POSITION,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => static::hasArchive(),
            'has_single' => static::hasSingle(),
            'hierarchical' => false,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'capability_type' => 'post',
            'rewrite' => static::getRewriteOptions(),
            'taxonomies' => static::TAXONOMIES,
        ];
    }

    abstract public static function getSingularName(): string;

    abstract public static function getPluralName(): string;

    abstract public static function getACFFields(): array;

    public static function register(): void
    {
        if (! function_exists('register_post_type')) {
            return;
        }
        register_post_type(static::SLUG, static::getWPFields());

        static::registerACFFields();

        if (static::hasOptions()) {
            static::registerOptions();
            static::registerOptionsACFFields();
        }
    }

    public static function registerOptions(): void
    {
        if (! function_exists('acf_add_options_page')) {
            return;
        }

        acf_add_options_sub_page([
            'page_title' => __(static::getSingularName() . ' options'),
            'menu_title' => __(static::getSingularName() . ' options'),
            'parent_slug' => 'edit.php?post_type=' . static::SLUG,
        ]);
    }

    public static function registerACFFields(): void
    {
        if (! function_exists('register_extended_field_group')) {
            return;
        }

        register_extended_field_group([
            'title' => static::getSingularName(),
            'location' => [
                \Extended\ACF\Location::where('post_type', static::SLUG),
            ],
            'fields' => static::getACFFields(),
        ]);
    }

    public static function registerOptionsACFFields(): void
    {
        if (! function_exists('register_extended_field_group')) {
            return;
        }

        register_extended_field_group([
            'title' => static::getPluralName() . ' Options',
            'location' => [
                \Extended\ACF\Location::where('options_page', 'acf-options-' . static::SLUG . '-options'),
            ],
            'fields' => static::getOptionsACFFields(),
        ]);
    }

    public static function getOptionsACFFields()
    {
        return [];
    }

    public function enforceRequiredTitle(): void
    {
        global $pagenow, $typenow;
        if (is_admin() && ($pagenow === 'post-new.php' || $pagenow === 'post.php') && $typenow === static::SLUG) {
?>
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    $('#post').submit(function(e) {
                        if ($('#title').val().trim() === '') {
                            e.preventDefault();
                            alert('The title is mandatory');
                            $('#title').focus();
                        }
                    });
                });
            </script>
<?php
        }
    }

    protected static function getMenuIcon()
    {
        return 'dashicons-book';
    }

    protected static function getRewriteOptions()
    {
        return [
            'slug' => static::REWRITE_SLUG,
            'with_front' => false,
        ];
    }

    protected static function hasArchive()
    {
        return false;
    }

    protected static function hasSingle()
    {
        return false;
    }

    protected static function hasOptions()
    {
        return false;
    }
}
