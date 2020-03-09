/* 

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */

$(document).ready(function () {

    $(".banner").backgroundCycle({

        imageUrls: [

            'http://www.bledshare.com/wp-content/themes/bookshare/assets/images/slider_bg.jpg',

            'http://www.bledshare.com/wp-content/themes/bookshare/assets/images/visuel2.jpg',

            'http://www.bledshare.com/wp-content/themes/bookshare/assets/images/visuel3.jpg',  

            'http://www.bledshare.com/wp-content/themes/bookshare/assets/images/visuel5.jpg'  

        ],

        fadeSpeed: 3000,

        duration: 8000,

        backgroundSize: SCALING_MODE_COVER

    });

});



