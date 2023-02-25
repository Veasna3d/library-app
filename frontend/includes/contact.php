<!--CDN-->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<!-- Contact Start -->
<div id="contact" class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h6 class="section-title bg-white text-center text-primary px-3">Contact Us</h6>
            <h1 class="display-6 mb-4">If You Have Any Query, Please Feel Free Contact Us</h1>
        </div>
        <div class="row g-0 justify-content-center">
            <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.5s">
                <p class="text-center mb-4">The contact form is currently inactive. Get a functional and working contact
                    form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're
                    done. <a href="https://htmlcodex.com/contact-form">Download Now</a>.</p>
                <form id="contact-form">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="name"
                                    placeholder="Full Name">
                                <label for="subject">Name</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="email" class="form-control" name="email" placeholder="Email">
                                <label for="subject">Email</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea name="message" class="form-control" placeholder="Leave a message here"
                                    id="message" style="height: 200px"></textarea>
                                <label for="message">Message</label>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Send Message</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script>
$(document).ready(function() {
    $("#contact-form").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "submit.php",
            data: $(this).serialize(),
            success: function() {
                alert("Your message was sent successfully!");
            }
        });
    });
});
</script>