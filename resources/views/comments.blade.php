<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Comments</div>
                <div class="card-body">
                    <div class="row add-comment">
                        @auth
                        <div class="comment-alert"></div>
                        <div class="form-group col-md-12">
                            <label for="name">Name <small>(required)</small></label>
                            <input type="text" name="name" class="form-control comment-name" placeholder="Enter Name">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="comment">Comment <small>(required)</small></label>
                            <textarea class="form-control comment-desc" name="comment" rows="3"></textarea>
                        </div>
                        <button class="btn btn-primary mb-2" id="add-comment">Add Comment</button>

                        @endauth
                    </div>
                    <div class="row comments"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>