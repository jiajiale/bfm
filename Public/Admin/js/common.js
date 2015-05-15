/**
 * Created by KU04PC on 2015/5/14.
 */


(function(){

   //遮罩弹出层
   //if ($('a.J_dialog').length) {
   //    Wind.css('layer',function(){
   //        Wind.use('layer', function () {
   //            $('.J_dialog').on('click', function (e) {
   //                e.preventDefault();
   //                e.stopPropagation();
   //                var _this = $(this);
   //                var href = _this.attr('href');
   //                var title = _this.attr('title');
   //                layer.open({
   //                    type: 2,
   //                    shadeClose: true, //点击遮罩关闭
   //                    title:title,
   //                    content: href,
   //                    success: function(layero, index){
   //                        var body = layer.getChildFrame('body', index);
   //                        var left = (window.parent.screen.availWidth - body.outerWidth()) / 2;
   //                        var top = (window.parent.screen.availHeight - body.outerHeight()) / 2;
   //
   //                        console.log(window.screen.availHeight);
   //                        console.log(window.screen.availWidth);
   //
   //                        layero.find('iframe').height(body.outerHeight());
   //                        layero.find('iframe').width(body.outerWidth());
   //                        //layero.offset({
   //                        //    top:top-30,
   //                        //    left:left
   //                        //});
   //                    }
   //                });
   //
   //                layer.onclose(function(){
   //
   //                });
   //            });
   //        });
   //    });
   //}

    //dialog弹窗内的关闭方法
    $('#J_dialog_close').on('click', function (e) {
        e.preventDefault();
        if (window.parent.Wind.dialog) {
            window.parent.Wind.dialog.closeAll();
        }
    });

    //所有加了dialog类名的a链接，自动弹出它的href
    if ($('a.J_dialog').length) {
        Wind.use('dialog', function () {
            $('.J_dialog').on('click', function (e) {
                e.preventDefault();
                var _this = $(this);
                Wind.dialog.open($(this).prop('href'), {
                    onClose: function () {
                        _this.focus();//关闭时让触发弹窗的元素获取焦点
                    },
                    title: _this.prop('title')
                });
            }).attr('role', 'button');

        });
    }


    //日期选择器
    var dateInput = $("input.J_date")
    if (dateInput.length) {
        var dateBegin = $("input.J_date_begin")
        var dateEnd = $("input.J_date_end")

        if(dateBegin.val() != undefined && dateEnd.val() != undefined){
            dateBegin.focus(function(){
                if(dateEnd.val() != undefined){
                    Wind.use('datePicker', function () {
                        dateBegin.datePicker({'max':dateEnd.val()});
                    });
                }else{
                    Wind.use('datePicker', function () {
                        dateBegin.datePicker();
                    });
                }
            });

            dateEnd.focus(function(){
                if(dateBegin.val() != undefined){
                    Wind.use('datePicker', function () {
                        dateEnd.datePicker({'min':dateBegin.val()});
                    });
                }else{
                    Wind.use('datePicker', function () {
                        dateEnd.datePicker();
                    });
                }
            });

        }else{
            Wind.use('datePicker', function () {
                dateInput.datePicker();
            });
        }

    }

    //日期+时间选择器
    var dateTimeInput = $("input.J_datetime");
    if (dateTimeInput.length) {
        var dateTimeBegin = $("input.J_datetime_begin")
        var dateTimeEnd = $("input.J_datetime_end")

        if(dateTimeBegin.val() != undefined && dateTimeEnd.val() != undefined){
            dateTimeBegin.focus(function(){
                if(dateTimeEnd.val() != undefined){
                    Wind.use('datePicker', function () {
                        dateTimeBegin.datePicker({'max':dateTimeEnd.val(),'time':true});
                    });
                }else{
                    Wind.use('datePicker', function () {
                        dateTimeBegin.datePicker({'time': true});
                    });
                }
            });

            dateTimeEnd.focus(function(){
                if(dateTimeBegin.val() != undefined){
                    Wind.use('datePicker', function () {
                        dateTimeEnd.datePicker({'min':dateTimeBegin.val(),'time':true});
                    });
                }else{
                    Wind.use('datePicker', function () {
                        dateTimeEnd.datePicker({'time': true});
                    });
                }
            });

        }else{
            Wind.use('datePicker', function () {
                dateTimeInput.datePicker({'time': true});
            });
        }
    }

    //所有的ajax form提交,由于大多业务逻辑都是一样的，故统一处理
    var ajaxForm_list = $('form.J_ajaxForm');
    if (ajaxForm_list.length) {
        Wind.use('dialog', 'ajaxForm', function () {

            if ($.browser.msie) {
                //ie8及以下，表单中只有一个可见的input:text时，会整个页面会跳转提交
                ajaxForm_list.on('submit', function (e) {
                    //表单中只有一个可见的input:text时，enter提交无效
                    e.preventDefault();
                });
            }

            $('button.J_ajax_submit_btn').on('click', function (e) {
                e.preventDefault();
                /*var btn = $(this).find('button.J_ajax_submit_btn'),
                 form = $(this);*/

                var btn = $(this),
                    form = btn.parents('form.J_ajaxForm');


                //批量操作 判断选项
                if (btn.data('subcheck')) {
                    btn.parent().find('span').remove();
                    if (form.find('input.J_check:checked').length) {
                        var msg = btn.data('msg');
                        if (msg) {
                            Wind.dialog({
                                type: 'confirm',
                                isMask: false,
                                message: btn.data('msg'),
                                follow: btn,
                                onOk: function () {
                                    btn.data('subcheck', false);
                                    btn.click();
                                }
                            });
                        } else {
                            btn.data('subcheck', false);
                            btn.click();
                        }

                    } else {
                        $('<span class="tips_error">请至少选择一项</span>').appendTo(btn.parent()).fadeIn('fast');
                    }
                    return false;
                }

                //ie处理placeholder提交问题
                if ($.browser.msie) {
                    form.find('[placeholder]').each(function () {
                        var input = $(this);
                        if (input.val() == input.attr('placeholder')) {
                            input.val('');
                        }
                    });
                }

                form.ajaxSubmit({
                    url: btn.data('action') ? btn.data('action') : form.attr('action'),			//按钮上是否自定义提交地址(多按钮情况)
                    dataType: 'json',
                    beforeSubmit: function (arr, $form, options) {
                        var text = btn.text();

                        //按钮文案、状态修改
                        btn.text(text + '中...').prop('disabled', true).addClass('disabled');
                    },
                    success: function (data, statusText, xhr, $form) {
                        var text = btn.text();

                        //按钮文案、状态修改
                        btn.removeClass('disabled').text(text.replace('中...', '')).parent().find('span').remove();

                        if (data.state === 'success') {

                            $('<span class="tips_success">' + data.message + '</span>').appendTo(btn.parent()).fadeIn('slow').delay(500).fadeOut(function () {
                                if (typeof callback =='function') {

                                    callback(data.data);

                                    if (window.parent.Wind.dialog) {
                                        window.parent.Wind.dialog.closeAll()
                                    }

                                }
                                if (data.referer) {
                                    //返回带跳转地址
                                    //if (window.parent.Wind.dialog) {
                                    //    //iframe弹出页
                                    //    window.parent.location.href = decodeURIComponent(data.referer);
                                    //} else {
                                    window.location.href = decodeURIComponent(data.referer);
                                    //}
                                } else {
                                    if (window.parent.Wind.dialog) {
                                        reloadPage(window.parent);
                                    } else {
                                        reloadPage(window);
                                    }
                                }

                            });
                        } else if (data.state === 'fail') {
                            $('<span class="tips_error">' + data.message + '</span>').appendTo(btn.parent()).fadeIn('fast');
                            btn.removeProp('disabled').removeClass('disabled');
                        }
                    }
                });
            });

        });
    }

})(window);


//重新刷新页面，使用location.reload()有可能导致重新提交
function reloadPage(win) {
    var location = win.location;
    location.href = location.pathname + location.search;
}