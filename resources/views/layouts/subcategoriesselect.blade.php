@php
$levelstr = '';
for ($i = 0; $i < $level; $i++) {
  $levelstr .= '-->';
} 
@endphp
<option value="{{ $cat->id }}"{!! $cat->id == $selected ? 'selected="selected"' : ''!!}>{{ $cat->getParentsNames() }}</option>
@if (count($cat->children) > 0)
  @foreach ($cat->children as $sub)
    @php $level++; @endphp
    @include('layouts.subcategoriesselect', [
      'cat' => $sub,
      'level' => $level,
      'levelstr' => $levelstr,
      'selected' => $selected
      ])
    @php $level-- @endphp
  @endforeach
@endif