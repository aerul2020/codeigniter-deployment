/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

const video = document.getElementById("my-video");
const SUCCESS = 'success';
const ERROR = 'error';

const startVideo = () => {
    navigator.mediaDevices
        .getUserMedia({
            video: {},
        })
        .then((stream) => {
            video.srcObject = stream;
        })
        .catch((err) => console.error(err));
};

const facesData = [];

const faceMatcher = async () => {
    const labeledFaceDescriptors = await Promise.all(
        FACES_MODELS.map((kode) => {
            kode = JSON.parse(kode);
            const descriptors = [];
            for (let i = 0; i < kode.descriptors.length; i++) {
                descriptors.push(new Float32Array(kode.descriptors[i]));
            }
            return new faceapi.LabeledFaceDescriptors(kode.label, descriptors);
        })
    );
    return new faceapi.FaceMatcher(labeledFaceDescriptors, 0.8);
};

/* Load all models */
Promise.all([
    faceapi.loadSsdMobilenetv1Model(BASE_URL + "/assets/models"),
    faceapi.loadFaceRecognitionModel(BASE_URL + "/assets/models"),
    faceapi.loadFaceLandmarkModel(BASE_URL + "/assets/models"),
]).then(startVideo);

const run = async () => {
    const canvas = faceapi.createCanvasFromMedia(video);
    const target = document.getElementById("target-video");
    const displaySize = {
        width: video.offsetWidth,
        height: video.offsetHeight,
    };

    canvas.setAttribute("id", "canvas-layer");
    target.append(canvas);
    faceapi.matchDimensions(canvas, displaySize);

    const labels = await faceMatcher();

    setInterval(async () => {
        const detections = await faceapi
            .detectSingleFace(video)
            .withFaceLandmarks()
            .withFaceDescriptor();

        if (detections) {
            const resizedDetections = faceapi.resizeResults(detections, displaySize);
            const result = labels.findBestMatch(detections.descriptor);

            canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
            faceapi.draw.drawDetections(canvas, resizedDetections);

            const box = resizedDetections.detection.box;
            const {label, distance} = result;
            const empData = DAFTAR_PEGAWAI[label];

            const distanceResult = parseInt(distance * 100, 10);

            let labelText;

            if (distanceResult <= 40) {
                const userLocation = JSON.parse(localStorage.getItem('position'));

                const data = {
                    kode: label,
                    latitude: userLocation.lat,
                    longitude: userLocation.lng
                };

                $.post(RECORD_ATTENDANCE_ROUTE, data, function (response) {
                    const responseData = JSON.parse(response);
                    if (responseData.status === SUCCESS && responseData.data !== null) {
                        swal({
                            icon: "success",
                            title: "Sukses",
                            text: "Selamat datang " + empData + "!",
                            timer: 2000,
                        }).then(() => {
                            getTodayAttendance();
                        });
                    }
                })
                labelText = (await empData) + " (" + (100 - distanceResult) + ")";
            } else {
                labelText = "Tidak dikenal";
            }
            new faceapi.draw.DrawBox(box, {label: labelText}).draw(canvas);
        } else {
            canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
        }
    }, 100);
};

video.addEventListener("play", run);

const getTodayAttendance = () => {
    $('#attendance-list').DataTable().destroy();
    $('#attendance-list').DataTable({
        "processing": true,
        "searching": false,
        "lengthChange": false,
        "responsive": true,
        "info": false,
        "serverSide": true,
        "serverMethod": "POST",
        "ajax": {
            url: LIST_ATTENDANCE_ROUTE,
            type: 'POST',
            error: function () {

            }
        },
        "aoColumns": [
            {
                data: 'id_presensi',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'nama_pegawai'},
            {data: 'jam_masuk'},
            {data: 'jam_pulang'},
        ],
    });
}