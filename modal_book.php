<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Modal title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="contact-form" role="form" action="" method="post">

                    <div class="col-md-12 col-sm-12">
                        <input type="text" class="form-control" placeholder="Enter full name" name="name" required="">

                        <input type="email" class="form-control" placeholder="Enter email address" name="email"
                            required="">

                        <textarea class="form-control" rows="6" placeholder="Tell us about your message" name="message"
                            required=""></textarea>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <input type="submit" class="form-control" name="send message" value="Send Message">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>