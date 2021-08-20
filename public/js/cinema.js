$(document).ready(function() {
  $("#createCinemaForm, #updateCinemaForm").validate({
    rules: {
      name: {
        required: true
      },
      address: {
        required: true
      },
      geo_lat_long: {
        required: true
      },
      seating_capacity: {
        required: true,
        number: true
      }
    }
  });
});