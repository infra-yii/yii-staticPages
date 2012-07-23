<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'page-form',
    'enableAjaxValidation' => false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'parent_id'); ?>
        <?php echo $form->textField($model, 'parent_id'); ?>
        <?php echo $form->error($model, 'parent_id'); ?>
    </div>

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

    <div class="row">
        <?php echo $form->labelEx($model, 'sorting'); ?>
        <?php echo $form->textField($model, 'sorting'); ?>
        <?php echo $form->error($model, 'sorting'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->