document.querySelector("form").addEventListener("submit", function(e) {
    e.preventDefault();

    const studentNum = document.getElementById("student-number").value.trim();
    const password = document.getElementById("password").value.trim();

    // Get stored users
    const users = JSON.parse(localStorage.getItem("users")) || [];

    // Check if user exists
    const found = users.find(u => u.studentNum === studentNum && u.password === password);

    if (!found) {
        alert("Invalid student number or password.");
        return;
    }

    // Save current session
    localStorage.setItem("currentUser", JSON.stringify(found));

    // Redirect to home
    window.location.href = "studenthome.html";
});