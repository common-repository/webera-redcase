=== RedCase ===
Contributors: joelzamboni, felipemarques10
Stable tag: 4.2
Tags: deals, offers
Requires at least: 4.6
Tested up to: 5.1
Requires PHP: 5.2.4
License: GPLv2 or later

This plugin is used to show deals based on Sheerid RedCase platform

== Description ==
This plugin is used to show deals based on RedCase platform for the entities who are connected to the SheerID verification platform

== Installation ==
Just upload the plugin to a Wordpress site or use the plugin installation process

== Changelog ==
= 1.0 =
* A initial version of the plugin
= 1.1 =
* Fix bugs
* Fix bugs load scripts and styles in page admin
* Fix title deal full in card
* Tag by fix and adjust title css
* Fix bug search by category
= 1.7 =
* Add segments for deals
= 1.8 =
* Fix Bug "This plugin does not have an valid header"
= 1.9 =
* Fix Bug "function deals_admin_init not found or invalid"
= 2.0 =
* Fix Bug save key marketplace
= 2.1 =
* Notify Add key marketplace if success or error
= 2.2 =
* Bug line-height title <h1>
* Extra spaces between lines under deal images
* Pop up deal page bugs
= 2.3 =
* Bug line-height title <h1>
* Extra spaces between lines under deal images
* Fix style modal
= 2.4 =
* Fix bug footer pages
= 2.5 =
* Fix replace text in portugues
* Photo edges squared instead of rounded
= 2.6 =
* Fix bug load scrips and css for pluin in painel wordpress
* Fix style footer
= 2.7 =
* Fix style input search and space in select category
= 2.8 =
* Fix style image in cards deals
= 2.9 = 
Fix style search
= 3.0 = 
Add single deal - /deal/?title='add the slug generate in admin'
Order by partners
Add Pagination in Deals
Fix of the responsive
= 3.2 = 
Fix Failed opening show_sinlge.php
= 3.5 = 
Fix Pagination
= 3.6 =
Remove Pagination
= 3.7 =
Fix bug request in API
= 3.8 =
Fix bug filter and pagination
= 3.9 =
Improvements in api for targeting and prevention of future paging bugs
= 4.0 =
Include in title deal company
= 4.1 or 4.2=
Add lib lazy load in images

== Shortcode ==
Show all deals: `[show_deals]`
Show deal: Create page with name Deal and add the shortcode `[show_single_deal]`
Add segment for shortcode: `[show_deals segment="military"]`
