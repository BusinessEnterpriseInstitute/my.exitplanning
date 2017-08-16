(function($) {
	$(document).ready(function() {		
		
		//generic checkbox for inputs without empty value
		var regularInputArray = ['.form-item-first','.form-item-last','.form-item-company','.form-item-phone','.form-item-name','.form-item-address1','.form-item-city','.form-item-zip','.form-item-cvv','.form-item-verification-value','.form-item-routing-number','.form-item-account-number'];
		$.each(regularInputArray, function(key,thisDiv) {
			$(thisDiv + ' input').blur(function() {
				// on blur, if there is no value, set the defaultText
				if ($(this).val() !== '') {
					$(thisDiv + ' span.valid-input').remove();
					$(this).after('<span class="valid-input"> </span>');
					$(thisDiv + ' span.valid-input').hide().fadeIn();
					$(thisDiv + '  .description').addClass('show-blur-text');
				} else {
					$(thisDiv + ' span.valid-input').remove();
					$(thisDiv + ' .description').removeClass('show-blur-text');
				}
			});
		});
		//generic checkbox for select
		var regularSelectArray = ['.form-item-state','.form-item-year','.form-item-account-type'];
		$.each(regularSelectArray, function(key,thisDiv) {
			$(thisDiv + ' select').focusout(function() {
				// on blur, if there is no value, set the defaultText
				if ($(this).val() !== '') {
					$(thisDiv + ' span.valid-input').remove();
					$(this).after('<span class="valid-input"> </span>');
					$(thisDiv + ' span.valid-input').hide().fadeIn();
					$(thisDiv + '  .description').addClass('show-blur-text');
				} else {
					$(thisDiv + ' span.valid-input').remove();
					$(thisDiv + ' .description').removeClass('show-blur-text');
				}
			});
		});
		
		//email blur
		$('.form-item-email input').blur(function() {
			var thisDiv = '.form-item-email';
			// on blur, if there is no value, set the defaultText
			if ($(this).val() !== '') {
				var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				if(!re.test($(this).val())) {

					$(thisDiv + ' .input-error').remove();
					$(thisDiv + ' .description').before('<div class="input-error">Please enter a valid email address</div>');
				} else {
					$(thisDiv + ' span.valid-input').remove();
					$(this).after('<span class="valid-input"> </span>');
					$(thisDiv + ' span.valid-input').hide().fadeIn();
					$(thisDiv + ' .description').addClass('show-blur-text');
					$(thisDiv + ' .input-error').remove();
				}
			} else {
				$(thisDiv + ' span.valid-input').remove();
				$(thisDiv + ' .description').removeClass('show-blur-text');
			}
    });
		
		//cc number blur
		$('.form-item-number input').blur(function() {
			var valNoSpaces = $(this).val().replace(/ /g,'');
			var thisDiv = '.form-item-number';
			var isNumeric = $.isNumeric(valNoSpaces);
			// on blur, if there is no value, set the defaultText
			if (isNumeric && valNoSpaces.length < 20 && valNoSpaces.length > 14) {
				$(thisDiv + ' span.valid-input').remove();
				$(this).after('<span class="valid-input"> </span>');
				$(thisDiv + ' span.valid-input').hide().fadeIn();
			} else {
				$(thisDiv + ' span.valid-input').remove();
				$(thisDiv + ' .input-error').remove();
				$(thisDiv + ' .description').before('<div class="input-error">Please enter a valid email address</div>');
			}
    });

  });
  
	
	
  Drupal.behaviors.recurly_custom = {
    attach: function(context, settings) { 			
				
			//credit card number checker
			//https://github.com/lopezton/jquery-creditcard-formatter
			var _self = this;	

			_self.card_types = [
					{
						name: 'American Express',
						code: 'ax',
						pattern: /^3[47]/,
						valid_length: [15],
						formats : [
							{
								length: 15,
								format: 'xxxx xxxxxxx xxxx'
							}
						]
					}, {
						name: 'Diners Club',
						code: 'dc',
						pattern: /^3[68]/,
						valid_length: [14],
						formats : [
							{
								length: 14,
								format: 'xxxx xxxx xxxx xx'
							}
						]
					}, {
						name: 'JCB',
						code: 'jc',
						pattern: /^35/,
						valid_length: [16],
						formats : [
							{
								length: 16,
								format: 'xxxx xxxx xxxx xxxx'
							}
						]
					}, {
						name: 'Visa',
						code: 'vs',
						pattern: /^4/,
						valid_length: [16],
						formats : [
							{
								length: 16,
								format: 'xxxx xxxx xxxx xxxx'
							}
						]
					}, {
						name: 'Mastercard',
						code: 'mc',
						pattern: /^5[1-5]/,
						valid_length: [16],
						formats : [
							{
								length: 16,
								format: 'xxxx xxxx xxxx xxxx'
							}
						]
					}
				];

			this.isValidLength = function(cc_num, card_type) {
				for(var i in card_type.valid_length) {
					if (cc_num.length <= card_type.valid_length[i]) {
						return true;
					}
				}
				return false;
			};

			this.getCardType = function(cc_num) {
				for(var i in _self.card_types) {
					var card_type = _self.card_types[i];
					if (cc_num.match(card_type.pattern) && _self.isValidLength(cc_num, card_type)) {
						return card_type;
					}
				}
			};

			this.getCardFormatString = function(cc_num, card_type) {
				for(var i in card_type.formats) {
					var format = card_type.formats[i];
					if (cc_num.length <= format.length) {
						return format.format;
					}
				}
			};

			this.formatCardNumber = function(cc_num, card_type) {
				var numAppendedChars = 0;
				var formattedNumber = '';

				if (!card_type) {
					return cc_num;
				}

				var cardFormatString = _self.getCardFormatString(cc_num, card_type);
				for(var i = 0; i < cc_num.length; i++) {
					cardFormatIndex = i + numAppendedChars;
					if (!cardFormatString || cardFormatIndex >= cardFormatString.length) {
						return cc_num;
					}

					if (cardFormatString.charAt(cardFormatIndex) !== 'x') {
						numAppendedChars++;
						formattedNumber += cardFormatString.charAt(cardFormatIndex) + cc_num.charAt(i);
					} else {
						formattedNumber += cc_num.charAt(i);
					}
				}

				return formattedNumber;
			};

			this.monitorCcFormat = function($elem) {
				var cc_num = $elem.val().replace(/\D/g,'');
				var card_type = _self.getCardType(cc_num);
				$elem.val(_self.formatCardNumber(cc_num, card_type));
				_self.addCardClassIdentifier($elem, card_type);
			};

			this.addCardClassIdentifier = function($elem, card_type) {
				var classIdentifier = 'cc_type_unknown';
				if (card_type) {
					classIdentifier = 'cc_type_' + card_type.code;
				}

				if (!$elem.hasClass(classIdentifier)) {
					var classes = '';
					for(var i in _self.card_types) {
						classes += 'cc_type_' + _self.card_types[i].code + ' ';
					}
					$elem.removeClass(classes + 'cc_type_unknown');
					$elem.addClass(classIdentifier);
				}
			};

			$(function() {
				$(document).find('.ccFormatMonitor').each(function() {
					var $elem = $(this);
					if ($elem.is('input')) {
						$elem.on('input', function () {
							_self.monitorCcFormat($elem);
						});
					}
				});
			});
						
    }
  };
  
  // Add ajax processing overlay to modals
  Drupal.behaviors.ajaxCustom = {
    attach: function(context, settings) {
      $(document)
        .ajaxStart(function() {
          $('#modalContent', context).prepend('<div id="ajax-in-progress"></div>');
        })
        .ajaxStop(function() {
          $('#ajax-in-progress', context).remove();
        });
    }
  };
}(jQuery));