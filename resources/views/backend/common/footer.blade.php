<!-- FOOTER -->
            <footer class="footer">
                <div class="container">
                    <div class="row align-items-center flex-row-reverse">
                        <div class="col-md-12 col-sm-12 text-center">
                            Copyright © 2025 <a href="#">Podcast Rank </a>All rights reserved. Developed with <span class="fa fa-heart text-danger"></span> by <a href="https://devsagar.online/" target="_blank"> Avijit Sagar </a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- FOOTER CLOSED -->

        </div>
        <!-- page -->

        <!-- BACK-TO-TOP -->
        <a href="#top" id="back-to-top"><i class="fa fa-long-arrow-up"></i></a>

        <!-- JQUERY JS -->
        <script src="{{ asset('') }}backend/assets/plugins/jquery/jquery.min.js"></script>

        <!-- BOOTSTRAP JS -->
        <script src="{{ asset('') }}backend/assets/plugins/bootstrap/js/popper.min.js"></script>
        <script src="{{ asset('') }}backend/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

        <!-- SIDE-MENU JS -->
        <script src="{{ asset('') }}backend/assets/plugins/sidemenu/sidemenu.js"></script>

        <!-- Perfect SCROLLBAR JS-->
        <script src="{{ asset('') }}backend/assets/plugins/p-scroll/perfect-scrollbar.js"></script>
        <script src="{{ asset('') }}backend/assets/plugins/p-scroll/pscroll.js"></script>

        <!-- STICKY JS -->
        <script src="{{ asset('') }}backend/assets/js/sticky.js"></script>

        <!-- Bootstrap-Date Range Picker js-->
		<script src="{{ asset('') }}backend/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>

		<!-- bootstrap-datepicker js (Date picker Style-01) -->
		<script src="{{ asset('') }}backend/assets/plugins/bootstrap-datepicker/js/datepicker.js"></script>

		<!-- SELECT2 JS -->
		<script src="{{ asset('') }}backend/assets/plugins/select2/select2.full.min.js"></script>

		<!-- FORM ELEMENTS JS -->
		<script src="{{ asset('') }}backend/assets/js/formelementadvnced.js"></script>

        
        <!-- APEXCHART JS -->
        <script src="{{ asset('') }}backend/assets/js/apexcharts.js"></script>

        <!-- INTERNAL SELECT2 JS -->
        <script src="{{ asset('') }}backend/assets/plugins/select2/select2.full.min.js"></script>

        <!-- CHART-CIRCLE JS-->
        <script src="{{ asset('') }}backend/assets/plugins/circle-progress/circle-progress.min.js"></script>

        <!-- DATA TABLE JS-->
		<script src="{{ asset('') }}backend/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
		<script src="{{ asset('') }}backend/assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
		<script src="{{ asset('') }}backend/assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
		<script src="{{ asset('') }}backend/assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
		<script src="{{ asset('') }}backend/assets/plugins/datatable/js/jszip.min.js"></script>
		<script src="{{ asset('') }}backend/assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
		<script src="{{ asset('') }}backend/assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
		<script src="{{ asset('') }}backend/assets/plugins/datatable/js/buttons.html5.min.js"></script>
		<script src="{{ asset('') }}backend/assets/plugins/datatable/js/buttons.print.min.js"></script>
		<script src="{{ asset('') }}backend/assets/plugins/datatable/js/buttons.colVis.min.js"></script>
		<script src="{{ asset('') }}backend/assets/plugins/datatable/dataTables.responsive.min.js"></script>
		<script src="{{ asset('') }}backend/assets/plugins/datatable/responsive.bootstrap5.min.js"></script>
		<script src="{{ asset('') }}backend/assets/js/table-data.js"></script>

        <!-- INTERNAL DATA-TABLES JS-->
        {{-- <script src="{{ asset('') }}backend/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('') }}backend/assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
        <script src="{{ asset('') }}backend/assets/plugins/datatable/dataTables.responsive.min.js"></script> --}}

        <!-- INDEX JS -->
        <script src="{{ asset('') }}backend/assets/js/index1.js"></script>
        <script src="{{ asset('') }}backend/assets/js/index.js"></script>

        <!-- Reply JS-->
		<script src="{{ asset('') }}backend/assets/js/reply.js"></script>

        <!--Internal Fileuploads js-->
		<script src="{{ asset('') }}backend/assets/plugins/fileuploads/js/fileupload.js"></script>
		<script src="{{ asset('') }}backend/assets/plugins/fileuploads/js/file-upload.js"></script>
        
        <!-- COLOR THEME JS -->
        <script src="{{ asset('') }}backend/assets/js/themeColors.js"></script>

        <!-- CUSTOM JS -->
        <script src="{{ asset('') }}backend/assets/js/custom.js"></script>

        <!-- SWITCHER JS -->
        <script src="{{ asset('') }}backend/assets/switcher/js/switcher.js"></script>

        <!-- INTERNAL Summernote Editor js -->
		<script src="{{ asset('') }}backend/assets/plugins/summernote-editor/summernote1.js"></script>
		<script src="{{ asset('') }}backend/assets/js/summernote.js"></script>

        <!-- WYSIWYG Editor JS -->
		<script src="{{ asset('') }}backend/assets/plugins/wysiwyag/jquery.richtext.js"></script>
		<script src="{{ asset('') }}backend/assets/plugins/wysiwyag/wysiwyag.js"></script>


        <!-- dynamic script for adding and removing plan features -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const container = document.getElementById('plan-features-container');
                const addBtn = document.getElementById('add-feature');

                addBtn.addEventListener('click', function() {
                    const div = document.createElement('div');
                    div.className = 'input-group mb-2';
                    div.innerHTML = `
                        <input type="text" class="form-control plan-feature-input" name="planFeatures[]" required>
                        <button type="button" class="btn btn-danger remove-feature">Remove</button>
                    `;
                    container.appendChild(div);
                    updateRemoveButtons();
                });

                container.addEventListener('click', function(e) {
                    if (e.target.classList.contains('remove-feature')) {
                        e.target.parentElement.remove();
                        updateRemoveButtons();
                    }
                });

                function updateRemoveButtons() {
                    const removeBtns = container.querySelectorAll('.remove-feature');
                    removeBtns.forEach(btn => btn.style.display = 'inline-block');
                    if (removeBtns.length === 1) removeBtns[0].style.display = 'none';
                }
            });
        </script>

    </body>


<!-- Mirrored from laravel8.spruko.com/noa/index by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 06 May 2023 13:08:40 GMT -->
</html>
