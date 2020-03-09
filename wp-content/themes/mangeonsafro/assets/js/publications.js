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

    $('select#publication_type').change(function (e) {
        if ($('select#publication_type option:selected').val() !== bookshare_translate("textbooks")) {
            $('#publication_class_subject').hide();
            clear_class_subject_book_information();
        } else {
            $('#publication_class_subject').show();
        }
    });

    $('select#publication_type_barter').change(function (e) {
        if ($('select#publication_type_barter option:selected').val() !== bookshare_translate("textbooks")) {
            $('#publication_class_subject_barter').hide();
            clear_bater_class_subject_book_information();
        } else {
            $('#publication_class_subject_barter').show();
        }
    });

    $('select#publication_option').change(function (e) {
        if ($('select#publication_option option:selected').val() === "10") {
            $('#publication_price_tenancy').show();
            $('#publication_tenancy_field').show();
            $('#publication_price_field').show();
            $('#barter_books_information').hide();
            clear_bater_book_information();
        } else if ($('select#publication_option option:selected').val() === "11") {
            $('#publication_price_tenancy').show();
            $('#publication_tenancy_field').hide();
            clear_tenancy_book_information();
            $('#publication_price_field').show();
            $('#barter_books_information').hide();
            clear_bater_book_information();
        } else if ($('select#publication_option option:selected').val() === "9") {
            $('#publication_price_tenancy').hide();
            clear_renting_book_information();
            $('#barter_books_information').show();

        } else {
            $('#publication_price_tenancy').hide();
            clear_renting_book_information();
            $('#barter_books_information').hide();
            clear_bater_book_information();
        }
    });
    
    //Publish a book process
    $('#publication_form')
            .form({
                fields: {
                    publication_name: {
                        identifier: 'publication-name',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please enter a book name'
                            }
                        ]
                    },
                    publication_type: {
                        identifier: 'publication-type',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please select a book type'
                            }
                        ]
                    },
                    publication_state: {
                        identifier: 'publication-state',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please select a book state'
                            }
                        ]
                    },
                    publication_option: {
                        identifier: 'publication-option',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please select a sale option'
                            }
                        ]
                    },
                    publication_city: {
                        identifier: 'publication-city',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please enter a city where someone can get your book'
                            }
                        ]
                    }
                },
                inline: true,
                on: 'change'
            }
            );
    $('#submit_publication_form').click(function (e) {
        if ($('#publication_form').form('is valid')) {
            $('#publication_form').addClass('loading');
        }
    });
    
    
    //Send a message to get a book process
    $('#contact_book_owner_form')
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
    $('#submit_contact_book_owner_form').click(function (e) {
        if ($('#contact_book_owner_form').form('is valid')) {
            $('#contact_book_owner_form').addClass('loading');
        }
    });

    $('#contact_owner_btn').click(function (e) {
        $('#contact_book_owner').show();
    });
    $('#cancel_contact_owner').click(function (e) {
        $('#contact_book_owner').hide();
    });
    
    $('#show_publication_description').click(function (e) {
        $(this).hide();
        $('#hide_publication_description').show();
        $('#publication_description').show();
    });
    $('#hide_publication_description').click(function (e) {
        $(this).hide();
        $('#show_publication_description').show();
        $('#publication_description').hide();
    });
});

function clear_bater_book_information(){
    $('#publication_name_barter').val('');
    $('#publication_type_barter').dropdown('clear');
    clear_bater_class_subject_book_information();
}

function clear_bater_class_subject_book_information(){
    $('#publication_class_barter').dropdown('clear');
    $('#publication_subject_barter').dropdown('clear');
}

function clear_class_subject_book_information(){
    $('#publication_class').dropdown('clear');
    $('#publication_subject').dropdown('clear');
}

function clear_renting_book_information(){
    $('#publication_price').val('');
    clear_tenancy_book_information();
}

function clear_tenancy_book_information(){
    $('#publication_tenancy').val('');
}