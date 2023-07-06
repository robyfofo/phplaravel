<!-- Displaying the current category -->
<tr class="treegrid-{{ $category->id }}{{ $category->parent_id > 0 ? ' treegrid-parent-'.$category->parent_id : '' }}" valign="top">
  <td class="tree-simbol"></td>
  <td>{{ $category->id }}</td>
  <td>{{ $category->parent_id }}</td>
  <td>{{ $level }}</td>
  <td>{{ $category->title }}</td>


  <!-- If category has children -->
  @if (count($category->children) > 0)
    <!-- Loop through this category's children -->
    @foreach ($category->children as $sub)

      @php $level++; @endphp

      <!-- Call this blade file again (recursive) and pass the current subcategory to it -->
      @include('layouts.subcategoriestable', ['category' => $sub,'level' => $level])


    @endforeach
  @endif
</tr>