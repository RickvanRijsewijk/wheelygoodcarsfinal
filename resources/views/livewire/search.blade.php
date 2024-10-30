<div>
    <input type="text" wire:model.live="searchTerm" placeholder="Search cars..." class="form-control mt-2">
    <div>
        @foreach ($results as $car)
            <div>
                <a href="{{ route('auto.details', $car->id) }}">
                    <p>{{ $car->model }}</p>
                </a>
            </div>
        @endforeach
    </div>
</div>
