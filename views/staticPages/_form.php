<?
/* @var $this CController */
/* @var $module StaticPagesModule */
/* @var $model StaticPage */
/** @var $form ExtForm */
$module = Yii::app()->getModule("staticPages");
$parents = $module->possibleParents($model ? $model->id : null);
$regions = $module->possibleRegions();
?>
<div class="form">

    <?php $form = $this->beginWidget('ext.shared-core.widgets.ExtForm', array(
    'model' => $model,
    'id' => 'page-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
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

        <?if (count($regions)) { ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'region'); ?>
            <?=$form->dropdownList($model, "region", $regions)?>
            <?php echo $form->error($model, 'region'); ?>
        </div>
        <? }?>

    </fieldset>

    <?$form->inject()?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->