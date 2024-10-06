<!-- app/Views/admin/paket_edit.php -->

<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="truck"></i></div>
                                Pengelolaan Laporan
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xxl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">Cetak Laporan</div>
                <div class="card-body">
                    <div class="sbp-preview">
                        <div class="sbp-preview-content">
                            <form id="reportForm" method="post" action="<?= base_url() ?>bali/report/printReport" target="_blank">
                                <div class="mb-3">
                                    <label for="litepickerDaily">Pilih Tanggal Harian:</label>
                                    <div class="input-group">
                                        <input type="text" id="litepickerDaily" name="dailyDate" class="form-control" />
                                        <input type="hidden" name="reportType" value="daily">
                                        <button type="submit" class="btn btn-primary">Cetak Laporan Harian</button>
                                    </div>
                                </div>

                                <!-- Pilihan Bulanan -->
                                <div class="mb-3">
                                    <label for="litepickerMonthly">Pilih Rentang Bulan:</label>
                                    <div class="input-group">
                                        <input type="text" id="litepickerMonthly" name="monthlyRange" class="form-control" />
                                        <input type="hidden" name="reportType" value="monthly">
                                        <button type="submit" class="btn btn-primary">Cetak Laporan Bulanan</button>
                                    </div>
                                </div>

                                <!-- Pilihan Tahunan -->
                                <div class="mb-3">
                                    <label for="litepickerYearly">Pilih Rentang Tahun:</label>
                                    <div class="input-group">
                                        <input type="text" id="litepickerYearly" name="yearlyRange" class="form-control" />
                                        <input type="hidden" name="reportType" value="yearly">
                                        <button type="submit" class="btn btn-primary">Cetak Laporan Tahunan</button>
                                    </div>
                                </div>

                                <!-- All-time -->
                                <div class="mb-3">
                                    <label for="litepickerAlltime">Seluruh Data:</label>
                                    <div class="input-group">
                                        <input type="hidden" name="reportType" value="all-time">
                                        <button type="submit" class="btn btn-primary">Cetak Semua Data</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        window.addEventListener("DOMContentLoaded", (event) => {
            // Litepicker untuk Tanggal Harian (default hari ini)
            const litepickerDaily = document.getElementById("litepickerDaily");
            if (litepickerDaily) {
                new Litepicker({
                    element: litepickerDaily,
                    singleMode: true,
                    format: "DD-MM-YYYY",
                    startDate: new Date(), // Default ke hari ini
                });
            }

            // Litepicker untuk Rentang Bulanan
            const litepickerMonthly = document.getElementById("litepickerMonthly");
            if (litepickerMonthly) {
                new Litepicker({
                    element: litepickerMonthly,
                    singleMode: false, // Memungkinkan pemilihan rentang bulan
                    format: "MMMM YYYY", // Format bulan
                    numberOfMonths: 2, // Menampilkan 2 bulan sekaligus
                    numberOfColumns: 2,
                    dropdowns: {
                        minYear: 2000,
                        maxYear: new Date().getFullYear(),
                        months: true,
                        years: true,
                    },
                });
            }

            // Litepicker untuk Rentang Tahun
            const litepickerYearly = document.getElementById("litepickerYearly");
            if (litepickerYearly) {
                new Litepicker({
                    element: litepickerYearly,
                    format: "YYYY", // Format hanya tahun
                    dropdowns: {
                        minYear: 2000,
                        maxYear: new Date().getFullYear(),
                        months: false, // Hanya menampilkan tahun
                        years: true,
                    },
                });
            }
        });
    </script>