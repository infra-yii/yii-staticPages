<?php

Yii::import('staticPages.models._base.BaseStaticPage');

/**
 * @property string $content
 * @property StaticPage[] pages
 */
class StaticPage extends BaseStaticPage
{
    private $_content;

    public static function model($className = null)
    {
        if (!$className) $className = Yii::app()->getModule("staticPages")->modelClass;
        return parent::model($className);
    }

    public function relations()
    {
        $relation = parent::relations();

        if (array_key_exists("staticPages", $relation)) {
            $relation["pages"] = $relation["staticPages"];
            unset($relation["staticPages"]);
        }

        $relation['pages']['order'] = 'sorting ASC';
        $relation['pages'][1] = Yii::app()->getModule("staticPages")->modelClass;
        $relation['parent'][1] = Yii::app()->getModule("staticPages")->modelClass;

        return $relation;
    }

    /**
     * @return array fieldName => formMethod
     */
    public function additionalFields()
    {
        return array("path" => "textField", "sorting" => "textField");
    }

    /**
     * A view (or partial template) to be injected into a page form view
     * @return string
     */
    public function formInjection()
    {
        return null;
    }

    /**
     * Adds region to criteria
     * @param $name
     * @return StaticPage
     */
    public function region($name)
    {
        $this->getDbCriteria()->order = "sorting ASC";
        $this->getDbCriteria()->compare("region", $name);
        if ($this->id) {
            $this->getDbCriteria()->compare("parent_id", $this->id);
        }
        return $this;
    }

    public function getContent()
    {
        if (!$this->_content) {
            $this->_content = $this->dbConnection
                ->createCommand("SELECT content FROM {{static_page_content}} WHERE page_id=:id")
                ->bindValue("id", $this->id)->queryScalar();
        }
        return $this->_content;
    }

    public function setContent($content)
    {
        $this->_content = $content;
    }

    /**
     * Adds mainmenu flag to criteria
     * @return StaticPage
     */
    public function mainMenu()
    {
        $this->getDbCriteria()->compare("in_main_menu", 1);
        return $this;
    }

    /**
     * @param $path
     * @return CActiveRecord
     */
    public function findByPath($path)
    {
        return $this->findByAttributes(array("path" => $path));
    }

    public function __toString()
    {
        return $this->title;
    }

    /**
     * @return string html-link
     */
    public function link()
    {
        return CHtml::link($this->title, array(Yii::app()->getModule("staticPages")->actionView, "id" => $this->path ? $this->path : $this->id));
    }

    /**
     * @param bool $normalize
     * @return array|string
     */
    public function url($normalize = false)
    {
        $u = array(Yii::app()->getModule("staticPages")->actionView, "id" => $this->path ? $this->path : $this->id);

        return $normalize ? CHtml::normalizeUrl($u) : $u;
    }

    public function beforeSave()
    {
        if (Yii::app()->getComponent("i18n2ascii")) {
            Yii::app()->getComponent("i18n2ascii")->setModelUrlAlias($this, $this->title);
        }
        return true;
    }

    public function afterSave()
    {
        parent::afterSave();
        $contentExists = $this->dbConnection
            ->createCommand("SELECT COUNT(*) FROM {{static_page_content}} WHERE page_id=:id")
            ->bindValue("id", $this->id)
            ->queryScalar();
        if ($contentExists) {
            $this->dbConnection
                ->createCommand("UPDATE {{static_page_content}} SET content=:content WHERE page_id=:id")
                ->bindValues(array("id" => $this->id, "content" => $this->_content))
                ->execute();
        } else {
            $this->dbConnection
                ->createCommand("INSERT INTO {{static_page_content}}(page_id, content) VALUES(:id, :content)")
                ->bindValues(array("id" => $this->id, "content" => $this->_content))
                ->execute();
        }
    }

    public function setAttributes($values, $safeOnly = true)
    {
        parent::setAttributes($values, $safeOnly);
        if (is_array($values) && array_key_exists("content", $values)) {
            $this->setContent($values["content"]);
        }
    }
}