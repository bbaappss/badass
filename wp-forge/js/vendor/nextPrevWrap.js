jQuery( document ).ready(function( $ ) {
	jQuery.fn.prevWrap = function(selector) {
		prev = $(this).prev(selector);
		if (prev.length <= 0) {
			prev = $(this).parent().children(selector).last();
		}
		return prev;
	}
	jQuery.fn.nextWrap = function(selector) {
		next = $(this).next(selector);
		if (next.length <= 0) {
			next = $(this).parent().children(selector).first();
		}
		return next;
	}
})