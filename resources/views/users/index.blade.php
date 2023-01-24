@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel Interview Test</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create New</a>
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
            <th>Name</th>
            <th>Email</th>
            <th>Birth Date</th>
            <th>Gender</th>
            <th>Phone</th>
            <th width="280px">Action</th>
            <th width="280px">Delete</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->dob }}</td>
            <td>{{ $user->gender }}</td>
            <td>{{ $user->phone }}</td>
            <td>
            <from>
                <a href="{{ route('users.edit',$user->id) }}" class="btn btn-sm btn-primary">Edit</a></td>
                
                <td>
                    <!--from action="{{ route('users.distroy',$user ) }}" method="post"-->
                        @csrf
                        @method('delete')
                        <button type="submit"  name="submit" onclick="return confirm('are you sure')"class="btn btn-sm btn-warning">Delete</a>
                    </from>
                </td>
    
                <!--form action="{{ route('users.edit',$user->id) }}" method="POST">
                 @method('put')
                <a href="submit" name="submit" class="btn btn-primary">Edit</a> 
                    <!-- <a class="btn btn-info">Show</a> 
                    <a class="btn btn-primary">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button--> 
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $users->links() !!}
</div></div>
<style>
    .w-5{
        display:none
    }
    </style>
@endsection

    