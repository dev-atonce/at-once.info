<div class="fade-in">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header py-2 px-3">
                    <span class="breadcrumb-item"><a href="{{ url("$prefix/dashboard") }}">Dashboard</a></span>
                    <span class="breadcrumb-item"><a href="{{ url("$prefix/chatbot-clicks") }}">Chatbot Clicks</a></span>
                    <span class="breadcrumb-item active text-dark">{{ $profileUrl }}</span>
                    <div class="card-header-actions">
                        <a href="{{ url("$prefix/chatbot-clicks") }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                    <div class="card-header-actions mr-2">
                        <small class="badge badge-secondary">
                            <a href="{{ url("$prefix/chatbot-clicks/" . urlencode($profileUrl) . "/export") }}" target="_blank">
                                <i class="fas fa-file-export"></i> Export .csv
                            </a>
                        </small>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Summary by language --}}
                    @if($summary->count())
                    <div class="row mb-3">
                        @foreach($summary as $s)
                        <div class="col-auto">
                            <div class="card border-info text-center px-3 py-2">
                                <small class="text-muted">{{ strtoupper($s->lang ?: 'N/A') }}</small>
                                <strong class="text-info">{{ number_format($s->cnt) }}</strong>
                                <small>clicks</small>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-auto">
                            <div class="card border-success text-center px-3 py-2">
                                <small class="text-muted">TOTAL</small>
                                <strong class="text-success">{{ number_format($logs->total()) }}</strong>
                                <small>clicks</small>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Detail log table --}}
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="10%">Lang</th>
                                    <th width="20%">IP Address</th>
                                    <th width="40%">User Agent</th>
                                    <th width="25%">Clicked At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logs as $key => $log)
                                <tr>
                                    <td>{{ $logs->firstItem() + $key }}</td>
                                    <td><span class="badge badge-info">{{ strtoupper($log->lang ?: '-') }}</span></td>
                                    <td><code>{{ $log->ip }}</code></td>
                                    <td><small class="text-muted">{{ Str::limit($log->user_agent, 80) }}</small></td>
                                    <td>{{ date('d-M-Y H:i:s', strtotime($log->created_at)) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No records found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
