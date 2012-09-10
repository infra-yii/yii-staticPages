<?php
/**
 * @author alari
 * @since 7/23/12 1:04 PM
 */
class ContentEditor extends CInputWidget
{
    public function run()
    {
        $module = Yii::app()->getModule("staticPages");
        $this->widget("staticPages.widgets.redactorjs.Redactor",
            array("model" => $this->model,
                'attribute' => 'content',
                'editorOptions' => array(
                    'imageUpload' => $module->actionImageUpload,
                    'fileUpload' => $module->actionFileUpload,
                    'linkFileUpload' => $module->actionLinkFileUpload,
                ),
            ));
    }
}
