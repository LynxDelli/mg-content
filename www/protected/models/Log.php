<?php

Yii::import('application.models._base.BaseLog');

class Log extends BaseLog
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
  
  public static function label($n = 1) {
    return Yii::t('app', 'Admin Log Entry|Admin Logs', $n);
  }
  
  /**
   * Provides the search CActiveDataProvider for the admin tools grid view
   * 
   * @return CActiveDataProvider
   */
  public function search() {
    $criteria = new CDbCriteria;

    $criteria->compare('id', $this->id);
    $criteria->compare('category', $this->category, true);
    $criteria->compare('message', $this->message, true);
    $criteria->compare('user_id', $this->user_id);
    $criteria->compare('created', $this->created, true);
    
    
    if (!Yii::app()->getRequest()->getIsAjaxRequest())
      $criteria->order = "created DESC";
    
    
    return new CActiveDataProvider($this, array(
      'criteria' => $criteria,
      'pagination'=>array(
        'pageSize'=> 100,
      ),
    ));
  }
  
  public function canDelete() {
    return Yii::app()->user->checkAccess(ADMIN);
  }
} 
