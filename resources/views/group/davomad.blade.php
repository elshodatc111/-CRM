<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-6">
        <h5 class="card-title text-primary">{{ __('group_davomad.groups') }}</h5>
      </div>
      <div class="col-6" style="text-align: right">
        <h5 class="card-title text-primary">{{ date('d.m.Y') }}</h5>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered table-striped" style="font-size: 14px">
        <thead class="">
          <tr class="text-center">
            <th class="bg-primary text-white">#</th>
            <th class="bg-primary text-white">{{ __('group_davomad.group') }}</th>
            <th class="bg-primary text-white">{{ __('group_davomad.davomad') }}</th>
            <th class="bg-primary text-white">{{ __('group_davomad.child_count') }}</th>
            <th class="bg-primary text-white">{{ __('group_davomad.keldi') }}</th>
            <th class="bg-primary text-white">{{ __('group_davomad.kechikdi') }}</th>
            <th class="bg-primary text-white">{{ __('group_davomad.kelmadi') }}</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($res['groups'] as $item)
            <tr class="text-center">
              <td>{{ $loop->index+1 }}</td>
              <td style="text-align: left">
                @if($item['users_count']>0)
                  <a href="{{ route('groups_davomad_show',$item['group_id']) }}">{{ $item['group_name'] }}</a></td>
                @else
                  {{ $item['group_name'] }}
                @endif
              <td>
                @if($item['is_done'])
                  <span class="btn btn-success p-0 px-1"><i class="bi bi-calendar-check"></i></span>
                @else 
                  <span class="btn btn-danger p-0 px-1"><i class="bi bi-calendar-minus"></i></span>
                @endif
              </td>
              <td>{{ $item['users_count'] }}</td>
              <td>{{ $item['keldi'] }}</td>
              <td>{{ $item['kechikdi'] }}</td>
              <td>{{ $item['kelmadi'] }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center">{{ __('group_davomad.not_fount_groups')}}</td>
            </tr>
          @endforelse
        </tbody>
        <tfoot>
          <tr class="text-center">
            <th></th>
            <th> </th>
            <th>{{ $res['chart']['group_davomad'] }}</th>
            <th>{{ $res['chart']['total_users'] }}</th>
            <th>{{ $res['chart']['total_keldi'] }}</th>
            <th>{{ $res['chart']['total_kelmadi'] }}</th>
            <th>{{ $res['chart']['total_kechikdi'] }}</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>