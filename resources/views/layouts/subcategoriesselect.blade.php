@php
$subcat_levelstr = '';
for ($i = 0; $i < $subcat_level; $i++) {
  $subcat_levelstr .= '-->';
} 
@endphp
<option value="{{ $cat->id }}"{!! $cat->id == $subcat_selected ? 'selected="selected"' : ''!!}>{{ $cat->getParentsNames() }}</option>
@if (count($cat->children) > 0)
  @foreach ($cat->children as $sub)
    @php $subcat_level++; @endphp
    @include('layouts.subcategoriesselect', [
      'cat' => $sub,
      'subcat_level' => $subcat_level,
      'subcat_levelstr' => $subcat_levelstr,
      'subcat_selected' => $subcat_selected
      ])
    @php $subcat_level-- @endphp
  @endforeach
@endif