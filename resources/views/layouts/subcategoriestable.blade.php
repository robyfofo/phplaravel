<tr class="treegrid-{{ $category->id }}{{ $category->parent_id > 0 ? ' treegrid-parent-'.$category->parent_id : '' }}" valign="top">
  <td class="tree-simbol"></td>
  <td>{{ $category->id }}/{{ $category->parent_id }}/{{ $level }}</td>

  <td></td>
 

  <td>{{ $levelstr }}{{ $category->title }}</td>

  <td class="actions text-end">
    <a href="javascript:void(0);" data-id="{{ $category->id }}" data-table="thirdparties_categories" data-label="Categoria" data-labelsex="a" data-token="{{ csrf_token() }}" class="setactive" title=""><i class="bx bx-{{ $category->active == 1 ? 'lock-open-alt' : 'lock-alt' }}{{ $category->active == 1 ? ' text-success' : ' text-danger' }}"></i></a><a class="" href="{{ route('thirdpartiescategories.edit', [$category->id]) }}" title="Modifica categoria"><i class='bx bx-edit'></i></a>
    {!! Form::open(['style'=>'','class'=>'float-end','method' => 'DELETE','route' => ['thirdpartiescategories.destroy', $category->id]]) !!}
    <a class="deleteitemformbutton" href="#" title="Cancella Categoria"><i class='bx bx-trash'></i></a>
    {!! Form::close() !!}
  </td>

  @if (count($category->children) > 0)
    @foreach ($category->children as $sub)
      @php $levelstr .= ' --> '; @endphp
      @php $level++; @endphp
      @include('layouts.subcategoriestable', ['category' => $sub,'level' => $level,'levelstr'=>$levelstr])
    @endforeach
  @endif
</tr>