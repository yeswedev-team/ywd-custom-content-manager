<?php

namespace YwdCustomContentManager\Taxonomies;

use YwdCustomContentManager\CustomTaxonomy;

class ExampleTaxonomy extends CustomTaxonomy
{
    public const SLUG = 'example';
    public const TAXONOMY = 'example-category';

    public static function getSingularName(): string
    {
        return __('Category');
    }

    public static function getPluralName(): string
    {
        return __('Categories');
    }
}
