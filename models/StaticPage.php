<?php

Yii::import('staticPages.models._base.BaseStaticPage');

class StaticPage extends BaseStaticPage
{
    public static function model($className = null)
    {
        if (!$className) $className = Yii::app()->getModule("staticPages")->modelClass;
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

    public function region($name)
    {
        $this->getDbCriteria()->order = "sorting ASC";
        $this->getDbCriteria()->compare("region", $name);
        return $this;
    }

    public function findByPath($path)
    {
        return $this->findByAttributes(array("path" => $path));
    }

    public function __toString()
    {
        return $this->title;
    }

    public function link()
    {
        return CHtml::link($this->title, array(Yii::app()->getModule("staticPages")->actionView, "id" => $this->id));
    }

    public function url($normalize = false)
    {
        $u = array(Yii::app()->getModule("staticPages")->actionView, "id" => $this->path ? $this->path : $this->id);

        return $normalize ? CHtml::normalizeUrl($u) : $u;
    }

    public function beforeSave()
    {
        if(Yii::app()->getComponent("i18n2ascii")) {
            Yii::app()->getComponent("i18n2ascii")->setPath($this, $this->title);
        }
        return true;
    }
}