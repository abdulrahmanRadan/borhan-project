<video controls width="250">
    <source src="{{ asset('storage/' . $getState()) }}" type="{{ Storage::disk('public')->mimeType($getState()) }}">
    Your browser does not support the video tag.
</video>


{{-- <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach ($getState() as $video)
        <div class="p-4 border rounded-lg">
            <h3 class="text-lg font-semibold mb-2">{{ $video->title }}</h3>
            <video controls class="w-full h-auto mb-2">
                <source src="{{ asset('storage/' . $video->video_path) }}" type="{{ Storage::disk('public')->mimeType($video->video_path) }}">
                المتصفح الخاص بك لا يدعم عرض الفيديو.
            </video>
            <p class="text-sm text-gray-600">{{ $video->description }}</p>
        </div>
    @endforeach
</div> --}}