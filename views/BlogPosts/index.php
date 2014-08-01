<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;
use linchpinstudios\blog\widgets\BlogPostsWidget;
use linchpinstudios\blog\widgets\BlogCategoriesWidget;


/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\BlogPostsSearch $searchModel
 */

$this->title = 'Blog Posts';
$this->params['breadcrumbs'][] = $this->title;
?>


	<div class="container large-padding">
		<div class="row">
			<div class="col-md-8">
                <?
                   $models = $dataProvider->getModels();
                   
                   foreach($models as $m){
                       
                       echo '<div class="row"><article>';
                       //$mRender .= $this->renderThumbnail($m);
                       echo '<h3 style="margin-top:0;">' . Html::a(Html::encode($m->title), ['blogposts/view', 'id' => $m->id, 'slug' => $m->slug, 'year' => date('Y',strtotime($m->date)), 'month' => date('m',strtotime($m->date)), 'day' => date('d',strtotime($m->date))]) . '</h3>';
                       echo '
                	        <ul class="list-inline">
                	            <li><i class="glyphicon glyphicon-calendar"></i> '.date('M d, Y',strtotime($m->date)).'</li>
                	            <li><i class="glyphicon glyphicon-user"></i> '.$m->user_id.'</li>
                	            <li><i class="glyphicon glyphicon-folder-close"></i> '.$m->id.'</li>
                	            <li><i class="glyphicon glyphicon-comment"></i> Comments</li>
                	        </ul>';
                	   
                	   echo '<p>'.$m->body.'</p>';
                	   echo Html::a('Read Article',['blogposts/view', 'id' => $m->id, 'slug' => $m->slug, 'year' => date('Y',strtotime($m->date)), 'month' => date('m',strtotime($m->date)), 'day' => date('d',strtotime($m->date))],['class'=>'btn btn-success btn-xs pull-right']);
                	   echo '</div></article></div>';
                	   echo '<hr />';
                       
                   }
                ?>
			</div>
			<div class="col-md-4">
			    <?= BlogCategoriesWidget::widget(); ?>
			</div>
		</div>
	</div>