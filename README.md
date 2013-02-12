WordPress Theme Customizer Boilerplate
=================================================

Theme Customizer Boiler plate you can use in your themes. For detailed explanation, check [WP Explorer][1].

Copy entire `/customizer` directory into your theme's directory and include `customizer.php` from your theme's `functions.php`:

    require( get_stylesheet_directory() . '/customizer-boilerplate/customizer.php' );

Then you can change contents of `$options` array in [`options.php`][2] file and use whatever fields you need.

@slobodanmanic

  [1]: http://www.wpexplorer.com/theme-customizer-boilerplate/
  [2]: customizer-boilerplate/options.php#L28
