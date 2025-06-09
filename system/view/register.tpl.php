<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($data['title'] ?? 'Register') ?></title>
    <style>
        body {
            font-family: Segoe UI, Arial, sans-serif;
            margin: 30px;
            background: #f5f7fa;
            color: #222;
        }
        h1 {
            color: #286090;
            margin-bottom: 20px;
        }
        .form-container {
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 12px #0001;
            max-width: 400px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #e0e0e0;
            box-sizing: border-box;
        }
        button {
            background: #286090;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        .error {
            color: #c12c2c;
            font-size: 0.9em;
            margin-top: 5px;
        }
        .general-error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #f5c6cb;
        }
        .login-link {
            margin-top: 15px;
            color: #555;
        }
        .login-link a {
            color: #286090;
            text-decoration: none;
        }
    </style>
</head>
<body>
<?php if (!empty($data['general_error'])): ?>
    <h1>Already Logged In</h1>
    <p><?= htmlspecialchars($data['general_error']) ?></p>
    <ul>
        <li><a href="?page=Logout">Logout</a></li>
        <li><a href="?page=Index">Go to Index (Dashboard)</a></li>
    </ul>
<?php else: ?>
    <h1><?= htmlspecialchars($data['title'] ?? 'Register') ?></h1>
    
    <div class="form-container">
        <?php if (isset($data['general_error'])): ?>
            <div class="general-error">
                <?= htmlspecialchars($data['general_error']) ?>
            </div>
        <?php endif; ?>
        
        <form method="<?= $data['method'] ?? 'POST' ?>" action="<?= htmlspecialchars($data['action'] ?? '') ?>">
            <?php foreach ($data['fields'] as $field): ?>
                <div class="form-group">
                    <label for="<?= htmlspecialchars($field['name']) ?>">
                        <?= htmlspecialchars($field['label']) ?>
                    </label>
                    
                    <input 
                        type="<?= htmlspecialchars($field['type'] ?? 'text') ?>"
                        name="<?= htmlspecialchars($field['name']) ?>" 
                        id="<?= htmlspecialchars($field['name']) ?>"
                        value="<?= htmlspecialchars($field['value'] ?? '') ?>"
                        <?= isset($field['required']) && $field['required'] ? 'required' : '' ?>
                    />
                    
                    <?php if (isset($field['error'])): ?>
                        <div class="error"><?= htmlspecialchars($field['error']) ?></div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            
            <button type="submit"><?= htmlspecialchars($data['submit_text'] ?? 'Submit') ?></button>
        </form>
        
        <div class="login-link">
            Already have an account? <a href="?page=Login">Sign in here</a>
        </div>
    </div>
<?php endif; ?>
</body>
</html>