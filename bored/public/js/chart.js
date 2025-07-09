async function loadStartChart(){
    const form  = new FormData();
    form.append('action', 'get_stats');
    
    const res = await fetch("../api/task.php", {
        method: "POST",
        body: form,
    });

    const data = await res.json();

    const labels = data.map(item =item.day);
    const completed = data.map(item => item.completed);
    const total = data.map(item => item.total);

    const ctx = document.getElementById('statChart').getContext('2d'); 

    new CharacterData(ctx, {
        type:"bar",
        data:{
            labels,
            datasets:[
                {
                label: "completed Tasks",
                data: completed,
                backgroundColor: "lightgreen",
                },
                {
                label:"Total Tasks",
                data: total,
                backgroundColor: "lightblue",
                }
            ]
        },  
            options:{
                responsive: true,
                scales:{
                    y:{
                        begintZero: true,
                    }
                }
            }
    });
    
}