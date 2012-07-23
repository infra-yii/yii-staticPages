<?php
/**
 * @author alari
 * @since 7/23/12 1:36 PM
 */
abstract class UploadAction extends CAction
{
    protected function imagesDir()
    {
        return $this->getDir(__FUNCTION__);
    }

    protected function filesDir()
    {
        return $this->getDir(__FUNCTION__);
    }

    protected function linkFilesDir()
    {
        return $this->getDir(__FUNCTION__);
    }

    protected function getUniquePath($dir, $ext)
    {
        $ext = '.' . $ext;
        while (file_exists($filename = $dir . '/' . uniqid() . $ext)) ;
        return $filename;
    }

    private function getDir($name)
    {
        $dir = Yii::app()->getModule("staticPages")->$name;
        $this->checkDir($dir);
        return $dir;
    }

    private function checkDir($dir)
    {
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    }
}
