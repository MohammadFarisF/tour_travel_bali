// Litepicker
//
// The date pickers in Material Admin Pro
// are powered by the Litepicker plugin.
// Litepicker is a lightweight, no dependencies
// date picker that allows for date ranges
// and other options. For more usage details
// visit the Litepicker docs.
//
// Litepicker Documentation
// https://wakirin.github.io/Litepicker

window.addEventListener("DOMContentLoaded", (event) => {
  const litepickerSingleDate = document.getElementById("litepickerSingleDate");
  if (litepickerSingleDate) {
    new Litepicker({
      element: litepickerSingleDate,
      format: "MMM DD, YYYY",
    });
  }

  const litepickerDateRange = document.getElementById("litepickerDateRange");
  if (litepickerDateRange) {
    new Litepicker({
      element: litepickerDateRange,
      singleMode: false,
      format: "MMM DD, YYYY",
    });
  }

  const litepickerDateRange2Months = document.getElementById("litepickerDateRange2Months");
  if (litepickerDateRange2Months) {
    new Litepicker({
      element: litepickerDateRange2Months,
      singleMode: false,
      numberOfMonths: 2,
      numberOfColumns: 2,
      format: "MMM DD, YYYY",
    });
  }

  const litepickerRangePlugin = document.getElementById("litepickerRangePlugin");
  if (litepickerRangePlugin) {
    new Litepicker({
      element: litepickerRangePlugin,
      startDate: new Date(),
      endDate: new Date(),
      singleMode: false,
      numberOfMonths: 2,
      numberOfColumns: 2,
      format: "MMM DD, YYYY",
      plugins: ["ranges"],
    });
  }

  const today = new Date();

  // Format tanggal menjadi 'Hari, Tanggal Bulan Tahun' (contoh: 'Senin, 29 September 2024')
  const options = { weekday: "long", year: "numeric", month: "long", day: "numeric" };
  const formattedDate = today.toLocaleDateString("id-ID", options); // Menggunakan 'id-ID' untuk format Indonesia

  // Mengisi div dengan tanggal saat ini
  const datepickerDiv = document.getElementById("datepicker");
  datepickerDiv.textContent = formattedDate; // Mengisi teks dalam div

  // Mengatur pointer events untuk menonaktifkan interaksi
  datepickerDiv.style.pointerEvents = "none";
});
