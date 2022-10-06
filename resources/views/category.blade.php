@include('header')


<!-- Content Start -->
<div class="content">
    @include('navbar')

    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Manage News Category</h6>
                <a href="/add">Add New Category</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($query as $key => $q)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$q->name}}</td>
                            <td><a href="{{ url('/categorys/edit', $q->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <a href="{{ url('/categorys/delete', $q->id) }}" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->


    @include('footer')
</div>
<!-- Content End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

@include('jslibrary')
</body>

</html>