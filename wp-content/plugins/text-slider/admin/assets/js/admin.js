(function ( $ ) {
	"use strict";

	$(function () {

		// Place your administration-specific JavaScript here
		$('.my-color-field').wpColorPicker();

		var initial_maintext_font = $("input[name='text_slider_settings[maintext_fontfamily]']").val();

		$('#maintext-font').fontSelector({
			'hide_fallbacks' : true,
			'initial' : initial_maintext_font,
			'selected' : function(style) { $("input[name='text_slider_settings[maintext_fontfamily]']").val(style); },
			'fonts' : font_chooser_options
		});

		var initial_subtext_font = $("input[name='text_slider_settings[subtext_fontfamily]']").val();

		$('#subtext-font').fontSelector({
			'hide_fallbacks' : true,
			'initial' : initial_subtext_font,
			'selected' : function(style) { $("input[name='text_slider_settings[subtext_fontfamily]']").val(style); },
			'fonts' : font_chooser_options	
		});
	});

}(jQuery));