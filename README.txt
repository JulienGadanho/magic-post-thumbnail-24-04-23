=== Magic Post Thumbnail ===
Plugin Name:       Magic Post Thumbnail
Version:           4.1.11
Tags:              image, generate, google image, pixabay, unsplash, pexels, dalle, flickr, cron, mpt, image bank
Donate link:       https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=contact%40magic-post-thumbnail.com&item_name=Donation+for+Magic+Post+Thumbnail&currency_code=EUR&source=url
Contributors:      Mcurly
Author URI:        https://magic-post-thumbnail.com/
Author:            Magic Post Thumbnail
Requires at least: 5.0
Tested up to:      6.2
Stable tag:        4.1.11
Requires PHP:      7.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Transform your posts with stunning images effortlessly! Magic Post Thumbnail includes many image banks to automatically get featured images for your posts.

== Description ==

**Easily create eye-catching images for your posts automatically with Magic Post Thumbnail!**

Retrieve images from **Google Images**, DALL·E, Pexels, Unsplash or **Pixabay** thanks to API, **based on your post title**, text analysis and much more. The plugin add picture as your **featured thumbnail** or **inside the post** when you publish the post.

The plugin allows you to configure some settings for your automatic images : **Image bank**, language search, selected post types, image type, free-to-use or not, image size and much more.


**Tired of spending hours searching for the perfect images for your posts?** Magic Post Thumbnail! does the hard work for you!

**<a target="_blank" href="https://magic-post-thumbnail.com/">Official Website</a>**

**<a target="_blank" href="https://magic-post-thumbnail.com/docs/">Documentation</a>**

== What is included ? ==

= Magic Post Thumbnail for FREE =

<ul>
<li>Generate Thumbnail for one post</li>
<li><strong>Generate Thumbnails</strong> for Posts, Pages & Custom Post Types</li>
<li>Image <strong>based on Titles</strong> or Text Analysis</li>
<li>Images from <strong>Google Image</strong>, Google API, <strong>Pixabay</strong>, Creative Commons, DALL·E API (v1) or Flickr</li>
<li><strong>Mass Image Generation</strong> for chosen posts or chosen taxonomies</li>
</ul>

= Magic Post Thumbnail PRO =

Upgrade to our PRO version to unlock even more **advanced features** and take your blog to the next level!

<ul>
<li>Customisable <strong>Crons</strong></li>
<li>Images from Youtube, <strong>Unsplash</strong>, <strong>Pexels</strong> or <strong>Envato Elements</strong></li>
<li>Image based on Tags, Categories, Custom Fields, Custom Request and <strong>OpenAI Keyword Extractor</strong></li>
<li>Image generated randomized</li>
<li><strong>Image Shuffle</strong>: Flip horizontally and/or Crop Image by 10%</li>
<li><strong>Compatibility</strong> with REST requests, WPeMatico, FeedWordPress, WP All Import and Featured Image from URL.</li>
<li>Restricted domains</li>
<li>Setup a proxy</li>
<li><strong>24h Support</strong></li>
</ul>

[Upgrade to PRO](https://magic-post-thumbnail.com/pricing/)

== Translations ==
* French
* Spanish

== Screenshots ==
1. Magic Post Thumbnail : Bulk Generation
2. Magic post Thumbnail : Settings
3. Magic post Thumbnail : Image Banks
4. Magic post Thumbnail : Cron
5. Magic post Thumbnail : Generate featured images for post types
6. Magic post Thumbnail : Generate featured images for taxonomies
7. Magic post Thumbnail : Generate featured images for each post individually

== Support the plugin ==
If you've found the plugin useful, please consider <a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=contact%40magic-post-thumbnail.com&item_name=Donation+for+Magic+Post+Thumbnail&currency_code=EUR&source=url">making a donation</a>. Thank you for your support !


== Installation ==
1. Activate the plugin
2. Go to the "Magic Post Thumbnail" menu tab
3. Configure your settings, which post type you want to enable it and the image bank.
4. Go into a post, and choose "Click to generate" on the sidebar.
5. You can also **mass generate thumbnails** for posts. Go into the list of your posts, choose posts or taxonomy you want to get thumbnails, and into "Bulk Actions" choose "Generate featured images"

The "How to do" for APIs activations is <a target="_blank" href="https://magic-post-thumbnail.com/docs-category/image-databases/">available here</a>.


== Frequently Asked Questions ==

= How to generate images ? =

There are several ways :
<ul>
<li>You can generate an image with the button "Click to generate" on a post (works on Gutemberg & Classic Editor).</li>
<li>You can mass generate thumbnails for posts. Go into the list of your posts, choose posts or taxonomy you want to get thumbnails, and into “Bulk Actions” choose “Generate featured images”</li>
<li>You can also automatically schedule generation with crons with the Pro version, or by enabling compatibility with REST Requests, WPeMatico, FeedWordPress & WP Automatic Plugin.</li>
</ul>

= Is it unlimited ? =

Yes you can generate image as much as you want.

= Why images aren't generated anymore ? =

If you use Google Image too much for generation in a short time, your server may be temporarily banned. In this case, you should enable Interval for the generation.

= I have other pre-sale questions, can you help? =

Yes! You can ask us any question through our <a href="https://magic-post-thumbnail.com/contact-us/">support page</a>.


== Upgrade Notice ==

Upgrade your plugin to **<a target="_blank" href="https://magic-post-thumbnail.com/pricing/">Pro Version</a>** ! You will get much more options to configure, more image banks, and customisable crons.


== Changelog ==

= 4.1.11 - March 31, 2023 =
* Security : Removed a useless div in the "Bulk Generation"
* Update Freemius 2.5.6

= 4.1.10 - March 25, 2023 =
* PRO: If "Translate to English" feature is enabled, set original search for image name (instead of translated)
* Update Freemius 2.5.5: Should fix problems with "Fatal error: Uncaught Error: Call to undefined method Freemius_Api_WordPress::RemoteRequest()"
* Update some dashboard links
* Tests with WordPress 6.2 ok

= 4.1.9.1 - March 18, 2023 =
* Fix bug with Freemius
* Fix few JS errors
* Update some translations
* PRO: Fix bug with FeedWordPress
* PRO: Add compatibility with REST requests from external services

= 4.1.8 - March 08, 2023 =
* Update Freemius
* Change CSS for "Based on" list (remove inline style)
* PRO: Add Envato Elements as Image Database (requires Envato ELements subscription)
* PRO: Changed "text-davinci-003" to "gpt-3.5-turbo" for OpenAI Keyword Extractor (cheaper & better)
* PRO: Add option to translate the "based on" phrase/keywords with Google Translation (for better results)

= 4.1.7 - February 28, 2023 =
* Update words & translations for Pixabay
* Update link for Shutterstock API key
* Pixabay : update webformatURL to largeImageURL to get larger images
* Add documentation link (dashboard & readme)
* PRO : Add "OpenAI Keyword Extractor" to extract main keyword from title

= 4.1.6 =
* Semantic change : "rewrite" to "overwrite"
* PRO : Improve Cron by avoiding posts with images & limiting the number of posts

= 4.1.5 =
* Shutterstock options: update input type password
* Add informative sentences for Shutterstock, getty images & creative commons sources
* Prepare wp_insert_post() compatibility for future update
* PRO : Add "WordPress Automatic Plugin" for compatibility

= 4.1.4 =
* PRO : Add Pexels as database
* Add few translations

= 4.1.3 =
* Add show/hide icon for API keys
* PRO : Improve results with Unsplash (more coming soon)

= 4.1.2 =
* PRO : Add "Custom Request" for "Based on" images: allows a custom search (screenshot 2)
* Changed back-office title for panel options  (french version only)
* More results with Pixabay (200 instead of 100)

= 4.1.1 =
* Add webp as supported filetype for Google Image API
* Add link to youtube video according the WP language
* Change some spanish translations
* Fix bug with tags (several words into a tag didn't work)
* More results with Pixabay & Unsplash (useful for random results)
* PRO : Add language for Unsplash options

= 4.1 =
* Fix CSS bug when a new post is created
* Fix displaying of the button to generate
* Change some translations
* Add plugin translation in spanish
* Add message when settings are updated
* Update Freemius
* Change CSS for logs page to avoid width problem
* Add "settings config" into logs to copy current plugin settings
* PRO : Fix bug with cron form (Interval & Posts date)

= 4.0.6 =
* Include main CSS file only for the plugin dashboard
* Add CSS file only for post editor

= 4.0.5 =
* Remove useless function
* Add option to add save_post hook (Tab "Posts")

= 4.0.4 =
* Update Freemius
* PRO : @shuffle() instead of shuffle()

= 4.0.3 =
* Fix Text Analyser with free version
* Fix Text Analyser for few languages (due to stop-words and special characters)
* Add webp filetype images
* PRO : Fix div not showing when choosing Based on "Categories" & "Custom Field"

= 4.0.2 =
* Update some conditions with pro version
* Fix return error on generation.js
* Remove .tabs() on magic-post-thumbnail-admin.js
* Remove "-webkit-scrollbar" display:none on magic-post-thumbnail-admin.css

= 4.0.1 =
* Change screenshots & plugin description

= 4.0 =
* Re-worked plugin framework and classes
* Re-worked Text Analyser
* Re-worked graphic interface
* Add button on post editor to generate images (instead of save_post hook)
* Add custom interval between each image generation
* Add Creative Commons & DALL·E API (v1) as Sources
* After uninstall plugin : Remove plugin options & logs
* Update Freemius
* PRO : Add Image shuffle - flip horizontally & crop image
* PRO : Update compatibility with WPeMatico & FeedWordPress

= 3.3.12 =
* Fix Regex with Google Image Method
* PRO : Fix bug with proxy and PHP 8.0
* Update Freemius

= 3.3.11 =
* Update Freemius

= 3.3.10 =
* Fix Wp All import : avoid images with double generation
* Add do_action('mpt_after_create_thumb') after generation
* Add trim() to Google Image (API) for ID & Key

= 3.3.9 =
* Remove some errors "Post box not check"
* PRO : Fix with FIFU Compatibility

= 3.3.8 =
* Error with readme

= 3.3.7 =
* Security fix
* New Freemius version

= 3.3.6 =
* Fix Regex with Google Image Method

= 3.3.5 =
* Fix with Google Image Method

= 3.3.4 =
* Fix with Google Image Method

= 3.3.3 =
* Fix problem with all banks except Google due to last update
* PRO : Add notice about proxies : Work only with HTTPS protocol

= 3.3.2 =
* Improved results: Remove more empty images that may appear
* Freemius update
* PRO : Add "Blacklisted domains"
* PRO : Add Username & Password for proxy

= 3.3.1 =
* Fix errors with custom post types and excluded categories

= 3.3 =
* Improved results: Remove some empty images that may appear
* Link between media & post into the media library
* PRO : Add "Featured Image from URL" plugin compatibility

= 3.2.1 =
* Fix problem with WP All import and custom fields

= 3.2 =
* Add "Text_analyser" for "Based on" option
* Add logs

= 3.1.3 =
* Add Affiliation tab

= 3.1.2 =
* PRO : Fix bug with categories for image into posts

= 3.1.1 =
* Fix broken banks (all except Google Image)
* Fix "select all" input for free version
* Improve regex for Google Image

= 3.1 =
* Repair scraping for Google Image
* "Select all" input for some settings
* Parameters for js & css files for problems with browser cache
* PRO : Add proxy settings

= 3.0 =
* New Bulk generation design
* Work with resizers plugins
* More Google Image Sizes
* New setting : Image format
* Remove useless files
* Change image generation method : use admin-ajax now
* Fix error with "Restricted domains" textarea
* PRO : Fix problem with crons that don't fire
* PRO : Fix problem with crons, - pages images don't generate
* PRO : Better design in Crons settings (interval & Post date)
* PRO : New setting - Image generation into posts
