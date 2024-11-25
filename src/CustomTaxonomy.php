<?php

namespace YwdCustomContentManager;

abstract class CustomTaxonomy extends SingletonInit
{
    public const TAXONOMY = '';
    public const SLUG = '';

    protected function __construct()
    {
        add_action('admin_footer');
    }

    public static function getFields()
    {
        $labels = [
            'name' => __(static::getPluralName()),
            'singular_name' => __(static::getSingularName()),
            'add_new_item' => __('Ajouter une catégorie'),
            'edit_item' => __('Modifier une catégorie'),
            'search_items' => __('Rechercher une catégorie'),
            'all_items' => __('Tous les catégories'),
            'parent_item' => __('catégorie parente :'),
            'update_item' => __('Mettre à jour la catégorie'),
            'new_item_name' => __('Nom de la nouvelle catégorie'),
            'not_found' => __('Aucune catégorie trouvée.'),
        ];

        return [
            'labels' => $labels,
            'hierarchical' => true,
            'has_archive' => false,
            'public' => true,
            'show_in_rest' => true,
        ];
    }

    public static function register(): void
    {
        if (! function_exists('register_taxonomy')) {
            return;
        }
        register_taxonomy(static::TAXONOMY, static::SLUG, static::getFields());
    }

    abstract public static function getSingularName(): string;

    abstract public static function getPluralName(): string;
}
