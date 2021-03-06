<?php

/**
 * @var $form kartik\widgets\ActiveForm
 * @var $model cinghie\articles\models\Categories
 * @var $this yii\web\View
 */

use cinghie\articles\models\Categories;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\Html;

// Load Articles Assets
cinghie\articles\assets\ArticlesAsset::register($this);

?>

<div class="categories-form">

    <?php $form = ActiveForm::begin([
		'options' => [
			'enctype'=>'multipart/form-data'
		],
	]) ?>
	
        <div class="row">

            <div class="col-lg-12">

                <div class="bs-example bs-example-tabs">

                    <div class="row">

                        <div class="col-md-6">

                            <!-- Tab Control -->
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active">
                                    <a data-toggle="tab" href="#item">
                                        <?= Yii::t('articles', 'Category') ?>
                                    </a>
                                </li>
                                <li class="">
                                    <a data-toggle="tab" href="#seo">
                                        <?= Yii::t('traits', 'SEO') ?>
                                    </a>
                                </li>
                                <li class="">
                                    <a data-toggle="tab" href="#image">
                                        <?= Yii::t('traits', 'Image') ?>
                                    </a>
                                </li>
	                            <?php if(Yii::$app->controller->module->advancedTranslation): ?>
                                    <li class="">
                                        <a data-toggle="tab" href="#translations">
				                            <?= Yii::t('traits', 'Translations') ?>
                                        </a>
                                    </li>
	                            <?php endif ?>
                                <li class="">
                                    <a data-toggle="tab" href="#params">
                                        <?= Yii::t('traits', 'Options') ?>
                                    </a>
                                </li>
                            </ul>

                        </div>

                        <div class="col-md-6">

                            <?= $model->getExitButton() ?>

                            <?= $model->getCancelButton() ?>

                            <?= $model->getSaveButton() ?>

                        </div>

                    </div>

                    <!-- Tab Contents -->
                    <div class="tab-content" id="myTabContent">

                        <!-- Item -->
                        <div id="item" class="row tab-pane fade active in">

                            <div class="separator"></div>

                            <div class="col-md-4">

                                <?= $model->getNameWidget($form) ?>

                                <?= $model->getAccessWidget($form) ?>

                            </div> <!-- col-md-4 -->

                            <div class="col-md-4">

	                            <?= $model->getParentWidget($form,$model->getCategoriesSelect2()) ?>

                                <?= $model->getLanguageWidget($form) ?>

                            </div> <!-- col-md-4 -->

                            <div class="col-md-4">

	                            <?= $model->getOrderingWidget($form,Categories::class, 'parent_id',['ordering','name'], ['parent_id' => $model->parent_id, 'language' => $model->language])?>

                                <?= $model->getStateWidget($form) ?>

                                <?= $form->field($model, 'theme')->widget(Select2::class, [
                                    'data' => $model->getThemesSelect2(),
                                    'addon' => [
                                        'prepend' => [
                                            'content'=>'<i class="glyphicon glyphicon-blackboard"></i>'
                                        ]
                                    ],
                                ]) ?>

                            </div> <!-- col-md-4 -->

                            <div class="col-md-12">

                                <?= $model->getEditorWidget($form,'description') ?>

                            </div> <!-- col-md-12 -->

                        </div> <!-- #item -->

                        <!-- SEO -->
                        <div id="seo" class="row  tab-pane fade">

                            <div class="separator"></div>

                            <div class="col-lg-5">

                                <?= $model->getAliasWidget($form) ?>

                                <?= $model->getRobotsWidget($form) ?>

                                <?= $model->getAuthorWidget($form) ?>

                                <?= $model->getCopyrightWidget($form) ?>

                            </div> <!-- col-lg-5 -->

                            <div class="col-lg-7">

                                <?= $model->getMetaDescriptionWidget($form) ?>

                                <?= $model->getMetaKeyWidget($form) ?>

                            </div> <!-- col-lg-7 -->

                        </div> <!-- #seo -->

                        <!-- Image -->
                        <div id="image" class="row tab-pane fade">

                            <div class="separator"></div>

                            <div class="col-lg-12">

                                <p class="bg-info">
                                    <?= Yii::t('traits', 'Allowed Extensions') . ': ' . implode( ', ',$model->getImagesAllowed()) ?>
                                    (<?= Yii::t('traits', 'Max Size') . ': ' . $model->getUploadMaxSize() ?>)
                                </p>

                            </div> <!-- col-lg-12 -->

                            <div class="col-lg-6">

                                <?= $model->getImageWidget()  ?>

                            </div> <!-- col-lg-6 -->

                            <div class="col-lg-6">

                                <?= $model->getImageCaptionWidget($form) ?>

                                <?= $model->getImageCreditsWidget($form) ?>

                            </div> <!-- col-lg-6 -->

                        </div> <!-- #image -->

                        <!-- Translations -->
	                    <?php if(Yii::$app->controller->module->advancedTranslation): ?>

                            <div id="translations" class="row tab-pane fade">

			                    <?php

			                    foreach (Yii::$app->controller->module->languages as $langTag):

				                ?>

				                <?php

				                    $lang = substr($langTag,0,2);

				                    $selectName  = 'translation_'.$lang;
				                    $titleName   = 'name_'.$lang;
				                    $aliasName   = 'alias_'.$lang;
				                    $description = 'description_'.$lang;

				                    if($model->language !== $lang && $langTag !== Yii::$app->controller->module->languageAll):

					                    ?>

                                        <div class="col-md-6 col-sm-12">

                                            <div class="row">

                                                <div class="col-md-6">

                                                    <h2><?= Yii::t('traits','Translation') ?> <?= $langTag ?></h2>

                                                </div>

                                                <div class="col-md-6">

                                                    <label class="control-label"></label>

                                                    <div class="form-group">

                                                        <div class="input-group">

										                    <?= Select2::widget([
											                    'name' => $selectName,
											                    'data' => $model->getCategoriesLangSelect2($lang),
											                    'disabled' => true
										                    ]) ?>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group">

                                                        <label class="control-label"><?= Yii::t('traits','Name') ?></label>

                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
										                    <?= Html::textInput($titleName, $model->getFieldTranslation($lang,'name'), ['class' => 'form-control']) ?>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group">

                                                        <label class="control-label"><?= Yii::t('traits','Alias') ?></label>

                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
										                    <?= Html::textInput($aliasName, $model->getFieldTranslation($lang,'alias'), ['class' => 'form-control']) ?>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-md-12">

                                                    <div class="form-group">

                                                        <label class="control-label"><?= Yii::t('articles','Description') ?></label>

									                    <?= $model->getEditorWidget(null, $description, '', $model->getFieldTranslation($lang,'description')) ?>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

				                    <?php endif ?>

			                    <?php endforeach ?>

                            </div> <!-- #translations -->

	                    <?php endif ?>

                        <!-- Params -->
                        <div id="params" class="row tab-pane fade">

                            <div class="separator"></div>

                            <?= $this->render('_form_params') ?>

                        </div> <!-- #params -->

                    </div> <!-- tab-content -->

                </div> <!-- bs-example -->

            </div> <!-- col-lg-12 -->

        </div> <!-- row -->

    <?php ActiveForm::end() ?>

</div>
