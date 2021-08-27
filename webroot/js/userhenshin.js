document.addEventListener('DOMContentLoaded',function(){
    $('#userID',parent.document).val($('td.userID').text());
    $('#username',parent.document).val($('td.username').text());	
});
$(document).on('click','.koshinbtn',function(){
    alert("本当に更新しますか？");
});