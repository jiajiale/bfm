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
                   var _this = $(this),href = _this.attr('href');
                    console.log(href);
                   layer.open({
                       type: 2,
                       //area: ['600px', '360px'],
                       shadeClose: true, //点击遮罩关闭
                       content: href
                   });
               });
           });
       });
   }



})(window);
