@include('header')
<!-- Content Start -->
<div class="content">
    @include('navbar')

    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Manage News Subategory</h6>
                <a href="addsubcategories">Add Subcategory</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">No</th>
                            <th scope="col">SubCategory</th>
                            <th scope="col">Category</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($query as $key => $q)
                        @foreach($q['subcategory'] as $keys => $qr)
                        <tr>
                            <td>{{$key + 1 }}</td>


                            <td>{{$qr['sname']}}</td>
                            <td>{{$q->name}}</td>

                            <td><a href="{{ url('/subcategories/edit', $qr->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <a href="{{ url('/subcategories/delete', $qr->id) }}" class="btn btn-danger btn-sm ">Delete</a>
                            </td>
                            @endforeach
                        @endforeach
                        </tr>
                    </tbody>
                </table>
                <!-- <table class="table table-bordered">
                            <thead>

                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">category</th>

                                    <th scope="col">operation</th>
                                </tr>

                            </thead>
                            @foreach($query as $key => $q)
                            <tbody>

                                <tr>
                                    <th scope="row">{{$key + 1}}</th>
                                    <td>{{$q->name}}</td>
                                    <td><a href="#" class="btn btn-info btn-sm">Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm ">Delete</a>
                                        <a href="#" class="btn btn-primary btn-sm " data-toggle="tooltip" title="subcategory" data-placement="top">subcategory</a>
                                       
                                    </td>
                                </tr>

                            </tbody>
                            @endforeach
                        </table> -->

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