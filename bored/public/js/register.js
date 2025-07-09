document.getElementById("registerForm").onsubmit = async (e) =>{
    e.preventDefault();
    const form = new FormData(e.target);
    form.append("action", "register");

    const res = await fetch("../api/auth.php", {
        method: "POST",
        body: form,
    });

    const result = await res.text();
    if(result === "registered"){
        alert("Registration successful! You can now log in.");
        window.location.href= "login.html";
    } else{
        alert("Failed to register: " + result);
    }
};