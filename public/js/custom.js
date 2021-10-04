/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/custom.js ***!
  \********************************/
$("document").ready(function () {
  $("#togglePassword").click(function () {
    $("#togglePassword").toggleClass("fa-eye fa-eye-slash text-blue-400 text-red-400");

    if ($("#password").prop("type") == "password") {
      $("#password").prop("type", "text");
    } else {
      $("#password").prop("type", "password");
    }
  });
  $(".btnDelete").each(function () {
    $(this).click(function () {
      data = new FormData();
      data.append('user', $(this).prop("id").substring(1));
      $.ajax({
        url: "/api/users/delete",
        type: "PUT",
        data: data,
        processData: false,
        contentType: false
      }).then(function (result) {
        console.log(result);
      })["catch"](function (err) {
        console.log(err);
      });
      ;
      console.log();
    });
  });
  $("#photoPicker").change(function () {
    file = $("#photoPicker")[0].files[0];
    data = new FormData();
    data.append("file", file);
    $.ajax({
      url: "/api/upload",
      data: data,
      type: 'POST',
      processData: false,
      contentType: false
    }).then(function (result) {
      result = result.replaceAll('\\', '/');
      $('#preview').css('background-image', 'url(/images/' + result + ')');
      $('#photo').val(result);
      $('#img').val(result);
      console.log(result);
    })["catch"](function (err) {
      console.log(err);
    });
    ;
  });
  $('input[name="r"]').each(function () {
    $(this).change(function () {
      $('form').submit();
    });
  });
  /* Open lateral panel */

  $('#rowLeft').click(function () {
    $('#lateral').toggle("slow ", false);
  });
  /* Change user type on adding */

  $('#role').change(function () {
    data = $('#role').val();
    location.replace('/users/create?role=' + data);
  });
  /* Darkmode switch */

  $('#toggle').change(function () {
    var status;

    if ($(this).is(":checked")) {
      status = 'Y';
    } else if ($(this).is(":not(:checked)")) {
      status = 'N';
    }

    user = $('#user').val();
    data = new FormData();
    data.append("mode", status);
    $.ajax({
      url: "/api/darkmode?mode=".concat(status, "&user=").concat(user),
      data: data,
      type: 'PUT',
      processData: false,
      contentType: false
    }).then(function (result) {
      location.reload();
    })["catch"](function (err) {
      console.log(err);
    });
    ;
  });
  $('#changeTrimester').change(function () {
    $('#formshow').submit();
  });
  $('#roleSearch').change(function () {
    $('#formSearch').submit();
  });
  $('#orderSearch').change(function () {
    $('#formSearch').submit();
  });
  $('.trselection').each(function () {
    $(this).click(function () {
      id = $(this).prop('id');
      $('.' + id).each(function () {
        $(this).toggle('', false);
      });
    });
  });
});
/******/ })()
;