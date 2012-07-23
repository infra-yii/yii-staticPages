<?php

Yii::import("staticPages.controllers.actions.UploadAction");

class ImageUploadAction extends UploadAction
{
    public function run()
    {
        $file = CUploadedFile::getInstanceByName('file');
        if (getimagesize($file->getTempName())) {
            $path = $this->getUniquePath($this->filesDir(), $file->extensionName);
            $file->saveAs($path);
            echo  CHtml::image('/' . $path);
        }
    }
}