@extends('pages.layouts.master')

@section('content')
    <div class="card">
    <div class="card-body">
        <form action="{{url('url-link/store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="urls">URLs</label>
                <input type="text" class="form-control" name="urls" id="urls" aria-describedby="emailHelp" placeholder="urls">
                @if($errors->has('urls'))<strong class="alert alert-danger">{{$errors->first('urls')}}</strong>@endif
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection

@section('script')

@endsection

