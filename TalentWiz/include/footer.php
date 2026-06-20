                </div><!-- /#containerInner -->
            </div><!-- /#containerOuter -->

            <footer class="tw-footer mt-auto py-3">
                <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
                    <span>&copy; 2014&ndash;<?php echo date('Y'); ?>
                        <a href="http://alphaitworld.co.in">Alpha Net Technologies Pvt. Ltd.</a>
                    </span>
                    <span class="d-flex gap-3">
                        <a href="#">Disclaimer</a>
                        <a href="#">Privacy Policy</a>
                        <a href="#">Copyright</a>
                        <a href="#">Site map</a>
                    </span>
                </div>
            </footer>
        </div><!-- /#mainContainer -->

        <!-- Bootstrap 5 bundle (navbar toggler + dropdowns), vendored locally.
             Works alongside the upgraded jQuery 3.7.1 loaded in the header. -->
        <script src="<?php echo URL ?>scripts/bootstrap/bootstrap.bundle.min.js?v=3"></script>

        <script>
            // Explicitly initialise navbar dropdowns (belt & suspenders).
            document.addEventListener('DOMContentLoaded', function () {
                if (window.bootstrap && bootstrap.Dropdown) {
                    document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach(function (el) {
                        bootstrap.Dropdown.getOrCreateInstance(el);
                    });
                }
            });
        </script>
    </body>
</html>
