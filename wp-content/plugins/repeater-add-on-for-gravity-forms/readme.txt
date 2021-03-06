=== Gravity Forms Repeater Add-On ===
Contributors: KodieGrantham
Tags: gravityforms, gravity, forms, form, gravityforms, repeater, repeat, duplicate, duplication, field, fields
Requires at least: 3.9
Tested up to: 4.4
Stable tag: trunk

A Gravity Forms add-on that allows specified groups of fields to be repeated by the user.

== Description ==
**This plugin is no longer maintained and is probably broken, go use [Gravity Forms Nested Forms by Gravity Wiz](https://gravitywiz.com/documentation/gravity-forms-nested-forms/?ref=145) instead!**

A Gravity Forms add-on that allows specified groups of fields to be repeated by the user.

= Supported Fields =
* Address
* Checkboxes
* Date
* Drop Down
* Email
* Hidden
* HTML
* MultiSelect
* Name
* Number
* Paragraph Text
* Phone
* Radio
* Section
* Single Line Text
* Time
* Website

= Features =
* Repeat groups of fields multiple times
* Use multiple repeaters on the same form
* Use shortcodes to display data to the user
* Use Javascript to manipulate the repeater (See GitHub Page)
* Customize the add and remove button's HTML
* Use Gravity Forms pre-populate hooks and filters like normal
* Supports Conditional Logic!

= Issues =
* Not all fields are currently supported.
* Ajax enabled forms are not yet supported. (Ajax will be automatically disabled on forms with repeaters)

= Shortcodes =
You can place shortcodes inside of input labels, input descriptions, and HTML blocks!

* [gfRepeater-count] - Will output the current repeat number.
* [gfRepeater-buttons] - Will output both the '+' and '-' buttons.
* [gfRepeater-add] - Will output the '+' button.
* [gfRepeater-remove] - Will output the '-' button.

= CSS Classes =
You can use these CSS classes in the in the "Custom CSS Class" setting to do different things.

* gf_repeater_hide_add - Will hide the '+' button if placed in the repeater end css setting.
* gf_repeater_hide_remove - Will hide the '-' button if placed in the repeater end css setting.

= Check out the source on GitHub! =
<https://github.com/kodie/gravityforms-repeater>

== Installation ==
1. Upload the `repeater-add-on-for-gravity-forms` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==
= Can I use multiple repeaters in one form? =
Yes!

= Can I nest repeaters? =
Unfortunately nesting repeaters is not supported at this time.

= Can I change the `+` and `-` buttons to text links? =
Yes! Just go to the form editor and change the `Add HTML` and `Remove HTML` settings to `<a>Your Link Text</a>` and they should appear as regular links on your form!

== Screenshots ==
1. Any supported fields placed between the `Repeater` and `Repeater End` will be repeated.
2. A minimum and maximum number may be set to limit how many times a Repeater can be repeated.
3. When activated, 2 new field type buttons will be added to Gravity Forms, `Repeater` and `Repeater End`.
4. A view of the front-end. The only visible difference will be the added `+` and `-` buttons.

== Changelog ==
= 1.0.9 =
* Fixed bug where in some cases a PHP error would occur when attempting to automatically disable ajax on a form.
* Fixed bug where sometimes a javascript error would occur on date fields with a calendar icon.
* Fixed bug where removing a specific repeatId would cause some weird things to happen.
* Fixed bug where repeaters in a multipage form that are not on the first page would appear to have failed validation even if the form hasn't been submitted.
* Fixed bug where repeaters in a muttipage form that are not on the first page would forget their saved data and ignore their start setting.
* Fixed hideButtons setting.
* Added [gfRepeater-buttons], [gfRepeater-add], and [gfRepeater-remove] shortcodes.
* Added custom CSS option to repeater start and end fields.
* Added gf_repeater_hide_add and gf_repeater_hide_remove CSS classes.
* Added gfRepeater_select javascript function.
* Added 'gform_repeater_init_done' trigger to window and individual forms.
* Changed 'beforeRepeat', 'afterRepeat', 'beforeUnRepeat', and 'afterUnRepeat' triggers to 'gform_repeater_before_repeat', 'gform_repeater_after_repeat', 'gform_repeater_before_unrepeat', and 'gform_repeater_after_unrepeat'.
* Repeated fields now respect conditional logic from outside the repeater.
* Applying conditional logic on a repeated section field now also applys that logic on repeated fields under that section.
* When exporting entries, repeater child data is now exported in a comma-separated list.

= 1.0.8 =
* Fixed bug where sometimes for some reason an input name would be sent as an array and cause a PHP error to display.
* Fixed bug where sometimes validation message would be displayed multiple times for same field.
* Fixed bug where filters would not be loaded if Repeater was the first field on the form.
* Fixed bug where sometimes captured repeater input data would be applied to other forms in cases where there are multiple forms on one page.
* Fixed prepopulation for checkbox and radio fields.
* Changed the way settings and field data is sent to Javascript so now monkey patching the input mask script is no longer necessary.
* Field input masks are now stored in gfRepeaters data. (gfRepeaters[repeaterId]['children'][childId]['inputMask'])
* Added support for conditional logic enabled fields!
* Added support for Repeater merge tags.
* Cleaned up formatting for text-only email notifications.
* Changed Repeater End Setting from 'doNotUse' to 'hideButtons'.
* Added Repeater Start Setting 'Hide Label & Description' to appearance tab.
* Repeater label now defaults to 'Repeater' instead of blank and adminLabel now defaults to blank instead of 'Repeater'.
* Repeater Javascript now initiates after 'gform_post_render' has been triggered instead of on window load.

= 1.0.7.2 =
* Fixed saved repeater field data during validation. (Accidently broke it in the 1.0.7.1 patch)

= 1.0.7.1 =
* Fixed a bug where repeater would break multipage forms. (Sorry about that!)

= 1.0.7 =
* Fixed bug where field order was not saved when a form was submitted.
* Fixed syntax error for older versions of PHP.
* Repeated fields now have their tabindex set to the one that was assigned to the repeater start field.
* Repeater start field tabindex now stored in gfRepeaters data. (gfRepeaters[repeaterId]['data']['tabIndex'])
* Repeater is now repeated if a paremeter is set for a specific field that is higher than the start repeat count.
* Highest set paremeter number is now stored in gfRepeaters data. (gfRepeaters[repeaterId]['data']['paremCount'])
* Repeater dependencies, actions, and filters are now only loaded on forms that have a repeater field.
* Field type is now set for hidden and section fields in gfRepeaters data.
* Ajax is now automatically disabled on forms that have a repeater field. (Until I come up with a fix for ajax enabled forms)
* Added support for Andy Fragen's GitHub Updater. (See readme for more info)
* CSS is now minified.
* gfRepeaters data now contains the form ID number as a root and the repeater Id as a subroot. (See readme for more info)

= 1.0.6 =
* Fixed repeater 'start' setting. (Apparently it's been broken for awhile?)
* Fixed datepicker ui for repeated date fields.
* Fixed bug where repeater plugin wouldn't allow page settings to display in the form editor.
* Fixed entry detail formatting for emails and non-html views.
* Repeated field labels are no longer saved in the database with the entries and are now looked up by field ID.
* Added support for Hidden field type.
* Added the ability to change the repeater 'start' setting by using the built in Gravity Froms pre-populate filters and hooks.
* Added the ability to pre-populate repeated fields using the built in Gravity Forms filters and hooks. (See readme for more info)
* Field ID number is now stored in gfRepeaters data. (gfRepeaters[repeaterId]['children'][childId]['idNum'])
* Field input pre-populate value is now stored in GfRepeaters data. (gfRepeaters[repeaterId]['children'][childId]['inputs'][inputId]['prePopulate']) (See readme for more info)
* Plugin now requires Gravity Forms 1.9 or later.

= 1.0.5 =
* Fixed bug where sometimes not all repeated, required fields would be validated.
* Fixed bug where repeated fields that are set to 'adminOnly' would have that setting switched off upon form validation.
* Added support for MultiSelect, Radio, and Time fields.
* Added upgrade function to clean up entries from older versions.
* Repeater field admin label now defaults to 'Repeater' instead of blank.
* All repeated values are now stored as arrays besides special cases such as Section fields.
* Field types are now stored in gfRepeaters data. (gfRepeaters[repeaterId]['children'][childId]['type'])
* Name and Address fields now only require the normally required fields.
* Added plugin page link to row meta.
* A few misc things and code clean up.

= 1.0.4 =
* Fixed bug with number field where a PHP error would show up if a form failed validation.
* Fixed bug where a javascript error would occur if no repeater children were marked as required.
* Fixed bug where a PHP error would sometimes occur on the entries page in the admin panel if a repeated field was submitted blank.
* Added support for Section field type.
* Default validation functions are now bypassed for repeater children.
* gfRepeater-count shortcode now shows up for field titles on the entires page in the admin panel.
* Blank repeated fields now show up if "Show Empty Fields" is enabled.
* Repeater children and repeater end fields no longer display duplicated results on the entries page in the admin panel.
* Added a little bit of backwards compatibility for fetching saved repeater child entry data.

= 1.0.3 =
* Fixed bug where repeated fields would look like they failed validation if any repeated fields before them failed.
* Fixed bug with validation on fields with multiple inputs.
* Fixed bugs with form editor and setting repeater children required option.
* Added beforeRepeat, afterRepeat, beforeUnRepeat, and AfterUnRepeat form triggers.
* Added a stylesheet with some default styles for repeater releated stuff.
* Added keypress event and tab index to add and remove buttons.
* Added a little bit of error handing to the javascript just in case the admin forgets to add a repeater-end or trys to nest repeaters.
* Repeater start field label now defaults to blank instead of "Untitled".

= 1.0.2 =
* Fixed bug where if any fields in a form with a repeater in it would be unsubmittable.
* Fixed repeater field validation.
* Added custom validation message feature.
* Added repeater "start" number feature.
* Added repeater label and description options.
* Added custom Add and Remove button HTML feature.
* Added "Do not use add and remove buttons" feature.
* Added new "[gfRepeater-count]" shortcode.

= 1.0.1 =
* Added support for Address, Checkboxes, Name, and Number fields.
* Added View details and GitHub links to row meta.
* Fixed input masks!

= 1.0.0 =
* Initial Release
