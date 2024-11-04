<x-filament::page>
    <video controls>
        <source src="{{ asset($this->record->video) }}" type="{{ Storage::disk('public')->mimeType($this->record->video) }}">
        Your browser does not support the video tag.
    </video>
</x-filament::page>