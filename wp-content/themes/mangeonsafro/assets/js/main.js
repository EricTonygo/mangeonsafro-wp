/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $('.alert').alert();
    
    $('#show-sign-up-form-btn').click(function(e){
       e.preventDefault();
       $('#login-block').hide();
       $('#register-block').show();
    });
    
    $('#show-sign-in-form-btn').click(function(e){
       e.preventDefault();
       $('#register-block').hide();
       $('#login-block').show();
    });
});

