/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var NotificationManager = function () {

    this.printMessage = function ($message, $type, $element) {
        console.log($element);
        $clone_message = $('.message-status.model').clone();
        $clone_message.removeClass('model');
        $element.append($clone_message);
        $clone_message.removeClass('hide');
        $clone_message.closest('span').html($message);
        $clone_message.click(function (e) {
            $(this).hide('slow');
        });
        return $clone_message;
    };

    this.removeMessage = function ($element) {
        $element.remove(); 
    };
    this.showLoader = function ($message) {

    };

    this.canDoAction = function ($userId) {
        return false;
    };
};

var BookManager = function () {

    this.notifManager;
    this.userId;
    this.currentBookId;

    this.setNotificationManager = function ($notifManager) {
        this.notifManager = $notifManager;
    };

    this.initListeners = function () {
        that = this;
        $('.large.remove.bookmark.icon').click(function () {
            $book_id = '2';
            $element = $(this).closest('.publication_card').find('.as_background');
            that.saveBook($book_id, $element);
        });

        $('.large.share.alternate.icon').click(function () {
            $book_url = '';
              that.shareBook('','');
        });
    };

    this.echoTest = function () {
        alert('echo testing');
    };

    this.saveBook = function ($bookId, $element) {
        that = this;

        this.notifManager.printMessage('message', 'type', $element);
        /*
         if (this.notifManager.canDoAction()) {
         $.post("saveBook.php", {bookId: that.currentBookId}, function (data) {
         this.notifManager.printMessage(JSON.parse(data));
         }, "json");
         } else {
         $('.ui.save-book-modal.modal')
         .modal('show')
         ;
         }*/
    };
    this.unsaveBook = function ($bookId) {
        that = this;
        if (this.notifManager.canDoAction()) {
            $.post("unsaveBook.php", {bookId: that.currentBookId}, function (data) {
                this.notifManager.printMessage(JSON.parse(data));
            }, "json");
        }
    };
    this.shareBook = function ($bookLink) {
//        $('.ui.share-book-modal.modal')
//                .modal('show')
//                ;
    };
};

$bookManager = new BookManager();
$notifManager = new NotificationManager();
$bookManager.setNotificationManager($notifManager);
$bookManager.initListeners();