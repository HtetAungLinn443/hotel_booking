$(document).ready(function() {
    $('.thumb-upload').click(function() {
        $("#thumb_file").click();
    })

    $(".thumb-update").click(function() {
        $("#thumb_file").click();
    })

    $("#thumb_file").change(function(event) {
            var fileInput = event.target.files[0];
            if (fileInput) {
                var fileName = fileInput.name;
                var fileExtension = fileName.split('.').pop().toLowerCase();
                if (fileExtension == 'jpg' || fileExtension == 'jpeg' ||
                    fileExtension == 'png' || fileExtension == 'gif') {
                    $('.thumb-upload').hide();
                    $('.preview-container').show();
                    const objectURL = URL.createObjectURL(fileInput);
                    const $imageElement = $('.preview-container img').attr('src', objectURL);
                    $('.preview-container').append($imageElement);
                } else {
                    $("#thumb_error").text('Image extension must be jpg, jpeg, png, gif!');
                    $("#thumb_error").show();
                }
            }
        })
        // $("#submit-btn").click(function() {
        //     let error = false;
        //     const thumb_image = $('#thumb_file').val();
        //     const room_name = $("#room_name").val();
        //     const room_occupation = $("#room_occupation").val();
        //     const room_bed = $("#room_bed").val();
        //     const room_size = $("#room_size").val();
        //     const room_view = $("#room_view").val();
        //     const room_price = $("#room_price").val();
        //     const extra_bed_price = $("#extra_bed_price").val();
        //     const description = $("#description").val();
        //     const room_details = $("#room_details").val();
        //     const room_amenity = $("input[name='room_amenity[]']:checked").length;
        //     const room_feature = $("input[name='room_feature[]']:checked").length;

    //     // test function
    //     function validateNull($id, $err_id, $msg) {
    //         if ($id == '') {
    //             $($err_id).text($msg);
    //             $($err_id).show();
    //             error = true;
    //         }
    //     }

    //     function validateCheckbox($id, $err_id, $msg) {
    //         if ($id == 0) {
    //             $($err_id).text($msg);
    //             $($err_id).show();
    //             error = true;
    //         }
    //     }
    //     validateNull(thumb_image, "#thumb_error", "Please fill hotel room thumbnail image!");
    //     validateNull(room_name, "#room_name_error", "Please fill hotel room name!");
    //     validateNull(room_occupation, "#room_occupation_error", "Please fill hotel room occupation!");
    //     validateNull(room_bed, "#room_bed_error", "Please choose hotel room bed type!");
    //     validateNull(room_size, "#room_size_error", "Please fill hotel room size!");
    //     validateNull(room_view, "#room_view_error", "Please choose hotel room view!");
    //     validateNull(room_price, "#room_price_error", "Please fill hotel room price per day!");
    //     validateNull(extra_bed_price, "#extra_bed_price_error",
    //         "Please fill hotel room extra bed price per day!");
    //     validateNull(description, "#description_error", "Please fill hotel room description!");
    //     validateNull(room_details, "#room_details_error", "Please fill hotel room details!");

    //     validateCheckbox(room_amenity, "#room_amenity_error", "Please check hotel room amenity!")
    //     validateCheckbox(room_feature, "#room_feature_error",
    //             "Please check hotel room special feature!")
    //         // if (room_name.length <= 2 && room_name != '') {
    //         //     $("#room_name_error").text('Hotel room name must be greater then two!');
    //         //     $("#room_name_error").show();
    //         //     error = true;
    //         // }

    //     // if (room_occupation > 13 && room_occupation != '') {
    //     //     $("#room_occupation_error").text('Please fill hotel room occupation!');
    //     //     $("#room_occupation_error").show();
    //     //     error = true;
    //     // }

    //     if (!error) {
    //         // alert('submit');
    //         $('#createForm').submit();
    //     }

    // })

    $("#reset-btn").click(function() {
        $(".label-error").hide();
    })
})