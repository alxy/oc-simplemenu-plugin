OctoberCMS SimpleMenu Plugin
====================

After the installation process, you will find a new component in your CMS area. It can be added to any page or layout, the integration works via the following code:

````
{% component 'alias' %}
````

You will likely want to add it to your main layout file. Once this is done, you will have to set a few options:
- Menu class: The class attribute for the main menu (ul).
- Submenu class: The class attribute for the sub menu (ul).
- Item class: The class attribute for the menu items (li).
- Active class: The class attribute for the active item.

There will be some sensible default values to provide a drop-in replacement for the existing demo theme navigation. I also cover this replacement in my video screencast: https://vimeo.com/96068398

On top of that, you will find a new settings tab in the Page editor called "SimpleMenu". This tab will give you the following options:
- Show in SimpleMenu: Decide, weather to show the page in the navigation or not.
- Displayed text: The text for the navigation item
- Order: The higher the value the later it will appear in the navigation. (Also supports negative values)
