<?php

/**
 * This is the model base class for the table "{{page}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Page".
 *
 * Columns in table "{{static_page}}" available as properties of the model,
 * followed by relations of table "{{static_page}}" available as properties of the model.
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $content
 * @property integer $sorting
 *
 * @property StaticPage $parent
 * @property StaticPage[] $pages
 */
abstract class BaseStaticPage extends GxActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{static_page}}';
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Page|Pages', $n);
    }

    public static function representingColumn()
    {
        return 'title';
    }

    public function rules()
    {
        return array(
            array('parent_id, sorting', 'numerical', 'integerOnly'=>true),
            array('title', 'length', 'max'=>255),
            array('region', 'length', 'max'=>16),
            array('content', 'safe'),
            array('parent_id, title, content, sorting, region', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, parent_id, title, content, sorting, region', 'safe', 'on'=>'search'),
        );
    }

    public function relations()
    {
        return array(
            'parent' => array(self::BELONGS_TO, 'StaticPage', 'parent_id'),
            'pages' => array(self::HAS_MANY, 'StaticPage', 'parent_id'),
        );
    }

    public function pivotModels()
    {
        return array(
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent Page'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'sorting' => Yii::t('app', 'Sorting'),
            'region' => Yii::t('app', 'Region'),
            'parent' => null,
            'pages' => null,
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('sorting', $this->sorting);
        $criteria->compare('region', $this->region, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}