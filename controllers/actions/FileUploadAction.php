<?php

class FileUploadAction extends CAction{
    
    public function run(){
        
       $dir_image = "assets/wysiwyg";
       if(!is_dir($dir_image)) {
                mkdir($dir_image);
       }
       
       
       $file =  CUploadedFile::getInstanceByName('file');


                $extension = '.'.$file->getExtensionName();

                while(file_exists($filename = $dir_image.'/'.uniqid().$extension));


                $file->saveAs($filename);


                echo  CHtml::link($file->name, '/'.$filename);
    }
    
}
    
?>
