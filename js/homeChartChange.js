$(function () {
  $("#id_charts").unbind('change').change(function() {
    $.ajax({
      url: 'home?charts=' + $(this).val(),
      type: 'get',
      data: {},
      success: function(data) {
        $("#pop_div").html($('.box-body',data).html());
        $('.loading').hide();


      },
      error: function(jqXHR, textStatus, errorThrown) {}
    });

  });

  $("#id_sexo").unbind('change').change(function() {
    $.ajax({
      url: 'animais?sexo=' + $(this).val(),
      type: 'get',
      data: {},
      success: function(data) {
       
       $('.box-body').html($('.box-body',data).html());
       $('.loading').hide();
       
        /*console.log($('.box box-primary',data).html());*/


      },
      error: function(jqXHR, textStatus, errorThrown) {}
    });

  });
});

