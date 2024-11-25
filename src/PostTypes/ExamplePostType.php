<?php

namespace YwdCustomContentManager\PostTypes;

use Extended\ACF\Fields\Text;
use YwdCustomContentManager\CustomPostType;
use YwdCustomContentManager\Taxonomies\ExampleTaxonomy;

class ExamplePostType extends CustomPostType
{
    public const SLUG = 'example';

    public const TAXONOMIES = [
        ExampleTaxonomy::TAXONOMY,
    ];

    public static function getSingularName(): string
    {
        return __('Example');
    }

    public static function getPluralName(): string
    {
        return __('Examples');
    }

    public static function getACFFields(): array
    {
        return [
            Text::make(__('Description'), 'description'),
        ];
    }

    public static function getOptionsACFFields()
    {
        return [
            Text::make(__('Title'), 'title'),
        ];
    }

    protected static function hasOptions()
    {
        return true;
    }
}
