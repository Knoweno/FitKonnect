<!-- Sliding Carousels -->
<div id="FitkonnectCarouselIndicators" class="carousel slide" data-ride="carousel" data-interval="5000">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="images/photo1.jpg" alt="Slide 1">
            <div class="carousel-caption d-flex align-items-center justify-content-center">
            <div>
                    <h3>Best Swimming Trainers</h3>
                    <p>Get expert swimming trainers to help you improve your skills and achieve your goals.</p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="images/photo2.jpg" alt="Slide 2">
            <div class="carousel-caption d-flex align-items-center justify-content-center">
            <div>
                    <h3>Best Swimming Trainers</h3>
                    <p>Get expert swimming trainers to help you improve your skills and achieve your goals.</p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="images/photo3.jpg" alt="Slide 3">
            <div class="carousel-caption d-flex align-items-center justify-content-center">
            <div>
                    <h3>Best Muscle Building Trainers</h3>
                    <p>Get expert guidance from our certified trainers to help you achieve your muscle building goals.</p>
                </div>
            </div>
        </div>
        <ol class="carousel-indicators">
            <li data-target="#FitkonnectCarouselIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#FitkonnectCarouselIndicators" data-slide-to="1"></li>
            <li data-target="#FitkonnectCarouselIndicators" data-slide-to="2"></li>
        </ol>
    </div>
    <a class="carousel-control-prev" href="#FitkonnectCarouselIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#FitkonnectCarouselIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<script>
        $(document).ready(function () {
            var navbar = $('.navbar');
            var content = $('.content');

            $(window).scroll(function () {
                var scroll = $(window).scrollTop();
                var contentOffset = content.offset().top;

                if (scroll >= contentOffset * 0.05) {
                    navbar.addClass('fixed-top');
                } else {
                    navbar.removeClass('fixed-top');
                }
            });
        });
    </script>