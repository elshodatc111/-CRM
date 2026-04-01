<div class="table-responsive">
    <table class="table table-hover table-bordered border-primary align-middle" style="font-size: 14px">
        <thead class="table-light text-center">
            <tr>
                <th>#</th>
                <th>{{ __('childLead.fio') }}</th>
                <th>{{ __('childLead.asosiy_phone') }}</th>
                <th>{{ __('childLead.tkun') }}</th>
                <th>{{ __('childLead.address') }}</th>
                <th>{{ __('childLead.xolat') }}</th>
                <th>{{ __('childLead.registr') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($childLead as $child)
            <tr>
                <td class="text-center">{{ ($childLead->currentPage()-1) * $childLead->perPage() + $loop->index + 1 }}</td>
                <td class="fw-bold">
                    <a href="{{ route('childLead_show', $child->id) }}">{{ $child->name }}</a>
                </td>
                <td class="text-center">{{ $child->phone }}</td>
                <td class="text-center">{{ $child->tkun->format('d.m.Y') }}</td>
                <td>{{ $child->address }}</td>
                <td class="text-center">
                    @if($child->status=='new')
                        <span class="badge bg-primary">{{ __('childLead.new') }}</span>
                    @elseif($child->status=='pending')
                        <span class="badge bg-warning text-white">{{ __('childLead.pending') }}</span>
                    @elseif($child->status=='success')
                        <span class="badge bg-success">{{ __('childLead.success') }}</span>
                    @else
                        <span class="badge bg-danger">{{ __('childLead.cancel') }}</span>
                    @endif
                </td>
                <td class="text-center">{{ $child->created_at->format('d.m.Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">{{ __('childLead.not_found') }}</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-end mt-3">
    {{ $childLead->links('pagination::bootstrap-5') }}
</div>