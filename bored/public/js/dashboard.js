async function loadTasks() {
        const form = new FormData();
        form.append("action", "get");

        const res = await fetch("../api/task.php",{
            method: "POST",
            body:  form,
        });

        const tasks = await res.json();
        let html = "";

        tasks.forEach( task => {
            html += `
            <div>
                <strong>${task.title}</strong> - ${task.status}<br>
                <button onclick="completeTask(${task.id})"> ✅ </button>
                <button onclick="deleteTask(${task.id})"> 🗑 </button>
            </div>`
        });

        document.getElementById("taskList").innerHTML = html;
    }

    document.getElementById("taskForm").onsubmit = async(e) =>{
        e.preventDefault();
        const form = new FormData(e.target);
        form.append("action", "add");

        const res = await fetch("../api/task.php", {
            method: "POST",
            body: form,
    });

    const result = await res.text();
    if (result === "added"){
        e.target.reset();
        loadTasks();
    }else{
        alert(" Error adding task. ")
    }
};
    

    async function deleteTask(id){
        const form = new FormData();
        form.append("action", "delete");
        form.append("task_id", id);

        const res = await fetch("../api/task.php", {
            method: "POST",
            body:form,
        });

        const result = await res.text();
        if (result === "deleted"){
            loadTasks();
        }
        else {
            alert("Error deleting task.");
        }
    }

    async function completeTask(id){
        const form = new FormData();
        form.append("action", "complete");
        form.append("task_id", id);

        const res = await fetch("../api/task.php", {
            method: "POST",
            body: form,
        });

        const result = await res.text();
        if (result === "completed"){
            loadTasks();
        }else  {
            alert("Error completing task.");
    }

}
    

async function loadUserInfo(){
        const form = new FormData();
        form.append("action", "get_user");

        const res = await fetch("../api/auth.php", {
            method: "POST",
            body: form,
        });
        
        if(res.ok){
            const user = await res.json();
            document.getElementById("username").innerText = user.name;
        }else{
            document.getElementById("username").innerText = "error negro";
        }
    }

async function logout(){
        const form = new FormData();
        form.append("action","logout")

        const res = await fetch("../api/auth.php", {
            method: "POST",
            body: form,
        });

        const result = await res.text();
        if(result === "logout"){
            window.location.href = "login.html";
        }
    }


loadTasks();
loadUserInfo();