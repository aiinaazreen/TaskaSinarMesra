<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <!-- Include Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            color: white;
            padding: 10px 20px;
        }

        .top-bar h1 {
            margin: 0;
            font-size: 24px;
        }

        .header-icon {
            cursor: pointer;
        }

        .header-icon i {
            font-size: 20px;
        }

        .navbar {
            display: flex;
            justify-content: space-around;
            background-color: #444;
            padding: 10px 0;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
        }

        .navbar a:hover {
            background-color: #555;
        }

        .container {
            padding: 20px;
        }

        .dashboard-section {
            margin-bottom: 20px;
        }

        .action-box {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .action-box h3 {
            margin-top: 0;
        }

        .action-box button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .action-box button:hover {
            background-color: #218838;
        }

        .logout-button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-button:hover {
            background-color: #c82333;
        }

        .student-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        #student-list {
            margin-top: 20px;
        }

        #student-list table {
            width: 100%;
            border-collapse: collapse;
        }

        #student-list th,
        #student-list td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        #student-list th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <!-- Top bar -->
    <div class="top-bar">
        <h1>Welcome, Teacher!</h1>
        <div class="header-icon">
            <i class="fa fa-sign-out" aria-hidden="true" onclick="location.href='home.php'"></i>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }

        document.addEventListener("DOMContentLoaded", () => {
            loadStudents();
        });

        function loadStudents() {
            fetch('view_students.php')
                .then(response => response.json())
                .then(data => {
                    const studentList = document.getElementById('student-list');
                    studentList.innerHTML = `
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Actions</th>
                            </tr>
                            ${data.map(student => `
                                <tr>
                                    <td>${student.id}</td>
                                    <td>${student.name}</td>
                                    <td>${student.age}</td>
                                    <td>
                                        <button onclick="editStudent(${student.id})">Edit</button>
                                        <button onclick="deleteStudent(${student.id})">Delete</button>
                                    </td>
                                </tr>
                            `).join('')}
                        </table>
                    `;
                })
                .catch(error => console.error('Error:', error));
        }

        function addStudent(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            fetch('add_student.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        loadStudents();
                        event.target.reset();
                    } else {
                        alert('Failed to add student');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function editStudent(id) {
            // Implement the edit functionality
        }

        function deleteStudent(id) {
            if (confirm('Are you sure you want to delete this student?')) {
                fetch(`delete_student.php?id=${id}`, {
                    method: 'GET'
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            loadStudents();
                        } else {
                            alert('Failed to delete student');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
    </script>

    <!-- Navbar -->
    <div class="navbar">
        <a href="http://localhost/Taska2023/home.php">Home</a>
        <a href="http://localhost/Taska2023/teacher_profile.php">Profile</a>
        <a href="http://localhost/Taska2023/attendance_form.php">Attendance</a>
    </div>

    <!-- Main container -->
    <div class="container">
        <div class="student-container">

            <!-- Action box for adding a student -->
            <div class="dashboard-section">
                <div class="action-box">
                    <div class="action-form">
                        <form action="add_student.php" method="post">
                            <h3>Add Student</h3>
                            <button type="submit">Add Student</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Dashboard section for student management -->
            <div class="dashboard-section">
                <div class="action-box">
                    <div class="action-form">
                     <form action="view_students.php" method="post">
                        <h3>View Students</h3>
                        <div id="student-list">
                        <button type="submit">View Student</button>
                        </form>


                            <!-- Student list will be populated here -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Leave Application Section for Teacher -->
            <div class="dashboard-section">
                <div class="action-box">
                    <div class="action-form">
                        <form action="req.teacher.leave.php" method="post">
                            <h3>Request Leave</h3>
                            <button type="submit">Request Leave</button>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</body>

</html>
