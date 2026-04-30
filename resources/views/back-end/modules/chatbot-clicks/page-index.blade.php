<div class="fade-in">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header py-2 px-3">
                    <span class="breadcrumb-item"><a href="{{ url("$prefix/dashboard") }}">Dashboard</a></span>
                    <span class="breadcrumb-item active text-dark">Chatbot Clicks</span>
                    <div class="card-header-actions mr-2">
                        <small class="badge badge-secondary">
                            <a href="{{ url("$prefix/chatbot-clicks/export") }}" target="_blank">
                                <i class="fas fa-file-export"></i> Export .csv
                            </a>
                        </small>
                    </div>
                    <div class="card-header-actions mr-2">
                        <span class="badge badge-primary badge-pill">{{ $rows->total() }} companies</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="25%">Company Name</th>
                                    <th width="20%">Category</th>
                                    <th width="15%">Profile URL</th>
                                    <th width="10%" class="text-center">Total Clicks</th>
                                    <th width="15%" class="text-center">Last Click</th>
                                    <th width="10%" class="text-center">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rows as $key => $row)
                                <tr>
                                    <td>{{ $rows->firstItem() + $key }}</td>
                                    <td>
                                        <strong>{{ $row->company_name }}</strong>
                                    </td>
                                    <td><small class="text-muted">{{ $row->category }}</small></td>
                                    <td>
                                        <a href="https://at-once.info/th/{{ $row->category }}/cp/{{ $row->profile_url }}" 
                                           target="_blank" class="text-info">
                                            <small>{{ $row->profile_url }}</small>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-success badge-pill" style="font-size:1rem;">
                                            {{ number_format($row->total_clicks) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <small>{{ date('d-M-Y H:i', strtotime($row->last_click)) }}</small>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url("$prefix/chatbot-clicks/" . urlencode($row->profile_url)) }}" 
                                           class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-list-ul"></i> Log
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                        No chatbot click data yet.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $rows->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
