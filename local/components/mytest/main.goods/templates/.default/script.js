"use strict";

$(document).ready(function() {
    var mainGoods = $('#main-goods');
    var mainGoodsForm = mainGoods.find('form');

    mainGoodsForm.on('submit', function(evt) {
        evt.preventDefault();

        var targetForm = $(this);
        var DATA = new FormData(targetForm.get(0));
        var iblockID = mainGoods.data('iblock');
        DATA.append('iblock_id', iblockID);

        var xhr = $.ajax({
            url: "/local/components/mytest/main.goods/action.php",
            type: "POST",
            dataType: "json",
            data: DATA,
            processData: false,
            contentType: false,
            beforeSend :function() {
                targetForm.find('.message').html('');
                targetForm.find('.result').html('');
            },
            success: function(answ) {
                targetForm.find('.message').html(answ.message);

                if (answ.status == 'success') {
                    targetForm.find("input[type=text], input[type=number]").val("");
                    targetForm.find('.result').html(answ.content);
                }
            }
        });
    });
});