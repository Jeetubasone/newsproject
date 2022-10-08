@include('header')

        <!-- Content Start -->
        <div class="content">
        @include('navbar')


            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Advertisement</h6>
                            <form action="/addads" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <select class="form-select" for="category_id" id="category_id" name="category_id" aria-label="Default select example">
                                        <option selected>Select Category</option>
                                        @foreach($query as $key => $q)
                                        <option id="category_id" name="category_id" value={{$q->id}}>{{$q->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <select class="form-select" for="subcategory_id" id="subcategory_id" name="subcategory_id" aria-label="Default select example">
                                        <option selected>Select SubCategory</option>
                                        @foreach($query1 as $key => $q)
                                        <option id="subcategory_id" name="subcategory_id" value={{$q->id}}>{{$q->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="mb-3">
                                    <label for="add_position" class="form-label">Position</label>
                                    <input type="text" class="form-control" id="add_position" name="add_position">
                                </div>
                                <div class="mb-3">
                                    <label for="add_rate" class="form-label">Rate</label>
                                    <input type="text" class="form-control" id="add_rate" name="add_rate">
                                </div>
                                <div class="mb-3">
                                    <label for="add_date" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="add_date" name="add_date">
                                </div>
                                <label class="form-label" for="add_image">Upload Image</label>
                                <input type="file" class="form-control" name="add_image" id="add_image" />
                                <br>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form End -->


            @include('footer')
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('jslibrary')
</body>

</html>