
let AjaxJS = function () {
  let _componentChangeStatusUser = function () {
      $(".switch-status").change(function (e) {
          e.preventDefault();
          let url = $(this).data('url');
          let value = $(this).data("value");
          $.ajax({
              type: "GET",
              url: url,
          }).done(function (data) {
              if (data.status == "success") {
                alert(data.msg)
              } else {
                alert("Không cập nhập được vui lòng kiểm tra lại")
                window.location.href = "/admin/users/index"
              }
          });
      });
  };

  

  return {
      init: function () {
        _componentChangeStatusUser();
      }
  };
}();

// Initialize module
document.addEventListener('DOMContentLoaded', function () {
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  AjaxJS.init();
});
