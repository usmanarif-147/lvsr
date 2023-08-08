<div>
    <div>
        <div class="d-flex justify-content-between">
            <h2 class="card-header">
                {{ $heading }}
                <span>
                    <h5 style="margin-top:10px"> Total: {{ $total }} </h4>
                </span>
            </h2>
            <h5 class="card-header">
                <a class="btn btn-primary" href="{{ url('admin/template/create') }}"> Create
                </a>
            </h5>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-3 offset-md-3">
                    <label for=""> Select status </label>
                    <select wire:model="filterByStatus" class="form-control form-select me-2">
                        <option value="" selected> Select Status </option>
                        @foreach ($statuses as $val => $status)
                            <option value="{{ $val }}">{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for=""> Sort by </label>
                    <select wire:model="sortBy" class="form-control form-select me-2">
                        <option value="" selected> Select Sort </option>
                        <option value="created_asc"> Created Date (Low to High)</option>
                        <option value="created_desc"> Created Date (High to Low)</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for=""> Select Type </label>
                    <select wire:model="sortBy" class="form-control form-select me-2">
                        <option value="" selected> Select Type </option>
                        <option value="1"> Free </option>
                        <option value="2"> Pro </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="table-responsive text-nowrap">
                    <table class="table admin-table">
                        <thead class="table-light">
                            <tr>
                                <th> Image </th>
                                <th> Type </th>
                                <th> Status </th>
                                <th> Created at </th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($templates['templates'] as $template)
                                <tr>
                                    <td>
                                        <div class="img-holder">
                                            <img src="{{ asset(isImageExist($template->image)) }}">
                                        </div>
                                    </td>
                                    <td> {{ $template->type }}</td>
                                    <td>
                                        <span class="badge {{ model_status($template)['background'] }} me-1">
                                            {{ model_status($template)['status'] }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ defaultDateFormat($template->created_at) }}
                                    </td>
                                    <td class="action-td">
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt3"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                                <a class="btn btn-icon btn-outline-secondary" data-bs-toggle="tooltip"
                                                    data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                    title=""
                                                    data-bs-original-title="<i class='bx bx-edit-alt bx-xs' ></i> <span>Edit</span>"
                                                    href="{{ url('admin/template/' . $template->id . '/edit') }}">
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>
                                                @if ($template->status == 0)
                                                    <button class="btn btn-icon btn-outline-secondary"
                                                        data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                        data-bs-placement="top" data-bs-html="true" title=""
                                                        data-bs-original-title="<i class='fa fa-eye bx-xs' ></i> <span>Activate</span>"
                                                        wire:click="activateConfirmModal({{ $template->id }})">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                @else
                                                    <button class="btn btn-icon btn-outline-secondary"
                                                        data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                        data-bs-placement="top" data-bs-html="true" title=""
                                                        data-bs-original-title="<i class='fa fa-slash bx-xs' ></i> <span>Deactivate</span>"
                                                        wire:click="deactivateConfirmModal({{ $template->id }})">
                                                        <i class="fa fa-eye-slash"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="demo-inline-spacing">
                        @if ($templates['templates']->count() > 0)
                            {{ $templates['templates']->links() }}
                        @else
                            <p class="text-center"> No Record Found </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Modal -->
    @include('partials.confirm_modal')

</div>

@section('script')
    <script>
        window.addEventListener('swal:modal', event => {
            $('#confirmModal').modal('hide');
            swal({
                title: event.detail.message,
                icon: event.detail.type,
            });
        });

        window.addEventListener('close-modal', event => {
            $('#confirmModal').modal('hide');
        });

        window.addEventListener('confirm-modal', event => {
            $('#confirmModal').modal('show');
        });
    </script>
@endsection
