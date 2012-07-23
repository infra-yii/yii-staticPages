<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo $data->link() ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('parent_id')); ?>:</b>
    <?php echo CHtml::encode($data->parent_id); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
    <?php echo CHtml::encode($data->title); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
    <?php echo CHtml::encode($data->content); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('sorting')); ?>:</b>
    <?php echo CHtml::encode($data->sorting); ?>
    <br/>


</div>