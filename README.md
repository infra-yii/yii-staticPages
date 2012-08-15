yii-staticPages
===============

Yii module to create and manage simple static pages

Installation
====

0) Add giix dependency. You may install it from yiiframework.com, or add submodule like the following:

```
git submodule add git://github.com/alari/giix.git protected/extensions/giix
    'import' => array(
        #...
        'ext.giix.components.*',
        #...
    ),
    #...
    'modules' => array(
        #...
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'generatorPaths' => array(
                'ext.giix.generators', // giix generators
            ),
        ),
        #...
    ),

```

1) Add submodule:

`git submodule add git://github.com/alari/yii-staticPages.git protected/modules/staticPages`
`git submodule update`

Or, optionnaly, download and unzip it.

2) Modify your `main.php` config file:
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
            'view'=>'//??? whatever view',
            'modelClass'=>'StaticPage'
        ),
```

You also may override `additionalFields()` in model class.

3) Run migration script:

`./yiic migrate --migrationPath=staticPages.migrations`

Usage
======

1. Use it to store any static pages on a small and simple website.
2. Upload images and files in WYSIWYG.
3. Extend `StaticPage` model class to add functionality.
4. Use parent pages and regions to organize your view (main menu, contextual menus, etc.)
5. Demand more documentation.

This module works perfectly with `yii-i18n2ascii` component.