=== CB Visual Shortcode ===
Contributors: xpointer
Donate link: http://www.cbspoint.com/plugins/visual-shortcode-community-edition/
Tags: shortcode, post, page, custom post, visual, form, admin, content, cms, content management system
Requires at least: 4.0
Tested up to: 4.7.3
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Turns textual Wordpress Post Shortcodes into Visual Shortcode, provide web form for changing attributes value

== Description ==

Convert Post Shortcodes into Visual Clickable Elements. Provide a simple web form for modifying Shortcode attributes by just clicking on the visual shortcodes.

Shortcode is one of the very important features introduced in Wordpress platform. Shortcode is a WordPress-specific code that lets you do nifty things with very little effort. Shortcodes can embed files or create objects that would normally require lots of complicated, ugly code in just one line. Shortcode = shortcut

The only problem is dealing with Shortcode via raw text editor. Editing Shortcode with text editor would required a little efforts. Visual Shortcode Plugin rule is to simplify shortcode editing process by allow editing Shortcode attributes through simple web form

Visual Shortcode form is very simple and consist only from Text Fields however more fields might be configured for the Shortcode by installing [Advanced Visual Shortcode Extension Plugin](http://www.cbspoint.com/plugins/advanced-visual-shortcode/) Extension.

Once Shortcode Visual Element is clicked a Shortcode form will be pop-up allowing editing Shortcode attributes very easy without any manual editing for Shortcode attributes

Shortcode content, those data between the open and close Shortcode tags, is currently not allowed to be edited. Only Shortcode attributes can be edited.

Shortcode still can be edited manually or via Visual Shortcode clickable element, however make sure to don't change Visual Shortcode HTML wrapped signature to avoid Visual Shortcode plugin from visualizing your element twice as this would lead to unpredicatble behavior that prevent you from editing Shortcode attribute via web form.

Creating Visual Shortcodes must be done manually by clicking on Visualize Shortcode button. Visualizing Shortcode automaticlly is considered as [Advanced Visual Shortcode Extension Plugin](http://www.cbspoint.com/plugins/advanced-visual-shortcode/) feature to be added later.

[Advanced Visual Shortcode Extension Plugin](http://www.cbspoint.com/plugins/advanced-visual-shortcode/) make it even eaiser by allowing of defining Shortcode and its attributes so you don't need to rememebder Shortcode attributes everytime you want to edit Shortcode Attributes. Its also allow many Creating Different field type for every Shortcode Attribute.

= Features =
* Turns Shortcode texts into Visual Elements
* Modify Shortcode attributes using Web Form
* All Shortcode attributes are represted as input text field
* Visualize each post Shortcodes manually by single button click
* Support Switch between Text and Visual Editors
* Shortcode attributes may be updated manually after shortcode visualized

= Note =
This Plugin will display empty dialog for Shortcodes those don't have attributes yet. You must have Shortcode Attributes typed before displaying the form so that The Plugin knows how to create Shortcode Form. If you like to have Your Shortcode Defined and the forms as well you can purchase [Advanced Visual Shortcode Extension Plugin](http://www.cbspoint.com/plugins/advanced-visual-shortcode/)

= Need More Features ? =
[Advanced Visual Shortcode Extension Plugin](http://www.cbspoint.com/plugins/advanced-visual-shortcode/) comes along with many features, check out he list below:

* Text Field
* Dropdown List
* Multiple Selection list
* Single Selection List
* Checkbox list
* Radio Options list
* HTML5 Color Picker
* Wordpress Color Picker
* Image field
* Yes/No Field
* True/False Field
* On/Off Field
* Zero/One field
* Textarea field
* Set Field defaut value
* Define Shortcode (Tag, Title, Description)
* Define Shortcode form (Name, Title)
* Herarichal forms

== Installation ==

1. Upload `.zip` to the `/wp-content/plugins/cb-visual-shortcode` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Requirements ==
* PHP >= 5.3

== Frequently Asked Questions ==

= How VS Plugin works? =
* VS Plugin convert post textual Shortcodes into Clicakble elements

= Can I edit attributes manually after visualization? =
* Yes, however its not recommended to modify the HTML wrapper used to identify the Shortcode

= May I Click Visualize multiple times on the same post? =
* Yes, however, this would work perfect as long as the Wrapper code is not manually edited

= May I switch between Visual and Text Editor =
* Yes, this is fully supported

= Does VS automatically save the post content after clicking visualized =
* No! You need to update post to save the post content

= Does VS Support fields other than Text field? =
* No! However, [Advanced Visual Shortcode Extension Plugin](http://www.cbspoint.com/plugins/advanced-visual-shortcode/) do that and the list will be even grow by the time!

== Screenshots ==
1. Visualize Shortcode Edit Post Level Metabox Toolbox
2. Visualize Shortcodes
3. Shortcode form


== Changelog ==

= 1.0.0 =
* First release