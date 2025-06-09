<?php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Pollutant</title>
</head>
<body>
    <h1>Create Pollutant</h1>
    <form id="createForm">
        <label for="name">Pollutant Name:</label>
        <input type="text" id="name" name="name" required>
        <button type="submit">Create</button>
    </form>
    <pre id="result"></pre>
    <script>
    document.getElementById('createForm').onsubmit = async function(e) {
        e.preventDefault();
        const name = document.getElementById('name').value;
        const res = await fetch('?page=PollutantCreate', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({name})
        });
        let msg = '';
        try 
        {
            const data = await res.json();
            if (data.success) 
            {
                msg = 'Successfully created!';
            } 
            else if (data.error) 
            {
                msg = data.error;
            } 
            else 
            {
                msg = 'Unknown response';
            }
        } 
        catch (err) 
        {
            msg = 'Server error or invalid response';
        }
        document.getElementById('result').textContent = msg;
    };
    </script>
</body>
</html>