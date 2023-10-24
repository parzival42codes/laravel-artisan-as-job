@include('artisan-as-job::header')

<div id="artisan-as-job" style="display:flex;">
    <div class="card" style="flex: 3;">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <tr class="table-light">
                    <th>
                        Artisan CMD
                    </th>
                    <th style="width: 100px;">
                        Artisan ID
                    </th>
                    <th style="width: 100px;">
                        Status
                    </th>
                    <th style="width: 250px; text-align: right;">
                        Created / Available
                    </th>
                </tr>

                @foreach ($artisanQueue as $artisan)
                    <tr>
                        <td>
                            @if($artisan->artisan_output)
                                <details>
                                    <summary>{{ $artisan->artisan_cmd }}</summary>
                                    {{ $artisan->artisan_output }}
                                </details>
                            @else
                                {{ $artisan->artisan_cmd }}
                            @endif
                        </td>
                        <td>
                            {{ $artisan->job_id }}
                        </td>
                        <td>
                            {{ $artisan->artisan_status }}
                        </td>
                        <td style="text-align: right;">
                            @if($artisan->created_at)
                                {{ $artisan->created_at->isoFormat('LLLL') }}
                            @endif
                            @if($artisan->job)
                                <br>  {{ $artisan->job->available_at->isoFormat('LLLL') }}
                            @endif
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>

    <div style="flex: 1;">
        <div class="card">
            <div class="card-header">First Job Queue ID</div>
            <div class="card-body">
                @if($startQueue)
                    {{ $startQueue->id }}
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                {{ Aire::open() }}
                {{ Aire::input('artisan_cmd','Artisan CMD')->value('optimize:clear') }}
                {{ Aire::submit() }}
                {{ Aire::close() }}
            </div>
        </div>
    </div>
</div>


@include('artisan-as-job::footer')
