<x-layout>
    <x-slot:title>
        Show a product
    </x-slot>

    <h1>{{ $product->name }}</h1>

    <div>
        <button type="button"
                id="decrease-btn"
                {{ $product->quantity <= 0 ? 'disabled' : '' }}>
            − Samazināt
        </button>

        <strong id="product-quantity">
            {{ $product->quantity }}
        </strong>

        <button type="button" id="increase-btn">
            + Palielināt
        </button>
    </div>

    <p id="message"></p>

    <p>{{ $product->description }}</p>


    <form action="{{ route('products.update', $product) }}" method="post">
    @csrf
    @method('PUT')
    <input type="hidden" name="tags_submitted" value="1">

    <label for="tags">Tags (atdali ar komatiem)</label>
    <input type="text" id="tags" name="tags" list="tag-options"
           value="{{ $product->tags->pluck('name')->implode(', ') }}">
    <datalist id="tag-options">
        @foreach ($allTags as $tag)
            <option value="{{ $tag->name }}">
        @endforeach
    </datalist>

    <input type="submit" value="Update">
</form>
    
    <a href="{{ route('products.edit', $product) }}">Edit</a>

    <form action="{{ route('products.destroy', $product) }}"
          method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete">
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const increaseBtn = document.getElementById('increase-btn');
            const decreaseBtn = document.getElementById('decrease-btn');
            const quantityElement = document.getElementById('product-quantity');
            const messageElement = document.getElementById('message');

            const increaseUrl = "{{ route('products.increase', $product) }}";
            const decreaseUrl = "{{ route('products.decrease', $product) }}";

            const csrfToken = "{{ csrf_token() }}";

            function changeQuantity(url) {

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {

                    messageElement.textContent = data.message;

                    if (data.success) {
                        quantityElement.textContent = data.quantity;

                        decreaseBtn.disabled = data.quantity <= 0;
                        messageElement.style.color = 'green';
                    } else {
                        messageElement.style.color = 'red';
                    }

                })
                .catch(error => {
                    messageElement.textContent =
                        'Radās kļūda! Mēģiniet vēlreiz.';

                    messageElement.style.color = 'red';

                    console.error(error);
                });
            }

            increaseBtn.addEventListener('click', function () {
                changeQuantity(increaseUrl);
            });

            decreaseBtn.addEventListener('click', function () {
                changeQuantity(decreaseUrl);
            });

        });
    </script>

</x-layout>