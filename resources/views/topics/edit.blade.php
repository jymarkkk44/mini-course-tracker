<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Topic</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto px-4 py-6">
        <a href="{{ url('/') }}" class="inline-block bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 mb-4">
            ← Back to Home
        </a>

        <h1 class="text-2xl font-bold mb-4">Edit Topic</h1>

        <form action="{{ route('topics.update', $topic->id) }}" method="POST" class="bg-white p-4 rounded shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Title:</label>
                <input type="text" name="title" value="{{ old('title', $topic->title) }}" required class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Status:</label>
                <select name="status" class="w-full px-3 py-2 border rounded">
                    <option value="not_started" {{ $topic->status == 'not_started' ? 'selected' : '' }}>Not Started</option>
                    <option value="in_progress" {{ $topic->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="done" {{ $topic->status == 'done' ? 'selected' : '' }}>Done</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Time Spent (minutes):</label>
                <input type="number" name="time_spent" value="{{ old('time_spent', $topic->time_spent) }}" class="w-full px-3 py-2 border rounded">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Topic</button>
        </form>
    </div>
</body>
</html>
