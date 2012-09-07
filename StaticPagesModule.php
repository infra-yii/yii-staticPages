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
        $this->setImport(array(
            'staticPages.models.*',
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

    /**
     * Returns possible parent pages for a page
     * @param $id
     * @return array
     */
    public function possibleParents($id)
    {
        $prts = array("" => "-");
        foreach (StaticPage::model()->findAll() as $p) {
            if ($p->id == $id) continue;
            $prts[$p->id] = $p->title;
        }
        return $prts;
    }

    /**
     * @return array possible regions to place a page to
     */
    public function possibleRegions()
    {
        if (!count($this->regions)) return $this->regions;
        $regions = array();
        foreach ($this->regions as $k => $v) {
            if ($k === "") {
                $regions[$k] = $v;
                continue;
            }
            if (is_array($v)) $v = $k;
            $regions[$v] = Yii::t("app", "Region " . ucfirst($v));
        }
        return $regions;
    }

    /**
     * @return array CMenu-prepared links array
     */
    public function mainMenuLinks()
    {
        $links = array();
        foreach (StaticPage::model()->mainMenu()->findAll() as $p) {
            $links[] = array("label" => $p->title, "url" => array($this->actionView, "id" => $p->path ? $p->path : $p->id));
        }
        return $links;
    }

    /**
     * @return array AdminGenModule integration
     */
    public function adminGenLinks()
    {
        return array(
            'label'=>Yii::t('app', "Static Pages"),
            'url'=>'#',
            'items'=>array(
                array('url' => array("/staticPages/staticPages/admin"), 'label' => Yii::t("app", "Manage Static Pages")),
                array('url' => array("/staticPages/staticPages/create"), 'label' => Yii::t("app", "Create Page")),
            )
        );
    }
}
