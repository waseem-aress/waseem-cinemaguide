$(document).ready(function() {
   $("#createMovieForm, #updateMovieForm").validate({
   rules: {
      title: {
         required: true
      },
      parental_rating: {
         required: true
      },
      movie_length: {
         required: true,
         number: true,
         min:1,
         max:999,
      },
      poster: {
         required: true
      }
   }
   });
});