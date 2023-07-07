
  <option value="{{ $category->id }}"{!! $category->id == $selectedparent ? 'selected="selected"' : ''!!}>{{ $levelstr }}{{ $category->title }}</option>
  @if (count($category->children) > 0)
    @foreach ($category->children as $sub)
      @php $levelstr .= ' --> '; @endphp
      @php $level++; @endphp
      @include('layouts.subcategoriesselect', [
        'category' => $sub,
        'level' => $level,
        'levelstr' => $levelstr,
        'selectedcategory' => $selectedcategory,
        'selectedparent'  =>  $selectedparent
        ])
    @endforeach
  @endif
</tr>