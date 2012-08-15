<?
    $parents = Yii::app()->getModule("staticPages")->possibleParents($model ? $model->id : null);
    $regions = Yii::app()->getModule("staticPages")->possibleRegions();
    $additionalFields = Yii::app()->getModule("staticPages")->model()->additionalFields();
?>
<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'page-form',
    'enableAjaxValidation' => false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'content'); ?>
        <?$this->widget("staticPages.widgets.staticPages.ContentEditor", array("model" => $model))?>
        <?php echo $form->error($model, 'content'); ?>
    </div>

    <fieldset>

        <div class="row">
            <?php echo $form->labelEx($model, 'parent_id'); ?>
            <?=$form->dropdownList($model, "parent_id", $parents)?>
            <?php echo $form->error($model, 'parent_id'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'in_main_menu'); ?>
            <?=$form->checkBox($model, "in_main_menu")?>
            <?php echo $form->error($model, 'in_main_menu'); ?>
        </div>

        <?if(count($regions)) {?>
        <div class="row">
            <?php echo $form->labelEx($model, 'region'); ?>
            <?=$form->dropdownList($model, "region", $regions)?>
            <?php echo $form->error($model, 'region'); ?>
        </div>
        <?}?>

        <?foreach($additionalFields as $k=>$v){?>
        <div class="row">
            <?php echo $form->labelEx($model, $k); ?>
            <?php echo $form->$v($model, $k); ?>
            <?php echo $form->error($model, $k); ?>
        </div>
        <?}?>

    </fieldset>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->