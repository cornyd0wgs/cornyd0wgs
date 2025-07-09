<?php require_once "../includes/session.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/chart.js" defer></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
  
</head>
<body>
    <h2>Task Dashboard</h2>
    <form id="taskForm">
        <input type="text" name="title"  id="taskInput" placeholder="Task Title" required>
        <input type="text" name="description" placeholder="Task Description" required>
        <button type="submit">Add Task</button>
    </form>
    
    <div id="userInfo">
        logged in as: <span id="username">loading...</span>
        <button onclick="logout()">Logout</button>
    </div>

    <section id="chartSection">
        <h3>Your Productivity (Last 7 Days)</h3>
        <canvas id="chart" width="400" height="200"></canvas>
    </section>

    <div id="taskList"></div>
    <script src="js/dashboard.js" defer></script>
</body>
</html>