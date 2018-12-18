<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>



        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    
	                  				
					
                    [
                        'label' => 'Pages Management',
                        'icon' => 'fa fa-product-hunt',
                        'url' => 'javascript:void(0);',
                        'items' => [
                            ['label' => 'All Pages', 'icon' => 'fa fa-angle-right', 'url' => ['/pages'],'active' => ($this->context->route == 'pages/index'),],
                            ['label' => 'Add Page', 'icon' => 'fa fa-angle-right', 'url' => ['/pages/create'],'active' => ($this->context->route == 'pages/create'),],

                        ],
                    ],
                    
                    [
                        'label' => 'Slider Management',
                        'icon' => 'fa fa-sliders',
                        'url' => '#',
                        'items' => [
                            ['label' => 'All Slider', 'icon' => 'fa fa-file-image-o ', 'url' => ['/slider'],],
                            ['label' => 'Add New Slider', 'icon' => 'fa fa-plus', 'url' => ['/slider/create'],],
                        ],
                    ],
					[
                        'label' => 'Gallery Management',
                        'icon' => 'fa fa-picture-o',
                        'url' => '#',
                        'items' => [ 
                            ['label' => 'All Gallery Images', 'icon' => 'fa fa-file-image-o ', 'url' => ['/gallery'],],
                            ['label' => 'Add New Gallery Image', 'icon' => 'fa fa-plus', 'url' => ['/gallery/create'],],
                        ],
                    ],
					[
                        'label' => 'Sponser Management',
                        'icon' => 'fa fa-money',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Categories', 'icon' => 'fa fa-file-image-o ', 'url' => ['/sponsor-category'],],														['label' => 'All Sponser Images', 'icon' => 'fa fa-file-image-o ', 'url' => ['/sponser'],],
                            ['label' => 'Add New Sponser Image', 'icon' => 'fa fa-plus', 'url' => ['/sponser/create'],],
                        ],
                    ],

                    /* [
                        'label' => 'Testimonial Management',
                        'icon' => 'fa fa-commenting-o',
                        'url' => 'javascript:void(0);',
                        'items' => [
                            ['label' => 'All Testimonials', 'icon' => 'fa fa-angle-right', 'url' => ['/testimonial'],'active' => ($this->context->route == 'testimonial/index'),],
                             ['label' => 'Add testimonial', 'icon' => 'fa fa-angle-right', 'url' => ['/testimonial/create'],'active' => ($this->context->route == 'testimonial/create'),],

                        ],
                    ], */
					['label' => 'Paper Management', 'icon' => 'fa fa-file', 'url' => ['/papers'],'active' => ($this->context->route == 'papers/index'),],
					['label' => 'Payment Management', 'icon' => 'fa fa-money', 'url' => ['/fee'],'active' => ($this->context->route == 'fee/index'),],
					
					[
                        'label' => 'Date Management',
                        'icon' => 'fa fa-calendar',
                        'url' => 'javascript:void(0);',
                        'items' => [
                            ['label' => 'All Important Dates', 'icon' => 'fa fa-angle-right', 'url' => ['/exam-date'],'active' => ($this->context->route == 'exam-date/index' || $this->context->route == 'exam-date/update'),],
                             /* ['label' => 'Add date', 'icon' => 'fa fa-plus', 'url' => ['/exam-date/create'],'active' => ($this->context->route == 'exam-date/create'),], */

                        ],
                    ],
					[
                        'label' => 'Downloads Management',
                        'icon' => 'fa fa-arrow-circle-down',
                        'url' => 'javascript:void(0);',
                        'items' => [
                            ['label' => 'All Downloads File', 'icon' => 'fa fa-angle-right', 'url' => ['/downloads'],'active' => ($this->context->route == 'downloads/index' || $this->context->route == 'downloads/update'),],
                              ['label' => 'Add date', 'icon' => 'fa fa-plus', 'url' => ['/downloads/create'],'active' => ($this->context->route == 'downloads/create'),],

                        ],
                    ],
					[
                        'label' => 'Members Management',
                        'icon' => 'fa fa-users',
                        'url' => 'javascript:void(0);',
                        'items' => [
                            ['label' => 'All Member Categories', 'icon' => 'fa fa-angle-right', 'url' => ['/category'],'active' => ($this->context->route == 'category/index' || $this->context->route == 'category/create' || $this->context->route == 'category/update' || $this->context->route == 'members/update' || $this->context->route == 'members/create' || $this->context->route == 'members/index' || $this->context->route == 'members/viewmembers'),],
                             ['label' => 'Add Member Category', 'icon' => 'fa fa-plus', 'url' => ['/category/create'],'active' => ($this->context->route == 'exam-date/create'),],

                        ],
                    ],
					[
                        'label' => 'Speakers Management',
                        'icon' => 'fa fa-bullhorn',
                        'url' => 'javascript:void(0);',
                        'items' => [
                            ['label' => 'All Speakers', 'icon' => 'fa fa-angle-right', 'url' => ['/speakers'],'active' => ($this->context->route == 'speakers/index'),],
                             ['label' => 'Add Speaker', 'icon' => 'fa fa-plus', 'url' => ['/speakers/create'],'active' => ($this->context->route == 'speakers/create'),],

                        ],
                    ],
					[
                        'label' => 'Session Management',
                        'icon' => 'fa fa-gavel',
                        'url' => 'javascript:void(0);',
                        'items' => [
							['label' => 'All Session', 'icon' => 'fa fa-bars', 'url' => ['/special-session'],'active' => ($this->context->route == 'special-session/index'),],                            
                        ],
                    ],
					/* [
                        'label' => 'Newsletter Subscriber',
                        'icon' => 'fa fa-newspaper-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'All Subscribers', 'icon' => 'fa fa-newspaper-o ', 'url' => ['/newsletter'],],
                            ['label' => 'Add New Subscriber', 'icon' => 'fa fa-plus', 'url' => ['/newsletter/create'],],
                        ],
                    ], */
                    /* [
                        'label' => 'User Management',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'All Users', 'icon' => 'fa fa-file-code-o', 'url' => ['/user'],'active' => ($this->context->route == 'user/index')],
                            ['label' => 'Add New User', 'icon' => 'fa fa-dashboard', 'url' => ['/user/create'],'active' => ($this->context->route == 'user/create')],
                        ],
                    ], */
                    

                    ['label' => 'Menu Management', 'icon' => 'fa fa-bars', 'url' => ['/menu'],'active' => ($this->context->route == 'menu/index'),],
                    ['label' => 'Website Configurations', 'icon' => 'fa fa-cog', 'url' => ['/configs'],'active' => ($this->context->route == 'configs/index'),],
                    ['label' => 'Website Settings', 'icon' => 'fa fa-cogs', 'url' => ['/setting-attributes/web-set'],],
                ],

            ]
        ) ?>
    </section>

</aside>
