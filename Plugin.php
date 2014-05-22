<?php namespace Alxy\SimpleMenu;

use System\Classes\PluginBase;
use Event;

/**
 * SimpleMenu Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'SimpleMenu',
            'description' => 'Generates a simple Menu based on the existing pages.',
            'author'      => 'Alexander Guth',
            'icon'        => 'icon-tasks'
        ];
    }

    public function register()
    {
        Event::listen('backend.form.extendFields', function($widget) {
            // if (!$widget->getController() instanceof \RainLab\User\Controllers\Users) return;
            // if ($widget->getContext() != 'update') return;
            // if (!Member::getFromUser($widget->model)) return;
            if (!$widget->model instanceof \Cms\Classes\Page) return;

            $widget->addFields([
                'settings[menu_text]' => [
                    'label' => 'Displayed text',
                    'tab' => 'SimpleMenu',
                    'span' => 'left',
                ],
                'settings[menu_order]' => [
                    'label' => 'Order',
                    'comment' => 'Change the order of displayed items',
                    'tab' => 'SimpleMenu',
                    'span' => 'right',
                ],
                'settings[show_menu]' => [
                    'label' => 'Show in SimpleMenu',
                    'type' => 'checkbox',
                    'tab' => 'SimpleMenu',
                    'span' => 'auto',
                    'comment' => 'Place a tick in this box to show this page in the menu.',
                ],
            ], 'primary');
        });
    }

    public function registerComponents()
    {
        return [
            'Alxy\SimpleMenu\Components\Menu' => 'simpleMenu'
        ];
    }

}
