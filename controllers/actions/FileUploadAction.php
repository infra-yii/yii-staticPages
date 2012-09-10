<?php

Yii::import("staticPages.controllers.actions.UploadAction");

class FileUploadAction extends UploadAction
{

    public function run()
    {
        $file = CUploadedFile::getInstanceByName('file');
        $path = $this->getUniquePath($this->filesDir(), $file->extensionName);
        $file->saveAs($path);

        echo  CHtml::link($file->name, "http://" . $_SERVER["HTTP_HOST"] . '/' . $path);
    }

}
