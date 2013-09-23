(function($) { 

	// variables
	var FormDesigner, FormHelper;
	
	// event bindings
	// 0

	FormHelper = {
		$elements: {
			$listCheckboxes: $("#mc4wp-form-settings input[name*='mc4wp_form[lists]']"),
			$notice: $("#mc4wp-form-settings p.mc4wp-notice"),
			$inputDoubleOptin: $("input[name='mc4wp_form[double_optin]']"),
			$inputUpdateExisting: $('input[name="mc4wp_form[update_existing]"]'),
			$rowSendWelcome: $("#mc4wp-send-welcome"),
			$rowReplaceInterests: $("#mc4wp-replace-interests")
		},
		init: function() {
			var els = this.$elements;

			els.$listCheckboxes.change(function() {
				FormHelper.checkIfListSelected();
			});

			els.$inputDoubleOptin.change(function() {
				var value = ($(this).val() == '') ? $(this).data('inherited-value') : $(this).val();
				var display = (value == 1) ? 'none' : 'table-row';
				els.$rowSendWelcome.css('display', display);
			});

			els.$inputUpdateExisting.change(function (){
				var value = ($(this).val() == '') ? $(this).data('inherited-value') : $(this).val();
				var display = (value == 1) ? 'table-row' : 'none';
				els.$rowReplaceInterests.css('display', display);
			});

			FormHelper.checkIfListSelected();
		},
		checkIfListSelected: function() {
			var e = this.$elements;

			if(!e.$listCheckboxes.is(":checked")) {
				e.$notice.text("Select at least 1 list.").show();
			} else {
				e.$notice.hide();
			}
		}
	}


	FormHelper.init();

	FieldWizard = {
		fields: {
			$container: $("#mc4wp-fw .mc4wp-fields"),
			$fields: $("#mc4wp-fw .mc4wp-fields :input, #mc4wp-fw select"),
			$fieldRows: $("#mc4wp-fw .field-row"),
			$textFields: $("#mc4wp-fw .mc4wp-fields :input[type='text']"),
			$form: $("#content"),
			$grouping: $("#mc4wp-fw-grouping"),
			$groupingGroups: $("#mc4wp-fw-grouping-groups"),
			$label: $("#mc4wp-fw-label"),
			$name: $("#mc4wp-fw-name"),
			$nameClone: $("#mc4wp-fw-name").clone(),
			$nameContainer: $("#mc4wp-fw-name-container"),
			$value: $("#mc4wp-fw-value"),
			$placeholder: $("#mc4wp-fw-placeholder"),
			$type: $("#mc4wp-fw-type"),
			$wrapInP: $("#mc4wp-fw-p"),
			$preview: $("#mc4wp-fw-preview"),
			$required: $("#mc4wp-fw-req"),
			$preset: $("#mc4wp-fw-preset"),
			$valueLabel: $("#mc4wp-fw-value-label"),
			$lists: $("#mc4wp-lists")
		},
		init: function() {
			f = this.fields;

			// attach list data to list elements
			for(var i = 0, count = mc4wpListData.length; i < count; i++) {
				var list = mc4wpListData[i];
			 	f.$lists.find('input#mc4wp-list-' + list.id + "-cb" ).data('merge-vars', list.merge_vars).data('groupings', list.interest_groupings);
			}

			// Events
			f.$type.change(this.setup);
			f.$type.change(this.preview);
			f.$preset.change(this.preset);
			f.$name.change(this.validate.nameField);
			f.$grouping.change(this.validate.nameField);
			f.$grouping.change(this.updateGroups);
			f.$groupingGroups.change(this.setGroupValues);
			f.$fields.change(this.preview);
			f.$lists.find('input').change(this.updateAvailableOptions);
			f.$lists.find('input').change(this.setup);
			$("#mc4wp-fw-add-to-form").click(FieldWizard.publish);

			f.$name.suggest(['EMAIL']);

			FieldWizard.updateAvailableOptions();
		},
		updateAvailableOptions: function() {
			var mergeFieldSuggestions = [];
			var availablePresets = [];
			var availableGroupings = [];

			f.$lists.find('input:checked').each(function() {

				var listMergeFieldTags = [];
				var mergeFields = $(this).data('merge-vars');
				var groupings = $(this).data('groupings');
				
				for(var i = 0, mergeFieldsCount = mergeFields.length; i < mergeFieldsCount; i++) {
					listMergeFieldTags.push(mergeFields[i].tag);
				}

				availableGroupings = availableGroupings.concat(groupings);
				availablePresets = availablePresets.concat(mergeFields);
				mergeFieldSuggestions = mergeFieldSuggestions.concat(listMergeFieldTags);
			});
			
			f.$name.data('suggestionSource', mergeFieldSuggestions);
			FieldWizard.updatePresets(availablePresets);
			FieldWizard.updateGroupings(availableGroupings);
		},
		updateGroupings: function(availableGroupings) {
			f.$grouping.find('option').not('.default').remove();

			for(var i = 0, groupingsCount = availableGroupings.length; i < groupingsCount; i++) {
				var g = availableGroupings[i];
				var $option = $("<option />").val(g.id).text(g.name).appendTo(f.$grouping).data('groups', g.groups);
			}

			this.updateGroups();
		},
		updateGroups: function() {
			f.$groupingGroups.find('option').not(".default").remove();
			var groups = f.$grouping.find('option:selected').first().data('groups');

			if(groups == undefined || groups.length == 0) { 
				return;
			}

			for(var i = 0, limit = groups.length; i < limit; i++) {
				g = groups[i];
				$option = $("<option />").val(g.name).text(g.name).appendTo(f.$groupingGroups);
			}

			if(f.$groupingGroups.attr('multiple')) {
				f.$groupingGroups.find('option.default').text("Select 1 or more groups..");
			} else {
				f.$groupingGroups.find('option.default').text("Select a group..");
			}
		},
		setGroupValues: function() {
			var value = $(this).val();

			if(typeof value == 'string') {
				f.$value.val(value);
			} else {
				f.$value.val(value.join(','));
			}

			if(f.$label.is(":visible")) {
				f.$label.val(value);
			}

		},
		updatePresets: function(availablePresets) {
			var usedTags = [], $firstOption;

			// remove all options
			f.$preset.find('option').not('.default, .group').remove();
			$lastOption = f.$preset.find('option').last();

			for(var i = 0, presetCount = availablePresets.length; i < presetCount; i++) {
				var p = availablePresets[i];

				if(usedTags[p.tag]) { continue; }

				var optionName = p.name;
				if(p.required) optionName += '*';

				var $option = $("<option />")
					.val(p.tag)
					.text(optionName)
					.data('presets', {
						'fieldType': p.field_type,
						'fieldName': p.tag,
						'label': p.name + ":",
						'placeholder': "Your " + p.name.toLowerCase(),
						'required': p.required
					}).insertBefore($lastOption)
					.addClass('fieldType-' + p.field_type);

				if(p.field_type == 'url' || p.field_type == 'email' || p.field_type == 'date' || p.field_type == 'birthday' || p.field_type == 'phone') {
					$option.addClass('fieldType-text');
				}
				if(p.field_type == 'birthday') {
					$option.addClass('fieldType-date');
				}
				if(p.field_type == 'phone') {
					$option.addClass('fieldType-tel');
				}

				usedTags[p.tag] = true;
			}

		},
		validate: {
			nameField: function() {
				var f = FieldWizard.fields, name, arrayCharPos;

				if(f.$preset.val() == 'group') {
					if(f.$type.val() == 'checkbox' || f.$type.val() == 'radio') {
						f.$name.val('GROUPINGS[' + f.$grouping.val() +'][]');
					} else {
						f.$name.val('GROUPINGS[' + f.$grouping.val() +']');				
					}
					return;
				}				
				
				name = f.$name.val().trim();
				if((arrayCharPos = name.indexOf('[')) != -1) {
					name = name.substring(0, arrayCharPos).toUpperCase().replace(/\s+/g,'') + name.substring(arrayCharPos);
				} else {
					name = name.toUpperCase().replace(/\s+/g,'');
				}
				
				f.$name.val(name);
				return true;
			}
		},
		publish: function() {
			var f = FieldWizard.fields, formMarkup;
			formMarkup = f.$form.val() + "\n" + f.$preview.val();
			f.$form.val(formMarkup);
		},
		preview: function() {

			var f = FieldWizard.fields, $p, $input, $label, fieldType, fieldId;

			fieldType = f.$type.val();

			$input = $("<input>");
			$input.attr('type', fieldType);

			if(fieldType != 'submit') { $input.attr('name', f.$name.val()); }

			// set a default value?
			if(f.$value.val().length > 0) { 
				$input.attr('value', f.$value.val());
			}

			// generate field id
			if(f.$name.val().length > 0 && fieldType != 'submit' && fieldType != 'hidden') {
				if(fieldType == 'checkbox' || fieldType == 'radio') {
					fieldId = "f_" + f.$name.val().toLowerCase().replace(/[^\w-]+/g,'').replace('groupings','') + '_' + f.$value.val().toLowerCase().replace(/[^\w-]+/g,'');
				} else {
					fieldId = "f_"+ f.$name.val().toLowerCase().replace(/[^\w-]+/g,'');
				}
								
				$input.attr('id', fieldId);
			}

			// set placeholder attribute
			if(f.$placeholder.val() != '' && f.$placeholder.is(':visible')) {
				$input.attr('placeholder', f.$placeholder.val());
			}

			// set required attribute
			if(f.$required.is(":checked:visible")) {
				$input.attr('required', true);
			}

			$code = $input.wrap("<p />").parent();

			// wrap in paragraph tags
			if(f.$wrapInP.is(":checked:visible")) {
				$input.wrap("<p />").parent();
				$("<br>").insertBefore($input).clone().insertAfter($input);
			}

			// add label element
			if(f.$label.val() != '' && f.$label.is(':visible')) {
				$label = $("<label />");
				$label.attr('for', fieldId);
				
				if(fieldType == 'radio' || fieldType == 'checkbox') {
					// wrap $input in a <label> tag
					$input.wrap($label);
					// wrap label text in <span> tags, insert after input
					$("<span />").text(f.$label.val()).insertAfter($input);
				} else {
					// add label before input element
					$label.html(f.$label.val());
					$label.insertBefore($input);
					$("<br>").insertAfter($label);
				}

				
			}		

			f.$preview.val($code.html().replace(/<br>/gi, "\n"));

			return;
		},
		setup: function() {
			var f, fieldType, visibleRows;

			f = FieldWizard.fields;
			fieldType = f.$type.val();

			// reset
			f.$container.hide();
			f.$fieldRows.hide();
			f.$textFields.val('');
			f.$wrapInP.attr('checked', true);
			f.$required.attr('checked', false);
			f.$grouping.val('');
			f.$groupingGroups.val('').find('option.default').text("Select a grouping first..").parent().find('option').not('.default').remove();
			f.$preset.val('').find('option').attr('disabled', true);
			f.$valueLabel.html("Initial value <small>(optional)</small>");

			if(fieldType == '') { return; }

			// show the container
			f.$container.show();

			visibleRows = {
				text: ['preset', 'name', 'label', 'value', 'req', 'p', 'placeholder'],
				hidden: ['preset', 'name', 'value'],
				email: ['preset', 'name', 'label', 'value', 'req', 'p', 'placeholder'],
				checkbox: ['preset', 'name', 'label', 'value', 'p'],
				radio: ['preset', 'name', 'label', 'value', 'p'],
				submit: ['value', 'p'],
				date: [ 'preset', 'name', 'label', 'req', 'p'],
				tel: [ 'preset', 'name', 'label', 'req', 'p', 'placeholder'],
				url: [ 'preset', 'name', 'label', 'req', 'p', 'placeholder']
			}

			// show field rows for chosen fieldType
			for(var i = 0; i < visibleRows[fieldType].length; i++) {
				f.$container.children('.row-' + visibleRows[fieldType][i]).show();
			}

			$availablePresets = f.$preset.find('option.fieldType-' + f.$type.val());
			if($availablePresets.length == 0) {
				f.$container.find('.row-preset').hide();
			} else {
				$availablePresets.removeAttr('disabled');
			} 

			// customize texts
			if(fieldType == 'submit') {
				f.$valueLabel.html('Button text');
			} else if(fieldType == 'checkbox' || fieldType == 'radio') {
				f.$valueLabel.html("Value");
			}

			return true;
		},
		preset: function() {
			var f = FieldWizard.fields, preset, data;
			preset = f.$preset.val();
			data = $(this).find(':selected').data('presets');

			if(preset != 'group') {
				f.$name.val($(this).val());
				f.$label.val(data['label']);
				f.$placeholder.val(data.placeholder);
				f.$required.attr('checked', data.required);
			} else {
				// show grouping related fields
				f.$container.find('.row-grouping-groups, .row-grouping').show();

				// hide normal name and value field
				f.$container.find('.row-name, .row-value').hide();

				if(f.$type.val() == 'checkbox' || f.$type.val() == 'radio') {
					f.$groupingGroups.removeAttr('multiple');
				} else {
					f.$groupingGroups.attr('multiple', true);
				}

			}
			return;
		}
	}

	FieldWizard.init();
	

})(jQuery);