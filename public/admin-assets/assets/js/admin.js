$(document).ready(function () {

    //Jquery custome validation
    $.validator.addMethod("customEmailValidation", function (value, element) {
        return /\S+@\S+\.\S+/.test(value);
    }, "Please enter a valid email address");
    $.validator.addMethod("noSpaces", function(value, element) {
        return value.trim().length > 0;
    }, "This field cannot be empty.");

    //select multiple options
    $('.select_multiple').select2();

    //--------------------------------on edit button click------------------------
    // $('.edit_hangout').on('click', function (event) {
    //     event.preventDefault(event)

    //     var id = $(this).data('id');
    //     var title = $(this).data('title');
    //     var duration = $(this).data('duration');
    //     var image = $(this).data('image');
    //     var img_path = $(this).data('img_path');

    //     $('#hangout_modal').modal('show');
    //     $('#hangout_modal').find('form').attr("id", "edit_hangout_form");
    //     $('#hangout_modal').find('form').attr("action", base_url + 'admin/edit-hangout');
    //     $('#hangout_modal #imgPreview').attr('src', '').show();
    //     $('#hangout_modal #title').val(title);
    //     $('#hangout_modal #duration').val(duration);
    //     $('#hangout_modal #imgPreview').attr('src', img_path + '/' + image);
    //     $('#hangout_modal #hangout_model_title').text("Edit Hangout");
    //     $('#hangout_modal #hangout_submit_btn').text("Update");
    //     var hangout_id = '<input type="hidden" name="hangout_id" value=' + id + ' class="hangout_id">';
    //     $("#title").after(hangout_id);

    // });
    $('.edit_post').on('click', function (event) {
        event.preventDefault(event)

        var id = $(this).data('id');
        var title = $(this).data('title');
        var description = $(this).data('description');
        var instagram_post_link = $(this).data('instagram_post_link');
        var image = $(this).data('image');
        var img_path = $(this).data('img_path');

        $('#post_modal').modal('show');
        $('#post_modal').find('form').attr("id", "edit_post_form");
        $('#post_modal').find('form').attr("action", base_url + 'admin/edit-post');
        $('#post_modal #imgPreview').attr('src', '').show();
        $('#post_modal #title').val(title);
        $('#post_modal #description').val(description);
        $('#post_modal #instagram_post_link').val(instagram_post_link);
        $('#post_modal #imgPreview').attr('src', img_path + '/' + image);
        $('#post_modal #post_model_title').text("Edit post");
        $('#post_modal #post_submit_btn').text("Update");
        var post_id = '<input type="hidden" name="post_id" value=' + id + ' class="post_id">';
        $("#title").after(post_id);

    });
    $('.edit_vertical_btn').on('click', function (event) {
        event.preventDefault(event)

        var id = $(this).data('id');
        var vertical_name = $(this).data('vertical_name');
        var status = $(this).data('status');

        $('#vertical_modal').modal('show');
        $('#vertical_modal').find('form').attr("id", "edit_verticale");
        $('#vertical_modal').find('form').attr("action", base_url + 'admin/vertical-update');
        $('#vertical_modal #vertical_name').val(vertical_name);
        $('#vertical_modal #status').val(status);

        $('#vertical_modal #vertical_modal_title').text("Edit vertical");
        $('#vertical_modal #vertical_submit_btn').text("Update");
        var vertical_id = '<input type="hidden" name="vertical_id" value=' + id + ' class="vertical_id">';
        $("#vertical_name").after(vertical_id);

    });
    $('.edit_plan').on('click', function (event) {
        event.preventDefault(event)

        var id = $(this).data('id');
        var name = $(this).data('name');
        var arriving = $(this).data('arriving');
        var departing = $(this).data('departing');
        var about_trip = $(this).data('about_trip');
        var link = $(this).data('link');
        var is_private = $(this).data('is_private');
        var destinations = $(this).data('destinations');
        var verticals = $(this).data('verticals');
        var image = $(this).data('image');
        var img_path = $(this).data('img_path');

        $('#plan_modal').modal('show');
        $('#plan_modal').find('form').attr("id", "edit_plan_form");
        $('#plan_modal').find('form').attr("action", base_url + 'admin/edit-plan');
        $('#plan_modal #imgPreview').attr('src', '').show();
        $('#plan_modal #name').val(name);
        $('#plan_modal #arriving').val(arriving);
        $('#plan_modal #departing').val(departing);
        $('#plan_modal #about_trip').val(about_trip);
        $('#plan_modal #link').val(link);
        $('#plan_modal #imgPreview').attr('src', img_path + '/' + image);
        $('#plan_modal #plan_model_title').text("Edit plan");
        $('#plan_modal #plan_submit_btn').text("Update");
        var plan_id = '<input type="hidden" name="plan_id" value=' + id + ' class="plan_id">';
        $("#name").after(plan_id);

        if (is_private == 1) {
            $("#is_private").prop("checked", true);
        }
        else {
            $("#is_private").prop("checked", false);
        }

        if (destinations.includes(',')) {

            var destinations = destinations.split(",");
        }
        else {

            var destinations = destinations.split();
        }

        $('#destinations').val(destinations);
        $('#destinations').change();

        if (verticals.includes(",")) {
            var verticals = verticals.split(",");
        }
        else {
            var verticals = verticals.split();
        }

        $('#verticals').val(verticals);
        $('#verticals').change();

        $('#plan_modal #plan_model_title').text("Edit plan");
        $('#plan_modal #plan_submit_btn').text("Update");
        var plan_id = '<input type="hidden" name="plan_id" value=' + id + ' class="plan_id">';
        $("#name").after(plan_id);

    });

    //------------------------------On model hide------------------------
    $('.modal').on('hidden.bs.modal', function () {


        if ($(this).find('form').attr("id") == 'add_hangout_form' || $(this).find('form').attr("id") == 'edit_hangout_form') {

            $(this).find('form').attr("id", "add_hangout_form");
            $(this).find('form').attr("action", base_url + 'admin/add-hangout');
            $('.hangout_id').remove();
            var form = $('#add_hangout_form');
            form.validate().resetForm();
            $(this).find('form').trigger('reset');
            form.find('.error').removeClass('error');
            form.find('.is-invalid').removeClass('is-invalid');
            form.find('.is-valid').removeClass('is-valid');


            $('#plan_modal #plan_model_title').text("Add plan");
            $('#plan_modal #plan_submit_btn').text("Submit");

        }
        else
            if ($(this).find('form').attr("id") == 'add_post_form' || $(this).find('form').attr("id") == 'edit_post_form') {

                $(this).find('form').attr("id", "add_post_form");
                $(this).find('form').attr("action", base_url + 'admin/add-post');
                $('.post_id').remove();
                var form = $('#add_post_form');
                form.validate().resetForm();
                $(this).find('form').trigger('reset');
                form.find('.error').removeClass('error');
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.is-valid').removeClass('is-valid');



                $('#post_modal #post_model_title').text("Add post");
                $('#post_modal #post_submit_btn').text("Submit");
            }
            else
                if ($(this).find('form').attr("id") == 'add_plan_form' || $(this).find('form').attr("id") == 'edit_plan_form') {

                    $(this).find('form').attr("id", "add_plan_form");
                    $(this).find('form').attr("action", base_url + 'admin/add-plan');
                    $('.plan_id').remove();
                    var form = $('#add_plan_form');
                    form.validate().resetForm();
                    $(this).find('form').trigger('reset');
                    form.find('.error').removeClass('error');
                    form.find('.is-invalid').removeClass('is-invalid');
                    form.find('.is-valid').removeClass('is-valid');


                    $('#plan_modal #plan_model_title').text("Add plan");

                    $('#plan_modal #plan_submit_btn').text("Submit");

                    $('#destinations').val([]).trigger('change');
                    $('#verticals').val([]).trigger('change');
                }
                else
                    if ($(this).find('form').attr("id") == 'vertical_store' || $(this).find('form').attr("id") == 'edit_verticale') {

                        $(this).find('form').attr("id", "vertical_store");
                        $(this).find('form').attr("action", base_url + 'admin/vertical.store');
                        $('.vertical_id').remove();
                        var form = $('#vertical_store');
                        form.validate().resetForm();
                        $(this).find('form').trigger('reset');
                        form.find('.error').removeClass('error');
                        form.find('.is-invalid').removeClass('is-invalid');
                        form.find('.is-valid').removeClass('is-valid');

                        $('#vertical_modal #vertical_modal_title').text("Add vertical");

                        $('#vertical_modal #vertical_submit_btn').text("Submit");

                    }
    });
    // $('#hangout_add_btn').on('click', function (event) {
    //     event.preventDefault(event)
    //     $('#hangout_modal #imgPreview').attr('src', '').hide();
    //     $('#hangout_form').attr('action', base_url + "admin/add-hangout");
    // });
    $('#post_add_btn').on('click', function (event) {
        event.preventDefault(event)
        $('#post_modal #imgPreview').attr('src', '').hide();
        $('#post_form').attr('action', base_url + "admin/add-post");
    });
    $('#plan_add_btn').on('click', function (event) {
        event.preventDefault(event)
        $('#plan_modal #imgPreview').attr('src', '').hide();
        $('#plan_form').attr('action', base_url + "admin/add-plan");
    });

    //-------------------------------------validations start------------------------
    // $("#add_hangout_form,#edit_hangout_form").validate({
    //     rules: {
    //         image: {
    //             required: {
    //                 depends: function (elem) {
    //                     var fomrs_id = $(this).parents("form").attr("id");
    //                     return fomrs_id != 'edit_hangout_form';
    //                 }
    //             }
    //         },
    //         title: {
    //             required: true
    //         },
    //         duration: {
    //             required: true
    //         }
    //     },
    //     messages: {
    //         image: {
    //             required: 'Please upload a image'
    //         },
    //         title: {
    //             required: 'Please enter title'
    //         },
    //         duration: {
    //             required: 'Please select duration'
    //         }
    //     }, errorElement: 'span',
    //     errorPlacement: function (error, element) {
    //         error.addClass('invalid-feedback');
    //         element.closest('.form-group').append(error);
    //     },

    // });
    $("#add_post_form,#edit_post_form").validate({
        rules: {
            image: {
                required: {
                    depends: function (elem) {
                        var fomrs_id = $(this).parents("form").attr("id");
                        return fomrs_id != 'edit_post_form';
                    }
                }
            },
            title: {
                required: true,
                noSpaces : true

            },
            description: {
                required: true,
                noSpaces : true

            },
            instagram_post_link: {
                required: true,
                noSpaces : true

            }
        },
        messages: {
            image: {
                required: 'Please upload a image'
            },
            title: {
                required: 'Please enter title'
            },
            description: {
                required: 'Please enter description'
            },
            instagram_post_link: {
                required: 'Please enter instagram post link'
            }
        }, errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        }
    });
    $("#add_plan_form,#edit_plan_form").validate({
        rules: {
            image: {
                required: {
                    depends: function (elem) {
                        var fomrs_id = $(this).parents("form").attr("id");
                        return fomrs_id != 'edit_plan_form';
                    }
                }
            },
            name: {
                required: true,
                noSpaces : true

            },
            arriving: {
                required: true
            },
            departing: {
                required: true
            },
            about_trip: {
                required: true,
                noSpaces : true

            },
            link: {
                required: true,
                noSpaces : true

            },
            'destinations[]': {
                required: true
            },
            'verticals[]': {
                required: true
            }
        },
        messages: {
            image: {
                required: 'Please upload a image'
            },
            name: {
                required: 'Please enter plan name '
            },
            arriving: {
                required: 'Please enter arriving date'
            },
            departing: {
                required: 'Please enter departing date'
            },
            about_trip: {
                required: 'Please enter about trip'
            },
            link: {
                required: 'Please enter link'
            },
            'destinations[]': {
                required: 'Please select at least one destination'
            },
            'verticals[]': {
                required: 'Please select at least one vertical'
            }
        }, errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        }
    });
    $("#change_password_admin").validate({
        rules: {
            current_password: {
                required: true,
                minlength: 8,
                noSpaces : true

            },
            password: {
                required: true,
                minlength: 8,
                noSpaces : true

            },
            password_confirmation: {
                required: true,
                equalTo: "#password",
                minlength: 8,
                noSpaces : true


            }
        },
        messages: {
            current_password: {
                required: 'Please enter current password'
            },
            password: {
                required: 'Please enter new password'
            },
            password_confirmation: {
                required: 'Please enter confirmation password',
                equalTo: 'Password not match'
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col-sm-10').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        }
    });
    $("#admin_deatils").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                noSpaces : true
            },
            email: {
                required: true,
                email: true,
                customEmailValidation: true
            },
        },
        messages: {
            name: {
                required: 'Please enter name'
            },
            email: {
                required: 'Please enter email'
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col-sm-10').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        }
    });
    $("#vertical_store,#edit_verticale").validate({
        rules: {
            vertical_name: {
                required: true,
                minlength: 3,
                noSpaces : true
            }
        },
        messages: {
            vertical_name: {
                required: 'Please enter vertical name'
            }
        }, errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        }
    });
});
