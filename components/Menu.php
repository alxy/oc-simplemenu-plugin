<?php namespace Alxy\SimpleMenu\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Cms\Classes\Theme;
use System\Classes\ApplicationException;
use Symfony\Component\Yaml\Yaml;

class Menu extends ComponentBase
{

    public $links = [];

    public function componentDetails()
    {
        return [
            'name'        => 'SimpleMenu',
            'description' => 'Displays the SimpleMenu.'
        ];
    }

    public function defineProperties()
    {
        return [
            'main-ul-class' => [
                 'title'             => 'Menu class',
                 'description'       => 'The class attribute for the main menu (ul).',
                 'type'              => 'string',
                 'defaut'            => 'nav navbar-nav'
            ],
            'sub-ul-class' => [
                 'title'             => 'Submenu class',
                 'description'       => 'The class attribute for the sub menu (ul).',
                 'type'              => 'string',
                 'defaut'            => ''
            ],
            'main-li-class' => [
                 'title'             => 'Item class',
                 'description'       => 'The class attribute for the menu items (li).',
                 'type'              => 'string',
                 'defaut'            => ''
            ],
            'active-class' => [
                 'title'             => 'Active class',
                 'description'       => 'The class attribute for the active item.',
                 'type'              => 'string',
                 'defaut'            => 'active'
            ]
        ];
    }

    public function getOptions() {
        return array_merge(
            $this->getProperties(), [
                'currentURL' => \URL::current(),
                'links' => static::parsePages(static::listPages())
            ]);
    }



    public function onRun() {
        
    }

    private static function listPages()
    {
        if (!($theme = Theme::getEditTheme()))
            throw new ApplicationException(Lang::get('cms::lang.theme.edit.not_found'));

        $pages = Page::listInTheme($theme, true);

        $result = [];
        foreach ($pages as $page) {
            if ($page->show_menu == "1") {
                $result[$page->menu_order] = [
                    'text' => $page->menu_text,
                    'path' => $page->getBaseFileName(),
                    'order' => $page->menu_order
                ];
            }
        }

        ksort($result);

        return $result;
    }

    private static function parsePages($pages = []) {
        $tree = [];
        foreach ($pages as $page) {
            array_set($tree, str_replace('/', '.', $page['path']), $page);
        }
        return $tree;
    }

}