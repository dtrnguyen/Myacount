function check(){
    var hidden = document.getElementById("jouhoid").value;
    if(hidden == ""){
        window.alert("ユーザー情報を選んでください");
        return false;
    }else{
        return true;
    }		
}
$(document).on('click', 'tr', function(){
    var userjouho = $(this).children("td.id").text();
    document.getElementById("jouhoid").value = userjouho;
});
$(document).on('click', 'td', function(){
    var clsName = 'selectrow';
    var tmpTr = $(this).parents('tr');
    if ( !tmpTr.hasClass(clsName) ) {
        $(tmpTr).parents('table').find('tr').removeClass(clsName);
        $(tmpTr).addClass(clsName);
    }
}); 