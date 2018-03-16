# Theme Customizer

A Magnento 2.2.x compatible extension to allow easy overrides for theme colors via the Admin UI. The user has the ability to create skins, which is a set of css overides for a particular theme. The skins are maintaned and saved separately from the theme, so they can be applied to or removed from any theme as necessary.

#### Please note

> The primary use of this exention is to quickly customize a theme for demonstration purposes. It is NOT recommeded for use in a production environment 

#### Concepts
- ***Element*** - The definition of a theme override. Includes css code, and UI Definitions
- ***Skin*** - A set of element configurations that can be applied to themes
- ***Template*** - A read only skin that can be duplicated as the start of a customization. Templates defined include existing themes -- Blank, Luma, Venia & Brentmill

#### Usage
- The UI is avilable under **SC Tools->Theme Customizer**
- The first screen shows a list of defined templates and any skins that are created.  Templates can only be duplicated. Skins can be edited, duplicated and applied to themes.
- If you want to make changes to an exising theme, you can duplicate its template, but that is not necessary. Only the elements you define in the skin will be overridden. All others will inherit the parent theme settings. For example, you can create a new skin and only edit the Primary Font Color. When applied to the Luma theme the Primary Font Color will be the only change, with all other colors remaining the same as the Luma theme.
- Clicking on a field will bring up a color picker. You can manually enter RGB and Hex values.  Or use your mouse to select the color by dragging the small circle and arrows in the color picker. After selecting your color, click the color wheel in the lower right to apply the changes.
- There is an **Additional CSS** field to put in any additional css changes that arent covered by the defined fields.
- To apply a skin to a theme, just select the theme and save the skin.  If the theme has a different skin selected, it will be switched to your latest change.
- You may need to flush the Magento and browser caches. The general rule of thumb is the first time a skin is applied to a theme, the Magento cache will need to be flushed. A change to a deployed skin will usually only require a browser cache flush.
### Developer Notes
**Database**

magentoese_themecustomizer_elements - definition of element

| Column | Description|
| ------ | ------ |
| element_id | Autoincrement|
| element_code | Unique string to identify element|
| frontend_label | Name shown in admin UI|
| ui | Selector interface in the admin UI. Currently only colorpicker supported|
| css_code | CSS to be added that overrides the theme|

magentoese_themecustomizer_skin - includes templates and saved skins

| Column | Description|
| ------ | ------ |
| skin_id | Autoincrement|
| name | Unique name|
| creation_date ||
| update_date ||
| is_active |Defaulted to 1|
| applied_to | Id of theme skin is applied to. 0 if not applied|
| read_only | 1 = template, 0 = skin|
| additional_css | CSS added by the user in the UI|
| **top_bar_color...** | Value input in the UI. The table is extended with a column for each element_code defined by the elements table|

**CSV Files examples**

elements.csv 
(see magentoese_themecustomizer_elements table for field definitions)
In the css_code field, the value to be substituted is represented by a variable ($top_bar_color) which should match the element_code

| element_code | frontend_label | ui | css_code |
| ------ | ------ | ------ | ------ |
| top_bar_color | Top Bar Color | colorpicker | .page-header .panel.wrapper { background-color:$top_bar_color !important;} |

templates.csv 
(see magentoese_themecustomizer_skins table for field definitions)

| name | read_only | top_bar_color | ... |
| ------ | ------ | ------ | ------ |
| Luma Theme Template | 1 | #ff00ff | ... |


**Adding to HTML Head**
Script is added to Content->Design->Configuration->HTML Head for each store using the theme in order to include the appropriate css file
```<!-- START THEME CUSTOMIZER --><link  rel="stylesheet" type="text/css"  media="all" href="{{MEDIA_URL}}MagentoLuma.css" /><!-- END THEME CUSTOMIZER -->```

**CSS File location**
Resulting css files are saved to the pub/media directory with the theme as the file name. Example:  MagentoLuma.css

#### Release Notes
| Version | Notes |
| ------ | ------ |
| 1.0.0 | Initial Release |

#### Backlog
- Define Fonts for theme elements
- Save skin as template
- Mass delete skins
- Add/Update elements and templates
- Uninstall to clean up tags in head and removal of css files
