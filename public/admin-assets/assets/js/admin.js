$(document).ready(function () {
    //--------------------------------on edit button click------------------------
    $('.edit_hangout').on('click', function (event) {
        event.preventDefault(event)

        var id = $(this).data('id');
        var title = $(this).data('title');
        var duration = $(this).data('duration');
        var image = $(this).data('image');
        var img_path = $(this).data('img_path');

        $('#hangout_modal').modal('show');
        $('#hangout_modal').find('form').attr("id", "edit_hangout_form");
        $('#hangout_modal').find('form').attr("action", base_url + 'admin/edit-hangout');
        $('#hangout_modal #imgPreview').attr('src', '').show();
        $('#hangout_modal #title').val(title);
        $('#hangout_modal #duration').val(duration);
        $('#hangout_modal #imgPreview').attr('src', img_path + '/' + image);
        $('#hangout_modal #hangout_model_title').text("Edit Hangout");
        $('#hangout_modal #hangout_submit_btn').text("Update");
        var hangout_id = '<input type="hidden" name="hangout_id" value=' + id + ' class="hangout_id">';
        $("#title").after(hangout_id);

    });
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

            }
    });

    $('#hangout_add_btn').on('click', function (event) {
        event.preventDefault(event)
        $('#hangout_modal #imgPreview').attr('src', '').hide();
        $('#hangout_form').attr('action', base_url + "admin/add-hangout");
    });
    $('#post_add_btn').on('click', function (event) {
        event.preventDefault(event)
        $('#post_modal #imgPreview').attr('src', '').hide();
        $('#post_form').attr('action', base_url + "admin/add-post");
    });

    //-------------------------------------validations start------------------------
    $("#add_hangout_form,#edit_hangout_form").validate({
        rules: {
            image: {
                required: {
                    depends: function (elem) {
                        var fomrs_id = $(this).parents("form").attr("id");
                        return fomrs_id != 'edit_hangout_form';
                    }
                }
            },
            title: {
                required: true
            },
            duration: {
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
            duration: {
                required: 'Please select duration'
            }
        }, errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },

    });
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
});
