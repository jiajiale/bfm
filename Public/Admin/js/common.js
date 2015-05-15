/**
 * Created by KU04PC on 2015/5/14.
 */


(function(){

   //遮罩弹出层
   if ($('a.J_dialog').length) {
       Wind.css('layer',function(){
           Wind.use('layer', function () {
               $('.J_dialog').on('click', function (e) {
                   e.preventDefault();
                   e.stopPropagation();
                   var _this = $(this);
                   var href = _this.attr('href');
                   var title = _this.attr('title');
                   layer.open({
                       type: 2,
                       shadeClose: true, //点击遮罩关闭
                       title:title,
                       content: href,
                       success: function(layero, index){
                           var body = layer.getChildFrame('body', index);
                           var left = (window.parent.screen.availWidth - body.outerWidth()) / 2;
                           var top = (window.parent.screen.availHeight - body.outerHeight()) / 2;

                           console.log(window.screen.availHeight);
                           console.log(window.screen.availWidth);

                           layero.find('iframe').height(body.outerHeight());
                           layero.find('iframe').width(body.outerWidth());
                           //layero.offset({
                           //    top:top-30,
                           //    left:left
                           //});
                       }
                   });
               });
           });
       });
   }

    //dialog弹窗内的关闭方法
    $('#J_dialog_close').on('click', function (e) {
        e.preventDefault();
        console.log("log");
        console.log(window.Wind.layer);
        if (window.parent.Wind.layer) {
            console.log(window.parent.Wind.layer)
        }
    });

    ////所有加了dialog类名的a链接，自动弹出它的href
    //if ($('a.J_dialog').length) {
    //    Wind.use('dialog', function () {
    //        $('.J_dialog').on('click', function (e) {
    //            e.preventDefault();
    //            var _this = $(this);
    //            Wind.dialog.open($(this).prop('href'), {
    //                onClose: function () {
    //                    _this.focus();//关闭时让触发弹窗的元素获取焦点
    //                },
    //                title: _this.prop('title')
    //            });
    //        }).attr('role', 'button');
    //
    //    });
    //}


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


})(window);
