var fileobj;
function upload_file(e) {
    e.preventDefault();
    fileobj = e.dataTransfer.files[0];
    ajax_file_upload(fileobj);
}
  
function file_explorer() {
    document.getElementById('file').click();
    document.getElementById('file').onchange = function() {
        fileobj = document.getElementById('file').files[0];
        ajax_file_upload(fileobj);
    };
}
  
function ajax_file_upload(file_obj) {
    if(file_obj != undefined) {
        $('#validate').submit(function(e) {
            //e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
              url: url,
              type: 'POST',
              data: form.serialize(),
              success: function(response) {
                if(response == "error"){
                    failed_alert();
                }else{
                   success_alert();
                }
              }
            });
          });
    }else{
        $('#validate').submit(function(e) {
            //e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
              url: url,
              type: 'POST',
              data: form.serialize(),
              success: function(response) {
                if(response == "error"){
                    failed_alert();
                }else{
                   success_alert();
                }
              }
            });
          });
    }
}
