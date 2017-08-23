
<div class="site-contact">
    <h1>图片上传</h1>

        <div class="row">
            <div class="col-lg-5">

			<?php 
			    use yii\widgets\ActiveForm;
				use yii\helpers\Html;
			?>
	
			<?php $form = ActiveForm::begin([‘options’ => ['enctype' => 'multipart/form-data']]) ?>

			<?= $form->field($model, ‘file’)->fileInput() ?>

			<button>Submit</button>

			<?php ActiveForm::end() ?>
       

            </div>
			<div class="row">
			<?php if($data->url) { ?>
			<?php echo CHtml::image($data->url,'',array('width'=>'800px','height'=>'800px')); ?>
			<?php }?>
			</div>
        </div>

</div>
