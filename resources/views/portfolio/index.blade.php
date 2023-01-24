@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel Interview Test</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('portfolio.create') }}"> Create New</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Name</th>
            <th>Date</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($portfolios as $portfolio)
        <tr>
            <td>{{ ++$i }}</td>
            <td><img src="{{  $portfolio->image }}" alt=""/></td>
            <td>{{ $portfolio->name }}</td>
            <td>{{ $portfolio->date }}</td>
            <td>
                <form action="{{ route('portfolio.edit',$portfolio->id) }}" method="POST">
                    <a href="" name="submit"class="btn btn-primary">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button> 

                </form> 
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $portfolios->links() !!}
</div>
</div>
@endsection
