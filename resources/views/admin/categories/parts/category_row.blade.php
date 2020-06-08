<tr>
    <th scope="row">{{ $category->id }}</th>
    <td>{{ $category->name }}</td>
    <td>{{ $category->shortDescription }}</td>
    <td>
        <div style="display: flex; flex-direction: row; align-items: center; justify-content: center">
            <a href="{{route('admin.categories.edit', $category)}}"
               style="margin-right: 12px"
               class="btn btn-warning">{{__('Edit')}}</a>
            <form action="{{route('admin.categories.destroy', $category)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">{{__('Delete')}}</button>
        </div>
       </form>
    </td>
</tr>
