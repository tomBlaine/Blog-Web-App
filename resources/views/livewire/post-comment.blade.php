<form wire:submit.prevent="submitComment">
    <div class="form-group">
        <textarea wire:model="body" class="form-control" rows="3"></textarea>
        @error('body') <p class="text-danger">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Submit Comment</button>
</form>
