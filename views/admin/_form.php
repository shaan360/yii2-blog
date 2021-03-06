<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use linchpinstudios\datetimepicker\DateTime;
use dosamigos\tinymce\TinyMce;
use yii\helpers\ArrayHelper;
use linchpinstudios\filemanager\widgets\FileSelect;

/**
 * @var yii\web\View $this
 * @var linchpinstudios\blog\models\BlogPosts $model
 * @var yii\widgets\ActiveForm $form
 */

$tfArray = [
    '1' => 'Enabled',
    '0' => 'Disabled',
]

?>

<div class="blog-posts-form">

    <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Blog Post</strong></div>
                    <div class="panel-body">

                        <?= $form->field($model, 'title')->textInput(['maxlength' => 555]) ?>

                        <?= $form->field($model, 'thumbnail')->widget(FileSelect::className(),[
                            'clientOptions' => [],
                        ])
                        /*$form->field($model, 'thumbnail')->textInput(['maxlength' => 555])
                         $form->field($model, 'thumbnail')->widget(Fileupload::className(), [
                            'clientOptions' => [

                            ],
                        ]); */?>

                        <?= $form->field($model, 'body')->widget(TinyMce::className(), [
                            'options' => ['rows' => 25],
                            'clientOptions' => [
                                'relative_urls' => false,
                                'plugins' => [
                                    "advlist autolink lists link charmap print preview anchor",
                                    "searchreplace visualblocks code fullscreen image",
                                    "insertdatetime media table contextmenu paste filemanager"
                                ],
                                'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image filemanager"
                            ]
                        ]); ?>


                        <?= $form->field($model, 'excerpt')->textarea(['rows' => 6]) ?>


                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Settings</strong></div>
                    <div class="panel-body">
                        <?= $form->field($model, 'user_id')->dropDownList($model->authorList) ?>

                        <?= $form->field($model, 'status')->dropDownList($tfArray) ?>

                        <?= $form->field($model, 'comments')->dropDownList($tfArray) ?>

                        <?= $form->field($model, 'date')->widget(DateTime::className(), ['options' => ['class' => 'form-control']]) ?>

                        <?= $form->field($model, 'slug')->textInput(['maxlength' => 45]) ?>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Categories</strong>
                        <?= Html::a('<i class="glyphicon glyphicon-plus-sign"></i> Add', ['#'], ['class' => 'pull-right', 'data-toggle' => 'modal', 'data-target' => '#myModal']) ?>
                    </div>
                    <div class="panel-body">

                        <div class="categories-wrapper">
                            <?php
                                $availableCategories = ArrayHelper::map($categories, 'id', 'name');
                                $preselectedOptions = ArrayHelper::map(ArrayHelper::toArray($model->terms), 'id', 'term_id');
                            ?>
                            <?= Html::checkboxList('categories',$preselectedOptions,$availableCategories,['id' => 'categories-con']) ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>





<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Tag</h4>
      </div>
      <?php
          $form = ActiveForm::begin([
              'action'                    => ['blogterms/createcategory'],
              'enableAjaxValidation'      => false,
              'enableClientValidation'    => true,
              'id'                        => 'create_category',
          ]);
      ?>
          <div class="modal-body">
              <?= $form->field($terms, 'name')->textInput(['maxlength' => 255]) ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <?= Html::submitButton('<i class="glyphicon glyphicon-plus-sign"></i> Create', ['class' => 'btn btn-success', 'id' => 'create-category']) ?>
          </div>
          <?php ActiveForm::end(); ?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
