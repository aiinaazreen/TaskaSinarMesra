$(document).ready(function () {
    // Simulate fetching and displaying leave details (replace with your actual data)
    if ($("#leaveTable tbody tr").length === 0) {
        // Add sample data (replace with your actual data)
        var sampleData = [
            { empNumber: "001", empName: "John Doe", startDate: "2024-01-10", endDate: "2024-01-15", duration: "6 days", status: "Pending" },
            { empNumber: "002", empName: "Joyah", startDate: "2024-01-28", endDate: "2024-02-21", duration: "15 days", status: "Pending" },
            // Add more rows as needed
        ];

        // Populate the table with sample data
        $.each(sampleData, function (index, data) {
            var approveButton = '<button class="approve-btn" data-index="' + index + '">Approve</button>';
            var rejectButton = '<button class="reject-btn" data-index="' + index + '">Reject</button>';
            $("#leaveTable tbody").append("<tr><td>" + data.empNumber + "</td><td>" + data.empName + "</td><td>" + data.startDate + "</td><td>" + data.endDate + "</td><td>" + data.duration + "</td><td>" + data.status + "</td><td class='action-buttons'>" + approveButton + " " + rejectButton + "</td></tr>");
        });

        // Attach click events for approve and reject buttons
        $(".approve-btn").click(function () {
            // Show confirmation dialog
            var isConfirmed = confirm('Are you sure you want to approve this leave?');
            if (isConfirmed) {
                // Implement your approve logic here using the index
                var index = $(this).data("index");
                alert("Approve button clicked for index " + index);
            }
        });

        $(".reject-btn").click(function () {
            // Redirect to leave_management.php when Reject button is clicked
            window.location.href = "leave_management.php";
        });
    }
});
