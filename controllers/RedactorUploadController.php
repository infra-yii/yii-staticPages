<?php
/**
 * Created by IntelliJ IDEA.
 * User: alari
 * Date: 7/23/12
 * Time: 12:55 PM
 * To change this template use File | Settings | File Templates.
 */
class RedactorUploadController extends Controller
{
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // upload images for wysiwyg
            'imageUpload' => array(
                'class' => 'staticPages.controllers.actions.ImageUploadAction',
            ),
            'fileUpload' => array(
                'class' => 'staticPages.controllers.actions.FileUploadAction',
            ),
            'linkFileUpload' => array(
                'class' => 'staticPages.controllers.actions.LinkFileUploadAction',
            ),
        );
    }
}
