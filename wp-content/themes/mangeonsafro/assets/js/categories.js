/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var CatManager = function () {
    showCategorie = function ($element) {

    };
    hideCategorie = function ($element) {

    };

    visibilityCategorie = function ($element, $visibility) {

    }
};

$catManager = new CatManager();

$('i.catviewer').click(function () {
    if ($(this).hasClass('plus')) {
        $(this).removeClass('plus');
        $(this).addClass('minus');
        $(this).parent().parent().find('a').css('display', 'block');
    } else {
        $(this).removeClass('minus');
        $(this).addClass('plus');
         $(this).parent().parent().find('a').css('display', 'none');
    }
});
