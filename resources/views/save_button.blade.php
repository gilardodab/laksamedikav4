<!-- resources/views/save_button.blade.php -->

<form method="post" action="{{ route('save') }}">
    @csrf
    <button type="submit">Save</button>
</form>
