<form wire:submit.prevent="submitComment">
    <div class="form-group">
        <p>Comment:</p>
        <textarea wire:model="body" class="form-control" rows="3" style="width: 40%"></textarea>
        @error('body') <p class="text-danger">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Submit Comment</button>
</form>
