function getCourses(val) {
  if (val === "") {
    // If the 'Select a Semester' option is selected, display the 'Select a Semester First' option
    $("#course").html('<option value="">Select a Semester First</option>');
  } else {
    // Send an AJAX request to the server
    $.ajax({
        type: "POST",
        url: "checks.php",
        data: "id=" + val,
        success: function(data){
          $("#course").html(data);
        }
    });
  }
}