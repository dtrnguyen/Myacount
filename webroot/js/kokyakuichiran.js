function check(){
    var hidden = document.getElementById("shousaiid").value;
    if(hidden == ""){
        window.alert("商品名を選んでください");
        return false;
    }else{
        return true;
    }		
}
$(document).on('click', 'tr', function(){
    var shousai = $(this).children("td.id").text();
    document.getElementById("shousaiid").value = shousai;
    var toroku = $(this).children("td.id").text();
    document.getElementById("torokuid").value = toroku;
});
$(document).on('click', 'td', function(){
    var clsName = 'selectrow';
    var tmpTr = $(this).parents('tr');
    if ( !tmpTr.hasClass(clsName) ) {
        $(tmpTr).parents('table').find('tr').removeClass(clsName);
        $(tmpTr).addClass(clsName);
    }
});
$(function(){
    $('#companyname').change(function(){
        var csrf = $('input[name=_csrfToken]').val();
        $.ajax({
            type:'post',
            url:'/Myacount/Kokyakuichirans/findcompany',
            beforeSend: function(xhr){
            xhr.setRequestHeader('X-CSRF-Token',csrf);
            },
            data:{companyname:$("#companyname").val()}
            }).done(function(data){
            console.log(data);
            $("#tenponame").html(data);
        }).fail(function(){
            alert('エラーが発生しました。');
        });
    })
});