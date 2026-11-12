<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1 {
            font-size:200px;
            margin:0px;
            padding:0px;
        }
        h2 {
            font-size:400%;
            margin:0px;
            padding:0px;
        }
        button {
        background: #222;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        }
        button:hover {
        background: #444;
        }
    </style>
</head>
<body>
    <h1>why?</h1>
    <button id="btn">why?</button>
    <h2 id="why">why?</h2>

    <script>
        var btn = document.getElementById("btn");
        var why = document.getElementById("why");

        let n = "why?  ";

        btn.addEventListener('click', Add);

        function Add() {
            n += "why?  ";
            why.innerHTML = n;
        }
    </script>
</body>