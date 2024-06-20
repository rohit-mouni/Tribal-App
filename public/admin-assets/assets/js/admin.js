$(document).ready(function () {

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

        // alert(id + "  " + name + "  " +arriving + "  " + departing + "  " + about_trip + "  " + link + "  " +destinations + "  " + verticals + "  " + image + "  " + img_path + " " + is_private);

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

                    $('#plan_modal #plan_model_title').text("Add plan");
                    $('#plan_modal #plan_submit_btn').text("Submit");

                    $('#destinations').val([]).trigger('change');
                    $('#verticals').val([]).trigger('change');
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
                required: true
            },
            description: {
                required: true
            },
            instagram_post_link: {
                required: true
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
                required: true
            },
            arriving: {
                required: true
            },
            departing: {
                required: true
            },
            about_trip: {
                required: true
            },
            link: {
                required: true
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
    });
});
