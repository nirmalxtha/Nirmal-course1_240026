document.getElementById("registerForm")?.addEventListener("submit", function(e) {
    e.preventDefault();
    const username = document.getElementById("regUsername").value;
    const email = document.getElementById("regEmail").value;
    const password = document.getElementById("regPassword").value;

    fetch("register.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ username, email, password })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            window.location.href = "index.html";
        } else {
            document.getElementById("regErrorMsg").textContent = data.message;
        }
    });
});

document.getElementById("loginForm")?.addEventListener("submit", function(e) {
    e.preventDefault();
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    fetch("login.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ username, password })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            window.location.href = "dashboard.php";
        } else {
            document.getElementById("errorMsg").textContent = data.message;
        }
    });
});
