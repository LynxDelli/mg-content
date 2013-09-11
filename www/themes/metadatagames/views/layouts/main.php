<?php $this->beginContent('//layouts/page'); ?>
<div id="header">
  <a id="page_title" class="ir" href="<?php echo MGHelper::bu("/"); ?>"><?php CHtml::encode(Yii::app()->fbvStorage->get("settings.app_name")); ?></a>
  <div id="mainmenu">
  <?php $this->widget('application.components.MGMenu',array(
    'items'=>array(
      /*array('label'=>'Home', 'url'=>array('/site/index')),*/
      /*array('label'=>'Contact', 'url'=>array('/site/contact')),*/
      array('url'=>Yii::app()->getModule('user')->loginUrl, 'label'=>Yii::app()->getModule('user')->t("Login"), 'visible'=>Yii::app()->user->isGuest),
      /*array('url'=>Yii::app()->getModule('user')->registrationUrl, 'label'=>Yii::app()->getModule('user')->t("Register"), 'visible'=>Yii::app()->user->isGuest),*/
      array('url'=>array('/admin'), 'label'=>Yii::t('app', 'Admin'), 'visible'=>Yii::app()->user->checkAccess(EDITOR)),
      array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest),
      array('url'=>Yii::app()->getModule('user')->logoutUrl, 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest)
    ),
    
  )); 
  ?></div><!-- mainmenu -->

  <div id="usersonline">
  <!-- Stubbing in code for number of users online -->
<?php
// 2013-04-07 - qubit - Disable user counter by default (mostly disabled in many builds)
// Properly initialize the values in the counter.
//Yii::app()->counter->refresh();
//
//$num = Yii::app()->counter->getOnline();
//echo "<span>There " . ($num == 1 ? "is" : "are") . " $num user" .
//  ($num == 1 ? "" : "s") . " online.</span>";
?>
  </div><!-- usersonline -->
</div>

<div class="container" id="page">
  
  <?php if(isset($this->breadcrumbs)):?>
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
      /*'homeLink' =>CHtml::link(Yii::t('app', 'Home'), "/"),*/
      'links'=>$this->breadcrumbs,
    )); ?><!-- breadcrumbs -->
  <?php endif?>
  <?php $this->widget('application.extensions.yii-flash.Flash', array(
    'keys'=>array('success', 'warning','error'), 
    'htmlOptions'=>array('class'=>'flash'),
  )); ?><!-- flashes -->

  <?php echo $content; ?>

  <div id="footer">
    &copy; <?php echo date('Y'); ?> <a href="http://www.tiltfactor.org/">tiltfactor</a>, all rights reserved
  </div><!-- footer -->

</div><!-- page -->
<?php $this->endContent(); ?>