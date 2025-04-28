@foreach ($posts as $post)
<tr>
    <th scope="row">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="chk_child">
        </div>
    </th>
    <td class="title">{{ $post->title }}</td>
    <td class="thumbnail">
        @if ($post->thumbnail)
            <img src="{{ asset('uploads/posts/' . $post->thumbnail) }}" 
                 alt="{{ $post->title }}"
                 style="width:80px; height:80px; object-fit: cover;">
        @else
            N/A
        @endif
    </td>
    <td class="category">{{ $post->category->name }}</td>
    <td class="user">{{ $post->user->name }}</td>
    <td class="status">
        <span class="badge 
            @if ($post->status == 'published') bg-success-subtle text-success 
            @elseif($post->status == 'draft') bg-warning-subtle text-warning 
            @else bg-danger-subtle text-danger @endif">
            {{ ucfirst($post->status) }}
        </span>
    </td>
    <td>

    </td>
</tr>
@endforeach