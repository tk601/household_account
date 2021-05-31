//jqueryを使う
// test_jquery.js
$(function () {
    $('#btn').on('click', function() {
        alert("Hello jQuery!!");
    });
});

$(function() {
	setTimeout(function(){
		$('.start_01').fadeIn(1600);
	},500); //0.5秒後にロゴをフェードイン!
	setTimeout(function(){
		$('.start').fadeOut(500);
	},2500); //2.5秒後にロゴ含め真っ白背景をフェードアウト！
});
