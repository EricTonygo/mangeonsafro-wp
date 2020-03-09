$(document).ready(function () {
    // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: 'http://www.bledshare.com/wp-content/themes/bookshare/assets/emoji-picker/lib/img/',
          popupButtonClasses: 'fa fa-smile-o'
        });
        // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // It can be called as many times as necessary; previously converted input fields will not be converted again
        window.emojiPicker.discover();
    $('.ui.form .ui.dropdown')
            .dropdown()
            ;
    
    $('select#alert_type').change(function (e) {
        if ( $('select#alert_type option:selected').val()!== bookshare_translate("textbooks")) {
            $('#alert_class_subject').hide();
            clear_class_subject_book_information();
        } else {
            $('#alert_class_subject').show();
        }
    });
    
    $('select#alert_type_barter').change(function (e) {
        if ( $('select#alert_type_barter option:selected').val()!== bookshare_translate("textbooks")) {
            $('#alert_class_subject_barter').hide();
            clear_bater_class_subject_book_information();
        } else {
            $('#alert_class_subject_barter').show();
        }
    });
    
    $('select#alert_option').change(function (e) {
        if ( $('select#alert_option option:selected').val() === "10") {
            $('#barter_books_information').hide();
            clear_bater_book_information();
        }else if ( $('select#alert_option option:selected').val() === "11") {
            $('#alert_price_field').show();
            $('#barter_books_information').hide();
            clear_bater_book_information();
        }else if ( $('select#alert_option option:selected').val() === "9") {
            $('#barter_books_information').show();           
        }else {
            $('#barter_books_information').hide();
            clear_bater_book_information();
        }
    });
    
    //Publish a book process
    $('#alert_form')
            .form({
                fields: {
                    alert_name: {
                        identifier: 'alert-name',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please enter a book name'
                            }
                        ]
                    },
                    alert_type: {
                        identifier: 'alert-type',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please select a book type'
                            }
                        ]
                    },
                    alert_city: {
                        identifier: 'alert-city',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please enter a city where someone can contact you'
                            }
                        ]
                    }
                },
                inline: true,
                on: 'change'
            }
            );
    $('#submit_alert_form').click(function (e) {
        if ($('#alert_form').form('is valid')) {
            $('#alert_form').addClass('loading');
        }
    });
    
    
    //Send a message to solve alert process
    $('#contact_alert_owner_form')
            .form({
                fields: {
                    user_name: {
                        identifier: 'username',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please enter your name'
                            }
                        ]
                    },
                    user_email: {
                        identifier: 'email',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please select your email'
                            }
                        ]
                    },
                    country_code: {
                        identifier: 'country-code',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please select your country code'
                            }
                        ]
                    },
                    phone_number: {
                        identifier: 'phone-number',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please enter your phone number'
                            }
                        ]
                    },
                    message: {
                        identifier: 'message',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please enter a message to send'
                            }
                        ]
                    }
                },
                inline: true,
                on: 'change'
            }
            );
    $('#submit_contact_alert_owner_form').click(function (e) {
        if ($('#contact_alert_owner_form').form('is valid')) {
            $('#contact_alert_owner_form').addClass('loading');
        }
    });
    
    $('#contact_owner_btn').click(function (e) {
        $('#contact_alert_owner').show();
    });
    $('#cancel_contact_owner').click(function (e) {
        $('#contact_alert_owner').hide();
    });
    
    $('#show_alert_description').click(function (e) {
        $(this).hide();
        $('#hide_alert_description').show();
        $('#alert_description').show();
    });
    $('#hide_alert_description').click(function (e) {
        $(this).hide();
        $('#show_alert_description').show();
        $('#alert_description').hide();
    });
});


function clear_bater_book_information(){
    $('#alert_name_barter').val('');
    $('#alert_type_barter').dropdown('clear');
    clear_bater_class_subject_book_information();
}

function clear_bater_class_subject_book_information(){
    $('#alert_class_barter').dropdown('clear');
    $('#alert_subject_barter').dropdown('clear');
}

function clear_class_subject_book_information(){
    $('#alert_class').dropdown('clear');
    $('#alert_subject').dropdown('clear');
}