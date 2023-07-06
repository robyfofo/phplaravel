
  <option value="{{ $category->id }}">{{ $levelstr }}{{ $category->title }}</option>
  @if (count($category->children) > 0)
    @foreach ($category->children as $sub)
      @php $levelstr .= ' --> '; @endphp
      @php $level++; @endphp
      @include('layouts.subcategoriesselect', ['category' => $sub,'level' => $level,'levelstr'=>$levelstr])
    @endforeach
  @endif
</tr>