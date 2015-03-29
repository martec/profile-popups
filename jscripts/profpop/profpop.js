$.fn.profile = function(el) {
	$.ajax({
		type: "get",
		url: 'member.php?action=profile_pop&uid='+el,
		complete: function(request){
			$('#profile').jGrowl(request.responseText, {
				sticky: true,
				beforeOpen: function(e,m,o){
					$('<div/>', { id: 'mask', class: 'mask'}).appendTo('body').css({ display: 'block', 'width':$(document).width(),'height':$(document).height()});
					$(e).css({ 'marginTop': '80px', 'width':'500px' });
				},
				close: function(e,m,o){
					$('#mask').remove();
				},
			});
		}
	});
	$(document).mouseup(function (e) {
		if ($("#mask").length) {
			var container = $("#profile .jGrowl-notification:last-child");
			if (!container.is(e.target) && container.has(e.target).length === 0) {
				$("#profile .jGrowl-notification:last-child").remove();
				$('#mask').remove();
			}
		}
	});						
	return false;
}

function prof_pop() {
	$("a[href*='user-'], a[href*='member.php?action=profile&uid=']").on({
		click: function (event) {
			if($.inArray(parseInt(myusrgrp), grpignore.split(',').map(function(grup_ign){return Number(grup_ign);}))!=-1) {
				event.preventDefault();
				$.jGrowl(grpnoperm);
			}
			else {
				if(!$('#profile').length) {
					$('<div/>', { id: 'profile', class: 'center' }).appendTo('body');		
				}
				uid2 = parseInt($(this).attr('href').match(/(\d+)(?!.*\d)/));
				event.preventDefault();
				$(this).profile(uid2);
			}
		}
	});
}

$(document).ready(function() {
	$("a[href*='user-'], a[href*='member.php?action=profile&uid=']").on({
		click: function (event) {
			if($.inArray(parseInt(myusrgrp), grpignore.split(',').map(function(grup_ign){return Number(grup_ign);}))!=-1) {
				event.preventDefault();
				$.jGrowl(grpnoperm);
			}
			else {
				if(!$('#profile').length) {
					$('<div/>', { id: 'profile', class: 'center' }).appendTo('body');		
				}
				uid2 = parseInt($(this).attr('href').match(/(\d+)(?!.*\d)/));
				event.preventDefault();
				$(this).profile(uid2);
			}
		}
	});
});