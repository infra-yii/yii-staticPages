<?php
$this->pageTitle = $model->title;
if(!Yii::app()->user->isGuest) {
    $this->menu = array(
            array("label"=>Yii::t("app", "Manage Page"), "url"=>array("/staticPages/staticPages/update", "id"=>$model->id)),
            array("label"=>Yii::t("app", "Create New Page"), "url"=>array("/staticPages/staticPages/create")),
    );
}
?>

<h1><?=$model->title?></h1>


<?=$model->content?>

<?php
foreach ($model->pages as $page){
    $this->widget('zii.widgets.CMenu',array(
        'items'=>array(
            array("label"=>$page->title, "url"=>$page->url()),
        )
    ));
}
?>

