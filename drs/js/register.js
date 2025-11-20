document.getElementById("registerForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const studentNum = document.getElementById("student-number").value.trim();
    const password = document.getElementById("password").value.trim();
    const confirm = document.getElementById("confirm-password").value.trim();

    if (password !== confirm) {
        alert("Passwords do not match!");
        return;
    }

    const users = JSON.parse(localStorage.getItem("users")) || [];

    // Check if student number already exists
    if (users.some(u => u.studentNum === studentNum)) {
        alert("This student number is already registered.");
        return;
    }

    users.push({
        studentNum,
        password
    });

    localStorage.setItem("users", JSON.stringify(users));

    alert("Account created successfully!");
    window.location.href = "login.html";
});