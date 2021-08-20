$(document).ready(function() {

  $( "#date_time" ).datetimepicker({
    dateFormat: 'mm/dd/yy',
    timeFormat: 'HH:mm:ss',
    pickerTimeFormat: 'HH:mm:ss',
  });

  $("#createCinemaForm").validate({
    rules: {
      movie_id: {
        required: true
      },
      date_time: {
        required: true
      }
    },
     messages: {
        movie_id:"Please select movie",
        date_time:"Please select date and time",
      },
  });

});