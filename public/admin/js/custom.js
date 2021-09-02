setTimeout(() => {
    $(".msg-div").hide();
}, 5000);

$(document).ready(function () {
    $('.button1').click(function (e) {
        e.preventDefault(); // stops link from making page jump to the top
        e.stopPropagation(); // when you click the button, it stops the page from seeing it as clicking the body too
        $('.content').toggle();
        $('.content1').hide();
        $('.content2').hide();
    });

    $('.content').click(function (e) {
        e.stopPropagation(); // when you click within the content area, it stops the page from seeing it as clicking the body too
    });

    $('.button2').click(function (e) {
        e.preventDefault(); // stops link from making page jump to the top
        e.stopPropagation(); // when you click the button, it stops the page from seeing it as clicking the body too
        $('.content1').toggle();
        $('.content').hide();
        $('.content2').hide();
    });

    $('.content1').click(function (e) {
        e.stopPropagation(); // when you click within the content area, it stops the page from seeing it as clicking the body too
    });

    $('.button3').click(function (e) {
        e.preventDefault(); // stops link from making page jump to the top
        e.stopPropagation(); // when you click the button, it stops the page from seeing it as clicking the body too
        $('.content2').toggle();
        $('.content').hide();
        $('.content1').hide();
    });

    $('.content2').click(function (e) {
        e.stopPropagation(); // when you click within the content area, it stops the page from seeing it as clicking the body too
    });

    $('body').click(function () {
        $('.content').hide();
        $('.content2').hide();
        $('.content1').hide();
    });

    if ($(window).width() > 991) {
        $('.main-sidebar .navbar-toggler').on('click', function () {
            $('body').toggleClass('show');
            $('.navbar-toggler').toggleClass('open');
            $(".main-sidebar").toggleClass("full-menu");
            $(".main-sidebar-nav ul li a span").toggleClass("menu-text");
            $(".dashboard-body").toggleClass("dashboard-shrink");
        });
    } else {
        $('.navbar-toggler').on('click', function () {
            $(".main-sidebar").toggleClass("mobile-show-menu");
            $('.navbar-toggler').toggleClass('open');
        });

        $('.admin-body-area, .header-right-component, .btm-main-footer').click(function (evt) {
            $(".main-sidebar").removeClass("mobile-show-menu");
            $('.navbar-toggler').removeClass('open');
        });
    }

    $(document).on('click', '.booking-view-more', function (event) {
        $(this).find(".booking-view-dropdown").toggleClass("show-dropdown")
    });

    $('.hdr-settings').on('click', function (event) {
        $(this).find(".profile-setting").toggleClass("show-profile");
    });

    $(document).mouseup(function (e) {
        var container = $(".show-dropdown");

        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.removeClass("show-dropdown");
        }

        var container1 = $(".show-profile");

        // if the target of the click isn't the container nor a descendant of the container
        if (!container1.is(e.target) && container1.has(e.target).length === 0) {
            container1.removeClass("show-profile");
        }
    });

    $('[data-toggle="tooltip"]').tooltip();

    $(window).on("load", function () {
        $("#about_txt_scroll").mCustomScrollbar({
            autoHideScrollbar: true,
            theme: "rounded"
        });
    });

    $('#bootstrap-data-table-export').DataTable();

    $('.count').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 4000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });


    $('.button_prt').click(function(){
        $(this).hide();
        $('.show-span').hide();
        $('.hide-span').show();
    });

    $('#seller_type').change(function(){
        var seller_type = $('#seller_type').val();

        if(seller_type == "Realtor") {
            $('#company_name').prop('required',true);
        } else {
            $('#company_name').removeAttr('required');
        }
    });

    $('#update_user_form').submit(function(){
        var new_pass  = $('#new_password').val();
        var conf_pass = $('#confirm_password').val();

        if(new_pass != conf_pass) {
            $('.err-pass').show();
            return false;
        }
    });
});

function customInput(el) {
    const fileInput = el.querySelector('[type="file"]')
    const label = el.querySelector('[data-js-label]')

    fileInput.onchange =
        fileInput.onmouseout = function () {
            if (!fileInput.value) return

            var value = fileInput.value.replace(/^.*[\\\/]/, '')
            el.className += ' -chosen'
            label.innerText = value
        }
};

// Choose File JS
function fileInputText() {
    var inputs = document.querySelectorAll('.file-input')

    for (var i = 0, len = inputs.length; i < len; i++) {
        customInput(inputs[i])
    }
}

fileInputText();

// edit record for auto fillup the fields
function editRecord(url, id, view, src_loader) {
    $.ajax({
        "url": url,
        "method": "GET",
        "data": {"id": id, "view": view},
        "beforeSend": function () {
            $("#update-div").html('<div class="loaderprt"><img src="' + src_loader + '"></div>');
        },
        "success": function (res) {
            var viewArr = view.split(".");
            if (viewArr[viewArr.length - 1] == "read")
                $("#read-div").html(res);
            else {
                $("#update-div").html(res);
                fileInputText();
            }

            $('.selectpicker').selectpicker();
        }
    });
}

// delete record function
function deleteRecord(url) {
    swal({
        icon: "warning",
        buttons: true,
        dangerMode: true,
        title: "Confirm Delete",
        text: "Are you sure want to delete this record?",
    }).then((willDelete) => {
        if (willDelete) {
            window.location.href = url;
        }
    });
}

// add another input function for service entry
function addAnotherInput(url, div_id, append_id) {
    var id = Date.now();

    $.ajax({
        "url": url,
        "method": "GET",
        "data": {"id": id, "div_id": div_id},
        "success": function (res) {
            $(".pricing-lavel-form-sec").find("#" + append_id).append(res);
            if ($("." + div_id).length > 1) {
                $("." + div_id).show();
            }

            $('.selectpicker').selectpicker();
        }
    });
}

// add another input function for treatment entry
function addAnotherInputTT(div_id, append_id) {
    var id = Date.now();

    var html = '<div class="pricing-lavel-form-row" id="' + id + '"><div class="pricing-lavel-form-left-clmn fullwidth"><div class="form-group"><label>Treatment Type</label><input type="text" name="name[]" class="form-control" required></div></div><div><div class="remove-price-lavel ' + div_id + '"><a href="javascript:void(0);" onclick=\'removeInput("' + div_id + '", "' + id + '");\'><i class="fa fa-trash-o"></i></a></div></div></div>';

    $(".pricing-lavel-form-sec").find("#" + append_id).append(html);

    if ($("." + div_id).length > 1) {
        $("." + div_id).show();
    }
}

// remove input function for service entry
function removeInput(div_id, id) {
    $("#" + id).remove();

    if ($("." + div_id).length == 1) {
        $("." + div_id).hide();
    }
}

// remove image confirmation
function removeImageConf(url, id, url_no_image) {
    swal({
        title: "Confirm Remove",
        text: "Are you sure want to remove this image?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: true,
        closeOnCancel: true
    }).then((result) => {
        if (result.value) {
            removeImage(url, id, url_no_image);
        }
    });
}

// remove image function for category
function removeImage(url, id = "", url_no_image) {
    $.ajax({
        "url": url,
        "method": "GET",
        "data": {"id": id},
        "success": function (res) {
            $("#profile-image").html("<img src='" + url_no_image + "'>");
            $("#" + id).html("<img src='" + url_no_image + "'>");
            $(".imgprt").html("<img src='" + url_no_image + "' width='400'>");
        }
    });
}

// function to generate auto filled up form to update admin profile
function getProfile(url, src_loader) {
    $('#myModalProfileUpdate').show();

    $.ajax({
        "url": url,
        "method": "GET",
        "beforeSend": function () {
            $("#edit-profile-div").html('<div class="loaderprt"><img src="' + src_loader + '"></div>');
        },
        "success": function (res) {
            $("#edit-profile-div").html(res);
            fileInputText();
        }
    });
}


$(window).load(function()
{
   var phones = [{ "mask": "(###) ###-####"}, { "mask": "(###) ###-##############"}];
    $('#phone').inputmask({ 
        mask: phones, 
        greedy: false, 
        definitions: { '#': { validator: "[0-9]", cardinality: 1}} });
});



function showMap() {  
  var myLatLng = {lat:parseFloat(document.getElementById('latitude').value), lng:parseFloat(document.getElementById('longitude').value) };
  var map = new google.maps.Map(document.getElementById('map_property'), {
    zoom: 10,
    center: myLatLng
  });
  var marker = new google.maps.Marker({
    position: myLatLng,
    map: map
  });
}


function validate(evt) {
    var theEvent = evt || window.event;
          // Handle paste
          if (theEvent.type === 'paste') {
              key = event.clipboardData.getData('text/plain');
          } else {
          // Handle key press
          var key = theEvent.keyCode || theEvent.which;
          key = String.fromCharCode(key);
      }
      var regex = /^-?\d*\.?\d{0,25}$/;
      if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}

function readURL(input) {
        $('.show-img').show();
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#showImg')
                .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }