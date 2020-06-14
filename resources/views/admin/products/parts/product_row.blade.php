<tr>
    <th scope="row">{{ $product->sku }}</th>
    <td><img src="{{Storage::url($product->thumbnail)}}" height="50" width="50"></td>
    <td>{{ $product->name }}</td>
    <td><a href="{{route('admin.categories.edit', $product->category->id)}}"  >{{$product->category->name}}</a></td>
    <td>{{ $product->short_description }}</td>
    <td>
        <div style="display: flex; flex-direction: row; align-items: center; justify-content: center">
            <a href="{{route('admin.products.edit', $product)}}"
               style="margin-right: 12px"
               class="btn btn-warning">{{__('Edit')}}</a>
            <form action="{{route('admin.products.destroy', $product)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">{{__('Delete')}}</button>
        </div>
       </form>
    </td>
</tr>
