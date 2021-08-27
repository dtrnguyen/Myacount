$(function(){
	$('.btns').click(function(){
		wn = '.' + $(this).attr('date-tgt');
		var mW = $(wn).find('.modalBody').innerWidth() / 2;
		var mH = $(wn).find('.modalBody').innerHeight() / 2;
		$(wn).find('.modalBody').css({'margin-left':-mW,'margin-top':-mH});
		$(wn).fadeIn(500);
	});
	$('.close,.modalBK').click(function(){
		$(wn).fadeOut(500);
	});
});