
  <option value="{{ $cat->id }}"{!! $cat->id == $selected ? 'selected="selected"' : ''!!}>{{ $levelstr }}{{ $cat->title }}</option>
  @if (count($cat->children) > 0)
    @foreach ($cat->children as $sub)
      @php $levelstr .= ' --> '; @endphp
      @php $level++; @endphp
      @include('layouts.subcategoriesselect', [
        'cat' => $sub,
        'level' => $level,
        'levelstr' => $levelstr,
        'selected' => $selected
        ])
    @endforeach
  @endif
</tr>