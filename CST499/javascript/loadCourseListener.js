$(document).ready(function() {
  // Listen for changes in the semester dropdown
  $('#semester').change(function() {
      // Retrieve the selected semester
      var semester = $(this).val();

      // Send an AJAX request to the server
      $.ajax({
          type: 'POST',
          url: '',
          data: { semester: semester },
          success: function(response) {
              // Update the options in the course dropdown
              var courses = JSON.parse(response);
              var options = '<option value="">-- Select a course --</option>';
              for (var i = 0; i < courses.length; i++) {
                  options += '<option value="' + courses[i]['id'] + '">' + courses[i]['name'] + '</option>';
              }
              $('#course').html(options);
          }
      });
  });
});