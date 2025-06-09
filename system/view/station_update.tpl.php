<?php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Station</title>
</head>
<body>
    <h1>Update Station</h1>
    <form id="updateForm">
        <label for="id">Station ID:</label>
        <input type="number" id="id" name="id" required>
        <label for="name">New Name:</label>
        <input type="text" id="name" name="name" required>
        <button type="submit">Update</button>
    </form>
    <pre id="result"></pre>
    <script>
        document.getElementById('updateForm').onsubmit = async function(e) {
            e.preventDefault();
            const id = document.getElementById('id').value;
            const name = document.getElementById('name').value;
            const res = await fetch(`?page=StationUpdate&id=${id}`, {
                method: 'PUT',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({name})
            });
            let msg = '';
            try {
                const data = await res.json();
                if (data.success) {
                    msg = 'Successfully changed!';
                } else if (data.error) {
                    msg = data.error;
                } else {
                    msg = 'Unknown response';
                }
            } catch (err) {
                msg = 'Server error or invalid response';
            }
            document.getElementById('result').textContent = msg;
        };
    </script>
</body>
</html>