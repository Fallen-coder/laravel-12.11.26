<x-layout>
    <h1>why</h1>
    <button id="btn">why?</button>
    <p id="why">0</p>

    <script>
        var btn = document.getElementById("btn");
        var why = document.getElementById("why");

        let i = 0;

        btn.addEventListener('click', Add);

        function Add() {
            i += 1;
            why.innerHTML = i;
        }
    </script>
</x-layout>