<?
$module = Yii::app()->getModule("staticPages");
$regions = $module->possibleRegions();
?>
<div class="wide form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
)); ?>

    <div class="row">
        <?php echo $form->label($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'region'); ?>
        <?=$form->dropdownList($model, "region", $regions)?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'path'); ?>
        <?php echo $form->textField($model, 'path'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->