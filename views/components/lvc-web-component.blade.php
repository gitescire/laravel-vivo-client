<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LVC Query</title>
    <style>
        html,
        body {
            height: 95%;
            margin: 0;
        }

        body {
            font-family: sans-serif;
            background-color: #1a202c;
            color: #e2e8f0;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .container {
            width: 95%;
            height: calc(100vh - 40px);
            background: #2d3748;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
            margin: 0 auto;
            margin-top: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .form-group {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 0.875rem;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            padding: 10px;
            border: 1px solid #4a5568;
            border-radius: 4px;
            background-color: #edf2f7;
            color: #1a202c;
            box-sizing: border-box;
        }

        .form-group textarea {
            height: 200px;
            resize: vertical;
        }

        button {
            background-color: #3182ce;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #2b6cb0;
        }

        .form-group-full-height {
            display: flex;
            flex-direction: column;
            flex: 1;
            margin-top: 15px;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .form-group-full-height textarea {
            flex: 1;
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            resize: none;
        }
    </style>
</head>

<body>
    <form action="{{ route('lvcQuery') }}" method="POST" target="_blank">
        <div class="container">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <h2>LVC Query</h2>
                </div>
                <div class="form-group">
                    <label for="url">URL:</label>
                    <input type="text" name="url_vivo" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email_user_vivo" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password_user_vivo" required>
                </div>
                <div class="form-group">
                    <label> Read Only? <input type="checkbox" name="read_only_vivo"> </label>
                    <button type="submit">Submit</button>
                </div>
            </div>

            <div class="form-group-full-height">
                <textarea name="query_vivo" placeholder="Query" required></textarea>
            </div>

        </div>
    </form>
</body>

</html>