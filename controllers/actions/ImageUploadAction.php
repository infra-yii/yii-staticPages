<?php

Yii::import("staticPages.controllers.actions.UploadAction");

class ImageUploadAction extends UploadAction
{
    public function run()
    {
        $file = CUploadedFile::getInstanceByName('file');
        if (getimagesize($file->getTempName())) {
            $path = $this->getUniquePath($this->filesDir(), $file->extensionName);
            if (Yii::app()->hasComponent("imagine") && $uploadSize = Yii::app()->getModule("staticPages")->uploadImageSize) {
                /* @var $imagine ImagineYii */
                $imagine = Yii::app()->imagine;
                $imagine->handleAndSave($file->tempName, $uploadSize, $path);
            } else {
                $file->saveAs($path);
            }
            echo  CHtml::image("http://" . $_SERVER["HTTP_HOST"] . '/' . $path);
        }
    }
}