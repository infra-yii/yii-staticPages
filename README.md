yii-staticPages
===============

Yii module to create and manage simple static pages

Installation
====

1) Add submodule:

`git submodule add git://github.com/alari/yii-staticPages.git protected/modules/staticPages`
`git submodule update`

Or, optionnaly, download and unzip it.

2) Run migration script:

`./yiic migrate --migrationPath=staticPages.migrations`

3) Modify your `main.php` config file:
```
'components' => array(
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(

                'page/<id:[\w\-]+>' => 'staticPages/staticPages/view',
```

And in _modules_ section:

```
        'staticPages' => array(
            "regions"=>array(
                ""=>"-",
                "mainMenu",
                ...
            ),
            'view'=>'//??? whatever',
            'modelClass'=>'StaticPage'
        ),
```

You also may override `additionalFields()` in model class.

Usage
======

1. Use it to store any static pages on a small and simple website.
2. Upload images and files in WYSIWYG.
3. Extend `StaticPage` model class to add functionality.
4. Use parent pages and regions to organize your view (main menu, contextual menus, etc.)
5. Demand more documentation.

This module works perfectly with `yii-i18n2ascii` component.