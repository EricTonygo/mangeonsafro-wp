$(document).ready(function () {
    
    $('#account_type_0_label').click(function (e) {
            e.preventDefault();
            $('#account_type_0').prop("checked", true);
            $('#account_type_1').prop("checked", false);
    });
    
    $('#account_type_1_label').click(function (e) {
            e.preventDefault();
            $('#account_type_1').prop("checked", true);
            $('#account_type_0').prop("checked", false);
    });
});

