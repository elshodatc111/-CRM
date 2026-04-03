<div class="table-responsive">
    <table class="table table-hover table-bordered border-primary align-middle" style="font-size: 14px">
        <thead class="table-light text-center">
            <tr>
                <th>#</th>
                <th>{{ __('child.fio') }}</th>
                <th>{{ __('child.guvohnoma') }}</th>
                <th>{{ __('child.phone') }}</th>
                <th>{{ __('child.tkun') }}</th>
                <th>{{ __('child.balans') }}</th>
                <th>{{ __('child.holat') }}</th>
                <th>{{ __('child.reg_date') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($childs as $child)
            <tr>
                <td class="text-center">{{ ($childs->currentPage()-1) * $childs->perPage() + $loop->index + 1 }}</td>
                <td class="fw-bold">
                    <a href="{{ route('child_show', $child->id) }}">{{ $child->name }}</a>
                </td>
                <td>{{ $child->guvohnoma }}</td>
                <td class="text-center">{{ $child->phone }}</td>
                <td class="text-center">{{ $child->tkun->format('d.m.Y') }}</td>
                <td class="text-center" class="text-primary fw-bold">{{ $child->formatted_balans }}</td>
                <td class="text-center">
                    @if($child->is_active)
                        <span class="badge bg-success">Aktiv</span>
                    @else
                        <span class="badge bg-danger">Noaktiv</span>
                    @endif
                </td>
                <td class="text-center">{{ $child->created_at->format('d.m.Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">{{ __('child.no_data') }}</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-end mt-3">
    {{ $childs->links('pagination::bootstrap-5') }}
</div>