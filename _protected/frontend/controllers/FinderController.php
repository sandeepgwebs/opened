<?php
namespace frontend\controllers;
use yii\helpers\Url;
use common\models\User;
use common\models\LoginForm;
use common\models\Pages;
use common\models\Newsletter;
use common\models\Product;
use common\models\Cart;
use common\models\VarientProduct;
use common\models\ProductCatRel;
use common\models\Review;
use common\models\ProductImages;
use common\models\ProductPageSetting;
use common\models\ProductDropdownValues;
use common\models\Category;
use common\models\Wishlist;
use common\models\ProductTextValues;
use common\models\ProductDescValues;
use common\models\DropdownValues;
use common\models\Attributes;
use frontend\models\AccountActivation;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SearchForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\helpers\Html;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use yii\web\Response;
/**
 * Site controller.
 * It is responsible for displaying static pages, logging users in and out,
 * sign up and account activation, password reset.
 */
class FinderController extends Controller
{
    /**
     * Returns a list of behaviors that this component should behave as.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Declares external actions for the controller.
     *
     * @return array
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

//------------------------------------------------------------------------------------------------//
// STATIC PAGES
//------------------------------------------------------------------------------------------------//


	public function actionCategory($slug){
			$this->layout="category";
			$productimage = new ProductImages();
			$wishlist = new Wishlist();
			$cat = Category::find()->where(['slug' =>$slug])->one();
			if(!$cat){
				throw new NotFoundHttpException('The requested page does not exist.');
			}
			$parents_cat = $cat->parents()->asArray()->all();
			$count = 0;
			$menu_breadrumbs = array();

			foreach($parents_cat as $parent_cat){
				$menu_breadrumbs[$count]['id']=$parent_cat['id'];
				$menu_breadrumbs[$count]['name']=$parent_cat['name'];
				$menu_breadrumbs[$count]['link']= Url::to(['finder/category','slug'=>$parent_cat['slug'],'main'=>$parent_cat['slug']]);
				$count++;
			}
			
			$menu_breadrumbs[$count]['id']=$cat->id;
			$menu_breadrumbs[$count]['name']=$cat->name;
			$menu_breadrumbs[$count]['link']= Url::to(['finder/category','slug'=>$cat->slug]);
			
			$prods = Product::find()->where(["status" => 1,])->orderBy(["id"=> SORT_DESC ])->all();
			$cat_child = $cat->children()->all();
			$ids = array();
			$widths = array();	
			$colors = array();	
			$sizes = array();
			if($cat_child){
				
				foreach($cat_child as $categ){
					if($categ->status == 1)
						$ids[] = $categ->id;
				}
				
				$prods = ProductCatRel::find()->select('product_id')->where(["cat_id" => $ids])->orderBy(["id"=> SORT_DESC ])->all();
				$proids = array();
				foreach($prods as $prodsid){
					$imagedata = $productimage->find()->where(['product_id' => $prodsid])->one();
					if($imagedata->flip_image)
						$proids[$prodsid->product_id] = $prodsid->product_id;
				}
				$searchvarient = VarientProduct::find()->where(['product_id'=>$proids,'status'=>1])->all();	
				$varients = array();
				$i = 0;

				foreach($searchvarient as $varient){
					$qnt = $varient->quantity;
					if($qnt < 1){
						unset($proids[$searchvarient->product_id]);
						continue;
					}
						
					
					if($varient->color == ''){
						unset($proids[$searchvarient->product_id]);
						continue;
					}	
					if($varient->width0->displayname == ''){
						//unset($proids[$searchvarient->product_id]);
						continue;
					}
					if($varient->size0->displayname == ''){
						//unset($proids[$searchvarient->product_id]);
						continue;
					}
					
					$widths[$varient->width0->id] = $varient->width0->displayname;
					$colors[$varient->color0->id] = $varient->color0->displayname;
					$sizes[$varient->size0->id] = $varient->size0->displayname;
				}	
		
				
			}else{
				$prods = ProductCatRel::find()->select('product_id')->where(["cat_id" => $cat->id ])->orderBy(["id"=> SORT_DESC ])->all();
				$proids = array();
				foreach($prods as $prodsid){
					$imagedata = $productimage->find()->where(['product_id' => $prodsid])->one();
					if($imagedata->flip_image)						
						$proids[$prodsid->product_id] = $prodsid->product_id;
				}
				$searchvarient = VarientProduct::find()->where(['product_id'=>$proids,'status'=>1])->all();	
				$varients = array();
				$i = 0;

				foreach($searchvarient as $varient){
					$qnt = $varient->quantity;
					if($qnt < 1){
						unset($proids[$searchvarient->product_id]);
						continue;
					}
						
					
					if($varient->color == ''){
						unset($proids[$searchvarient->product_id]);
						continue;
					}	
					if($varient->width0->displayname == ''){
						//unset($proids[$searchvarient->product_id]);
						continue;
					}
					if($varient->size0->displayname == ''){
						//unset($proids[$searchvarient->product_id]);
						continue;
					}				
					$widths[$varient->width0->id] = $varient->width0->displayname;
					$colors[$varient->color0->id] = $varient->color0->displayname;
					$sizes[$varient->size0->id] = $varient->size0->displayname;
				}	
				
			}
			$prod_model = Product::find()->where(["status" => 1,'id' => $proids ])->orderBy(["id"=> SORT_DESC ])->all();
			
			$prod_model_min = Product::find()->select('MIN(price) as min_price, Max(price) as max_price')->where(["status" => 1,'id' => $proids ])->orderBy(["id"=> SORT_DESC ])->asArray()->all();
			$min_price = 0;
			$max_price = 15000;
			if($prod_model_min){
				$min_price = preg_replace('~\.0+$~','',$prod_model_min[0]['min_price']);
				$max_price = preg_replace('~\.0+$~','',$prod_model_min[0]['max_price']);
			}

		asort($widths);
		asort($colors);
		asort($sizes);
		 $wishlist_products = array();	
		 if(!Yii::$app->user->isGuest){
            $user_id = Yii::$app->user->identity->id;		
			$wishlist = Wishlist::find()->where(['client_id'=> $user_id])->one();	
			if($wishlist)
				$wishlist_products = unserialize($wishlist->products);	
		}
		return $this->render('/site/category', [
           'products' => $prod_model,
           'wishlist' => $wishlist,
           'productimage' => $productimage,
           'category' => $cat,
           'slug' => $slug,
           'widths' => $widths,
           'colors' => $colors,
           'min_price' => $min_price,
           'max_price' => $max_price,
           'sizes' => $sizes,
           'wishlist_products' => $wishlist_products,
           'breadrumbs' => $menu_breadrumbs,
        ]);
	}
	public function actionSearch(){
		$request = Yii::$app->request;
        if ($request->isAjax) {
            $searchevent = Yii::$app->request->post('searchevent');
			$models = Product::find()->where(['like', 'name', $searchevent])->orWhere(['like', 'descr', $searchevent])->orWhere(['like', 'article_id', $searchevent])->limit(5)->orderBy(['updated_at' => SORT_DESC, ])->all();
			$data = array();
			foreach($models as $model){
				$data[$model->id]['link']= Url::to(['men/product','slug'=>$model->slug]);
				$data[$model->id]['name']= $model->name;
			}
			return json_encode($data);
        } 
	}
	public function actionProductSearch(){
		$this->layout="category";
		$model = new SearchForm();
		$product_model = new Product();
		$request = Yii::$app->request;
		$dropdown = new DropdownValues();
		if ($request->isAjax) {	
			$products = array();
			$productimage = new ProductImages();
			
			$query = Product::find()->innerJoinWith('varientProducts')->innerJoinWith('productCatRel', 'product.id = product_cat_rel.product_id')->innerJoinWith('productImages', 'product.id = product_images.product_id');
			
			$search = Yii::$app->request->post('search');
			if($search != ''){

				$query->andWhere(['like', 'product.name', $search])->orWhere(['like', 'product.descr', $search])->orWhere(['like', 'product.article_id', $search]);
			}		
			
			$query->andWhere(['<>','product_images.flip_image' ,'']);	
			$query->andWhere(['<>','product_images.flip_image1' ,'']);	
			$query->andWhere(['<>','varient_product.status' ,0]);
			if(Yii::$app->request->post('color') != ""){
				$query->andWhere(['varient_product.color' => (int)Yii::$app->request->post('color')]);	
			}
			if(Yii::$app->request->post('cat_id') != ""){
				$cat_all = Category::findOne(Yii::$app->request->post('cat_id'));
				$cat_subchild = $cat_all->children()->all();

				$cat_ids = array();
				if($cat_subchild){
					foreach($cat_subchild as $cat_subchild1){
						$cat_ids[] = $cat_subchild1->id;
					}
					$query->andWhere(['product_cat_rel.cat_id' => $cat_ids ]);	
				}else{
					$query->andWhere(['product_cat_rel.cat_id' => $cat_all->id ]);	
				}	
			}
			if(Yii::$app->request->post('size') != ""){
				$query->andWhere(['varient_product.size' => (int)Yii::$app->request->post('size')]);	
			}
			if(Yii::$app->request->post('width') != ""){
				$query->andWhere(['varient_product.width' => (int)Yii::$app->request->post('width') ]);	
			}
			if(Yii::$app->request->post('min_price') != ""){
				$query->andWhere(['>=','product.price' ,(int)Yii::$app->request->post('min_price')]);	
			}
			if(Yii::$app->request->post('max_price') != ""){
				$query->andWhere(['<=','product.price' ,(int)Yii::$app->request->post('max_price')]);	
			}	
			
			$query->andWhere(['product.status' => 1]);	
			

				
			if(Yii::$app->request->post('sortby') != ""){

				if(Yii::$app->request->post('sortby') == 3){
					$query->orderBy([
						'product.price'=>SORT_DESC,
					]);

				}else{
					$query->orderBy([
						'product.price'=>SORT_ASC,
					]);				
				}	
			}else{
				$query->orderBy([
					'product.id'=>SORT_DESC,
				]);	
			}

			$data = array();
			$products = $query->distinct()->asArray()->all();

			$i = 0;
			foreach($products as $product){ 

				$slug = $product['slug'];
				$id = $product['id'];
				$name = $product['name'];
				$price = $product['price'];
				$flip_image = $product['productImages']['flip_image'];
				$flip_image1 = $product['productImages']['flip_image1'];
				$data[$i]['div'] = '<div class="col-lg-3 col-sm-4 col-md-4 col-xs-12 braided-flip">
							<a href="'.Url::to(["men/product","slug"=>$slug ]) . '">
							   <div class="braided-main">
								  <div class="braided-img">
									 <ul class="braided-heart">
										<li>
										   <svg enable-background="new 0 0 128 128" id="Layer_1" version="1.1" viewBox="0 0 128 128" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
											  <circle cx="89" cy="101" fill="none" r="8" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4"/>
											  <circle cx="49" cy="101" fill="none" r="8" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4"/>
											  <path d="  M29,33h83.0800705c2.8071136,0,4.7410736,2.8159065,3.7333832,5.4359169L99.8765564,79.8718338  C98.6882782,82.9613724,95.7199707,85,92.4097977,85H45.6081238c-3.8357391,0-7.1316795-2.722496-7.8560524-6.4892197L29,33z" fill="none" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4"/>
											  <path d="  M28.9455147,33.0107765l-1.5162468-7.5799599C26.6812878,21.6915436,23.3980236,19,19.5846729,19h-7.2409086" fill="none" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4"/>
											  <line fill="none" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4" x1="89.9039841" x2="92.9041901" y1="45" y2="45"/>
											  <line fill="none" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4" x1="32" x2="80.9041901" y1="45" y2="45"/>
										   </svg>
										</li>
										<li><i class="fa fa-heart-o"></i></li>
									 </ul>
									 <div class="card effect__hover">
										<div class="card__front">
										   <span class="card__text"><img src="'.Yii::$app->params['baseurl'].'/uploads/product/flip/'. $id .'/medium/'. $flip_image .'" class="img-responsive" alt="'.$name.'" title="'.$name.'"></span>
										</div>
										<div class="card__back">
										   <span class="card__text"><img src="'. Yii::$app->params['baseurl'] .'/uploads/product/flip1/'. $id .'/medium/'. $flip_image1 .'" class="img-responsive" alt="'.$name.'" title="'.$name.'"></span>
										</div>
									 </div>  
									 <!-- /card -->	
								  </div>
								  <div class="braided-text">
									 <p>'. $name .'</p>
									 <p class="red-color"> <i class="fa fa-inr"></i>'. $price .'</p>
								  </div>
							   </div>
							</a>
						 </div>';
				$i++;
			}
			return json_encode($data);
			
		}
		if ($model->load(Yii::$app->request->get()) && $model->validate()) {
			
			$products = array();
			$dropids = array();
			$productimage = new ProductImages();
			if($model->search){
				$dropdownvalues = DropdownValues::find()->select('id')->where(['like','displayname',$model->search])->asArray()->all();
				if($dropdownvalues){
					foreach($dropdownvalues as $dropvalue){
						$dropids[] = $dropvalue['id'];
					}
				}

			}

			$query = Product::find()->innerJoinWith('varientProducts')->innerJoinWith('productCatRel', 'product.id = product_cat_rel.product_id')->innerJoinWith('productImages', 'product.id = product_images.product_id');

			if(count($dropids)){
				$query->innerJoinWith('productDropdownValues', 'product.id = product_dropdown_values.product_id');
			}
			if($model->search){
				if(count($dropids)){
					$query->andWhere(['like', 'product.name', $model->search])->orWhere(['like', 'product.descr', $model->search])->orWhere(['like', 'product.article_id', $model->search])->orWhere(['like', 'product.article_id', $model->search])->orWhere(['like', 'product_dropdown_values.value_id', $dropids])->orWhere(['like', 'varient_product.color', $dropids]);
				}else{
					
					$query->andWhere(['like', 'product.name', $model->search])->orWhere(['like', 'product.descr', $model->search])->orWhere(['like', 'product.article_id', $model->search])->orWhere(['like', 'product.article_id', $model->search]);
				}
				
			}
			
			$query->andWhere(['<>','product_images.flip_image' ,'']);	
			$query->andWhere(['<>','product_images.flip_image1' ,'']);	
			$query->andWhere(['<>','varient_product.status' ,0]);		
			$query->andWhere(['product.status' => 1]);					

			$query->orderBy([
				'product.id'=>SORT_DESC,
			]);	

			$products1 = $query->distinct()->asArray()->all();

			
			$widths = array();	
			$colors = array();	
			$sizes = array();
				
			foreach($products1 as $prodsid){
				$proids[$prodsid['id']] = $prodsid['id'];
			}				

				$searchvarient = VarientProduct::find()->where(['product_id'=>$proids,'status'=>1])->all();	
			
				$varients = array();
				$i = 0;
				
			if(count($searchvarient) > 0){
				foreach($searchvarient as $varient){
					
					$qnt = $varient->quantity;
					
					if($qnt < 1){
						unset($proids[$searchvarient->product_id]);
						continue;
					}
							
					
					if($varient->color == ''){
						unset($proids[$searchvarient->product_id]);
						continue;
					}	
					if($varient->width0->displayname != '' && $varient->width0->status == 0 ){
						unset($proids[$searchvarient->product_id]);
						continue;
					}
					
					if($varient->size0->displayname != '' && $varient->size0->status == 0 ){
						unset($proids[$searchvarient->product_id]);
						continue;
					}	
					
					if($varient->color0->status == 0){
						unset($proids[$searchvarient->product_id]);
						continue;
					}

					
					$widths[$varient->width0->id] = $varient->width0->displayname;
					$colors[$varient->color0->id] = $varient->color0->displayname;
					$sizes[$varient->size0->id] = $varient->size0->displayname;
				}	
			}

				
			$prod_model_min = Product::find()->select('MIN(price) as min_price, Max(price) as max_price')->where(["status" => 1,'id' => $proids ])->orderBy(["price"=> SORT_ASC ])->asArray()->all();
			
			$products = Product::find()->where(["status" => 1,'id' => $proids ])->orderBy(["id"=> SORT_DESC ])->all();

			$min_price = 0;
			$max_price = 15000;
			if($prod_model_min){
				$min_price = preg_replace('~\.0+$~','',$prod_model_min[0]['min_price']);
				$max_price = preg_replace('~\.0+$~','',$prod_model_min[0]['max_price']);
			}
			asort($widths);
			asort($colors);
			asort($sizes);	

			return $this->render('/site/search', [
		   'search'=> $model->search,
           'dropdown' => $dropdown,
           'product_model' => $product_model,
           'products' => $products,
           'productimage' => $productimage,
           'min_price' => $min_price,
           'max_price' => $max_price,
           'search' => $search,
		   
           'widths' => $widths,
           'colors' => $colors,
           'sizes' => $sizes,
        ]);
		}
		return $this->redirect(Url::to(['site/index']));
	}
	
}
