<div>
    <div>
        <div class="d-flex justify-content-between">
            <h2 class="card-header">
                <a href="{{ url('admin/font-styles') }}"> Font Styles </a> / {{ $heading }}
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <form wire:submit.prevent="store">
                    <div class="card-body">
                        <div class="row">
                            <div id="container">
                                <h1 style="font-size: 50px;">Font style</h1>
                                <div id="text">
                                    <p class="display-6">
                                        Grumpy wizards make toxic brew for the evil Queen and Jack.
                                        Grumpy wizards make toxic brew for the evil Queen and Jack.
                                        Grumpy wizards make toxic brew for the evil Queen and Jack.
                                        Grumpy wizards make toxic brew for the evil Queen and Jack.
                                        Grumpy wizards make toxic brew for the evil Queen and Jack.
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Select Font Style <span class="text-danger"> * </span>
                                            @error('font_style')
                                                <span class="text-danger error-message">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <select class="form-select" wire:model.lazy="font_style" id='select'
                                            onChange="fontChange();">
                                            @foreach ($styles as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Type <span class="text-danger"> * </span>
                                            @error('type')
                                                <span class="text-danger error-message">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <select class="form-select" wire:model="type">
                                            <option value="0" selected="">Select</option>
                                            <option value="1">Free</option>
                                            <option value="2">Pro</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" {{ $isDisabled ? 'disabled' : '' }}
                                class="btn btn-primary">Save</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
        function fontChange() {
            var x = document.getElementById("select").selectedIndex;
            var y = document.getElementById("select").options;

            document.body.insertAdjacentHTML("beforeend", "<style> #text{ font-family:'" + y[x].text + "';} </style>");
        }

        window.addEventListener('swal:modal', event => {
            swal({
                title: event.detail.message,
                icon: event.detail.type,
            });
        });
    </script>
@endsection
