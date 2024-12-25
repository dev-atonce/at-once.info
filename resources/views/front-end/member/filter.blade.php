@foreach ($filter->input as $k => $v)
    @if ($v->type == 'checkbox')
        <div class="form-group this-filter" data-val="{{@$myFilter[$v->name]}}" >
            <label for="{{ $v->name }}" class="bold text-secondary">
                <input class="filterSub" type="checkbox" name="{{ $v->name }}[]" id="{{ $v->name }}" value="1">
                {{ $v->label }}
            </label>
        </div>
    @endif
    @if ($v->type == 'text')
        @if ($v->name == 'location' || $v->name == 'warehouse' || $v->name == 'nationality' || $v->name == 'pick-up-point' || $v->name == 'destination')
            <div class="form-group this-filter" data-val="{{@$myFilter[$v->name]}}">
                <h6 class="bold text-secondary">{{ $v->label }}</h6>
                <div class="row ml-1">
                    <div class="col-lg-12">
                        <select name="{{ $v->name }}[]" class="{{ $v->name }} form-control" multiple="multiple">
                        @foreach ($filter->filter[$v->name] as $key => $val)
                            <option class="filterSub" value="{{$val->key}}">{{$val->name ? $val->name : $val->name_th}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>
        @else
            <div class="form-group this-filter" data-val="{{@$myFilter[$v->name]}}">
                <h6 class="bold text-secondary">{{ $v->label }}</h6>
                <div class="row ml-1 {{ $v->name }}">
                    @foreach ($filter->filter[$v->name] as $key => $val)
                        @php
                            $col = $v->name == 'service' ? 'col-lg-6' : 'col-lg-6';
                        @endphp
                        <div class="{{ $col }} d-flex">
                            <div class="mr-2">
                                <input class="filterSub" type="checkbox" name="{{ $v->name }}[]" id="{{ $v->name }}_{{ $key }}"
                                    value="{{ $val->key }}">
                            </div>
                            <div>
                                <label for="{{ $v->name }}_{{ $key }}"
                                    class="text-secondary">{{ $val->name ? $val->name : $val->name_th }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
@endforeach
