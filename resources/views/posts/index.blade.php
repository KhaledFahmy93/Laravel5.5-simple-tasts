@extends('layout')



@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel CRUD</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('posts.create') }}"> Create New Article</a>
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
            <th>Posted By</th>
            <th>Slug</th>
            <th> Created at </th>
            <th> Image </th>
            <th width="280px">Action</th>
        </tr>

    @foreach ($posts as $post)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $post->title}}</td>
        <td>{{ $post->user->name}}</td>
        <td>{{ $post->slug}}</td>
        <td>{{ $post->created_at}}</td>
        <td><img width="50px" heigth="50px" src="{{Storage::url($post->image)}}">  </td>

        <td>
            <a class="btn btn-info" href="{{ route('posts.show',$post->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('posts.edit',$post->id) }}">Edit</a>

            {!! Form::open(['method' => 'DELETE','route' => ['posts.destroy', $post->id],'style'=>'display:inline']) !!}
            <input type="submit" value="delete" class='btn btn-danger' onclick="return confirm('Are you sure you want to delete this item?');">
            {!! Form::close() !!}
        </td>
    </tr>

    @endforeach
    </table>

    {!! $posts->links() !!}

    

<script>
    $(document).ready(function () {

        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }

        });


        $(document).on('confirm', function (e) {
            
            var ele = e.target;

            e.preventDefault();


            $.ajax({

                url: ele.href,
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                success: function (data) {

                    if (data['success']) {

                        $("#" + data['tr']).slideUp("slow");

                        alert(data['success']);

                    } else if (data['error']) {

                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }

                },

                error: function (data) {
                    alert(data.responseText);
                }
            });

            return false;
        });
    });

</script>

@endsection
