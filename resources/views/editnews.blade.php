@include('header')

        <!-- Content Start -->
        <div class="content">
        @include('navbar')


            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Add News</h6>
                            <form action="" method="post">
                                @csrf
                                @method('put')
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
                                    <label for="title" class="form-label" >Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="content" >Description</label>
                                    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Update</button>
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