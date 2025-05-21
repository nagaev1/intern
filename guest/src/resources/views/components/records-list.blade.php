<div id="records-list">
    @foreach ($records as $record)
        {{ $record->comment }}
    @endforeach
</div>