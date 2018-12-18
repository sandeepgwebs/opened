/*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2016 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

var responsiveflagVerticalMenu = false;
var categoryVerticalMenu = $('ul.tmvm-menu');
var mVerticalCategoryGrover = $('.tmvm-contener .cat-title');
var max_elem = 10;
var itemstop = $('#top_column #tm_vertical_menu .tmvm-menu > li');
var itemsleft = $('#left_column #tm_vertical_menu .tmvm-menu > li');
var items = $('#tm_vertical_menu .tmvm-menu > li');

$(document).ready(function(){
	categoryVerticalMenu = $('ul.tmvm-menu');
	mVerticalCategoryGrover = $('.tmvm-contener .cat-title');
	

	// For Top Column Vertical More Category
	//max_elem = 10;
	itemstop = $('#top_column #tm_vertical_menu_top .tmvm-menu > li');
	
	if ( itemstop.length > max_elem ) {
		$('#top_column #tm_vertical_menu_top .tmvm-menu').append('<li><div class="more-wrap"><span class="more-view">More Categories</span></div></li>');
	}
	
	$('#top_column #tm_vertical_menu_top .more-wrap').click(function() {
		if ($(this).hasClass('active')) {
			itemstop.each(function(i) {
				if ( i >= max_elem ) {
					$(this).slideUp(200);
				}
			});
			$(this).removeClass('active');
			$('.more-wrap').html('<span class="more-view">More Categories</span>');
		} else {
			itemstop.each(function(i) {
				if ( i >= max_elem  ) {
					$(this).slideDown(200);
				}
			});
			$(this).addClass('active');
			$('.more-wrap').html('<span class="more-view">Less Categories</span>');
		}
	});
	// More Categories
	responsiveVerticalMenu();
	$('#top_column #tm_vertical_menu_top li:has(.tmvm_menu_container)').doubleTapToGo();

	// For Left Column Vertical More Category

	itemsleft = $('#left_column #tm_vertical_menu_top .tmvm-menu > li');
	
	if ( itemsleft.length > max_elem ) {
		$('#left_column #tm_vertical_menu_top .tmvm-menu').append('<li><div class="more-wrap"><span class="more-view">More Categories</span></div></li>');
	}
	
	$('#left_column #tm_vertical_menu_top .more-wrap').click(function() {
		if ($(this).hasClass('active')) {
			itemsleft.each(function(i) {
				if ( i >= max_elem ) {
					$(this).slideUp(200);
				}
			});
			$(this).removeClass('active');
			$('.more-wrap').html('<span class="more-view">More Categories</span>');
		} else {
			itemsleft.each(function(i) {
				if ( i >= max_elem  ) {
					$(this).slideDown(200);
				}
			});
			$(this).addClass('active');
			$('.more-wrap').html('<span class="more-view">Less Categories</span>');
		}
	});
	// More Categories
	
	responsiveVerticalMenu();
	
	$('#left_column #tm_vertical_menu_top li:has(.tmvm_menu_container)').doubleTapToGo();

});
$(window).resize(function(){responsiveVerticalMenu();});

// check resolution
function responsiveVerticalMenu()
{
    if ($(window).width() <= 991 && responsiveflagVerticalMenu == false) {
        mobileInitVertical();
        responsiveflagVerticalMenu = true;
    } else if ($(window).width() >= 992) {
        desktopInitVertical();
        responsiveflagVerticalMenu = false;
    }
}

// init Super Fish Menu for 767px+ resolution
function desktopInitVertical()
{
	// More Categories top
	$('#top_column #tm_vertical_menu').find('.more-wrap').removeClass('active').removeAttr('style');
	itemstop.each(function(i) {
		if ( i >= max_elem ) { 
			$(this).css('display', 'none');
		}
	});
	// More Categories

	// More Categories left
	$('#left_column #tm_vertical_menu').find('.more-wrap').removeClass('active').removeAttr('style');
	itemsleft.each(function(i) {
		if ( i >= max_elem ) { 
			$(this).css('display', 'none');
		}
	});
	// More Categories
			
	mVerticalCategoryGrover.off();
	mVerticalCategoryGrover.removeClass('active');
	$('.tmvm-menu li ul').removeClass('menu-mobile').parent().find('.menu-mobile-grover').remove();
	$('.tmvm-menu li ul').removeAttr('style');
	$('.tmvm-menu').removeAttr('style');

}

function mobileInitVertical()
{
	// More Categories
	$('#tm_vertical_menu').find('.more-wrap').css('display', 'none');
	items.removeAttr('style');
	// More Categories
	
	$('.tmvm-menu').removeAttr('style');

	mVerticalCategoryGrover.on('click', function(e){
		e.preventDefault();
		$(this).toggleClass('active').parent().find('ul.tmvmmenu-content').stop().slideToggle('medium');
		return false;
	});

	$('.tmvm-menu li ul').addClass('menu-mobile clearfix').parent().prepend('<span class="menu-mobile-grover"></span>');

	$(".tmvm-menu .menu-mobile-grover").on('click', function(e){
		var catSubUl = $(this).parent().find('.menu-mobile:first');
		if (catSubUl.is(':hidden'))
		{
			catSubUl.slideDown();
			$(this).addClass('active');
		}
		else
		{
			catSubUl.slideUp();
			$(this).removeClass('active');
		}
		return false;
	});


	$('#tm_vetical_menu > ul:first > li > a').on('click', function(e){
		var parentOffset = $(this).prev().offset();
	   	var relX = parentOffset.left - e.pageX;
		if ($(this).parent('li').find('ul').length && relX >= 0 && relX <= 20)
		{
			e.preventDefault();
			var mobCatSubUl = $(this).next('.menu-mobile');
			var mobMenuGrover = $(this).prev();
			if (mobCatSubUl.is(':hidden'))
			{
				mobCatSubUl.slideDown();
				mobMenuGrover.addClass('active');
			}
			else
			{
				mobCatSubUl.slideUp();
				mobMenuGrover.removeClass('active');
			}
		}
	});

}