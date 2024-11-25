# YesWeDev Custom Content Manager

**Version:** 1.0.0
**Author:** YesWeDev

## Description

The **YesWeDev Custom Content Manager** plugin provides a foundation for creating and managing **Custom Post Types**, **Taxonomies**, and their associated **ACF fields** in WordPress. It includes examples to quickly set up a new Custom Post Type or Taxonomy with minimal effort, and supports adding custom options pages using ACF.

---

## Features

- **Custom Post Types**: Define and register custom post types.
- **Custom Taxonomies**: Create and associate taxonomies with custom post types.
- **ACF Integration**: Add custom fields to post types and taxonomies using the [Advanced Custom Fields (ACF)](https://www.advancedcustomfields.com/) plugin.
- **Options Pages**: Create options pages for custom post types.

---

## Installation

1. **Plugins Dependencies**: You will need the following plugins : advanced-custom-fields-pro, acf-cpt-options-page and vinkla/extended-acf.
2. **Composer Dependencies**: Run `composer install` to ensure all necessary dependencies are installed.
3. **Upload**: Place the plugin folder in the `plugins` directory of your WordPress installation.
4. **Activate**: Activate the plugin from the WordPress admin dashboard under **Plugins**.

---

## File Structure

### Main Plugin File
- **`ywd-custom-content-manager.php`**: Entry point for the plugin. Handles the registration of post types and taxonomies.

### Core Classes
- **`SingletonInit.php`**: Abstract class implementing the singleton pattern for reusable components.
- **`CustomTaxonomy.php`**: Abstract class for defining reusable taxonomy functionality.
- **`CustomPostType.php`**: Abstract class for defining reusable post type functionality.

### Examples
- **`src/PostTypes/ExamplePostType.php`**: Example of a custom post type named "Example".
- **`src/Taxonomies/ExampleTaxonomy.php`**: Example of a taxonomy named "Example Category" associated with the "Example" post type.

---

## Usage

### 1. Adding a Custom Post Type
To add a custom post type:
1. Create a new class in the `PostTypes` directory, extending `CustomPostType`.
2. Define constants like `SLUG`, `TAXONOMIES`, and override methods such as `getSingularName()`, `getPluralName()`, and `getACFFields()`.

### 2. Adding a Custom Taxonomy
To add a custom taxonomy:
1. Create a new class in the `Taxonomies` directory, extending `CustomTaxonomy`.
2. Define constants like `TAXONOMY` and `SLUG`, and override methods such as `getSingularName()` and `getPluralName()`.

### 3. Associating Taxonomies with Post Types
To associate a taxonomy with a custom post type, define the taxonomy in the `TAXONOMIES` constant of the post type class.

---

## Extending Functionality

### ACF Fields
- Fields can be added to both post types and taxonomies using ACF's field registration. Use the `getACFFields()` method in the custom post type or taxonomy class to define the fields.

### Options Pages
- To enable an options page for a post type, override the `hasOptions()` method to return `true` and define the fields with `getOptionsACFFields()`.

---

## Dependencies

- **WordPress**
- **Composer**
- **Advanced Custom Fields (ACF)**: plugin
- **ACF CPT Options Pages**: plugin
- **Extend ACF**: composer package
