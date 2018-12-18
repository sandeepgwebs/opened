<?php
use frontend\widgets\FooterMenu;
use yii\helpers\Url;
?>

	
<!-- footer start-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; 2016 Website Designed by GnetWebs</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href="<?= Yii::$app->params['settings']['twitter'] ?>"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="<?= Yii::$app->params['settings']['facebook'] ?>"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="<?= Yii::$app->params['settings']['google_plus'] ?>"><i class="fa fa-google-plus"></i></a>
						<li><a href="<?= Yii::$app->params['settings']['linked_in'] ?>"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="#">Privacy Policy</a>
                        </li>
                        <li><a href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
 <!-- footer end--> 

