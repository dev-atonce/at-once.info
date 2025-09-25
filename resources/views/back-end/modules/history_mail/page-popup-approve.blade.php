<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="fade-id">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="breadcrumb-item active">
                        <a
                            href="{{ $segment == 'email-reject' ? $prefix . '/' . $segment : $prefix . '/' . $segment }}">{{ $segment == 'email-reject' ? 'Email Reject' : 'Email Approve' }}</a>
                    </span>
                </div>
                <div class="card-body">
                    <div class="card p-3">
                        <form method="get">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="keyword">Keyword:</label>
                                        <input type="text" name="keywords" id="keywords" class="form-control"
                                            value="{{ Request::get('keywords') }}">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 30px">
                                        <i class="fas fa-search fa-fw"></i>Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped no-footer table-res" id="sort_table" role="grid"
                                style="border-collapse: collapse !important">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>At-once Customer</th>
                                        <th>ชื่อผู้ส่ง</th>
                                        <th>เบอร์โทรศัพท์</th>
                                        <th>รายละเอียด</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($rows)
                                        @foreach ($rows as $key => $row)
                                            @php
                                                $fixedText = 'Pop-up from CP';
                                                $editableText = str_replace($fixedText, '', $row->message);
                                            @endphp
                                            <tr role="row" class="odd" data-row="{{ $key + 1 }}"
                                                data-id="{{ $row->id }}">
                                                <td class="date">{{ $row->created }}</td>
                                                <td class="name">{{ $row->company_name }}</td>
                                                <td class="name">{{ $row->name }}</td>
                                                <td class="telephone">{{ $row->telephone }}</td>

                                                <td class="content">
                                                    <span class="fixed-text">{{ $fixedText }}</span>
                                                    <span class="editable-text">{{ $editableText }}</span>
                                                </td>
                                                <td class="edit_content d-none" data-fixed="{{ $fixedText }}">
                                                    <span class="fixed-text">{{ $fixedText }}</span>
                                                    <textarea class="form-control mb-2" rows="6">{{ $editableText }}</textarea>
                                                    <div class="d-flex gap-2 justify-content-end">
                                                        <button class="btn btn-success btn-sm save-edit">✓</button>
                                                        <button class="btn btn-secondary btn-sm cancel-edit">✕</button>
                                                    </div>
                                                </td>

                                                <td class="status">
                                                    <div class="btn-group" role="group">
                                                        <button onclick="updateStatus('{{ $row->id }}' ,  'approve')" class="btn btn-success popup-approve">✓</button>
                                                        <button onclick="updateStatus('{{ $row->id}}' , 'reject')" class="btn btn-danger popup-reject">✕</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{ $rows->links() }}
                        </div>
                    </div>
                    <h1 class="pt-4 mt-2 border-top">Approve</h1>
                    <div class="dataApprove">
                        <div class="table-responsive">
                            <table class="table table-info table-striped no-footer table-res" id="sort_table" role="grid"
                                style="border-collapse: collapse !important;">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>At-once Customer</th>
                                        <th>ชื่อผู้ส่ง</th>
                                        <th>เบอร์โทรศัพท์</th>
                                        <th>รายละเอียด</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($dataApprove)
                                        @foreach ($dataApprove as $key => $data)
                                            <tr role="data" class="odd" data-data="{{ $key + 1 }}"
                                                data-id="{{ $data->id }}">
                                                <td class="date">{{ $data->created }}</td>
                                                <td class="name">{{ $data->company_name }}</td>
                                                <td class="name">{{ $data->name }}</td>
                                                <td class="telephone">{{ $data->telephone }}</td>
                                                <td class="message">{{ $data->message }}</td>

                                                <td class="status">
                                                    <div class="btn-group" role="group">
                                                        <button onclick="updateStatus('{{ $data->id }}' ,  'reset')" class="btn btn-danger">Reset</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{ $dataApprove->links() }}
                        </div>
                    </div>
                    <h1 class="pt-4 mt-2 border-top">Reject</h1>
                    <div class="dataReject">
                        <div class="table-responsive">
                            <table class="table table-secondary table-striped no-footer table-res" id="sort_table" role="grid"
                                style="border-collapse: collapse !important">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>At-once Customer</th>
                                        <th>ชื่อผู้ส่ง</th>
                                        <th>เบอร์โทรศัพท์</th>
                                        <th>รายละเอียด</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($dataReject)
                                        @foreach ($dataReject as $key => $data)
                                            <tr role="data" class="odd" data-data="{{ $key + 1 }}"
                                                data-id="{{ $data->id }}">
                                                <td class="date">{{ $data->created }}</td>
                                                <td class="name">{{ $data->company_name }}</td>
                                                <td class="name">{{ $data->name }}</td>
                                                <td class="telephone">{{ $data->telephone }}</td>
                                                <td class="message">{{ $data->message }}</td>

                                                <td class="status">
                                                    <div class="btn-group" role="group">
                                                        <button onclick="updateStatus('{{ $data->id }}' ,  'reset')" class="btn btn-danger">Reset</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{ $dataReject->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Popup Loading -->
<div id="loadingPopup" style="
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0,0,0,0.5);
    z-index: 9999;
    display: none;
    display: flex;
    align-items: center;
    justify-content: center;
">
    <div class="bg-white p-4 rounded shadow color-dark" style="color:black;">
        <strong>Update completed. The page is now refreshing...</strong>
    </div>
</div>
<script>
    $('#loadingPopup').hide();
    // click to edit message
    $(document).on('click', '.content' , function () {
        const td = $(this);
        td.addClass('d-none');
        td.next().removeClass('d-none')
    });

    // click to save message
    $(document).on('click', '.save-edit', function () {
        const td = $(this).closest('td');
        const id = $(this).closest('tr').data('id');
        const textarea = td.find('textarea').val();
        const fixedText = td.prev().find('.fixed-text').html();
        const newValue = fixedText + "\n" +textarea;
        const oldValue = td.prev().find('.editable-text').text();
        td.addClass('d-none');
        td.prev().removeClass('d-none')

        $.ajax({
            url: `/webpanel/popup-approve/update`,
            type: 'POST',
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: JSON.stringify({ id:id , message: newValue }),
            success: function (response) {
                console.log(response);
                if (response.status === 'success') {
                    td.prev().find('.editable-text').text(newValue)

                    location.reload();
                    $('#loadingPopup').show();
                } else {
                    td.find('textarea').val(oldValue);
                    alert('Update failed.');
                }
            },
            error: function () {
                td.find('textarea').val(oldValue);
                alert('Error');
            }
        });
    });

    // click to cancel message
    $(document).on('click', '.cancel-edit', function () {
        const td = $(this).closest('td');
        const tdPrev = td.prev();

        const textarea = td.find('textarea');
        const oldValue = td.prev().find('.editable-text').text();
        textarea.val(oldValue);

        td.addClass('d-none');
        td.prev().removeClass('d-none')
    });

    // click to update status approve
    function updateStatus(id , status) {
        $.ajax({
            url: `/webpanel/popup-approve/update`,
            type: 'POST',
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: JSON.stringify({ id:id , status: status }),
            success: function (response) {  
                console.log(response);
                if (response.status === 'success') {
                    location.reload();
                    $('#loadingPopup').show();
                } else {
                    alert('Update failed.');
                }
            },
            error: function () {
                alert('Error');
            }
        });
    }
</script>