@php
$subcat_levelstr = '';
for ($i = 0; $i < $subcat_level; $i++) {
  $subcat_levelstr .= '-->';
} 
@endphp

<tr class="treegrid-{{ $category->id }}{{ $category->parent_id > 0 ? ' treegrid-parent-'.$category->parent_id : '' }}" valign="top">
  <td class="tree-simbol"></td>
  <td>{{ $category->id }}/{{ $category->parent_id }}/{{ $subcat_level }}</td>

  <td>
    <a class="" href="{{ route($subcat_route.'.moreordering',[$category->id,'ASC']) }}" title="sposta giu"><i class='bx bx-down-arrow-alt' ></i></a><a class="" href="{{ route($subcat_route.'.lessordering',[$category->id,'ASC']) }}" title="sposta su"><i class='bx bx-up-arrow-alt' ></i></a> <small>{{ $category->ordering }}</small>
  </td>
 

  <td>{{ $subcat_levelstr }}{{ $category->title }}</td>
  <td><a href="{{ $subcat_associatedulr }}" title="{{ $subcat_associatedtitle }}">{{ $subcat_associatedtitle }}: {{ $category->associated }}</a></td>

  <td class="actions text-end">
    <a href="javascript:void(0);" data-id="{{ $category->id }}" data-table="{{ $subcat_table }}" data-label="Categoria" data-labelsex="a" data-token="{{ csrf_token() }}" class="setactive" title=""><i class="bx bx-{{ $category->active == 1 ? 'lock-open-alt' : 'lock-alt' }}{{ $category->active == 1 ? ' text-success' : ' text-danger' }}"></i></a><a class="" href="{{ route($subcat_route.'.edit', [$category->id]) }}" title="Modifica categoria"><i class='bx bx-edit'></i></a>
    {!! Form::open(['style'=>'','class'=>'float-end','method' => 'DELETE','route' => [$subcat_route.'.destroy', $category->id]]) !!}
    <a class="deleteitemformbutton" href="#" title="Cancella Categoria"><i class='bx bx-trash'></i></a>
    {!! Form::close() !!}
  </td>
</tr>

  @if (count($category->children) > 0)
    @foreach ($category->children as $sub)
      @php $subcat_level++; @endphp
      @include('layouts.subcategoriestable', [
        'category' => $sub,
        'subcat_level' => $subcat_level,
        'subcat_levelstr'=>$subcat_levelstr,
        'subcat_associatedulr'=>$subcat_associatedulr,
        'subcat_associatedtitle'=>$subcat_associatedtitle,
        'subcat_route'=>$subcat_route,
        'subcat_table'=>$subcat_table])
      @php $subcat_level-- @endphp
    @endforeach
  @endif