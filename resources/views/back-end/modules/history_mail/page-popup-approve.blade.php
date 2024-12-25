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
                                        <div class="form-group">
                                            <label for="keyword">Reject By:</label>
                                            <select name="rejectby" id="rejectby" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($userAction as $k => $v)
                                                    <option value="{{ $v->id }}"
                                                        @if (Request::get('rejectby') == $v->id) selected @endif>
                                                        {{ $v->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="keyword">Person In Charge:</label>
                                            <select name="cs" id="cs" class="form-control">
                                                <option value="">Select</option>
                                                @foreach(\App\Models\UsersMd::select('id','name')->where('name',['BUM','MAY','BANANA','BALL','YOYO'])->get() as $k => $v)
                                                <option value="{{$v->id}}"
                                                    @if (Request::get('cs') == $v->id) selected @endif>{{$v->name}}
                                                </option>
                                                @endforeach
                                                {{-- <option value="50"
                                                    @if (Request::get('cs') == '50') selected @endif>May
                                                </option>
                                                <option value="51"
                                                    @if (Request::get('cs') == '51') selected @endif>Banana
                                                </option>
                                                <option value="52"
                                                    @if (Request::get('cs') == '52') selected @endif>Ball
                                                </option>
                                                <option value="53"
                                                    @if (Request::get('cs') == '53') selected @endif>Yoyo
                                                </option> --}}
                                            </select>
                                        </div>
                                    </div>
                                <div class="col-lg-2">
                                    <label for="keyword">Date:</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Date" aria-label="Date"
                                            name="date" id="date" autocomplete="off">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary reset-date"
                                                type="button">Reset</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 30px">
                                        <i class="fas fa-search fa-fw"></i>Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>