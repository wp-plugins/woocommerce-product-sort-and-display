=== WooCommerce Product Sort and Display ===

Contributors: a3rev, A3 Revolution Software Development team, nguyencongtuan
Tags: WooCommerce, WooCommerce Shop Page, WooCommerce Products, WooCommerce Product Display, WooCommerce Product sort.
Requires at least: 4.0
Tested up to: 4.3
Stable tag: 1.3.5
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Create a true Supermarket shopping experience. Sort and show products on Shop page by category - auto show On Sale or Featured first, Endless Scroll.

== Description ==

Walk into any shop, Supermarket or Department store and what do you see - products organized and grouped in aisle and areas. 'Walk' into any WooCommerce store page and what does your customer / client see - an almost entirely random display of products sorted mostly by date of publishing.

That has always seemed crazy to us. What shop owner would just keep stacking new stock at the front of all the other stock in their shop in any order. None is the answer! So why is that exactly what all of our virtual WooCommerce stores do?

We decided to build a plugin that would fix that. With WooCommerce Product Sort and Display installed you can:

* Sort products to show by category on shop page.
* Sort category order on shop page by drag and drop.
* Set the number of products to show per category on the shop page with link to view all.
* If Parent Category has no products attached to it - will show products from the Parents Child Categories.
* Set to auto show all current 'On Sale' products first in each category on the shop page.
* Set to auto show all 'featured' products in each category on the shop page.
* Intelligent Navigation shows customers the total number of products in the category they are viewing with a link to view all.
* Endless Scroll feature (option) for seamless customer scrolling through the entire shop page makes for quick and very easy shop browsing.

= Shop Page Display Features =

* Show products by Category group.
* Use WooCommerce Product Categories to sort display order by drag and drop.
* Set the number of products to show per category.
* Set which products show first from the category - On Sale, Featured of the default latest.
* Set how many category group of products show before pagination or endless scroll loads.
* Activate Endless scroll feature for your shop page.
* Select Auto Endless Scroll or Scroll on Click.

= 2 Brand New Product Sort Features =

* Auto show any 'On Sale' products first in the Category View on shop page.
* Auto show any 'featured' products first in the category view.

= Intelligent Browsing =

* Show the current number of products being viewed and total products in Category.
* 'No more product to view' message when all products are showing.

= Endless Scroll Features =

* Enable/Disable Endless Scroll on Shop Page
* Set number of Product category groups to show per endless scroll.
* Options of auto scroll or scroll on click.

= Shop Page Product Category Group Visual Separator =

* Enable/Disable a visual separator between each Product Category group of products.
* WYSIWYG separator style editor.
* Set padding in px above and below the separator.


= Live Shop Demo =

Visit [Dixie Sourenirs](http://dixiesouvenirs.com/shop-here/) to see how the plugin allows you to set up your Shop page product display on a live store. Thanks to the site owner Colin Slark for permission to link to his shop page.

= Mobile Responsive App style admin interface =

* a3 Plugin framework
* Feature mobile first admin interface
* Open and closing admin setting boxes give excellent admin UX
* Admin can set Open and Closed setting box display behaviour when open a tab

= Premium Version =

The Premium version of this plugin is for those who want Sort and Display applied to their stores Product Category and Product Tag pages. It has ALL the features of this Free version - Apply Sort and Display to the shop page - plus these advanced features:

* Apply Sort and display to the entire store - Product Category and Product Tags pages
* Show Sub Categories with products on their Parent Category page.
* Set the number of products to show in parent and each child category
* Set Parent Cat to show no products - just show Child cats and products.
* If parent Category has no products because all products are in the child categories set to show child cats with products
* Custom Sort Featured and On Sale is added to WooCommerce Sort features for Category and Tags pages
* Endless Scroll feature for Product Category and Product tag pages
* Apply all settings globally from the admin dashboard with individual setting on each category e.g. Sort type, number of products to show 

The Premium version is a once only payment Lifetime License plugin (not annual subscription). View details here on the [a3rev.com](http://a3rev.com/shop/woocommerce-product-sort-and-display/) site

= Localization =

* English (default) - always included.
*.po file (wc_psad.po) in languages folder for translations.
* If you do a translation for your site please send it to us for inclusion in the plugin language folder. We'll acknowledge your work here. [Go here](http://a3rev.com/contact-us-page/) to send your translation files to us.

= Plugin Resources =

[Premium Version](http://a3rev.com/shop/woocommerce-product-sort-and-display/) |
[Documentation](http://docs.a3rev.com/user-guides/plugins-extensions/woocommerce/product-sort-and-display/) |
[Lite Version Support](http://wordpress.org/support/plugin/woocommerce-product-sort-and-display/)


== Installation ==

= Minimum Requirements =

* WordPress 4.0
* WooCommerce 2.1 and later.
* PHP version 5.2.4 or greater
* MySQL version 5.1 or greater

= Automatic installation =

Automatic installation is the easiest option as WordPress handles the file transfers itself and you don't even need to leave your web browser. To do an automatic install of WooCommerce Product Sort and Display, log in to your WordPress admin panel, navigate to the Plugins menu and click Add New. Search WooCommerce Product Sort and Display. Click install.

= Manual installation =

The manual installation method involves downloading our plugin and uploading it to your web server via your favourite FTP application.

1. Download the plugin zip file from WordPress to your computer and unzip it
2. Using an FTP program, or your hosting control panel, upload the unzipped plugin folder to your WordPress installations wp-content/plugins/ directory.
3. Activate the plugin from the Plugins menu within the WordPress admin.


== Screenshots ==

1. Show products by category on the WooCommerce Shop page.
2. Use new Sort types to show your most important products where they should be - first up
3. If your theme does not support endless scroll - activate the plugins Endless Scroll feature.


== Usage ==

1. Install and activate the plugin

2. On wp-admin click on WooCommerce > Sort & Display

3. Settings Tab - Turn Endless Scroll on for your shop page.

4. Endless Scroll - active on Shop Page.

5. Go to Products > Categories and use drop and drag to sort the categories in the order you want them to display.

6. Enjoy endlessly tweaking your stores product layout.


== Frequently Asked Questions ==

= When can I use this plugin? =

On any WordPress install that has the WooCommerce plugin installed and activated.


== Changelog ==

= 1.3.5 - 2015/08/20 =
* Tweak - include new CSSMin lib from https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port into plugin framework instead of old CSSMin lib from http://code.google.com/p/cssmin/ , to avoid conflict with plugins or themes that have CSSMin lib
* Tweak - make __construct() function for 'Compile_Less_Sass' class instead of using a method with the same name as the class for compatibility on WP 4.3 and is deprecated on PHP4
* Tweak - change class name from 'lessc' to 'a3_lessc' so that it does not conflict with plugins or themes that have another Lessc lib
* Tweak - Plugin Framework DB query optimization. Refactored settings_get_option call for dynamic style elements, example typography, border, border_styles, border_corner, box_shadow
* Tweak - Tested for full compatibility with WooCommerce Version 2.4.4
* Tweak - Tested for full compatibility with WordPress major version 4.3.0
* Fix - Make __construct() function for 'WC_PSAD' class instead of using a method with the same name as the class for compatibility on WP 4.3 and is deprecated on PHP4
* Fix - Update the plugin framework for setup correct default settings on first installed
* Fix - Update the plugin framework for reset to correct default settings when hit on 'Reset Settings' button on each settings tab

= 1.3.4 - 2015/07/30 =
* Tweak - Removed all Premium Version settings boxes from that admin panels
* Tweak - Removed all Premium Version settings boxes from Product Category create and edit pages
* Tweak - Removed Pro Version setting boxes description from the Plugin Framework setting box
* Tweak - Added Premium Version feature description to bottom of a3 framework setting box with SHOW | HIDE switch
* Tweak - Updated the images in admin panel sidebar
* Tweak - Tested for full compatibility with WooCommerce version 2.3.13
* Tweak - Tested for full compatibility with WordPress version 4.2.3
* Fix - Updated orderby = meta_value_num to meta_value_num date to ensure when Featured or On Sale sort is used that other products in the category show in resent order after the Feature or On Sale products.

= 1.3.3 - 2015/07/21 =
* Tweak - Defined new trigger for when items are loaded by endless scroll

= 1.3.2 - 2015/07/07 =
* Tweak - Add DB queries cached for WordPress roles for compatibility with sites that have pre-set product views based on user roles
* Tweak - Shortened cached names when appended with role name it does not exceed the 45 characters for cached name. See reference here http://codex.wordpress.org/Function_Reference/set_transient

= 1.3.1 - 2015/07/04 =
* Tweak - Hook 'dont_show_categories_on_shop' into 'woocommerce_product_subcategories_args' tag for not show subcategories on Shop page
* Tweak - Hook 'dont_show_product_on_shop' into 'woocommerce_before_shop_loop' with priority 41 for not show products on Shop page
* Fix - Shop page showing Products above categories when Sort and Display is activated

= 1.3.0 - 2015/07/03 =
* Feature - Major performance upgrade with optimized database queries and in plugin caching
* Feature - Add new DB Query Cache settings box with option to switch caching ON | OFF and manual clear cache
* Feature - Add caching for shop page product categories and products queries
* Tweak - Hook to filter 'woocommerce_product_subcategories_args' tag to remove duplicate the queries to database
* Tweak - Check and just called queries from Shop page in Responsi Framework

= 1.2.1 - 2015/06/17 =
* Tweak - Check if a3_admin_ui_script_params is defined to save status of settings box
* Tweak - Added call 'admin_localize_printed_scripts' on setting panel page to avoid conflicts with other plugins built on a3 Plugin framework

= 1.2.0 - 2015/06/16 =
* Feature - Plugin framework Mobile First focus upgrade
* Feature - Massive improvement in admin UI and UX in PC, tablet and mobile browsers
* Feature - Introducing opening and closing Setting Boxes on admin panels.
* Feature - Added Plugin Framework Customization settings. Control how the admin panel settings show when editing.
* Feature - New interface has allowed us to do away with the 5 sub menus on the admin panel
* Feature - Includes a script to automatically combine sub category tables into the Tabs main table when upgrading
* Feature - Added Option to set Google Fonts API key to directly access latest fonts and font updates from Google
* Feature - Pro Version setting boxes have a green background colour and are sorted to the bottom of each admin panel
* Feature - Added full support for Right to Left RTL layout on plugins admin dashboard.
* Feature - Added a 260px wide images to the right sidebar for support forum link, Documentation links.
* Tweak - Updated a lot of admin panel Description and Help text
* Tweak - Tested for full compatibility with WooCommerce Version 2.3.11
* Fix - Check 'request_filesystem_credentials' function, if it does not exists then require the core php lib file from WP where it is defined

= 1.1.8 - 2015/06/04 =
* Tweak - Tested for full compatibility with WooCommerce Version 2.3.10
* Tweak - Security Hardening. Removed all php file_put_contents functions in the plugin framework and replace with the WP_Filesystem API
* Tweak - Security Hardening. Removed all php file_get_contents functions in the plugin framework and replace with the WP_Filesystem API

= 1.1.7 - 2015/05/30 =
* Tweak - Tested for full compatibility with WordPress Version 4.2.2
* Tweak - Tested and Tweaked for full compatibility with WooCommerce Version 2.3.9
* Tweak - Changed Permission 777 to 755 for style folder inside the uploads folder
* Tweak - Chmod 644 for dynamic style and .less files from uploads folder
* Fix - Update url of dynamic stylesheet in uploads folder to the format //domain.com/ so it's always is correct when loaded as http or https
* Fix - Sass compile path not saving on windows xampp

= 1.1.6 - 2015/04/23 =
* Fix - Move the output of <code>add_query_arg()</code> into <code>esc_url()</code> function to fix the XSS vulnerability identified in WordPress 4.1.2 security upgrade

= 1.1.5 - 2015/04/21 =
* Tweak - Tested and Tweaked for full compatibility with WordPress Version 4.2.0
* Tweak - Tested and Tweaked for full compatibility with WooCommerce Version 2.3.8
* Tweak - Update style of plugin framework. Removed the [data-icon] selector to prevent conflict with other plugins that have font awesome icons

= 1.1.4 - 2015/03/19 =
* Tweak - Tested and Tweaked for full compatibility with WooCommerce Version 2.3.7
* Tweak - Tested and Tweaked for full compatibility with WordPress Version 4.1.1

= 1.1.3 - 2015/02/13 =
* Tweak - Maintenance update for full compatibility with WooCommerce major version release 2.3.0 with backward compatibility to WC 2.2.0
* Tweak - Tested fully compatible with WooCommerce just released version 2.3.3
* Tweak - Changed WP_CONTENT_DIR to WP_PLUGIN_DIR. When an admin sets a custom WordPress file structure then it can get the correct path of plugin

= 1.1.2 - 2014/12/24 =
* Tweak - Added support for product card image lazy load when [a3 Lazy Load plugin](https://wordpress.org/plugins/a3-lazy-load/) is installed.
* Tweak - Updated plugin to be 100% compatible with WooCommerce Version 2.2.10
* Tweak - Tested 100% compatible with WordPress Version 4.1
* Tweak - Added link to a3 Lazy Load and a3 Portfolio plugins on admin dashboard yellow sidebar.
* Fix - Infinite scroll bug on URLs that end with -#

= 1.1.1 - 2014/09/12 =
* Tweak - Tested 100% compatible with WooCommerce 2.2.2
* Tweak - Tested 100% compatible with WordPress Version 4.0
* Tweak - Added WordPress plugin icon
* Fix - Changed __DIR__ to dirname( __FILE__ ) for Sass script so that on some server __DIR___ is not defined

= 1.1.0 - 2014/09/04 =
* Feature - Converted all front end CSS #dynamic {stylesheets} to Sass #dynamic {stylesheets} for faster loading.
* Feature - Convert all back end CSS to Sass.
* Tweak - Tested 100% compatible with WooCommerce Version 2.2 and backwards to version 2.1
* Tweak - use wc_get_product() function instead of get_product() function when site is using WooCommerce Version 2.2
* Tweak - Updated google font face in plugin framework.

= 1.0.5.3 - 2014/07/18 =
* Tweak - Update to Product Category create and edit page Sort and display settings in line with Pro version new features for synch.
* Tweak - On Product category create and edit pages One Level Up Display settings now always show even when Sort and display features are OFF.

= 1.0.5.2 - 2014/07/16 =
* Tweak - Added ON | OFF button for Sort and Display Pro Version feature activation on product category pages
* Tweak - On Product category create and edit pages set switch to OFF to hide Pro settings for better UI.

= 1.0.5.1 - 2014/07/03 =
* Tweak - Updated plugins description and dashboard text for details about plugin upgrade version.
* Tweak - Checked for full compatibility with WooCommerce Version 2.1.12

= 1.0.5 - 2014/06/26 =
* Feature - When Parent Category has no products on Shop page, set to show products from the Parents Child Cats.
* Feature - Added Empty Parent Categories feature ON | OFF switch for Shop Page.
* Tweak - Updated admin pages help text links to WooCommerce admin panel which have changed in recent updates.
* Tweak - Updated chosen js script to latest version 1.1.0 on the a3rev Plugin Framework
* Tweak - Tested 100% compatible with WooCommerce version 2.1.11
* Fix - Pagination link breaking. Added str_replace( 'page/'.$page , '', pagination_link ); to trip page/[number]

= 1.0.4.3 - 2014/05/29 =
* Tweak - Updated the plugins wordpress.org description.
* Tweak - Updated the plugins admin panel yellow sidebar text.

= 1.0.4.2 - 2014/05/28 =
* Tweak - Added remove_all_filters('mce_external_plugins'); before call to wp_editor to remove extension scripts from other plugins.
* Tweak - Updated Framework help text font for consistency.
* Tweak - Changed add_filter( 'gettext', array( $this, 'change_button_text' ), null, 2 ); to add_filter( 'gettext', array( $this, 'change_button_text' ), null, 3 );
* Tweak - Update change_button_text() function from ( $original == 'Insert into Post' ) to ( is_admin() && $original === 'Insert into Post' )
* Tweak : Added support for placeholder feature for input, email , password , text area types
* Tweak - Tested 100% compatible with WooCommerce Version 2.1.9
* Tweak - Tested 100% compatible with WordPress Version 3.9.1

= 1.0.4.1 - 2014/04/14 =
* Tweak - Tested and updated for full WordPress version 3.9 compatibility.
* Tweak - Updated Masonry script to work with WP 3.9 with backward compatibility to WP v 3.7

= 1.0.4 - 2014/01/27 =
* Feature - Upgraded for 100% compatibility with WooCommerce Version 2.1 with backward compatibility to Version 2.0
* Feature - Added all required code so plugin can work with WooCommerce Version 2.1 refactored code.
* Tweak - All switch text to show as Uppercase.
* Tweak - Added description text to the top of each Pro Version yellow border section
* Tweak - Tested for compatibility with WordPress version 3.8.1
* Tweak - Full WP_DEBUG ran, all uncaught exceptions, errors, warnings, notices and php strict standard notices fixed.

= 1.0.3 - 2013/12/20 =
* Feature - a3rev Plugin Framework admin interface upgraded to 100% Compatibility with WordPress v3.8.0 with backward compatibility.
* Feature - a3rev framework 100% mobile and tablet responsive, portrait and landscape viewing.
* Tweak - Upgraded dashboard switch and slider to Vector based display that shows when WordPress version 3.8.0 is activated.
* Tweak - Upgraded all plugin .jpg icons and images to Vector based display for full compatibility with new WordPress version.
* Tweak - Yellow sidebar on Pro Version Menus does not show in Mobile screens to optimize admin panel screen space.
* Tweak - Tested 100% compatible with WP 3.8.0
* Fix - Upgraded array_textareas type for Padding, Margin settings on the a3rev plugin framework

= 1.0.2 - 2013/11/28 =
* Feature - Upgraded the plugin to the newly developed a3rev admin Framework with app style interface.
* Feature - Admin panel Conditional logic and intuitive triggers. When setting is ON corresponding settings appear, OFF and they don't show.
* Tweak - Moved admin from WooCommerce settings tab onto the WooCommerce menu items under the menu name Sort and Display.
* Tweak - Sort & Display menus item tabs, Settings | Endless Scroll | View All & Count
* Tweak - Endless Scroll tab has 3 sub menu items, Shop Page Scroll | Category Page Scroll | Parent Cat & Tag Page Scroll
* Tweak - View All & Count has 2 sub menu items, View All Products | Count Meta
* Tweak - New admin UI features check boxes replaced by switches, some dropdowns replaced by sliders.
* Tweak - Tested 100% compatible with WordPress 3.7.1
* Tweak - Tested 100% compatible with WooCommerce 2.0.20
* Fix - Fix - $args->slug depreciated in WordPress 3.7, replace with $request = unserialize( $args['body']['request'] ); $request->slug
* Fix - Plugins admin script and style not loading in Firefox with SSL on admin. Stripped http// and https// protocols so browser will use the protocol that the page was loaded with.
* Fix - Full WP_DEBUG and all uncaught exceptions, errors, notifications and warnings fixed.

= 1.0.1 - 2013/09/03 =
* Tweak - Updated some prefixes to a3rev_ for compatibility with the a3revFramework.
* Tweak - Tested for full compatibility with WordPress v3.6.0
* Fix - Replaced get_pagenum_link() function with add_query_arg() function. Endless scroll not loading pages on sites with SSL redirects from https to http on shop and archive pages.

= 1.0.0 - 2013/07/23 =
* First working release


== Upgrade Notice ==

= 1.3.5 =
Major Maintenance Upgrade. 6 Code Tweaks plus 3 bug fixes for full compatibility with WordPress v 4.3.0 and WooCommerce v 2.4.4

= 1.3.4 =
Maintenance Upgrade. One custom sort Featured and On Sale bug fix plus Removed all Pro Version setting boxes from admin panels. Tweak for full compatibility with WooCommerce Version 2.3.13 and WP 4.2.3

= 1.3.3 =
Maintenance Upgrade. 1 tweak for full compatibility with plugins or themes have use masonry scripts

= 1.3.2 =
Maintenance Upgrade. 2 tweaks for full compatibility with plugins that have pre-set product views based on roles. Example product price

= 1.3.1 =
Maintenance Upgrade. 2 x code tweaks to fix bug on shop page display that was in yesterday version 1.3.0 feature release

= 1.3.0 =
Feature Upgrade. Major performance upgrade with optimized database queries and in-plugin caching

= 1.2.1 =
Maintenance Upgrade. 2 code Tweaks for new a3 Plugin Framework released in version 1.2.0

= 1.2.0 =
Major Feature Upgrade. Massive admin panel UI and UX upgrade. Includes 8 new features, 1 bug fix plus full compatibility with WooCommerce Version 2.3.11

= 1.1.8 =
Important Maintenance Upgrade. 2 x major a3rev Plugin Framework Security Hardening Tweaks plus full compatibility with WooCommerce 2.3.10

= 1.1.7 =
Maintenance Upgrade. 2 bugs fix and 2 security Tweaks, full compatibility with WordPress 4.2.2 and WooCommerce 2.3.9

= 1.1.6 =
Important Security Patch! - please run this update now. Fixes XSS vulnerability declared and patched in WordPress Security update v 4.1.2

= 1.1.5 =
Maintenance upgrade. Code tweaks for full compatibility with WordPress 4.2.0 and WooCommerce 2.3.8

= 1.1.4 =
Upgrade now for full compatibility with WooCommerce Version 2.3.7 and WordPress version 4.1.1

= 1.1.3 =
Upgrade now for full compatibility with WooCommerce major version release 2.3.0 with backward compatibility to WooCommerce v 2.2.0

= 1.1.2 =
Upgrade now for Infinite Scroll bug fix, plus support for a3 Lazy Load and full compatibility with WooCommerce 2.2.10 and WordPress 4.1

= 1.1.1 =
Upgrade now for full 1 Sass bug fix and full compatibility with WooCommerce Version 2.2.2 and WordPress 4.0

= 1.1.0 =
Major version upgrade. Full front end and back end conversion to Sass and Tweaks for full compatibility with soon to be released WooCommerce 2.2

= 1.0.5.3 =
Minor version upgrade to keep the Lite Version in synch with Pro version upgrade.

= 1.0.5.2 =
Minor version upgrade. Improved Product Cat create and edit pages UI for lite version users.

= 1.0.5.1 =
Update your plugin now for tweaks for full compatibility with WooCommerce Version 2.1.12

= 1.0.5 =
Upgrade now for 2 New Features, 2 framework code tweaks, 1 bug fix and full compatibility with WooCommerce version 2.1.11

= 1.0.4.3 =
Minor version update - missed 2 tweaks from yesterdays version 1.0.4.2 release.

= 1.0.4.2 =
Update now for 5 Framework code tweaks and full compatibility with WooCommerce version 2.1.9 and WordPress version 3.9.1

= 1.0.4.1 =
Important Upgrade! Upgrade now for full compatibility with WordPress version 3.9 and backwards to WP v3.7

= 1.0.4 =
Upgrade now for full compatibility with WooCommerce Version 2.1 and WordPress version 3.8.1. Includes full backward compatibly with WooCommerce versions 2.0 to 2.0.20.

= 1.0.3 =
Upgrade now for full a3rev Plugin Framework compatibility with WordPress version 3.8.0 and backwards. New admin interface full mobile and tablet responsive display.

= 1.0.2 =
Upgrade your plugin now to the new a3rev plugin framework and intuitive app style admin interface plus 6 associated tweaks and 3 bug fixes and full compatibility with WP 3.7.1 and Woocommerce 2.0.20.

= 1.0.1 =
Upgrade now for a page load bug fix on sites the have SSL