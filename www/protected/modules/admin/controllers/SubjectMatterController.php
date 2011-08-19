<?php

class SubjectMatterController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow',
				'actions'=>array('view'),
				'roles'=>array('*'),
				),
			array('allow', 
				'actions'=>array('index','view', 'minicreate', 'create','update', 'admin','delete'),
				'roles'=>array('dbmanager', 'admin', 'xxx'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'SubjectMatter'),
		));
	}

	public function actionCreate() {
		$model = new SubjectMatter;
    $model->created = date('Y-m-d H:i:s');
    $model->modified = date('Y-m-d H:i:s');
    
		$this->performAjaxValidation($model, 'subject-matter-form');

		if (isset($_POST['SubjectMatter'])) {
			$model->setAttributes($_POST['SubjectMatter']);
			$relatedData = array(
				'imageSets' => $_POST['SubjectMatter']['imageSets'] === '' ? null : $_POST['SubjectMatter']['imageSets'],
				'users' => $_POST['SubjectMatter']['users'] === '' ? null : $_POST['SubjectMatter']['users'],
				);

			if ($model->saveWithRelated($relatedData)) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'SubjectMatter');
    $model->modified = date('Y-m-d H:i:s');
		$this->performAjaxValidation($model, 'subject-matter-form');

		if (isset($_POST['SubjectMatter'])) {
			$model->setAttributes($_POST['SubjectMatter']);
			$relatedData = array(
				'imageSets' => $_POST['SubjectMatter']['imageSets'] === '' ? null : $_POST['SubjectMatter']['imageSets'],
				'users' => $_POST['SubjectMatter']['users'] === '' ? null : $_POST['SubjectMatter']['users'],
				);

			if ($model->saveWithRelated($relatedData)) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'SubjectMatter')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$model = new SubjectMatter('search');
    $model->unsetAttributes();

    if (isset($_GET['SubjectMatter']))
      $model->setAttributes($_GET['SubjectMatter']);

    $this->render('admin', array(
      'model' => $model,
    ));
	}

	public function actionAdmin() {
		$model = new SubjectMatter('search');
		$model->unsetAttributes();

		if (isset($_GET['SubjectMatter']))
			$model->setAttributes($_GET['SubjectMatter']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}