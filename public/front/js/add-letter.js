"use strict";

// Class Definition
var KTAddUser = function () {
    // Private Variables
    var _wizardEl;
    var _formEl;
    var _wizardObj;
    var _avatar;
    var _validations = [];

    // Private Functions
    var _initWizard = function () {
        // Initialize form wizard
        _wizardObj = new KTWizard(_wizardEl, {
            startStep: 1, // initial active step number
            clickableSteps: false  // allow step clicking
        });

        // Validation before going to next page
        _wizardObj.on('change', function (wizard) {
            if (wizard.getStep() > wizard.getNewStep()) {
                return; // Skip if stepped back
            }

            // Validate form before change wizard step
            var validator = _validations[wizard.getStep() - 1]; // get validator for currnt step
            if (validator) {
                validator.validate().then(function (status) {

                    if (status == 'Valid') {
                        wizard.goTo(wizard.getNewStep());
                        let image = $('.image-input-letter:checked').data('image');
                        let key = $('.image-input-letter:checked').val();
                        let width = $('.image-input-letter:checked').data('width');
                        let height = $('.image-input-letter:checked').data('height');
                        let ratio = $('.image-input-letter:checked').data('ratio');

                        let screen_ratio = ($('.preview-image-tab').width() / width);
                        $('.preview-image-tab').css('background-image', "url(" + image + ")");
                        $('.preview-image-tab').css('height', screen_ratio * height);
                        let variables = [];
                        $('.preview-variables').remove();
                        $('.variables-input').each(function () {
                            variables.push({
                                'x': $(this).data('var-x-' + key),
                                'y': $(this).data('var-y-' + key),
                                'style': $(this).data('var-style'),
                                'val': $(this).val(),
                            })
                        })
                        for (let element of variables) {
                            let html = '<span class="preview-variables" ' +
                                'style="position:absolute;left: ' + (element['x'] * screen_ratio) + 'px;top:' + (element['y'] * screen_ratio) + 'px;' + element['style'] + '"' + ">" +
                                element['val'] + "</span";
                            $('.preview-image-tab').append(html)
                        }
                        console.log(variables);
                        KTUtil.scrollTop();
                    } else {
                        toastr.error('الرجاء ملئ الحقول المطلوبة');
                    }
                }).then(function () {
                    KTUtil.scrollTop();
                });
            }
            return false;  // Do not change wizard step, further action will be handled by he validator

        });


// Change event
        _wizardObj.on('changed', function (wizard) {
            KTUtil.scrollTop();
        });

// Submit event
        _wizardObj.on('submit', function (wizard) {
            let path = $(_formEl).attr('action');
            $(_formEl).find('.loader,.loader-al').show();
            $(_formEl).find('.action-submit').attr('disabled', true);
            $(_formEl).find('.action-submit').addClass('loading');
            $.ajax({
                url: path,
                method: 'post',
                data: $(_formEl).serialize()
            }).done(function (data) {
                Swal.fire({
                    title: 'تم الحفظ بنجاح',
                    input: 'select',
                    inputOptions: {
                        pdf: 'ملف',
                        image: 'صورة',
                        print: 'طباعة',
                    },
                    inputPlaceholder: 'اختر نوع المشاركة',
                    showCancelButton: true,
                    confirmButtonText: 'مشاركة',
                    cancelButtonText: 'بدون',
                    showLoaderOnConfirm: true,
                    preConfirm: (login) => {
                        window.location.replace(data.redirect_to + "?share=" + login);
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (!result.isConfirmed) {
                        window.location.replace(data.redirect_to);
                    }
                })

            }).fail(function (data) {
                ajaxFail(data);
            }).always(function () {
                $(_formEl).find('.loader,.loader-al').hide();
                $(_formEl).find('[type=submit]').attr('disabled', false);
                $(_formEl).find('[type=submit]').removeClass('loading');
            })


        });
    }

    var _initValidations = function () {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/

        // Validation Rules For Step 1
        _validations.push(FormValidation.formValidation(
            _formEl,
            {
                fields: fields,
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap({
                        //eleInvalidClass: '',
                        eleValidClass: '',
                    })
                }
            }
        ));
    }


    return {
        // public functions
        init: function () {
            _wizardEl = KTUtil.getById('kt_wizard');
            _formEl = KTUtil.getById('kt_form');

            _initWizard();
            _initValidations();
        }
    };
}
();

jQuery(document).ready(function () {
    KTAddUser.init();
});
