function updateDateTime() {
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();
    var formattedTime =
        hours.toString().padStart(2, "0") +
        ":" +
        minutes.toString().padStart(2, "0") +
        ":" +
        seconds.toString().padStart(2, "0");

    var days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
    var day = days[now.getDay()];
    var date = now.getDate();
    var months = [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember",
    ];
    var month = months[now.getMonth()];
    var year = now.getFullYear();
    var formattedDate =
        day +
        ", " +
        date.toString().padStart(2, "0") +
        " " +
        month +
        " " +
        year;

    $("#date-part").text(formattedDate);
    $("#time-part").text(formattedTime);
}

setInterval(updateDateTime, 1000);

// $(document).ready(function () {
//     const video = $("#camera-stream")[0];
//     const captureButton = $("#capture");
//     const imageDataInput = $("#foto");
//     const imagePreview = $("#image-preview")[0];

//     // add function hide button submit
//     const submitButton = $('button[type="submit"]');
//     submitButton.hide();

//     navigator.mediaDevices
//         .getUserMedia({ video: true })
//         .then((stream) => {
//             video.srcObject = stream;
//         })
//         .catch((error) => {
//             console.error("Ada kesalahan saat mengakses kamera: ", error);
//         });

//     captureButton.click(function () {
//         const canvas = document.createElement("canvas");
//         const context = canvas.getContext("2d");
//         canvas.width = video.videoWidth;
//         canvas.height = video.videoHeight;
//         context.drawImage(video, 0, 0, canvas.width, canvas.height);

//         const imageDataURL = canvas.toDataURL("image/png");
//         imageDataInput.val(imageDataURL);

//         // Sembunyikan tag video dan tampilkan image preview
//         video.style.display = "none";
//         imagePreview.src = imageDataURL;
//         $(imagePreview).removeClass("d-none");

//         // add function hide button submit
//         captureButton.hide();
//         submitButton.show();
//     });
// });
