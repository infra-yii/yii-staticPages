<?php

Yii::import('staticPages.models._base.BasePage');

class StaticPage extends BaseStaticPage
{
    public static function model($className = null)
    {
        if(!$className) $className = Yii::app()->getModule("staticPages")->modelClass;
        return parent::model($className);
    }

    public function relations()
    {
        $relation = parent::relations();

        $relation['pages']['order'] = 'sorting ASC';
        $relation['pages'][1] = Yii::app()->getModule("staticPages")->modelClass;
        $relation['parent'][1] = Yii::app()->getModule("staticPages")->modelClass;

        return $relation;
    }

    public function __toString() {
        return $this->title;
    }

    public function link() {
        return CHtml::link($this->title, array(Yii::app()->getModule("staticPages")->actionView, "id"=>$this->id));
    }

    public function url() {
        return CHtml::normalizeUrl(array(Yii::app()->getModule("staticPages")->actionView, "id"=>$this->id));
    }
}