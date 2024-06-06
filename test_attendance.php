<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Attendance Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    h1 {
      text-align: center;
    }

    #attendance-form {
      max-width: 400px;
      margin: 20px auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="time"],
    textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    button[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <h1>Teacher Attendance Form</h1>
  <form id="attendance-form">
    <label for="teacher-name">Teacher Name:</label>
    <input type="text" id="teacher-name" name="teacher-name" required>
    
    <label for="subject">Subject:</label>
    <input type="text" id="subject" name="subject" required>
    
    <label for="time-in">Time In:</label>
    <input type="time" id="time-in" name="time-in" required>
    
    <label for="time-out">Time Out:</label>
    <input type="time" id="time-out" name="time-out" required>
    
    <label for="notes">Notes/Comments:</label>
    <textarea id="notes" name="notes"></textarea>
    
    <button type="submit">Submit</button>
  </form>

  <script>
    document.getElementById('attendance-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission
        
        // Get form values
        var teacherName = document.getElementById('teacher-name').value;
        var timeIn = document.getElementById('time-in').value;
        var timeOut = document.getElementById('time-out').value;
        
        // Calculate if the teacher is late or absent
        var timeInHours = parseInt(timeIn.split(':')[0]);
        var timeOutHours = parseInt(timeOut.split(':')[0]);
        var isLate = timeInHours > 8; // Assuming 8:00 AM is the expected time to start
        var isAbsent = timeIn === "" || timeOut === "";
        
        // Display message based on attendance status
        if (isAbsent) {
            alert(teacherName + " is absent.");
        } else if (isLate) {
            alert(teacherName + " is late.");
        } else {
            alert(teacherName + " is on time.");
        }
    });
  </script>
</body>
</html>
