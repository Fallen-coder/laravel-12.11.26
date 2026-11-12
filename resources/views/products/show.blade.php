<x-layout>
    <x-slot:title>
        Show a product
    </x-slot>

    @if ($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>{{ $product->name }}</h1>
    <h4>Quantity: {{ $product->quantity }}</h4>
    <p>{{ $product->description }}</p>


    <form action="{{ route('products.update', $product) }}" method="post">
    @csrf
    @method('PUT')
    <input type="hidden" name="tags_submitted" value="1">

    <label for="tags">Tags (atdali ar komatiem)</label>
    <input type="text" id="tags" name="tags" list="tag-options"
           value="{{ $product->tags->pluck('
    <datalist id="tag-options">
        @foreach ($allTags as $tag)
            <option value="{{ $tag->name }}">
        @endforeach
    </datalist>

    <input type="submit" value="Update">
</form>
    
    <a href="{{ route('products.edit', $product) }}">Edit</a>
    <form action="{{ route('products.destroy', $product) }}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete">
    </form>
</x-layout>