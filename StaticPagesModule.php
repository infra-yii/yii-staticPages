<?php

class StaticPagesModule extends CWebModule
{
    public $actionView = "/staticPages/staticPages/view";
    public $view = "view";

    public $actionImageUpload = "/staticPages/redactorUpload/imageUpload";
    public $actionFileUpload = "/staticPages/redactorUpload/fileUpload";
    public $actionLinkFileUpload = "/staticPages/redactorUpload/linkFileUpload";

    public $modelClass = "StaticPage";

    public $imagesDir = "assets/staticPages/images";
    public $filesDir = "assets/staticPages/files";
    public $linkFilesDir = "assets/staticPages/files";

    public $regions = array();

    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application

        // import the module-level models and components
        $this->setImport(array(
            'staticPages.models.*',
            'staticPages.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        } else
            return false;
    }

    public function model() {
        return StaticPage::model($this->modelClass);
    }

    public function possibleParents($id) {
        $prts = array(""=>"-");
        foreach(StaticPage::model()->findAll() as $p) {
            if($p->id == $id) continue;
            $prts[$p->id] = $p->title;
        }
        return $prts;
    }

    public function possibleRegions() {
        if(!count($this->regions)) return $this->regions;
        $regions = array();
        foreach($this->regions as $k=>$v) {
            if($k === "") {
                $regions[$k] = $v;
                continue;
            }
            if(is_array($v)) $v = $k;
            $regions[$v] = Yii::t("app", "Region ".ucfirst($v));
        }
        return $regions;
    }

    public function adminGenLinks() {
        return array(array('url' => array("/staticPages/staticPages/admin"), 'label' => Yii::t("app", "Manage Static Pages"), 'visible' => !Yii::app()->user->isGuest
        ));
    }
}
