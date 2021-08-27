$(document).on('click','td',function(){
    var clsName = 'selectrow';
    var tmpTr = $(this).parents('tr');
    if(!tmpTr.hasClass(clsName)){
        $(tmpTr).parents('table').find('tr').removeClass(clsName);
        $(tmpTr).addClass(clsName);
    }
});
$(function(){
    $(document).on('click','#hanei',function(){
        $('#shouhinID',parent.document).val($('.selectrow td.shouhinID').text());
        $('#companyname',parent.document).val($('.selectrow td.companyname').text());
        $('#companytel',parent.document).val($('.selectrow td.companytel').text());
        $('#companyaddress',parent.document).val($('.selectrow td.companyaddress').text());
        $('#tenponame',parent.document).val($('.selectrow td.tenponame').text());
        $('#tenpotel',parent.document).val($('.selectrow td.tenpotel').text());
        $('#tenpoaddress',parent.document).val($('.selectrow td.tenpoaddress').text());
    });
});