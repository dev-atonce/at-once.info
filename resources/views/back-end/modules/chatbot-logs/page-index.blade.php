<div class="fade-in">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header py-2 px-3">
                    <span class="breadcrumb-item"><a href="{{ url("$prefix/dashboard") }}">Dashboard</a></span>
                    <span class="breadcrumb-item active text-dark">Chatbot Logs</span>
                    <div class="card-header-actions mr-2">
                        <small class="badge badge-secondary">
                            <a href="{{ url("$prefix/chatbot-logs/export") }}" target="_blank">
                                <i class="fas fa-file-export"></i> Export .csv
                            </a>
                        </small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="20%">Conversation ID</th>
                                    <th width="20%">User ID</th>
                                    <th width="40%">User Input</th>
                                    <th width="15%">Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rows as $key => $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->conversation_id }}</td>
                                    <td>{{ $row->user_id }}</td>
                                    <td>{{ $row->user_input }}</td>
                                    <td>{{ date('d-M-Y H:i:s', strtotime($row->created_at)) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $rows->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
