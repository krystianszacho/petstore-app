<div class="container">
    <h1>Pets</h1>
    <a href="{{ route('pets.create') }}" class="btn btn-primary">Add Pet</a>
    <table class="table mt-3">
        <tbody>
            @foreach ($pets as $pet)
            <tr>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
        <tbody>
            @foreach ($pets as $pet)
            <tr>
                <td>{{ $pet['id'] ?? 'No ID' }}</td>
                <td>{{ $pet['name'] ?? 'No name' }}</td>
                <td>{{ $pet['category']['name'] ?? 'No category' }}</td>
                <td>{{ $pet['status'] ?? 'No status' }}</td>
                <td>
                    <a href="{{ route('pets.edit', $pet['id']) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
</div>