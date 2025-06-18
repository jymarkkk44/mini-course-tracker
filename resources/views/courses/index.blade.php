<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mini Course Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">📚 Mini Course Tracker</h1>

        <!-- Flash Message -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add Course - moved to top -->
        <div class="bg-white p-4 rounded shadow mb-8">
            <h2 class="text-lg font-semibold mb-2">➕ Add New Course</h2>
            <form action="/courses" method="POST">
                @csrf
                <div class="flex gap-2">
                    <input type="text" name="title" required placeholder="Course Title" class="border px-2 py-1 rounded w-1/2">
                    <button type="submit" class="bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600">Add Course</button>
                </div>
            </form>
        </div>

        <!-- Course List -->
        @foreach ($courses as $course)
            <div class="bg-white p-4 rounded shadow mb-6">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-xl font-semibold">{{ $course->title }}</h2>
                    <div class="flex items-center gap-2">
                        <a href="/courses/{{ $course->id }}/edit" class="text-blue-500 text-sm hover:underline">Edit</a>

                        <form action="/courses/{{ $course->id }}" method="POST" onsubmit="return confirm('Delete course?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 text-sm hover:underline">Delete</button>
                        </form>
                    </div>
                </div>

                <!-- Progress Bar -->
                @php
                    $total = $course->topics->count();
                    $done = $course->topics->where('status', 'done')->count();
                    $percent = $total > 0 ? round(($done / $total) * 100) : 0;
                @endphp
                <div class="w-full bg-gray-200 rounded-full h-4 mb-2">
                    <div class="bg-green-500 h-4 rounded-full" style="width: {{ $percent }}%;"></div>
                </div>
                <p class="text-sm mb-4">{{ $percent }}% complete</p>

                <!-- Topic Filter -->
                <form method="GET" action="/">
                    <label for="filter" class="text-sm font-semibold">Filter Topics:</label>
                    <select name="status" onchange="this.form.submit()" class="ml-2 px-2 py-1 border rounded text-sm">
                        <option value="">All</option>
                        <option value="not_started" {{ request('status') == 'not_started' ? 'selected' : '' }}>Not Started</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                </form>

                <!-- Topics List -->
                @foreach ($course->topics as $topic)
                    @if (!request('status') || request('status') === $topic->status)
                        <div class="flex justify-between items-center border-t py-2">
                            <div>
                                <p class="text-sm font-semibold">{{ $topic->title }}</p>
                                <p class="text-xs text-gray-600">
                                    Status: {{ ucfirst($topic->status) }} | Time: {{ $topic->time_spent ?? '0' }} mins
                                </p>
                            </div>
                            <div class="flex items-center gap-2">
                                <a href="/topics/{{ $topic->id }}/edit" class="text-blue-500 text-xs hover:underline">Edit</a>

                                <form action="/topics/{{ $topic->id }}" method="POST" onsubmit="return confirm('Delete topic?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 text-xs hover:underline">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach

                <!-- Add Topic -->
                <form action="/topics" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <div class="flex flex-wrap gap-2">
                        <input type="text" name="title" placeholder="New Topic Title" required class="border px-2 py-1 rounded w-1/4">
                        <select name="status" class="border px-2 py-1 rounded w-1/4">
                            <option value="not_started">Not Started</option>
                            <option value="in_progress">In Progress</option>
                            <option value="done">Done</option>
                        </select>
                        <input type="number" name="time_spent" placeholder="Time (mins)" class="border px-2 py-1 rounded w-1/4">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600">Add Topic</button>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
</body>
</html>
