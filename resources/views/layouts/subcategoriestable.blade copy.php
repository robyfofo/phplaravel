<!-- Displaying the current category -->
<li value="{{ $category->id }}">{{ $category->title}}

    <!-- If category has children -->
    @if (count($category->children) > 0)

        <!-- Create a nested unordered list -->
        <ul>

            <!-- Loop through this category's children -->
            @foreach ($category->children as $sub)

                <!-- Call this blade file again (recursive) and pass the current subcategory to it -->
                @include('layouts.subcategoriestable', ['category' => $sub])
        
            @endforeach
        </ul>
    @endif
</li>