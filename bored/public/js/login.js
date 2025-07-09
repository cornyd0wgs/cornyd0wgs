document.getElementById("loginForm").onsubmit = async (e) =>{
    e.preventDefault();
    const form = new FormData(e.target);
    form.append("action", "login");

    const res = await fetch("../api/auth.php", {
        method: "POST",
        body: form,
    });

    const result = await res.text();
    if (result === "loggedin"){
        window.location.href = "dashboard.php";
    }else {
        alert("login failed" + result);
    }
};