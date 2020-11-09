@extends('layouts.admin')

@section('title')
    <title>Admin</title>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'Category', 'key' => 'list'])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          <a href="{{ route('categories.create') }}" class="btn btn-success float-right m-1">Add</a>
          </div>
         <div class="col-md-12">
            <table class="table">
                <thead class="thead-light">
                  <tr class="row">
                    <th class="col-md-1">#</th>
                    <th class="col-md-9">Tên danh mục</th>
                    <th class="col-md-2">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr class="row">
                            <th class="col-md-1">{{ $category->id }}</th>
                            <td class="col-md-9">{{ $category->name }}</td>
                            <td class="col-md-2">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('categories.delete', $category->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
         </div>
         <div class="col-md-12" style="display: flex;  justify-content: center; align-items: center; margin-bottom: 10px;">
             {{ $categories->links() }}
         </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
