<?php

class ImageUploadAction extends CAction{
    
    public function run(){
        
       $dir_image = "assets/wysiwyg";
       if(!is_dir($dir_image)) {
                mkdir($dir_image);
       }
       
       
       $images =  CUploadedFile::getInstanceByName('file');
       
       $imagesize = getimagesize($images->getTempName());
       if(is_array($imagesize)){

                $extension = '.'.$images->getExtensionName();

                while(file_exists($filename = $dir_image.'/'.uniqid().$extension));


                $images->saveAs($filename);


                echo  CHtml::image('/'.$filename);
       }
    }
    
}
    
?>
